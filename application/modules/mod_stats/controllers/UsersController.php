<?php

/**
 * 
 *
 * @author 
 */
class UsersController extends ControllerBase {

    public function __construct($controller) {
        parent::__construct($controller);
        $controller->import('traits/DateIntervalTrait.php');
        $controller->load->model('users_model');
        $controller->users_model->setParams(array(
            'dateFrom' => isset($_GET['from']) ? $_GET['from'] : '2005-05-05',
            'dateTo' => isset($_GET['to']) ? $_GET['to'] : date("Y-m-d"),
            'interval' => isset($_GET['group']) ? $_GET['group'] : 'day',
        ));
    }

    public function online() {
        $onlineUsers = $this->controller->users_model->getOnline();
        $this->renderAdmin('online', array(
            'data' => $onlineUsers
        ));
    }

    public function info() {
        $data = $this->controller->users_model->getInfo();
        $this->renderAdmin('info', array(
            'data' => $data
        ));
    }

    public function attendance() {
        $this->controller->import('traits/DateIntervalTrait.php');
        $this->controller->load->model('attendance_model');
        $params = array(
            'dateFrom' => isset($_GET['from']) ? $_GET['from'] : '2005-05-05',
            'dateTo' => isset($_GET['to']) ? $_GET['to'] : date("Y-m-d"),
            'interval' => isset($_GET['group']) ? $_GET['group'] : 'day',
            'registered' => TRUE
        );
        $data = $this->controller->attendance_model->getCommonAttendance($params);

        $this->renderAdmin('attendance', array(
            'data' => $data
        ));
    }

    public function register() {
        $this->renderAdmin('register');
    }

    public function getRegisterData() {
        $data = $this->controller->users_model->getRegister();
        $chartValues = array();
        foreach ($data as $row) {
            $chartValues[] = array(
                (int) $row['unix_date'] * 1000,
                (int) $row['count']
            );
        }
        echo json_encode(array(array('key' => 'Registration dynamic', 'values' => $chartValues)));
    }

}

?>
