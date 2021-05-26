<?php
namespace App\Controllers;

use App\Models\User;
use App\Models\Admin;
use App\Models\Image;

class GuestLogin extends BaseController
{
    private static $minPassLength = 6;
    private static $maxPassLength = 20;
    private static $minUserLength = 6;
    private static $maxUserLength = 20;


    public function index(){
        // kad ti se ovo inicijalno ucitaj dodaj one quotes tj jednu random quote izaberi da se prikaze!
        // dodaj i toggle da se prikaze lepo na stranici
        return view('homepage.php');
    }

    public function showLogin(){
        return view('login.php');
    }

    public function login(){
        // proveri maliciozne karaktere
        //sifrovanje lozinke vidi
       $username = $this->request->getVar('username');
       $password = $this->request->getVar('password');

       if($username === "" || $password === ""){
           echo "All fields are required!";
           return;
       }

       $message = "";
       if(strlen($username) < self::$minUserLength || strlen($username)  > self::$maxUserLength ){
           $message .="Username field invalid size!";
       }

        if(strlen($password) < self::$minPassLength || strlen($username) > self::$maxPassLength ){
            $message .="Password field invalid size!";
        }

        if($message != ""){
            echo $message;
            return;
        }


       //$username = addslashes($username);
       //$password = addslases($password);

       $userModel = new User();
       $users = $userModel->findUser($username);

       $isAdmin = false;
       if($users == null){
           $adminModel = new Admin();
           $users = $adminModel->findAdmin($username);
           if ($users == null){
               echo "You need to create an account first!!";
               return;
           }
           $isAdmin = true;
       }

       $same = false;
       $id = 0;
       foreach($users as $user){
           if($user->password === $password){
               $id = $isAdmin == true ? $user->id_adm:$user->id_usr;
               $same = true;
               break;
           }
       }

       if($same === false){
           echo "The password is incorrect..";
           return;
       }

       $this->session->set("isAdmin",$isAdmin?1:0);
       $this->session->set("username",$username);
       $this->session->set("userId",$id);

       if($isAdmin){
           echo "admin";
           return;
       }
       else{
           echo "user";
           return;
       }

    }
}
