<?php

namespace Larahack\Http\Actions\Users\Register;

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
        $input = $request->all([
            'display_name',
            'first_name',
            'last_name',
            'email',
            'password',
            'password_confirmation',
        ]);

        if ($this->users->register($input)) {
            Alerts::success(trans('users.register.success'));
            return $this->response()->redirectToRoute('user:login.create');
        }

        Alerts::error(trans('users.register.failure'));
        return $this->response()->redirectToRoute('user:register.create');
    }
}