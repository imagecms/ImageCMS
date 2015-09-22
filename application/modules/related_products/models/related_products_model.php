<?php

/**
 * @property CI_DB_active_record $db
 * @property DX_Auth $dx_auth
 */
class Related_products_model extends CI_Model {

    /**
     * Related_products table name
     */
    const TABLE = 'mod_related_products';

    private $updateData = [];

    private $alreadyUpdated = [];

    private $mainProductData = [];

    public function __construct() {
        parent::__construct();
    }

    /**
     * Save related products
     * @param integer $main_product_id - main product id
     * @param array $related_ids - related products ids
     * @return boolean
     */
    public function saveProducts($main_product_id, $related_ids) {
        $data = [];
        $reverse_data = [];
        foreach ($related_ids as $product_id) {
            if ($product_id != $main_product_id) {
                $data[] = ['product_parent' => $main_product_id, 'product_child' => $product_id];
                $reverse_data[] = ['product_parent' => $product_id, 'product_child' => $main_product_id];
            }

            foreach ($related_ids as $child_id) {
                if ($product_id != $child_id) {
                    $reverse_data[] = ['product_parent' => $product_id, 'product_child' => $child_id];
                }
            }
        }

        $this->db->where('product_parent', $main_product_id)->delete(self::TABLE);
        if ($related_ids) {
            $this->db->where_not_in('product_parent', $related_ids)->where('product_child', $main_product_id)->delete(self::TABLE);
            $this->db->insert_batch(self::TABLE, $data);

            $this->setHitHotAction($main_product_id, $related_ids);

            $this->db->where_in('product_parent', $related_ids)->delete(self::TABLE);
            foreach ($reverse_data as $data) {
                $this->db->insert(self::TABLE, $data);
            }
        } else {
            $this->db->where('product_child', $main_product_id)->delete(self::TABLE);
        }

        return $this->db->affected_rows() ? TRUE : FALSE;
    }

    //    Not recursive version of setHitHotAction method
    //    public function setHitHotAction($main_product_id, $related_ids) {
    //        $main_product = $this->db->where('id', $main_product_id)->get('shop_products');
    //        if ($main_product) {
    //            $main_product = $main_product->row_array();
    //
    //            $update_data = array();
    //            foreach ($related_ids as $product_id) {
    //                $update_data[] = array(
    //                    'id' => $product_id,
    //                    'hit' => $main_product['hit'],
    //                    'hot' => $main_product['hot'],
    //                    'action' => $main_product['action']
    //                );
    //            }
    //            $this->db->update_batch('shop_products', $update_data, 'id');
    //            return $this->db->affected_rows() ? TRUE : FALSE;
    //        }
    //    }

    /**
     * Update hit, hot, action valuer of related products
     * @param integer $main_product_id - main product id
     * @param array $related_ids - related products array
     * @return boolean
     */
    public function setHitHotAction($main_product_id, $related_ids) {
        $main_product = $this->db->where('id', $main_product_id)->get('shop_products');
        if ($main_product) {
            $this->mainProductData = $main_product->row_array();

            $this->alreadyUpdated[$main_product_id] = $main_product_id;
            $this->prepareHitHotActionData($related_ids);
        }
        $this->db->update_batch('shop_products', $this->updateData, 'id');
        return $this->db->affected_rows() ? TRUE : FALSE;
    }

    /**
     * Recursivly prepare updation data for hit, hot, action values
     * @param array $related_ids - relate products ids array
     */
    public function prepareHitHotActionData($related_ids) {
        foreach ($related_ids as $product_id) {
            if (!$this->alreadyUpdated[$product_id]) {

                $this->updateData[] = [
                    'id' => $product_id,
                    'hit' => $this->mainProductData['hit'],
                    'hot' => $this->mainProductData['hot'],
                    'action' => $this->mainProductData['action']
                ];

                $related_prods = $this->getRelatedProdyctsIds($product_id);
                if ($related_prods) {
                    $this->alreadyUpdated[$product_id] = $product_id;
                    $this->prepareHitHotActionData($related_prods);
                }
            }
        }
    }

    /**
     * Get all related products to main product
     * @param integer $main_product_id - main product id
     * @return boolean
     */
    public function getProducts($main_product_id) {
        $related_products = $this->db->where('product_parent', $main_product_id)->get(self::TABLE);
        if ($related_products) {
            $related_products = $related_products->result_array();
            $product_ids = [];
            foreach ($related_products as $product) {
                $product_ids[] = (int) $product['product_child'];
            }

            $products = new SProductsQuery;
            $products = $products->distinct()
                ->joinWithI18n(MY_Controller::defaultLocale())
                ->findPks($product_ids);
            return $products;
        }
        return FALSE;
    }

    /**
     * Returns related product ids array
     * @param integer $main_product_id - main product id
     * @return array
     */
    public function getRelatedProdyctsIds($main_product_id) {
        $related_products = $this->db->where('product_parent', $main_product_id)->get(self::TABLE);
        if ($related_products) {
            $related_products = $related_products->result_array();
            $related_products_ids = [];
            foreach ($related_products as $product) {
                $related_products_ids[] = (int) $product['product_child'];
            }

            return $related_products_ids;
        }
        return [];
    }

    /**
     * Install module data queries
     */
    public function install() {
        $query = $this->db->where('field_name', 'color')->where('entity', 'product')->get('custom_fields');
        if (!$query->num_rows()) {
            $this->db->query(
                "INSERT INTO `custom_fields` (`field_type_id`, `field_name`, `is_required`, `is_active`, `is_private`, `validators`, `entity`, `options`, `classes`, `position`) VALUES
                            (0, 'color', 0, 1, 0, 'test', 'product', NULL, 'ColorPicker', NULL);"
            );

            $id = $this->db->insert_id();
            $this->db->query(
                "INSERT INTO `custom_fields_i18n` (`id`, `locale`, `field_label`, `field_description`, `possible_values`) VALUES
                            (" . $id . ", 'ru', 'Цвет', '<p>Поле выбора цвета</p>', 'N;');"
            );
            $this->db->query(
                "INSERT INTO `custom_fields_i18n` (`id`, `locale`, `field_label`, `field_description`, `possible_values`) VALUES
                            (" . $id . ", 'en', 'Color', '<p>Color selection field</p>', 'N;');"
            );
            $this->db->query(
                "INSERT INTO `custom_fields_i18n` (`id`, `locale`, `field_label`, `field_description`, `possible_values`) VALUES
                            (" . $id . ", 'ua', 'Колір', '<p>Поле вибору кольора</p>', 'N;');"
            );
        }

        $this->db->where('name', 'related_products')
            ->update('components', ['autoload' => '1', 'enabled' => '1']);

        $this->db->query(
            "CREATE TABLE IF NOT EXISTS `" . self::TABLE . "` (
                            `product_parent` int(11) NOT NULL,
                            `product_child` int(11) NOT NULL,
                            PRIMARY KEY (`product_parent`,`product_child`)
                          ) ENGINE=InnoDB DEFAULT CHARSET=latin1;"
        );
    }

    /**
     * Deinstall module data queries
     */
    public function deinstall() {
        $query = $this->db->where('field_name', 'color')->where('entity', 'product')->get('custom_fields');

        if ($query->num_rows()) {
            $field = $query->row();
            $this->db->where('field_name', 'color')->where('entity', 'product')->delete('custom_fields');
            $this->db->where('id', $field->id)->delete('custom_fields_i18n');
        }

        $this->db->where('name', 'related_products')
            ->delete('components');
    }

}