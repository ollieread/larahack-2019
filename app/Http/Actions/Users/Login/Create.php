<?php

namespace Larahack\Http\Actions\Users\Login;

use Larahack\Support\Action;

class Create extends Action
{
    public function __invoke()
    {
        return $this->response()->view('users.login');
    }
}