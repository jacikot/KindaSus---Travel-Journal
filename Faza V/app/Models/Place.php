<?php

namespace App\Models;

use CodeIgniter\Model;

class Place extends Model
{
    protected $table = 'place';
    protected $primaryKey = 'id_plc';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $allowedFields = ['name', 'categorized', 'category_1', 'category_2',
                                'category_3', 'category_4', 'category_5', 'id_img', 'id_cnt'];

    public function findMatchingPlaceOrCountry($inputVal) {
        return $this->select("place.id_plc as id,
                                    place.name as place,
                                    country.name as country,
                                    country.code as code", false)
            ->join('country', 'place.id_cnt = country.id_cnt')
            ->like('place.name', $inputVal, 'after', true, true)
            ->orLike('country.name', $inputVal, 'after', true, true)
            ->findAll();
    }

    public function getCountry($plcid){
        $visited=$this->find($plcid);
        return $visited->id_cnt;
    }

    public function visitsInCountry($visits,$country){
        $ret=[];
        foreach($visits as $visit){
            $p=$this->find($visit["id_plc"]);
            if($country==null||$p->id_cnt==$country["id"]){
                $r=[];
                $r["id_plc"]=$p->id_plc;
                $r["name"]=$p->name;
                $r["id_vis"]=$visit["id_vis"];
                $ret[]=$r;
            }
        }
        return $ret;
    }

    public function visitsInPlace($visits,$place){
        $ret=[];
        foreach($visits as $visit){
            $p=$this->find($visit["id_plc"]);
            if($p->name==$place){
                $r=[];
                $r["id_plc"]=$p->id_plc;
                $r["name"]=$p->name;
                $r["id_vis"]=$visit["id_vis"];
                $ret[]=$r;
            }
        }
        return $ret;
    }
}