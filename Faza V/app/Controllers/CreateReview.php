<?php namespace App\Controllers;

use App\Models\Image;
use App\Models\Question;
use App\Models\Review;
use App\Models\ToGo;
use App\Models\Visited;
use App\Models\Place;
use App\Models\Country;
use App\Models\Awarded;
use CodeIgniter\Model;
/*
 *
 * This controller enables creating a review
 *
 */
class CreateReview extends BaseController{

public function index(){

    return view('create_review.php');
}

/*
 *
 * Author: Adriana Vidic 2018/0311
 */

/*
 * function addVisit inserts a new visit into Visited table, while checking if the country exists in database (if not, it
 * alerts user about that, and checks if the place exists in the Place table (if not, the place is inserted into that table)
 * function also checks if user has made that destination one of his To-Go goals, and if so, it deletes that from his To-Go list
 * it also awards user with a badge for a continent he has visited by visiting that destination
 *
 * function returns integer value of the id of the inserted visit
 * */


    public function addVisit($plc, $country){


        $tmp_country=new Country();
        $tmp_place=new Place();

        $country_list=$tmp_country->getCountryByName($country);
        if($country_list==null){
            return -1;
        }
        $country_obj=$country_list[0];
        $place_list=$tmp_place->getPlaceByNameAndCountry($plc, $country_obj->id_cnt);
        if(!$place_list){
            $num=0;
            $one=1;
            $tmp_place->save([
                'name'=>$plc,
                'categorized'=>$num,
                'heritage'=>$num,
                'relax'=>$num,
                'sightseeing'=>$num,
                'weather'=>$num,
                'populated'=>$num,
                'id_cnt'=>$country_obj->id_cnt,
                'taken_survey'=>$num
            ]);
            $place_list=$tmp_place->getPlaceByNameAndCountry($plc, $country_obj->id_cnt);
            $place_obj=$place_list[0];
        }
        else
        $place_obj=$place_list[0];

        $tmp_togo=new ToGo();
        $togo_item=$tmp_togo->getListItem($this->session->get('userId'),$place_obj->id_plc);
        if($togo_item!=null) $tmp_togo->deleteFromToGoList($this->session->get('userId'),$place_obj->id_plc);



        $tmp_visit=new Visited();
        $tmp_visit->insert([
            'id_plc'=>$place_obj->id_plc,
            'id_usr'=>$this->session->get("userId")
        ]);


         $tmp_awarded=new Awarded();
        $id_con=$country_obj->id_con;
        $id_bdg=($id_con-1)/2*5+1+($id_con-1)%2;

        $tmp_awarded->giveBadgeIfNotGiven($this->session->get('userId'),$id_bdg);




        return $tmp_visit->getInsertID();
    }
/*
 * function pinOnTheMap inserts visit into Visited table so that it can be shown on user's map
 * function returns string value that represents the success of the function
 * */
    public function pinOnTheMap(){
        $id_vis=$this->addVisit($this->request->getVar('place'), $this->request->getVar('country'));
        if($id_vis==-1){
            echo 'It looks like the country does not exist';
            return;
        }
        echo "Congrats! You pinned a place on the map!";
    }

    /*
    function addRev creates a review while checking if all of the data collected from the form is valid (country exists,
    all of the form fields were filled,if images are added they have valid extensions and are not too big, etc.),
     if not it alerts the user about that
function returns string value that represents the success of the function
     */

