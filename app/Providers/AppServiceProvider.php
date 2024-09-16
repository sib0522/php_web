<?php

namespace App\Providers;

use App\Core\UseCases\UserUsecase;
use App\Core\UseCases\UserUsecaseInterface;
use App\Infrastructure\Repositories\DBError;
use App\Infrastructure\Repositories\RepositoryBaseInterface;
use App\Infrastructure\Repositories\UserRepository;
use App\Infrastructure\Repositories\UserRepositoryInterface;
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

        // Inject UserUsecase
        $this->app->bind(UserUsecaseInterface::class, UserUsecase::class);

        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(RepositoryBaseInterface::class, UserRepository::class);
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
