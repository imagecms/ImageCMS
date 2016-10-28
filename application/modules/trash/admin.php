<?php

use CMSFactory\assetManager;
use core\models\Route;
use core\models\RouteQuery;

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * @author Gula Andrew <a.gula@imagecms.net>
 * @property Cms_base $cms_base
 */
class Admin extends BaseAdminController
{

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('trash');

        $this->load->library('DX_Auth');

        assetManager::create()->registerScript('script');
        //cp_check_perm('module_admin');
    }

    public function search_url($type_search = 'old') {
        $type_search = $type_search == 'old' ? 'old' : 'new';
        // old = старый урл, new - новый урл
        if ($this->input->get()) {
            $get = $this->input->get();
            if ($type_search == 'old') {
                $this->db->select('id, trash_url as text');
                $this->db->like('trash_url', $get['term'], 'both');
            } else {
                $this->db->select('id, trash_redirect as text');
                $this->db->like('trash_redirect', $get['term'], 'both');
            }

            $this->db->order_by('id', 'DESC');
            $this->db->limit(100);
            $result = $this->db->get('trash')->result_array();
            $json_answer = [];
            if ($result) {
                foreach ($result as $res) {
                    $json_answer[] = [
                                      'value'      => $res['text'],
                                      'identifier' => [
                                                       'id' => $res['id'],
                                                      ],
                                     ];
                }
                return json_encode($json_answer);
            } else {
                return json_encode([]);
            }
        }
    }

    public function index() {
        $countTotalRows = (int) $this->db->get('trash')->num_rows();
        $perPage = (int) $this->input->get('per_page');
        if (empty($perPage)) {
            $perPage = 0;
        }
        $this->db->offset($perPage);
        $this->db->limit(25);
        $query = $this->db->get('trash')->result();

        $this->load->library('pagination');
        $config['base_url'] = site_url('admin/components/cp/trash?');
        $config['uri_segment'] = $perPage;
        $config['total_rows'] = $countTotalRows;
        $config['per_page'] = 25;
        $config['page_query_string'] = true;
        $config['full_tag_open'] = '<div class="pagination pull-left"><ul>';
        $config['full_tag_close'] = '</ul></div>';
        $config['controls_tag_open'] = '<div class="pagination pull-right"><ul>';
        $config['controls_tag_close'] = '</ul></div>';
        $config['next_link'] = lang('Next', 'admin') . '&nbsp;&gt;';
        $config['prev_link'] = '&lt;&nbsp;' . lang('Prev', 'admin');
        $config['cur_tag_open'] = '<li class="btn-primary active"><span>';
        $config['cur_tag_close'] = '</span></li>';
        $config['prev_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['num_tag_close'] = '</li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->num_links = 5;
        $this->pagination->initialize($config);

        assetManager::create()
                ->setData('model', $query)
                ->setData('pagination', $this->pagination->create_links_ajax())
                ->registerScript('admin')
                ->renderAdmin('main');
    }

    public function create_trash_list() {
        assetManager::create()->registerScript('admin')->renderAdmin('create_trash_list');
    }

    public function trash_list() {
        if ($this->input->post('urls')) {
            $data = nl2br($this->input->post('urls'));
            $data = explode('<br />', $data);
            $data = array_map('trim', $data);
            $data = array_filter($data);

            $this->load->module('trash');

            foreach ($data as $value) {

                $value = explode(' ', $value);
                try {
                    $this->trash->create_redirect($value[0], $value[1], $value[2]);
                    $this->lib_admin->log(lang('Redirect created', 'trash') . '. Id:' . $this->db->insert_id());
                } catch (Exception $exc) {
                    showMessage($exc->getMessage(), false, 'r');
                    exit;
                }
            }

            showMessage(lang('List of redirects has been created', 'trash'));

            if ($this->input->post('action') == 'exit') {
                pjax('/admin/components/init_window/trash');
            }
        } else {
            showMessage(lang('Error', 'admin'), false, 'r');
        }
    }

    public function create_trash() {
        $this->form_validation->set_rules('url', 'Url', 'required');

        $this->db->where('name', 'shop')->get('components');

        $this->_addShopData();

        $this->db->order_by('name', 'asc');
        $query = $this->db->get('category');

        ($this->ajaxRequest) OR assetManager::create()->setData(['category_base' => $query->result()])->registerScript('admin')->renderAdmin('create_trash');

        if ($this->input->post()) {
            if ($this->form_validation->run($this) == false) {
                showMessage(validation_errors(), '', 'r');
            } else {

                switch ($this->input->post('redirect_type')) {

                    case 'url':
                        $array = [
                                  'trash_url'           => ltrim($this->input->post('url'), '/'),
                                  'trash_redirect_type' => $this->input->post('redirect_type'),
                                  'trash_type'          => $this->input->post('type'),
                                  'trash_redirect'      => $this->input->post('redirect_url'),
                                 ];
                        break;

                    case 'product':
                        $route = RouteQuery::create()
                            ->filterByEntityId($this->input->post('products'))
                            ->filterByType(Route::TYPE_PRODUCT)
                            ->findOne();

                        $array = [
                                  'trash_id'            => $this->input->post('products'),
                                  'trash_url'           => ltrim($this->input->post('url'), '/'),
                                  'trash_redirect_type' => $this->input->post('redirect_type'),
                                  'trash_type'          => $this->input->post('type'),
                                  'trash_redirect'      => site_url($route->getRouteUrl()),
                                 ];
                        break;

                    case 'category':
                        $route = RouteQuery::create()
                            ->filterByEntityId($this->input->post('category'))
                            ->filterByType(Route::TYPE_SHOP_CATEGORY)
                            ->findOne();

                        $array = [
                                  'trash_id'            => $this->input->post('category'),
                                  'trash_url'           => ltrim($this->input->post('url'), '/'),
                                  'trash_redirect_type' => $this->input->post('redirect_type'),
                                  'trash_type'          => $this->input->post('type'),
                                  'trash_redirect'      => site_url($route->getRouteUrl()),
                                 ];
                        break;

                    case 'basecategory':
                        $query = $this->db->get_where('category', ['id' => $this->input->post('category_base')]);
                        $url = $query->row();
                        $array = [
                                  'trash_id'            => $this->input->post('category_base'),
                                  'trash_url'           => ltrim($this->input->post('url'), '/'),
                                  'trash_redirect_type' => $this->input->post('redirect_type'),
                                  'trash_type'          => $this->input->post('type'),
                                  'trash_redirect'      => site_url($this->cms_base->get_category_full_path($url->id)),
                                 ];
                        break;

                    case '404':
                        $array = [
                                  'trash_url'           => ltrim($this->input->post('url'), '/'),
                                  'trash_type'          => $this->input->post('type'),
                                  'trash_redirect_type' => '404',
                                 ];
                        break;

                    default :
                        $array = [
                                  'trash_url'           => ltrim($this->input->post('url'), '/'),
                                  'trash_type'          => $this->input->post('type'),
                                  'trash_redirect_type' => '404',
                                 ];
                        break;
                }

                $this->db->set($array);
                $this->db->insert('trash');
                $lastId = $this->db->insert_id();

                showMessage(lang('Trash was created', 'trash'));

                $this->lib_admin->log(lang('Trash was created', 'trash') . '. Url: ' . $array['trash_url']);

                if ($this->input->post('action') == 'create') {
                    pjax('/admin/components/init_window/trash/edit_trash/' . $lastId);
                }
                if ($this->input->post('action') == 'exit') {
                    pjax('/admin/components/init_window/trash');
                }
            }
        }
    }

    /**
     *
     * @param integer $id
     */
    public function edit_trash($id) {
        $query = $this->db->get_where('trash', ['id' => $id]);
        $this->template->add_array(['trash' => $query->row()]);

        $this->_addShopData();

        $this->db->order_by('name', 'asc');
        $query = $this->db->get('category');

        if (!$this->ajaxRequest) {
            assetManager::create()
                ->setData(['category_base' => $query->result()])
                ->registerScript('admin')
                ->renderAdmin('edit_trash');
        }

        if ($this->input->post()) {
            switch ($this->input->post('redirect_type')) {
                case 'url':
                    $array = [
                              'id'                  => $this->input->post('id'),
                              'trash_url'           => $this->input->post('old_url'),
                              'trash_redirect_type' => $this->input->post('redirect_type'),
                              'trash_type'          => $this->input->post('type'),
                              'trash_redirect'      => $this->input->post('redirect_url'),
                             ];
                    break;

                case 'product':
                    $route = RouteQuery::create()
                        ->filterByEntityId($this->input->post('products'))
                        ->filterByType(Route::TYPE_PRODUCT)
                        ->findOne();

                    $array = [
                              'id'                  => $this->input->post('id'),
                              'trash_id'            => $this->input->post('products'),
                              'trash_url'           => $this->input->post('old_url'),
                              'trash_redirect_type' => $this->input->post('redirect_type'),
                              'trash_type'          => $this->input->post('type'),
                              'trash_redirect'      => site_url($route->getRouteUrl()),

                             ];
                    break;

                case 'category':
                    $route = RouteQuery::create()
                        ->filterByEntityId($this->input->post('category'))
                        ->filterByType(Route::TYPE_SHOP_CATEGORY)
                        ->findOne();
                    $array = [
                              'id'                  => $this->input->post('id'),
                              'trash_id'            => $this->input->post('category'),
                              'trash_url'           => $this->input->post('old_url'),
                              'trash_redirect_type' => $this->input->post('redirect_type'),
                              'trash_type'          => $this->input->post('type'),
                              'trash_redirect'      => site_url($route->getRouteUrl()),

                             ];
                    break;

                case 'basecategory':
                    $query = $this->db->get_where('category', ['id' => $this->input->post('category_base')]);
                    $url = $query->row();

                    $array = [
                              'id'                  => $this->input->post('id'),
                              'trash_id'            => $this->input->post('category_base'),
                              'trash_url'           => $this->input->post('old_url'),
                              'trash_redirect_type' => $this->input->post('redirect_type'),
                              'trash_type'          => $this->input->post('type'),
                              'trash_redirect'      => site_url($this->cms_base->get_category_full_path($url->id)),
                             ];
                    break;

                case '404':
                    $array = [
                              'id'                  => $this->input->post('id'),
                              'trash_redirect_type' => $this->input->post('redirect_type'),
                              'trash_type'          => $this->input->post('type'),
                              'trash_redirect'      => '',
                             ];

                    break;

                default :
                    $array = [
                              'id'                  => $this->input->post('id'),
                              'trash_url'           => $this->input->post('old_url'),
                              'trash_redirect_type' => $this->input->post('redirect_type'),
                             ];
                    break;
            }

            $this->db->where('id', $this->input->post('id'));
            $this->db->update('trash', $array);
            $this->lib_admin->log(lang('Redirect was edited', 'trash') . '. Url: ' . $array['trash_url']);
        }

        if ($this->input->post('action')) {
            showMessage(lang('Successfully saved', 'trash'));
        }
        if ($this->input->post('action') == 'exit') {
            pjax('/admin/components/init_window/trash');
        }
    }

    public function delete_trash() {
        foreach ($this->input->post('ids') as $item) {
            $this->db->where('id', $item);
            $this->db->delete('trash');
        }
        $this->lib_admin->log(lang('Redirect deleted', 'trash'));

        showMessage(lang('Redirect deleted', 'trash'));
    }

    public function _addShopData() {
        if (count($this->db->where('name', 'shop')->get('components')->row()) > 0) {

            $locale = MY_Controller::defaultLocale();

            $shop_products_i18n = $this->db
                ->where('locale', $locale)
                ->order_by('name', 'asc')
                ->get('shop_products_i18n');
            assetManager::create()->setData('products', $shop_products_i18n->result());

            assetManager::create()->setData('category', ShopCore::app()->SCategoryTree->getTree_());
        }
    }

}

/* End of file admin.php */