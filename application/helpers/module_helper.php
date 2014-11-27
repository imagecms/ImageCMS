<?php

if (!function_exists('getModulePath')) {

    /**
     * 
     * @param string $moduleName
     * @return string|boolean(false)
     */
    function getModulePath($moduleName) {
        return \CI::$APP->lib_modules->getModulePath($moduleName);
    }

    /**
     * Cheking if file exists in module
     * @param string $module module name
     * @param string $filePath file within module
     * @return boolean 
     */
    function moduleFileExists($module, $filePath) {
        if (!moduleExists($module)) {
            return false;
        }
        return file_exists(getModulePath($module), ltrim($filePath, '/'));
    }

    /**
     * 
     * @param string $moduleName
     * @return boolean
     */
    function moduleExists($moduleName) {
        return \CI::$APP->lib_modules->moduleExists($moduleName);
    }

    /**
     * 
     * @return array moduleName => modulePath
     */
    function getModulesPaths() {
        return \CI::$APP->lib_modules->getModulesPaths();
    }

    /**
     * 
     * @return array list of module names
     */
    function getModulesNames() {
        return \CI::$APP->lib_modules->getModulesNames();
    }

    /**
     * @param string $moduleName
     * @return string
     */
    function getModContDirName($moduleName) {
        return \CI::$APP->lib_modules->getModContDirName($moduleName);
    }

}