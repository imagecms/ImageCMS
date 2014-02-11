<?php

/**
 * class TTemplateEditor for Components template manager
 *
 * @author kolia
 */
class TTemplateEditor extends \template_manager\classes\TComponent {

    /**
     * id component to save db
     * @return int
     */
    public function getId() {
        return 28;
    }

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
        return lang('Color scheme', 'template_manager');
    }

    /**
     * render wityh param
     */
    public function renderAdmin() {
       
        $this->cAssetManager->display('admin/main');
    }

}

?>
