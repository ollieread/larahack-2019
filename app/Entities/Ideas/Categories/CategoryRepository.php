<?php

namespace Larahack\Entities\Ideas\Categories;

use Larahack\Support\Repository;

class CategoryRepository extends Repository
{

    public function getAll()
    {
        return $this->criteriaQuery()->get();
    }
}