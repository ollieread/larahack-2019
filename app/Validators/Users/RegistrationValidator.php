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
            'email'    => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed'],
        ];
    }
}