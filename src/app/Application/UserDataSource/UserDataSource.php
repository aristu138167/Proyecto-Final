<?php

namespace App\Application\UserDataSource;

use App\Domain\User;

Interface UserDataSource
{
    public function findByEmail(string $email): User;

    /**
     * @return User[]
     */
    public function getAll(): array;
    
    public function userExist(string $user_id): bool;
}
