<?php

namespace App\Controllers;

use App\Models\Review;
use App\Models\Awarded;
use App\Models\ToGo;
use App\Models\Visited;
use App\Models\RegisteredUser;
use CodeIgniter\Model;

class Admin extends BaseController
{
    public function index()
    {
        $reviewModel = new Review();
        $reviews = $reviewModel->getAllReviews();

        $userModel = new RegisteredUser();
        $users = $userModel->getAllUsers();

        $data = ['reviews' => $reviews, 'users' => $users];

        return $this->displayPage('admin', $data);
    }

    public function markReviewAsPrivate()
    {
        $idRev = $this->request->getVar('idRev');
        $reviewModel = new Review();
        $reviewModel->makeReviewAsPrivate($idRev);
    }

    public function deleteUser()
    {
//        $toGoModel = new Togo();
//        $toGoModel->emptyListForUser($idUsr);
//        $awardedModel = new Awarded();
//        $awardedModel->emptyCollectionForUser($idUsr);
//        $visitedModel = new Visited();
//        $visitedModel->emptyListForUser($idUsr);
        $idUsr = $this->request->getVar('idUsr');
        $userModel = new RegisteredUser();
        $userModel->deleteUser($idUsr);
    }

//    public function refresh()
//    {
//        $type = $this->request->getVar('type');
//        $direction = $this->request->getVar('direction');
//
//        $reviewModel = new Review();
//            $reviews = $reviewModel->getAllReviews($type, $direction);
//        echo json_encode($reviews);
//    }

}
