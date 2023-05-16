<?php

namespace App\Application\WalletDataSource;

use App\Domain\Wallet;

Interface WalletDataSource
{
    public function create(string $user_id): ?Wallet;
}
