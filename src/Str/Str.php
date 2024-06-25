<?php

namespace AdityaZanjad\Utils\Str;


/**
 * This class is make in an attempt to help ease some common string related operations.
 */
class Str
{
    /**
     * Get length i.e. the number of total characters in the given substring.
     *
     * @param string &$str
     *
     * @return int
     */
    public static function length(string &$str): int
    {
        return strlen($str);
    }

    /**
     * Convert the given string to lowercase.
     *
     * @param string $str
     *
     * @return string
     */
    public static function toLower(string $str): string
    {
        return strtolower($str);
    }

    /**
     * Convert the given string to uppercase.
     *
     * @param string $str
     *
     * @return string
     */
    public static function toUpper(string $str): string
    {
        return strtoupper($str);
    }

    /**
     * Get the part of string before the first occurrence of the given substring.
     *
     * @param   string  $str
     * @param   string  $substr
     *
     * @return  null|string
     */
    public static function before(string $str, string $substr): ?string
    {
        $subPos = stripos($str, $substr);

        if ($subPos) {
            return null;
        }

        return substr($str, 0, $subPos);
    }

    /**
     * [Case Sensitive]: Get the part of string before the first occurrence of the given substring.
     *
     * @param   string  $str
     * @param   string  $substr
     *
     * @return  null|string
     */
    public static function beforeSensitive(string $str, string $substr): ?string
    {
        $subPos = strpos($str, $substr);

        if ($subPos) {
            return null;
        }

        return substr($str, 0, $subPos);
    }

    /**
     * Get part of the given string after the first occurrence of the given substring.
     *
     * @param   string  $str
     * @param   string  $substr
     *
     * @return  null|string
     */
    public static function after(string $str, string $substr): ?string
    {
        $subPos = stripos($str, $substr);

        if ($subPos === false) {
            return null;
        }

        return substr($str, $subPos + static::length($substr), strlen($str));
    }

    /**
     * [Case Sensitive]: Get part of the given string after the first occurrence of the given substring.
     *
     * @param   string  $str
     * @param   string  $substr
     *
     * @return  null|string
     */
    public static function afterSensitive(string $str, string $substr): ?string
    {
        $subPos = strpos($str, $substr);

        if ($subPos === false) {
            return null;
        }

        return substr($str, $subPos + static::length($substr), strlen($str));
    }

    /**
     * Get part of the given string before the last occurrence of the given substring.
     *
     * @param   string  $str
     * @param   string  $substr
     *
     * @return  null|string
     */
    public static function beforeLast(string $str, string $substr): ?string
    {
        $subPos = strripos($str, $substr);

        if ($subPos === false) {
            return null;
        }

        return substr($str, 0, $subPos);
    }

    /**
     * [Case Sensitive]: Get part of the given string before the last occurrence of the given substring.
     *
     * @param   string  $str
     * @param   string  $substr
     *
     * @return  null|string
     */
    public static function beforeLastSensitive(string $str, string $substr): ?string
    {
        $subPos = strrpos($str, $substr);

        if ($subPos === false) {
            return null;
        }

        return substr($str, 0, $subPos);
    }

    /**
     * Get part of the string after the last occurrence of the given substring.
     *
     * @param   string  $str
     * @param   string  $substr
     * '
     * @return  null|string
     */
    public static function afterLast(string $str, string $substr): ?string
    {
        $subPos = stripos($str, $substr);

        if ($subPos === false) {
            return null;
        }

        return substr($str, $subPos + static::length($subPos));
    }

    /**
     * [Case Sensitive]: Get part of the string after the last occurrence of the given substring.
     *
     * @param   string  $str
     * @param   string  $substr
     * '
     * @return  null|string
     */
    public static function afterLastSensitive(string $str, string $substr): ?string
    {
        $subPos = strpos($str, $substr);

        if ($subPos === false) {
            return null;
        }

        return substr($str, $subPos + static::length($subPos));
    }

    /**
     * Determine if the given string contains the given substring or not.
     *
     * @param   string  $str
     * @param   string  $substr
     *
     * @return  bool
     */
    public static function contains(string $str, string $substr): bool
    {
        if (function_exists('str_contains')) {
            return str_contains($str, $substr);
        }

        return stripos($str, $substr);
    }

    /**
     * Determine if the given string contains the given substring or not.
     *
     * @param   string  $str
     * @param   string  $substr
     *
     * @return  bool
     */
    public static function containsSensitive(string $str, string $substr): bool
    {
        if (function_exists('str_contains')) {
            return str_contains(static::toLower($str), static::toLower($substr));
        }

        return strpos($str, $substr);
    }

    /**
     * Replace the given 'Search' string with the given 'Replace' string in the given string.
     *
     * @param   string  $str
     * @param   string  $search
     * @param   string  $replace
     *
     * @return  string
     */
    public static function replace(string $str, string $search, string $replace): string
    {
        $subPos = stripos($str, $search);

        if ($subPos === false) {
            return null;
        }

        return substr_replace($str, $replace, $subPos, static::length($subPos));
    }

    /**
     * [Case Sensitive]: Replace the given 'Search' string with the given 'Replace' string in the given string.
     *
     * @param   string  $str
     * @param   string  $search
     * @param   string  $replace
     *
     * @return  string
     */
    public static function replaceSensitive(string $str, string $search, string $replace): string
    {
        $subPos = strpos($str, $search);

        if ($subPos === false) {
            return null;
        }

        return substr_replace($str, $replace, $subPos, static::length($subPos));
    }
}
