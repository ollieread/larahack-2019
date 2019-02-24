<?php

namespace Larahack\Http\Actions\Categories;

use Larahack\Entities\Categories;
use Larahack\Support\Action;

class Index extends Action
{
    /**
     * @var \Larahack\Entities\Categories
     */
    private $categories;

    public function __construct(Categories $categories)
    {
        $this->categories = $categories;
    }

    public function __invoke()
    {
        $categories = $this->categories->paginate();

        return $this->response()->view('categories.index', compact('categories'));
    }
}