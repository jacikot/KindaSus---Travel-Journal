<?php

namespace App\Controllers;

class GuestController extends BaseController
{
    public function index()
    {
        echo view('homepage.php');
    }
}
