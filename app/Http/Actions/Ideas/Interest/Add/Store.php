<?php

namespace Larahack\Http\Actions\Ideas\Interest\Add;

use Illuminate\Http\Request;
use Larahack\Entities\Ideas;
use Larahack\Entities\Interest;
use Larahack\Entities\Users;
use Larahack\Support\Action;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Store extends Action
{
    /**
     * @var \Larahack\Entities\Ideas
     */
    private $ideas;

    /**
     * @var \Larahack\Entities\Interest
     */
    private $interest;

    /**
     * @var \Larahack\Entities\Users
     */
    private $users;

    public function __construct(Ideas $ideas, Interest $interest, Users $users)
    {
        $this->ideas    = $ideas;
        $this->interest = $interest;
        $this->users    = $users;
    }

    public function __invoke(string $ideaSlug, Request $request)
    {
        $idea = $this->ideas->findBySlug($ideaSlug);

        if ($idea) {
            $input    = $request->all(['would_pay', 'would_newsletter']);
            $user     = $this->users->user();
            $interest = $this->interest->findUsersInterestInIdea($idea, $user);
            $success  = false;

            if ($interest) {
                $success = $this->interest->update($interest, $input);
            } else {
                $success = $this->interest->create($idea, $input) !== null;
            }

            if ($success) {
                return $this->response()->json();
            }

            return $this->response()->json(null, 500);
        }

        throw new NotFoundHttpException;
    }
}