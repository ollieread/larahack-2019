<?php

namespace Larahack\Http\Actions\Ideas;

use Larahack\Entities\Feedback;
use Larahack\Entities\Ideas;
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

    public function __construct(Ideas $ideas, Feedback $feedback)
    {
        $this->ideas    = $ideas;
        $this->feedback = $feedback;
    }

    public function __invoke(string $slug)
    {
        $idea = $this->ideas->findBySlug($slug);

        if ($idea) {
            $feedback = $this->feedback->findForIdea($idea);

            return $this->response()->view('ideas.view', compact('idea', 'feedback'));
        }

        throw new NotFoundHttpException;
    }
}