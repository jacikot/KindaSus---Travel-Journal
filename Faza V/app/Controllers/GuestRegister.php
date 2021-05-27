<?php
namespace App\Controllers;

use App\Models\User;
use App\Models\Admin;
use App\Models\Image;
use CodeIgniter\Model;

class GuestRegister extends BaseController
{
    private static $minPassLength = 6;
    private static $maxPassLength = 20;
    private static $minUserLength = 6;
    private static $maxUserLength = 20;


    public function getDefaultImagePath(){
        return $defaultImagePath = "".base_url("/assets/db_files/avatar_img/1.png");
    }

    public function showRegister(){
        return view('register.php');
    }
    public function showQuestions(){
        return view('que.php');
    }

    public function addQuestions(){
        $q1 = $this->request->getVar('q1');
        $q2 = $this->request->getVar('q2');
        $q3 = $this->request->getVar('q3');

        if(!isset($q1) || !isset($q1) || !isset($q1)){
            echo "All questions are a must!";
            return;
        }

        $userModel = new User();
        $users = $userModel->findUser($this->session->get('username'));

        if($users == null){
            echo "need to be logged in..";
            return;
        }

        foreach($users as $user){
            $user->security_answer_1=$q1;
            $user->security_answer_2=$q2;
            $user->security_answer_3=$q3;
            break;
        }

        echo "all good!";
        return;

    }

    public function register(){
        $name = $this->request->getVar('name');
        $surname = $this->request->getVar('surname');
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('pass');
        $email = $this->request->getVar('email');
        $city = $this->request->getVar('city');
        $country = $this->request->getVar('country');
        $img = $this->request->getFile('file');

        if(!isset($name) || !isset($surname) || !isset($username) || !isset($email)
            || !isset($city) || !isset($country)){
            echo "Required fields not set!";
            return;
        }


        //dodaj sve provere ponovo mrzi me sad ovde

        $defaultImg = false;
        $ext = "";
        if(!isset($img)){
            $defaultImg = true;
            $img = $this->getDefaultImagePath();
        } else{
            if(!is_uploaded_file($img)){
                echo "Not a good file..";
                return;
            }
            $ext = strtolower(pathinfo($img->getName(), PATHINFO_EXTENSION));
            $supported_image = array(
                'gif',
                'jpg',
                'jpeg',
                'png'
            );
            if (!in_array($ext, $supported_image)){
                echo $ext." Inadequate type!";
                return;
            }
            //vidi za ovu vr
            if($img->getSize() > 100000){
                echo "File is too large!";
                return;
            }


        }

        // dohvati iz baze place, ako ne postoji napravi novo
        // moras da proveris i za drzavu da l je ok
        // moras i da ubacis ako ne postoji
        // nije puno posla, ali moras da odradis
        // samo prvo razmisli !
        $id_plc = 1;


        $userModel = new User();

        // mora provera da l postoji prvo druze!
        $users = $userModel->findUser($username);

        if($users != null){
            echo "Already exists!";
            return;
        }

        $id = $userModel->insertUser($username,$password,$name,$surname,$email,$id_plc);
        $user = $userModel->find($id);

        if(!$defaultImg) {
            // dodaj folder da bude id korisnika
            // promeni db_files
            $img->store("../../public/assets/db_files/avatar_img", $id .".". $ext);
            // da li ce ovo raditi da se procita?
            $user->avatar_path = "" . base_url("/assets/db_files/avatar_img/" . $id .".". $ext);
        } else{
            $user->avatar_path = $img;
        }

        $userModel->save($user);


        $this->session->set("isAdmin",0);
        $this->session->set("username",$username);
        $this->session->set("userId",$id);

        echo "Success! ".$username;

    }


}
