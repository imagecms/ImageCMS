<?php

class TOpi extends \template_manager\classes\TComponent{
    
    public function OPI($model, $data = array(), $tpl = 'one_product_item') {
        \CMSFactory\assetManager::create()
                ->setData('products', $model)
                ->setData($data)
                ->render($tpl, TRUE, FALSE);
    }
    
    public function setParamsXml(\SimpleXMLElement $nodes) {
        ;
    }
}
