<?php

namespace Larahack\Http\Actions\Ideas;

use Larahack\Entities\Ideas;
use Larahack\Support\Action;

class Index extends Action
{
    /**
     * @var \Larahack\Entities\Ideas
     */
    private $ideas;

    public function __construct(Ideas $ideas)
    {
        $this->ideas = $ideas;
    }

    public function __invoke()
    {
        $ideas = $this->ideas->paginate();

        return $this->response()->view('ideas.index', compact('ideas'));
    }
}