<?php

/**
 * 
 *
 * @author 
 */
class UsersController extends ControllerBase {

    public function online() {
        $this->controller->load->model('users_model');

        $result = $this->controller->users_model->getOnline();
        echo '<pre>';
        print_r($result);
        echo '</pre>';
        exit;

        //$this->renderAdmin('online');
    }

}

?>
