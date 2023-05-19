<?php

namespace App\Application;



use App\Application\CoinDataSource\CoinDataSource;
use App\Application\UserDataSource\UserDataSource;
use App\Application\WalletDataSource\WalletDataSource;
use Illuminate\Support\Facades\Cache;
use function response;

class SellCoinService
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
        $wallet=$this->walletDataSource->findById($wallet_id);
        if(is_null($wallet)){
            return response()->json([
                'Wallet not found exception'
            ], 404);
        }
        $coin = $this->coinDataSource->findById($coin_id);
        if(is_null($coin)){
            return response()->json([
                'Coin not found exception'
            ], 404);
        }
        $coins = $wallet->getCoins();
        if(isset($coins[$coin_id])){
            $existingCoin=$coins[$coin_id];
            $newAmount =$existingCoin->getAmount()-($amount_usd / $coin->getValueUsd());
            if($newAmount<0){
                return response()->json([
                    'Cantidad de crypto insuficiente'
                ], 400);
            }
            else{
                $existingCoin->setAmount($newAmount);
                if($newAmount==0){
                    unset($coins[$coin_id]);
                }
            }
        }
        else{
            return response()->json([
                'Crypto no encontrada en el wallet'
            ], 404);
        }
        $wallet->setCoins($coins);
        var_dump($wallet);
        Cache::set("wallet_".$wallet_id,$wallet);
        return response()->json([
            'successful sell operation'
        ], 200);
    }

}
