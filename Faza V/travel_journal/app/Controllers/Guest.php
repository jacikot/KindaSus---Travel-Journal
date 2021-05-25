<?php

namespace App\Controllers;

use App\Models\PlaceModel;
use App\Models\ReviewModel;
use CodeIgniter\Model;

class Guest extends BaseController
{

    private function displayPage($fileName, $data)
    {
        $data['controller'] = 'Guest';
        $data['fileName'] = $fileName;
        return view("pages/$fileName", $data);
    }

    public function index()
    {
        $idPlc = $this->request->getVar('id_plc');

        $reviewModel = new ReviewModel();
        $reviews = $reviewModel->getReviewsForPlace(5);

        $placeModel = new PlaceModel();
        $placeAndCountry = $placeModel->getPlaceAndCountryNames(5);

        $data = ['reviews' => $reviews, 'placeAndCountry' => $placeAndCountry];

        return $this->displayPage('list_of_reviews_guest', $data);
    }

    public function login()
    {
        return $this->displayPage('login', []);
    }

    public function homepage()
    {
        return $this->displayPage('homepage', []);
    }

    public function register()
    {
        return $this->displayPage('register', []);
    }

    public function review_guest($id)
    {
        return $this->displayPage("review_guest/$id", ['id' => $id]);
    }

    public function refresh()
    {
        $type = $this->request->getVar('type');
        $direction = $this->request->getVar('direction');
        $reviews = json_decode($this->request->getVar('reviews'));
        $reviewModel = new ReviewModel();
        $reviews = $reviewModel->orderReviews($type, $direction, $reviews);
        foreach ($reviews as $review) {
            echo $review->id;
        }
    }
}
