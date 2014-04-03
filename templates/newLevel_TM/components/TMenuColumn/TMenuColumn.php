<?php

/**
 * class TMenuColumn for component template_manager
 */
class TMenuColumn extends \template_manager\classes\TComponent {

    private $column = array(1, 2, 3, 4, 5);

    /**
     * prepare to save param from xml to db 
     */
    public function setParamsXml(\SimpleXMLElement $component) {
        $data = array();
        foreach ($component as $item) {
            switch ($item->getName()) {
                case 'params':
                    $params_attributes = $item->attributes();
                    foreach ($item as $param) {
                        $param_attributes = $param->attributes();
                        $data[(string) $params_attributes->name][] = array(
                            'column' => (string) $param_attributes->key,
                            'values' => (string) $param_attributes->value
                        );
                    }
                    $data[(string) $params_attributes->name] = serialize($data[(string) $params_attributes->name]);
                    break;
            }
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
     * Prepare param to output
     */
    public function getParam($key = null) {
        $params = parent::getParam($key);
        $params = unserialize($params);

        $data = array();
        if ($key) {
            $data[$key] = $params;
        } else {
            foreach ($params as $param) {
                $data[$key] = $param;
            }
        }

        return $data;
    }

    /**
     * render admin tpl with data
     */
    public function renderAdmin() {
        $params = $this->getParam('columns');
        $columns = array();
        if (isset($params['columns'])) {
            foreach ($params['columns'] as $column) {
                $column['values'] = preg_replace('/\s+/', '', $column['values']);
                $columns[$column['column']] = explode(',', $column['values']);
            }
        }

        $this->cAssetManager->display('admin/main', array(
            'columns' => $this->column,
            'columns_db' => $columns,
            'handler' => $this->name)
        );
    }

    public function updateParams() {
        if ($_POST['columns']) {
            $data = \CI::$APP->input->post();
            $dataToUpdate = array();
            foreach ($data['columns'] as $column => $values) {
                $dataToUpdate['columns'][] = array(
                    'column' => $column,
                    'values' => implode(',', $values)
                );
            }
            
            $dataToUpdate['columns'] = serialize($dataToUpdate['columns']);
            if (count($dataToUpdate) > 0)
                return parent::updateParams($dataToUpdate);
        }
    }

    public function getLabel() {
        return lang('Menu Column', 'template_maneger');
    }

    public function getType() {
        return __CLASS__;
    }

}

?>
