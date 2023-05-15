<?php

namespace App\Domain;

class Wallet
{
    private string $wallet_id;
    private array $coins;


    public function __construct(string $wallet_id)
    {
        $this->wallet_id = $wallet_id;
    }

    /**
     * @return string
     */
    public function getWalletId(): string
    {
        return $this->wallet_id;
    }

    /**
     * @return array
     */
    public function getCoins(): array
    {
        return $this->coins;
    }



}
