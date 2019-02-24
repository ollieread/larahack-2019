<?php

namespace Larahack\Entities\Ideas\Interests;

use Larahack\Entities\Ideas\Idea;
use Larahack\Entities\Users\User;
use Sprocketbox\Articulate\Contracts\EntityMapping;
use Sprocketbox\Articulate\Entities\EntityMapper;

class InterestMapper extends EntityMapper
{

    public function entity(): string
    {
        return Interest::class;
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
        $mapping->setTable('idea_interest')
                ->setKey('id')
                ->setRepository(InterestRepository::class);

        $mapping->int('id')->setImmutable();
        $mapping->entity('idea', Idea::class)->setColumnName('idea_id');
        $mapping->entity('user', User::class)->setColumnName('user_id');
        $mapping->bool('would_pay');
        $mapping->bool('would_newsletter');
        $mapping->bool('subscribe');
        $mapping->bool('active');
        $mapping->timestamps();
    }
}