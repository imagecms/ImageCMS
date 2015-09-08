<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'elfinder/elFinderConnector.class.php';
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'elfinder/elFinder.class.php';
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'elfinder/elFinderVolumeDriver.class.php';
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'elfinder/elFinderVolumeLocalFileSystem.class.php';

class Elfinder_lib {

    public function __construct($opts) {

        $connector = new elFinderConnector(new elFinder($opts));
        $connector->run();
    }

}