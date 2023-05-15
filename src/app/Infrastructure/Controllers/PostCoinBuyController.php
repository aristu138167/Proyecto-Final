<?php

namespace App\Infrastructure\Controllers;

use App\Application\CoinDataSource\CoinDataSource;
use App\Application\UserDataSource\UserDataSource;
use App\Application\WalletDataSource\WalletDataSource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class PostCoinBuyController extends BaseController
{
    private  CoinDataSource $coinDataSource;

    public function __construct(CoinDataSource $coinDataSource)
    {
        $this->coinDataSource=$coinDataSource;
    }

    public function __invoke(String $coin_id,String $wallet_id,float $amount_usd): JsonResponse
    {
        $coin=$this->coinDataSource->findCoinById($coin_id);
        if(is_null($coin)){
            return response()->json([
                'A coin with the specified ID was not found.',
            ], 404);
        }
        else{
            return response()->json([
                'successful operation'
            ], 200);
        }
    }
}
