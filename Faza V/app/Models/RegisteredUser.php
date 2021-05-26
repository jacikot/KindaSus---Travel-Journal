<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Database;

class RegisteredUser extends Model
{
    protected $table      = 'registered_user';
    protected $primaryKey = 'id_usr';
    protected $useAutoIncrement = true;
    protected $returnType     = 'object';
    protected $allowedFields = ['username', 'avatar_path', 'acc_creation_date'];
    protected $dateFormat = 'date';


    public function getAllUsers()
    {
        return $this->select("registered_user.id_usr AS id,
                                registered_user.username AS username, 
                                registered_user.avatar_path AS avatar_path", false)
                    ->orderBy('registered_user.acc_creation_date', "DESC")
                    ->findAll();
    }

    public function deleteUser($idUsr)
    {
        return $this->delete($idUsr);
    }
}