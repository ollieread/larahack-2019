<?php

namespace Larahack\Validators\Users;

use Illuminate\Validation\Rule;
use Larahack\Support\Validator;

class RegistrationValidator extends Validator
{

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'display_name' => [],
            'first_name'   => ['required'],
            'last_name'    => ['required'],
            'email'        => ['required', 'email', Rule::unique('users', 'email')],
            'password'     => ['required', 'confirmed'],
        ];
    }
}