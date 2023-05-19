<?php

namespace App\Domain;

class Coin
{
    private string $coin_id;
    private string $name;
    private string $symbol;
    private float $amount;
    private float $value_usd;


    public function __construct(string $coin_id, string $name,string $symbol,float $amount,float $value_usd)
    {
        $this->coin_id = $coin_id;
        $this->name = $name;
        $this->symbol = $symbol;
        $this->amount = $amount;
        $this->value_usd=$value_usd;
    }

    /**
     * @return string
     */
    public function getCoinId(): string
    {
        return $this->coin_id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getSymbol(): string
    {
        return $this->symbol;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @return float
     */
    public function getValueUsd(): float
    {
        return $this->value_usd;
    }

    /**
     * @param float $amount
     */
    public function setAmount(float $amount): void
    {
        $this->amount = $amount;
    }
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'symbol'=>$this->symbol,
            'amount'=>$this->amount,
            'value'=>$this->value_usd
        ];
    }
}
