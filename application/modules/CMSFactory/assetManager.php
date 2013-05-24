<?php

namespace CMSFactory;

/**
 * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
 */
class assetManager {
    const REGISTER_FILE_TYPE_STYLE = 'style';
    const REGISTER_FILE_TYPE_SCRIPT = 'script';

    protected static $_BehaviorInstance;

    private function __construct() {
        $vla = new \stdClass();
    }

    private function __clone() {
        
    }

    /**
     * @param string 
     * @return array
     * @access public
     * @author cutter     
     */
    public function Get_trace($list = 'first_file') {
        $trace = debug_backtrace();
        if ($list == 'first_file') {
            $paths = explode(DIRECTORY_SEPARATOR, $trace[0]['file']);           
            return  $paths[count($paths) - 2];
        }

        if ($list == 'first') {
            return $trace[0];
        }

        if ($list == 'all') {
            return $trace;
        }
        if (is_numeric($list)) {
            return $trace[$list]; 
        }
        // exit('error get trace file. (assetManager)');
        return false;
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
     * @author Kaero / modified by JohnJ
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    public function registerScript($name, $pattern = 'default') {
        $paths = $this->Get_trace('first_file');
        $pattern = $this->processingPatternName($pattern);

        if (!is_array($name)) $name = array($name);

        foreach ($name as $v) {
            $this->registerByType(self::REGISTER_FILE_TYPE_SCRIPT, APPPATH . 'modules/' . $paths . '/assets' . $pattern . '/js/' . $v . '.js');
        }

        return $this;
    }

    /**
     * @return assetManager
     * @access public
     * @author Kaero / modified by JohnJ
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    public function registerStyle($name, $pattern = 'default') {
        $paths = $this->Get_trace('first_file');
        $pattern = $this->processingPatternName($pattern);

        if (!is_array($name)) $name = array($name);

        foreach ($name as $v) {
            \CI_Controller::get_instance()->template->registerCssFile(APPPATH . 'modules/' . $paths . '/assets' . $pattern . '/css/' . $v . '.css', 'before');
        }

        return $this;
    }

    /**
     * Includes some register* functions
     * @param $type - one of constants assetManager::REGISTER_FILE_TYPE_*
     * @param $path - path to file
     * @return $this
     * @author JohnJ
     * @copyright Free
     */
    private function registerByType($type, $path) {
        if ($type == self::REGISTER_FILE_TYPE_SCRIPT) {
            \CI_Controller::get_instance()->template->registerJsFile($path, 'after');
            return $this;
        } elseif ($type == self::REGISTER_FILE_TYPE_STYLE) {
            \CI_Controller::get_instance()->template->registerCssFile($path, 'before');
            return $this;
        }
        throwException('Unknown register file type: "<i>' . $type . '</i>" for path "<i>' . $path . '</i>"');
    }

    /**
     * Change pattern string for using in path
     * @param $pattern
     * @return string
     * @author JohnJ
     * @copyright Free
     */
    private function processingPatternName($pattern) {
        return !is_string($pattern) || empty($pattern) ? '' : '/' . trim($pattern, '/\\');
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
        $paths = $this->Get_trace('first_file'); 
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
        $paths = $this->Get_trace('first_file'); 
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
        $paths = $this->Get_trace('first_file'); 
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
