<?php

namespace Larahack\Entities\Stats\Criteria;

use Sprocketbox\Articulate\Criteria\BaseCriteria;

class WithStats extends BaseCriteria
{

    /**
     * @param \Sprocketbox\Articulate\Sources\Illuminate\Builder $query
     *
     * @return void
     */
    public function perform($query): void
    {
        $query->with('stats');
    }
}