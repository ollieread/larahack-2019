<?php

namespace Larahack\Entities\Ideas;

use Carbon\Carbon;
use Sprocketbox\Articulate\Entities\Entity;

/**
 * Class Idea
 *
 * @property-read int                       $id
 * @property int                            $userId
 * @property \Larahack\Entities\Users\User  $user
 * @property string                         $title
 * @property string                         $slug
 * @property string                         $excerpt
 * @property string                         $content
 * @property bool                           $active
 * @property \Carbon\Carbon                 $createdAt
 * @property \Carbon\Carbon                 $updatedAt
 *
 * @property \Illuminate\Support\Collection $feedback
 *
 * @package Larahack\Entities\Ideas
 */
class Idea extends Entity
{
    public function create(array $data): self
    {
        $this->user      = $data['user'];
        $this->userId    = $this->user->id;
        $this->title     = $data['title'];
        $this->slug      = $data['slug'];
        $this->excerpt   = $data['excerpt'];
        $this->content   = $data['content'];
        $this->active    = (bool) ($data['active'] ?? true);
        $this->createdAt = $this->updatedAt = Carbon::now();

        return $this;
    }
}