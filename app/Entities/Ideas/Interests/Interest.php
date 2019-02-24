<?php

namespace Larahack\Entities\Ideas\Interests;

use Carbon\Carbon;
use Sprocketbox\Articulate\Entities\Entity;

/**
 * Class Interest
 *
 * @property-read int                      $id
 * @property int                           $ideaId
 * @property \Larahack\Entities\Ideas\Idea $idea
 * @property int                           $userId
 * @property \Larahack\Entities\Users\User $user
 * @property bool                          $wouldPay
 * @property bool                          $wouldNewsletter
 * @property bool                          $subscribe
 * @property bool                          $active
 * @property \Carbon\Carbon                $createdAt
 * @property \Carbon\Carbon                $updatedAt
 *
 * @package Larahack\Entities\Ideas\Interests
 */
class Interest extends Entity
{
    public function create(array $data): self
    {
        $this->idea            = $data['idea'];
        $this->ideaId          = $this->idea->id;
        $this->wouldPay        = (bool) ($data['would_pay'] ?? false);
        $this->wouldNewsletter = (bool) ($data['would_newsletter'] ?? false);
        $this->subscribe       = (bool) ($data['subscribe'] ?? false);
        $this->active          = (bool) ($data['active'] ?? true);
        $this->createdAt       = $this->updatedAt = Carbon::now();

        return $this;
    }

    public function update(array $data): self
    {
        if (isset($data['would_pay'])) {
            $this->wouldPay = (bool) $data['would_pay'];
        }

        if (isset($data['would_newsletter'])) {
            $this->wouldNewsletter = (bool) $data['would_newsletter'];
        }

        if (isset($data['subscribe'])) {
            $this->subscribe = (bool) $data['subscribe'];
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