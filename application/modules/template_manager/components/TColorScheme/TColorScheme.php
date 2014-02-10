<?php

/**
 * 
 *
 * @author kolia
 */
class TColorScheme extends \template_manager\classes\TComponent {

    public function getId() {
        return 1;
    }

    public function setParamsXml(\SimpleXMLElement $nodes) {
        
    }

    public function getLabel() {
        return lang('Color scheme', 'template_manager');
    }

    public function renderAdmin() {
        $this->cAssetManager->registerScriptFile('script');
        //echo $this->cAssetManager->fetch('some_asset', array('data' => $this->getParam()));
    }
    public function getParam($key = null) {
        parent::getParam($key);
    }
}

?>
