<?php namespace App\Models;

use CodeIgniter\Model;

class Review extends Model
{
    protected $table      = 'review';
    protected $primaryKey = 'id_rev';
    protected $returnType = 'object';

    protected $allowedFields = ['id_rev', 'id_vis','title','text','date_posted'];

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


}