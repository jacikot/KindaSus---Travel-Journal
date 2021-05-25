<?php

namespace App\Controllers;

use App\Models\BadgeModel;

class User extends BaseController
{
    private function displayPage($fileName, $data)
    {
        $data['controller'] = 'User';
        $data['fileName'] = $fileName;
        return view("pages/$fileName", $data);
    }

    public function badges()
    {
        $badgeModel = new BadgeModel();
        $badges = $badgeModel->getBadgesForUser(1);
        return $this->displayPage('badges', ['badges' => $badges]);
    }

    public function passport()
    {
        return view();
    }

    public function review()
    {

    }

    public function refresh()
    {

    }
}
