<?php namespace App\Models;

use CodeIgniter\Model;

class Country extends Model
{
    protected $table      = 'country';
    protected $primaryKey = 'id_cnt';
    protected $returnType = 'object';

    protected $allowedFields =['name','code','id_con'];

    public function getCountry($cntid){
        $visited=$this->find($cntid);
        $ret=[];
        $ret["name"]=$visited->name;
        $ret["code"]=$visited->code;
        return $ret;
    }

    public function getId($name){
        $countries=$this->where('name',$name)->findAll();
        $ret["id"]=$countries[0]->id_cnt;
        $ret["code"]=$countries[0]->code;
        return $ret;
    }
}

