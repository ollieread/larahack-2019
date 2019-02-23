<?php

namespace Larahack\Http\Routes;

use Illuminate\Routing\Router;
use Larahack\Http\Actions\Users as Actions;
use Larahack\Support\Contracts\Routes;

class UserRoutes implements Routes
{

    public function __invoke(Router $router)
    {
        $router->middleware('guest:web')
               ->group(function (Router $router) {
                   $this->guestRoutes($router);
               });

        $router->middleware('auth:web')
               ->group(function (Router $router) {
                   $this->authRoutes($router);
               });
    }

    private function guestRoutes(Router $router)
    {
        $router->group(['prefix' => '/register', 'as' => 'user:register.'], function (Router $router) {
            $router->get('/')->name('create')->uses(Actions\Register\Create::class);
            $router->post('/')->name('store')->uses(Actions\Register\Store::class);
        });

        $router->group(['prefix' => '/login', 'as' => 'user:login.'], function (Router $router) {
            $router->get('/')->name('create')->uses(Actions\Login\Create::class);
            $router->post('/')->name('store')->uses(Actions\Login\Store::class);
        });

        $router->get('/verify/{userId}')->name('user:verify')->uses(Actions\Verify::class);
    }

    private function authRoutes(Router $router)
    {
        $router->get('/logout')->name('user:logout')->uses(Actions\Logout::class);
    }
}