<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

// SHORTCUTS FOR SOME TEMPLATE COMPONENTS METHODS

if (!function_exists('getColorSheme')) {

    function getColorSheme() {
        return callComponentMethod('TColorScheme', __FUNCTION__);
    }

}

if (!function_exists('getOPI')) {

    function getOPI($model, $data = array(), $tpl = 'one_product_item') {
        $tcs = new \template_manager\classes\TComponentShortcut();
        return $tcs->TOpi->getOPI($model, $data, $tpl);
    }

}

if (!function_exists('getPropertyTypes')) {

    function getPropertyTypes($property_id = NULL) {
        $tcs = new \template_manager\classes\TComponentShortcut();
        return $tcs->TProperties->getPropertyTypes($property_id);
    }

}

if (!function_exists('getCategoryColumns')) {

    function getCategoryColumns($category_id = NULL) {
        $tcs = new \template_manager\classes\TComponentShortcut();
        return $tcs->TMenuColumn->getCategoryColumns($category_id);
    }

}

if (!function_exists('getOpenLevels')) {

    function getOpenLevels() {
        $tcs = new \template_manager\classes\TComponentShortcut();
        return $tcs->TMenuColumn->getOpenLevels();
    }

}



if (!function_exists('callComponentMethod')) {

    /**
     * 
     * @param string $componentName
     * @param string $methodName
     * @param ... arguments
     */
    function callComponentMethod($componentName, $methodName) {
        $component = \template_manager\classes\TemplateManager::getInstance()
                ->getCurentTemplate()
                ->getComponent($componentName);

        if (!$component) {
            return false;
        }

        $arguments = func_get_args();

        array_shift($arguments);
        array_shift($arguments);
        return call_user_func(array($component, $methodName), $arguments);
    }

}
