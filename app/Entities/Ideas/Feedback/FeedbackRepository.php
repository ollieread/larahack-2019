<?php

namespace Larahack\Entities\Ideas\Feedback;

use Larahack\Entities\Ideas\Idea;
use Larahack\Support\Repository;

class FeedbackRepository extends Repository
{

    public function findForIdea(Idea $idea)
    {
        return $this->criteriaQuery()
                    ->with('user')
                    ->where('idea_id', '=', $idea->id)
                    ->get();
    }
}