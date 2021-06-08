<?php

namespace App\Controllers;

use App\Models\Review;
use App\Models\RegisteredUser;
use CodeIgniter\Model;

/**
 * Author: Jovan Djordjevic 0159/2018
 */
/**
 * Admin – class for maintaining admin activities
 *
 * @version 1.0
 */
class Admin extends BaseController
{
    public function index()
    {
        $reviewModel = new Review();
        $reviews = $reviewModel->getAllReviews();                       // get all reviews from all the users

        $userModel = new RegisteredUser();
        $users = $userModel->getAllUsers();                              // get all users

        $data = ['reviews' => $reviews, 'users' => $users];

        return $this->displayPage('admin', $data);
    }

    public function markReviewAsPrivate()       // a method called using AJAX
    {
        $idRev = $this->request->getVar('idRev');
        $reviewModel = new Review();
        $reviewModel->changePrivacy($idRev, 'private');            // mark review as private
    }

    public function deleteUser()                // a method called using AJAX
    {
        // when a user is deleted, all of the information stored about this user is
        // also deleted, including all his reviews, all his place visits, badges won and to-go places

        $idUsr = $this->request->getVar('idUsr');
        $userModel = new RegisteredUser();
        $userModel->deleteUser($idUsr);
    }
}
