<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'user_id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'username',
        'email',
        'password_hash',
        'status',
        'user_type',
        'created_by',
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getUserByUsername($username)
    {
        return $this->where('username', $username)
                    ->where('status', 'active')
                    ->first();
    }

    public function verifyPassword($user_id, $password)
    {
        $user = $this->find($user_id);
        if ($user && password_verify($password, $user['password_hash'])) {
            return true;
        }
        return false;
    }
}