<?php namespace App\Models;

use CodeIgniter\Model;

class Country extends Model
{
    protected $table      = 'country';
    protected $primaryKey = 'id_cnt';
    protected $returnType = 'object';
    protected $allowedFields = ['name', 'code', 'id_con'];

    public function findCountry($cntr) {
        return like('name', $cntr)->findAll();
    }
    public function getCountryById($id){
        return $this->where('id_cnt', $id)->find();
        //pazi na fin da bi ti vratio samo 1 objekat jer je svakako po primarnom kljucu!!!
    }


}