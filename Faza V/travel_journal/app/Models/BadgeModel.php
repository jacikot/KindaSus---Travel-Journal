<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Database;

class BadgeModel extends Model
{
    protected $table      = 'badge';
    protected $primaryKey = 'id_bdg';
    protected $useAutoIncrement = true;
    protected $returnType     = 'object';
    protected $allowedFields = ['icon_path', 'title', 'description'];


    public function getBadgesForUser($idUsr)
    {
        return $this->select("badge.id_bdg AS id,
                                badge.icon_path AS icon_path, 
                                badge.title AS title, 
                                badge.description AS description, 
                                awarded.id_usr AS user", false)
            ->join('awarded', "badge.id_bdg = awarded.id_bdg AND awarded.id_usr = $idUsr", 'left outer')
            ->orderBy( 'id', "ASC")
            ->findAll();
    }
}