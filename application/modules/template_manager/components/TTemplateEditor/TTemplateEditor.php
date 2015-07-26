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
    public function setParamsXml(\SimpleXMLElement $nodes = NULL) {
        return FALSE;
    }

    /**
     * Get lable, component name
     * @return string
     */
    public function getLabel() {
        return lang('Template Editor', 'template_manager');
    }

    /**
     * Get component type, class name
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
