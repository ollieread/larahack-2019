<?php

namespace Larahack\Entities\Stats;

use Larahack\Entities\Ideas\Categories\Category;
use Sprocketbox\Articulate\Contracts\EntityMapping;
use Sprocketbox\Articulate\Entities\EntityMapper;

class CategoryStatsMapper extends EntityMapper
{

    public function entity(): string
    {
        return CategoryStats::class;
    }

    public function source(): string
    {
        return 'illuminate';
    }

    /**
     * @param \Sprocketbox\Articulate\Contracts\EntityMapping|\Sprocketbox\Articulate\Sources\Illuminate\EntityMapping $mapping
     */
    public function map(EntityMapping $mapping)
    {
        $mapping->setTable('category_stats')
                ->setRepository(CategoryStatsRepository::class)
                ->setReadOnly();

        $mapping->entity('category', Category::class)->setColumnName('category_id');
        $mapping->int('idea_count');
        $mapping->int('user_count');
        $mapping->int('feedback_count');
        $mapping->int('feedback_user_count');
    }
}