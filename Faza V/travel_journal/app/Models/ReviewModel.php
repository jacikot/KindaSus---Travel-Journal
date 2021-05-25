<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Database;

class ReviewModel extends Model
{
    protected $table      = 'review';
    protected $primaryKey = 'id_rev';
    protected $useAutoIncrement = true;
    protected $returnType     = 'object';
    protected $allowedFields = ['title', 'text_path', 'privacy', 'token_count', 'date_posted', 'id_vis'];
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
}