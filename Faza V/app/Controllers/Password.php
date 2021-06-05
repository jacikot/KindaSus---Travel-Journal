<?php

namespace App\Controllers;

use App\Models\RegisteredUser;
use CodeIgniter\Model;

class Password extends BaseController
{
    public function listPassQuestions(){
        $this->session->set('status',"not answered");
//        $data["cssFile"]="que";
//        $data["jsFile"]="que";
//        echo view('templates/header_user',$data);
        echo view('que');
    }

    public function chPassword(){

        echo view('ch_pass');
    }
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
    public function validateQuestions(){
        $flag=$this->session->get("flag");

        if($this->session->get('status')=="answered"){
            echo "You have already answered! Press the button to continue!";
            return;
        }
        $model=new RegisteredUser();
        $username=$this->request->getVar('username');
        if($username==""){
            $user=$this->session->get('userId');
        }
        else{
            $user=$model->getUserId($username);
            if($user==null){
                echo "User with that username does not exist!";
                return;
            }
            $this->session->set("usr_id",$user);
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

    function getUser(){
        $user =$this->session->get('userId');
        if($user!=null){
            echo json_encode("$user");
        }
        else echo "";
    }
}
