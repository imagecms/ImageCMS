<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Emails
 */
class Email extends \email\classes\BaseEmail {

    protected static $_instance;

    public function __construct() {
        parent::__construct();
        var_dump(3);
    }

    private function __clone() {

    }

    public static function getInstance() {
        if (null === self::$_instance) {
            self::$_instance = new self();
            var_dump(1);
        }
        var_dump(2);
        return self::$_instance;
    }

}

/* End of file email.php */
