<?php

namespace Larahack\Providers;

use Illuminate\Container\Container;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Larahack\Http\Routes;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    protected $routes = [
        Routes\UserRoutes::class,
    ];

    /**
     * @var \Illuminate\Routing\Router
     */
    private $router;

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes(): void
    {
        $this->router()
             ->middleware('web')
             ->group(function (Router $router) {
                 foreach ($this->routes as $route) {
                     (new $route)($router);
                 }
             });
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
    }

    /**
     * @return \Illuminate\Routing\Router|mixed
     */
    private function router(): Router
    {
        if (!($this->router instanceof Router)) {
            $this->router = Container::getInstance()->make(Router::class);
        }

        return $this->router;
    }
}
