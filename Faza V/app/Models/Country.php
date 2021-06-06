<?php namespace App\Models;

use CodeIgniter\Model;

class Country extends Model
{
    protected $table      = 'country';
    protected $primaryKey = 'id_cnt';
    protected $returnType = 'object';
    protected $allowedFields =['name','code','id_con'];

    /*
     * returns infos for country with given id
     * @return array - name, code
     * */
    public function getCountry($cntid){
        $visited=$this->find($cntid);
        $ret=[];
        $ret["name"]=$visited->name;
        $ret["code"]=$visited->code;
        return $ret;
    }

    /*
     * returns id of country with given name
     * @return int id
     * */

    public function getId($name){
        $countries=$this->where('name',$name)->findAll();
        $ret["id"]=$countries[0]->id_cnt;
        $ret["code"]=$countries[0]->code;
        return $ret;
    }

    public function getCountryIdByCode($countryCode)
    {
        return $this->where('code', $countryCode)->first()->id_cnt;
    }






    public function findCountry($cntr) {
        return like('name', $cntr)->findAll();
    }
    public function getCountryById($id){
        return $this->where('id_cnt', $id)->find();
        //pazi na fin da bi ti vratio samo 1 objekat jer je svakako po primarnom kljucu!!!
    }

    public function getCountryByName($name){
        return $this->where('name',$name)->findAll();
    }


}