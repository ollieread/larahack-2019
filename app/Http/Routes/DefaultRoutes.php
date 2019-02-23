<?php

namespace Larahack\Http\Routes;

use Illuminate\Routing\Router;
use Larahack\Http\Actions\Homepage;
use Larahack\Support\Contracts\Routes;

class DefaultRoutes implements Routes
{

    public function __invoke(Router $router)
    {
        $router->get('/')->name('homepage')->uses(Homepage::class);
    }
}