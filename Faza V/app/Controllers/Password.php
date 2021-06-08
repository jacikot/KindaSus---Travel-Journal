<?php

namespace App\Controllers;

use App\Models\RegisteredUser;
use CodeIgniter\Model;

/*
 * Author: Jana Toljaga 18/0023
 *
 * Password Controller - class for changing password and validation of user identity
 * Version 1.0
 *
 *
 * */

class Password extends BaseController
{
    /*
    * used for opening page with questions used to confirm user identity and sets flag into session
    * @return view
     *
    * @throws BadRequestHttpException
    * @throws UnauthorizedHttpException
    *
    * */
    public function listPassQuestions(){
        $this->session->set('status',"not answered");
        echo view('que');
    }

    /*
   * used for opening page with a form for entering new password
   * @return view
   *
   * @throws BadRequestHttpException
   * @throws UnauthorizedHttpException
   *
   * */
    public function index(){

        echo view('ch_pass');
    }

    /*
        * used for setting new password if it passed validation - format has to be correct and it has to bi long enough
        * it uses RegisteredUser model to set password
        * @param Request $request Request - $pass and $passC
        * @session $userId
        *
        * @return Response
        * @throws BadRequestHttpException
        * @throws UnauthorizedHttpException
        *
        *
     * */
    public function setPassword(){
        $password=$this->request->getVar('pass');
        $correct=$this->request->getVar('passC');
        if(!$this->validate(["pass"=>"required|max_length[20]|min_length[6]|matches[passC]|alpha_numeric_space"])||$password!=$correct){
            echo "Validation failed";
            return;
        }
        $user=$this->session->get('userId');
        $model=new RegisteredUser();
        $model->setPassword($user,$password);
        echo "Password has been successfully changed";

    }
    /*
       * used for answer validation to questions used for user identity confirmation
       * it uses RegisteredUser model for validation
       *
       * @param Request $request Request - $username and answers
       * @session $userId and flags
       *
       * @return Response
       * @throws BadRequestHttpException
       * @throws UnauthorizedHttpException
       *
       *
    * */
    public function validateQuestions(){
        $flag=$this->session->get("flag");

        if($this->session->get('status')=="answered"){
            echo "You have already answered! Press the button to continue!";
            return;
        }
        $model=new RegisteredUser();
        $username=$this->request->getVar('username');
        if(!isset($username)||$username==""){
            $user=$this->session->get('userId');

        }
        else{
            $user=$model->getUserId($username);
            if(!isset($user)||$user==null){
                echo "User with that username does not exist!";
                return;
            }

            $this->session->set("userId",$user);
            $this->session->set("forgot",1);
        }


        $q1= $this->request->getVar('q0');
        $q2= $this->request->getVar('q1');
        $q3= $this->request->getVar('q2');
        if($q1==""||$q2==""||$q3==""){
            $this->session->set("forgot",null);
            echo "Your answers are incorrect!";
            return;
        }



        $ok=$model->validateAnswers($user,$q1,$q2,$q3);
        if($ok=="Your answers are correct! Press the button to continue!"){
            $this->session->set('status',"answered");
        }
        else{
            $this->session->set("forgot",null);
        }

        echo $ok;



    }

    /*
       * used for getting userId from session
       *
       * @session $userId
       *
       * @return Response
       * @throws BadRequestHttpException
       * @throws UnauthorizedHttpException
       *
       *
    * */

    function getUser(){
        $user =$this->session->get('userId');
        if($user!=null){
            echo json_encode("$user");
        }
        else echo "";
    }
}
