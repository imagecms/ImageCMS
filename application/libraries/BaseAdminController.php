<?php

class BaseAdminController extends MY_Controller {

    public function __construct() {
        parent::__construct();
        
//        $adminController = $this->uri->segment(2);
//        $adminClassName = ucfirst($adminController);
//        $adminMethod = $this->uri->segment(3);
//        $adminClassFile =  '/application/modules/admin/'. $adminController . '.php';
//        var_dump($adminClassName);
//        var_dump($adminController);
//        var_dump($adminMethod);
//        var_dump($adminClassFile);
        $this->load->library('Permitions');
        //Permitions::checkShopPermitions($adminClassName, $adminMethod);
        Permitions::checkPermitions();
        
    }

}

?>
