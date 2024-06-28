<?php

namespace AdityaZanjad\Utils\Traits;

use AdityaZanjad\Utils\Validator\ErrorsCollection;
use AdityaZanjad\Utils\Validator\Validator as ValidatorInstance;


trait Validator
{
    /**
     * Get a new instance of the 'Validator' to perform validation against the given input data.
     *
     * @param   array<int|string, mixed>                                                                            $data
     * @param   array<string, string|array<int, string|\AdityaZanjad\Utils\Validator\Interfaces\ValidationRule>>    $rules
     * @param   array<string, array<string, string>>                                                                $messages
     * @param   \AdityaZanjad\Utils\Validator\ErrorsCollection                                                      $errors
     *
     * @return  \AdityaZanjad\Utils\Validator\Validator
     */
    public function validator(array $data, array $rules, array $messages = []): ValidatorInstance
    {
        return new ValidatorInstance($data, $rules, $messages, new ErrorsCollection());
    }
}
