<?php

namespace App\Models;

use App\Model;

/**
 * Databázový model pro komentář
 */
class GameCommentModel extends Model {
    
    /**
     * Vrátí cekový počet a vybranou stránku komentářů dané hry
     * 
     * @param int $page     číslo stránky
     * @param int $count    počet na stránku
     * @param int $gameId   ID hry
     */
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

    /**
     * Vytvoří nový kometář na dané hře
     * 
     * @param int $userId   ID uživatele
     * @param int $gameId   ID hry
     * @param string $message  zpráva
     */
    public function create(int $userId, string $gameId, string $message) {
        $stmt = $this->db->prepare(
            'INSERT INTO `game_comments` (`user_id`, `game_id`, `message`, `created_at`, `updated_at`) VALUES (?, ?, ?, NOW(), NOW())'
        );

        $stmt->execute([$userId, $gameId, $message]);

        return (int) $this->db->lastInsertId();
    }

    /**
     * Vrátí kometář podle ID
     * 
     * @param int $id ID komentáře
     */
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

    /**
     * Smaže kometář podle ID
     * 
     * @param int $id ID komentáře
     */
    public function delete(int $id) {
        $query = 'DELETE FROM `game_comments` WHERE `id` = ?';
    
        $stmt = $this->db->prepare($query);
    
        return $stmt->execute([$id]);
    }
}