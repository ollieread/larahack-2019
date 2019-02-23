<?php

namespace Larahack\Entities\Ideas\Feedback;

use Carbon\Carbon;
use Sprocketbox\Articulate\Entities\Entity;

/**
 * Class Feedback
 *
 * @property-read int                      $id
 * @property int                           $ideaId
 * @property \Larahack\Entities\Ideas\Idea $idea
 * @property int                           $userId
 * @property \Larahack\Entities\Users\User $user
 * @property string                        $content
 * @property \Carbon\Carbon                $createdAt
 * @property \Carbon\Carbon                $updatedAt
 *
 * @package Larahack\Entities\Ideas\Feedback
 */
class Feedback extends Entity
{

    public function create(array $data): self
    {
        $this->idea      = $data['idea'];
        $this->ideaId    = $this->idea->id;
        $this->user      = $data['user'];
        $this->userId    = $this->user->id;
        $this->content   = $data['content'];
        $this->createdAt = $this->updatedAt = Carbon::now();

        return $this;
    }
}