<?php

namespace App\Infrastructure\Controllers;

use App\Application\CoinDataSource\CoinDataSource;

use App\Application\WalletDataSource\WalletDataSource;
use Illuminate\Http\JsonResponse;

use Illuminate\Routing\Controller as BaseController;

class OpenWalletController extends BaseController
{
    private  WalletDataSource $walletDataSource;

    public function __construct(WalletDataSource $walletDataSource)
    {
        $this->WalletDataSource=$walletDataSource;
    }

    public function __invoke(String $user_id): JsonResponse
    {
        if(existUser($user_id)){
            return response()->json([
                'error' => 'wallet no encontrada',
            ], 404);
        }
        else{
            $wallet=$this->walletDataSource->openWallet($user_id);
            return response()->json([
                'id' => $wallet->getWalletId(),
            ], 200);
        }
    }
}
