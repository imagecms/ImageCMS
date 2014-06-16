<?php

/**
 * class TOpi for Components template manager
 */
class TOpi extends \template_manager\classes\TComponent {

    /**
     * Not render admin template
     * @var type 
     */
    public $notRenderAdminTemplate = TRUE;

    /**
     * Render product block
     * @param type $model - products models colection
     * @param array $data - template variables array
     * @param string $tpl - template name
     */
    public function getOPI($model, $data = array(), $tpl = 'one_product_item') {
        $this->cAssetManager->display($tpl, array_merge($data, array('products' => $model)));
    }

    /**
     * Prepare param from xml to save in db
     * @param \SimpleXMLElement $nodes
     */
    public function setParamsXml(\SimpleXMLElement $component) {
        ;
    }

    /**
     * Get component type
     * @return system
     */
    public function getType() {
        return __CLASS__;
    }

    /**
     * Get component label
     * @return string
     */
    public function getLabel() {
        return lang('One Product Item component', 'light');
    }

    /**
     * Render admin template
     */
    public function renderAdmin() {
        ;
    }

}
