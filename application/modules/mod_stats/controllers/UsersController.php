<?php

/**
 * 
 *
 * @author 
 */
class UsersController extends ControllerBase {

    public $params = array();

    public function __construct($controller) {
        parent::__construct($controller);
        $controller->import('traits/DateIntervalTrait.php');
        $this->params = array(
            'dateFrom' => isset($_GET['from']) ? $_GET['from'] : '2005-05-05',
            'dateTo' => isset($_GET['to']) ? $_GET['to'] : date("Y-m-d"),
            'interval' => isset($_GET['group']) ? $_GET['group'] : 'day',
        );
    }

    public function online() {
        $this->controller->load->model('attendance_model');
        $onlineUsers = $this->controller->attendance_model->getOnline();
        $this->renderAdmin('online', array(
            'data' => $onlineUsers
        ));
    }

    public function info() {
        $this->controller->load->model('users_model');
        $this->controller->users_model->setParams($this->params);
        $data = $this->controller->users_model->getInfo();
        $this->renderAdmin('info', array(
            'data' => $data
        ));
    }

    public function attendance() {
        // getting view type
        if (isset($_GET['view_type'])) {
            $vt = $_GET['view_type'];
            $viewType = $vt == 'table' || $vt == 'chart' ? $vt : 'chart';
        } else {
            $viewType = 'table';
        }

        $this->controller->import('traits/DateIntervalTrait.php');
        $this->controller->load->model('attendance_model');

        $data = $this->controller->attendance_model->getCommonAttendance($this->params);

        $this->renderAdmin('attendance', array(
            'data' => $data,
            'viewType' => $viewType,
        ));
    }

    public function getAttendanceData() {
        $params = $this->params;

        $this->controller->import('traits/DateIntervalTrait.php');
        $this->controller->load->model('attendance_model');

        $params['type'] = 'registered';
        $data = $this->controller->attendance_model->getCommonAttendance($params);
        $registered = array();
        foreach ($data as $row) {
            $registered[] = array(
                (int) $row['unix_date'] * 1000,
                (int) $row['users_count']
            );
        }

        $params['type'] = 'unregistered';
        $data = $this->controller->attendance_model->getCommonAttendance($params);
        $unregistered = array();
        foreach ($data as $row) {
            $unregistered[] = array(
                (int) $row['unix_date'] * 1000,
                (int) $row['users_count']
            );
        }

        echo json_encode(array(
            array('key' => 'Count of unique registered users', 'values' => $registered),
            array('key' => 'Count of unique unregistered users', 'values' => $unregistered),
        ));
    }

    public function register() {
        $this->renderAdmin('register');
    }

    public function getRegisterData() {
        $this->controller->load->model('users_model');
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
