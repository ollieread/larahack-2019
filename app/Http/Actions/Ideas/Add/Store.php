<?php

namespace Larahack\Http\Actions\Ideas\Add;

use Illuminate\Http\Request;
use Larahack\Entities\Ideas;
use Larahack\Entities\Interest;
use Larahack\Entities\Users;
use Larahack\Support\Action;
use Larahack\Support\Alerts;

class Store extends Action
{
    /**
     * @var \Larahack\Entities\Ideas
     */
    private $ideas;

    /**
     * @var \Larahack\Entities\Users
     */
    private $users;

    /**
     * @var \Larahack\Entities\Interest
     */
    private $interest;

    public function __construct(Ideas $ideas, Users $users, Interest $interest)
    {
        $this->ideas    = $ideas;
        $this->users    = $users;
        $this->interest = $interest;
    }

    public function __invoke(Request $request)
    {
        $currentUser = $this->users->user();

        if (!$currentUser->verifiedAt) {
            Alerts::warning(trans('ideas.verify'), 'global');
            return $this->response()->redirectTo('/');
        }

        $input = $request->all(['title', 'category', 'content', 'excerpt']);
        $idea  = $this->ideas->create($input);

        if ($idea) {
            $this->interest->create($idea, ['would_pay' => false, 'would_newsletter' => false], $currentUser);
            Alerts::success(trans('ideas.create.success'), 'global');
            return $this->response()->redirectToRoute('idea:view', $idea->slug);
        }

        Alerts::error(trans('ideas.create.failure'), 'global');
        $request->session()->flashInput($input);
        return $this->response()->redirectToRoute('idea:create');
    }
}