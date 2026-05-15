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

            echo "DEBUG: Badge = " . $badge . "<br>";
            echo "DEBUG: Password = " . $password . "<br>";

            // Sprawdzenie czy agent istnieje
            $agent = $this->fibAgentModel
                ->where('agent_badge', $badge)
                ->first();

            echo "DEBUG: Agent Found = " . ($agent ? 'YES' : 'NO') . "<br>";
            
            if ($agent) {
                echo "DEBUG: Agent Data: " . json_encode($agent) . "<br>";
                echo "DEBUG: Password Hash = " . $agent['password_hash'] . "<br>";
                
                $verify = password_verify($password, $agent['password_hash']);
                echo "DEBUG: Password Verify = " . ($verify ? 'TRUE' : 'FALSE') . "<br>";
            }

            // Jeśli agent nie znaleziony
            if (!$agent) {
                echo "DEBUG: Redirecting - Agent not found<br>";
                return redirect()->back()->withInput()->with('error', 'Agent nie znaleziony: ' . $badge);
            }

            // Sprawdzenie hasła
            if (!password_verify($password, $agent['password_hash'])) {
                echo "DEBUG: Redirecting - Password mismatch<br>";
                return redirect()->back()->withInput()->with('error', 'Błędne hasło');
            }

            // Ustawienie sesji
            echo "DEBUG: Setting session...<br>";
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

            echo "DEBUG: Session set. is_logged_in = " . session()->get('is_logged_in') . "<br>";
            echo "DEBUG: Redirecting to /dashboard<br>";

            // Redirect na dashboard
            return redirect()->to('/dashboard')->with('success', 'Zalogowano pomyślnie');
        }

        return view('auth/login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/')->with('success', 'Wylogowano pomyślnie');
    }
}