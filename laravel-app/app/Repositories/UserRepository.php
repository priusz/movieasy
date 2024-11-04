<?php

namespace App\Repositories;

use App\DBConnection\Connection;
use Illuminate\Support\Facades\Log;
use PDO;
use PDOException;

class UserRepository
{
    protected PDO $pdo;

    public function __construct()
    {
        $this->pdo = Connection::connect();
    }

    public function create(array $data): bool
    {
        try {
            $query = "INSERT INTO users (name, email, password, created_at, updated_at) VALUES (:name, :email, :password, :created_at, :updated_at)";
            $stmt = $this->pdo->prepare($query);

            $stmt->bindParam(':name', $data['name']);
            $stmt->bindParam(':email', $data['email']);
            $stmt->bindParam(':password', $data['password']);
            $stmt->bindParam(':created_at', $data['created_at']);
            $stmt->bindParam(':updated_at', $data['updated_at']);

            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            Log::error('User creation failed: ' . $e->getMessage(), [
                'exception' => $e,
                'data' => $data
            ]);
            return false;
        }
    }
}
