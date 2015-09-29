<?php

/**
 * @property CI_DB_active_record $db
 * @property DX_Auth $dx_auth
 */
class Ymarket_products_fields_model extends CI_Model {

    const TABLE = 'mod_ymarket_products_fields';

    public function __construct() {
        parent::__construct();
    }

    public function setFields($productId, $data) {
        if ($this->db->where('product_id', $productId)->get(self::TABLE)->num_rows) {
            $this->db->where('product_id', $productId)->update(self::TABLE, $data);
        } else {
            $data['product_id'] = $productId;
            $this->db->insert(self::TABLE, $data);
        }
        return $this->db->affected_rows();
    }

    public function getFields($productId) {
        $fields = $this->db->where('product_id', $productId)->get(self::TABLE);
        $fields = $fields ? $fields->row_array() : [];

        return $fields;
    }

    public function getProductsFields() {
        $fields = $this->db->get(self::TABLE);
        $fields = $fields ? $fields->result_array() : [];

        $fieldsData = [];
        array_map(
            function($field) use(&$fieldsData) {
                $fieldsData[$field['product_id']] = $field;
            },
            $fields
        );

        return $fieldsData;
    }

}