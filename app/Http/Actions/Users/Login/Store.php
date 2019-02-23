<?php

namespace Larahack\Http\Actions\Users\Login;

use Illuminate\Http\Request;
use Larahack\Entities\Users;
use Larahack\Support\Action;
use Larahack\Support\Alerts;

class Store extends Action
{

    /**
     * @var \Larahack\Entities\Users
     */
    private $users;

    public function __construct(Users $users)
    {
        $this->users = $users;
    }

    public function __invoke(Request $request)
    {
        $credentials = $request->all(['email', 'password']);
        $rememberMe  = (bool) ($request->input('remember_me') ?? true);

        if ($this->users->auth($credentials, $rememberMe)) {
            return $this->response()->redirectToIntended();
        }

        Alerts::error(trans('users.login.failure'));
        return $this->response()->redirectToRoute('user:login.create');
    }
}