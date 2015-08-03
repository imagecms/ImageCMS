<?php

namespace template_manager\classes;

/**
 * Class for working with template archive
 * Template archive must always be zip-type
 * 
 * Can return some information about template (name, color schemes...)
 */
class TArchive {

    /**
     * 
     * @var \ZipArchive 
     */
    private $zip;

    /**
     * Files structure of archive
     * @var array
     */
    private $tree = array();

    /**
     * Archive must have in root only one folder with template
     * this folder name is the template name
     * @var string
     */
    private $templateName;

    /**
     * Color schemes of template
     * @var array
     */
    private $colorSchemes = array();

    /**
     * Components of template
     * @var array
     */
    private $components = array();

    /**
     * 
     * @param string $zipPath
     * @throws \Exception
     */
    public function __construct($zipPath) {
        if (!file_exists($zipPath)) {
            throw new \Exception(lang('Specified zip file does not exists', 'template_manager'));
        }
        $this->zip = new \ZipArchive();
        $this->zip->open($zipPath);

        $this->getTree_();

        if (count($this->tree) == 1) {
            $this->templateName = key($this->tree);
            $this->getColorSchemes_();
            $this->getComponents_();
        }
    }

    /**
     * Unpacking the archive to ./templates/ folder
     * @param string $unpackPath (optional) path to templates folder (default ./templates)
     * @return string template name
     * @throws \Exception
     */
    public function unpack($unpackPath = TEMPLATES_PATH) {
        // in root of the archive must be only one folder with template name
        if (is_null($this->templateName)) {
            throw new \Exception(lang('Bad archive structure', 'template_manager'));
        }

        // in the root directory of the template must file with the settings
        if (!in_array('params.xml', $this->tree[$this->templateName])) {
            throw new \Exception(lang('No params.xml file', 'template_manager'));
        }

        if (is_dir($unpackPath . $this->templateName)) {
            throw new \Exception(lang('Template already exists', 'template_manager'));
        }

        if (!$this->zip->extractTo($unpackPath)) {
            throw new \Exception(lang('Unable to extract archive', 'template_manager'));
        }

        return true;
    }

    /**
     * 
     * @return \ZipArchive
     */
    public function getZipHandler() {
        return $this->zip;
    }

    /**
     * 
     * @return null|string null if error in structure of archive or template name
     */
    public function getTemplateName() {
        return $this->templateName;
    }

    /**
     * 
     * @return null|array null if error in structure of archive or array with color schemes
     */
    public function getColorSchemes() {
        if (is_null($this->templateName)) {
            return null;
        }
        return $this->colorSchemes;
    }

    /**
     * 
     * @return null|array null if error in structure of archive or array with components
     */
    public function getComponents() {
        if (is_null($this->templateName)) {
            return null;
        }
        return $this->components;
    }

    private function getColorSchemes_() {
        if (is_null($this->templateName)) {
            return;
        }

        foreach ($this->tree[$this->templateName]['css'] as $key => $item) {
            if (is_array($item)) { // color schemas are folders
                if (preg_match('/^color_scheme_(.*)$/', $key)) {
                    array_push($this->colorSchemes, $key);
                }
            }
        }
    }

    private function getComponents_() {
        if (is_null($this->templateName)) {
            return;
        }
        if (!isset($this->tree[$this->templateName]['components'])) {
            return;
        }
        if (count($this->tree[$this->templateName]['components']) == 0) {
            return;
        }
        $this->components = array_keys($this->tree[$this->templateName]['components']);
    }

    private function getTree_() {
        for ($i = 0; $i < $this->zip->numFiles; $i++) {
            $pathString = $this->zip->getNameIndex($i);
            $isDir = strrpos($pathString, '/') == strlen($pathString) - 1 ? true : false;
            if ($isDir)
                $pathString = rtrim($pathString, '/');
            $pathArray = explode('/', $pathString);
            $this->add($pathArray, $isDir, $this->tree);
        }
    }

    /**
     * Recursive helper function to build files-tree of zip archive
     * @param array $pathArray part of path
     * @param boolean $isDir whether item is directory or not
     * @param array $tree current (processing) part of tree
     */
    private function add($pathArray, $isDir, &$tree) {
        $firstElement = array_shift($pathArray);
        if (count($pathArray) > 0) {
            if (!isset($tree[$firstElement])) {
                $tree[$firstElement] = array();
            }
            $this->add($pathArray, $isDir, $tree[$firstElement]);
        } else {
            if (!$isDir) {
                $tree[] = $firstElement;
            }
        }
    }

    
}

?>
