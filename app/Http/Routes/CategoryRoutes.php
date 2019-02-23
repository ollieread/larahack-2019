<?php

namespace Larahack\Http\Routes;

use Illuminate\Routing\Router;
use Larahack\Support\Contracts\Routes;
use Larahack\Http\Actions\Categories as Actions;

class CategoryRoutes implements Routes
{

    public function __invoke(Router $router)
    {
        $router->get('/category/{category}')->name('category.view')->uses(Actions\View::class);
    }
}