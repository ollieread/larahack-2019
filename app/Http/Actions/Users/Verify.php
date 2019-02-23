<?php

namespace Larahack\Http\Actions\Users;

use Larahack\Entities\Users;
use Larahack\Support\Action;
use Larahack\Support\Alerts;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Verify extends Action
{
    /**
     * @var \Larahack\Entities\Users
     */
    private $users;

    public function __construct(Users $users)
    {
        $this->users = $users;
    }

    public function __invoke(int $userId)
    {
        $user = $this->users->find($userId);

        if ($user) {
            if ($this->users->verify($user)) {
                Alerts::success(trans('users.verify.success'));
                return $this->response()->redirectTo('/');
            }

            Alerts::error(trans('users.verify.failure'));
            return $this->response()->redirectRoute('users:login.create');
        }

        throw new NotFoundHttpException;
    }
}