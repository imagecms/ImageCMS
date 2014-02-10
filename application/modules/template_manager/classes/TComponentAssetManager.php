<?php

namespace template_manager\classes;

/**
 * 
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
     * @param string $fileName file name or path to file
     */
    public function registerCssFile($fileName, $pos = 'before') {
        $filePath = strpos($filePath, '.css') === FALSE ? $filePath .= '.css' : $filePath;
        $fullPath = $this->tComponentPath . '/assets/css/' . $filePath;
        $fullPath = str_replace(array('/', '//', '\\', '\\\\'), DIRECTORY_SEPARATOR, $fullPath);
        \CI_Controller::get_instance()->template->registerCssFile($fullPath, $pos);
    }

    /**
     * 
     * @param string $filePath
     */
    public function registerScriptFile($filePath, $pos = 'after') {
        $filePath = strpos($filePath, '.js') === FALSE ? $filePath .= '.js' : $filePath;
        $fullPath = $this->tComponentPath . '/assets/js/' . $filePath;
        $fullPath = str_replace(array('/', '//', '\\', '\\\\'), DIRECTORY_SEPARATOR, $fullPath);
        echo '<pre>';
        print_r($fullPath);
        echo '</pre>';
        exit;
        \CI_Controller::get_instance()->template->registerJsFile($fullPath, $pos);
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

}

?>
