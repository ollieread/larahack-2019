<?php

namespace Larahack\Http\Routes;

use Illuminate\Routing\Router;
use Larahack\Http\Actions\Ideas as Actions;
use Larahack\Support\Contracts\Routes;

class IdeaRoutes implements Routes
{
    public function __invoke(Router $router)
    {
        $router->get('/idea/{idea}')->name('idea.view')->uses(Actions\View::class);
    }
}