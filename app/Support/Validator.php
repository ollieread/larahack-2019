<?php

namespace Larahack\Support;

use Illuminate\Container\Container;
use Illuminate\Contracts\Validation\Factory;
use Illuminate\Contracts\Validation\Validator as ValidatorContract;
use Illuminate\Validation\ValidationException;
use Sprocketbox\Articulate\Entities\Entity;

abstract class Validator
{
    /**
     * @var \Sprocketbox\Articulate\Entities\Entity
     */
    protected $entity;

    /**
     * @var array
     */
    protected $data;

    /**
     * @var array
     */
    protected $extra = [];

    /**
     * @var \Illuminate\Contracts\Validation\Validator
     */
    protected $validator;

    /**
     * BaseValidator constructor.
     *
     * @param array                                        $data
     * @param null|\Sprocketbox\Articulate\Entities\Entity $entity
     */
    private function __construct(array $data = [], ?Entity $entity = null)
    {
        $this->data   = $data;
        $this->entity = $entity;
    }

    /**
     * @param array                                        $data
     * @param null|\Sprocketbox\Articulate\Entities\Entity $entity
     * @param array                                        $extra
     *
     * @return \Larahack\Support\Validator
     */
    public static function validate(array $data = [], ?Entity $entity = null, array $extra = []): self
    {
        $validator = new static($data, $entity);
        $validator->setExtra($extra);
        $validator->fire();

        return $validator;
    }

    public function setExtra(array $extra)
    {
        $this->extra = $extra;
    }

    /**
     * @return array
     */
    abstract public function rules(): array;

    /**
     * @return array
     */
    protected function data(): array
    {
        return $this->data;
    }

    /**
     * @return array
     */
    protected function messages(): array
    {
        return [];
    }

    /**
     * @return array
     */
    protected function attributes(): array
    {
        return [];
    }

    protected function preValidation(): void
    {
    }

    /**
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(): ValidatorContract
    {
        if (!$this->validator) {
            $this->validator = $this->makeValidator();
        }

        return $this->validator;
    }

    /**
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function makeValidator(): ValidatorContract
    {
        $factory = Container::getInstance()->make(Factory::class);

        return $factory->make($this->data(), $this->rules(), $this->messages());
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failed(): void
    {
        throw new ValidationException($this->validator);
    }

    /**
     * @return bool
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function fire(): bool
    {
        $validator = $this->validator();
        $this->preValidation();

        if ($validator->fails()) {
            $this->failed();
        }

        return true;
    }
}