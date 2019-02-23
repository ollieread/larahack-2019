<?php

namespace Larahack\Validators\Ideas;

use Illuminate\Validation\Rule;
use Larahack\Support\Validator;

/**
 * Class UpdateValidator
 *
 * @property \Larahack\Entities\Ideas\Idea $entity
 *
 * @package Larahack\Validators\Ideas
 */
class UpdateValidator extends Validator
{

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'title'   => ['required'],
            'slug'    => ['required', Rule::unique('ideas', 'slug')->ignore($this->entity->id)],
            'excerpt' => ['required'],
            'content' => ['required'],
        ];
    }
}