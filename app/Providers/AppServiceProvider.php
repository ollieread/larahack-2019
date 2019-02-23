<?php

namespace Larahack\Providers;

use Illuminate\Auth\Passwords\PasswordBrokerManager;
use Illuminate\Auth\SessionGuard;
use Illuminate\Container\Container;
use Illuminate\Contracts\Auth\Factory as AuthFactory;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Factory as ViewFactory;
use Larahack\Composers\MainLayoutComposer;
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
        $view = Container::getInstance()->make(ViewFactory::class);

        $view->composer('layouts.main', MainLayoutComposer::class);
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
                      return $this->app->make(AuthFactory::class)->guard('web');
                  });

        $this->app->when(Users::class)
                  ->needs(PasswordBroker::class)
                  ->give(function () {
                      return $this->app->make(PasswordBrokerManager::class)->broker('users');
                  });
    }
}
