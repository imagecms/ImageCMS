<?php

/**
 * class TProperties for Components template manager
 */
class TProperties extends \template_manager\classes\TComponent {

    /**
     *  prepare to save param from xml to db 
     * @param \SimpleXMLElement $nodes
     */
    public function setParamsXml(\SimpleXMLElement $nodes) {
        $data = array();
        foreach ($nodes as $node) {
            $nodeAttr = $node->attributes();
            $keys = explode(',', (string)$nodeAttr['name']);
            foreach ($keys as $key) {
                $value = serialize(explode(',', (string)$nodeAttr['value']));
                $data[$key] = $value;
            }
        }
        if (count($data) > 0)
            $this->setParams($data);
    }

    /**
     * prepare to save param from form to db 
     */
    public function setParams($data = array()) {

        if (count($data) > 0)
            parent::setParams($data);
        else {
            if ($_POST['property']) {
                $data = array();
                foreach ($_POST['property'] as $key => $prop) {
                    $keyData = str_replace('prop', '', $key);
                    $arrAux = array();
                    foreach ($prop as $k => $v)
                        $arrAux[] = $k;

                    $keyValue = serialize($arrAux);
                    $data[$keyData] = $keyValue;
                }
                if (count($data) > 0)
                    parent::setParams($data);
            }
        }
    }

    /**
     * prepare param to output
     */
    public function getParam($key = null) {
        $params = parent::getParam($key);
        $paramsWithKey = array();
        foreach ($params as $param)
            $paramsWithKey[$param['key']] = $param['value'];

        $properties = $this->getProperties();
        foreach ($properties as $key => $prop)
            $properties[$key]['param'] = $paramsWithKey[$prop['id']];

        return $properties;
    }

    /**
     * render tpl
     */
    public function renderAdmin() {

        $this->cAssetManager->display('admin/main', array('handler' => $this->handler, 'properties' => $this->getParam()));
    }

    /**
     * id component to save db 
     */
    public function getId() {
        return 6;
    }

    public function getLabel() {
        ;
    }

    /**
     * get properties
     * @return array
     */
    public function getProperties() {
        $locale = \MY_Controller::getCurrentLocale();
        return \CI::$APP->db
                        ->select('shop_product_properties_i18n.id, shop_product_properties_i18n.name, mod_new_level_product_properties_types.type as type')
                        ->join('mod_new_level_product_properties_types', 'mod_new_level_product_properties_types.property_id=shop_product_properties_i18n.id', 'left')
                        ->where('shop_product_properties_i18n.locale', $locale)
                        ->get('shop_product_properties_i18n')
                        ->result_array();
    }

}

?>
