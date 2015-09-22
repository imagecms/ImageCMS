<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Module_managment extends CI_Model {

    const TABLE_NAME_SEO = 'smart_filter_semantic_urls';
    const PHYSICAL_TYPE_BRAND = 'brand';
    const PHYSICAL_TYPE_PROPERTY = 'property';

    public function create($data) {
        $data['created'] = time();
        $data['updated'] = time();
        $this->db->insert(self::TABLE_NAME_SEO, $data);
        return $this->db->insert_id();
    }

    public function update($id, $locale, $data) {
        $data['updated'] = time();
        return $this->db
            ->where('id', $id)
            ->where('locale', $locale)
            ->update(self::TABLE_NAME_SEO, $data);
    }

    public function get($locale, $id = null) {
        $locale = $locale ? $locale : MY_Controller::defaultLocale();

        $links = $this->db
            ->select(
                self::TABLE_NAME_SEO . '.*,
            shop_product_properties.csv_name as property_csv_name,
            shop_product_properties.id as property_id,
            shop_product_properties_i18n.name as property_name,
            shop_brands_i18n.name as brand_name,
            shop_brands.url as brand_url,
            shop_brands.id as brand_id,
            shop_category.full_path as category_full_path,  shop_category_i18n.name as category_name,
            shop_category.parent_id as category_parent_id'
            )
            ->where(self::TABLE_NAME_SEO . '.locale', $locale)
            ->order_by('id', 'DESC')
            ->join('shop_category', 'shop_category.id=' . self::TABLE_NAME_SEO . '.category_id')
            ->join('shop_category_i18n', "shop_category_i18n.id=" . self::TABLE_NAME_SEO . '.category_id' . " AND shop_category_i18n.locale='$locale'")
            ->join('shop_brands', "shop_brands.id=" . self::TABLE_NAME_SEO . '.entity_id', 'left')
            ->join('shop_brands_i18n', "shop_brands_i18n.id=" . self::TABLE_NAME_SEO . '.entity_id' . " AND shop_brands_i18n.locale='$locale'", 'left')
            ->join('shop_product_properties', "shop_product_properties.id=" . self::TABLE_NAME_SEO . '.entity_id', 'left')
            ->join('shop_product_properties_i18n', "shop_product_properties_i18n.id=" . self::TABLE_NAME_SEO . '.entity_id' . " AND shop_product_properties_i18n.locale='$locale'", 'left');

        if ($id) {
            $links = $links->where(self::TABLE_NAME_SEO . '.id', $id);
        }

        $links = $links->get(self::TABLE_NAME_SEO);
        return $links ? $links->result_array() : [];
    }

    public function delete($id, $locale) {
        return $this->db
            ->where('id', $id)
            ->where('locale', $locale)
            ->delete(self::TABLE_NAME_SEO);
    }

    public function getBrandsByCategoryId($categoryId, $locale) {
        $locale = $locale ? $locale : MY_Controller::defaultLocale();

        $brands = $this->db->distinct()->select('shop_brands_i18n.name, shop_brands.id, shop_brands.url')
            ->from('shop_brands')
            ->join('shop_products', 'shop_products.brand_id = shop_brands.id')
            ->join('shop_product_categories', 'shop_product_categories.product_id=shop_products.id')
            ->join('shop_brands_i18n', 'shop_brands_i18n.id=shop_brands.id')
            ->where('shop_products.active', 1)
            ->where('shop_product_categories.category_id', $categoryId)
            ->where('shop_brands_i18n.locale', $locale)
            ->order_by('shop_brands_i18n.name')
            ->get();

        if (!$brands) {
            return [];
        }
        return $brands->result_array();
    }

    public function getPropertiesByCategoryId($categoryId, $locale) {
        $locale = $locale ? $locale : MY_Controller::defaultLocale();

        $this->db->distinct()
            ->select('shop_product_properties_categories.property_id, shop_product_properties_i18n.name, shop_product_properties.csv_name')
            ->from('shop_product_properties_categories')
            ->join('shop_product_properties', 'shop_product_properties_categories.property_id=shop_product_properties.id')
            ->join('shop_product_properties_i18n', 'shop_product_properties_categories.property_id=shop_product_properties_i18n.id')
            ->where('shop_product_properties_i18n.locale', $locale)
            ->where('shop_product_properties.show_in_filter', 1)
            ->where('shop_product_properties.active', 1)
            ->where('shop_product_properties_categories.category_id', $categoryId);

        $properties = $this->db
            ->order_by('shop_product_properties.position')
            ->get();

        if (!$properties) {
            return [];
        }

        return $properties->result_array();

    }

    public function getSeoData($entityId, $categoryId, $type = null, $locale = null) {
        $locale = $locale ? $locale : MY_Controller::getCurrentLocale();
        $type = $type ? $type : self::PHYSICAL_TYPE_BRAND;

        $seo = $this->db
            ->where('entity_id', $entityId)
            ->where('category_id', $categoryId)
            ->where('type', $type)
            ->where('locale', $locale)
            ->where('active', 1)
            ->get(self::TABLE_NAME_SEO);

        return $seo ? $seo->row_array() : [];
    }

    public function getProductsValues($propertyId, $categoryId, $locale = null) {
        $locale = $locale ? $locale : MY_Controller::getCurrentLocale();

        $productValues = $this->db->distinct()
            ->select('value, shop_product_properties_data.id')
            ->from('shop_product_properties_data')
            ->join('shop_product_categories', 'shop_product_categories.product_id=shop_product_properties_data.product_id')
            ->join('shop_products', 'shop_product_categories.product_id=shop_products.id')
            ->where('shop_product_properties_data.property_id', $propertyId)
            ->where('shop_product_properties_data.locale', $locale)
            ->where("shop_product_properties_data.value <> ''")
            ->where("shop_products.active = '1'")
            ->where('shop_product_categories.category_id', $categoryId)
            ->order_by('ABS(shop_product_properties_data.value)')
            ->group_by('shop_product_properties_data.value')
            ->get();

        return $productValues ? $productValues->result_array() : [];
    }

    public function saveBatch($data) {
        return $this->db->insert_batch(self::TABLE_NAME_SEO, $data);
    }

    /**
     * Creating needed tables
     */
    public function installModule() {

        $this->load->dbforge();
        ($this->dx_auth->is_admin()) OR exit;

        $fields = [
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true
            ],
            'locale' => [
                'type' => 'VARCHAR',
                'constraint' => 5,
                'null' => false,
            ],
            'type' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
                'null' => false,
            ],
            'category_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false,
            ],
            'entity_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false,
            ],
            'active' => [
                'type' => 'INT',
                'constraint' => 1,
                'null' => true,
                'default' => 0
            ],
            'h1' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'meta_title' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'meta_description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'meta_keywords' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'seo_text' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'custom_url_pattern' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'created' => [
                'type' => 'INT',
                'constraint' => 11
            ],
            'updated' => [
                'type' => 'INT',
                'constraint' => 11
            ],
        ];

        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table(self::TABLE_NAME_SEO);

        $this->db->update('components', ['autoload' => '1'], ['identif' => 'smart_filter'], 1);
    }

    /**
     * Deleting tables
     */
    public function deinstallModule() {

        $this->load->dbforge();
        ($this->dx_auth->is_admin()) OR exit;

        $this->dbforge->drop_table(self::TABLE_NAME_SEO);

        $this->db
            ->where('identif', 'smart_filter')
            ->limit(1)
            ->delete('components');
    }

}