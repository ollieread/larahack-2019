<?php

namespace Larahack\Validators\Users;

use Larahack\Support\Validator;

class LoginValidator extends Validator
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ];
    }
}