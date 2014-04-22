<?php
/**
 * class TOpi for Components template manager
 */
class TOpi extends \template_manager\classes\TComponent {
    
    /**
     * render product block
     * @param type $model
     * @param type $data
     * @param type $tpl
     */
    public function OPI($model, $data = array(), $tpl = 'one_product_item') {
        $this->cAssetManager->display($tpl, array_merge($data, array('products' => $model)));

    }

    public function setParamsXml(\SimpleXMLElement $nodes) {
        ;
    }

    public function getId() {
        
    }

    public function getLabel() {
        
    }

    public function renderAdmin() {
        echo 'Нет настроек';
        
    }

}
