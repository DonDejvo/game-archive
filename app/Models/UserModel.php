<?php

namespace App\Models;

use App\Model;

/**
 * Databázový model pro uživatelský profil
 */
class UserModel extends Model {

    /**
     * Zahešuje heslo
     * 
     * @param string $value     heslo
     */
    private function hashPassword(string $value): string {
        return password_hash($value, PASSWORD_BCRYPT, [ 'cost' => 12 ]);
    } 
    
    /**
     * Vytvoří uživatele
     * 
     * @param string $username      uživatelské jméno
     * @param string $password      heslo
     */
    public function create(string $username, string $password) {

        $stmt = $this->db->prepare(
            'INSERT INTO `users` (`username`, `password`, `created_at`, `updated_at`) VALUES (?, ?, NOW(), NOW())'
        );

        $stmt->execute([$username, $this->hashPassword($password)]);

        return (int) $this->db->lastInsertId();
    }

    /**
     * Upraví a uloží uživatele
     * 
     * @param int $id               ID uživatele
     * @param string $username      uživatelské jméno
     * @param string $bio           bio
     */
    public function update(string $id, string $username, string $bio) {
        $query = 'UPDATE `users` SET `username` = ?, `bio` = ?, `updated_at` = NOW() WHERE `id` = ?';
        $stmt = $this->db->prepare($query);

        return $stmt->execute([$username, $bio, $id]);
    }

    /**
     * Upraví a uloží heslo
     * 
     * @param int $id               ID uživatele
     * @param string $password      heslo
     */
    public function updatePassword(string $id, string $password) {
        $query = 'UPDATE `users` SET `password` = ?, `updated_at` = NOW() WHERE `id` = ?';
        $stmt = $this->db->prepare($query);

        return $stmt->execute([$this->hashPassword($password), $id]);
    }

    /**
     * Vrátí uživatele podle ID
     * 
     * @param int $id    ID uživatele
     */
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

    /**
     * Vrátí uživatele podle jména
     * 
     * @param string $name     jméno
     */
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