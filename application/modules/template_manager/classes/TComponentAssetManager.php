<?php

namespace template_manager\classes;

/**
 * Components may have it's own "views" - this class
 * is for comfortably using of tpl-files and clients scripts
 * 
 * Default pathes:
 *  - base assset folder: /ComponentName/assets/
 *  - base script folder: /ComponentName/assets/js/
 *  - base css folder: /ComponentName/assets/css/
 *
 * @author 
 */
class TComponentAssetManager {

    private $tComponentPath;

    public function __construct($tComponentPath) {
        $this->tComponentPath = $tComponentPath;
    }

    /**
     * 
     * @param string $filePath file name or path to file
     */
    public function registerCss($filePath, $pos = 'before') {
        $filePath = strpos($filePath, '.css') === FALSE ? $filePath .= '.css' : $filePath;
        $fullPath = $this->tComponentPath . '/assets/css/' . $filePath;
        $fullPath = str_replace(array('/', '//', '\\', '\\\\'), DIRECTORY_SEPARATOR, $fullPath);
        \CI_Controller::get_instance()->template->registerCss('<style>' . file_get_contents($fullPath) . '</style>', $pos);
    }

    /**
     * 
     * @param string $filePath
     */
    public function registerScript($filePath, $pos = 'after') {
        $filePath = strpos($filePath, '.js') === FALSE ? $filePath .= '.js' : $filePath;
        $fullPath = $this->tComponentPath . '/assets/js/' . $filePath;
        $fullPath = str_replace(array('/', '//', '\\', '\\\\'), DIRECTORY_SEPARATOR, $fullPath);
        \CI_Controller::get_instance()->template->registerJsScript('<script>' . file_get_contents($fullPath) . '</script>', $pos);
    }

    /**
     * 
     * @param string $filePath file name or path to file
     * @param array $data data for template
     * @return string html of component 
     */
    public function fetch($filePath, array $data = array()) {
        $filePath = strpos($filePath, '.tpl') === FALSE ? $filePath .= '.tpl' : $filePath;
        $fullPath = $this->tComponentPath . '/assets/' . $filePath;
        $fullPath = str_replace(array('/', '//', '\\', '\\\\'), DIRECTORY_SEPARATOR, $fullPath);
        return \CI_Controller::get_instance()->template->fetch('file:' . $fullPath, $data);
    }
    /**
     * 
     * @param string $filePath file name or path to file
     * @param array $data data for template
     * @return html
     */
    public function display($filePath, array $data = array()) {
        $filePath = strpos($filePath, '.tpl') === FALSE ? $filePath .= '.tpl' : $filePath;
        $fullPath = $this->tComponentPath . '/assets/' . $filePath;
        $fullPath = str_replace(array('/', '//', '\\', '\\\\'), DIRECTORY_SEPARATOR, $fullPath);
        if (count($data) > 0)
            \CI_Controller::get_instance()->template->add_array($data);
        \CI_Controller::get_instance()->template->display('file:' . $fullPath);
    }

}

?>
