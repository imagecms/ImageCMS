<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class Admin extends BaseAdminController {

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('trash');

        $this->load->library('DX_Auth');
        //cp_check_perm('module_admin');
    }

    public function index() {
        $query = $this->db->get('trash');
        $this->template->add_array(array('model' => $query->result()));
        if (!$this->ajaxRequest)
            $this->display_tpl('main');
    }

    function create_trash() {
        $this->form_validation->set_rules('url', 'Url', 'required');
        if (count($this->db->get_where('components', array('name' => 'shop'))->row()) > 0) {
            $this->db->order_by("name", "asc");
            $query = $this->db->get('shop_products_i18n');
            $this->template->add_array(array('products' => $query->result()));

            $this->db->order_by("name", "asc");
            $query = $this->db->get('shop_category_i18n');
            $this->template->add_array(array('category' => $query->result()));
        }

        $this->db->order_by("name", "asc");
        $query = $this->db->get('category');
        $this->template->add_array(array('category_base' => $query->result()));

        ($this->ajaxRequest) OR $this->display_tpl('create_trash');

        if ($_POST) {
            if ($this->form_validation->run($this) == FALSE) {
                showMessage(validation_errors(), '', 'r');
            } else {

                switch ($this->input->post('redirect_type')) {

                    case "url":
                        $array = array(
                            'trash_url' => ltrim($this->input->post('url'), '/'),
                            'trash_redirect_type' => $this->input->post('redirect_type'),
                            'trash_type' => $this->input->post('type'),
                            'trash_redirect' => 'http://' . ltrim($this->input->post('redirect_url'), 'http://')
                        );
                        break;

                    case "product":
                        $query = $this->db->get_where('shop_products', array('id' => $this->input->post('products')));
                        $url = $query->row();
                        $array = array(
                            'trash_id' => $this->input->post('products'),
                            'trash_url' => ltrim($this->input->post('url'), '/'),
                            'trash_redirect_type' => $this->input->post('redirect_type'),
                            'trash_type' => $this->input->post('type'),
                            'trash_redirect' => site_url() . 'shop/product/' . $url->url
                        );
                        break;

                    case "category":
                        $query = $this->db->get_where('shop_category', array('id' => $this->input->post('category')));
                        $url = $query->row();
                        $array = array(
                            'trash_id' => $this->input->post('category'),
                            'trash_url' => ltrim($this->input->post('url'), '/'),
                            'trash_redirect_type' => $this->input->post('redirect_type'),
                            'trash_type' => $this->input->post('type'),
                            'trash_redirect' => site_url() . 'shop/category/' . $url->full_path
                        );
                        break;

                    case "basecategory":
                        $query = $this->db->get_where('category', array('id' => $this->input->post('category_base')));
                        $url = $query->row();
                        $array = array(
                            'trash_id' => $this->input->post('category_base'),
                            'trash_url' => ltrim($this->input->post('url'), '/'),
                            'trash_redirect_type' => $this->input->post('redirect_type'),
                            'trash_type' => $this->input->post('type'),
                            'trash_redirect' => site_url() . $url->url
                        );
                        break;

                    case "404":
                        $array = array(
                            'trash_url' => ltrim($this->input->post('url'), '/'),
                            'trash_redirect_type' => '404'
                        );
                        break;

                    default :
                        $array = array(
                            'trash_url' => ltrim($this->input->post('url'), '/'),
                            'trash_redirect_type' => '404'
                        );
                        break;
                }

                $this->db->set($array);
                $this->db->insert('trash');
                $lastId = $this->db->insert_id();

                if ($this->input->post('action') == 'create')
                    pjax('/admin/components/init_window/trash/edit_trash/' . $lastId);
                if ($this->input->post('action') == 'exit')
                    pjax('/admin/components/init_window/trash');
            }
        }
    }

    function edit_trash($id) {
        $query = $this->db->get_where('trash', array('id' => $id));
        $this->template->add_array(array('trash' => $query->row()));

        if (count($this->db->get_where('components', array('name' => 'shop'))->row()) > 0) {
            $this->db->order_by("name", "asc");
            $query = $this->db->get('shop_products_i18n');
            $this->template->add_array(array('products' => $query->result()));

            $this->db->order_by("name", "asc");
            $query = $this->db->get('shop_category_i18n');
            $this->template->add_array(array('category' => $query->result()));
        }

        $this->db->order_by("name", "asc");
        $query = $this->db->get('category');
        $this->template->add_array(array('category_base' => $query->result()));

        if (!$this->ajaxRequest)
            $this->display_tpl('edit_trash');

        if ($_POST) {
            switch ($this->input->post('redirect_type')) {
                case "url":
                    $array = array(
                        'id' => $this->input->post('id'),
                        'trash_url' => $this->input->post('old_url'),
                        'trash_redirect_type' => $this->input->post('redirect_type'),
                        'trash_type' => $this->input->post('type'),
                        'trash_redirect' => prep_url($this->input->post('redirect_url'))
                    );
                    break;

                case "product":
                    $query = $this->db->get_where('shop_products', array('id' => $this->input->post('products')));
                    $url = $query->row();

                    $array = array(
                        'id' => $this->input->post('id'),
                        'trash_id' => $this->input->post('products'),
                        'trash_url' => $this->input->post('old_url'),
                        'trash_redirect_type' => $this->input->post('redirect_type'),
                        'trash_type' => $this->input->post('type'),
                        'trash_redirect' => site_url() . 'shop/product/' . $url->url
                    );
                    break;

                case "category":
                    $query = $this->db->get_where('shop_category', array('id' => $this->input->post('category')));
                    $url = $query->row();

                    $array = array(
                        'id' => $this->input->post('id'),
                        'trash_id' => $this->input->post('category'),
                        'trash_url' => $this->input->post('old_url'),
                        'trash_redirect_type' => $this->input->post('redirect_type'),
                        'trash_type' => $this->input->post('type'),
                        'trash_redirect' => site_url() . 'shop/category/' . $url->url
                    );
                    break;

                case "basecategory":
                    $query = $this->db->get_where('category', array('id' => $this->input->post('category_base')));
                    $url = $query->row();

                    $array = array(
                        'id' => $this->input->post('id'),
                        'trash_id' => $this->input->post('category_base'),
                        'trash_url' => $this->input->post('old_url'),
                        'trash_redirect_type' => $this->input->post('redirect_type'),
                        'trash_type' => $this->input->post('type'),
                        'trash_redirect' => site_url() . $url->url
                    );
                    break;

                case "404":
                    $array = array(
                        'id' => $this->input->post('id'),
                        'trash_url' => $this->input->post('old_url'),
                        'trash_redirect_type' => $this->input->post('redirect_type')
                    );
                    break;

                default :
                    $array = array(
                        'id' => $this->input->post('id'),
                        'trash_url' => $this->input->post('old_url'),
                        'trash_redirect_type' => $this->input->post('redirect_type')
                    );
                    break;
            }

            $this->db->where('id', $this->input->post('id'));
            $this->db->update('trash', $array);
        }

        if ($this->input->post('action') == 'save')
            pjax('/admin/components/init_window/trash/edit_trash/' . $this->input->post('id'));
        if ($this->input->post('action') == 'exit')
            pjax('/admin/components/init_window/trash');
    }

    function delete_trash() {
        foreach ($_POST['ids'] as $item) {
            $this->db->where('id', $item);
            $this->db->delete('trash');
        }
    }

    private function display_tpl($file = '') {
        $file = realpath(dirname(__FILE__)) . '/templates/admin/' . $file;
        $this->template->show('file:' . $file);
    }

}

/* End of file admin.php */