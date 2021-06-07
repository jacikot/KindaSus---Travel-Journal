<?php

namespace App\Controllers;

use App\Models\Country;
use App\Models\Place;
use App\Models\RegisteredUser;
use App\Models\Review;
use App\Models\FoundUseful;
use CodeIgniter\Model;

/**
 * Author: Jovan Djordjevic 0159/2018
 */
/**
 * ListOfReviews – class for displaying reviews for a certain place
 * for different kinds of users
 *
 * @version 1.0
 */
class ListOfReviews extends BaseController
{
    public function index()
    {
        $idPlc = $this->request->getVar('idPlc');
        $placeName = $this->request->getVar('placeName');
        $countryName = $this->request->getVar('countryName');
        $countryCode = $this->request->getVar('countryCode');

        // if idPlc is an empty string, the user was redirected from the search & trending page whilst using search
        // hence, there must be a check whether the parsed place exists in the database

        // in all other cases, idPlc will be set, so no need to retrieve it from the database

        if ($idPlc == "") {

            // there was a search for a place

            $countryModel = new Country();
            $idCnt = $countryModel->getCountryIdByCode($countryCode);

            $placeModel = new Place();
            $idPlc = $placeModel->getPlaceId($idCnt, $placeName);
        }

        $reviewModel = new Review();
        $data = ['placeAndCountry' => "$placeName, $countryName", 'countryCode' => $countryCode];

        $idUsr = $this->session->get('userId');

//        $userModel = new RegisteredUser();
//        $tokenCount = $userModel->getTokenCount(4);
//        echo view("p1", ['i' => $tokenCount]);

        if ($idUsr != null) {           // checking if a registered user or a guest is on this page

            // a registered user is on this page

            if ($idPlc != null) {               // checking if the place does exist in the database
                $data['reviews'] = $reviewModel->getReviewsForPlaceUser($idPlc, $idUsr);
            }
            return $this->displayPage('list_of_reviews_user', $data);
        }

        // a guest is on this page

        if ($idPlc != null) {
            $data['reviews'] = $reviewModel->getReviewsForPlaceGuest($idPlc);
        }
        return $this->displayPage('list_of_reviews_guest', $data);
    }

    public function updateTokens()                                      // a method called using AJAX
    {
        $idUsr = $this->session->get('userId');
        $idRev = $this->request->getVar('idRev');
        $idOwr = $this->request->getVar('idOwr');
        $vote = $this->request->getVar('vote');

        $foundUsefulModel = new FoundUseful();
        $foundUsefulModel->giveVote($idUsr, $idRev, $vote);         // note that the user has given a vote for this review

        $reviewModel = new Review();
        $reviewModel->updateReviewTokens($idRev, $vote);            // update tokens of that review

        $userModel = new RegisteredUser();
        $userModel->updateOwnerTokens($idOwr, $vote);               // update tokens of the owner of the review
    }
}
