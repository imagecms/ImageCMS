<?php

namespace CMSFactory;

/**
 * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
 */
class assetManager {

    protected static $_BehaviorInstance;
    protected $callMapp = null;

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
    public function setData($item, $value = null) {
        if ($value != null AND !is_array($item)) {
            $data[$item] = $value;
        } else {
            $data = $item;
        }
        (empty($data)) OR \CI_Controller::get_instance()->template->add_array((array) $data);
        return $this;
    }

    /**
     * @return assetManager
     * @access public
     * @author Kaero
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    public function registerScript($name) {
        /** Start. Load file into template */
        \CI_Controller::get_instance()->template->registerJsFile($this->buildScriptPath($name), 'after');
        return $this;
    }

    /**
     * @return assetManager
     * @access public
     * @author Kaero
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    public function registerStyle($name) {
        /** Start. Load file into template */
        \CI_Controller::get_instance()->template->registerCssFile($this->buildStylePath($name), 'before');
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
        try {
            /** Start. If file doesn't exists thorow exception */
            file_exists($this->buildAdminTemplatePath($tpl) . '.tpl') OR throwException(sprintf('Can\'t load template file: <i>%s/assets/admin/%s.tpl</i>', $this->getTrace(), $tpl));

            /** Start. Load template file */
            \CI_Controller::get_instance()->template->show('file:' . $this->buildAdminTemplatePath($tpl));
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
        try {
            /** Start. If file doesn't exists thorow exception */
            file_exists($this->buildTemplatePath($tpl) . '.tpl') OR throwException(sprintf('Can\'t load template file: <i>%s/assets/%s.tpl</i>', $this->getTrace(), $tpl));

            /** Start. Load template file */
            \CI_Controller::get_instance()->template->show('file:' . $this->buildTemplatePath($tpl), !$ignoreWrap);
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
        try {
            /** Start. If file doesn't exists thorow exception */
            file_exists($this->buildTemplatePath($tpl) . '.tpl') OR throwException('Can\'t load template file: <i>' . $paths . DIRECTORY_SEPARATOR . $tpl . '.tpl</i>');

            /** Start. Return template file */
            return \CI_Controller::get_instance()->template->fetch('file:' . $this->buildTemplatePath($tpl));
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
        self::$_BehaviorInstance->callMapp = debug_backtrace();
        return self::$_BehaviorInstance;
    }

    /**
     * @param string
     * @return array
     * @access public
     * @author cutter
     */
    private function getTrace($list = 'first_file') {
        if ($list == 'first_file') {
            $paths = explode(DIRECTORY_SEPARATOR, $this->callMapp[0]['file']);
            return $paths[count($paths) - 2];
        }

        if ($list == 'first') {
            return $this->callMapp[0];
        }

        if ($list == 'all') {
            return $this->callMapp;
        }
        if (is_numeric($list)) {
            return $this->callMapp[$list];
        }
        return false;
    }

    /**
     * Return formated path
     * @return string
     * @access private
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    private function buildTemplatePath($tpl) {
        return sprintf('%smodules/%s/assets/%s', APPPATH, $this->getTrace(), $tpl);
    }

    /**
     * Return formated path
     * @return string
     * @access private
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    private function buildAdminTemplatePath($tpl) {
        return sprintf('%smodules/%s/assets/admin/%s', APPPATH, $this->getTrace(), $tpl);
    }

    /**
     * Return formated path for JS - script files
     * @return string
     * @access private
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    private function buildScriptPath($tpl) {
        return sprintf('%smodules/%s/assets/js/%s.js', APPPATH, $this->getTrace(), $tpl);
    }

    /**
     * Return formated path for css
     * @return string
     * @access private
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    private function buildStylePath($tpl) {
        return sprintf('%smodules/%s/assets/css/%s.css', APPPATH, $this->getTrace(), $tpl);
    }

}

/** End of file /application/modules/CMSFactory/assetManager.php */
?>