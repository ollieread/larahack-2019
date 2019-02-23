<?php

namespace Larahack\Entities\Ideas;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Larahack\Support\Repository;

class IdeaRepository extends Repository
{
    public function getPaginated(int $count): LengthAwarePaginator
    {
        return $this->paginate($this->criteriaQuery(), $count);
    }

    public function findOneBySlug(string $slug): ?Idea
    {
        return $this->criteriaQuery()
                    ->where('slug', '=', $slug)
                    ->first();
    }

    public function findOneById(int $id): ?Idea
    {
        return $this->criteriaQuery()
                    ->where('id', '=', $id)
                    ->first();
    }
}