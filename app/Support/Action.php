<?php

namespace Larahack\Support;

use Illuminate\Container\Container;
use Illuminate\Routing\ResponseFactory;

abstract class Action
{
    private $responseFactory;

    protected function response()
    {
        if (!($this->responseFactory instanceof ResponseFactory)) {
            $this->responseFactory = Container::getInstance()->make(ResponseFactory::class);
        }

        return $this->responseFactory;
    }
}