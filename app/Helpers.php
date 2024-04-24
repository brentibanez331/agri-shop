<?php

if (!function_exists('truncateString')) {
    function truncateString($string, $maxLength = 38, $ellipsis = '...')
    {
        return strlen($string) > $maxLength ? substr($string, 0, $maxLength - strlen($ellipsis)) . $ellipsis : $string;
    }
}