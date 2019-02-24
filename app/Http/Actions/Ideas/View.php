<?php

namespace Larahack\Http\Actions\Ideas;

use Larahack\Entities\Feedback;
use Larahack\Entities\Ideas;
use Larahack\Entities\Interest;
use Larahack\Entities\Users;
use Larahack\Support\Action;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class View extends Action
{
    /**
     * @var \Larahack\Entities\Ideas
     */
    private $ideas;

    /**
     * @var \Larahack\Entities\Feedback
     */
    private $feedback;
    /**
     * @var \Larahack\Entities\Users
     */
    private $users;

    /**
     * @var \Larahack\Entities\Interest
     */
    private $interest;

    public function __construct(Ideas $ideas, Feedback $feedback, Users $users, Interest $interest)
    {
        $this->ideas    = $ideas;
        $this->feedback = $feedback;
        $this->users    = $users;
        $this->interest = $interest;
    }

    public function __invoke(string $slug)
    {
        $idea = $this->ideas->findBySlug($slug);

        if ($idea) {
            $feedback    = $this->feedback->findForIdea($idea);
            $currentUser = $this->users->user();

            if ($currentUser) {
                $interest = $this->interest->findUsersInterestInIdea($idea, $currentUser);
            } else {
                $interest = null;
            }

            return $this->response()->view('ideas.view', compact('idea', 'feedback', 'currentUser', 'interest'));
        }

        throw new NotFoundHttpException;
    }
}