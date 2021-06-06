<?php

namespace App\Controllers;

use App\Models\Place;
use CodeIgniter\Model;

class SearchAndTrending extends BaseController
{
    public function index()
    {
        $data['jsFile'] = 'search_and_trending';
        $data['idUsr'] = $this->session->get('userId');
        if ($data['idUsr'] !=  null) {                                                      // USER / GUEST 3
            return $this->displayPage('search_and_trending_user', $data);
        }
        return $this->displayPage('search_and_trending_guest', $data);
    }

    public function getTrendingPlaces()
    {
        $placeModel = new Place();
        $results = $placeModel->getTrendingPlaces();
        echo json_encode($results);
    }
}
