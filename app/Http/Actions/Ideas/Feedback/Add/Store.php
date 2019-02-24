<?php

namespace Larahack\Http\Actions\Ideas\Feedback\Add;

use Illuminate\Http\Request;
use Larahack\Entities\Feedback;
use Larahack\Entities\Ideas;
use Larahack\Entities\Users;
use Larahack\Support\Action;
use Larahack\Support\Alerts;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Store extends Action
{
    /**
     * @var \Larahack\Entities\Feedback
     */
    private $feedback;

    /**
     * @var \Larahack\Entities\Ideas
     */
    private $ideas;

    /**
     * @var \Larahack\Entities\Users
     */
    private $users;

    public function __construct(Ideas $ideas, Feedback $feedback, Users $users)
    {
        $this->ideas    = $ideas;
        $this->feedback = $feedback;
        $this->users    = $users;
    }

    public function __invoke(string $ideaSlug, Request $request)
    {
        $idea = $this->ideas->findBySlug($ideaSlug);

        if ($idea) {
            $input = $request->all([
                'parent',
                'content',
            ]);

            $user = $this->users->user();

            if ($input['parent']) {
                $input['parent'] = $this->feedback->findOneById($input['parent']);
            }

            if ($this->feedback->create($idea, $user, $input)) {
                Alerts::success(trans('ideas.feedback.create.success'));
                return $this->response()->redirectToRoute('idea:view', $idea->slug);
            }

            Alerts::error(trans('ideas.feedback.create.failure'));
            return $this->response()->redirectToRoute('idea:view', $idea->slug);
        }

        throw new NotFoundHttpException;
    }
}