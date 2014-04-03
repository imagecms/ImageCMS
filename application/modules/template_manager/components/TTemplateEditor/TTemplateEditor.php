<?php

/**
 * class TTemplateEditor for Components template manager
 *
 * @author kolia
 */
class TTemplateEditor extends \template_manager\classes\TComponent {

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
        return lang('Template Editor', 'template_manager');
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
