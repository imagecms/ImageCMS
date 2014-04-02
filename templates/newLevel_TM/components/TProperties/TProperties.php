<?php

/**
 * class TProperties for Components template manager
 */
class TProperties extends \template_manager\classes\TComponent {

    private $propType = array('dropDown', 'scroll', 'select');

    /**
     * Prepare to save param from xml to db 
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
     * Prepare to save param from form to db 
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
     * Prepare param to output
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
     * Render admin tpl
     */
    public function renderAdmin() {
        $properties = $this->getParam('properties');
        $propertiesSorted = array();
        foreach ($properties['properties'] as $property) {
            $property['values'] = preg_replace('/\s+/', '', $property['values']);
            $propertiesSorted[$property['property_id']] = explode(',', $property['values']);
        }

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

    public function getLabel() {
        ;
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

}

?>
