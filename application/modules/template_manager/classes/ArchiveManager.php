<?php

namespace template_manager\classes;

/**
 * 
 *
 * 
 */
class ArchiveManager {

    /**
     *
     * @var \ZipArchive 
     */
    private $zip;

    /**
     * Folders and files structure
     * @var array
     */
    private $tree = array();

    /**
     *
     * @var string
     */
    private $templateName;

    /**
     *
     * @var array
     */
    private $colorSchemes = array();

    /**
     *
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
            throw new \Exception('Specified zip file doesn\'t exists');
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
            throw new \Exception('Bad archive structure');
        }

        // in the root directory of the template must file with the settings
        if (!in_array('params.xml', $this->tree[$this->templateName])) {
            throw new \Exception('No "params.xml" file');
        }

        if (is_dir($unpackPath . $this->templateName)) {
            throw new \Exception('Template already exists');
        }

        if (!$this->zip->extractTo($unpackPath)) {
            throw new \Exception('Unable to extract archive');
        }
    }

    public function getTemplateName() {
        return $this->templateName;
    }

    public function getColorSchemes() {
        if (is_null($this->templateName)) {
            return null;
        }
        return $this->colorSchemes;
    }

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
            $isDir = strrpos($pathString, DIRECTORY_SEPARATOR) == strlen($pathString) - 1 ? true : false;
            if ($isDir)
                $pathString = rtrim($pathString, DIRECTORY_SEPARATOR);
            $pathArray = explode(DIRECTORY_SEPARATOR, $pathString);
            $this->add($pathArray, $isDir, $this->tree);
        }
    }

    /**
     * Recursive helper function to build content-tree of zip archive
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
