<?php



/**
 * Description of ProductsBase
 *
 * @author kolia
 */
class Stats_model_users extends CI_Model {

    protected $locale;
    
    public function __construct() {
        parent::__construct();
        $this->locale = \MY_Controller::getCurrentLocale();
    }

    public function getUsersOnline() {
        
    }
}

?>
