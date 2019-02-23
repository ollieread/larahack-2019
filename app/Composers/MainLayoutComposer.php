<?php

namespace Larahack\Composers;

use Illuminate\View\View;
use Larahack\Entities\Users;

class MainLayoutComposer
{
    /**
     * @var \Larahack\Entities\Users
     */
    private $users;

    public function __construct(Users $users)
    {
        $this->users = $users;
    }

    public function compose(View $view)
    {
        $view->with('currentUser', $this->users->user());
    }
}