<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

function modules_namespaces_initialize() {
    (version_compare(PHP_VERSION, '5.3.0') >= 0) OR die('Namespaces requires PHP 5.3 or higher');
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
