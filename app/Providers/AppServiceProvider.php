<?php

namespace Larahack\Providers;

use Illuminate\Auth\Passwords\PasswordBrokerManager;
use Illuminate\Auth\SessionGuard;
use Illuminate\Contracts\Auth\Factory;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Support\ServiceProvider;
use Larahack\Entities\Users;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->when(Users::class)
                  ->needs(SessionGuard::class)
                  ->give(function () {
                      return $this->app->make(Factory::class)->guard('web');
                  });

        $this->app->when(Users::class)
                  ->needs(PasswordBroker::class)
                  ->give(function () {
                      return $this->app->make(PasswordBrokerManager::class)->broker('users');
                  });
    }
}
