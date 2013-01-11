<?php

namespace CMSFactory;

class assetManager {

    protected static $_BehaviorInstance;
    protected $data;

    private function __construct() {
        
    }

    private function __clone() {
        
    }

    /**
     * @param array $data Fetch data to template
     * @return assetManager
     * @access public
     * @author Kaero
     * @copyright ImageCMS (c) 2012, Kaero <dev@imagecms.net>
     */
    public function fetchData(array $data) {
        (empty($data)) OR \CI_Controller::get_instance()->template->add_array($data);
        return $this;
    }

    /**
     * @return assetManager
     * @access public
     * @author Kaero
     * @copyright ImageCMS (c) 2012, Kaero <dev@imagecms.net>
     */
    public function registerScript($name) {
        $trace = debug_backtrace();
        $paths = explode('/', $trace[0]['file']);
        var_dumps($paths);
        return $this;
    }

    /**
     * Render Admin view
     * @param string $tpl Template file name
     * @return void
     * @access public
     * @author Kaero
     * @copyright ImageCMS (c) 2012, Kaero <dev@imagecms.net>
     */
    public function renderAdmin($tpl) {
        $trace = debug_backtrace();
        $paths = explode('/', $trace[0]['file']);
        $paths = $paths[count($paths) - 2];
        \CI_Controller::get_instance()->template->show('file:' . 'application/modules/' . $paths . '/assets/admin/' . $tpl);
    }

    /**
     * @return assetManager
     * @access public
     * @author Kaero
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    public static function create() {
        (null !== self::$_BehaviorInstance) OR self::$_BehaviorInstance = new self();
        return self::$_BehaviorInstance;
    }

}

?>