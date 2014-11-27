<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Test extends MY_Controller {

    public function index() {
        $this->writeDatabaseConfig();
    }

    

}
