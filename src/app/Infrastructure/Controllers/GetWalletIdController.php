<?php

namespace App\Infrastructure\Controllers;

use App\Application\CoinDataSource\CoinDataSource;

use App\Application\WalletDataSource\WalletDataSource;
use Illuminate\Http\JsonResponse;

use Illuminate\Routing\Controller as BaseController;

class GetWalletIdController extends BaseController
{
    private  WalletDataSource $walletDataSource;

    public function __construct(WalletDataSource $walletDataSource)
    {
        $this->WalletDataSource=$walletDataSource;
    }

    public function __invoke(String $wallet_id): JsonResponse
    {
        $wallet=$this->walletDataSource->findById($wallet_id);
        if(is_null($wallet)){
            return response()->json([
                'error' => 'wallet no encontrada',
            ], 404);
        }
        else{
            $coin=$wallet->getCoins();
            return response()->json([
                'id' => $wallet->getWalletId(),
            ], 200);
        }
    }
}
