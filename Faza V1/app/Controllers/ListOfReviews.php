<?php

namespace App\Controllers;

use App\Models\Place;
use App\Models\Review;
use CodeIgniter\Model;

class ListOfReviews extends BaseController
{

    private function displayPage($fileName, $data)
    {
        $data['cssFile'] = $fileName;
        return view("pages/$fileName", $data);
    }

    public function index($idPlc)
    {
        $reviewModel = new Review();
        $reviews = $reviewModel->getReviewsForPlace($idPlc);

        $placeModel = new Place();
        $placeAndCountry = $placeModel->getPlaceAndCountryNames($idPlc);

        $data = ['reviews' => $reviews, 'placeAndCountry' => $placeAndCountry, 'jsFile' => 'list_of_reviews'];

        if ($this->session->get('id_usr'))
            return $this->displayPage('list_of_reviews_user', $data);
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

    public function passport()
    {
        return $this->displayPage('map', []);
    }

    public function reviewGuest($id)
    {
        return $this->displayPage('review_guest', ['id' => $id]);
    }

    public function reviewUser($id)
    {
        return $this->displayPage('review_user', ['id' => $id]);
    }

    public function refresh()
    {
        $type = $this->request->getVar('type');
        $direction = $this->request->getVar('direction');
        $reviews = json_decode($this->request->getVar('reviews'));

        $reviewModel = new Review();
        $reviews = $reviewModel->orderReviews($type, $direction, $reviews);

        foreach ($reviews as $review) {
            echo $review->id;
        }
    }
}
