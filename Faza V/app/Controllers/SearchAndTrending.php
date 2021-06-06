<?php

namespace App\Controllers;

use App\Models\Place;
use CodeIgniter\Model;

class SearchAndTrending extends BaseController
{
    public function index()
    {
        $data['idUsr'] = $this->session->get('userId');
        if ($data['idUsr'] !=  null) {                     // checking if a registered user or a guest is on this page
            return $this->displayPage('search_and_trending_user', $data);
        }
        return $this->displayPage('search_and_trending_guest', $data);
    }

    public function getTrendingPlaces()                      // a method called using AJAX
    {
        $placeModel = new Place();
        $results = $placeModel->getTrendingPlaces();         // get the 6 most popular places from the database
        echo json_encode($results);                          // and send them back to the .js file as a callback argument
    }
}
