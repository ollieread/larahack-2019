<?php

namespace Larahack\Entities\Ideas\Feedback\Criteria;

use Sprocketbox\Articulate\Criteria\BaseCriteria;

class OrderByRecentAndParent extends BaseCriteria
{

    /**
     * @param \Sprocketbox\Articulate\Sources\Illuminate\Builder $query
     *
     * @return void
     */
    public function perform($query): void
    {
        $query->orderBy('idea_feedback.created_at', 'desc');
    }
}