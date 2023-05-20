<?php

namespace App\Infrastructure\Persistence;

use App\Application\CoinDataSource\CoinDataSource;
use App\Application\WalletDataSource\WalletDataSource;
use App\Domain\Coin;
use App\Domain\User;

class ApiCoinDataSource implements CoinDataSource
{

    public function post(string $coin_id): ?Coin{
        $url = 'https://api.coinlore.net/api/ticker/?id=' . $coin_id;

        // Obtener el contenido de la URL
        $data = file_get_contents($url,true);

        // Decodificar el resultado JSON
        $result = json_decode($data);

        $coin = $result[0];

        $id = $coin->id;
        $name = $coin->name;
        $symbol = $coin->symbol;
        $priceUsd = $coin->price_usd;
        return new Coin($id, $name,$symbol,0,$priceUsd);
    }
    public function findById(string $coin_id): ?Coin
    {
        $coin=$this->post($coin_id);
        if($coin==null) {
            return null;
        }
        return $coin;

    }
}
