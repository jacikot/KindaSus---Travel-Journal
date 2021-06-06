<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Database;

class Awarded extends Model
{
    protected $table = 'awarded';
    protected $primaryKey = 'id_awd';
    protected $returnType = 'object';
    protected $allowedFields = ['id_usr, id_bdg'];

    public function giveBadgeIfNotGiven($idUsr, $idBdg) {

        // a badge is awarded to a user only once - if he already won this badge,
        // nothing will happen

        $idAwd = $this->where(['id_usr' => $idUsr, 'id_bdg' => $idBdg])->first();
        if ($idAwd == null) {
            $this->db->table('awarded')->insert(['id_usr' => $idUsr, 'id_bdg' => $idBdg]);
        }
    }

    /*public function emptyCollectionForUser($idUsr)
    {
        $this->where('id_usr', $idUsr)->delete();
    }*/
}