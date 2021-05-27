<?php

namespace App\Controllers;

use App\Models\Badge;

class Badges extends BaseController
{
    private function displayPage($fileName, $data)
    {
        $data['cssFile'] = $fileName;
        return view("pages/$fileName", $data);
    }

    public function index()
    {
        $badgeModel = new Badge();
        $badges = $badgeModel->getBadgesForUser(2);
        return $this->displayPage('badges', ['badges' => $badges]);
    }

    public function passport()
    {
        return $this->displayPage('map', ['jsFile' => 'map']);
    }
}
