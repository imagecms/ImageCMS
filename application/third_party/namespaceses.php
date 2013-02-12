<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function modules_namespaces_initialize() {
    if (!defined('PHP_VERSION_ID') || PHP_VERSION_ID < 50300)
        die('Namespaces requires PHP 5.3 or higher');
    spl_autoload_register('modules_namespaces_autoload', false);
}

function modules_namespaces_autoload($name) {
    if (strpos($name, "\\")) {
        if (file_exists($file = 'application/modules/' . str_replace('\\', DIRECTORY_SEPARATOR, $name) . EXT))
            require $file;
        if (file_exists($file = 'application/modules/shop/classes/' . str_replace('\\', DIRECTORY_SEPARATOR, $name) . EXT))
            require $file;
    }
}

spl_autoload_register(function ($class) {
            var_dump($class);
//                return false;
        }, null, null, false);

function runFactory() {
    \CMSFactory\Events::runFactory();
}
