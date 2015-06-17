<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/*
 * TODO: This file is legacy from older versions of CMS and should be 
 * transformed into some bootstrap logic along with Lib_init library
 */

function runFactory() {
    \CMSFactory\Events::runFactory();
}
