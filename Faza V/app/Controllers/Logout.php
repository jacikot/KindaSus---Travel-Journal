<?php

namespace App\Controllers;

class Logout extends BaseController
{
    public function index(){

        $this->session->destroy();
        return redirect()->to(site_url('/'));
    }
}