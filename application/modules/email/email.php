<?php

namespace email;

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Emails
 */
class email extends \email\classes\BaseEmail {

    protected static $_instance;

    public function __construct() {
        parent::__construct();

        $this->load->model('../modules/email/models/email_model');
    }

    private function __clone() {

    }

    /**
     *
     * @return Email
     */
    public static function getInstance() {
        if (null === self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    

}

/* End of file email.php */
