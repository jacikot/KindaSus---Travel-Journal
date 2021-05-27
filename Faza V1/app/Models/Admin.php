<?php namespace App\Models;

use CodeIgniter\Model;

class Admin extends Model
{
    protected $table      = 'admin';
    protected $primaryKey = 'id_adm';
    protected $returnType = 'object';
    protected $allowedFields =['username','password'];

    public function findAdmin($user){
        return $this->where('username',$user)->findAll();
    }


}
