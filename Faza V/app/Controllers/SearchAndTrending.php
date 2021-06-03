<?php

namespace App\Controllers;

use App\Models\Place;
use CodeIgniter\Model;

class SearchAndTrending extends BaseController
{
    public function index()
    {
        $data['jsFile'] = 'search_and_trending';
        $data['idUsr'] = $this->session->get('idUsr');
        if ($data['idUsr'] !=  null) {                                                      // USER / GUEST 3
            return $this->displayPage('list_of_reviews_user', $data);
        }
        return $this->displayPage('search_and_trending_guest', $data);
    }

    public function search()
    {
        $inputVal = $this->request->getVar('inputVal');
        $placeModel = new Place();
        $results = $placeModel->findMatchingPlaceOrCountry($inputVal);
        echo json_encode($results);
    }
}
