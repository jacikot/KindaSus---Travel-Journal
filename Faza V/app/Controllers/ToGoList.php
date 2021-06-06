<?php namespace App\Controllers;

use App\Models\Image;
use App\Models\Review;
use App\Models\ToGo;
use App\Models\Visited;
use App\Models\Place;
use App\Models\Country;
use CodeIgniter\Model;

class ToGoList extends BaseController{
    public function index(){
        echo view('to-go_list.php');
    }

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
            'category_1'=>$num,
            'category_2'=>$num,
            'category_3'=>$num,
            'category_4'=>$num,
            'category_5'=>$num,
            'id_img'=>$one
        ]);
        $id_plc=$tmp_place->getInsertID();
    }
    else {
        $place=$placelist[0];
        $id_plc = $place->id_plc;
    }

    $tmp_togo->save([
        'id_usr'=>$this->session->get('userId'),
        'id_plc'=>$id_plc,
        'crossed_off'=>$num
    ]);

        echo "okay";



}

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