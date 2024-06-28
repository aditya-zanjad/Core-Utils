<?php

namespace AdityaZanjad\Utils\Validator;

use AdityaZanjad\Utils\Arr\Arr;
use AdityaZanjad\Utils\Validator\Interfaces\ValidationRule;


class Validator
{
    /**
     * The input data that we want to validate.
     *
     * @var array<int|string, mixed> $data
     */
    protected array $data;

    /**
     * The validation rules that we want to apply on the given input data.
     *
     * @var array<string, string|array<int, string|\AdityaZanjad\Utils\Validator\Interfaces\ValidationRule>> $data
     */
    protected array $rules;

    /**
     * The custom validation error messages to use instead of the default ones for the specified rule attributes.
     *
     * @var array<string, array<string, string>> $messages
     */
    protected array $messages;

    /**
     * To mange validation errors.
     *
     * For example, registering a new validation error, fetching a particular OR all errors etc.
     *
     * @var \AdityaZanjad\Utils\Validator\ErrorsCollection $errors
     */
    protected ErrorsCollection $errors;

    /**
     * Indicates whether to stop or not as soon as the first validation error occurs.
     *
     * @var array<string, mixed> $options
     */
    protected array $options;

    /**
     * Inject necessary data & dependencies into the class.
     *
     * @param   array<int|string, mixed>                                                                            $data
     * @param   array<string, string|array<int, string|\AdityaZanjad\Utils\Validator\Interfaces\ValidationRule>>    $rules
     * @param   array<string, array<string, string>>                                                                $messages
     * @param   \AdityaZanjad\Utils\Validator\ErrorsCollection                                                      $errors
     */
    public function __construct(array $data, array $rules, array $messages = [], ErrorsCollection $errors)
    {
        $this->data     =   $data;
        $this->rules    =   $rules;
        $this->messages =   $messages;
        $this->errors   =   $errors;
    }

    /**
     * The actions to apply before performing the actual validation.
     *
     * @return static
     */
    public function before(): static
    {
        return $this;
    }

    /**
     * The actions to perform after the validation has been done.
     *
     * @return static
     */
    public function after(): static
    {
        return $this;
    }

    /**
     * To stop the validator immediately on the first validation failure.
     *
     * @return static
     */
    public function abortOnFailure()
    {
        $this->options['stop_on_first_failure'] = true;
        return $this;
    }

    /**
     * Perform validation on the given input data.
     *
     * @return static
     */
    public function validate()
    {
        $this->data = Arr::toDot($this->data);

        foreach ($this->rules as $attribute => $rules) {
            //
        }
    }

    /**
     * Check if validation failed.
     *
     * @return bool
     */
    public function failed(): bool
    {
        return $this->errors->any();
    }

    /**
     * Validate the given attribute against the validation rule written in 'String Form'.
     *
     * @param   string  $attributePath
     * @param   string  $rule
     *
     * @return  static
     */
    protected function assertStringRule(string $attributePath, string $rule)
    {
        //
    }

    /**
     * Validate the given attribute against the given callback rule.
     *
     * @param   string                                  $attributePath
     * @param   callable($attrName, $attrValue): bool   $rule
     *
     * @return  static
     */
    protected function assertClosureRule(string $attributePath, callable $rule)
    {
        //
    }

    /**
     * Validate the given attribute against the given 'ValidationRule' instance.
     *
     * @param   string                                                      $attributePath
     * @param   \AdityaZanjad\Utils\Validator\Interfaces\ValidationRule     $rule
     *
     * @return  static
     */
    protected function assertInstanceRule(string $attributePath, ValidationRule $rule)
    {
        //
    }
}
