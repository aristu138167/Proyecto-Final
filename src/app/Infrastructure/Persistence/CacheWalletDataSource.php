<?php

namespace App\Infrastructure\Persistence;

use App\Application\WalletDataSource\WalletDataSource;
use App\Domain\Wallet;
use Illuminate\Support\Facades\Cache;

class CacheWalletDataSource implements WalletDataSource
{
    public function create(string $user_id): ?Wallet
    {   $wallet=new Wallet($user_id);
        Cache::put($wallet->getWalletId(),$wallet);
        return $wallet;
    }
    public function findByID(string $wallet_id): ?Wallet
    {
        return Cache::get($wallet_id);
    }

}
