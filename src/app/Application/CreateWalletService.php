<?php

namespace App\Application;

use App\Application\UserDataSource\UserDataSource;
use App\Application\WalletDataSource\WalletDataSource;

use function response;

class CreateWalletService
{
    private UserDataSource $userDataSource;
    private WalletDataSource $walletDataSource;


    public function __construct(WalletDataSource $walletDataSource, UserDataSource $userDataSource)
    {
        $this->userDataSource = $userDataSource;
        $this->walletDataSource = $walletDataSource;
    }

    public function execute(string $user_id)
    {
        $user = $this->userDataSource->findUserById($user_id);
        if (is_null($user)) {
            return response()->json([
                'User not found exception',
            ], 404);
        }
        $wallet = $this->walletDataSource->create($user_id);
        return response()->json([
            'wallet_id' => $wallet->getWalletId(),
        ], 200);
    }
}
