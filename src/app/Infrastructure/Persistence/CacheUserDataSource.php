<?php

namespace App\Infrastructure\Persistence;

use App\Application\UserDataSource\UserDataSource;
use App\Domain\User;
use App\Domain\Wallet;
use Illuminate\Support\Facades\Cache;

class CacheUserDataSource implements UserDataSource
{
    public function findUserById(string $user_id): ?User
    {
        $cache_user=Cache::get("user_".$user_id) ;
        if($cache_user){
            return $cache_user;
        }
        return null;
    }

    public function getAll(): array
    {
        return [new User(1, "email@email.com"), new User(2, "another_email@email.com")];
    }
}
