<?php

namespace App\Auth;

class User {

    public function __construct(
        private int $id,
        private string $username,
        private bool $active
    ) {
    }

    public function getId(): int {
        return $this->id;
    }

    public function getUsername(): string {
        return $this->username;
    }

    public function isActive(): bool {
        return $this->active;
    }

}