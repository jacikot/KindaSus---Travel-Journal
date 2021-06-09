<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class  RegisteredUserFilter implements FilterInterface
{
    public function before(RequestInterface $request,$arguments=null)
    {
        $session = session();
        if ($session->has('userId') && $session->get('isAdmin') == 0)
            return redirect()->to(site_url('Map'));
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments=null)
    {

    }
}
