<?php

namespace Larahack\Entities\Ideas\Categories;

use Carbon\Carbon;
use Sprocketbox\Articulate\Entities\Entity;

/**
 * Class Category
 *
 * @property-read int                                          $id
 * @property int                                               $parentId
 * @property \Larahack\Entities\Ideas\Categories\Category|null $parent
 * @property string                                            $name
 * @property string                                            $slug
 * @property string                                            $description
 * @property bool                                              $active
 * @property \Carbon\Carbon                                    updatedAt
 * @property \Carbon\Carbon                                    createdAt
 *
 * @property \Illuminate\Support\Collection                    $children
 *
 * @package Larahack\Entities\Ideas\Categories
 */
class Category extends Entity
{
    public function create(array $data): self
    {
        $this->parent      = $data['parent'] ?? null;
        $this->parentId    = $this->parent->id ?? null;
        $this->name        = $data['name'];
        $this->slug        = $data['slug'];
        $this->description = $data['description'];
        $this->active      = (bool) ($data['active'] ?? true);
        $this->createdAt   = $this->updatedAt = Carbon::now();

        return $this;
    }
}