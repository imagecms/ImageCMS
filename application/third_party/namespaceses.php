<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

function modules_namespaces_initialize() {
    if (!defined('PHP_VERSION_ID') || PHP_VERSION_ID < 50300)
        die('Namespaces requires PHP 5.3 or higher');
    spl_autoload_register(function ($class) {
                if (strpos($class, "\\")) {
                    if (file_exists($file = 'application/modules/' . str_replace('\\', DIRECTORY_SEPARATOR, $class) . EXT) || file_exists($file = 'application/modules/shop/classes/' . str_replace('\\', DIRECTORY_SEPARATOR, $class) . EXT))
                        require $file;
                }
            }, false);
}

function runFactory() {
    \CMSFactory\Events::runFactory();
}
