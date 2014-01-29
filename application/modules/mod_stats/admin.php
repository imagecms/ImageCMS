<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Class Admin for mod_stats module
 * @uses \BaseAdminController
 * @author DevImageCms
 * @copyright (c) 2014, ImageCMS
 * @package ImageCMSModule
 */
class Admin extends \BaseAdminController {

    use FileImportTrait;

    /**
     * Asset manager is building path of clients scripts by trace,
     * so we need to get instance here, and pass it to controllers
     * @var \CMSFactory\assetManager 
     */
    public $assetManager;

    /**
     * For index action
     * In format controller/action
     * @var string
     */
    public $defaultAction = 'orders/count';

    public function __construct() {
        parent::__construct();
        $this->load->helper('file');

        $this->import('classes/ControllerBase' . EXT);
        $this->assetManager = \CMSFactory\assetManager::create()
                ->registerScript('functions')
                ->registerScript('d3.v3')
                ->registerScript('nv.d3')
                ->registerStyle('nv.d3')
                ->registerScript('scripts')
                ->registerStyle('styles');

        // for saving date params between pages crossing
        if (!empty($_SERVER['QUERY_STRING'])) {
            $this->assetManager->setData('queryString', '?' . $_SERVER['QUERY_STRING']);
        }
        // passing to template array with menu structure
        $leftMenu = include __DIR__ . DIRECTORY_SEPARATOR . 'include' . DIRECTORY_SEPARATOR . 'left_menu' . EXT;

        // set data to template
        $this->assetManager->setData('leftMenu', $leftMenu);
        $this->assetManager->setData('saveSearchResults', \mod_stats\classes\AdminHelper::create()->getSetting('save_search_results'));
        $this->assetManager->setData('saveUsersAttendance', \mod_stats\classes\AdminHelper::create()->getSetting('save_users_attendance'));
        $this->assetManager->setData('CS', \mod_stats\classes\AdminHelper::create()->getCurrencySymbol());
    }

    public function index() {
//        if ($this->input->is_ajax_request()){
//            exit();
//        }
        $ca = explode('/', $this->defaultAction);
        $this->runControllerAction($ca[0], array($ca[1]));
    }

    public function orders() {
        $this->runControllerAction(__FUNCTION__, func_get_args());
    }

    public function users() {
        $this->runControllerAction(__FUNCTION__, func_get_args());
    }

    public function products() {
        $this->runControllerAction(__FUNCTION__, func_get_args());
    }

    public function categories() {
        $this->runControllerAction(__FUNCTION__, func_get_args());
    }

    public function search() {
        $this->runControllerAction(__FUNCTION__, func_get_args());
    }

    public function adminAdd() {
        $this->runControllerAction(__FUNCTION__, func_get_args());
    }

    /**
     * Simple redirecting to page from attendance data
     */
    public function attendance_redirect() {
        if (!isset($_GET['type_id']) || !isset($_GET['id_entity'])) {
            echo "Page not found - No data";
            exit;
        }
        $this->import('classes/Attendance');
        $this->import('classes/AttendanceRedirect');
        $attendanceRedirect = new AttendanceRedirect();
        $attendanceRedirect->redirect($_GET['type_id'], $_GET['id_entity']);
    }

    /**
     * Helper function for spliting controllers
     * @param string $callerFunctionName
     * @param array $arguments
     * @return mixed result of function 
     */
    private function runControllerAction($callerFunctionName, $arguments) {
        $controllerName = ucfirst($callerFunctionName) . 'Controller';
        $action = array_shift($arguments);
        include __DIR__ . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . $controllerName . EXT;
        return call_user_func_array(array(new $controllerName($this), $action), $arguments);
    }

}

