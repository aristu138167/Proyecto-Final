<?php

namespace App\Domain;

class Wallet
{
    private string $wallet_id;
    private array $coins = [];

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

    /**
     * @param array $coins
     */
    public function setCoins(array $coins): void
    {
        $this->coins = $coins;
    }
    public function showCoins(): array
    {
        $coinsArray = [];

        foreach ($this->coins as $coinId => $coin) {
            $coinsArray[$coinId] = $coin->toArray();
        }

        return $coinsArray;
    }



}
