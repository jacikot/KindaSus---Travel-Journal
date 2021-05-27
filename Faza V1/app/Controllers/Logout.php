<?php

namespace App\Controllers;

class Logout extends BaseController
{
    public function logout(){

        $this->session->destroy();
        return redirect()->to(site_url('/'));
    }
}