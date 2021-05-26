<?php 

namespace App\Models;


use CodeIgniter\Model;

class ToGo extends Model
{

    protected $table = 'to-go';
    protected $primaryKey = 'id_tgl';
    protected $returnType = 'object';
    protected $allowedFields = ['id_usr', 'id_plc', 'crossed_off'];

    public function emptyListForUser($idUsr)
    {
        $this->where('id_usr', $idUsr)->delete();

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

