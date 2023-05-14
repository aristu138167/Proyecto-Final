<?php

namespace App\Infrastructure\Controllers;

use App\Application\CoinDataSource\CoinDataSource;
use App\Application\UserDataSource\UserDataSource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class GetCoinController extends BaseController
{
    private  CoinDataSource $coinDataSource;

    public function __construct(CoinDataSource $coinDataSource)
    {
        $this->coinDataSource=$coinDataSource;
    }

    public function __invoke(String $name): JsonResponse
    {
        $coin=$this->coinDataSource->findByName($name);
        if(is_null($coin)){
            return response()->json([
                'error' => 'crypto no encontrada',
            ], 404);
        }
        else{
            return response()->json([
                'id' => $coin->getCoinId(),
                'name'=> $coin->getName(),
                'symbol'=>$coin->getSymbol(),
                'amount'=> $coin->getAmount(),
                'value_usd'=>$coin->getValueUsd()
            ], 200);
        }
    }
}
