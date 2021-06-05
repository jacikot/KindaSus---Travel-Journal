<?php

namespace App\Controllers;

use App\Models\RegisteredUser;
use App\Models\Review;
use App\Models\FoundUseful;
use CodeIgniter\Model;

class ListOfReviews extends BaseController
{
    public function index()
    {
        $idPlc = $this->request->getVar('idPlc');
        $placeAndCountry = $this->request->getVar('placeAndCountry');
        $countryCode = $this->request->getVar('countryCode');

        $reviewModel = new Review();
        $data = ['jsFile' => 'list_of_reviews', 'placeAndCountry' => $placeAndCountry,
            'countryCode' => $countryCode, 'idPlc' => $idPlc];

        $data['idUsr'] = $this->session->get('idUsr');
        if ($data['idUsr'] != null) {                                                      // USER / GUEST 1
            $data['reviews'] = $reviewModel->getReviewsForPlaceUser($idPlc, $data['idUsr']);         // $data['idUsr']
            return $this->displayPage('list_of_reviews_user', $data);
        }

        $data['reviews'] = $reviewModel->getReviewsForPlaceGuest($idPlc);
        return $this->displayPage('list_of_reviews_guest', $data);
//        echo view("p1", ["i" => $countryCode, 'a' => $idPlc, 'r' => $placeAndCountry]);
    }


    public function updateTokens()
    {
        $idUsr = $this->session->get('idUsr');                      // $this->session->get('idUsr');
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

//    public function refresh()
//    {
//        $type = $this->request->getVar('type');
//        $direction = $this->request->getVar('direction');
//        $place = $this->request->getVar('place');
//        $usrSet = $this->request->getVar('usrSet');
//
//
//        $reviewModel = new Review();
//        //$reviewModel->updateReviewTokens(3, 'up');
//
//        if ($usrSet == false)                                             // VRATI 2
//            $reviews = $reviewModel->getReviewsForPlaceUser($place, 1, $type, $direction);  // treba $_SESSION['idUsr'], isto i gore
//        else
//            $reviews = $reviewModel->getReviewsForPlaceGuest($place, $type, $direction);
//
//        /*usort($this->reviews, function ($a, $b) use ($type, $direction) {
//            if ($type == 'tokens')
//                return ($a->tokens - $b->tokens) * (($direction == 'ASC') ? 1 : -1);
//            if ($direction == 'DESC')
//                return $a->date < $b->date;
//            return $a->date > $b->date;
//        });*/
//
//        echo json_encode($reviews);
//    }

}
