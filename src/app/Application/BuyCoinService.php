<?php

namespace App\Application;



use App\Application\CoinDataSource\CoinDataSource;
use App\Application\UserDataSource\UserDataSource;
use App\Application\WalletDataSource\WalletDataSource;
use Illuminate\Support\Facades\Cache;
use function response;

class BuyCoinService
{
    private CoinDataSource $coinDataSource;
    private WalletDataSource $walletDataSource;


    public function __construct(WalletDataSource $walletDataSource,CoinDataSource $coinDataSource)
    {
        $this->coinDataSource = $coinDataSource;
        $this->walletDataSource = $walletDataSource;
    }
    public function execute(string $coin_id,string $wallet_id, float $amount_usd)
    {
        $wallet = $this->walletDataSource->findById($wallet_id);
        if (is_null($wallet)) {
            return response()->json([
                'error' => 'Wallet no encontrada'
            ], 404);
        }
        $coin = $this->coinDataSource->findById($coin_id);
        if (is_null($coin)) {
            return response()->json([
                'error' => 'Coin no encontrada'
            ], 404);
        }

        $coins = $wallet->getCoins();
        if(isset($coins[$coin_id])){
            $existingCoin=$coins[$coin_id];
            $newAmount =$existingCoin->getAmount()+($amount_usd / $coin->getValueUsd());
            $existingCoin->setAmount($newAmount);
        }
        else{
            $newCoin = clone $coin;
            $newAmount=$amount_usd / $coin->getValueUsd();
            $newCoin->setAmount($newAmount);
            $coins[$coin_id] = $newCoin;
        }
        $wallet->setCoins($coins);
        Cache::set("wallet_".$wallet_id,$wallet);
        return response()->json([
            'Successful buy operation'
        ], 200);
    }

}
