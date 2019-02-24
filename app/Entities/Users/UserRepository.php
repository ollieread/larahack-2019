<?php

namespace Larahack\Entities\Users;

use Illuminate\Contracts\Auth\Authenticatable;
use Larahack\Support\Repository;
use Sprocketbox\Articulate\Sources\Illuminate\Auth\AuthRepository;

class UserRepository extends Repository implements AuthRepository
{
    /**
     * Retrieve a user by their unique identifier.
     *
     * @param  mixed $identifier
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveById($identifier): ?Authenticatable
    {
        return $this->criteriaQuery()
                    ->where('id', '=', $identifier)
                    ->first();
    }

    /**
     * Retrieve a user by their unique identifier and "remember me" token.
     *
     * @param  mixed  $identifier
     * @param  string $token
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByToken($identifier, $token): ?Authenticatable
    {
        return $this->criteriaQuery()
                    ->where('id', '=', $identifier)
                    ->where((new User)->getRememberTokenName(), '=', $token)
                    ->first();
    }

    /**
     * Update the "remember me" token for the given user in storage.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable|\Larahack\Entities\Users\User $user
     * @param  string                                                                   $token
     *
     * @return void
     */
    public function updateRememberToken(Authenticatable $user, $token): void
    {
        $user->setRememberToken($token);
        $this->persist($user);
    }

    /**
     * Retrieve a user by the given credentials.
     *
     * @param  array $credentials
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null|\Larahack\Entities\Users\User
     */
    public function retrieveByCredentials(array $credentials): ?Authenticatable
    {
        $queryCredentials = array_except($credentials, 'password');
        $query            = $this->criteriaQuery();

        foreach ($queryCredentials as $column => $value) {
            $query->where($column, '=', $value);
        }

        return $query->first();
    }

    /**
     * @param int $id
     *
     * @return null|\Larahack\Entities\Users\User
     */
    public function findOneByid(int $id)
    {
        return $this->retrieveById($id);
    }

    public function getAll(?int $count = 0)
    {
        $query = $this->criteriaQuery()->select('users.*');

        if ($count) {
            $query->limit($count);
        }

        return $query->get();
    }
}