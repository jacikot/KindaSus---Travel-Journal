<?php

namespace App\Controllers;

use App\Models\Country;
use App\Models\Place;
use App\Models\Review;
use App\Models\Visited;
use CodeIgniter\Model;

class Journal extends BaseController
{

    public function countryJournal($country = null)
    {
        $this->session->set("country", $country);
        $this->session->set("place", null);
        echo view('country_journal');
    }
    public function reviewsByCountries()
    {

        $user = $this->session->get('userId');
        $country = $this->session->get("country");
        $place = $this->request->getVar('place');
        $countryModel = new Country();
        if ($country != null) {
            $cntId = $countryModel->getId($country);
        } else $cntId = null;

        $revModel = new Review();
        $data=$revModel->getReviewInfo($user,$country,$place,$cntId["code"]);
        echo json_encode($data);

    }

    public function deleteReview(){
        $user=$this->session->get('userId');
        $rev=$this->request->getVar("id_rev");
        $model=new Review();
        $path="../public/assets/db_files/".$user."/review_img/".$rev.'/';
        helper('filesystem');
        delete_files($path,true);
        rmdir($path);
        $model->deleteReview($rev);
        echo $rev;
    }

    public function review($id_rev){
        $this->session->set("id_rev",$id_rev);
        echo view('journal');
    }
}