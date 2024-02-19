<?php

/**
 * Stefan Dumić 2020/0012
 */
namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class KlijentFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        if(!$session->has('tip')){
            return redirect()->to(site_url('Gost'));
        }
        elseif($session->get('tip') == 'Admin'){
            return redirect()->to(site_url('Admin'));
        }
        elseif($session->get('tip') == 'Agent'){
            return redirect()->to(site_url('Agent'));
        }
    
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}