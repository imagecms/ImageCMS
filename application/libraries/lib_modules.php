<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Lib_modules {

    /**
     *
     * @var type
     */
    private $modules = array();

    /**
     *
     * @var array
     */
    private $modulesAppRelPath = array();

    public function __construct() {
        $this->setModulesLocations();
        $this->loadModules();
    }

    /**
     * Adding dirs that may contain modules
     */
    private function setModulesLocations() {

        if (FALSE !== $modulesLocations = \CI::$APP->config->item('modules_locations')) {
            $locationsToSet = array();
            $countModulesLocations = count($modulesLocations);
            for ($i = 0; $i < $countModulesLocations; $i++) {
                $withinPath = trim($modulesLocations[$i], '/') . '/';
                $locationsToSet[APPPATH . $withinPath] = "../{$withinPath}";
            }
            \Modules::$locations = $locationsToSet;
        }
    }

    /**
     * Loading all modules names and their paths
     */
    private function loadModules() {
        \CI::$APP->load->helper('file');
        foreach (\Modules::$locations as $path => $relPath) {
            $modulesInLocation = get_dir_file_info($path);
            foreach ($modulesInLocation as $name => $info) {
                $fullModulePath = $path . $name . '/';
                //                var_dump($fullModulePath);
                if (is_dir($fullModulePath)) {
                    $this->modules[$name] = $fullModulePath;
                    $this->modulesAppRelPath[$name] = trim(str_replace(APPPATH, '', $path), '/');
                }
            }
        }
    }

    // ------------ useful methods section -------------

    /**
     *
     * @param type $moduleName
     * @return boolean
     */
    public function getModulePath($moduleName) {
        if (!is_string($moduleName) || empty($moduleName)) {
            throw new \InvalidArgumentException('Module name must be string');
        }
        if (!isset($this->modules[$moduleName])) {
            return false;
        }
        return $this->modules[$moduleName];
    }

    /**
     *
     * @return type
     */
    public function getModulesPaths() {
        return $this->modules;
    }

    /**
     *
     * @return type
     */
    public function getModulesNames() {
        return array_keys($this->modules);
    }

    /**
     *
     * @param type $moduleName
     * @return type
     */
    public function moduleExists($moduleName) {
        if (!is_string($moduleName) || empty($moduleName)) {
            return false;
        }
        return key_exists($moduleName, $this->modules);
    }

    /**
     * Get module containing dir name
     *
     * @param string $moduleName
     */
    public function getModContDirName($moduleName) {
        if (!SHOP_INSTALLED && $moduleName == 'shop') {
            return;
        }
        if (!is_string($moduleName) || empty($moduleName)) {
            throw new \InvalidArgumentException('Module name must be string');
        }
        if (!key_exists($moduleName, $this->modulesAppRelPath)) {
            throw new \UnexpectedValueException("Module [{$moduleName}] not found");
        }
        return $this->modulesAppRelPath[$moduleName];
    }

}