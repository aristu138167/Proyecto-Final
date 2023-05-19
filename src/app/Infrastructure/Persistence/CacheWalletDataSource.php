<?php

namespace App\Infrastructure\Persistence;

use App\Application\WalletDataSource\WalletDataSource;
use App\Domain\Wallet;
use Illuminate\Support\Facades\Cache;

class CacheWalletDataSource implements WalletDataSource
{
    public function create(string $user_id): ?Wallet
    {   $cache_wallet=Cache::get("wallet_".$user_id) ;
        if($cache_wallet){
            return $cache_wallet;
        }
        $wallet=new Wallet($user_id);
        Cache::put("wallet_".$wallet->getWalletId(),$wallet);
        return $wallet;
    }
    public function findByID(string $wallet_id): ?Wallet
    {
        $cache_wallet=Cache::get("wallet_".$wallet_id) ;
        if($cache_wallet){
            return $cache_wallet;
        }
        return null;
    }

}
