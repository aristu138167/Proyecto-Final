<?php

namespace App\Infrastructure\Controllers;

use App\Application\WalletDataSource\WalletDataSource;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class GetWalletBalanceController extends BaseController
{
    private WalletDataSource $walletDataSource;

    public function __construct(WalletDataSource $walletDataSource)
    {
        $this->walletDataSource = $walletDataSource;
    }

    public function __invoke(string $wallet_id): JsonResponse
    {
        $wallet = $this->walletDataSource->findById($wallet_id);
        if (is_null($wallet)) {
            return response()->json([
                'error' => 'Wallet no encontrada',
            ], 404);
        }

        $balance = 0;
        foreach ($wallet->getCoins() as $coin) {
            $balance += $coin->getAmount() * $coin->getValueUsd();
        }

        return response()->json([
            'id' => $wallet->getWalletId(),
            'balance' => $balance . "$"
        ], 200);
    }
}
