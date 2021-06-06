<?php
namespace App\Controllers;

use App\Models\User;
use App\Models\Admin;
use App\Models\Image;

/*
 * Author: Dimitrije Panic 18/0205
 *
 */
class GuestLogin extends BaseController
{
    /*
     * @var int $minPassLength minimum password length
     */
    private static $minPassLength = 6;
    /*
     * @var int $maxPassLength maximum password length
     */
    private static $maxPassLength = 20;
    /*
     * @var int $minUserLength minimum username length
     */
    private static $minUserLength = 6;
    /*
     * @var int $maxUserLength maximum username length
     */
    private static $maxUserLength = 20;

    /*
     * used for opening homepage and loading a random Quote
     *
     * @return view
     * @return randomized Quote
     */
    public function index(){
        $rand = rand(0,count(Quiz::$quotes)-1);
        $data['data'] = ['quote'=>Quiz::$quotes[$rand]];
        return view('homepage.php',$data);
    }

    /*
     * used to load login page
     *
     * @return view
     */
    public function showLogin(){
        return view('login.php');
    }

    /*
     * used for authorization of users
     * checks that fields are adequate
     * all fields are required
     * authorization is available for
     * either admin or user with a created account
     *
     * @param Request $request Request
     *
     * @return Response
     *
     * @throws BadRequestHttpException
     * @throws UnauthorizedHttpException
     */
    public function login(){
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
           echo "admin,".$username;
           return;
       }
       else{
           echo "user,".$username;
           return;
       }

    }
}
