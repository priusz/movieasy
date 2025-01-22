<?php

namespace App\Repositories;

use App\DBConnection\Connection;
use Illuminate\Support\Facades\Log;
use PDO;
use PDOException;

class CollectionRepository
{

    protected PDO $pdo;

    public function __construct()
    {
        $this->pdo = Connection::connect();
    }
    public function updateMyList(string $id, string $type) : bool
    {
        $userId = auth()->id();

        try {
            $query = "SELECT COUNT(*) as count FROM users_collection_list WHERE userID = :userID AND imdbID = :imdbID";
            $stmt = $this->pdo->prepare($query);

            $stmt->bindParam(':userID', $userId);
            $stmt->bindParam(':imdbID', $id);

            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            $onTheList = $result['count'] > 0;

            if ($onTheList) {
                $deleteQuery = "DELETE FROM users_collection_list WHERE userID = :userID AND imdbID = :imdbID";
                $deleteStmt = $this->pdo->prepare($deleteQuery);

                $deleteStmt->bindParam(':userID', $userId);
                $deleteStmt->bindParam(':imdbID', $id);

                if ($deleteStmt->execute()) return true;

            } else {
                $insertQuery = "INSERT INTO users_collection_list (userID, imdbID, type) VALUES (:userID, :imdbID, :type)";
                $insertStmt = $this->pdo->prepare($insertQuery);

                $insertStmt->bindParam(':userID', $userId);
                $insertStmt->bindParam(':imdbID', $id);
                $insertStmt->bindParam(':type', $type);
                if ($insertStmt->execute()) return true;
            }

        } catch (PDOException $e) {
            Log::error('Error toggling list status: ' . $e->getMessage(), [
                'exception' => $e,
                'itemID' => $id,
                'type' => $type
            ]);

            return false;
        }

        return false;
    }


    public function addPersonalData(array $item) : array {

        $id = $item['imdbID'];
        $userId = auth()->id();

        try {
            $query = "SELECT * FROM users_collection_list WHERE userID = :userID AND imdbID = :imdbID";
            $stmt = $this->pdo->prepare($query);

            $stmt->bindParam(':userID', $userId);
            $stmt->bindParam(':imdbID', $id);

            $stmt->execute();
            $result = $stmt->fetch();

            $onTheList = !empty($result);

            $item['onTheList'] = $onTheList;

            if ($onTheList) {
                $item['favorite'] = (bool)$result['favorite'];
                $item['watchlist'] = (bool)$result['watchlist'];
            } else {
                $item['favorite'] = false;
                $item['watchlist'] = false;
            }

            return $item;

        } catch (PDOException $e) {
            Log::error('Error checking list status: ' . $e->getMessage(), [
                'exception' => $e,
                'itemID' => $id,
            ]);

            $item['onTheList'] = false;
            $item['favorite'] = false;
            $item['watchlist'] = false;

            return $item;
        }
    }
}
