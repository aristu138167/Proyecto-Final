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
        if($coin_id==="1") {
            return new Coin('1', "Bitcoin","B",0,1);
        }
        elseif ($coin_id==="2") {
            return new Coin('2', "Dogecoin","D",0,0.5);
        }
        elseif ($coin_id==="3") {
            return new Coin('3', "Ethereum", "E", 0, 0.2);
        }
        return null;
    }
}
