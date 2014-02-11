<?php

/**
 * class TColorScheme for Components template manager
 *
 * @author kolia
 */
class TColorScheme extends \template_manager\classes\TComponent {

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
        $data = array();
        foreach ($nodes as $node) {
            $nodeAttr = $node->attributes();
            $data[(string)$nodeAttr['name']] = (string)$nodeAttr['value'];
        }
        if (count($data) > 0)
            $this->setParams($data);
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
                foreach ($_POST['colorSchema'] as $key => $value){
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
    public function getAllColorSchema(){
        
        $tempaltePath = \CI::$APP->db->get('settings')->row()->site_template;
        $Path = 'templates/' . $tempaltePath . '/css/';
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
        $tempaltePath = \CI::$APP->db->get('settings')->row()->site_template;
        $mainSchema = $this->getParam('color_scheme');
        $this->cAssetManager->display('admin/main', array('handler' => $this->handler, 'mainSchema' => 'templates/' . $tempaltePath . '/css/' . $mainSchema['value'], 'allScheme' => $this->getAllColorSchema()));
    }

}

?>
