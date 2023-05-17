<?php

namespace App\Infrastructure\Persistence;

use App\Application\CoinDataSource\CoinDataSource;
use App\Domain\Coin;

class ApiClient implements CoinDataSource
{
    public function post(string $coin_id): ?Coin
    {
        return new Coin('1', "Bitcoin","B",12,1);
    }
    public function findById(string $coin_id): ?Coin
    {
        return null;
    }


}
