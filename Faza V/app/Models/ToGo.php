<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Database;

class ToGo extends Model
{
    protected $table      = 'to-go';
    protected $primaryKey = 'id_usr';
    protected $returnType     = 'object';
    protected $allowedFields = ['crossed_off'];

    public function emptyListForUser($idUsr)
    {
        $this->where('id_usr', $idUsr)->delete();
    }
}