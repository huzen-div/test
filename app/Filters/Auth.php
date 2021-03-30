<?php 
namespace App\Filters;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class Auth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = Services::session();
        if ($session->has('auth'))
        { 
            if ($request->uri->getPath() == 'login')
            {
                return redirect()->to('/');
            }
        } 
        else
        {
            if ($request->uri->getPath() != 'login' && $request->uri->getPath() != 'login/validlogin')
            {
                // return redirect()->to('/login');
            }
            

        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }

} 