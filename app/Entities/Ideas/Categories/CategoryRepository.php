<?php

namespace Larahack\Entities\Ideas\Categories;

use Larahack\Support\Repository;

class CategoryRepository extends Repository
{

    public function getAll()
    {
        return $this->criteriaQuery()->get();
    }

    public function findOneBySlug(string $slug)
    {
        return $this->criteriaQuery()
                    ->where('slug', '=', $slug)
                    ->first();
    }
}