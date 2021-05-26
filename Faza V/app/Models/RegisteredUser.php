<?php namespace App\Models;

use CodeIgniter\Model;

class RegisteredUser extends Model
{
    protected $table      = 'registered_user';
    protected $primaryKey = 'id_usr';
    protected $returnType = 'object';

    protected $allowedFields = ['id_usr', 'username', 'password', 'security_answer_1','security_answer_2','security_answer_3','id_plc','token_count','avatar_path'];

    public function validateAnswers($uid,$q1,$q2,$q3): string
    {

        $forWhere=["id_usr"=>$uid,"security_answer_1"=>$q1,"security_answer_2"=>$q2,"security_answer_3"=>$q3];
        //$u=$this->where($forWhere)->findAll();
        $u=$this->find($uid);
        if($u->security_answer_1==null ||$u->security_answer_2==null ||$u->security_answer_3==null){
            return "Password changing is not available!";
        }
        if($u->security_answer_1!=$q1 ||$u->security_answer_2!=$q2 ||$u->security_answer_3!=$q3){
            return "Your answers are incorrect. Try again!";
        }
        return "Your answers are correct! Press the button to continue!";

    }

    public function getHomePlace($user){
        $u=$this->find($user);
        return $u->id_plc;
    }

    public function setPassword($uid,$newPass){
        $data=['password'=>$newPass];
        $this->update($uid,$data);
    }

    public function getUserInfo($uid){
        $user=$this->find($uid);
        $data["username"]=$user->username;
        $data["tokens"]=$user->token_count;
        $data["avatar"]=$user->avatar_path;
        return $data;
    }

}