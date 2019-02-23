<?php

namespace Larahack\Entities\Ideas\Categories\Criteria;

use Sprocketbox\Articulate\Criteria\BaseCriteria;

class ForParent extends BaseCriteria
{
    private $category;

    public function __construct($category)
    {
        $this->category = $category;
    }

    /**
     * @param \Sprocketbox\Articulate\Sources\Illuminate\Builder $query
     *
     * @return void
     */
    public function perform($query): void
    {
        $query->where('parent_id', '=', is_numeric($this->category) ? $this->category : $this->category->id);
    }
}