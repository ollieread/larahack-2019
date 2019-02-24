<?php

namespace Larahack\Entities;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Larahack\Entities\Ideas\Categories\Category;
use Larahack\Entities\Ideas\Categories\CategoryRepository;
use Larahack\Entities\Ideas\Categories\Criteria\ForParent;
use Larahack\Entities\Stats\Criteria\WithStats;

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
     * @param \Larahack\Entities\Ideas\Categories\Category|null $category
     *
     * @return \Illuminate\Support\Collection
     */
    public function hierarchy(?Category $category = null): Collection
    {
        // Get all categories and make their key their id
        if ($category) {
            $this->categoryRepository->pushCriteria(new ForParent($category));
        }

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

        if ($category) {
            return $categories;
        }

        // Return only root categories, it, categories that do not have a parent
        return $categories->filter(function (Category $category) {
            return $category->parentId === null;
        });
    }

    public function findOneBySlug(string $slug)
    {
        $this->categoryRepository->pushCriteria(new WithStats);

        return $this->categoryRepository->findOneBySlug($slug);
    }

    public function findOneById(int $id)
    {
        return $this->categoryRepository->findOneById($id);
    }

    public function all(int $count = 20, bool $paginate = false, ?Category $category = null)
    {
        $this->categoryRepository->pushCriteria(new WithStats);

        if ($paginate) {
            return $this->categoryRepository->getPaginated($count);
        }

        return $this->categoryRepository->getAll($count);
    }

    public function paginate(int $count = 20, ?Category $category = null): LengthAwarePaginator
    {
        $this->categoryRepository->resetCriteria();

        return $this->all($count, true, $category);
    }
}