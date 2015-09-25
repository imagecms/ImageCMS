<?php

//define('PUBPATH', realpath(__DIR__ . '/../../..'));
//
//define('APPPATH', PUBPATH . '/application');
//
//$namespacedDirs = [
//    APPPATH,
//    APPPATH . '/modules',
//];
//
//
//// init namespace autoloading
//spl_autoload_register(function($className) use ($namespacedDirs) {
//    $namespacedClassPath = str_replace('\\', DIRECTORY_SEPARATOR, $className);
//    for ($i = 0; $i < count($namespacedDirs); $i++) {
//        $classPath = rtrim($namespacedDirs[$i], DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $namespacedClassPath . '.php';
//        if (file_exists($classPath)) {
//            require_once $classPath;
//            return;
//        }
//    }
//}, false);

