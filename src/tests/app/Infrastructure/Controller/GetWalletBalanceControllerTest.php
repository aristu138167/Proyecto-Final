<?php

namespace Tests\app\Infrastructure\Controller;

use App\Application\WalletDataSource\WalletDataSource;
use App\Domain\Coin;
use App\Domain\Wallet;
use App\Infrastructure\Persistence\CacheWalletDataSource;
use Mockery;
use Tests\TestCase;

class GetWalletBalanceControllerTest extends TestCase
{
    /**
     * @test
     */
    public function testWalletDoesNotExist()
    {
        $walletDataSource = Mockery::mock(CacheWalletDataSource::class);
        $walletDataSource->shouldReceive('findById')->andReturn(null);

        $this->app->instance(WalletDataSource::class, $walletDataSource);

        $response = $this->get('/api/wallet/1/balance');

        $response->assertStatus(404);
        $response->assertJson([
            'error' => 'Wallet no encontrada',
        ]);
    }

    /**
     * @test
     */
    public function testWalletExist()
    {
        $walletDataSource = Mockery::mock(CacheWalletDataSource::class);
        $wallet = new Wallet('33');

        $walletDataSource->shouldReceive('findById')->andReturn($wallet);

        $this->app->instance(WalletDataSource::class, $walletDataSource);

        $response = $this->get('/api/wallet/33/balance');

        $response->assertStatus(200);
        $response->assertJson([
            'id' => $wallet->getWalletId(),
            'balance' => 0 . "$"
        ]);
    }

    /**
     * @test
     */
    public function testWalletOneCoin()
    {
        $walletDataSource = Mockery::mock(CacheWalletDataSource::class);
        $wallet = new Wallet('33');
        $wallet->setCoins([
            'idTest' => new Coin('idTest', 'testCoin', 'tst', 1., 1.)
        ]);

        $walletDataSource->shouldReceive('findById')->andReturn($wallet);

        $this->app->instance(WalletDataSource::class, $walletDataSource);

        $response = $this->get('/api/wallet/33/balance');

        $response->assertStatus(200);
        $response->assertJson([
            'id' => $wallet->getWalletId(),
            'balance' => 1 . "$"
        ]);
    }

    /**
     * @test
     */
    public function testWalletTwoDifferentCoins()
    {
        $walletDataSource = Mockery::mock(CacheWalletDataSource::class);
        $wallet = new Wallet('33');
        $wallet->setCoins([
            'idTest' => new Coin('idTest', 'testCoin', 'tst', 1., 1.),
            'idTest2' => new Coin('idTest2', 'testCoin2', 'tst2', 2., 2.)
        ]);

        $walletDataSource->shouldReceive('findById')->andReturn($wallet);

        $this->app->instance(WalletDataSource::class, $walletDataSource);

        $response = $this->get('/api/wallet/33/balance');

        $response->assertStatus(200);
        $response->assertJson([
            'id' => $wallet->getWalletId(),
            'balance' => 5 . "$"
        ]);
    }
}
