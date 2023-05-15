<?php

namespace App\Application\CoinDataSource;

use App\Domain\Coin;

Interface CoinDataSource
{
    public function findCoinById(string $coin_id): ?Coin;

    /**
     * @return Coin[]
     */
    public function getAll(): array;
}
