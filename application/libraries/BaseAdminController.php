<?php

class BaseAdminController extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('Permitions');
        Permitions::checkPermitions();
    }

//    public function render($viewName, array $data = array(), $return = false) {
//        if (!empty($data))
//            $this->template->add_array($data);
//
//        if ($this->ajaxRequest)
//            echo $this->template->fetch('file:' . 'application/modules/cfcm/templates/admin/' . $viewName);
//        else
//            $this->template->show('file:' . 'application/modules/cfcm/templates/admin/' . $viewName);
////     	$this->template->fetch('file:' . 'application/modules/cfcm/templates/admin/' . $viewName);
//        exit;
//    }

}

?>
