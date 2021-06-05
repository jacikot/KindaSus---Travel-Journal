<?php

namespace App\Controllers;

use App\Models\User;
use CodeIgniter\Model;

class ChangePic extends BaseController
{
    public function changePic(){
        $img = $this->request->getFile('file');
        //obrisi ovo posle
        //$this->session->set('userId',6);
        $id = $this->session->get('userId');

        if(!isset($id)){
            echo "You need to log in first";
            return;
        }

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
        if($img->getSize() > 150000){
            echo "File is too large!";
            return;
        }

        $userModel = new User();
        helper('filesystem');
        delete_files('../public/assets/db_files/'.$id.'/avatar_img/', TRUE);
        $user = $userModel->find($id);
        $img->store("../../public/assets/db_files/".$id."/avatar_img/", "avatar.". $ext);
        $user->avatar_path = "" . "/assets/db_files/".$id."/avatar_img/"."avatar.". $ext;
        $userModel->save($user);

        echo "Success,"."/assets/db_files/".$id."/avatar_img/"."avatar.". $ext;

    }

}
