<?php

namespace Larahack\Entities\Ideas\Categories;

use Larahack\Entities\Stats\CategoryStats;
use Sprocketbox\Articulate\Contracts\EntityMapping;
use Sprocketbox\Articulate\Entities\EntityMapper;

class CategoryMapper extends EntityMapper
{
    public function entity(): string
    {
        return Category::class;
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
                ->setRepository(CategoryRepository::class);

        $mapping->int('id')->setImmutable();
        $mapping->entity('stats', CategoryStats::class)->setDynamic();
        $mapping->string('name');
        $mapping->string('slug');
        $mapping->text('description');
        $mapping->bool('active');
        $mapping->timestamps();

        $mapping->entity('parent', Category::class)->setColumnName('parent_id');
        $mapping->entity('children', Category::class, true);

        $mapping->belongsTo('parent', 'parent_id');
        $mapping->hasMany('children', 'parent_id');
        $mapping->hasOne('stats', 'category_id');
    }
}