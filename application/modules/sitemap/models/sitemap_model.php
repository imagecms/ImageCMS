<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * @property CI_DB_active_record $db
 * @property DX_Auth $dx_auth
 */
class Sitemap_model extends CI_Model
{

    protected $activeCategories = [];

    protected $categoriesSelected;

    /**
     * Sitemap_model constructor.
     */
    public function __construct() {

        parent::__construct();
    }

    /**
     * Get priorities
     * @return array
     */
    public function getPriorities() {

        $priorities = $this->db->limit(1)->get('mod_sitemap_priorities');
        if ($priorities) {
            return $priorities->row_array();
        } else {
            return [];
        }
    }

    /**
     * Get change frequency
     * @return array
     */
    public function getChangefreq() {

        $changeFreq = $this->db->limit(1)->get('mod_sitemap_changefreq');
        if ($changeFreq) {
            return $changeFreq->row_array();
        } else {
            return [];
        }
    }

    /**
     * Get blocked urls
     * @return array
     */
    public function getBlockedUrls() {

        $urls = $this->db->get('mod_sitemap_blocked_urls');
        return $this->returnData($urls);
    }

    /**
     * Update priorities
     * @param array $data - data array
     * @return boolean
     */
    public function updatePriorities($data = []) {

        return $this->db->where('id', 1)->update('mod_sitemap_priorities', $data);
    }

    /**
     * Update change frequency
     * @param array $data - data array
     * @return boolean
     */
    public function updateChangefreq($data = []) {

        return $this->db->where('id', 1)->update('mod_sitemap_changefreq', $data);
    }

    /**
     * Update blocked urls
     * @param array $data - data array
     * @return boolean
     */
    public function updateBlockedUrls($data = []) {

        $this->db->where('id >', 0)->delete('mod_sitemap_blocked_urls');

        return $this->db->insert_batch('mod_sitemap_blocked_urls', $data);
    }

    /**
     * Update sitemap module settings
     * @param array $data - data array
     * @return bool
     */
    public function updateSettings($data = []) {

        $this->db->limit(1);
        $this->db->where('name', 'sitemap');
        return $this->db->update('components', ['settings' => serialize($data)]);
    }

    /**
     * Get module settings
     * @return array
     */
    public function load_settings() {

        $this->db->select('settings');
        $this->db->where('name', 'sitemap');
        $query = $this->db->get('components', 1)->row_array();

        return unserialize($query['settings']);
    }

    /**
     * Get all pages
     * @return array
     */
    public function get_all_pages() {

        $this->db->select('content.id, content.created, content.updated, content.lang');
        $this->db->select('if(parent_url <> "",concat(parent_url, "/"), "") as cat_url', FALSE);
        $this->db->select('if(parent_url <> "", concat(parent_url, "/", url), url) as full_url', FALSE);
        $this->db->join('route', 'route.id = content.route_id');
        $this->db->where('post_status', 'publish');
        $this->db->where('publish_date <=', time());
        $result = $this->db->get('content');

        return $this->returnData($result);
    }

    /**
     * Get category pages
     * @param integer $id
     * @return array
     */
    public function get_cateogry_pages($id = 0) {

        $this->db->select('id, created, updated, lang, title as name');
        $this->db->select('CONCAT_WS("", cat_url, url) as full_url', FALSE);
        $this->db->where('lang', $this->config->item('cur_lang'));
        $this->db->where('category', $id);
        $this->db->where('post_status', 'publish');
        $this->db->where('publish_date <=', time());
        $result = $this->db->get('content');

        return $this->returnData($result);
    }

    /**
     * Get shop categories
     * @return array
     */
    public function get_shop_categories() {

        $result = $this->db
            ->select('shop_category_i18n.locale, shop_category.*, route.url, route.parent_url')
            ->join('languages', 'languages.identif = shop_category_i18n.locale and languages.active = 1')
            ->join('shop_category', 'shop_category_i18n.id = shop_category.id')
            ->join('route', 'route.id = shop_category.route_id')
            ->where('shop_category.active', 1)
            ->get('shop_category_i18n');

        $categories = $this->returnData($result);
        $this->checkActivity($categories);
        $this->categoriesSelected = true;
        return $categories;
    }

