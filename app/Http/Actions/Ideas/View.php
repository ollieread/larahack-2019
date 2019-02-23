<?php

namespace Larahack\Http\Actions\Ideas;

use Larahack\Entities\Ideas;
use Larahack\Support\Action;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class View extends Action
{
    /**
     * @var \Larahack\Entities\Ideas
     */
    private $ideas;

    public function __construct(Ideas $ideas)
    {
        $this->ideas = $ideas;
    }

    public function __invoke(string $slug)
    {
        $idea = $this->ideas->findBySlug($slug);

        if ($idea) {
            return $this->response()->view('ideas.view', compact('idea'));
        }

        throw new NotFoundHttpException;
    }
}