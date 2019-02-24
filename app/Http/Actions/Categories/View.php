<?php

namespace Larahack\Http\Actions\Categories;

use Larahack\Entities\Categories;
use Larahack\Entities\Ideas;
use Larahack\Support\Action;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class View extends Action
{
    /**
     * @var \Larahack\Entities\Categories
     */
    private $categories;
    /**
     * @var \Larahack\Entities\Ideas
     */
    private $ideas;

    public function __construct(Categories $categories, Ideas $ideas)
    {

        $this->categories = $categories;
        $this->ideas      = $ideas;
    }

    public function __invoke(string $slug)
    {
        $category = $this->categories->findOneBySlug($slug);

        if ($category) {
            $ideas    = $this->ideas->paginate(20, $category);
            $categories = $this->categories->hierarchy($category);

            return $this->response()->view('categories.view', compact('category', 'ideas', 'categories'));
        }

        throw new NotFoundHttpException;
    }
}