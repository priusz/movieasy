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
    public function updateItem(string $target, string $id, string $type) : bool
    {
        $userId = auth()->id();

        try {
            $query = "SELECT * FROM users_collection_list WHERE userID = :userID AND imdbID = :imdbID";
            $stmt = $this->pdo->prepare($query);

            $stmt->bindParam(':userID', $userId);
            $stmt->bindParam(':imdbID', $id);

            $stmt->execute();
            $result = $stmt->fetch();

            $onTheList = !empty($result);

            if ($target === 'item-my-list') return $this->switchItemMyList($onTheList, $userId, $id, $type);
            else if ($target === 'item-favorite') return $this->switchItemFavorite($userId, $id);
            else if ($target === 'item-watchlist') return $this->switchItemWatchlist($userId, $id);

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

    private function switchItemMyList(bool $onTheList, string $userId, string $id, string $type) : bool {
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

        return false;
    }

    private function switchItemFavorite(string $userId, string $id) : bool {
        try {
            $query = "UPDATE users_collection_list SET favorite = NOT favorite WHERE userID = :userID AND imdbID = :imdbID";
            $stmt = $this->pdo->prepare($query);

            $stmt->bindParam(':userID', $userId);
            $stmt->bindParam(':imdbID', $id);

            $success = $stmt->execute();

            return $success;

        } catch (PDOException $e) {
            Log::error('Error switch favorite: ' . $e->getMessage(), [
                'exception' => $e,
                'itemID' => $id,
            ]);

            return false;
        }
    }

    private function switchItemWatchlist(string $userId, string $id) : bool {
        try {
            $query = "UPDATE users_collection_list SET watchlist = NOT watchlist WHERE userID = :userID AND imdbID = :imdbID";
            $stmt = $this->pdo->prepare($query);

            $stmt->bindParam(':userID', $userId);
            $stmt->bindParam(':imdbID', $id);

            $success = $stmt->execute();

            return $success;

        } catch (PDOException $e) {
            Log::error('Error switch watchlist: ' . $e->getMessage(), [
                'exception' => $e,
                'itemID' => $id,
            ]);

            return false;
        }
    }
}
