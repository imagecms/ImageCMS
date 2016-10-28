<?php


(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Class Ymarket
 */
class Ymarket extends ShopController
{

    /**
     * @deprecated
     */
    public function index() {
        $this->load->module('aggregator')->service('ymarket');
    }

}

/* End of file sample_module.php */