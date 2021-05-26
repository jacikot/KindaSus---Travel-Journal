<?php namespace App\Models;

use CodeIgniter\Model;

class Place extends Model
{
    protected $table      = 'place';
    protected $primaryKey = 'id_plc';
    protected $returnType = 'object';
    protected $allowedFields = ['name', 'category','categorized','heritage','relax','sightseeing',
        'weather','populated','id_img','id_cnt'];

    public function getAllCategorized(){
       return $this->where('categorized',1)->findAll();
    }
    public function findPlace($name){
        return $this->where('name',$name)->findAll();
    }

    public function findPlaceId($name){
        $place =  $this->where('name',$name)->findAll();

        if($place == null) return null;

        foreach($place as $p){
            return $p->id_plc;
        }

    }

    public function insertPlace(){

    }





}