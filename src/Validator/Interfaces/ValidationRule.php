<?php

namespace AdityaZanjad\Utils\Validator\Interfaces;


Interface ValidationRule
{

    /**
     * Perform validation on the given attribute.
     *
     * @param   string  $attribute
     * @param   mixed   $value
     *
     * @return  bool
     */
    public function check(string $attribute, mixed $value): bool;

    /**
     * Set the validation error message for this rule.
     *
     * @return string
     */
    public function message(): string;
}
