<?php

namespace App\Models;

use App\Model;

class UserModel extends Model {

    private function hashPassword(string $value): string {
        return password_hash($value, PASSWORD_BCRYPT, [ 'cost' => 12 ]);
    } 
    
    public function create(string $username, string $password) {

        $stmt = $this->db->prepare(
            'INSERT INTO `users` (`username`, `password`, `created_at`, `updated_at`) VALUES (?, ?, NOW(), NOW())'
        );

        $stmt->execute([$username, $this->hashPassword($password)]);

        return (int) $this->db->lastInsertId();
    }

    public function update(string $id, string $username, string $bio) {
        $query = 'UPDATE `users` SET `username` = ?, `bio` = ?, `updated_at` = NOW() WHERE `id` = ?';
        $stmt = $this->db->prepare($query);

        return $stmt->execute([$username, $bio, $id]);
    }

    public function updatePassword(string $id, string $password) {
        $query = 'UPDATE `users` SET `password` = ?, `updated_at` = NOW() WHERE `id` = ?';
        $stmt = $this->db->prepare($query);

        return $stmt->execute([$this->hashPassword($password), $id]);
    }

    public function getById(string $id) {
        $stmt = $this->db->prepare(
            'SELECT * FROM `users` WHERE `id` = ?'
        );

        $stmt->execute([$id]);

        if($stmt->rowCount() > 0) {
            return $stmt->fetch();
        }

        return null;
    }

    public function getByUsername(string $name) {
        $stmt = $this->db->prepare(
            'SELECT * FROM `users` WHERE `username` = ?'
        );

        $stmt->execute([$name]);

        if($stmt->rowCount() > 0) {
            return $stmt->fetch();
        }

        return null;
    }
}