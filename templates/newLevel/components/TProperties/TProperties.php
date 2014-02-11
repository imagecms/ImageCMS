<?php

class TProperties extends \template_manager\classes\TComponent {

    public function setParamsXml(\SimpleXMLElement $nodes) {
        $data = array();
        foreach ($nodes as $node) {
            $nodeAttr = $node->attributes();
            $key = serialize(explode(',', $nodeAttr['name']));
            $value = serialize(explode(',', $nodeAttr['value']));
            $data[$key] = $value;
        }
        if (count($data) > 0)
            $this->setParams($data);
    }

    public function setParams() {

        foreach ($_POST['column'] as $col => $value) {
            $key = serialize(explode(',', $value));
            $value = str_replace('col', '', $col);
            $data[$key] = $nodeAttr['value'];
        }

        if (count($data) > 0)
            parent::setParams($data);
    }
    
    public function renderAdmin() {
        ;
    }

}

?>
