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

    public function deleteReview($id){
        $this->where("id_rev",$id)->delete();
    }

}