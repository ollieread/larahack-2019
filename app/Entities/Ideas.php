<?php

namespace Larahack\Entities;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
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

    public function paginate(int $count = 20): LengthAwarePaginator
    {
        return $this->ideaRepository->getPaginated($count);
    }

    public function find(int $id): ?Idea
    {
        return $this->ideaRepository->findOneById($id);
    }

    public function findBySlug(string $slug): ?Idea
    {
        return $this->ideaRepository->findOneBySlug($slug);
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

    }
}