    /**
     * Check if all parents are active
     * @param $categoryId
     * @return bool
     */
    public function categoryIsActive($categoryId) {
        if (!$this->categoriesSelected) {
            $this->get_shop_categories();
        }
        return in_array((int) $categoryId, $this->activeCategories);
    }

    /**
     * Fill array of un active categories
     * Category is un active if at leas one parent is not active
     * @param $categories
     */
    private function checkActivity($categories) {
        $activeCategories = [];
        foreach ($categories as $category) {
            if (!in_array((int) $category['id'], $activeCategories)) {
                array_push($activeCategories, (int) $category['id']);

            }
        }

        $unActive = [];
        foreach ($categories as $category) {
            $parentCategories = unserialize($category['full_path_ids']);
            $count = count($parentCategories);
            $countIntersect = count(array_intersect($activeCategories, $parentCategories));
            if ($count > 0 && $count !== $countIntersect && !in_array($category['id'], $unActive)) {
                $unActive[] = $category['id'];
            }
        }

        $this->activeCategories = array_diff($activeCategories, $unActive);
    }

    /**
     * Get shop brands
     * @return array
     */
    public function get_shop_brands() {

        $result = $this->db
            ->select('shop_brands_i18n.locale, shop_brands.*')
            ->join('languages', 'languages.identif = shop_brands_i18n.locale and languages.active = 1')
            ->join('shop_brands', 'shop_brands.id = shop_brands_i18n.id')
            ->get('shop_brands_i18n');

        return $this->returnData($result);
    }

    /**
     * Get shop products
     * @return array
     */
    public function get_shop_products() {

        $this->db->select('shop_products_i18n.locale, route.url, route.parent_url, shop_products.category_id, shop_products.updated, shop_products.created, shop_category.active, shop_category.id');
        $result = $this->db
            ->join('languages', 'languages.identif = shop_products_i18n.locale and languages.active = 1')
            ->join('shop_products', 'shop_products_i18n.id=shop_products.id')
            ->join('shop_category', 'shop_category.id=shop_products.category_id')
            ->join('route', 'route.id = shop_products.route_id')
            ->where('shop_category.active', 1)
            ->where('shop_products.active', 1)
            ->get('shop_products_i18n');

        return $this->returnData($result);
    }

    /**
     * Return data from sql query
     * @param type $result
     * @return array
     */
    public function returnData($result) {

        if ($result) {
            return $result->result_array();
        } else {
            return [];
        }
    }

