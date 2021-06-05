<?php

namespace App\Controllers;

use App\Models\Badge;

class Badges extends BaseController
{
    public function index()
    {
        $badgeModel = new Badge();
        $idUsr = $this->session->get('id_usr');
        $data['badges'] = $badgeModel->getBadgesForUser($idUsr);
        $data['cssFile'] = 'badges';
        return view("pages/badges", $data);
    }
}
