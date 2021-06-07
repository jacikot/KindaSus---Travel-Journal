<?php
namespace App\Controllers;

use App\Models\User;
use App\Models\Admin;
use App\Models\Image;
use App\Models\Country;
use App\Models\Place;
use CodeIgniter\Model;

/*
 * Author: Dimitrije Panic 18/0205
 * controller for registration
 * @version 1.0
 */
class GuestRegister extends BaseController
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
     * used to get the default image path if the user doesnt upload
     * his avatar image
     *
     * @return string defaultImagePath
     */
    public function getDefaultImagePath(){
        return $defaultImagePath = ""."/assets/images/default-avatar-2.jpg";
    }

    /*
     * used to display the register page
     *
     * @return view
     */
    public function showRegister(){
        return view('register.php');
    }

    /*
     * used to show the security questions if the
     * user decides he wants to secure his account
     *
     * @return view
     */
    public function showQuestions(){
        $this->session->set("flag",1);
        return view('que.php');
    }

    /*
     * used to add user questions so he can restore his password
     *
     * @param Request $request Request
     *
     * @return Response
     *
     * @throws BadRequestHttpException
     * @throws UnauthorizedHttpException
     */
    public function addQuestions(){
        $q1 = $this->request->getVar('q0');
        $q2 = $this->request->getVar('q1');
        $q3 = $this->request->getVar('q2');

        if(!isset($q1) || !isset($q1) || !isset($q1)){
            echo "All questions are a must!";
            return;
        }

        $userModel = new User();
        $users = $userModel->findUser($this->session->get('username'));

        if($users == null){
            echo "You need to log in first";
            return;
        }

        foreach($users as $user){
            $user->security_answer_1=$q1;
            $user->security_answer_2=$q2;
            $user->security_answer_3=$q3;
            $userModel->save($user);
            break;
        }

        $this->session->set('status','answered');
        echo "Thank you for answering all questions!";

    }
    /*
     * used to add user account to the database
     * except for avatar image
     * set default image path if the user hasnt chosen an avatar image
     * username needs to be unique
     *
     * @param Request $request Request
     *
     * @return Response
     *
     * @throws BadRequestHttpException
     * @throws UnauthorizedHttpException
     */
    public function register(){
        $name = $this->request->getVar('name');
        $surname = $this->request->getVar('surname');
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('pass');
        $email = $this->request->getVar('email');
        $city = $this->request->getVar('city');
        $country = $this->request->getVar('country');
        $img = $this->request->getFile('file');

        $errorMsg = "";

        if(!isset($name) ){
           $errorMsg .= "Firstname is required. ";
        }

        if(!isset($surname) ){
            $errorMsg .= "Lastname is required. ";
        }

        if(!isset($username) ){
            $errorMsg .= "Username is required. ";
        }

        if(!isset($email) ){
            $errorMsg .= "E-mail is required. ";
        }

        if(!isset($city) ){
            $errorMsg .= "City is required. ";
        }

        if(!isset($country) ){
            $errorMsg .= "Country is required. ";
        }

        if(!isset($password) ){
            $errorMsg .= "Country is required. ";
        }

        if($errorMsg != ""){
            echo $errorMsg;
            return;
        }

        if(strlen($username) < self::$minUserLength || strlen($username)  > self::$maxUserLength ){
            $errorMsg .="Username field invalid size!";
        }

        if(strlen($password) < self::$minPassLength || strlen($username) > self::$maxPassLength ){
            $errorMsg .="Password field invalid size!";
        }

        if($errorMsg != ""){
            echo $errorMsg;
            return;
        }

        $expr1 = "/^\w/";
        $expr2 = "/^\d/";

        if(preg_match($expr1,$username) == 0 || preg_match($expr2,$username) == 1){
            $errorMsg .= "Username needs to start with a letter or _. ";
        }

        $expr1 = "/^\w+$/";
        if(preg_match($expr1,$username) == 0){
            $errorMsg .= "Username needs to have _, A or a. ";
        }

        $expr1 = '/\w+@\w+/';
         if(preg_match($expr1,$email) == 0){
            $errorMsg .= "Inadequate email format. ";
        }

        $expr1 ='/[a-z]/';
        $expr2 ='/[A-Z]/' ;
        $expr3 ='/\d/' ;

        if(preg_match($expr1,$password) == 0 || preg_match($expr2,$password) == 0 || preg_match($expr3,$password) == 0){
            $errorMsg .= "Password needs to containt a single upper case, lower case  and number";
        }

        if($errorMsg != ""){
            echo $errorMsg;
            return;
        }

        // jel treba ponovna provera da l su sifra i potvr sifra iste? ja bih rekao da ne

        // ne znam sta da radim ako je veca slika
        // pa je default vreme slanja duze
        // vidi gde je default vreme zahteva
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
            if($img->getSize() > 150000){
                echo "File is too large!";
                return;
            }


        }

        // da l drzava postoji

        $countryModel = new Country();
        $count = $countryModel->getId($country);
        if($count == null){
            echo "Country doesn't exist..";
            return;
        }
        $id_cnt = $count['id'];

        //sta da se radi ako nema sliku mesto?
        // VIDI ZA OVU SLIKU STA DA SE RADI!
        $placeModel = new Place();
        $id_plc = $placeModel->findPlaceId($city);
        if($id_plc == null){
            $placeModel->save([
                'name'=> $city,
                'categorized' => 0,
                'heritage' => 0,
                'relax'=>0,
                'weather' => 0,
                'populated'=>0,
                'sightseeing'=> 0,
                'id_cnt' => $id_cnt,
                'id_img' => 1
                ]);

            $id_plc = $placeModel->getInsertID();
        }


        $userModel = new User();

        $users = $userModel->findUser($username);

        if($users != null){
            echo "Username is already taken.";
            return;
        }

        $id = $userModel->insertUser($username,$password,$name,$surname,$email,$id_plc);
        $user = $userModel->find($id);

        if(!$defaultImg) {
            $img->store("../../public/assets/db_files/".$id."/avatar_img/", "avatar.". $ext);
            // da li ce ovo raditi da se procita?
            $user->avatar_path = "" . "/assets/db_files/".$id."/avatar_img/"."avatar.". $ext;
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
