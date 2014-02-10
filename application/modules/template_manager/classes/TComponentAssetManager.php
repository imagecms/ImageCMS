<?php

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
        $fullPath = $this->tComponentPath . 'assets/css/' . $filePath;
        $fullPath = str_replace(array('/', '//', '\\', '\\\\'), DIRECTORY_SEPARATOR, $fullPath);
        \CI_Controller::get_instance()->template->registerCssFile($this->buildStylePath($name), 'before');
    }

    /**
     * 
     * @param string $filePath
     */
    public function registerScriptFile($filePath, $pos = 'after') {
        $fullPath = $this->tComponentPath . 'assets/js/' . $filePath;
        $fullPath = str_replace(array('/', '//', '\\', '\\\\'), DIRECTORY_SEPARATOR, $fullPath);
        \CI_Controller::get_instance()->template->registerJsFile($this->buildScriptPath($name), $position);
    }

    /**
     * 
     * @param string $filePath file name or path to file
     * @param array $data data for template
     * @return string html of component 
     */
    public function fetch($filePath, array $data = array()) {
        $fullPath = $this->tComponentPath . 'assets/' . $filePath;
        $fullPath = str_replace(array('/', '//', '\\', '\\\\'), DIRECTORY_SEPARATOR, $fullPath);
        return \CI_Controller::get_instance()->template->fetch('file:' . $fullPath, $data);
    }

}

?>
