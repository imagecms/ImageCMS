<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * 
 * 
 * 
 */
class Admin extends \BaseAdminController {

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
    public $defaultAction = 'orders/amount';

    public function __construct() {
        $this->assetManager = \CMSFactory\assetManager::create();
        include __DIR__ . DIRECTORY_SEPARATOR . 'interfaces' . DIRECTORY_SEPARATOR . 'ControllerBase' . EXT;
    }

    public function index() {
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