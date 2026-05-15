<?php

namespace App\Models;

use CodeIgniter\Model;

class FibAgentModel extends Model
{
    protected $table = 'fib_agents';
    protected $primaryKey = 'agent_id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'citizen_id',
        'agent_name',
        'agent_badge',
        'rank',
        'hire_date',
        'status',
        'division',
        'phone_number',
        'email',
        'is_undercover',
        'system_role',
        'password_hash',
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getAgentWithCitizen($agent_id)
    {
        return $this->select('fa.*, c.first_name, c.last_name, c.ssn, c.phone_number as citizen_phone, c.email as citizen_email')
            ->join('citizens c', 'fa.citizen_id = c.citizen_id')
            ->where('fa.agent_id', $agent_id)
            ->first();
    }

    public function getAllAgents()
    {
        return $this->select('fa.*, c.first_name, c.last_name, c.ssn')
            ->join('citizens c', 'fa.citizen_id = c.citizen_id')
            ->where('fa.status', 'active')
            ->findAll();
    }

    public function checkCredentials($badge, $password)
    {
        $agent = $this->where('agent_badge', $badge)
                     ->where('status', 'active') // Dodaj sprawdzenie statusu
                     ->first();
        
        if ($agent && password_verify($password, $agent['password_hash'])) {
            return $agent;
        }
        
        return null;
    }
}