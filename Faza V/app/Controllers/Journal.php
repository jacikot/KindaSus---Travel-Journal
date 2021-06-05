<?php

namespace App\Controllers;

use App\Models\Country;
use App\Models\Place;
use App\Models\Review;
use App\Models\Visited;
use CodeIgniter\Model;

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
        $countryModel = new Country();
        if ($country != null) {
            $cntId = $countryModel->getId($country);
        } else $cntId = null;

        $revModel = new Review();
        $data=$revModel->getReviewInfo($user,$country,$place,$cntId["code"]);
//
//        $visitedModel = new Visited();
//        $visits = $visitedModel->getVisited($user);
//        /*id_vis id_plc*/
//
//        $placeModel = new Place();
//        if ($place == null) $plcInCnt = $placeModel->visitsInCountry($visits, $cntId);
//        else $plcInCnt = $placeModel->visitsInPlace($visits, $place);
//        /*id_vis id_plc name*/
//
//
//        if ($country != null) $data = $rev->getReviews($plcInCnt, $country, $cntId["code"]);
//        else $data = $rev->getReviews($plcInCnt, $country, null);
//        /*place title text date country*/
//        $data=$countryModel->setCountriyNames($data);
        echo json_encode($data);

    }
}