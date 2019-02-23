<?php

namespace Larahack\Entities\Users;

use Sprocketbox\Articulate\Contracts\EntityMapping;
use Sprocketbox\Articulate\Entities\EntityMapper;

class UserMapper extends EntityMapper
{
    public function entity(): string
    {
        return User::class;
    }

    public function source(): string
    {
        return 'illuminate';
    }

    /**
     * @param \Sprocketbox\Articulate\Contracts\EntityMapping|\Sprocketbox\Articulate\Sources\Illuminate\EntityMapping $mapping
     */
    public function map(EntityMapping $mapping)
    {
        $mapping->setTable('user')
                ->setKey('id')
                ->setRepository(UserRepository::class);

        $mapping->int('id')->setImmutable();
        $mapping->string('display_name');
        $mapping->string('name')->setDynamic();
        $mapping->string('first_name');
        $mapping->string('last_name');
        $mapping->string('email');
        $mapping->string('password');
        $mapping->string('remember_token');
        $mapping->bool('active');
        $mapping->bool('verified')->setDynamic();
        $mapping->timestamp('verified_at');
        $mapping->timestamps();
    }
}