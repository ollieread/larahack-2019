<?php

namespace Larahack\Http\Actions\Users;

use Larahack\Entities\Users;
use Larahack\Support\Action;

class Logout extends Action
{
    /**
     * @var \Larahack\Entities\Users
     */
    private $users;

    public function __construct(Users $users)
    {
        $this->users = $users;
    }

    public function __invoke()
    {
        $this->users->deauth();
        return $this->response()->redirectTo('/');
    }
}