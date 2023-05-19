<?php

namespace App\Infrastructure\Controllers;

use App\Application\CoinDataSource\CoinDataSource;

use App\Application\WalletDataSource\WalletDataSource;
use Illuminate\Http\JsonResponse;

use Illuminate\Routing\Controller as BaseController;

class GetWalletController extends BaseController
{
    private  WalletDataSource $walletDataSource;

    public function __construct(WalletDataSource $walletDataSource)
    {
        $this->walletDataSource=$walletDataSource;
    }

    public function __invoke(String $wallet_id): JsonResponse
    {
        $wallet=$this->walletDataSource->findById($wallet_id);
        if(is_null($wallet)){
            return response()->json([
                'Wallet no encontrada',
            ], 404);
        }
        else{
            return response()->json([
                'id' => $wallet->getWalletId(),
                'coins'=>$wallet->showCoins()
            ], 200);
        }
    }
}
