<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Elfinder_lib
{

    public function __construct($opts) {

        $connector = new elFinderConnector(new elFinder($opts));
        $connector->run();
    }

}