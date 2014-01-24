<?php

/**
 * Description of ProductsBase
 *
 * @author 
 */
class Categories_model extends \CI_Model {

    protected $locale;
    
    public function __construct() {
        parent::__construct();
        $this->locale = \MY_Controller::getCurrentLocale();
    }


}

?>
