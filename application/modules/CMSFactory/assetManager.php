<?php

namespace CMSFactory;

/**
 * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
 */
class assetManager {

    protected static $_BehaviorInstance;

    private function __construct() {
        $vla = new \stdClass();
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
    public function setData($item, $value = null) {
        if ($value != null AND !is_array($item))
            $data[$item] = $value;
        else
            $data = $item;
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
        $paths = explode(DIRECTORY_SEPARATOR, $trace[0]['file']);
        $paths = $paths[count($paths) - 2];
        \CI_Controller::get_instance()->template->registerJsFile(APPPATH . 'modules/' . $paths . '/assets/js/' . $name . '.js', 'after');
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
        $paths = explode(DIRECTORY_SEPARATOR, $trace[0]['file']);
        $paths = $paths[count($paths) - 2];
        \CI_Controller::get_instance()->template->registerCssFile(APPPATH . 'modules/' . $paths . '/assets/css/' . $name . '.css', 'before');
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
        $paths = explode(DIRECTORY_SEPARATOR, $trace[0]['file']);
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
    public function render($tpl, $ignoreWrap = FALSE) {
        $trace = debug_backtrace();
        $paths = explode(DIRECTORY_SEPARATOR, $trace[0]['file']);
        $paths = $paths[count($paths) - 2];
        try {
            $tplPath = 'application/modules/' . $paths . '/assets/' . $tpl;
            file_exists($tplPath . '.tpl') OR throwException('Can\'t load template file: <i>' . $paths . DS . $tpl . '.tpl</i>');
            if (!$ignoreWrap)
                \CI_Controller::get_instance()->template->show('file:' . $tplPath);
            else
                \CI_Controller::get_instance()->template->display('file:' . $tplPath);
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
    public function fetchTemplate($tpl) {
        $trace = debug_backtrace();
        $paths = explode(DIRECTORY_SEPARATOR, $trace[0]['file']);
        $paths = $paths[count($paths) - 2];
        try {
            $tplPath = APPPATH . '/modules/' . $paths . '/assets/' . $tpl;
            file_exists($tplPath . '.tpl') OR throwException('Can\'t load template file: <i>' . $paths . DS . $tpl . '.tpl</i>');
            return \CI_Controller::get_instance()->template->fetch('file:' . $tplPath);
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

/** End of file /application/modules/CMSFactory/assetManager.php */
?>