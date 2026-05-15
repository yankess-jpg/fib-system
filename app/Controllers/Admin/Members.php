<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\FibAgentModel;
use App\Models\CitizenModel;

class Members extends BaseController
{
    protected $fibAgentModel;
    protected $citizenModel;

    public function __construct()
    {
        $this->fibAgentModel = new FibAgentModel();
        $this->citizenModel = new CitizenModel();

        // Sprawdzenie uprawnień
        if (!session()->get('is_logged_in') || session()->get('system_role') !== 'admin') {
            throw new \RuntimeException('Brak uprawnień dostępu');
        }
    }

    public function index()
    {
        $data = [
            'title' => 'Zarządzanie Członkami',
            'agents' => $this->fibAgentModel->getAllAgents(),
        ];

        return view('dashboard/admin/members', $data);
    }

    public function view($agent_id)
    {
        $data = [
            'title' => 'Szczegóły Agenta',
            'agent' => $this->fibAgentModel->getAgentWithCitizen($agent_id),
        ];

        return view('dashboard/admin/member_detail', $data);
    }

    public function create()
    {
        if ($this->request->getMethod() === 'post') {
            $citizenData = [
                'first_name' => $this->request->getPost('first_name'),
                'last_name' => $this->request->getPost('last_name'),
                'date_of_birth' => $this->request->getPost('date_of_birth'),
                'ssn' => $this->request->getPost('ssn'),
                'gender' => $this->request->getPost('gender'),
                'phone_number' => $this->request->getPost('phone_number'),
                'email' => $this->request->getPost('email'),
                'address' => $this->request->getPost('address'),
            ];

            $citizen_id = $this->citizenModel->insert($citizenData);

            $agentData = [
                'citizen_id' => $citizen_id,
                'agent_name' => $this->request->getPost('first_name') . ' ' . $this->request->getPost('last_name'),
                'agent_badge' => $this->request->getPost('agent_badge'),
                'rank' => $this->request->getPost('rank'),
                'division' => $this->request->getPost('division'),
                'email' => $this->request->getPost('email'),
                'phone_number' => $this->request->getPost('phone_number'),
                'system_role' => $this->request->getPost('system_role'),
                'password_hash' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
                'status' => 'active',
            ];

            $this->fibAgentModel->insert($agentData);

            return redirect()->to('/admin/members')->with('success', 'Agent dodany pomyślnie');
        }

        return view('dashboard/admin/member_form');
    }
}