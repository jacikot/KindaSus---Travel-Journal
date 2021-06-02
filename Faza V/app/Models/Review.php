<?php 

namespace App\Models;

use CodeIgniter\Model;

class Review extends Model
{
    protected $table      = 'review';
    protected $primaryKey = 'id_rev';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $allowedFields = ['title', 'text', 'privacy', 'token_count', 'date_posted', 'id_vis'];
    protected $dateFormat = 'date';

    public function getReviewsForPlace($idPlc)
    {
        return $this->select("review.id_rev AS id,
                                registered_user.avatar_path AS avatar_path, 
                                registered_user.username AS username, 
                                review.title AS title, 
                                review.token_count AS tokens, 
                                review.date_posted AS date", false)
                    ->join('visited', 'review.id_vis = visited.id_vis')
                    ->where('visited.id_plc', $idPlc)
                    ->join('registered_user', 'visited.id_usr = registered_user.id_usr')
                    ->orderBy( 'tokens', "DESC")
                    ->findAll();
    }

    public function orderReviews($type, $direction, $reviews)
    {
        usort($reviews, function ($a, $b) use ($type, $direction) {
            if ($type == 'tokens')
                return ($a->tokens - $b->tokens) * (($direction == 'ASC') ? 1 : -1);
            if ($direction == 'DESC')
                return $a->date < $b->date;
            return $a->date > $b->date;
        });
        return $reviews;
    }

    public function getAllReviews()
    {
        return $this->select("review.id_rev AS id,
                                registered_user.avatar_path AS avatar_path, 
                                registered_user.username AS username, 
                                review.title AS title, 
                                review.token_count AS tokens, 
                                place.name AS place,
                                country.name AS country,
                                review.date_posted AS date", false)
            ->join('visited', 'review.id_vis = visited.id_vis')
            ->join('place', 'visited.id_plc = place.id_plc')
            ->join('country', 'place.id_cnt = country.id_cnt')
            ->join('registered_user', 'visited.id_usr = registered_user.id_usr')
            ->orderBy( 'tokens', "DESC")
            ->findAll();
    }

    public function getReviewInfo($usr_id,$country,$place,$code){

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

    public function deleteReview($id){
        $this->where("id_rev",$id)->delete();
    }

}