<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Database;

class Visited extends Model
{
    protected $table      = 'visited';
    protected $primaryKey = 'id_vis';
    protected $returnType     = 'object';
    protected $allowedFields = ['id_usr, id_plc'];

    public function emptyListForUser($idUsr)
    {
        $this->where('id_usr', $idUsr)->delete();
    }
}