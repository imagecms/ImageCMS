<?php

/**
 * class TOpi for Components template manager
 */
class TOpi extends \template_manager\classes\TComponent {

    public $notRenderAdminTemplate = TRUE;
    /**
     * render product block
     * @param type $model
     * @param type $data
     * @param type $tpl
     */
    public function OPI($model, $data = array(), $tpl = 'one_product_item') {
        $this->cAssetManager->display($tpl, array_merge($data, array('products' => $model)));
    }

    public function setParamsXml(\SimpleXMLElement $component) {
       ;
    }

    public function getId() {
        
    }

    public function getType() {
        return __CLASS__;
    }

    public function getLabel() {
        return lang('One Product Item', 'template_maneger');
    }

    public function renderAdmin() {
       ;
    }

}
