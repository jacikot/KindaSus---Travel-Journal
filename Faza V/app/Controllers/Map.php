<?php

namespace App\Controllers;

use App\Models\Country;
use App\Models\Place;
use App\Models\RegisteredUser;
use App\Models\Review;
use App\Models\ToGo;
use App\Models\Visited;
use CodeIgniter\Model;

class Map extends BaseController
{

    public function index()
    {
        $this->session->set('usr_id', 4);
        $this->session->set("country", null);
        echo view('map');
    }



    public function getMap(){

        $user=$this->session->get('usr_id');
        $map=[];
        $visitedModel=new Visited();
        $togoModel=new ToGo();
        $placeModel=new Place();
        $countryModel=new Country();
        $userModel=new RegisteredUser();
        $placesV=$visitedModel->getVisitedPlaces($user);
        foreach($placesV as $place){
            $country=$placeModel->getCountry($place);
            $dataC=$countryModel->getCountry($country);
            $dataC["type"]=1;
            $map[$country]=$dataC;
        }

        $placesGo=$togoModel->getToGoPlaces($user);
        foreach($placesGo as $place){
            $country=$placeModel->getCountry($place);
            $dataC=$countryModel->getCountry($country);
            $dataC["type"]=2;
            $map[$country]=$dataC;
        }

        $home=$userModel->getHomePlace($user);
        $country=$placeModel->getCountry($home);
        $dataC=$countryModel->getCountry($country);
        $dataC["type"]=3;
        $map[$country]=$dataC;
        echo json_encode($map);


    }

    public function getUserInfo(){
        $user=$this->session->get('usr_id');
        $model=new RegisteredUser();
        echo json_encode($model->getUserInfo($user));

    }

}
