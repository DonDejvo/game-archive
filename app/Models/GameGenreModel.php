<?php

namespace App\Models;

use App\Model;

/**
 * Databázový model pro herní žánr
 */
class GameGenreModel extends Model {
    
    /**
     * Vrátí všechny žánry
     */
    public function getAll() {
        $query = 'SELECT * FROM `game_genres`';

        $stmt = $this->db->prepare($query);

        $stmt->execute([]);
        return $stmt->fetchAll();
    }
}