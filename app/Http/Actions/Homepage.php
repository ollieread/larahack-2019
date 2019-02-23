<?php

namespace Larahack\Http\Actions;

use Larahack\Entities\Ideas;
use Larahack\Support\Action;

class Homepage extends Action
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

        return $this->response()->view('homepage', compact('ideas'));
    }
}