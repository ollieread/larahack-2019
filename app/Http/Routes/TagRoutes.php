<?php

namespace Larahack\Http\Routes;

use Illuminate\Routing\Router;
use Larahack\Support\Contracts\Routes;
use Larahack\Http\Actions\Tags as Actions;

class TagRoutes implements Routes
{

    public function __invoke(Router $router)
    {
        $router->group(['as' => 'tag:'], function (Router $router) {
            $router->get('/tags')->name('index')->uses(Actions\Index::class);
        });
    }
}