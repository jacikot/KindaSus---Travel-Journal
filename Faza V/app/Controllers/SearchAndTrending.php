<?php

namespace App\Controllers;

use App\Models\Place;
use CodeIgniter\Model;

/**
 * Author: Jovan Djordjevic 0159/2018
 */
/**
 * SearchAndTrending – class for presenting search & trending functionalities
 * for different kinds of users
 *
 * @version 1.0
 */
class SearchAndTrending extends BaseController
{
    public function index()
    {
        if (isset($_SESSION['userId'])) {                     // checking if a registered user or a guest is on this page
            return $this->displayPage('search_and_trending_user', []);
        }
        return $this->displayPage('search_and_trending_guest', []);
    }

    public function getTrendingPlaces()                      // a method called using AJAX
    {
        $placeModel = new Place();
        $results = $placeModel->getTrendingPlaces();         // get the 6 most popular places from the database and send
        echo json_encode($results);                          // them back to the .js file as a callback function argument
    }
}
