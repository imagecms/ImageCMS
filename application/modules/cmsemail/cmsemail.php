<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * @package CMSEmail
 * @property cmsemail_model $cmsemail_model
 * Image CMS
 * Emails
 */
class CMSEmail extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('cmsemail_model');
        $lang = new MY_Lang();
        $lang->load('cmsemail');
    }

    public function _install() {
        $this->cmsemail_model->install();
    }

    public function _deinstall() {
        $this->cmsemail_model->deinstall();
    }

}

/* End of file email.php */
