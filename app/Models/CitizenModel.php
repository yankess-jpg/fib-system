<?php

namespace App\Models;

use CodeIgniter\Model;

class CitizenModel extends Model
{
    protected $table = 'citizens';
    protected $primaryKey = 'citizen_id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'first_name',
        'last_name',
        'date_of_birth',
        'ssn',
        'gender',
        'phone_number',
        'email',
        'address',
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}