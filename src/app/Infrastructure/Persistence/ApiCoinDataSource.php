<?php

namespace App\Infrastructure\Persistence;

use App\Application\CoinDataSource\CoinDataSource;
use App\Domain\Coin;
use App\Domain\User;

class ApiCoinDataSource implements CoinDataSource
{
    public function post(string $coin_id): ?Coin{
        return null;
    }
    public function findById(string $coin_id): ?Coin
    {
        return new Coin('1', "Bitcoin","B",0,1);
    }
}
