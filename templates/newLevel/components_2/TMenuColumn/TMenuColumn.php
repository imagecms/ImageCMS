<?php

/**
 * class TMenuColumn for component template_manager
 */
class TMenuColumn extends \template_manager\classes\TComponent {
    
    private $column = array(1,2,3,4,5);

    /**
     * prepare to save param from xml to db 
     */
    public function setParamsXml(\SimpleXMLElement $nodes) {
        $data = array();
        foreach ($nodes as $node) {
            $nodeAttr = $node->attributes();
            $value = serialize(explode(',', (string) $nodeAttr['value']));
            $data[(string) $nodeAttr['name']] = $value;
        }
        if (count($data) > 0)
            $this->setParams($data);
    }

    /**
     * prepare to save param from form to db 
     */
    public function setParams($data = array()) {
        if (count($data) > 0)
            parent::setParams($data);
        else {
            if ($_POST['column']) {
                $data = array();
                foreach ($_POST['column'] as $col => $value) {
                    $value = serialize($value);
                    $key = str_replace('col', '', $col);
                    $data[$key] = $value;
                }
                if (count($data) > 0) 
                    parent::setParams($data);
                
            }
        }
    }

    /**
     * render admin tpl with data
     */
    public function renderAdmin() {
        $this->cAssetManager->display('admin/main', array('columns' => $this->column,'params' => $this->getParam(), 'handler' => $this->handler));
    }

    /**
     * id component to save db 
     */
    public function getId() {
        return 5;
    }

    public function getLabel() {
        ;
    }

}

?>
