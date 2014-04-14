<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Singleton class for holding data for best performance
 */
class DataComponentsHolder {

    private static $instance = NULL;
    private static $data = array();

    private function __construct() {
        
    }

    public function getInstance() {
        if (self::$instance !== NULL) {
            return self::$instance;
        } else {
            return new self();
        }
    }

    public function setData($key, $data = array()) {
        if ($key) {
            self::$data[$key] = $data;
        }
        return FALSE;
    }

    public function getData($key) {
        if (isset(self::$data[$key])) {
            return self::$data[$key];
        } else {
            return FALSE;
        }
    }

}

if (!function_exists('getColorSheme')) {

    /**
     * Get color sheme for template
     * @return boolean
     */
    function getColorSheme() {
        $component = \template_manager\classes\TemplateManager::getInstance()
                ->getCurentTemplate()
                ->getComponent('TColorScheme');

        if ($component) {
            $component_data = $component->getParam();
            if (isset($component_data['color_scheme'])) {
                return $component_data['color_scheme'];
            }
        }
        return FALSE;
    }

}

if (!function_exists('getOPI')) {

    /**
     * Render one product template
     * @param type $model - product model
     * @param array $data - data for template
     * @param string $tpl - render product template name
     * @return boolean
     */
    function getOPI($model, $data = array(), $tpl = 'one_product_item') {
        $component = \template_manager\classes\TemplateManager::getInstance()
                ->getCurentTemplate()
                ->getComponent('TOpi');

        if ($component) {
            $component->getOPI($model, $data = array(), $tpl = 'one_product_item');
        }
        return FALSE;
    }

}

if (!function_exists('getPropertyTypes')) {

    /**
     * Get property types
     * @param int $property_id - propety id
     * @return boolean
     */
    function getPropertyTypes($property_id = NULL) {
        if (!DataComponentsHolder::getInstance()->getData('properties')) {
            $component = \template_manager\classes\TemplateManager::getInstance()
                    ->getCurentTemplate()
                    ->getComponent('TProperties');

            if ($component) {
                $component_data = $component->getParam('properties');

                if (!isset($component_data['properties'])) {
                    return FALSE;
                } else {
                    DataComponentsHolder::getInstance()->setData('properties', $component_data['properties']);
                }
            }
        } else {
            $component_data['properties'] = DataComponentsHolder::getInstance()->getData('properties');
        }

        if ($property_id !== NULL) {
            foreach ($component_data['properties'] as $property_types) {
                if ($property_types['property_id'] == $property_id) {
                    return explode(',', $property_types['values']);
                }
            }
        } else {
            return $component_data['properties'];
        }

        return FALSE;
    }

}

if (!function_exists('getCategoryColumns')) {

    /**
     * Get category columns names
     * @param int $category_id - category id
     * @return boolean|string
     */
    function getCategoryColumns($category_id = NULL) {
        if (!DataComponentsHolder::getInstance()->getData('columns')) {
            $component = \template_manager\classes\TemplateManager::getInstance()
                    ->getCurentTemplate()
                    ->getComponent('TMenuColumn');

            if ($component) {
                $component_data = $component->getParam('columns');

                if (!isset($component_data['columns'])) {
                    return FALSE;
                } else {
                    DataComponentsHolder::getInstance()->setData('columns', $component_data['columns']);
                }
            }
        } else {
            $component_data['columns'] = DataComponentsHolder::getInstance()->getData('columns');
        }

        if ($category_id !== NULL) {
            $category_columns = array();
            foreach ($component_data['columns'] as $column) {
                $values = explode(',', $column['values']);
                if (in_array($category_id, $values)) {
                    $category_columns[] = $column['column'];
                }
            }

            if ($category_columns) {
                return implode('_', $category_columns);
            } else {
                return '0';
            }
        } else {
            return '0';
        }
    }

}
