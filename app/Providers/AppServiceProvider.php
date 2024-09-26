<?php

namespace App\Providers;

use App\Core\UseCases\AccountUsecase;
use App\Core\UseCases\AccountUsecaseInterface;
use App\Core\UseCases\GachaUsecase;
use App\Core\UseCases\GachaUsecaseInterface;
use App\Core\UseCases\PlayerUsecase;
use App\Core\UseCases\PlayerUsecaseInterface;
use App\Infrastructure\Repositories\DBError;
use App\Infrastructure\Repositories\RepositoryBaseInterface;
use App\Infrastructure\Repositories\AccountRepository;
use App\Infrastructure\Repositories\AccountRepositoryInterface;
use App\Infrastructure\Repositories\PlayerCardRepository;
use App\Infrastructure\Repositories\PlayerCardRepositoryInterface;
use App\Infrastructure\Repositories\PlayerRepository;
use App\Infrastructure\Repositories\PlayerRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Ignore Sanctum
        Sanctum::ignoreMigrations();

        // Inject AccountUsecase
        $this->app->bind(AccountUsecaseInterface::class, AccountUsecase::class);
        $this->app->bind(AccountRepositoryInterface::class, AccountRepository::class);
        
        // NOTE: is requried?
        $this->app->bind(RepositoryBaseInterface::class, AccountRepository::class);

        // Inject PlayerUsecase
        $this->app->bind(PlayerUsecaseInterface::class, PlayerUsecase::class);
        $this->app->bind(PlayerRepositoryInterface::class, PlayerRepository::class);

        // Inject GachaUsecase
        $this->app->bind(GachaUsecaseInterface::class, GachaUsecase::class);
        $this->app->bind(PlayerCardRepositoryInterface::class, PlayerCardRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
