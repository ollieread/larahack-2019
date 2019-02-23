<?php

namespace Larahack\Entities\Ideas;

use Larahack\Entities\Users\User;
use Sprocketbox\Articulate\Contracts\EntityMapping;
use Sprocketbox\Articulate\Entities\EntityMapper;

class IdeaMapper extends EntityMapper
{
    public function entity(): string
    {
        return Idea::class;
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
        $mapping->setTable('ideas')
                ->setKey('id')
                ->setRepository(IdeaRepository::class);

        $mapping->int('id')->setImmutable();
        $mapping->entity('user', User::class)->setColumnName('user_id');
        $mapping->string('title');
        $mapping->string('slug');
        $mapping->text('excerpt');
        $mapping->text('content');
        $mapping->bool('active');
        $mapping->timestamps();
    }
}