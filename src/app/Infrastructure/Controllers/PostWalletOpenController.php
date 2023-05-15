<?php

namespace App\Infrastructure\Controllers;

use App\Application\CoinDataSource\CoinDataSource;

use App\Application\WalletDataSource\WalletDataSource;
use Illuminate\Http\JsonResponse;

use Illuminate\Routing\Controller as BaseController;

class PostWalletOpenController extends BaseController
{
    private  WalletDataSource $walletDataSource;

    public function __construct(WalletDataSource $walletDataSource)
    {
        $this->WalletDataSource=$walletDataSource;
    }

    public function __invoke(String $user_id): JsonResponse
    {
        if(is_null($user_id)){
            return response()->json([
                'A user with the specified ID was not found.',
            ], 404);
        }
        else{
            $wallet=$this->walletDataSource->openWallet($user_id);
            return response()->json([
                'wallet_id' => $wallet->getWalletId(),
            ], 200);
        }
    }
}
