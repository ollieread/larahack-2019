<?php

namespace Larahack\Http\Actions\Ideas\Add;

use Illuminate\Http\Request;
use Larahack\Entities\Categories;
use Larahack\Entities\Users;
use Larahack\Support\Action;
use Larahack\Support\Alerts;

class Create extends Action
{
    /**
     * @var \Larahack\Entities\Categories
     */
    private $categories;

    /**
     * @var \Larahack\Entities\Users
     */
    private $users;

    public function __construct(Categories $categories, Users $users)
    {
        $this->categories = $categories;
        $this->users      = $users;
    }

    public function __invoke(Request $request)
    {
        $currentUser = $this->users->user();

        if (!$currentUser->verifiedAt) {
            Alerts::warning(trans('ideas.verify'), 'global');
            return $this->response()->redirectTo('/');
        }

        $categories = $this->categories->all();
        $category   = $request->query('category');

        $request->session()->flashInput(compact('category'));

        return $this->response()->view('ideas.create', compact('categories'));
    }
}