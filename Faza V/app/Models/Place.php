<?php namespace App\Models;

use CodeIgniter\Model;

class Place extends Model
{
    protected $table      = 'place';
    protected $primaryKey = 'id_plc';
    protected $returnType = 'object';
    protected $allowedFields = ['name', 'categorized', 'heritage', 'relax',
        'sightseeing', 'weather', 'populated', 'id_cnt', 'taken_survey'];

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

    /*
    * returns country id for given place
    * @return int cnt_id
    */
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

    public function getPlaceId($idCnt, $placeName)
    {
        $res = $this->where(['id_cnt' => $idCnt, 'name' => $placeName])->first();
        if ($res == null) return null;
        return $res->id_plc;
    }

    public function getTrendingPlaces()
    {
        $query = $this->db->query("SELECT p1.id_plc AS idPlc, p1.name AS placeName, country.name AS countryName, country.code AS countryCode
                            FROM place AS p1 JOIN country ON p1.id_cnt = country.id_cnt
                            INNER JOIN (SELECT id_plc
                                        FROM place
                                        ORDER BY (SELECT SUM(review.token_count)
                                                  FROM review
                                                  JOIN visited on review.id_vis = visited.id_vis
                                                  WHERE visited.id_plc = place.id_plc
                                                  AND review.date_posted BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE()
                                                  GROUP BY place.id_plc) DESC
                                        LIMIT 6)
                            AS p2 ON p1.id_plc = p2.id_plc");

        return $query->getResultArray();
    }


/*
 * function getPlaceById fetches place (if exists) with given id
 * function returns a Place object
 * */
    public function getPlaceById($id){
        return $this->where('id_plc', $id)->findAll();
    }
    /*
     * function getPlaceByName fetches place (if exists) with given name
     * function returns a Place object
     * */
    public function getPlaceByName($name){
        return $this->where('name',$name)->find();
    }
    /*
 * function getPlaceByNameAndCountry fetches places (if exists) with given name and country id
 * function returns a Place object
 * */
    public function getPlaceByNameAndCountry($name, $country){

           return $this->where('name',$name)->where('id_cnt', $country)->findAll();

    }



}