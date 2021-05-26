<?php 

namespace App\Models;

use CodeIgniter\Model;

class RegisteredUser extends Model
{
    protected $table = 'registered_user';
    protected $primaryKey = 'id_usr';
    protected $returnType = 'object';
    protected $allowedFields = ['id_usr', 'username', 'password', 'name', 'surname', 'e-mail', 'security_answer_1', 
                                'security_answer_2', 'security_answer_3', 'token_count', 'avatar_path', 'acc_creation_date', 'id_plc'];
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

    public function getUserId($username){
        $uid=$this->where("username",$username)->findAll();
        if($uid==null) return null;
        return $uid[0]->id_usr;
    }

}