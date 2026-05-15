<?php

namespace App\Controllers;

use App\Models\FibAgentModel;

class Auth extends BaseController
{
    protected $fibAgentModel;

    public function __construct()
    {
        $this->fibAgentModel = new FibAgentModel();
    }

    public function login()
    {
        // Jeśli już zalogowany
        if (session()->get('is_logged_in')) {
            return redirect()->to('/dashboard');
        }

        if ($this->request->getMethod() === 'post') {
            $badge = $this->request->getPost('badge');
            $password = $this->request->getPost('password');

            // Sprawdzenie czy agent istnieje i hasło się zgadza
            $agent = $this->fibAgentModel->checkCredentials($badge, $password);

            // Jeśli agent nie znaleziony lub hasło błędne
            if (!$agent) {
                return redirect()->back()->withInput()->with('error', 'Nieprawidłowy numer identyfikacyjny lub hasło');
            }

            // Ustawienie sesji
            session()->set([
                'agent_id' => $agent['agent_id'],
                'citizen_id' => $agent['citizen_id'],
                'agent_name' => $agent['agent_name'],
                'agent_badge' => $agent['agent_badge'],
                'system_role' => $agent['system_role'],
                'division' => $agent['division'],
                'rank' => $agent['rank'],
                'is_logged_in' => true,
            ]);

            log_message('info', 'Agent logged in: ' . $agent['agent_badge']);

            // Redirect na dashboard
            return redirect()->to('/dashboard')->with('success', 'Zalogowano pomyślnie');
        }

        return view('auth/login');
    }

    public function logout()
    {
        $agent_badge = session()->get('agent_badge');
        session()->destroy();
        
        if ($agent_badge) {
            log_message('info', 'Agent logged out: ' . $agent_badge);
        }
        
        return redirect()->to('/')->with('success', 'Wylogowano pomyślnie');
    }
}