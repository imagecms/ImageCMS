<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 *
 * Класс редиректа удаленных товаров
 */
class Trash extends MY_Controller {

    /**
     * Construct.
     */
    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('trash');
        $this->load->module('core');
    }

    /**
     * Index method.
     * 
     * @return void 
     */
    public function index() {
        $this->core->error_404();
    }

    /**
     * AdminAutoload method.
     * 
     * @return void 
     */
    public static function adminAutoload() {
        parent::adminAutoload();
        \CMSFactory\Events::create()->onShopProductDelete()->setListener('addProductWhenDelete');
        \CMSFactory\Events::create()->onShopProductCreate()->setListener('delProductWhenCreate');
        \CMSFactory\Events::create()->onShopProductAjaxChangeActive()->setListener('addProductWhenAjaxChangeActive');
        \CMSFactory\Events::create()->onShopCategoryDelete()->setListener('addProductsWhenCatDelete');
    }

    /**
     * Autoload method.
     * 
     * @return void 
     */
    public function autoload() {
        $row = $this->db->get_where('trash', array('trash_url' => $this->uri->uri_string()))->row();
        if ($row != null) {
            ($row->trash_redirect_type != '404') OR $this->core->error_404();
            redirect($row->trash_redirect, 'location', $row->trash_type);
        }
    }

    /**
     * AddProductsWhenCatDelete - adding redirects on category deleting.
     *  
     * @param array $arg
     * 
     * @return void 
     */
    public static function addProductsWhenCatDelete(array $arg) {
        
    }

    public static function delProductWhenCreate($arg) {
        $model = $arg['model'];
        $ci = &get_instance();
        $ci->db->where('trash_url', 'shop/product/' . $model->url)->delete('trash');
    }

    public static function addProductWhenAjaxChangeActive($arg) {
        /* @var $model SProducts */
        $models = $arg['model'];
        /* @var $ci MY_Controller */
        $ci = &get_instance();

        if (!$models instanceof \PropelObjectCollection) {
            $model = $models;
            $models = new \PropelObjectCollection();
            $models->append($model);
        }

        foreach ($models as $model) {
            if ($model->getActive()) {
                $ci->db->where('trash_url', 'shop/product/' . $model->getUrl())->delete('trash');
            } else {
                $array = array(
                    'trash_id' => $model->getCategoryId(),
                    'trash_url' => 'shop/product/' . $model->getUrl(),
                    'trash_redirect_type' => 'category',
                    'trash_type' => '302',
                    'trash_redirect' => shop_url('category/' . $model->getMainCategory()->getFullPath())
                );
                $ci->db->insert('trash', $array);
            }
        }
    }

    public static function addProductWhenDelete($arg) {
        $models = $arg['model'];
        $ci = &get_instance();
        foreach ($models as $model) {
            $array = array(
                'trash_id' => $model->category_id,
                'trash_url' => 'shop/product/' . $model->url,
                'trash_redirect_type' => 'category',
                'trash_type' => '301',
                'trash_redirect' => shop_url('category/' . $model->getMainCategory()->getFullPath())
            );
            $ci->db->insert('trash', $array);
        }
    }

    public function _install() {
        $this->load->dbforge();
        ($this->dx_auth->is_admin()) OR exit;
        $fields = array(
            'id' => array(
                'type' => 'INT',
                'auto_increment' => TRUE
            ),
            'trash_id' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE,
            ),
            'trash_url' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE,
            ),
            'trash_redirect_type' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
                'null' => TRUE,
            ),
            'trash_redirect' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE,
            ),
            'trash_type' => array(
                'type' => 'VARCHAR',
                'constraint' => '3',
                'null' => TRUE,
            ),
        );

        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('trash');

        $this->db->where('name', 'trash');
        $this->db->update('components', array('enabled' => 0, 'autoload' => 1));
    }

    public function _deinstall() {
        $this->load->dbforge();
        ($this->dx_auth->is_admin()) OR exit;
        $this->dbforge->drop_table('trash');
    }

}

/* End of file trash.php */