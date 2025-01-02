<?php

if (! function_exists('dda')) {
    function dda(mixed ...$vars): never
    {
        $vars = array_map(function ($var) {
            // if (gettype($var) === 'object') {
                return json_decode(json_encode($var, true));
            // }
            // return $var;
        }, $vars);

        dd(...$vars);
    }
}
