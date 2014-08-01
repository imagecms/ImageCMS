<?php

namespace import_export\classes;

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * @property Core $core
 * @property CI_DB_active_record $db
 */
class PropertiesImport extends \ImportCSV\BaseImport {

    /**
     * Process Properties Handling
     * @access public
     * @author Kaero
     * @copyright ImageCMS (c) 2012, Kaero <dev@imagecms.net>
     */
    public function runProperties() {
        if (ImportBootstrap::hasErrors())
            return FALSE;
        $properties = $this->db->query('SELECT `id`, `csv_name` FROM `shop_product_properties`')->result();
        foreach ($properties as $property)
            $properyAlias[$property->csv_name] = $property->id;

        foreach ($this->content as $key => $node) {
            foreach ($node as $nodeKey => $nodeElement) {
                if (array_key_exists($nodeKey, $properyAlias) && !empty($nodeElement)) {
                    $result = $this->db->query('SELECT * FROM `shop_product_properties_data` WHERE `product_id` = ? AND `property_id` = ?', array($node['ProductId'], $properyAlias[$nodeKey]))->row();
                    if (!($result instanceof \stdClass))
                        $this->db->insert('shop_product_properties_data', array('product_id' => $node['ProductId'], 'property_id' => $properyAlias[$nodeKey], 'locale' => $this->languages, 'value' => $nodeElement));
                    else {
                        $this->db->update('shop_product_properties_data', array('value' => $nodeElement), array('product_id' => $node['ProductId'], 'property_id' => $properyAlias[$nodeKey], 'locale' => $this->languages));
                    }
                    foreach ($node['CategoryIds'] as $categoryId) {
                        $result = $this->db->query('SELECT * FROM `shop_product_properties_categories` WHERE `category_id` = ? AND `property_id` = ?', array($categoryId, $properyAlias[$nodeKey]))->row();
                        if (!($result instanceof \stdClass))
                            $this->db->insert('shop_product_properties_categories', array('property_id' => $properyAlias[$nodeKey], 'category_id' => $categoryId));
                    }

                    $propery = $this->db->query('
                    SELECT `id`, `data`
                    FROM `shop_product_properties_i18n`
                    WHERE id = ? AND locale = ?', array($properyAlias[$nodeKey], $this->languages))->row();
                    $data = (!empty($propery->data)) ? unserialize($propery->data) : array();
                    if (!in_array($nodeElement, $data)) {
                        $data[] = $nodeElement;
                        $this->db->update('shop_product_properties_i18n', array('data' => serialize($data)), array('id' => $properyAlias[$nodeKey], 'locale' => $this->languages));
                    }
                }
            }
        }
    }

    /**
     * Add new value to custom field and save it.
     * @param mixed $name
     * @param mixed $value
     * @access public
     * @return void
     * @author Kaero
     * @copyright ImageCMS (c) 2012, Kaero <dev@imagecms.net>
     */
    public function addCustomFieldValue($name, $value) {
        if (array_key_exists($name, $this->customFieldsCache)) {
            $fieldDataArray = $this->customFieldsCache[$name]->getDataArray();

            if ($fieldDataArray === null)
                $fieldDataArray = array();

            if (!in_array($value, $fieldDataArray)) {
                array_push($fieldDataArray, $value);
                $newData = implode("\n", $fieldDataArray);
                $this->customFieldsCache[$name]->setData($newData);
                $this->customFieldsCache[$name]->save();
                $this->customFieldsCache[$name]->setVirtualColumn('dataArray', $fieldDataArray);
                $this->customFieldsCache[$name]->setData($newData);
            }
        }
    }

    /**
     * Parse Category Name by slashes
     * @param string name
     * @return arrray
     * @access private
     * @author Kaero
     * @copyright ImageCMS (c) 2012, Kaero <dev@imagecms.net>
     */
    private function parseCategoryName($name) {
        $result = array_map('trim', array_map('stripcslashes', preg_split('/\\REPLACE((?:[^\\\\\REPLACE]|\\\\.)*)/', $name, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY)));
        return explode('/', $result[0]);
    }

}