<?php

namespace AdityaZanjad\Utils\Enum;

use ReflectionClass;
use AdityaZanjad\Utils\Abstracts\NonInstantiable;

/**
 * This class can be extended by other classes to achieve like functionalities in PHP.
 */
class Enum extends NonInstantiable
{
    /**
     * @var \ReflectionClass $reflect
     */
    protected static ReflectionClass $reflect;

    /**
     * Get an instance of the 'ReflectionClass'.
     *
     * @return \ReflectionClass
     */
    protected static function reflect(): ReflectionClass
    {
        // The reflection object must be already instantiated for the current class.
        if (!isset(static::$reflect) || static::$reflect->getNamespaceName() !== static::class) {
            return static::$reflect = new ReflectionClass(static::class);
        }

        return static::$reflect;
    }

    /**
     * Get all of the constants of the current class.
     *
     * @return array<string, mixed>
     */
    public static function all(): array
    {
        return static::reflect()->getConstants();
    }

    /**
     * Check if the constant is defined or not in the current class.
     *
     * @param string $name
     *
     * @return bool
     */
    public static function exists(string $name): bool
    {
        if (static::reflect()->getReflectionConstant(strtoupper($name)) === false) {
            return false;
        }

        return true;
    }

    /**
     * Get value of a constant by the given name.
     *
     * @param string $name
     *
     * @return mixed
     */
    public static function findOne(string $name): mixed
    {
        if (!static::exists($name)) {
            return null;
        }

        return static::reflect()->getConstant(strtoupper($name));
    }
}
