<?php

namespace App\Infrastructure\Providers;

use App\Application\CoinDataSource\CoinDataSource;
use App\Application\UserDataSource\UserDataSource;
use App\Application\WalletDataSource\WalletDataSource;
//use App\DataSource\Database\EloquentUserDataSource;
use App\Infrastructure\Persistence\ApiCoinDataSource;
use App\Infrastructure\Persistence\CacheUserDataSource;
use App\Infrastructure\Persistence\CacheWalletDataSource;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(WalletDataSource::class, function () {
            return new CacheWalletDataSource();
        });
        $this->app->bind(CoinDataSource::class, function () {
            return new ApiCoinDataSource();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(UserDataSource::class, function () {
           return new CacheUserDataSource();
        });

    }
}
