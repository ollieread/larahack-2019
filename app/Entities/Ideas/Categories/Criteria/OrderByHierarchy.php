<?php

namespace Larahack\Entities\Ideas\Categories\Criteria;

use Illuminate\Database\Query\Expression;
use Sprocketbox\Articulate\Criteria\BaseCriteria;

class OrderByHierarchy extends BaseCriteria
{

    /**
     * @param \Sprocketbox\Articulate\Sources\Illuminate\Builder $query
     *
     * @return void
     */
    public function perform($query): void
    {
        $query->orderBy(new Expression('COALESCE(categories.parent_id, categories.id), categories.parent_id IS NOT NULL, id'), 'DESC');
    }
}