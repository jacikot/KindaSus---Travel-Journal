<?php namespace App\Models;


namespace App\Models;


use CodeIgniter\Model;

class Place extends Model
{
    protected $table = 'place';
    protected $primaryKey = 'id_plc';
    protected $returnType = 'object';
    protected $useAutoIncrement = true;
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

    public function getPlaceAndCountryNames($idPlc)
    {
        return $this->select("place.name as place, country.name as country", false)
                    ->where('place.id_plc', $idPlc)
                    ->join('country', 'place.id_cnt = country.id_cnt')
                    ->find();
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