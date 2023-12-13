<?php

namespace App\Models;

use App\Model;

/**
 * Databázový model pro hru
 */
class GameModel extends Model {
    
    /**
     * Vrátí cekový počet a vybranou stránku her
     * 
     * @param string $search    hledaný řetězec
     * @param int $page         číslo stránky
     * @param int $count        počet na stránku
     * @param int $filter       filtr
     * @param int $genre        žánr
     * @param int $userId       ID uživatele
     */
    public function getByParams(string $search, int $page, int $count, int $filter, int $genre, int $userId) {
        $query = 'SELECT `games`.`id`, `games`.`title`, `games`.`user_id`, `games`.`genre_id`, `games`.`cover_image_url`, `games`.`created_at`, `games`.`updated_at`, `users`.`username`, `game_genres`.`name` as `genre_name`, (SELECT COUNT(*) FROM `game_stars` WHERE `game_id` = `games`.`id`) as `star_count` FROM `games` RIGHT JOIN `users` ON `games`.`user_id` = `users`.`id` INNER JOIN `game_genres` ON `games`.`genre_id` = `game_genres`.`id` WHERE 1';
        $params = [];

        if(strlen($search) > 0) {
            $query .= ' AND `title` REGEXP ?';
            $params[] = '^' . $search;
        }

        if($genre != 0) {
            $query .= ' AND `genre_id` = ?';
            $params[] = $genre;
        }

        switch($filter) {
            case 1:
                $query .= ' ORDER BY `updated_at` DESC';
                break;
            case 2:
                $query .= ' ORDER BY `star_count` DESC';
                break;
            case 3:
                $query .= ' AND `games`.`user_id` = ? ORDER BY `updated_at` DESC';
                $params[] = $userId;
                break;
            case 4:
                $query .= ' AND `games`.`id` IN (SELECT `game_stars`.`game_id` FROM `game_stars` WHERE `game_stars`.`user_id` = ?) ORDER BY `updated_at` DESC';
                $params[] = $userId;
                break;
        }

        $stmtCount = $this->db->prepare($query);
        $stmtCount->execute($params);
        $total = $stmtCount->rowCount();

        $offset = ($page - 1) * $count;
        $query .= " LIMIT {$count} OFFSET {$offset}";

        $stmt = $this->db->prepare($query);

        $stmt->execute($params);
        $data = $stmt->fetchAll();

        return [ 'data' => $data, 'count' => $total ];
    }

    /**
     * Upraví a uloží hru
     * 
     * @param int $id                  ID hry
     * @param string $title            název hry
     * @param string $description      popis hry
     * @param int $genreId             ID žánru
     * @param string $coverImageUrl    URL titulního obrázku
     */
    public function update(int $id, string $title, string $description, int $genreId, string $coverImageUrl) {
        $query = 'UPDATE `games` SET `title` = ?, `description` = ?, `genre_id` = ?, `cover_image_url` = ?, `updated_at` = NOW() WHERE `id` = ?';
        $stmt = $this->db->prepare($query);

        return $stmt->execute([$title, $description, $genreId, $coverImageUrl, $id]);
    }

    /**
     * Vytvoří novou hru
     * 
     * @param int $userId              ID uživatele
     * @param string $title            název hry
     * @param string $description      popis hry
     * @param int $genreId             ID žánru
     * @param string $coverImageUrl    URL titulního obrázku
     */
    public function create(int $userId, string $title, string $description, int $genreId, string $coverImageUrl) {
        $stmt = $this->db->prepare(
            'INSERT INTO `games` (`user_id`, `title`, `description`, `genre_id`, `cover_image_url`, `created_at`, `updated_at`) VALUES (?, ?, ?, ?, ?, NOW(), NOW())'
        );

        $stmt->execute([$userId, $title, $description, $genreId, $coverImageUrl]);

        return (int) $this->db->lastInsertId();
    }

    /**
     * Vrátí hru podle ID
     * 
     * @param int $id   ID hry
     */
    public function getById(int $id) {
        $stmt = $this->db->prepare(
            'SELECT `games`.`id`, `games`.`title`, `games`.`description`, `games`.`user_id`, `games`.`genre_id`, `games`.`cover_image_url`, `games`.`created_at`, `games`.`updated_at`, `users`.`username`, `game_genres`.`name` as `genre_name`, (SELECT COUNT(*) FROM `game_stars` WHERE `game_id` = `games`.`id`) as `star_count` FROM `games` RIGHT JOIN `users` ON `games`.`user_id` = `users`.`id` INNER JOIN `game_genres` ON `games`.`genre_id` = `game_genres`.`id` WHERE `games`.`id` = ?'
        );

        $stmt->execute([$id]);

        if($stmt->rowCount() > 0) {
            return $stmt->fetch();
        }

        return null;
    }

    /**
     * Smaže hru
     * 
     * @param int $id   ID hry
     */
    public function delete(int $id) {
        $query = 'DELETE FROM `games` WHERE `id` = ?';
    
        $stmt = $this->db->prepare($query);
    
        return $stmt->execute([$id]);
    }
}