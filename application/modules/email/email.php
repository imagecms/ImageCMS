<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Emails
 */
class Email extends \email\classes\BaseEmail {

    public function __construct() {
        parent::__construct();
    }

    public function autoload() {

    }

    public function _install() {
        parent::_install();
    }

    public function _deinstall() {
        parent::_deinstall();
    }

}

/* End of file email.php */
