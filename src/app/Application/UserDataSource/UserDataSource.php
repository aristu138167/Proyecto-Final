<?php

namespace App\Application\UserDataSource;

use App\Domain\User;

Interface UserDataSource
{
    public function findUserById(string $user_id): ?User;

    /**
     * @return User[]
     */
    public function getAll(): array;
}
