<?php

namespace AdityaZanjad\Utils\Arr;

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
     * Get the first value from the array based on the given callback. If the callback is not given, fetch the first array value.
     *
     * @param   array<int|string, mixed>                                $arr
     * @param   bool|callable(mixed $value, int|string $key): mixed     $callback
     *
     * @return  mixed
     */
    public static function first(array &$arr, bool|callable $callback = false): mixed
    {
        if ($callback === false) {
            return $arr[array_key_first($arr)] ?? null;
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
     * @param   array<int|string, mixed>                                $arr
     * @param   bool|callable(mixed $value, int|string $key): mixed     $callback
     *
     * @return  mixed
     */
    public static function last(array &$arr, bool|callable $callback = false): mixed
    {
        return Arr::first(array_reverse($arr), $callback);
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
        $keys   =   array_keys($arr);
        $arr    =   array_map($callback, $arr, $keys);

        return array_combine($keys, $arr);
    }

    /**
     * Filter out the array elements by iteratively applying the given callback function to the array.
     *
     * @param   array<int|string, mixed>                        $arr
     * @param   callable(mixed $value, int|string $key): mixed  $callback
     *
     * @return  array<int|string, mixed>
     */
    public static function filter(array $arr, callable $callback): array
    {
        return array_filter($arr, $callback);
    }

    /**
     * Check if the given "Dot notation array path" exists or not in the given array.
     *
     * @param   array<int|string, mixed>    &$arr
     * @param   string                      $dotNotationPath
     *
     * @return  bool
     */
    public static function exists(array &$arr, string $dotNotationPath): bool
    {
        $pathKeys   =   explode('.', $dotNotationPath);
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
     * @param   string                      $dotNotationPath
     *
     * @return  mixed
     */
    public static function get(array &$arr, string $dotNotationPath): mixed
    {
        $pathKeys   =   explode('.', $dotNotationPath);
        $ref        =   &$arr;

        foreach ($pathKeys as $pathKey) {
            // If any of the keys in the given dot notation path does not exist, it simply means the path is invalid.
            if (!isset($ref[$pathKey])) {
                return null;
            }

            $ref = &$ref[$pathKey];
        }

        return $ref;
    }

    /**
     * Set a value in the given array based on the given 'Dot Notation Path'.
     *
     * @param   array<int|string, mixed>    &$arr
     * @param   string                      $dotNotationPath
     * @param   mixed                       $value
     *
     * @return  void
     */
    public static function set(array &$arr, string $dotNotationPath, mixed $value): void
    {
        $pathKeys   =   explode('.', $dotNotationPath);
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
}
