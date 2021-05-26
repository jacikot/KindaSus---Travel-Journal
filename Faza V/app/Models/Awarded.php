<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Database;

class Awarded extends Model
{
    protected $table      = 'awarded';
    protected $primaryKey = 'id_usr';
    protected $returnType     = 'object';
    protected $allowedFields = ['id_bdg'];

    public function emptyCollectionForUser($idUsr)
    {
        $this->where('id_usr', $idUsr)->delete();
    }
}