    public function addRev() {
        $id_vis=$this->addVisit($this->request->getVar('place'), $this->request->getVar('country'));
        $num=0;
        $id_pic=0;
        if($id_vis==-1){
            echo 'It looks like the country does not exist';
            return;
        }

        //create new review
        $review = new Review();
        $review->save([

            'title' => $this->request->getVar('title'),
            'text' => $this->request->getVar('text'),
            'privacy' => $this->request->getVar('privacy'),
            'token_count' => $num,
            'id_vis' => $id_vis,
            'date_posted' => $this->request->getVar('date')

        ]);
        $id_rev=$review->getInsertID();

        $id=$this->session->get('userId');
///////////////

        $added_images=$this->request->getVar('num_of_pics');
        if($added_images>0) {
            while ($added_images > 0) {

                $filename="file".$added_images;
                $added_images--;

                $img = $this->request->getFile($filename);
                $imageExists = true;
                $ext = "";
                if (!isset($img)) {
                    $imageExists = false;


                } else {
                    if (!is_uploaded_file($img)) {
                        echo "Not a good file..";
                        return;
                    }
                    $ext = strtolower(pathinfo($img->getName(), PATHINFO_EXTENSION));
                    $supported_image = array(
                        'gif',
                        'jpg',
                        'jpeg',
                        'png'
                    );
                    if (!in_array($ext, $supported_image)) {
                        echo $ext . " Inadequate type!";
                        return;
                    }

                    if ($img->getSize() > 150000) {
                        echo "File is too large!";
                        return;
                    }


                }


                if ($imageExists) {
                    $img->store("../../public/assets/db_files/" . $id . "/review_img/".$id_rev."/", "review." . $id_rev . "_" . $id_pic . "." . $ext);

                    $tmp_image = new Image();
                    $tmp_image->save([
                        'id_rev' => $id_rev,
                        'image_path' => "" . "/assets/db_files/" . $id . "/review_img/".$id_rev."/" . "review." . $id_rev . "_" . $id_pic . "." . $ext
                    ]);

                    //  $user->avatar_path = "" . "/assets/db_files/".$id."/review_img/"."review.".$id_rev."_".$id_pic. $ext;
                    $id_pic++;
                }

            }
        }

        echo "Congrats! You added another adventure to your journal!";

    }

/*
 * function getSurveyQuestions collects survey questions from the database and returns them encapsulated into a JSON object
 *
 */

    public function getSurveyQuestions(){
            $tmp_question=new Question();

            $question_heritage_list=$tmp_question->getQuestionByForm(3);
            $question_heritage=$question_heritage_list[0];

        $question_relax_list=$tmp_question->getQuestionByForm(4);
        $question_relax=$question_relax_list[0];

        $question_sightseeing_list=$tmp_question->getQuestionByForm(5);
        $question_sightseeing=$question_sightseeing_list[0];

        $question_weather_list=$tmp_question->getQuestionByForm(6);
        $question_weather=$question_weather_list[0];

        $question_populated_list=$tmp_question->getQuestionByForm(7);
        $question_populated=$question_populated_list[0];

        $data=['heritage'=>$question_heritage->text,
            'relax'=>$question_relax->text,
            'sightseeing'=>$question_sightseeing->text,
            'populated'=>$question_populated->text,
            'weather'=>$question_weather->text
        ];
        echo json_encode($data);


    }
/*
 * unction completeSurveyInfo collects answers the user has given to the survey at the end of writing into his/hers journal and
 * calculates new points in each of the category for the reviewed place
 * function returns void
 * */
    public function completeSurveyInfo(){
        $place=$this->request->getVar('place');
        $country=$this->request->getVar('country');
        $points_heritage=$this->request->getVar('points_heritage');
        $points_relax=$this->request->getVar('points_relax');
        $points_weather=$this->request->getVar('points_weather');
        $points_sightseeing=$this->request->getVar('points_sightseeing');
        $points_populated=$this->request->getVar('points_populated');


        $tmp_country=new Country();
        $tmp_place=new Place();

        $country_list=$tmp_country->getCountryByName($country);
        $country_obj=$country_list[0];
        $place_list=$tmp_place->getPlaceByNameAndCountry($place, $country_obj->id_cnt);
        $place_obj=$place_list[0];


        $num_surveys=$place_obj->taken_survey;
        $new_points_heritage=(($points_heritage+$place_obj->heritage*$num_surveys))/(($num_surveys+1));
        $new_points_relax=(($points_relax+$place_obj->relax*$num_surveys))/(($num_surveys+1));
        $new_points_sightseeing=(($points_sightseeing+$place_obj->sightseeing*$num_surveys))/(($num_surveys+1));
        $new_points_weather=(($points_weather+$place_obj->weather*$num_surveys))/(($num_surveys+1));
        $new_points_populated=(($points_populated+$place_obj->populated*$num_surveys))/(($num_surveys+1));


        $num=0;
        $one=0;

        $num_surveys++;
        if( $num_surveys>=5)$one=1;
        $tmp_place->save([
            'id_plc'=>$place_obj->id_plc,
            'id_cnt'=>$place_obj->id_cnt,
            'categorized'=>$one,
            'heritage'=>$new_points_heritage,
            'relax'=>$new_points_relax,
            'sightseeing'=>$new_points_sightseeing,
            'weather'=>$new_points_weather,
            'populated'=>$new_points_populated,
            'taken_survey'=>$num_surveys,
            'name'=>$place_obj->name,

        ]);

    }
}