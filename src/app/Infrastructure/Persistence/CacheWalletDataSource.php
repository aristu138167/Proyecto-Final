<?php

namespace App\Infrastructure\Persistence;

use App\Application\WalletDataSource\WalletDataSource;
use App\Domain\Wallet;

class CacheWalletDataSource implements WalletDataSource
{
    public function create(string $user_id): ?Wallet
    {
        return new Wallet('1');
    }

}
