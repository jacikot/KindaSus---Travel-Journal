<?php 

namespace App\Models;

use CodeIgniter\Model;


class Visited extends Model
{
    protected $table = 'visited';
    protected $primaryKey = 'id_vis';
    protected $returnType = 'object';
    protected $allowedFields = ['id_usr, id_plc'];

//    public function emptyListForUser($idUsr)
//    {
//        $this->where('id_usr', $idUsr)->delete();
//    }

    public function getVisitedPlaces($user){
        $allVisited=$this->where("id_usr",$user)->findAll();
        $places=[];
        foreach($allVisited as $place){
            $places[]=$place->id_plc;
        }
        return $places;
    }

    public function getVisited($user){
        $allVisited=$this->where("id_usr",$user)->findAll();
        $visited=[];
        foreach($allVisited as $vis){
            $vd=[];
            $vd["id_plc"]=$vis->id_plc;
            $vd["id_vis"]=$vis->id_vis;
            $visited[]=$vd;
        }
        return $visited;
    }

    public function getTravelCount($idUsr)
    {
        // counting how many times a user has completed a travel

        return $this->where('id_usr', $idUsr)->countAllResults();
    }
}