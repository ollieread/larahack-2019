<?php

namespace Larahack\Entities;

use Illuminate\Support\Collection;
use Larahack\Entities\Ideas\Categories\Category;
use Larahack\Entities\Ideas\Categories\CategoryRepository;

class Categories
{
    /**
     * @var \Larahack\Entities\Ideas\Categories\CategoryRepository
     */
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function hierarchy(): Collection
    {
        // Get all categories and make their key their id
        $categories = $this->categoryRepository->getAll()->keyBy('id');
        // Cycle through the categories and append to the child of their parent, if they have one
        $categories->each(function (Category $category) use ($categories) {
            if ($category->parentId) {
                $parent = $categories->get($category->parentId);

                if ($parent) {
                    if (!$parent->children) {
                        $parent->children = new Collection;
                    }

                    $parent->children->push($category);
                }
            }
        });

        // Return only root categories, it, categories that do not have a parent
        return $categories->filter(function (Category $category) {
            return $category->parentId === null;
        });
    }
}