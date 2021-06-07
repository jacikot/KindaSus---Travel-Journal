<?php namespace App\Controllers;

use App\Models\Image;
use App\Models\Review;
use App\Models\ToGo;
use App\Models\Visited;
use App\Models\Place;
use App\Models\Country;
use CodeIgniter\Model;

/*
 * Author: Adriana Vidic 2018/0311
 * */

/*
 * this controller enables viewing, inserting, deleting and crossing from the To-Go list
 * */
class ToGoList extends BaseController{
    public function index(){
        return view('to-go_list.php');
    }
/*
 * function getMyToGo reads from the database which places are on the user's To-Go list and are they crossed off
 * function returns data encapsulated into JSON object
 * */
public function getMyToGo(){

    $id_usr=$this->session->get('userId');
    $tmp_togo=new ToGo();
    $my_togo=$tmp_togo->getToGo($id_usr);

    $data=[];
    $ind=0;

   foreach ($my_togo as $list_item){
        $id_plc=$list_item->id_plc;

        $tmp_place=new Place();
        $tmp_country=new Country();

        $place=$tmp_place->find($id_plc);
        $id_cnt=$place->id_cnt;
        $country=$tmp_country->find($id_cnt);

        $data[$ind]=$place->name.";".$country->name.";".$list_item->crossed_off;
        $ind++;

   }

    echo json_encode($data);



}
/* function addToToGoList() checks if country exists and if so, it checks if the place exists (if not, it is inserted into Places table)
and inserts destination into To-Go table; if country does not exist function alerts user about that fact
function return string value that represents success of adding the place to To-Go list
 * */

public function addToToGoList(){
    $tmp_togo=new ToGo();
    //provera da li postoji zemlja
    $tmp_place=new Place();
    $place_name=$this->request->getVar('placeToVisit');
    $country_name=$this->request->getVar('countryToVisit');



    $tmp_country=new Country();
    $placelist=$tmp_place->getPlaceByName($place_name);
    $countrylist=$tmp_country->getCountryByName($country_name);
    if($countrylist==null){
        echo "It seems this country doesn't exist :/";
        return;
    }
    $country=$countrylist[0];


    $id_plc=0;
    $num=0;
    $one=1;

    if($placelist==null){
        $tmp_place->save([
            'name'=>$place_name,
            'id_cnt'=>$country->id_cnt,
            'categorized' =>$num,
            'heritage'=>$num,
            'relax'=>$num,
            'sightseeing'=>$num,
            'weather'=>$num,
            'populated'=>$num,

        ]);
        $id_plc=$tmp_place->getInsertID();
    }
    else {
        $place=$placelist[0];
        $id_plc = $place->id_plc;
    }

    $tmp_togo->insert([
        'id_usr'=>$this->session->get('userId'),
        'id_plc'=>$id_plc,
        'crossed_off'=>$num
    ]);

        echo "okay";



}
    /* function crossFromList() checks if country exists and if so, it checks if the place exists; if country does not exist function
    alerts user about that fact; function then checks if there is such place in the user's To-Go list and if so it crosses it off and
     updates the database, and if not it alerts user about that
    function return string value that represents success of crossing place from the To-Go list

     * */

function crossFromList(){
    $tmp_togo=new ToGo();
    $tmp_place=new Place();
    $place_name=$this->request->getVar('placeToCross');
    $country_name=$this->request->getVar('countryToCross');
    $tmp_country=new Country();

    $placelist=$tmp_place->getPlaceByName($place_name);
    if($placelist==null) {
        echo "Sorry, it seems this place doesn't exist :/";
        return;
    }
    $place=$placelist[0];

    $countrylist=$tmp_country->getCountryByName($country_name);
    if($countrylist==null){
        echo "It seems this country doesn't exist :/";
        return;
    }
    $country=$countrylist[0];

    $id_usr=$this->session->get('userId');
    $id_plc=$place->id_plc;


    $items=$tmp_togo->getListItem($id_usr,$id_plc);
    if($items==null){
        echo "It seems that place is not one of your dream destinations :/";
        return;
    }

    $one=1;
    $list_item=$items[0];
    $tmp_togo->save([
        'id_tgl'=>$list_item->id_tgl,
        'id_plc'=>$id_plc,
        'id_usr'=>$id_usr,
        'crossed_off'=>$one
    ]);

    echo "okay";


}
    /* function deleteFromList() checks if country exists and if so, it checks if the place exists; if country does not exist function
       alerts user about that fact; function then checks if there is such place in the user's To-Go list and if so deletes it and updated the database, and if not
       it alerts user about that
       function return string value that represents success of deleting place from the To-Go list
        * */
public function deleteFromList(){
    $tmp_togo=new ToGo();
    $tmp_place=new Place();
    $place_name=$this->request->getVar('placeToCross');
    $country_name=$this->request->getVar('countryToCross');
    $tmp_country=new Country();

    $placelist=$tmp_place->getPlaceByName($place_name);
    if($placelist==null) {
        echo "Sorry, it seems this place doesn't exist :/";
        return;
    }
    $place=$placelist[0];

    $countrylist=$tmp_country->getCountryByName($country_name);
    if($countrylist==null){
        echo "It seems this country doesn't exist :/";
        return;
    }
    $country=$countrylist[0];

    $id_usr=$this->session->get('userId');
    $id_plc=$place->id_plc;


    $items=$tmp_togo->getListItem($id_usr,$id_plc);
    if($items==null){
        echo "It seems that place is not one of your dream destinations :/";
        return;
    }

    $one=1;
    $list_item=$items[0];
    $tmp_togo->deleteFromToGoList($id_usr,$id_plc);

    echo "okay";


}



}