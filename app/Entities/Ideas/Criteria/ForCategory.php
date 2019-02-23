<?php

namespace Larahack\Entities\Ideas\Criteria;

use Sprocketbox\Articulate\Criteria\BaseCriteria;

class ForCategory extends BaseCriteria
{
    /**
     * @var \Larahack\Entities\Ideas\Categories\Category|int
     */
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
        $query->where('category_id', '=', is_numeric($this->category) ? $this->category : $this->category->id);
    }
}