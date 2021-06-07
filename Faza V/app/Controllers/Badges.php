<?php

namespace App\Controllers;

use App\Models\Awarded;
use App\Models\Badge;
use App\Models\RegisteredUser;
use App\Models\Visited;
use CodeIgniter\Model;
use \Datetime;

/**
 * Author: Jovan Djordjevic 0159/2018
 */
/**
 * Badges – class for presenting badges
 *
 * @version 1.0
 */
class Badges extends BaseController
{
    public function index()
    {

        $idUsr = $this->session->get('userId');

        $this->checkTokenBadges($idUsr);                        // checking if the user has won any of the badges
        $this->checkTravelBadges($idUsr);                       // on loading the page itself
        $this->checkTimeBadges($idUsr);

        $badgeModel = new Badge();
        $data['badges'] = $badgeModel->getBadgesForUser($idUsr);    // information about the badges the user has won
        return $this->displayPage('badges', $data);
    }

    // if the user has a token count up to some value, he might get a badge

    private function checkTokenBadges($idUsr)
    {
        $userModel = new RegisteredUser();
        $tokenCount = $userModel->getTokenCount($idUsr);
//        echo view("p1", ['i' => $tokenCount]);

        $awardedModel = new Awarded();

        if ($tokenCount >= 1000) {
            $awardedModel->giveBadgeIfNotGiven($idUsr, 5);
        }
        elseif ($tokenCount >= 100) {
            $awardedModel->giveBadgeIfNotGiven($idUsr, 4);
        }
        elseif ($tokenCount >= 10) {
            $awardedModel->giveBadgeIfNotGiven($idUsr, 3);
        }
    }

    // if the user has travelled a certain amount of times, he might get a badge

    private function checkTravelBadges($idUsr)
    {
        $visitedModel = new Visited();
        $travelCount = $visitedModel->getTravelCount($idUsr);

        $awardedModel = new Awarded();

        if ($travelCount >= 20) {
            $awardedModel->giveBadgeIfNotGiven($idUsr, 10);
        }
        elseif ($travelCount >= 5) {
            $awardedModel->giveBadgeIfNotGiven($idUsr, 9);
        }
        elseif ($travelCount >= 1) {
            $awardedModel->giveBadgeIfNotGiven($idUsr, 8);
        }
    }

    // if the user has been using this app for a certain period of time, he might get a badge

    private function checkTimeBadges($idUsr)
    {
        $userModel = new RegisteredUser();
        $accCreationDateStr = $userModel->getAccCreationDate($idUsr);

        $date1 = new DateTime($accCreationDateStr);
        $date2 = new DateTime();
        $timePassed  = $date2->diff($date1);

        $awardedModel = new Awarded();

        if ($timePassed->y >= 1) {
            $awardedModel->giveBadgeIfNotGiven($idUsr, 15);
        }
        elseif ($timePassed->m >= 6) {
            $awardedModel->giveBadgeIfNotGiven($idUsr, 14);
        }
        elseif ($timePassed->m >= 1) {
            $awardedModel->giveBadgeIfNotGiven($idUsr, 13);
        }
    }
}
