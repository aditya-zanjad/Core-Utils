<?php

namespace AdityaZanjad\Utils\Validator;

use AdityaZanjad\Utils\Arr\Arr;
use AdityaZanjad\Utils\Str\Str;


class ErrorsCollection
{
    protected array $errors;

    public function __construct()
    {
        //
    }

    public function add(string $key, string $message = 'The :{attribute} ID is invalid'): static
    {
        Arr::set($this->errors, $key, Str::replace($message, ':{attribute}', $key));
        return $this;
    }

    public function all(): array
    {
        return $this->errors;
    }

    public function first(bool|string $key = false): null|string
    {
        if ($key !== false && array_key_exists($key, $this->errors)) {
            return Arr::first($this->errors[$key]);
        }

        return Arr::first($this->errors);
    }
}
