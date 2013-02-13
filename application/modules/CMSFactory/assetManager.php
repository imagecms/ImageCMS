<?php

namespace CMSFactory;

class assetManager {

    protected static $_BehaviorInstance;

    private function __construct() {
        
    }

    private function __clone() {
        
    }

    /**
     * @param array $data Fetch data to template
     * @return assetManager
     * @access public
     * @author Kaero
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    public function fetchData(array $data) {
        (empty($data)) OR \CI_Controller::get_instance()->template->add_array($data);
        return $this;
    }

    /**
     * @return assetManager
     * @access public
     * @author Kaero
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    public function registerScript($name) {
        $trace = debug_backtrace();
        $paths = explode('/', $trace[0]['file']);
        $paths = $paths[count($paths) - 2];
        $paths = APPPATH . implode('/', array_slice(explode('/', $trace[0]['file']), 5, 2));
        \CI_Controller::get_instance()->template->registerJsFile($paths . '/assets/js/' . $name . '.js', 'after');
        return $this;
    }

    /**
     * @return assetManager
     * @access public
     * @author Kaero
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    public function registerStyle($name) {
        $trace = debug_backtrace();
        $paths = explode('/', $trace[0]['file']);
        $paths = $paths[count($paths) - 2];
        $paths = APPPATH . implode('/', array_slice(explode('/', $trace[0]['file']), 5, 2));
        \CI_Controller::get_instance()->template->registerCssFile($paths . '/assets/css/' . $name . '.css', 'before');
        return $this;
    }

    /**
     * Render Admin view
     * @param string $tpl Template file name
     * @return void
     * @access public
     * @author Kaero
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    public function renderAdmin($tpl) {
        $trace = debug_backtrace();
        $paths = explode('/', $trace[0]['file']);
        $paths = $paths[count($paths) - 2];
        try {
            $tplPath = 'application/modules/' . $paths . '/assets/admin/' . $tpl;
            file_exists($tplPath . '.tpl') OR throwException('Can\'t load template file: <i>' . $paths . '/assets/admin/' . $tpl . '.tpl</i>');
            \CI_Controller::get_instance()->template->show('file:' . $tplPath);
        } catch (\Exception $exc) {
            log_message('error', $exc->getMessage());
            show_error($exc->getMessage(), 500, 'An Template Error Was Encountered');
        }
    }

    /** Render public view
     * @param string $tpl Template file name
     * @return void
     * @access public
     * @author Kaero
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    public function render($tpl) {
        $trace = debug_backtrace();
        $paths = explode('/', $trace[0]['file']);
        $paths = $paths[count($paths) - 2];
        try {
            $tplPath = 'application/modules/' . $paths . '/' . $tpl;
            file_exists($tplPath . '.tpl') OR throwException('Can\'t load template file: <i>' . $paths . '/' . $tpl . '.tpl</i>');
            $test = \CI_Controller::get_instance()->template->show('file:' . $tplPath);
        } catch (\Exception $exc) {
            log_message('error', $exc->getMessage());
            show_error($exc->getMessage(), 500, 'An Template Error Was Encountered');
        }
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