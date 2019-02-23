<?php

namespace Larahack\Entities;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Larahack\Entities\Ideas\Categories\Category;
use Larahack\Entities\Ideas\Criteria\ForCategory;
use Larahack\Entities\Ideas\Criteria\WithCategory;
use Larahack\Entities\Ideas\Idea;
use Larahack\Entities\Ideas\IdeaRepository;
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

    public function paginate(int $count = 20, ?Category $category = null): LengthAwarePaginator
    {
        if ($category) {
            $this->ideaRepository->pushCriteria(new ForCategory($category));
        } else {
            $this->ideaRepository->pushCriteria(new WithCategory);
        }

        $results = $this->ideaRepository->getPaginated($count);

        if ($category) {
            // If we provided a category we will set that relationship on all of the items,
            // because we didn't ask for it to be queried as we already have it
            foreach ($results->items() as $idea) {
                $idea->category   = $category;
                $idea->categoryId = $category->id;
            }
        }

        return $results;
    }

    public function find(int $id): ?Idea
    {
        return $this->ideaRepository->findOneById($id);
    }

    public function findBySlug(string $slug): ?Idea
    {
        return $this->ideaRepository->pushCriteria(new WithCategory)->findOneBySlug($slug);
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
}