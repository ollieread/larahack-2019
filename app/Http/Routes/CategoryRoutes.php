<?php

namespace Larahack\Http\Routes;

use Illuminate\Routing\Router;
use Larahack\Http\Actions\Categories as Actions;
use Larahack\Support\Contracts\Routes;

class CategoryRoutes implements Routes
{

    public function __invoke(Router $router)
    {
        $router->group(['as' => 'category:'], function (Router $router) {
            $router->get('/categories')->name('index')->uses(Actions\Index::class);
            $router->get('/category/{category}')->name('view')->uses(Actions\View::class);
        });
    }
}