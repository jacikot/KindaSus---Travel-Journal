<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
	    $this->session->destroy();
		return view('homepage.php');
	}
}
