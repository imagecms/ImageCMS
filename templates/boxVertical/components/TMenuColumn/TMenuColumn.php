<?php

/**
 * class TMenuColumn for component template_manager
 */
class TMenuColumn extends \template_manager\classes\TComponent {

    /**
     * Columns names array
     * @var type 
     */
    private $columns = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10);

    /**
     * Prepare param from xml to save in db
     * @param \SimpleXMLElement $nodes
     */
    public function select_column_menu($id, $disabled) {
        $params = $this->getParam('columns');

        $dis = '';
        if ($disabled)
            $dis = 'disabled="disabled"';

        $select = '<select name="categoriesColumns[' . $id . ']" class="input-mini"' . $dis . '>';

        foreach ($this->columns as $i) {
            $selected = '';
            if ($params['columns'][$id] && $params['columns'][$id] == $i)
                $selected = 'selected="selected"';
            $select .= "<option value='" . $i . "'" . $selected . ">" . $i . "</option>";
        }
        $select.='</select>';
        return $select;
    }

    public function setParamsXml(\SimpleXMLElement $component) {
        
        $data = array();
        foreach ($component as $item) {
            switch ($item->getName()) {
                case 'params':
                    $params_attributes = $item->attributes();
                    foreach ($item as $param) {
                        $param_attributes = $param->attributes();
                        $categories_ids = explode(',', (string) $param_attributes->value);
                        foreach ($categories_ids as $category_id){
                            $data[(string) $params_attributes->name][(int)trim($category_id)] = (int) $param_attributes->key;
                        }
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
        $categories = \ShopCore::app()->SCategoryTree->getTree();
        $categoriesT = array();

        foreach ($categories as $category) {
            if ($category->parent_id == 0) {
                $categoriesT[$category->id]['category'] = $category;
            }
        }

        foreach ($categories as $category) {
            if ($categoriesT[$category->parent_id]) {
                if (!$categoriesT[$category->parent_id]['children'])
                    $categoriesT[$category->parent_id]['children'] = array();
                $categoriesT[$category->parent_id]['children'][$category->id]['category'] = $category;
            }
        }

        foreach ($categories as $category) {
            foreach ($categoriesT as $key => $categoryT) {
                if (isset($categoryT['children']) && $categoryT['children'][$category->parent_id]) {
                    if (!$categoriesT[$key]['children'][$category->parent_id]['children'])
                        $categoriesT[$key]['children'][$category->parent_id]['children'] = array();
                    $categoriesT[$key]['children'][$category->parent_id]['children'][] = $category;
                }
            }
        }

        $this->cAssetManager->registerScript('scripts', 'after');
        $this->cAssetManager->display('admin/main', array(
            'handler' => $this->name,
            'openLevels' => $this->getOpenLevels(),
            'categoriesT' => $categoriesT
                )
        );
    }

    /**
     * Update component params
     */
    public function updateParams() {
        if ($_POST['categoriesColumns']) {
            $data = \CI::$APP->input->post();

            $dataToUpdate['columns'] = serialize($data['categoriesColumns']);
            $dataToUpdate['openLevels'] = serialize($data['openLevels']);
            if (count($dataToUpdate) > 0)
                return parent::updateParams($dataToUpdate);
        }
    }

    /**
     * Get component label
     * @return string
     */
    public function getLabel() {
        return lang('Menu Column', 'boxVertical');
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
            return '0';
        }

        if ($category_id !== NULL) {
            return $component_data['columns'][$category_id] ? $component_data['columns'][$category_id] : '0';
        }
        return '0';
    }

    public function getOpenLevels() {
        $component_data = $this->getParam('openLevels');

        if (!isset($component_data['openLevels'])) {
            return 'all';
        } else {
            return $component_data['openLevels'];
        }
    }

}

?>
