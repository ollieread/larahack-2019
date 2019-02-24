<?php

namespace Larahack\Entities\Ideas\Categories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Larahack\Support\Repository;

class CategoryRepository extends Repository
{

    public function getAll(?int $count = 0)
    {
        $query = $this->criteriaQuery()->select('categories.*');

        if ($count) {
            $query->limit($count);
        }

        return $query->get();
    }

    public function findOneBySlug(string $slug)
    {
        return $this->criteriaQuery()
                    ->where('slug', '=', $slug)
                    ->first();
    }

    public function findOneById(int $id)
    {
        return $this->criteriaQuery()
                    ->where('id', '=', $id)
                    ->first();
    }


    public function getPaginated(int $count): LengthAwarePaginator
    {
        return $this->paginate($this->criteriaQuery()->select('categories.*'), $count);
    }
}