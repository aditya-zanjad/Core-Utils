<?php

namespace AdityaZanjad\Utils\Arr;

use RecursiveArrayIterator;
use RecursiveIteratorIterator;
use AdityaZanjad\Utils\Abstracts\NonInstantiable;

/**
 * This class is made in attempt to help ease some common array related operations.
 */
class Arr extends NonInstantiable
{
    /**
     * Get the length i.e. the total number of elements in the given array.
     *
     * @param array<int|string, mixed> &$arr
     *
     * @return int
     */
    public static function length(array &$arr): int
    {
        return count($arr);
    }

    /**
     * Join the array values into a single string using the given separator string.
     *
     * @param   array<int, string>  $arr
     * @param   string              $separator
     *
     * @return  string
     */
    public static function join(array $arr, string $separator): string
    {
        return implode($separator, $arr);
    }

    /**
     * Get the first value from the array based on the given callback. If the callback is not given, fetch the first array value.
     *
     * @param   array<int|string, mixed>                        $arr
     * @param   ?callable(mixed $value, int|string $key): mixed $callback
     *
     * @return  mixed
     */
    public static function first(array &$arr, ?callable $callback): mixed
    {
        if (empty($arr)) {
            return null;
        }

        if (is_null($callback)) {
            return $arr[array_key_first($arr)];
        }

        foreach ($arr as $key => $value) {
            $result = call_user_func($callback, $value, $key);

            if ($result === true || $result === $value) {
                return $value;
            }
        }

        return null;
    }

    /**
     * Get the first value from the array based on the given callback. If the callback is not given, fetch the first array value.
     *
     * @param   array<int|string, mixed>                        $arr
     * @param   ?callable(mixed $value, int|string $key): mixed $callback
     *
     * @return  mixed
     */
    public static function last(array &$arr, ?callable $callback): mixed
    {
        if (empty($arr)) {
            return null;
        }

        if (is_null($callback)) {
            return $arr[array_key_last($arr)] ?? null;
        }

        // Get the last element of the array so that we can start iterating the array in reverse order.
        $currentElement = end($arr);

        while ($currentElement !== false) {
            // Apply the callback function on each item of the array.
            $result = call_user_func($callback, $currentElement, key($arr));

            if ($result === true || $result === $currentElement) {
                return $currentElement;
            }

            // Move the next array item in the reversed order.
            $currentElement = prev($arr);
        }

        return null;
    }

    /**
     * Iteratively apply the given callback function to each element of the given array.
     *
     * @param   array<int|string, mixed>                        $arr
     * @param   callable(mixed $value, int|string $key): mixed  $callback
     *
     * @return  array<int|string, mixed>
     */
    public static function map(array $arr, callable $callback): array
    {
        /**
         * Here, we'll pass the array values & array keys as the second & third arguments to the function
         * 'array_map()'. This will allow the user to use both the array value & its key as the
         * arguments in the callback function.
         */
        $keys   =   array_keys($arr);
        $arr    =   array_map($callback, $arr, $keys);

        return array_combine($keys, $arr);
    }

    /**
     * Filter out the array elements by iteratively applying the given callback function to the array.
     *
     * @param   array<int|string, mixed>                        $arr
     * @param   ?callable(mixed $value, int|string $key): mixed $callback
     *
     * @return  array<int|string, mixed>
     */
    public static function filter(array $arr, ?callable $callback): array
    {
        return array_filter($arr, $callback);
    }

    /**
     * Check if the given "Dot notation array path" exists or not in the given array.
     *
     * @param   array<int|string, mixed>    &$arr
     * @param   string                      $dotPath
     *
     * @return  bool
     */
    public static function exists(array &$arr, string $dotPath): bool
    {
        $pathKeys   =   explode('.', $dotPath);
        $ref        =   &$arr;

        foreach ($pathKeys as $pathKey) {
            if (!isset($ref[$pathKey])) {
                return false;
            }

            $ref = &$ref[$pathKey];
        }

        return true;
    }

    /**
     * Fetch a value from the given array based on the given "Dot Notation Path".
     *
     * @param   array<int|string, mixed>    $arr
     * @param   string                      $dotPath
     * @param   mixed                       $default
     *
     * @return  mixed
     */
    public static function get(array &$arr, string $dotPath, mixed $default): mixed
    {
        $pathKeys   =   explode('.', $dotPath);
        $ref        =   &$arr;

        foreach ($pathKeys as $pathKey) {
            // If any of the keys in the given dot notation path does not exist, it simply means the path is invalid.
            if (!isset($ref[$pathKey])) {
                return $default;
            }

            $ref = &$ref[$pathKey];
        }

        return $ref;
    }

    /**
     * Set a value in the given array based on the given 'Dot Notation Path'.
     *
     * @param   array<int|string, mixed>    &$arr
     * @param   string                      $dotPath
     * @param   mixed                       $value
     *
     * @return  void
     */
    public static function set(array &$arr, string $dotPath, mixed $value): void
    {
        $pathKeys   =   explode('.', $dotPath);
        $ref        =   &$arr;

        foreach ($pathKeys as $pathKey) {
            /**
             * If the array does not contain the given key or if it is not an array, create a new key within the
             * array & assign it an empty array value. This way, we can keep moving deeper into the array
             * until we encounter the last key to which we want to assign the given value.
             */
            if (!isset($ref[$pathKey]) || !is_array($ref[$pathKey])) {
                $ref[$pathKey]  =   [];
                $ref            =   &$ref[$pathKey];
            }
        }

        $ref[$pathKey] = $value;
    }

    /**
     * Convert the given array structure into the "Dot Notation Path" structure.
     *
     * @param array<int|string, mixed> $arr
     *
     * @return array<int|string, mixed>
     */
    public static function toDot(array $arr): array
    {
        $arr = new RecursiveArrayIterator($arr);
        $arr = new RecursiveIteratorIterator($arr, RecursiveIteratorIterator::SELF_FIRST);

        $nestedPathKeys =   []; // To contain all of the array keys to last nested key.
        $dotPaths       =   []; // To store the 'Dot Notation Paths' with their corresponding values.

        foreach ($arr as $key => $value) {
            $nestedPathKeys[$arr->getDepth()] = $key;

            // Keep skipping the current iteration until we get to the last nested array key.
            if (is_array($value)) {
                continue;
            }

            /**
             * The function 'array_slice()' will get all of the keys in the nested path, while the function
             * 'implode' will join all of those keys together into one 'Dot Notation Array Path' form.
             */
            $dotPaths[implode('.', array_slice($nestedPathKeys, 0, $arr->getDepth() + 1))] = $value;
        }

        return $dotPaths;
    }

    /**
     * Expand the given dot notation 2-D array into a multi-dimensional array.
     *
     * @param array<string, mixed> $arr
     *
     * @return array<string, mixed>
     */
    public static function fromDot(array $arr): array
    {
        foreach ($arr as $key => $value) {
            static::set($arr, (string) $key, $value);
            unset($arr[$key]);
        }

        return $arr;
    }
}
