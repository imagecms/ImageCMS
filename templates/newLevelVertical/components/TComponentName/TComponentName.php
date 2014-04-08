<?php

/**
 * class TComponentName for Components template manager
 *
 */
class TComponentName extends \template_manager\classes\TComponent {

    /**
     * prepare param from xml to save in db
     * @param \SimpleXMLElement $nodes
     */
    public function setParamsXml(\SimpleXMLElement $nodes) {
        
    }

    /**
     * 
     * @return type
     */
    public function getLabel() {
        return lang('Component Name', 'template_manager');
    }

    public function getType() {
        return __CLASS__;
    }

    /**
     * render wityh param
     */
    public function renderAdmin() {

        $this->cAssetManager->display('admin/main');
    }

}

?>
