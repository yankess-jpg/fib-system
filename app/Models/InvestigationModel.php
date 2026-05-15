<?php

namespace App\Models;

use CodeIgniter\Model;

class InvestigationModel extends Model
{
    protected $table = 'investigations';
    protected $primaryKey = 'investigation_id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'case_number',
        'title',
        'description',
        'lead_agent_id',
        'status',
        'priority',
        'case_type',
        'start_date',
        'close_date',
        'location',
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getInvestigationWithLeadAgent($investigation_id)
    {
        return $this->select('i.*, fa.agent_name, fa.agent_badge, fa.division')
            ->join('fib_agents fa', 'i.lead_agent_id = fa.agent_id')
            ->where('i.investigation_id', $investigation_id)
            ->first();
    }

    public function getInvestigationsByAgent($agent_id)
    {
        return $this->select('i.*, fa.agent_name as lead_agent_name')
            ->join('fib_agents fa', 'i.lead_agent_id = fa.agent_id')
            ->where('i.lead_agent_id', $agent_id)
            ->orWhereIn('i.investigation_id', function($builder) use ($agent_id) {
                return $builder->select('investigation_id')
                    ->from('investigation_teams')
                    ->where('agent_id', $agent_id);
            })
            ->findAll();
    }

    public function getRecentInvestigations($limit = 5)
    {
        return $this->select('i.*, fa.agent_name as lead_agent_name')
            ->join('fib_agents fa', 'i.lead_agent_id = fa.agent_id')
            ->orderBy('i.created_at', 'DESC')
            ->limit($limit)
            ->findAll();
    }
}