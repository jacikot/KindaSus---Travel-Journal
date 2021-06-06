<?php 

namespace App\Models;

use CodeIgniter\Model;

class ToGo extends Model
{
    protected $table = 'to-go';
    protected $primaryKey = 'id_tgl';
    protected $returnType = 'object';
    protected $allowedFields = ['id_usr', 'id_plc', 'crossed_off'];
	
    /*
 * function getToGo fetches items from the To-Go list (travelling goals made by given user and to given place)
     *function returns a To-Go object array
 * */

    public function getToGo($id_usr){
        return $this->where('id_usr',$id_usr)->find();
    }

    public function getListItem($id_usr, $id_pls){
        return $this->where('id_usr',$id_usr)->where('id_plc', $id_pls)->findAll();
    }
/*
 * function deleteFromToGoList deletes an item from the To-Go list (travelling goal made by given user and to given place)
 * returns void
 * */
    public function deleteFromToGoList( $id_usr, $id_pls){
        return $this->where('id_usr',$id_usr)->where('id_plc', $id_pls)->delete();
    }

    public function emptyListForUser($idUsr)
    {
        $this->where('id_usr', $idUsr)->delete();
    }

    /*
     * return all places which user with given id wants to visit
     * @return array - place id
     * */
    public function getToGoPlaces($user)
    {
        $allToGo=$this->where("id_usr",$user)->findAll();
        $places=[];
        foreach($allToGo as $place){
            if($place->crossed_off==0) $places[]=$place->id_plc;
        }
        return $places;
    }
      
}