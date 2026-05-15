<?php

namespace App\Controllers;

use App\Models\InvestigationModel;
use App\Models\FibAgentModel;

class Dashboard extends BaseController
{
    protected $investigationModel;
    protected $fibAgentModel;

    public function __construct()
    {
        $this->investigationModel = new InvestigationModel();
        $this->fibAgentModel = new FibAgentModel();
    }

    public function index()
    {
        // Debug - sprawdzenie sesji
        log_message('info', 'Dashboard - is_logged_in: ' . session()->get('is_logged_in'));

        $agent_id = session()->get('agent_id');
        $system_role = session()->get('system_role');

        if (!$agent_id) {
            return redirect()->to('/auth/login')->with('error', 'Sesja wygasła');
        }

        $data = [
            'title' => 'Dashboard',
            'agent_id' => $agent_id,
            'agent_name' => session()->get('agent_name'),
            'system_role' => $system_role,
            'recent_investigations' => $this->investigationModel->getRecentInvestigations(5),
            'agent_investigations' => $this->investigationModel->getInvestigationsByAgent($agent_id),
        ];

        if ($system_role === 'admin') {
            $data['all_agents'] = $this->fibAgentModel->getAllAgents();
            return view('dashboard/admin/dashboard', $data);
        }

        return view('dashboard/dashboard', $data);
    }
}