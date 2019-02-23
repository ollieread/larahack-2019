<?php

namespace Larahack\Http\Actions\Users\Register;

use Larahack\Support\Action;

class Create extends Action
{
    public function __invoke()
    {
        return $this->response()->view('users.register');
    }
}