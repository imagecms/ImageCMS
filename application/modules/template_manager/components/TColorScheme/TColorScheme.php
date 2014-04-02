<?php

/**
 * class TColorScheme for Components template manager
 *
 * @author 
 */
class TColorScheme extends \template_manager\classes\TComponent {

    /**
     * prepare param from xml to save in db
     * @param \SimpleXMLElement $nodes
     */
    public function setParamsXml(\SimpleXMLElement $node) {
        $attrs = $node->attributes();
        $data = array(
            (string) $attrs['name'] => (string) $attrs['value'],
        );
        parent::setParams($data);
    }

    /**
     * prepare param from form to save in db
     */
    public function setParams($data = array()) {
        if (count($data) > 0)
            parent::setParams($data);
        else {
            if ($_POST['colorSchema']) {
                $data = array();
                foreach ($_POST['colorSchema'] as $key => $value) {
                    $val = end(explode('/', $value));
                    $data[$key] = $val;
                }

                if (count($data) > 0)
                    parent::setParams($data);
            }
        }
    }

    /**
     * get all color schema
     * @return array 
     */
    public function getAllColorSchema() {
        $Path = 'templates/' . $this->currTemplate . '/css/';
        $dirList = array();
        if ($handle = opendir($Path)) {
            while (false !== ($schema = readdir($handle)))
                if ($schema != "." && $schema != ".." && !is_file($Path . $schema))
                    $dirList[$schema] = $Path . $schema;
            closedir($handle);
        }
        return $dirList;
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
        $mainSchema = $this->getParam('color_scheme');
        $this->cAssetManager->display('admin/main', array('handler' => $this->handler, 'mainSchema' => 'templates/' . $this->currTemplate . '/css/' . $mainSchema['value'], 'allScheme' => $this->getAllColorSchema()));
    }

}

?>
