<?php

namespace Larahack\Support;

use Sprocketbox\Articulate\Sources\Illuminate\Repository as BaseRepository;

abstract class Repository extends BaseRepository
{
    /**
     * @return \Sprocketbox\Articulate\Sources\Illuminate\Builder
     */
    protected function criteriaQuery()
    {
        return $this->applyCriteria($this->query());
    }
}