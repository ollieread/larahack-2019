<?php

namespace Larahack\Entities;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Larahack\Entities\Ideas\Categories\Category;
use Larahack\Entities\Ideas\Criteria\ForCategory;
use Larahack\Entities\Ideas\Criteria\OrderByRecent;
use Larahack\Entities\Ideas\Criteria\OrderByTop;
use Larahack\Entities\Ideas\Criteria\WithCategory;
use Larahack\Entities\Ideas\Criteria\WithUser;
use Larahack\Entities\Ideas\Idea;
use Larahack\Entities\Ideas\IdeaRepository;
use Larahack\Entities\Stats\Criteria\WithStats;
use Larahack\Entities\Users\User;
use Larahack\Validators\Ideas as Validators;

class Ideas
{
    /**
     * @var \Larahack\Entities\Ideas\IdeaRepository
     */
    private $ideaRepository;

    /**
     * @var \Larahack\Entities\Users
     */
    private $users;

    public function __construct(IdeaRepository $ideaRepository, Users $users)
    {
        $this->ideaRepository = $ideaRepository;
        $this->users          = $users;
    }

    public function all(int $count = 20, bool $paginate = false, ?Category $category = null)
    {
        if ($category) {
            $this->ideaRepository->pushCriteria(new ForCategory($category));
        } else {
            $this->ideaRepository->pushCriteria(new WithCategory);
        }

        $this->ideaRepository->pushCriteria(new WithUser, new WithStats);

        if ($paginate) {
            $results = $this->ideaRepository->getPaginated($count);

            if ($category) {
                // If we provided a category we will set that relationship on all of the items,
                // because we didn't ask for it to be queried as we already have it
                foreach ($results->items() as $idea) {
                    $idea->category   = $category;
                    $idea->categoryId = $category->id;
                }
            }
        } else {
            $results = $this->ideaRepository->getAll($count);

            if ($category) {
                $results->each(function (Idea $idea) use ($category) {
                    $idea->category   = $category;
                    $idea->categoryId = $category->id;
                });
            }
        }

        return $results;
    }

    public function paginate(int $count = 20, ?Category $category = null): LengthAwarePaginator
    {
        $this->ideaRepository->resetCriteria();

        return $this->all($count, true, $category);
    }

    public function find(int $id): ?Idea
    {
        return $this->ideaRepository->findOneById($id);
    }

    public function findBySlug(string $slug): ?Idea
    {
        return $this->ideaRepository->pushCriteria(new WithCategory, new WithUser)->findOneBySlug($slug);
    }

    public function create(array $data, ?User $user = null): ?Idea
    {
        Validators\CreateValidator::validate($data);

        $idea       = (new Idea)->create($data);
        $idea->user = $user ?? $this->users->user();

        if ($this->ideaRepository->persist($idea)) {
            return $idea;
        }

        return null;
    }

    public function update(Idea $idea, array $data): bool
    {
        Validators\UpdateValidator::validate($data);

        $idea->update($data);

        return $this->ideaRepository->persist($idea) !== null;
    }

    public function recent(int $count, bool $paginate = false, ?Category $category = null)
    {
        $this->ideaRepository->resetCriteria();
        $this->ideaRepository->pushCriteria(new OrderByRecent);

        return $this->all($count, $paginate, $category);
    }

    public function top(int $count, bool $paginate = false, ?Category $category = null)
    {
        $this->ideaRepository->resetCriteria();
        $this->ideaRepository->pushCriteria(new OrderByTop);

        return $this->all($count, $paginate, $category);
    }
}