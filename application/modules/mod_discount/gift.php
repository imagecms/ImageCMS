<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gift extends \mod_discount\classes\BaseDiscount {

    public function __construct() {

        parent::__construct();
        $this->get_all_discount();
        $this->collect_type();
    }

    public function get_gift_certificate($key) {

        foreach ($this->discount_type['all_order'] as $disc) 
            if ($disc['key'] == $key and $disc['is_gift']) {
                return $disc;
                break;
            } 
        
        return false;
    }
    
    public function render_gift_input(){
        
    }

}

