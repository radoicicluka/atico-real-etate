<?php

/**
 * Stefan Dumić 2020/0012
 */

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdminFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        if(!$session->has('tip')){ // provera da li je gost
            return redirect()->to(site_url('Gost'));
        }
        elseif($session->get('tip') == 'Klijent'){ // provera da li je klijent
            return redirect()->to(site_url('Klijent'));
        }
        elseif($session->get('tip') == 'Agent'){ // provera da li je agent, ako jeste redirekcija na agenta...
            return redirect()->to(site_url('Agent'));
        }
    
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}