    /**
     * Install sitemap module
     * @param integer $robotsCheck - robots status (0 - turn off, 1 - turn on)
     */
    public function installModule($robotsCheck) {

        $this->load->dbforge();
        ($this->dx_auth->is_admin()) OR exit;

        $fields = [
                   'id'                               => [
                                                          'type'           => 'INT',
                                                          'auto_increment' => TRUE,
                                                         ],
                   'main_page_priority'               => [
                                                          'type'    => 'FLOAT',
                                                          'null'    => TRUE,
                                                          'default' => 1,
                                                         ],
                   'cats_priority'                    => [
                                                          'type'    => 'FLOAT',
                                                          'null'    => TRUE,
                                                          'default' => 1,
                                                         ],
                   'pages_priority'                   => [
                                                          'type'    => 'FLOAT',
                                                          'null'    => TRUE,
                                                          'default' => 1,
                                                         ],
                   'sub_cats_priority'                => [
                                                          'type'    => 'FLOAT',
                                                          'null'    => TRUE,
                                                          'default' => 1,
                                                         ],
                   'products_priority'                => [
                                                          'type'    => 'FLOAT',
                                                          'null'    => TRUE,
                                                          'default' => 1,
                                                         ],
                   'products_categories_priority'     => [
                                                          'type'    => 'FLOAT',
                                                          'null'    => TRUE,
                                                          'default' => 1,
                                                         ],
                   'products_sub_categories_priority' => [
                                                          'type'    => 'FLOAT',
                                                          'null'    => TRUE,
                                                          'default' => 1,
                                                         ],
                   'brands_priority'                  => [
                                                          'type'    => 'FLOAT',
                                                          'null'    => TRUE,
                                                          'default' => 1,
                                                         ],
                  ];

        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('mod_sitemap_priorities');

        $this->db->insert(
            'mod_sitemap_priorities',
            [
             'main_page_priority'               => 1,
             'cats_priority'                    => 1,
             'pages_priority'                   => 1,
             'sub_cats_priority'                => 1,
             'products_priority'                => 1,
             'products_categories_priority'     => 1,
             'products_sub_categories_priority' => 1,
             'brands_priority'                  => 1,
            ]
        );

        $fields = [
                   'id'                                 => [
                                                            'type'           => 'INT',
                                                            'auto_increment' => TRUE,
                                                           ],
                   'main_page_changefreq'               => [
                                                            'type'       => 'VARCHAR',
                                                            'null'       => TRUE,
                                                            'constraint' => '255',
                                                           ],
                   'pages_changefreq'                   => [
                                                            'type'       => 'VARCHAR',
                                                            'null'       => TRUE,
                                                            'constraint' => '255',
                                                           ],
                   'product_changefreq'                 => [
                                                            'type'       => 'VARCHAR',
                                                            'null'       => TRUE,
                                                            'constraint' => '255',
                                                           ],
                   'categories_changefreq'              => [
                                                            'type'       => 'VARCHAR',
                                                            'null'       => TRUE,
                                                            'constraint' => '255',
                                                           ],
                   'products_categories_changefreq'     => [
                                                            'type'       => 'VARCHAR',
                                                            'null'       => TRUE,
                                                            'constraint' => '255',
                                                           ],
                   'products_sub_categories_changefreq' => [
                                                            'type'       => 'VARCHAR',
                                                            'null'       => TRUE,
                                                            'constraint' => '255',
                                                           ],
                   'brands_changefreq'                  => [
                                                            'type'       => 'VARCHAR',
                                                            'null'       => TRUE,
                                                            'constraint' => '255',
                                                           ],
                   'sub_categories_changefreq'          => [
                                                            'type'       => 'VARCHAR',
                                                            'null'       => TRUE,
                                                            'constraint' => '255',
                                                           ],
                  ];

        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('mod_sitemap_changefreq');

        $this->db->insert(
            'mod_sitemap_changefreq',
            [
             'main_page_changefreq'               => 'weekly',
             'pages_changefreq'                   => 'weekly',
             'product_changefreq'                 => 'weekly',
             'categories_changefreq'              => 'weekly',
             'products_categories_changefreq'     => 'weekly',
             'products_sub_categories_changefreq' => 'weekly',
             'brands_changefreq'                  => 'weekly',
             'sub_categories_changefreq'          => 'weekly',
            ]
        );

        $fields = [
                   'id'           => [
                                      'type'           => 'INT',
                                      'auto_increment' => TRUE,
                                     ],
                   'url'          => [
                                      'type'       => 'VARCHAR',
                                      'null'       => FALSE,
                                      'constraint' => '255',
                                     ],
                   'robots_check' => [
                                      'type'    => 'INT',
                                      'null'    => TRUE,
                                      'default' => 0,
                                     ],
                  ];

        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('mod_sitemap_blocked_urls');

        $this->db->where('name', 'sitemap');
        $this->db->delete('components');

        $data = [
                 'robotsStatus'       => $robotsCheck,
                 'generateXML'        => 1,
                 'sendSiteMap'        => 1,
                 'lastSend'           => 0,
                 'sendWhenUrlChanged' => 0,
                ];

        $this->db->insert(
            'components',
            [
             'name'     => 'sitemap',
             'identif'  => 'sitemap',
             'autoload' => '1',
             'enabled'  => '1',
             'settings' => serialize($data),
            ]
        );
    }

    /**
     * @return true
     */
    public function deinstallModule() {

        $this->load->dbforge();
        ($this->dx_auth->is_admin()) OR exit;

        $this->dbforge->drop_table('mod_sitemap_changefreq');
        $this->dbforge->drop_table('mod_sitemap_priorities');
        $this->dbforge->drop_table('mod_sitemap_blocked_urls');

        $this->db->where('name', 'sitemap')->delete('components');
        return TRUE;
    }

}