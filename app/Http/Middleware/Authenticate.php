<?php

namespace Larahack\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Container\Container;
use Illuminate\Contracts\Routing\ResponseFactory;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return string
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return Container::getInstance()->make(ResponseFactory::class)->redirectToRoute('user:login.create');
        }
    }
}
