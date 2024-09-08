<?php

namespace App\Providers;

use App\Core\UseCases\UserUsecase;
use App\Core\UseCases\UserUsecaseInterface;
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
        // Inject UserUsecase
        $this->app->bind(UserUsecaseInterface::class, UserUsecase::class);
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
