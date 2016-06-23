<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}


define('PATH_TO_ELFINDER', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'third_party'. DIRECTORY_SEPARATOR . 'studio-42'. DIRECTORY_SEPARATOR .'elfinder' . DIRECTORY_SEPARATOR .'php' . DIRECTORY_SEPARATOR);



require_once PATH_TO_ELFINDER . 'elFinderConnector.class.php';
require_once PATH_TO_ELFINDER . 'elFinder.class.php';
require_once PATH_TO_ELFINDER . 'elFinderVolumeDriver.class.php';
require_once PATH_TO_ELFINDER . 'elFinderVolumeLocalFileSystem.class.php';

class Elfinder_lib
{

    public function __construct($opts) {

        $connector = new elFinderConnector(new elFinder($opts));
        $connector->run();
    }

}