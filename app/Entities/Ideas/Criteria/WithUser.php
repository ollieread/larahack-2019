<?php

namespace Larahack\Entities\Ideas\Criteria;

use Sprocketbox\Articulate\Criteria\BaseCriteria;

class WithUser extends BaseCriteria
{

    /**
     * @param \Sprocketbox\Articulate\Sources\Illuminate\Builder $query
     *
     * @return void
     */
    public function perform($query): void
    {
        $query->with('user');
    }
}