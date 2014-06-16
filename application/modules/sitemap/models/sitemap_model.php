<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @property CI_DB_active_record $db
 * @property DX_Auth $dx_auth
 */
class Sitemap_model extends CI_Model {

    function __construct() {
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
            return array();
        }
    }

    /**
     * Get change frequency
     * @return array
     */
    public function getChangefreq() {
        $changefreq = $this->db->limit(1)->get('mod_sitemap_changefreq');
        if ($changefreq) {
            return $changefreq->row_array();
        } else {
            return array();
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
     * @param type $data - data array
     * @return boolean
     */
    public function updatePriorities($data = array()) {
        return $this->db->where('id', 1)->update('mod_sitemap_priorities', $data);
    }

    /**
     * Update change frequency
     * @param type $data - data array
     * @return boolean
     */
    public function updateChangefreq($data = array()) {
        return $this->db->where('id', 1)->update('mod_sitemap_changefreq', $data);
    }

    /**
     * Update blocked urls
     * @param type $data - data array
     * @return boolean
     */
    public function updateBlockedUrls($data = array()) {
        $this->db->where('id >', 0)->delete('mod_sitemap_blocked_urls');

        return $this->db->insert_batch('mod_sitemap_blocked_urls', $data);
    }

    /**
     * Update sitemap module settings
     * @param array $data  - data array
     * @return bool
     */
    public function updateSettings($data = array()) {
        $this->db->limit(1);
        $this->db->where('name', 'sitemap');
        return $this->db->update('components', array('settings' => serialize($data)));
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
        $this->db->select('id, created, updated, lang,cat_url');
        $this->db->select('CONCAT_WS("", cat_url, url) as full_url', FALSE);
        $this->db->where('post_status', 'publish');
        $this->db->where('publish_date <=', time());
        $result = $this->db->get('content');

        return $this->returnData($result);
    }

    /**
     * Get category pages
     * @param int $id
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
//        $this->db->select('full_path, parent_id');
        $this->db->where('active', 1);
        $result = $this->db->get('shop_category');

        return $this->returnData($result);
    }

    /**
     * Get shop brands
     * @return array
     */
    public function get_shop_brands() {
//        $this->db->select('url');
        $result = $this->db->get('shop_brands');

        return $this->returnData($result);
    }

    /**
     * Get shop products
     * @return array
     */
    public function get_shop_products() {
        $this->db->select('url, updated, created');
        $result = $this->db->where('active', 1)->get('shop_products');

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
            return array();
        }
    }

    /**
     * Install sitemap module
     * @param int $robotsCheck - robots status (0 - turn off, 1 - turn on)
     */
    public function installModule($robotsCheck) {

        $this->load->dbforge();
        ($this->dx_auth->is_admin()) OR exit;

        $fields = array(
            'id' => array(
                'type' => 'INT',
                'auto_increment' => TRUE
            ),
            'main_page_priority' => array(
                'type' => 'FLOAT',
                'null' => TRUE,
                'default' => 1
            ),
            'cats_priority' => array(
                'type' => 'FLOAT',
                'null' => TRUE,
                'default' => 1
            ),
            'pages_priority' => array(
                'type' => 'FLOAT',
                'null' => TRUE,
                'default' => 1
            ),
            'sub_cats_priority' => array(
                'type' => 'FLOAT',
                'null' => TRUE,
                'default' => 1
            ),
            'products_priority' => array(
                'type' => 'FLOAT',
                'null' => TRUE,
                'default' => 1
            ),
            'products_categories_priority' => array(
                'type' => 'FLOAT',
                'null' => TRUE,
                'default' => 1
            ),
            'products_sub_categories_priority' => array(
                'type' => 'FLOAT',
                'null' => TRUE,
                'default' => 1
            ),
            'brands_priority' => array(
                'type' => 'FLOAT',
                'null' => TRUE,
                'default' => 1
            ),
        );

        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('mod_sitemap_priorities');

        $this->db->insert('mod_sitemap_priorities', array(
            'main_page_priority' => 1,
            'cats_priority' => 1,
            'pages_priority' => 1,
            'sub_cats_priority' => 1,
            'products_priority' => 1,
            'products_categories_priority' => 1,
            'products_sub_categories_priority' => 1,
            'brands_priority' => 1
        ));

        $fields = array(
            'id' => array(
                'type' => 'INT',
                'auto_increment' => TRUE
            ),
            'main_page_changefreq' => array(
                'type' => 'VARCHAR',
                'null' => TRUE,
                'constraint' => '255'
            ),
            'pages_changefreq' => array(
                'type' => 'VARCHAR',
                'null' => TRUE,
                'constraint' => '255'
            ),
            'product_changefreq' => array(
                'type' => 'VARCHAR',
                'null' => TRUE,
                'constraint' => '255'
            ),
            'categories_changefreq' => array(
                'type' => 'VARCHAR',
                'null' => TRUE,
                'constraint' => '255'
            ),
            'products_categories_changefreq' => array(
                'type' => 'VARCHAR',
                'null' => TRUE,
                'constraint' => '255'
            ),
            'products_sub_categories_changefreq' => array(
                'type' => 'VARCHAR',
                'null' => TRUE,
                'constraint' => '255'
            ),
            'brands_changefreq' => array(
                'type' => 'VARCHAR',
                'null' => TRUE,
                'constraint' => '255'
            ),
            'sub_categories_changefreq' => array(
                'type' => 'VARCHAR',
                'null' => TRUE,
                'constraint' => '255'
            ),
        );

        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('mod_sitemap_changefreq');

        $this->db->insert('mod_sitemap_changefreq', array(
            'main_page_changefreq' => 'weekly',
            'pages_changefreq' => 'weekly',
            'product_changefreq' => 'weekly',
            'categories_changefreq' => 'weekly',
            'products_categories_changefreq' => 'weekly',
            'products_sub_categories_changefreq' => 'weekly',
            'brands_changefreq' => 'weekly',
            'sub_categories_changefreq' => 'weekly'
        ));


        $fields = array(
            'id' => array(
                'type' => 'INT',
                'auto_increment' => TRUE
            ),
            'url' => array(
                'type' => 'VARCHAR',
                'null' => FALSE,
                'constraint' => '255'
            ),
            'robots_check' => array(
                'type' => 'INT',
                'null' => TRUE,
                'default' => 0
            ),
        );

        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('mod_sitemap_blocked_urls');


        $this->db->where('name', 'sitemap');
        $this->db->delete('components');

        $data = array(
            'robotsStatus' => $robotsCheck,
            'generateXML' => 1,
            'sendSiteMap' => 1,
            'lastSend' => 0,
            'sendWhenUrlChanged' => 0
        );

        return $this->db->insert('components', array(
                    'name' => 'sitemap',
                    'identif' => 'sitemap',
                    'autoload' => '1',
                    'enabled' => '1',
                    'settings' => serialize($data)
                        )
        );
    }

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

?>
