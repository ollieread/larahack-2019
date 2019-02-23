<?php

namespace Larahack\Entities\Ideas\Feedback;

use Larahack\Entities\Ideas\Idea;
use Larahack\Entities\Users\User;
use Sprocketbox\Articulate\Contracts\EntityMapping;
use Sprocketbox\Articulate\Entities\EntityMapper;

class FeedbackMapper extends EntityMapper
{

    public function entity(): string
    {
        return Feedback::class;
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
        $mapping->setTable('idea_feedback')
                ->setKey('id')
                ->setRepository(FeedbackRepository::class);

        $mapping->int('id')->setImmutable();
        $mapping->entity('idea', Idea::class)->setColumnName('idea_id');
        $mapping->entity('user', User::class)->setColumnName('user_id');
        $mapping->text('content');
        $mapping->timestamps();

        $mapping->belongsTo('idea', 'idea_id');
        $mapping->belongsTo('user', 'user_id');
    }
}