<?php

namespace App\Infrastructure\Persistence;

use App\Application\CoinDataSource\CoinDataSource;
use App\Domain\Coin;
use App\Domain\User;

class FileCoinDataSource implements CoinDataSource
{
    public function findCoinById(string $coin_id): ?Coin
    {
        return new Coin('1', "Bitcoin","B",12,1);
    }

    public function getAll(): array
    {
        return [new Coin('1', "Bitcoin","B",12,1), new Coin('2', "Ethereum","Eth",20,3)];
    }
}
