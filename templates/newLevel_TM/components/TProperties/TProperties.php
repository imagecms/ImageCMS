<?php

/**
 * class TProperties for Components template manager
 */
class TProperties extends \template_manager\classes\TComponent {

    /**
     * Properties names
     * @var type 
     */
    private $propType = array('dropDown', 'scroll', 'select');

    /**
     * Prepare param from xml to save in db
     * @param \SimpleXMLElement $nodes
     */
    public function setParamsXml(\SimpleXMLElement $component) {
        $data = array();
        foreach ($component as $item) {
            switch ($item->getName()) {
                case 'params':
                    $params_attributes = $item->attributes();
                    foreach ($item as $param) {
                        $param_attributes = $param->attributes();
                        $data[(string) $params_attributes->name][] = array(
                            'property_id' => (string) $param_attributes->key,
                            'values' => (string) $param_attributes->value
                        );
                    }
                    $data[(string) $params_attributes->name] = serialize($data[(string) $params_attributes->name]);
                    break;
            }
        }

        if (count($data) > 0)
            $this->setParams($data);
    }

    /**
     * Prepare param from form to save in db
     * @param type $data - data array
     */
    public function setParams($data = array()) {
        if (count($data) > 0)
            parent::setParams($data);
    }

    /**
     * Update component params
     */
    public function updateParams() {
        if ($_POST['properties']) {
            $data = \CI::$APP->input->post();
            $dataToUpdate = array();
            foreach ($data['properties'] as $property_id => $values) {
                $dataToUpdate['properties'][] = array(
                    'property_id' => $property_id,
                    'values' => implode(',', $values)
                );
            }

            $dataToUpdate['properties'] = serialize($dataToUpdate['properties']);
            if (count($dataToUpdate) > 0)
                return parent::updateParams($dataToUpdate);
        }
    }

    /**
     * Get param
     * @param string $key - param key
     * @return array
     */
    public function getParam($key = null) {
        $params = parent::getParam($key);
        $params = unserialize($params);
        $data = array();
        if ($key) {
            $data[$key] = $params;
        } else {
            foreach ($params as $param) {
                $data[$key] = $param;
            }
        }

        return $data;
    }

    /**
     * Render admin template
     */
    public function renderAdmin() {
        $properties = $this->getParam('properties');
        $propertiesSorted = array();
        foreach ($properties['properties'] as $property) {
            $property['values'] = preg_replace('/\s+/', '', $property['values']);
            $propertiesSorted[$property['property_id']] = explode(',', $property['values']);
        }

        $this->cAssetManager->registerScript('tprop_script');
        $this->cAssetManager->display('admin/main', array(
            'propType' => $this->propType,
            'handler' => $this->name,
            'properties' => $propertiesSorted,
            'productProperties' => $this->getProductsProperties()
                )
        );
    }

    /**
     * Get component type
     * @return string
     */
    public function getType() {
        return __CLASS__;
    }

    /**
     * Get component label
     * @return string
     */
    public function getLabel() {
        return lang('Properties', 'newLevel_TM');
    }

    /**
     * Get product properties
     * @return array
     */
    public function getProductsProperties() {
        $locale = \MY_Controller::getCurrentLocale();
        return \CI::$APP->db
                        ->select('shop_product_properties_i18n.id, shop_product_properties_i18n.name')
                        ->where('shop_product_properties_i18n.locale', $locale)
                        ->order_by('id')
                        ->get('shop_product_properties_i18n')
                        ->result_array();
    }

    /**
     * Get property types
     * @param int $property_id - propety id
     * @return boolean
     */
    public function getPropertyTypes($property_id = NULL) {

        $component_data = $this->getParam('properties');

        if (!isset($component_data['properties'])) {
            return FALSE;
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
    }

}

?>
