<?php namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
    protected $table      = 'registered_user';
    protected $primaryKey = 'id_usr';
    protected $returnType = 'object';
    protected $allowedFields = ['username', 'password','name','surname','e-mail','security_answer_1',
        'security_answer_2','security_answer_3','token_count','avatar_path','acc_creation_date','id_plc'];

    public function findUser($user){
        return $this->where('username',$user)->findAll();
    }

    public function insertUser($username,$password,$name,$surname,$email,
    $id_plc,$token_count=0){
        $this->save([
            'username' => $username,
            'password' => $password,
            'name' => $name,
            'surname' => $surname,
            'e-mail' => $email,
            'avatar_path' => $email,
            'acc_creation_date' => date('Y-m-d'),
            'id_plc' => $id_plc,
            'token_count' => $token_count
        ]);

        return $this->getInsertID();
    }


}
