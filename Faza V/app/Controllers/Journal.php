<?php

namespace App\Controllers;

use App\Models\Country;
use App\Models\Place;
use App\Models\Review;
use App\Models\Visited;

class Journal extends BaseController
{

    public function countryJournal($country = null)
    {
        $this->session->set("country", $country);
        $this->session->set("place", null);
        echo view('country_journal');
    }
    public function reviewsByCountries()
    {

        $user = $this->session->get('usr_id');
        $country = $this->session->get("country");
        $place = $this->request->getVar('place');
        //$this->session->set("place", $place);

        if ($country != null) {
            $countryModel = new Country();
            $cntId = $countryModel->getId($country);
        } else $cntId = null;
        $data = [];

        $visitedModel = new Visited();
        $visits = $visitedModel->getVisited($user);
        /*id_vis id_plc*/

        $placeModel = new Place();
        if ($place == null) $plcInCnt = $placeModel->visitsInCountry($visits, $cntId);
        else $plcInCnt = $placeModel->visitsInPlace($visits, $place);
        /*id_vis id_plc name*/

        $rev = new Review();
        if ($country != null) $data = $rev->getReviews($plcInCnt, $country, $cntId["code"]);
        else $data = $rev->getReviews($plcInCnt, $country, null);
        /*place title text date country*/
        echo json_encode($data);

    }

    public function deleteReview(){
        $rev=$this->request->getVar("id_rev");
        $model=new Review();
        $model->deleteReview($rev);
        echo $rev;
    }

    public function review($id_rev){
        $this->session->set("id_rev",$id_rev);
        echo view('journal');
    }
}