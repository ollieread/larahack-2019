<?php

namespace Larahack\Entities\Ideas\Tags;

use Carbon\Carbon;
use Sprocketbox\Articulate\Entities\Entity;

/**
 * Class Tag
 *
 * @property-read int       $id
 * @property string         $name
 * @property string         $slug
 * @property bool           $active
 * @property \Carbon\Carbon updatedAt
 * @property \Carbon\Carbon createdAt
 *
 * @package Larahack\Entities\Ideas\Tags
 */
class Tag extends Entity
{
    public function create(array $data): self
    {
        $this->name      = $data['name'];
        $this->slug      = $data['slug'];
        $this->active    = (bool) ($data['active'] ?? true);
        $this->createdAt = $this->updatedAt = Carbon::now();

        return $this;
    }
}