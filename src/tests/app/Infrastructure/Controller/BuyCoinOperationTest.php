<?php

namespace Tests\app\Infrastructure\Controller;

use App\Application\CoinDataSource\CoinDataSource;
use App\Application\UserDataSource\UserDataSource;
use App\Application\WalletDataSource\WalletDataSource;
use App\Domain\Coin;
use App\Domain\User;
use App\Domain\Wallet;
use App\Infrastructure\Persistence\ApiCoinDataSource;
use App\Infrastructure\Persistence\CacheUserDataSource;
use App\Infrastructure\Persistence\CacheWalletDataSource;
use Mockery;
use Tests\TestCase;

class BuyCoinOperationTest extends TestCase
{

    /**
     * @test
     *
     */
    public function testWalletDoesNotExist()
    {
        $walletDataSource = Mockery::mock(CacheWalletDataSource::class);
        $walletDataSource->shouldReceive('findById')->andReturn(null);

        $this->app->instance(WalletDataSource::class, $walletDataSource);

        $response = $this->post('/api/coin/buy', [
            'coin_id' => '1',
            'wallet_id' => '1',
            'amount_usd' => 1
        ]);

        $response->assertStatus(404);
        $response->assertJson([
            'error' => 'Wallet no encontrada'
        ]);
    }

    /**
     * @test
     *
     */
    public function testCoinDoesNotExist()
    {
        $walletDataSource = Mockery::mock(CacheWalletDataSource::class);
        $wallet = new Wallet('1');

        $walletDataSource->shouldReceive('findById')->andReturn($wallet);
        $this->app->instance(WalletDataSource::class, $walletDataSource);

        $coinDataSource = Mockery::mock(ApiCoinDataSource::class);
        $coinDataSource->shouldReceive('findById')->andReturn(null);

        $this->app->instance(CoinDataSource::class, $coinDataSource);

        $response = $this->post('/api/coin/buy', [
            'coin_id' => '1',
            'wallet_id' => '1',
            'amount_usd' => 1
        ]);
        $response->assertStatus(404);
        $response->assertJson([
            'error' => 'Coin no encontrada',
        ]);
    }

    /**
     * @test
     *
     */
    public function testWalletAndCoinExist()
    {
        $walletDataSource = Mockery::mock(CacheWalletDataSource::class);
        $wallet = new Wallet('1');

        $walletDataSource->shouldReceive('findById')->andReturn($wallet);
        $this->app->instance(WalletDataSource::class, $walletDataSource);

        $coinDataSource = Mockery::mock(ApiCoinDataSource::class);
        $coin = new Coin('1', 'TestingCoin', 'TC', 1, 1);

        $coinDataSource->shouldReceive('findById')->andReturn($coin);
        $this->app->instance(CoinDataSource::class, $coinDataSource);

        $response = $this->post('/api/coin/buy', [
            'coin_id' => '1',
            'wallet_id' => '1',
            'amount_usd' => 1
        ]);

        $response->assertStatus(200);
        $response->assertJson([
             'Successful buy operation'
        ]);
    }

}
