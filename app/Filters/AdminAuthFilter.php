<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdminAuthFilter implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not change the request or response.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return RequestInterface|ResponseInterface|string|void
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        // Sprawdzenie czy użytkownik jest zalogowany
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/auth/login')->with('error', 'Musisz się zalogować');
        }

        // Sprawdzenie czy użytkownik jest adminem
        if (session()->get('system_role') !== 'admin') {
            return redirect()->to('/dashboard')->with('error', 'Brak dostępu - wymagane uprawnienia administratora');
        }
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. If you need to stop execution of
     * other filters, throw an exception out from here.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return void
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}