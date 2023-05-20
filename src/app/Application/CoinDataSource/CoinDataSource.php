<?php

namespace App\Application\CoinDataSource;

use App\Domain\Coin;

Interface CoinDataSource
{
    public function post(string $coin_id): ?Coin;
    public function findById(string $coin_id): ?Coin;

}
