<?php

namespace Larahack\Entities\Ideas;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Larahack\Support\Repository;

class IdeaRepository extends Repository
{
    public function getPaginated(int $count): LengthAwarePaginator
    {
        return $this->paginate($this->criteriaQuery()->select('ideas.*'), $count);
    }

    public function findOneBySlug(string $slug): ?Idea
    {
        return $this->criteriaQuery()
                    ->select('ideas.*')
                    ->where('slug', '=', $slug)
                    ->first();
    }

    public function findOneById(int $id): ?Idea
    {
        return $this->criteriaQuery()
                    ->select('ideas.*')
                    ->where('id', '=', $id)
                    ->first();
    }

    public function getAll(?int $count = 0)
    {
        $query = $this->criteriaQuery()->select('ideas.*');

        if ($count) {
            $query->limit($count);
        }

        return $query->get();
    }
}