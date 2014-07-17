<?php

/**
 * 
 *
 * @author kolia
 */
class Premmerce extends MY_Controller {

    public function index() {
        $email = $this->input->post('email');
        
        $encKey = $this->config->item('encryption_key');
        var_dump($encKey);
    }

}
