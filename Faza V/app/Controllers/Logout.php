<?php

namespace App\Controllers;
/*
 * Author: Jana Toljaga 18/0023
 *
 * Logout Controller - class for logging out from the system
 * Version 1.0
 *
 *
 * */
class Logout extends BaseController
{
    /*
    * used for logging out from the system, destroys session and redirects to homepage
    *
    * @return Response
    *
    * @throws BadRequestHttpException
    * @throws UnauthorizedHttpException
    *
    * */
    public function index(){

        $this->session->destroy();
        return redirect()->to(site_url('/'));
    }
}