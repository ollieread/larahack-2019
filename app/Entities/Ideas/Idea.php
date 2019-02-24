<?php

namespace Larahack\Entities\Ideas;

use Carbon\Carbon;
use Sprocketbox\Articulate\Entities\Entity;

/**
 * Class Idea
 *
 * @property-read int                                     $id
 * @property int                                          $userId
 * @property \Larahack\Entities\Users\User                $user
 * @property int                                          $categoryId
 * @property \Larahack\Entities\Ideas\Categories\Category $category
 * @property \Larahack\Entities\Stats\IdeaStats           $stats
 * @property string                                       $title
 * @property string                                       $slug
 * @property string                                       $excerpt
 * @property string                                       $content
 * @property bool                                         $active
 * @property \Carbon\Carbon                               $createdAt
 * @property \Carbon\Carbon                               $updatedAt
 *
 * @property \Illuminate\Support\Collection               $feedback
 * @property \Illuminate\Support\Collection               $tags
 *
 * @package Larahack\Entities\Ideas
 */
class Idea extends Entity
{
    public function create(array $data): self
    {
        $this->user       = $data['user'];
        $this->userId     = $this->user->id;
        $this->category   = $data['category'];
        $this->categoryId = $this->category->id;
        $this->title      = $data['title'];
        $this->slug       = $data['slug'];
        $this->excerpt    = $data['excerpt'];
        $this->content    = $data['content'];
        $this->active     = (bool) ($data['active'] ?? true);
        $this->createdAt  = $this->updatedAt = Carbon::now();

        return $this;
    }

    public function update(array $data): self
    {
        if (isset($data['user'])) {
            $this->user   = $data['user'];
            $this->userId = $this->user->id;
        }

        if (isset($data['category'])) {
            $this->category   = $data['category'];
            $this->categoryId = $this->category->id;
        }

        if (isset($data['title'])) {
            $this->title = $data['title'];
        }

        if (isset($data['slug'])) {
            $this->slug = $data['slug'];
        }

        if (isset($data['excerpt'])) {
            $this->excerpt = $data['excerpt'];
        }

        if (isset($data['content'])) {
            $this->content = $data['content'];
        }

        if (isset($data['active'])) {
            $this->active = (bool) $data['active'];
        }

        if ($this->isDirty()) {
            $this->updatedAt = Carbon::now();
        }

        return $this;
    }
}