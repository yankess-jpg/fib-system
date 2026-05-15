<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdminAuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Jeśli nie zalogowany
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/auth/login')->with('error', 'Musisz się zalogować');
        }

        // Jeśli nie admin
        if (session()->get('system_role') !== 'admin') {
            return redirect()->to('/dashboard')->with('error', 'Brak uprawnień administratora');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}