<?php

use Propel\Runtime\Collection\ObjectCollection as PropelObjectCollection;

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
        $url = ltrim(str_replace('/' . MY_Controller::getCurrentLocale() . '/', '', $this->input->server('REQUEST_URI')), '/'); //locale fix
        $row = $this->db
            ->where('trash_url', $url)
            ->or_where('trash_url', $this->uri->uri_string())
            ->get('trash')->row();

        if ($row != null) {
            ($row->trash_redirect_type != '404') OR $this->core->error_404();
            redirect($row->trash_redirect, 'location', $row->trash_type);
        }
    }

    /**
     *
     * @param type $trash_url
     * @param type $redirect_url
     * @param type $type
     * @throws Exception
     */
    public function create_redirect($trash_url, $redirect_url, $type = 301) {

        if (!isset($trash_url)) {
            throw new Exception(lang('Old URL is not specified', 'tresh'));
        }

        if (!isset($redirect_url)) {
            throw new Exception(lang('New URL is not specified', 'tresh'));
        }

        $array = array(
            'trash_url' => ltrim($trash_url, '/'),
            'trash_redirect_type' => 'url',
            'trash_type' => in_array($type, array(301, 302)) ? $type : 301,
            'trash_redirect' => '/' . ltrim($redirect_url, 'http://')
        );

        $this->db->insert('trash', $array);

        if ($this->db->_error_message()) {
            throw new Exception($this->db->_error_message());
        }
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

        if (!$models instanceof PropelObjectCollection) {
            $model = $models;
            $models = new PropelObjectCollection();
            $models->append($model);
        }

        foreach ($models as $model) {
            $ci->db->where('trash_url', 'shop/product/' . $model->getUrl())->delete('trash');
            if (!$model->getActive()) {
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
                'auto_increment' => true
            ),
            'trash_id' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ),
            'trash_url' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ),
            'trash_redirect_type' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
                'null' => true,
            ),
            'trash_redirect' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ),
            'trash_type' => array(
                'type' => 'VARCHAR',
                'constraint' => '3',
                'null' => true,
            ),
        );

        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', true);
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