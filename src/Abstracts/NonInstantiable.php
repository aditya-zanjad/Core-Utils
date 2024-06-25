<?php

namespace AdityaZanjad\Utils\Abstracts;

use Exception;

/**
 * Any class that inherits this class will become non-instantiable.
 */
abstract class NonInstantiable
{
    /**
     * By making the constructor 'final', we ensure that it cannot be override in the child
     * class. By throwing an exception in the constructor definition we make sure that
     * this class & its child class(es) cannot be instantiated.
     *
     * @throws \Exception
     */
    final public function __construct()
    {
        throw new Exception("[Developer][Exception]: The class [" . static::class . "] is non-instantiable.");
    }
}
