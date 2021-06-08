<?php

namespace App\Controllers;

use App\Models\Country;
use App\Models\Place;
use App\Models\RegisteredUser;
use App\Models\Review;
use App\Models\ToGo;
use App\Models\Visited;
use CodeIgniter\Model;
/*
 * Author: Jana Toljaga 18/0023
 *
 * Map Controller - class for handling interactive map and all options of main page
 * Version 1.0
 *
 *
 * */
class Map extends BaseController
{
    /*
    * used for opening map and setting all used flags in session to default values
    * @return view
     *
    * @throws BadRequestHttpException
    * @throws UnauthorizedHttpException
    *
    * */

    public function index()
    {

        $this->session->set('answered',null);
        $this->session->set('flag',null);
        $this->session->set("country", null);
        $this->session->set("forgot",null);
        echo view('map');
    }

    /*
        * used for getting info needed coloring visited, togo and home countries on a map and tooltip content
        * uses ToGo, Place, Country, Visited and RegisteredUser models to get info from database
        * @session $country and $userId
        *
        * @return Response
        * @throws BadRequestHttpException
        * @throws UnauthorizedHttpException
        *
        *
     * */

    public function getMap(){

        $user=$this->session->get('userId');
        $map=[];
        $visitedModel=new Visited();
        $togoModel=new ToGo();
        $placeModel=new Place();
        $countryModel=new Country();
        $userModel=new RegisteredUser();
        $placesGo=$togoModel->getToGoPlaces($user);
        foreach($placesGo as $place){
            $country=$placeModel->getCountry($place);
            $dataC=$countryModel->getCountry($country);
            $dataC["type"]=2;
            $map[$country]=$dataC;
        }

        $placesV=$visitedModel->getVisitedPlaces($user);
        foreach($placesV as $place){
            $country=$placeModel->getCountry($place);
            $dataC=$countryModel->getCountry($country);
            $dataC["type"]=1;
            $map[$country]=$dataC;
        }



        $home=$userModel->getHomePlace($user);
        $country=$placeModel->getCountry($home);
        $dataC=$countryModel->getCountry($country);
        $dataC["type"]=3;
        $map[$country]=$dataC;
        echo json_encode($map);


    }

    /*
        * used for getting user's info needed for dropdown menu
        * uses RegisteredUser model to get info from database
        * @session $country and $userId
        *
        * @return Response
        * @throws BadRequestHttpException
        * @throws UnauthorizedHttpException
        *
        *
     * */

    public function getUserInfo(){
        $user=$this->session->get('userId');
        $model=new RegisteredUser();
        echo json_encode($model->getUserInfo($user));

    }

}
