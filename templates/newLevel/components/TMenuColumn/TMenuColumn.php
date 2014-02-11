<?php

/**
 * class TMenuColumn for component template_manager
 */
class TMenuColumn extends \template_manager\classes\TComponent {

    /**
     * prepare to save param from xml to db 
     */
    public function setParamsXml(\SimpleXMLElement $nodes) {
        $data = array();
        foreach ($nodes as $node) {
            $nodeAttr = $node->attributes();
            $key = serialize(explode(',', (string)$nodeAttr['value']));
            $data[$key] = (string)$nodeAttr['name'];
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

                if (count($data) > 0) {
                    $countColumn = count($this->getParam());
                    for ($i = 1; $i <= $countColumn; $i++) {
                        if (!array_key_exists($i, $data))
                            $data[$i] = serialize(array());
                    }
                    parent::setParams($data);
                }
            }
        }
    }

    /**
     * render admin tpl with data
     */
    public function renderAdmin() {
        $this->cAssetManager->display('admin/main', array('params' => $this->getParam(), 'handler' => $this->handler));
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
