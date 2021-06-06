<?php namespace App\Controllers;

use App\Models\Image;
use App\Models\Question;
use App\Models\Review;
use App\Models\ToGo;
use App\Models\Visited;
use App\Models\Place;
use App\Models\Country;
use CodeIgniter\Model;

class CreateReview extends BaseController{

public function index(){
    echo view('create_review.php');
}


    public function validateRev($data){

        //check if all the fields were filled correctly
        //proveriti duzinu polja, da li postoji ta zemlja, da li su svi parametri uneti

        //OVO URADITI!!! + dodati da se napravi poruka koja ce se onda ispisivati na ekranu
        return true;
    }

    protected function getPlace($plc, $country){
        //proveriti da li mesto postoji u bazi
        //ako postoji vratiti njegov id
        //ako ne postoji ubaciti i onda vratiti njegov id

        return 1;
    }


    public function addVisit($plc, $country){


        $tmp_country=new Country();
        $tmp_place=new Place();

        $country_list=$tmp_country->getCountryByName($country);
        $country_obj=$country_list[0];
        $place_list=$tmp_place->getPlaceByNameAndCountry($plc, $country_obj->id_cnt);
        if(!$place_list){
            $num=0;
            $one=1;
            $tmp_place->save([
                'name'=>$plc,
                'categorized'=>$num,
                'category_1'=>$num,
                'category_2'=>$num,
                'category_3'=>$num,
                'category_4'=>$num,
                'category_5'=>$num,
                'id_img'=>$one,
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
        $tmp_visit->save([
            'id_plc'=>$place_obj->id_plc,
            'id_usr'=>intval(session()->get("userId"))
        ]);

        /*
         $tmp_awarded=new Awarded();
        $id_con=$country_obj->id_con;
        $id_bdg=($id_con-1)/2*5+1+($id_con-1)%2;

        $tmp_awarded->giveBadgeIfNotGiven($this->session->get('userId'),$id_bdg);

         */


        return $tmp_visit->getInsertID();
    }

    public function pinOnTheMap(){
        $id_vis=$this->addVisit($this->request->getVar('place'), $this->request->getVar('country'));
        echo "Congrats! You pinned a place on the map!";
    }

    public function addRev() {
        $id_vis=$this->addVisit($this->request->getVar('place'), $this->request->getVar('country'));
        $num=0;
        $id_pic=0;

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
        $new_points_heritage=(($points_heritage+$place_obj->category_1*$num_surveys))/(($num_surveys+1));
        $new_points_relax=(($points_relax+$place_obj->category_2*$num_surveys))/(($num_surveys+1));
        $new_points_sightseeing=(($points_sightseeing+$place_obj->category_3*$num_surveys))/(($num_surveys+1));
        $new_points_weather=(($points_weather+$place_obj->category_4*$num_surveys))/(($num_surveys+1));
        $new_points_populated=(($points_populated+$place_obj->category_5*$num_surveys))/(($num_surveys+1));


        $num=0;
        $one=0;

        $num_surveys++;
        if( $num_surveys>=5)$one=1;
        $tmp_place->save([
            'id_plc'=>$place_obj->id_plc,
            'id_cnt'=>$place_obj->id_cnt,
            'categorized'=>$one,
            'category_1'=>$new_points_heritage,
            'category_2'=>$new_points_relax,
            'category_3'=>$new_points_sightseeing,
            'category_4'=>$new_points_weather,
            'category_5'=>$new_points_populated,
            'taken_survey'=>$num_surveys,
            'name'=>$place_obj->name,
            'id_img'=>$place_obj->id_img

        ]);

    }
}