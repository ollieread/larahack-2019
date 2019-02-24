<?php

namespace Larahack\Http\Routes;

use Illuminate\Routing\Router;
use Larahack\Http\Actions\Ideas as Actions;
use Larahack\Support\Contracts\Routes;

class IdeaRoutes implements Routes
{
    public function __invoke(Router $router)
    {
        $router->group(['as' => 'idea:'], function (Router $router) {
            $router->get('/ideas')->name('index')->uses(Actions\Index::class);

            $router->get('/idea/add')->name('create')->uses(Actions\Add\Create::class);
            $router->post('/idea/add')->name('store')->uses(Actions\Add\Store::class);

            $router->get('/idea/{idea}')->name('view')->uses(Actions\View::class);

            $router->get('/idea/{idea}/edit')->name('edit')->uses(Actions\Edit\Edit::class);
            $router->post('/idea/{idea}/edit')->name('update')->uses(Actions\Edit\Update::class);

            $router->get('/idea/{idea}/delete')->name('delete')->uses(Actions\Delete\Delete::class);
            $router->post('/idea/{idea}/delete')->name('destroy')->uses(Actions\Delete\Destroy::class);
        });
    }
}