<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Database;

class Badge extends Model
{
    protected $table = 'badge';
    protected $primaryKey = 'id_bdg';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $allowedFields = ['title', 'description'];


    public function getBadgesForUser($idUsr)
    {
        // getting all the information about all the badges, and also about
        // which of these badges the user has won

        return $this->select("badge.id_bdg AS id,
                                badge.title AS title, 
                                badge.description AS description, 
                                awarded.id_usr AS user", false)
            ->join('awarded', "badge.id_bdg = awarded.id_bdg AND awarded.id_usr = $idUsr", 'left outer')
            ->orderBy( 'id', "ASC")
            ->findAll();
    }
}