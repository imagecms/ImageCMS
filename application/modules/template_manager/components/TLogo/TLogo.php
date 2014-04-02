<?php

/**

 * class TLogo for components template_manager
 */

class TLogo extends \template_manager\classes\TComponent{
    
    public function getParam(){
        ;
    }
    
    public function setParams() {
        
         
    }
        
    

    public function getId() {
        ;
    }
    public function setParamsXml(\SimpleXMLElement $nodes) {
        ;
    }
    public function getLabel() {
        ;
    }
    public function renderAdmin() {
        $this->cAssetManager->display('admin/main', array('handler' => $this->handler, 'logos' => $this->getParam()));
    }
}