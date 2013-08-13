<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Module Exchangeunfu
 */
class Exchangeunfu extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $e = new \exchangeunfu\exc();
        $e->index();
    }

//    public function autoload() {
//
//    }

    public static function adminAutoload() {
        \CMSFactory\Events::create()
                ->onShopProductPreUpdate()
                ->setListener('_extendPageAdmin');
    }

    public static function _extendPageAdmin($data) {
        $ci = &get_instance();
        $array = $ci->db
                ->where('product_id', $data['model']->getid())
                ->get('mod_exchangeunfu')
                ->result_array();

        $view = \CMSFactory\assetManager::create()
                ->setData('data', $array)
                ->fetchTemplate('main');

        \CMSFactory\assetManager::create()
                ->appendData('moduleAdditions', $view);
    }

    public function _install() {

        $this->load->dbforge();

        $fields = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE,
            ),
            'product_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => FALSE,
            ),
            'variant_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => FALSE,
            ),
            'region' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
            ),
            'price' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
            ),
        );

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field($fields);
        $this->dbforge->create_table('mod_exchangeunfu', TRUE);

        $this->db->query('INSERT INTO `mod_exchangeunfu` (`id` ,`product_id` ,`variant_id` ,`region`)
                          VALUES (NULL ,  \'892\',  \'873\',  \'lviv\');');

        $this->db->where('name', 'exchangeunfu')
                ->update('components', array('autoload' => '1', 'enabled' => '1'));
    }

    public function _deinstall() {

        $this->load->dbforge();
        $this->dbforge->drop_table('mod_exchangeunfu');
    }

    /**
     * Colect ids form model and return prices for current region
     * @param SProducts $model
     */
    public function getPriceForRegion($model) {
//        var_dump(count($model));

        if (count($model) == 1) {
            // product
            $ids[] = $model->getId();
        } elseif (count($model) > 1) {
            // category/brand/search
            foreach ($model as $product) {
                $ids[] = $product->getId();
                var_dump($product->getId());
            }
        } else {
            // an empty model
            return false;
        }

        $array = $this->db
                ->where_in('product_id', $ids)
                ->get('mod_exchangeunfu');

        if ($array) {
//            return $array->result_array();
            $result = array();
            foreach ($array->result_array() as $ar) {
                $result[$ar['variant_id']] = $ar['price'];
            }

            var_dump($result);
        }
    }

    /**
     * Get region name from cookie
     * @return string Name of region or null
     */
    public function getRegion() {
        $this->load->helper('cookie');
        return get_cookie('site_region');
    }

}

/* End of file exchangeunfu.php */
