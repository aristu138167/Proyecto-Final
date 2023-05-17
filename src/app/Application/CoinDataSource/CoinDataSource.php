<?php

namespace App\Application\CoinDataSource;

use App\Domain\Coin;

Interface CoinDataSource
{
    public function post(string $coind_id): ?Coin;
    public function findById(string $coin_id): ?Coin;

}
