<?php

namespace App\Infrastructure\Persistence;

use App\Application\WalletDataSource\WalletDataSource;
use App\Domain\Wallet;

class FileWalletDataSource implements WalletDataSource
{
    public function openWallet(string $user_id): ?Wallet
    {
        return new Wallet('1');
    }
    public function findById(string $wallet_id): ?Wallet
    {
        return new Wallet('1');
    }

}
