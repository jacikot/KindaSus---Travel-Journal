<?php 

namespace App\Models;

use CodeIgniter\Model;

class Review extends Model
{
    protected $table = 'review';
    protected $primaryKey = 'id_rev';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $allowedFields = ['title', 'text', 'privacy', 'token_count', 'date_posted', 'id_vis'];
    protected $dateFormat = 'date';

    public function getReviewsForPlaceGuest($idPlc)
    {
        // retrieving information about all the reviews for a certain place - called for guest

        return $this->select('review.id_rev AS idRev,
                                registered_user.avatar_path AS avatar_path, 
                                registered_user.username AS username, 
                                review.title AS title, 
                                review.token_count AS tokens, 
                                review.date_posted AS date', false)
            ->where('privacy', 0)
            ->join('visited', "review.id_vis = visited.id_vis AND visited.id_plc = $idPlc")
            ->join('registered_user', 'visited.id_usr = registered_user.id_usr')
            ->orderBy('tokens', 'DESC')
            ->findAll();
    }

    public function getReviewsForPlaceUser($idPlc, $idUsr)
    {
        // retrieving information about all the reviews for a certain place - called for user

        return $this->select("review.id_rev AS idRev,
                                registered_user.id_usr AS idOwr,
                                registered_user.avatar_path AS avatarPath, 
                                registered_user.username AS username, 
                                review.title AS title, 
                                review.token_count AS tokens, 
                                review.date_posted AS date,
                                CASE 
                                    WHEN found_useful.id_fnd IS NOT NULL THEN '1'
                                    ELSE '0'
                                END AS foundUseful", false)
            ->where('privacy', 0)
            ->join('visited', "review.id_vis = visited.id_vis AND visited.id_plc = $idPlc")
            ->join('registered_user', 'visited.id_usr = registered_user.id_usr')
            ->join('found_useful', "$idUsr = found_useful.id_usr AND review.id_rev = found_useful.id_rev", "left")
            ->orderBy('tokens', 'DESC')
            ->findAll();
    }

    public function getAllReviews()
    {
        // retrieving information about all the reviews in the database

        return $this->select("review.id_rev AS idRev,
                                registered_user.id_usr AS idOwr,
                                registered_user.avatar_path AS avatarPath, 
                                registered_user.username AS username, 
                                review.title AS title, 
                                place.name AS place,
                                country.name AS country,
                                review.token_count AS tokens, 
                                review.date_posted AS date,
                                review.privacy as privacy", false)
            ->join('visited', 'review.id_vis = visited.id_vis')
            ->join('place', 'visited.id_plc = place.id_plc')
            ->join('country', 'place.id_cnt = country.id_cnt')
            ->join('registered_user', 'visited.id_usr = registered_user.id_usr')
            ->orderBy('tokens', 'DESC')
            ->findAll();
    }

    public function getReviews($visits,$country,$code){
        $revs=[];
        $re=[];
        $re["country"]=$country;
        $re["code"]=$code;
        $revs[]=$re;
        foreach($visits as $visit){
            $reviews=$this->where('id_vis',$visit['id_vis'])->findAll();
            foreach($reviews as $r){
                $re=[];
                $re["place"]=$visit["name"];
                $re["title"]=$r->title;
                $re["text"]=$r->text;
                $re["date_posted"]=$r->date_posted;
                $re["id_rev"]=$r->id_rev;
                $revs[]=$re;

            }

        }
        return $revs;
    }

    public function updateReviewTokens($idRev, $vote)
    {
        // updating tokens of a review that was given a token / a review a token was taken away from

        if ($vote == 'up') {
            $this->where("id_rev", $idRev)->set('token_count', 'token_count + 1', false)->update();
        }
        if ($vote == 'down') {
            $this->where("id_rev", $idRev)->set('token_count', 'token_count - 1', false)->update();
        }
    }

    public function changePrivacy($idRev, $type)
    {
        // changing privacy of a review, depending on the type of change

        if ($type == 'private') {
            $this->where("id_rev", $idRev)->set('privacy', '1', false)->update();
        }
        if ($type == 'public') {
            $this->where("id_rev", $idRev)->set('privacy', '0', false)->update();
        }
    }

    /*
     * function returns review info needed for review list, joins with tables: visited, place, country, registered_user
     *
     * @return array - country, place, title, text, date, id_rev
     *
     * */

    public function getReviewInfo($usr_id,$country,$place,$code)
    {
        $res=$this->select("review.id_rev AS id_rev,review.title AS title, review.text AS text, place.name AS place, country.name AS country,review.date_posted AS date", false)
            ->join('visited', 'review.id_vis = visited.id_vis')
            ->join('place', 'visited.id_plc = place.id_plc')
            ->join('country', 'place.id_cnt = country.id_cnt')
            ->join('registered_user', 'visited.id_usr = registered_user.id_usr')
            ->where('visited.id_usr',$usr_id);
        if($country!=null){
            $res=$res->where('country.name',$country);
        }
        if($place!=null){
            $res=$res->where('place.name',$place);
        }
        $res=$res->orderBy( 'date_posted',"ASC")->findAll();
        $revs=[];
        $re["country"]=$country;
        $re["code"]=$code;
        $revs[]=$re;
        foreach ($res as $r){
            $re=[];
            $re["country"]=$r->country;
            $re["place"]=$r->place;
            $re["title"]=$r->title;
            $re["text"]=$r->text;
            $re["date_posted"]=$r->date;
            $re["id_rev"]=$r->id_rev;
            $revs[]=$re;
        }
        return $revs;

    }

    /*function deleteReview deletes (if exists) review with given id
    * function returns void
    * */

    public function deleteReview($id){
        $this->where("id_rev",$id)->delete();
    }


    /*function getRevById fetches (if exists) review with given id
     * function returns Review object
     * */
    public function getRevById($id){
        return $this->where('id_rev', $id)->find();
    }

}
