<?php

namespace exchangeunfu;

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Module Frame
 */
class exc {

    /**
     * Path to upload dir
     * @var string
     */
    private $pass = './application/modules/exchangeunfu/';

    public function __construct() {

    }

    public function index() {
        $xml = simplexml_load_file($this->pass . 'export.xml');

        var_dump($xml->СписокОрганизаций);
    }

}

/* End of file sample_module.php */
