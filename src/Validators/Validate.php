<?php
namespace gs\Validators;
use gs\Validator;

abstract class Validate{

    protected $data;

    protected $v;

    public function __construct(array $data)
    {
        $this->data = $data;
        $this->v = new Validator($data);
    }

    public function validate(): bool
    {
        return $this->v->validate();
    }

    public function errors(): array
    {
        return $this->v->errors();
    }

}