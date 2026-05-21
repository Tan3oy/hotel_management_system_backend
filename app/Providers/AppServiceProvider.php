<?php

namespace App\Providers;

use App\Repositories\Interfaces\RoomInterface;
use App\Repositories\RoomRepository;

use App\Repositories\Interfaces\UserInterface;
use App\Repositories\UserRepository;

use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            RoomInterface::class,
            RoomRepository::class
        );
        $this->app->bind(
            UserInterface::class,
            UserRepository::class
        );
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
