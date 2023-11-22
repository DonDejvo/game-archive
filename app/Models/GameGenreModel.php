<?php

namespace App\Models;

use App\Model;

class GameGenreModel extends Model {
    
    public function getAll() {
        $query = 'SELECT * FROM `game_genres`';

        $stmt = $this->db->prepare($query);

        $stmt->execute([]);
        return $stmt->fetchAll();
    }
}