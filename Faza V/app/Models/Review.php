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

    public function getReviewsForPlaceGuest($idPlc, $type = 'tokens', $direction = 'DESC')
    {
        return $this->select('review.id_rev AS idRev,
                                registered_user.avatar_path AS avatar_path, 
                                registered_user.username AS username, 
                                review.title AS title, 
                                review.token_count AS tokens, 
                                review.date_posted AS date', false)
            ->where('privacy', 0)
            ->join('visited', "review.id_vis = visited.id_vis AND visited.id_plc = $idPlc")
            ->join('registered_user', 'visited.id_usr = registered_user.id_usr')
            ->orderBy($type, $direction)
            ->findAll();
    }

    public function getReviewsForPlaceUser($idPlc, $idUsr, $type = 'tokens', $direction = 'DESC')
    {
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
            ->orderBy($type, $direction)
            ->findAll();
    }

    public function getAllReviews($type = 'tokens', $direction = 'DESC')
    {
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
            ->orderBy($type, $direction)
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
        if ($vote == 'up') {
            $this->where("id_rev", $idRev)->set('token_count', 'token_count + 1', false)->update();
        } else {
            $this->where("id_rev", $idRev)->set('token_count', 'token_count - 1', false)->update();
        }
    }

    public function makeReviewAsPrivate($idRev)
    {
        $this->where("id_rev", $idRev)->set('privacy', '1', false)->update();
    }
}

