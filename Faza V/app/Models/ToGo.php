<?php namespace App\Models;

use CodeIgniter\Model;

class ToGo extends Model
{
    protected $table      = 'to-go';
    protected $primaryKey = 'id_tgl';
    protected $returnType = 'object';
    protected $allowedFields = ['id_usr', 'id_plc','crossed_off'];

    public function getToGo($id_usr){
        return $this->where('id_usr',$id_usr)->find();
    }

    public function getListItem($id_usr, $id_pls){
        return $this->where('id_usr',$id_usr)->where('id_plc', $id_pls)->findAll();
    }

    public function deleteFromToGoList( $id_usr, $id_pls){
        return $this->where('id_usr',$id_usr)->where('id_plc', $id_pls)->delete();
    }

    public function emptyListForUser($idUsr)
    {
        $this->where('id_usr', $idUsr)->delete();
    }

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