<?php

namespace AdityaZanjad\Utils\Validator\Interfaces;


Interface ValidationRule
{

    public function check(string $attribute, mixed $value): bool;

    public function message(): string;
}
