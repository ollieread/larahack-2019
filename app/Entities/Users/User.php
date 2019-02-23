<?php

namespace Larahack\Entities\Users;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\Authenticatable;
use Sprocketbox\Articulate\Entities\Entity;

/**
 * Class User
 *
 * @property-read int       $id
 * @property string         $displayName
 * @property string         $name
 * @property string         $firstName
 * @property string         $lastName
 * @property string         $email
 * @property string         $password
 * @property string         $rememberToken
 * @property bool           $active
 * @property-read bool      $verified
 * @property \Carbon\Carbon $verifiedAt
 * @property \Carbon\Carbon $createdAt
 * @property \Carbon\Carbon $updatedAt
 *
 * @package Larahack\Entities\Users
 */
class User extends Entity implements Authenticatable
{
    public function create(array $data): self
    {
        $this->displayName = $data['display_name'];
        $this->firstName   = $data['first_name'];
        $this->lastName    = $data['last_name'];
        $this->email       = $data['email'];
        $this->password    = $data['password'];
        $this->active      = (bool) ($data['active'] ?? false);
        $this->verifiedAt  = $data['verified_at'] ?? null;
        $this->createdAt   = $this->updatedAt = Carbon::now();

        return $this;
    }

    public function getDisplayName(): string
    {
        return $this->getAttribute('display_name') ?? $this->getName();
    }

    public function getName(): string
    {
        return $this->firstName . ' ' . $this->lastName;
    }

    public function getVerified(): bool
    {
        return $this->verifiedAt !== null;
    }

    /**
     * Get the name of the unique identifier for the user.
     *
     * @return string
     */
    public function getAuthIdentifierName(): string
    {
        return 'id';
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->getAttribute($this->getAuthIdentifierName());
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword(): string
    {
        return $this->getAttribute('password');
    }

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string
     */
    public function getRememberToken(): ?string
    {
        return $this->getAttribute($this->getRememberTokenName());
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param  string $value
     *
     * @return void
     */
    public function setRememberToken($value)
    {
        $this->setAttribute($this->getRememberTokenName(), $value);
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName(): string
    {
        return 'remember_token';
    }
}