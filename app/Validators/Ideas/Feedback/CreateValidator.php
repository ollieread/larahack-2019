<?php

namespace Larahack\Validators\Ideas\Feedback;

use Larahack\Support\Validator;

class CreateValidator extends Validator
{

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'content' => ['required'],
        ];
    }
}