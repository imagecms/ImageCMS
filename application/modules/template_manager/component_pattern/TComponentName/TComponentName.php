<?php

/**
 * class TComponentName for Components template manager
 *
 */
class TComponentName extends \template_manager\classes\TComponent {

    /**
     * Prepare param from xml to save in db
     * @param \SimpleXMLElement $nodes
     */
    public function setParamsXml(\SimpleXMLElement $nodes) {
        
    }

    /**
     * Get componet lable
     * @return type
     */
    public function getLabel() {
        return lang('Component Name', 'template_manager');
    }

    /**
     * Get component type
     * @return string
     */
    public function getType() {
        return __CLASS__;
    }

    /**
     * Render admin template
     */
    public function renderAdmin() {

        $this->cAssetManager->display('admin/main');
    }

}

?>
