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
            // View all ideas
            $router->get('/ideas')->name('index')->uses(Actions\Index::class);

            $router->middleware('auth:web')->group(function (Router $router) {
                // Add an idea
                $router->get('/idea/add')->name('create')->uses(Actions\Add\Create::class);
                $router->post('/idea/add')->name('store')->uses(Actions\Add\Store::class);
                // Edit your own idea
                $router->get('/idea/{idea}/edit')->name('edit')->uses(Actions\Edit\Edit::class);
                $router->post('/idea/{idea}/edit')->name('update')->uses(Actions\Edit\Update::class);
                // Delete your own idea
                $router->get('/idea/{idea}/delete')->name('delete')->uses(Actions\Delete\Delete::class);
                $router->post('/idea/{idea}/delete')->name('destroy')->uses(Actions\Delete\Destroy::class);
                // Add feedback
                $router->post('/idea/{idea}/feedback/add')->name('feedback.store')->uses(Actions\Feedback\Add\Store::class);
                $router->post('/idea/{idea}/interest/add')->name('interest.store')->uses(Actions\Interest\Add\Store::class);
            });

            // View a specific idea
            $router->get('/idea/{idea}')->name('view')->uses(Actions\View::class);
        });
    }
}