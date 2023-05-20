<?php

namespace App\Infrastructure\Persistence;

use App\Application\CoinDataSource\CoinDataSource;
use App\Domain\Coin;

class ApiClient implements CoinDataSource
{
    public function post(string $coin_id): ?Coin
    {
        $url = 'https://api.coinlore.net/api/ticker/?id=' . $coin_id;

        // Obtener el contenido de la URL
        $data = file_get_contents($url);

        // Decodificar el resultado JSON
        $result = json_decode($data, true);
        $id = $result['id'];
        $name = $result['name'];
        $symbol = $result['symbol'];
        $priceUsd = $result['price_usd'];
        return new Coin($id, $name,$symbol,0,$priceUsd);
    }
    public function findById(string $coin_id): ?Coin
    {
        return null;
    }


}
