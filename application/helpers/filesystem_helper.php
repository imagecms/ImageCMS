<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Helps to create pathes
 * Please specify path parts in arguments
 *
 * @params strings - ANY NUMBER OF ARGUMENTS
 *
 * @return string path (with no right slash)
 * @throws \InvalidArgumentException
 * @author ailok
 */
function path() {
    $parts = func_get_args();
    if (count($parts) == 0) {
        throw new \InvalidArgumentException(lang('Function needs at least 1 argument', 'admin'));
    }
    $path = array_slice($parts);

    $path = rtrim($path, '/');
    $path = rtrim($path, '\\');

    foreach ($parts as $part) {
        $part = trim($part, '/');
        $part = trim($part, '\\');

        $path .= '/' . $part;
    }

    return rtrim(str_replace('\\', '/', $path), '/'); // slash works in linux and windows
}