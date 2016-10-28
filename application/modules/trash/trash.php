<?php

use CMSFactory\Events;
use CMSFactory\Exception;
use Propel\Runtime\Collection\ObjectCollection as PropelObjectCollection;

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 *
 * Класс редиректа удаленных товаров
 * @property Cms_base $cms_base
 */
class Trash extends MY_Controller
{

    /**
     * @var string $is_create
     */
    private $trash_is_create_type;

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
        Events::create()->onShopProductDelete()->setListener('addProductWhenDelete');
        Events::create()->onShopProductCreate()->setListener('delProductWhenCreate');
        Events::create()->onShopProductAjaxChangeActive()->setListener('addProductWhenAjaxChangeActive');
        Events::create()->onShopCategoryDelete()->setListener('addProductsWhenCatDelete');
        Events::create()->onShopCategoryEdit()->setListener('updateCatUrl');
        Events::create()->onShopProductUpdate()->setListener('addProductWhenAjaxChangeActive');
        Events::create()->onShopProductCreate()->setListener('addProductWhenAjaxChangeActive');
        Events::create()->on('ShopAdminProducts:fastProdCreate')->setListener('addProductWhenAjaxChangeActive');
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
            /** Подключает модули, в авто лоаде они идут после*/
            $this->load->helper('menu/menu');
            $this->load->helper('xbanners/xbanners');

            ($row->trash_redirect_type != '404') OR $this->core->error_404();

            $this->setTrashIsCreateType($row->trash_redirect_type);
            redirect($this->formRedirectUrl($row->trash_redirect), 'location', $row->trash_type);
        } else {
            $url = $this->uri->getBaseUrl() . $this->input->server('REQUEST_URI');
            if ($url != $this->formRedirectUrl($url)) {
                redirect($this->formRedirectUrl($url), 'location', 301);
            }
        }
    }

    /**
     * Form URL redirect to
     * @param $url - url string
     * @return mixed
     */
    public function formRedirectUrl($url) {

        $siteSettings = $this->cms_base->get_settings();

        if ($this->getTrashIsCreateType() && $this->getTrashIsCreateType() != 'url') {

            $site_length = mb_strlen($this->input->server('REQUEST_SCHEME') . '://' .$this->input->server('SERVER_NAME'));

            $url = site_url(substr($url, $site_length));

        }

        switch ($siteSettings['www_redirect']) {
            case 'from_www':
                return str_replace('://www.', '://', $url);
            case 'to_www':
                $url = str_replace('://www.', '://', $url);
                return str_replace('://', '://www.', $url);
            default:
                return $url;
        }

    }

    /**
     *
     * @param string $trash_url
     * @param string $redirect_url
     * @param int $type
     * @throws Exception
     */
    public function create_redirect($trash_url, $redirect_url, $type = 301) {

        if (!isset($trash_url)) {
            throw new Exception(lang('Old URL is not specified', 'trash'));
        }

        if (!isset($redirect_url)) {
            throw new Exception(lang('New URL is not specified', 'trash'));
        }

        $array = [
                  'trash_url'           => ltrim($trash_url, '/'),
                  'trash_redirect_type' => 'url',
                  'trash_type'          => in_array($type, [301, 302]) ? $type : 301,
                  'trash_redirect'      => '/' . str_replace(['http://', 'https://'], '', $redirect_url),
                 ];

        $this->db->insert('trash', $array);

        if ($this->db->_error_message()) {
            throw new Exception($this->db->_error_message());
        }
    }

    /**
     * @param array $arg
     */
    public static function delProductWhenCreate($arg) {

        /** @var SProducts $model */
        $model = $arg['model'];
        $ci = &get_instance();
        $ci->db->where('trash_url', $model->getRouteUrl())->delete('trash');
    }

    /**
     * @param array $arg
     */
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
            if (!$model) {
                continue;
            }

            $ci->db->where('trash_url', $model->getRouteUrl())->delete('trash');
            if (!$model->getActive()) {
                $array = [
                          'trash_id'            => $model->getCategoryId(),
                          'trash_url'           => $model->getRouteUrl(),
                          'trash_redirect_type' => 'category',
                          'trash_type'          => '302',
                          'trash_redirect'      => site_url($model->getMainCategory()->getRouteUrl()),
                         ];
                $ci->db->insert('trash', $array);
            }
        }
    }

    /**
     * @param array $arg
     */
    public static function addProductWhenDelete($arg) {

        $models = $arg['model'];
        $ci = &get_instance();
        /** @var SProducts $model */
        foreach ($models as $model) {
            $array = [
                      'trash_id'            => $model->getCategoryId(),
                      'trash_url'           => $model->getRouteUrl(),
                      'trash_redirect_type' => 'category',
                      'trash_type'          => '301',
                      'trash_redirect'      => site_url($model->getMainCategory()->getRouteUrl()),
                     ];
            $ci->db->insert('trash', $array);
        }
    }

    public function _install() {

        $this->load->dbforge();
        ($this->dx_auth->is_admin()) OR exit;
        $fields = [
                   'id'                  => [
                                             'type'           => 'INT',
                                             'auto_increment' => true,
                                            ],
                   'trash_id'            => [
                                             'type'       => 'VARCHAR',
                                             'constraint' => '255',
                                             'null'       => true,
                                            ],
                   'trash_url'           => [
                                             'type'       => 'VARCHAR',
                                             'constraint' => '255',
                                             'null'       => true,
                                            ],
                   'trash_redirect_type' => [
                                             'type'       => 'VARCHAR',
                                             'constraint' => '20',
                                             'null'       => true,
                                            ],
                   'trash_redirect'      => [
                                             'type'       => 'VARCHAR',
                                             'constraint' => '255',
                                             'null'       => true,
                                            ],
                   'trash_type'          => [
                                             'type'       => 'VARCHAR',
                                             'constraint' => '3',
                                             'null'       => true,
                                            ],
                  ];

        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table('trash');

        $this->db->where('name', 'trash');
        $this->db->update('components', ['enabled' => 0, 'autoload' => 1]);
    }

    public function _deinstall() {

        $this->load->dbforge();
        ($this->dx_auth->is_admin()) OR exit;
        $this->dbforge->drop_table('trash');
    }

    /**
     * @return string
     */
    public function getTrashIsCreateType() {

        return $this->trash_is_create_type;
    }

    /**
     * @param string $trash_is_create_type
     */
    public function setTrashIsCreateType($trash_is_create_type) {

        $this->trash_is_create_type = $trash_is_create_type;
    }

}

/* End of file trash.php */