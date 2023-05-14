<?php

namespace App\Application\CoinDataSource;

use App\Domain\Coin;

Interface CoinDataSource
{
    public function findByName(string $name): ?Coin;

    /**
     * @return Coin[]
     */
    public function getAll(): array;
}
