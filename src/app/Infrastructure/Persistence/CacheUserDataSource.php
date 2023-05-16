<?php

namespace App\Infrastructure\Persistence;

use App\Application\UserDataSource\UserDataSource;
use App\Domain\User;

class CacheUserDataSource implements UserDataSource
{
    public function findUserById(string $user_id): ?User
    {
        return new User(1, "email@email.com");
    }

    public function getAll(): array
    {
        return [new User(1, "email@email.com"), new User(2, "another_email@email.com")];
    }
}
