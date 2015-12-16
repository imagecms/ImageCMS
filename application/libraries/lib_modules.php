<?php

use CI;
use Modules;

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Lib_modules
{

    /**
     *
     * @var array
     */
    private $modules = [];

    /**
     *
     * @var array
     */
    private $modulesAppRelPath = [];

    public function __construct() {

        $this->setModulesLocations();
        $this->loadModules();
    }

    /**
     * Adding dirs that may contain modules
     */
    private function setModulesLocations() {

        if (FALSE !== $modulesLocations = CI::$APP->config->item('modules_locations')) {
            $locationsToSet = [];
            $countModulesLocations = count($modulesLocations);
            for ($i = 0; $i < $countModulesLocations; $i++) {
                $withinPath = trim($modulesLocations[$i], '/') . '/';
                $locationsToSet[APPPATH . $withinPath] = "../{$withinPath}";
            }
            Modules::$locations = $locationsToSet;
        }
    }

    /**
     * Loading all modules names and their paths
     */
    private function loadModules() {

        CI::$APP->load->helper('file');
        foreach (Modules::$locations as $path => $relPath) {
            $modulesInLocation = get_dir_file_info($path);
            foreach ($modulesInLocation as $name => $info) {
                $fullModulePath = $path . $name . '/';
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
     * @param string $moduleName
     * @return boolean|string
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
     * @return array
     */
    public function getModulesPaths() {

        return $this->modules;
    }

    /**
     * @return array
     */
    public function getModulesNames() {

        return array_keys($this->modules);
    }

    /**
     *
     * @param string $moduleName
     * @return bool
     */
    public function moduleExists($moduleName) {

        if (!is_string($moduleName) || empty($moduleName)) {
            return false;
        }
        return array_key_exists($moduleName, $this->modules);
    }

    /**
     * Get module containing dir name
     *
     * @param string $moduleName
     * @return string
     */
    public function getModContDirName($moduleName) {

        if (!SHOP_INSTALLED && $moduleName == 'shop') {
            return;
        }
        if (!is_string($moduleName) || empty($moduleName)) {
            throw new \InvalidArgumentException('Module name must be string');
        }
        if (!array_key_exists($moduleName, $this->modulesAppRelPath)) {
            throw new \UnexpectedValueException("Module [{$moduleName}] not found");
        }
        return $this->modulesAppRelPath[$moduleName];
    }

}