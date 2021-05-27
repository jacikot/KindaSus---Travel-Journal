<?php

namespace App\Controllers;

use App\Models\Review;
use App\Models\Awarded;
use App\Models\ToGo;
use App\Models\Visited;
use App\Models\RegisteredUser;

class Admin extends BaseController
{
    private function displayPage($fileName, $data)
    {
        $data['cssFile'] = $fileName;
        return view("pages/$fileName", $data);
    }

    public function index()
    {
        $reviewModel = new Review();
        $reviews = $reviewModel->getAllReviews();

        $userModel = new RegisteredUser();
        $users = $userModel->getAllUsers();

        $data = ['reviews' => $reviews, 'users' => $users];

        return $this->displayPage('admin', $data);
    }

    public function deleteUser($idUsr)
    {
        $toGoModel = new Togo();
        //$toGoModel->emptyListForUser($idUsr);
        $awardedModel = new Awarded();
        //$awardedModel->emptyCollectionForUser($idUsr);
        $visitedModel = new Visited();
        //$visitedModel->emptyListForUser($idUsr);
        $userModel = new RegisteredUser();
        //$userModel->deleteUser($idUsr);
        return $this->index();
    }

    public function reviewAdmin($id)
    {
        return $this->displayPage('review_admin', ['id' => $id]);
    }
}
