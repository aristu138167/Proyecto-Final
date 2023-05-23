<?php

namespace Tests\app\Infrastructure\Controller;

use App\Application\CreateWalletService;
use App\Application\UserDataSource\UserDataSource;
use App\Application\WalletDataSource\WalletDataSource;
use App\Domain\Coin;
use App\Domain\User;
use App\Domain\Wallet;
use App\Infrastructure\Persistence\CacheUserDataSource;
use App\Infrastructure\Persistence\CacheWalletDataSource;
use Mockery;
use Tests\TestCase;

class GetWalletControllerTest extends TestCase
{
    /**
     * @test
     */
    public function testCreateWalletIfUserNotExists()
    {
        $userDataSource = Mockery::mock(CacheUserDataSource::class);

        $userDataSource->shouldReceive('findUserById')->with('13')->andReturn(null);

        $this->app->instance(UserDataSource::class, $userDataSource);

        $response = $this->post('/api/wallet/open', [
            'user_id' => '13'
        ]);

        $response->assertStatus(404);
        $response->assertJson([
            'error' => 'Usuario no encontrado',
        ]);
    }

    /**
     * @test
     */
    public function testCreateWalletIfUserExists()
    {
        $userDataSource = Mockery::mock(CacheUserDataSource::class);
        $user = new User('1', 'juan@juan.com');

        $userDataSource->shouldReceive('findUserById')->with('1')->andReturn($user);

        $this->app->instance(UserDataSource::class, $userDataSource);

        $response = $this->post('/api/wallet/open', [
            'user_id' => '1'
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'wallet_id' => '1',
        ]);
    }

    /**
     * @test
     */
    public function testWalletDoesNotExist()
    {
        $walletDataSource = Mockery::mock(CacheWalletDataSource::class);
        $walletDataSource->shouldReceive('findById')->andReturn(null);

        $this->app->instance(WalletDataSource::class, $walletDataSource);

        $response = $this->get('/api/wallet/1');

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

        $response = $this->get('/api/wallet/33');

        $response->assertStatus(200);
        $response->assertJson([
            'id' => $wallet->getWalletId(),
            'coins' => []
        ]);
    }


}
