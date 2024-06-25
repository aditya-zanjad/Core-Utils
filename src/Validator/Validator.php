<?php

namespace AdityaZanjad\Utils\Validator;

use AdityaZanjad\Utils\Validator\Interfaces\ValidationRule;

class Validator
{
    protected array $data;

    protected array $rules;

    protected array $messages;

    protected ErrorsCollection $errors;

    protected bool $stopOnFirstFailure;


    public function __construct(array $data, array $rules, array $messages = [], null|ErrorsCollection $errors)
    {
        $this->data     =   $data;
        $this->rules    =   $rules;
        $this->messages =   $messages;
        $this->errors   =   $errors ?? new ErrorsCollection();
    }


    public function validate()
    {
        //
    }

    public function failed()
    {
        //
    }

    public function assertStringRule(string $attributePath, string $rule)
    {
        //
    }

    public function assertClosureRule(string $attributePath, callable $rule)
    {
        //
    }

    public function assertInstanceRule(string $attributePath, ValidationRule $rule)
    {
        //
    }
}
