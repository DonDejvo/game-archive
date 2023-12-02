<?php

namespace App\Models;

use App\Model;

class GameCommentModel extends Model {
    
    public function getByParams(int $page, int $count, int $gameId) {
        $query = "SELECT `game_comments`.`id`, `game_comments`.`user_id`, `game_comments`.`game_id`, `game_comments`.`message`, `game_comments`.`created_at`, `game_comments`.`updated_at`, `users`.`username` FROM `game_comments` RIGHT JOIN `users` ON `game_comments`.`user_id` = `users`.`id` WHERE `game_comments`.`game_id` = ? ORDER BY `created_at` DESC";

        $stmtCount = $this->db->prepare($query);
        $stmtCount->execute([$gameId]);
        $total = $stmtCount->rowCount();

        $offset = ($page - 1) * $count;
        $query .= " LIMIT {$count} OFFSET {$offset}";

        $stmt = $this->db->prepare($query);

        $stmt->execute([$gameId]);
        $data = $stmt->fetchAll();

        return [ 'data' => $data, 'count' => $total ];
    }

    public function create(int $userId, string $gameId, string $message) {
        $stmt = $this->db->prepare(
            'INSERT INTO `game_comments` (`user_id`, `game_id`, `message`, `created_at`, `updated_at`) VALUES (?, ?, ?, NOW(), NOW())'
        );

        $stmt->execute([$userId, $gameId, $message]);

        return (int) $this->db->lastInsertId();
    }

    public function getById(int $id) {
        $stmt = $this->db->prepare(
            'SELECT `game_comments`.`id`, `game_comments`.`game_id`, `game_comments`.`message`, `game_comments`.`user_id`, `game_comments`.`created_at`, `game_comments`.`updated_at`, `users`.`username` FROM `game_comments` RIGHT JOIN `users` ON `game_comments`.`user_id` = `users`.`id` WHERE `game_comments`.`id` = ?'
        );

        $stmt->execute([$id]);

        if($stmt->rowCount() > 0) {
            return $stmt->fetch();
        }

        return null;
    }

    public function delete(int $id) {
        $query = 'DELETE FROM `game_comments` WHERE `id` = ?';
    
        $stmt = $this->db->prepare($query);
    
        return $stmt->execute([$id]);
    }
}