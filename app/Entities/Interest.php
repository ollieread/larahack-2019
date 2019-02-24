<?php

namespace Larahack\Entities;

use Larahack\Entities\Ideas\Idea;
use Larahack\Entities\Ideas\Interests\Interest as InterestEntity;
use Larahack\Entities\Ideas\Interests\InterestRepository;
use Larahack\Entities\Users\User;
use Larahack\Validators\Ideas\Interest as Validators;

class Interest
{
    /**
     * @var \Larahack\Entities\Ideas\Interests\InterestRepository
     */
    private $interestRepository;

    /**
     * @var \Larahack\Entities\Users
     */
    private $users;

    public function __construct(InterestRepository $interestRepository, Users $users)
    {
        $this->interestRepository = $interestRepository;
        $this->users              = $users;
    }

    public function create(Idea $idea, array $data, ?User $user = null)
    {
        Validators\CreateValidator::validate($data);

        $data['user'] = $user ?? $this->users->user();
        $data['idea'] = $idea;

        $interest = (new InterestEntity)->create($data);

        if ($this->interestRepository->persist($interest)) {
            return $interest;
        }

        return null;
    }

    public function findUsersInterestInIdea(Idea $idea, User $user = null): ?InterestEntity
    {
        return $this->interestRepository->findOneByIdeaAndUser($idea, $user ?? $this->users->user());
    }

    public function update(InterestEntity $interest, array $input)
    {
        Validators\UpdateValidator::validate($input);

        $interest->update($input);

        if ($this->interestRepository->persist($interest)) {
            return true;
        }

        return false;
    }
}