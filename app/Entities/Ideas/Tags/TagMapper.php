<?php

namespace Larahack\Entities\Ideas\Tags;

use Sprocketbox\Articulate\Contracts\EntityMapping;
use Sprocketbox\Articulate\Entities\EntityMapper;

class TagMapper extends EntityMapper
{

    public function entity(): string
    {
        return Tag::class;
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
        $mapping->setTable('categories')
                ->setKey('id')
                ->setRepository(TagRepository::class);

        $mapping->int('id')->setImmutable();
        $mapping->string('name');
        $mapping->string('slug');
        $mapping->bool('active');
        $mapping->timestamps();
    }
}