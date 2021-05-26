<<<<<<< HEAD
<<<<<<< HEAD
<?php 

namespace App\Models;
=======
<?php namespace App\Models;
>>>>>>> Dimitrije
=======
<?php 

namespace App\Models;

>>>>>>> Dimitrije

use CodeIgniter\Model;

class ToGo extends Model
{
<<<<<<< HEAD
<<<<<<< HEAD
=======

>>>>>>> Dimitrije
    protected $table = 'to-go';
    protected $primaryKey = 'id_tgl';
    protected $returnType = 'object';
    protected $allowedFields = ['id_usr', 'id_plc', 'crossed_off'];

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
<<<<<<< HEAD
=======
    protected $table      = 'to-go';
    protected $primaryKey = 'id_usr';
    protected $returnType = 'object';
    protected $allowedFields = ['id_plc', 'crossed_off'];




}
>>>>>>> Dimitrije
=======

>>>>>>> Dimitrije
