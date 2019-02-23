<?php

namespace Larahack\Http\Actions;

use Larahack\Entities\Categories;
use Larahack\Entities\Ideas;
use Larahack\Support\Action;

class Homepage extends Action
{
    /**
     * @var \Larahack\Entities\Ideas
     */
    private $ideas;
    /**
     * @var \Larahack\Entities\Categories
     */
    private $categories;

    public function __construct(Ideas $ideas, Categories $categories)
    {
        $this->ideas      = $ideas;
        $this->categories = $categories;
    }

    public function __invoke()
    {
        $ideas      = $this->ideas->paginate();
        $categories = $this->categories->hierarchy();

        return $this->response()->view('homepage', compact('ideas', 'categories'));
    }
}