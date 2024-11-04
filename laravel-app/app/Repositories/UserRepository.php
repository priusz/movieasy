<?php

namespace App\Repositories;

use App\DBConnection\Connection;
use Illuminate\Support\Facades\Log;

class UserRepository
{
    protected \PDO $db;

    public function __construct()
    {
        $this->db = Connection::connect();
    }

    public function create(array $data): bool
    {
        try {
            $query = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
            $stmt = $this->db->prepare($query);

            $stmt->bindParam(':name', $data['name']);
            $stmt->bindParam(':email', $data['email']);
            $stmt->bindParam(':password', $data['password']);

            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (\PDOException $e) {
            Log::error('User creation failed: ' . $e->getMessage(), [
                'exception' => $e,
                'data' => $data
            ]);
            return false;
        }
    }
}
