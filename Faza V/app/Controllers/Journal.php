<?php

namespace App\Controllers;

use App\Models\Country;
use App\Models\Place;
use App\Models\Review;
use App\Models\Visited;
use CodeIgniter\Model;

/*
 * Author: Jana Toljaga 18/0023
 *
 * Journal Controller - class for showing, deleting and filtering reviews in user's own journal
 * Version 1.0
 *
 *
 * */

class Journal extends BaseController
{

    /*
     * used for opening journal and setting country name into session
     * @return view
     * @throws BadRequestHttpException
     * @throws UnauthorizedHttpException
     *
     * */

    public function countryJournal($country = null)
    {
        $this->session->set("country", $country);
        $this->session->set("place", null);
        echo view('country_journal');
    }

    /*
     * used for getting all review info for user and given country and place (if is set)
     * it uses Country and Review model to get info from database
     *
     * @param Request $request Request - $place
     * @session $country and $userId
     * @return Response
     *
     * @throws BadRequestHttpException
     * @throws UnauthorizedHttpException
     *
     * */

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

    /*
     * used for deleting review along with all images of the review from filesystem
     * it uses Review model to delete review from database
     *
     * @param Request $request Request - $id_rev
     * @session $userId
     * @return Response
     *
     * @throws BadRequestHttpException
     * @throws UnauthorizedHttpException
     *
     * */

    public function deleteReview(){
        $user=$this->session->get('userId');
        $rev=$this->request->getVar("id_rev");
        $model=new Review();
        $path="../public/assets/db_files/".$user."/review_img/".$rev.'/';
        helper('filesystem');
        delete_files($path,true);
        $model->deleteReview($rev);
        if(is_dir($path)) rmdir($path);
        echo $rev;
    }

    /*
    * used for redirecting to ReviewOverview controller to show review content
    *
    * @param int $id_rev
    * @return Response
    *
    * @throws BadRequestHttpException
    * @throws UnauthorizedHttpException
    *
    * */

    public function review($id_rev){
        $this->session->set("id_rev",$id_rev);
        return redirect()->to(base_url("ReviewOverview"));
    }
}