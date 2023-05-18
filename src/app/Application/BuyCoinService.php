<?php

namespace App\Application;



use App\Application\CoinDataSource\CoinDataSource;
use App\Application\UserDataSource\UserDataSource;
use App\Application\WalletDataSource\WalletDataSource;
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
                'Wallet not found exception'
            ], 404);
        }
        $coin = $this->coinDataSource->findById($coin_id);
        if (is_null($coin)) {
            return response()->json([
                'Coin not found exception'
            ], 404);
        }

        $coins = $wallet->getCoins();
        if(isset($coins[$coin_id])){
            $existingCoin=$coins[$coin_id];
            print_r($existingCoin->getAmount());
            $existingCoin->setAmount($coin->getAmount()+($amount_usd / $coin->getValueUsd()));
            print_r($existingCoin->getAmount());
        }
        else{
            $coin->setAmount($amount_usd / $coin->getValueUsd());
            $coins[$coin_id] = $coin;
        }
        $wallet->setCoins($coins);
        return response()->json([
            'successful buy operation'
        ], 200);
    }

}
