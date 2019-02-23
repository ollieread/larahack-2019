<?php

namespace Larahack\Validators\Ideas;

use Illuminate\Validation\Rule;
use Larahack\Support\Validator;

class CreateValidator extends Validator
{

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'title'   => ['required'],
            'slug'    => ['required', Rule::unique('ideas', 'slug')],
            'excerpt' => ['required'],
            'content' => ['required'],
        ];
    }
}