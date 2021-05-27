<?php namespace App\Models;

use CodeIgniter\Model;

class Place extends Model
{
    protected $table      = 'place';
    protected $primaryKey = 'id_plc';
    protected $returnType = 'object';
    protected $allowedFields = ['name', 'categorized', 'category1','category2','category3','category4','category5', 'id_img', 'id_cnt'];

    public function findPlace($plc) {
        return like('name', $plc)->findAll();
    }

    public function getPlaceById($id){
        return $this->where('id_plc', $id)->find();
    }



}