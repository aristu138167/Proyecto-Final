<?php

namespace Tests\app\Infrastructure\Controller;

use App\Application\CoinDataSource\CoinDataSource;
use App\Domain\Coin;
use App\Domain\User;
use Exception;
use Illuminate\Http\Response;
use Mockery;
use Tests\TestCase;

class GetCoinControllerTest extends TestCase
{
    private CoinDataSource $coinDataSource;

    /**
     * @setUp
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->coinDataSource = Mockery::mock(CoinDataSource::class);
        $this->app->bind(CoinDataSource::class, function () {
            return $this->coinDataSource;
        });
    }
/*
    /**
     * @test
     *//*
    public function coinWithGivenNameDoesNotExist()
    {
        $this->coinDataSource
            ->expects('findByName')
            ->with('Bitcoin')
            ->andReturnNull();

        $response = $this->get('/api/coin/Bitcoin');

        $response->assertNotFound();
        $response->assertExactJson(['error' => 'crypto no encontrada']);
    }

    /**
     * @test
     *//*
    public function coinWithGivenNameDoesExist()
    {
        $this->coinDataSource
            ->expects('findByName')
            ->with('Bitcoin')
            ->andReturn( new Coin('1', "Bitcoin","B",12,1));

        $response = $this->get('/api/coin/Bitcoin');

        $response->assertOk();
        $response->assertExactJson(['id' => '1',
            'name'=> 'Bitcoin',
            'symbol'=>'B',
            'amount'=> 12,
            'value_usd'=>1]);
    }*/
}

