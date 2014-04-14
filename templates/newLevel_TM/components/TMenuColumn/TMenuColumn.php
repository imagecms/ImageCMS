<?php

/**
 * class TMenuColumn for component template_manager
 */
class TMenuColumn extends \template_manager\classes\TComponent {

    /**
     * Columns names array
     * @var type 
     */
    private $columns = array(1, 2, 3, 4, 5);

    /**
     * Prepare param from xml to save in db
     * @param \SimpleXMLElement $nodes
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
     * Prepare param from form to save in db
     * @param type $data - data array
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
     * Get param
     * @param string $key - param key
     * @return array
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
     * Render admin template
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

        $this->cAssetManager->registerScript('scripts', 'after');
        $this->cAssetManager->display('admin/main', array(
            'columns' => $this->columns,
            'columns_db' => $columns,
            'handler' => $this->name)
        );
    }

    /**
     * Update component params
     */
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

    /**
     * Get component label
     * @return string
     */
    public function getLabel() {
        return lang('Menu Column', 'template_maneger');
    }

    /**
     * Get component type
     * @return system
     */
    public function getType() {
        return __CLASS__;
    }

    public function getCategoryColumns($category_id = NULL) {
        $component_data = $this->getParam('columns');

        if (!isset($component_data['columns'])) {
            return FALSE;
        }

        if ($category_id !== NULL) {
            $category_columns = array();
            foreach ($component_data['columns'] as $column) {
                $values = explode(',', $column['values']);
                if (in_array($category_id, $values)) {
                    $category_columns[] = $column['column'];
                }
            }

            if (count($category_columns) > 0) {
                return implode('_', $category_columns);
            }
        }
        return '0';
    }

}

?>
