<?php

namespace Larahack\Entities\Ideas\Criteria;

use Illuminate\Database\Query\JoinClause;
use Sprocketbox\Articulate\Criteria\BaseCriteria;

class OrderByTop extends BaseCriteria
{

    /**
     * @param \Sprocketbox\Articulate\Sources\Illuminate\Builder $query
     *
     * @return void
     */
    public function perform($query): void
    {
        $query->rightJoin('idea_stats', function (JoinClause $join) {
            $join->on('idea_stats.idea_id', '=', 'ideas.id');
        })->orderBy('idea_stats.interest_count', 'desc');
    }
}