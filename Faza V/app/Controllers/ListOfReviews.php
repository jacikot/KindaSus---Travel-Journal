<?php

namespace App\Controllers;

use App\Models\Country;
use App\Models\Place;
use App\Models\RegisteredUser;
use App\Models\Review;
use App\Models\FoundUseful;
use CodeIgniter\Model;

class ListOfReviews extends BaseController
{
    public function index()
    {
        $idPlc = $this->request->getVar('idPlc');
        $placeName = $this->request->getVar('placeName');
        $countryName = $this->request->getVar('countryName');
        $countryCode = $this->request->getVar('countryCode');

        if ($idPlc == "") {                                                         // JOLETOV SEARCH
            $countryModel = new Country();
            $idCnt = $countryModel->getCountryIdByCode($countryCode);

            $placeModel = new Place();
            $idPlc = $placeModel->getPlaceId($idCnt, $placeName);
        }
        else {

        }

        $reviewModel = new Review();
        $data = ['jsFile' => 'list_of_reviews', 'placeAndCountry' => "$placeName, $countryName",
            'countryCode' => $countryCode, 'idUsr' => $this->session->get('userId')];

        if ($data['idUsr'] != null) {                                                      // USER / GUEST 1
            if ($idPlc != null) {
                $data['reviews'] = $reviewModel->getReviewsForPlaceUser($idPlc, $data['idUsr']);         // $data['idUsr']
            }
            return $this->displayPage('list_of_reviews_user', $data);
        }

        if ($idPlc != null) {
            $data['reviews'] = $reviewModel->getReviewsForPlaceGuest($idPlc);
        }
        return $this->displayPage('list_of_reviews_guest', $data);
        //echo view("p1", ["i" => $idPlc]);
    }


    public function updateTokens()
    {
        $idUsr = $this->session->get('userId');                      // $this->session->get('userId');
        $idRev = $this->request->getVar('idRev');
        $idOwr = $this->request->getVar('idOwr');
        $vote = $this->request->getVar('vote');

        $foundUsefulModel = new FoundUseful();
        $foundUsefulModel->giveVote($idUsr, $idRev, $vote);

        $reviewModel = new Review();
        $reviewModel->updateReviewTokens($idRev, $vote);

        $userModel = new RegisteredUser();
        $userModel->updateOwnerTokens($idOwr, $vote);
    }

}
