<?php

namespace Core;
class Validator
{
    public static function string($value, $min = 1, $max = INF)
    {
        $value = trim($value);
        return strlen($value) >= $min && strlen($value) <= $max;
    }

    public static function email($value)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    public static function select($value, array $validOptions)
    {
        // Check if the selected value exists in the array of valid options
        return in_array($value, $validOptions, true);
    }

}
