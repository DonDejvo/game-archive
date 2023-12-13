<?php

namespace App\Models;

use App\Model;

/**
 * Databázový model pro hvězdičku
 */
class GameStarModel extends Model {

    /**
     * Vytvoří hvězdičku od daného uživatele na dané hře
     * 
     * @param int $userId   ID uživatele
     * @param int gameId    ID hry
     */
    public function create(int $userId, int $gameId) {
        $query = 'INSERT INTO `game_stars` (`user_id`, `game_id`) VALUES (?, ?)';
    
        $stmt = $this->db->prepare($query);
    
        $stmt->execute([$userId, $gameId]);
        
        return (int) $this->db->lastInsertId();
    }

    /**
     * Zjistí existuje-li hvězdička od daného uživatele na dané hře
     * 
     * @param int $userId   ID uživatele
     * @param int gameId    ID hry
     */
    public function exists(int $userId, int $gameId) {    
        $query = 'SELECT * FROM `game_stars` WHERE `user_id` = ? AND `game_id` = ?';
    
        $stmt = $this->db->prepare($query);
    
        $stmt->execute([$userId, $gameId]);
        return $stmt->rowCount() == 1;
    }

    /**
     * Smaže hvezdičku od daného uživatele na dané hře
     * 
     * @param int $userId   ID uživatele
     * @param int $gameId   ID hry
     */
    public function delete(int $userId, int $gameId) {
        $query = 'DELETE FROM `game_stars` WHERE `user_id` = ? AND `game_id` = ?';
    
        $stmt = $this->db->prepare($query);
    
        return $stmt->execute([$userId, $gameId]);
    }

}