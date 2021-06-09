<?php 

namespace App\Models;

use CodeIgniter\Model;

class RegisteredUser extends Model
{
    protected $table = 'registered_user';
    protected $primaryKey = 'id_usr';
    protected $returnType = 'object';
    protected $allowedFields = ['username', 'password', 'name', 'surname', 'e-mail', 'security_answer_1',
                                'security_answer_2', 'security_answer_3', 'token_count', 'avatar_path', 'acc_creation_date', 'id_plc'];
    protected $dateFormat = 'date';

    public function getAllUsers()
    {
        // retrieving information about all the users in the database

        return $this->select("registered_user.id_usr AS idUsr,
                                registered_user.username AS username, 
                                registered_user.avatar_path AS avatarPath", false)
                    ->orderBy('registered_user.acc_creation_date', "DESC")
                    ->findAll();
    }

    public function deleteUser($idUsr)
    {
        // deleting a user, along with all of his information from the database
        // this is guaranteed from the database design itself

        // deleting the folder assigned to the user with its content

        $path = '../public/assets/db_files/'.$idUsr;
        helper('filesystem');

        if (is_dir($path)) {
            delete_files($path, true);
            rmdir($path);
        }
        $this->delete($idUsr);
    }

    public function getTokenCount($idUsr)
    {
        // returns token count for the user - used with badges
        return $this->find($idUsr)->token_count;
    }

    public function getAccCreationDate($idUsr)
    {
        // returns account creation date for the user - used with badges
        return strval($this->find($idUsr)->acc_creation_date);
    }

    public function updateOwnerTokens($idOwr, $vote)
    {
        // updating tokens of the owner of a review that was given a token / a review a token was taken away from

        if ($vote == 'up') {
            $this->where("id_usr", $idOwr)->set('token_count', 'token_count + 1', false)->update();
        }
        if ($vote == 'down') {
            $this->where("id_usr", $idOwr)->set('token_count', 'token_count - 1', false)->update();
        }
    }

    /*
     * checks if answers user gave for identity validation match answers in database
     *
     * @return Response
     *
     * */
    public function validateAnswers($uid,$q1,$q2,$q3): string
    {

        $forWhere = ["id_usr" => $uid, "security_answer_1" => $q1, "security_answer_2" => $q2, "security_answer_3" => $q3];
        //$u=$this->where($forWhere)->findAll();
        $u = $this->find($uid);
        if ($u->security_answer_1 == null || $u->security_answer_2 == null || $u->security_answer_3 == null) {
            return "Password changing is not available!";
        }
        if ($u->security_answer_1 != $q1 || $u->security_answer_2 != $q2 || $u->security_answer_3 != $q3) {
            return "Your answers are incorrect. Try again!";
        }
        return "Your answers are correct! Press the button to continue!";

    }

    /*returns place id for place where user with given id is from
     *
     * @return  int id_plc
     * */
    public function getHomePlace($user){
        $u=$this->find($user);
        return $u->id_plc;
    }

    /*
     * sets new password for user with given id
     *
     * */
    public function setPassword($uid,$newPass){
        $data=['password'=>$newPass];
        $this->update($uid,$data);
    }

    /*
     * return info for user with given id needed for dropdown menu
     *
     * @return array - username, tokens, avatar
     *
     * */
    public function getUserInfo($uid){
        $user=$this->find($uid);
        $data["username"]=$user->username;
        $data["tokens"]=$user->token_count;
        $data["avatar"]=$user->avatar_path;
        if($data["avatar"]==null){
            $data["avatar"]="/assets/images/avatar.png";
        }
        return $data;
    }
    /* returns user id for given username
     *
     * @return int user_id
     *
    */
    public function getUserId($username){
        $uid=$this->where("username",$username)->findAll();
        if($uid==null) return null;
        return $uid[0]->id_usr;
    }
    

    public function updateTokens($uid,$tokens){
        $this->where("id_usr", $uid)->set('token_count', "token_count - $tokens", false)->update();
    }
}