<?php

namespace Larahack\Entities\Ideas\Interests;

use Larahack\Entities\Ideas\Idea;
use Larahack\Entities\Users\User;
use Larahack\Support\Repository;

class InterestRepository extends Repository
{

    /**
     * @param \Larahack\Entities\Ideas\Idea $idea
     * @param \Larahack\Entities\Users\User $user
     *
     * @return \Larahack\Entities\Interest|null
     */
    public function findOneByIdeaAndUser(Idea $idea, User $user): ?Interest
    {
        return $this->criteriaQuery()
                    ->where('idea_id', '=', $idea->id)
                    ->where('user_id', '=', $user->id)
                    ->first();
    }
}