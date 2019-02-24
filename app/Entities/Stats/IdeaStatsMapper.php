<?php

namespace Larahack\Entities\Stats;

use Larahack\Entities\Ideas\Idea;
use Sprocketbox\Articulate\Contracts\EntityMapping;
use Sprocketbox\Articulate\Entities\EntityMapper;

class IdeaStatsMapper extends EntityMapper
{

    public function entity(): string
    {
        return IdeaStats::class;
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
        $mapping->setTable('idea_stats')
                ->setRepository(IdeaStatsRepository::class)
                ->setReadOnly();

        $mapping->int('feedback_count');
        $mapping->int('interest_count');
        $mapping->int('would_pay_count');
        $mapping->int('would_newsletter_count');
        $mapping->entity('idea', Idea::class)->setColumnName('idea_id');
    }
}