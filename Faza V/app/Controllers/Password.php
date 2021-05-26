<?php

namespace App\Controllers;

use App\Models\RegisteredUser;
use CodeIgniter\Model;

class Password extends BaseController
{
    public function listPassQuestions(){
        $this->session->set('status',"not answered");
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
        $user=$this->session->get('usr_id');
        $model=new RegisteredUser();
        $model->setPassword($user,$password);
        echo "Password successfully changed";

    }
    public function validateQuestions(){
        if($this->session->get('status')=="answered"){
            echo "Your already answered! Press the button to continue!";
            return;
        }


        $q1= $this->request->getVar('q0');
        $q2= $this->request->getVar('q1');
        $q3= $this->request->getVar('q2');
        if($q1==""||$q2==""||$q3==""){
            echo "Your answers are incorrect";
            return;
        }
        $user=$this->session->get('usr_id');

        $model=new RegisteredUser();
        $ok=$model->validateAnswers($user,$q1,$q2,$q3);
        if($ok=="Your answers are correct! Press the button to continue!"){
            $this->session->set('status',"answered");
        }

        echo $ok;



    }
}
