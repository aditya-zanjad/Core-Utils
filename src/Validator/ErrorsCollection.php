<?php

namespace AdityaZanjad\Utils\Validator;

use AdityaZanjad\Utils\Arr\Arr;
use AdityaZanjad\Utils\Str\Str;


class ErrorsCollection
{
    /**
     * To contain all of the validation errors.
     *
     * @var <string, array<string, string>> $errors
     */
    protected array $errors;

    /**
     * Indicates if any validation error has occurred after validation has been completely performed.
     *
     * @var bool $hasErrors
     */
    protected bool $hasErrors;

    /**
     * Check if any validation has occurred.
     *
     * @return bool
     */
    public function any(): bool
    {
        return $this->hasErrors ??= !empty($this->errors);
    }

    /**
     * Register given validation error message.
     *
     * @param   string  $key
     * @param   string  $message
     *
     * @return  static
     */
    public function add(string $key, string $message = 'The :{attribute} ID is invalid'): static
    {
        Arr::set($this->errors, $key, Str::replace($message, ':{attribute}', $key));
        return $this;
    }

    /**
     * Get all of the validation error messages.
     *
     * @return array<string, array<string, string>>
     */
    public function all(): array
    {
        return $this->errors;
    }

    /**
     * Get the first error depending on the given parameter.
     *
     * If the attribute name is given, then this method will get first error message of that attribute
     * from the errors array. Otherwise, it'll get the first error message of the first attribute
     * from the errors array.
     *
     * @param string|null $key
     * @return null|string
     */
    public function first(?string $key): null|string
    {
        if (!is_null($key) && array_key_exists($key, $this->errors)) {
            return Arr::first($this->errors[$key], null);
        }

        $firstField = Arr::first($this->errors, null);

        if (is_null($firstField)) {
            return null;
        }

        return Arr::first($firstField, null);
    }
}
