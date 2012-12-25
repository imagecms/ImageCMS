<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->library('DX_Auth');
        cp_check_perm('module_admin');
    }

    public function index() {
        $query = $this->db->get('trash');

        $this->template->add_array(array('model' => $query->result()));

        if (!$this->ajaxRequest)
            $this->display_tpl('main');
    }

    function create_trash() {

        $query = $this->db->get('shop_products_i18n');
        $this->template->add_array(array('products' => $query->result()));

        $query = $this->db->get('shop_category_i18n');
        $this->template->add_array(array('category' => $query->result()));

        $query = $this->db->get('category');
        $this->template->add_array(array('category_base' => $query->result()));

        if (!$this->ajaxRequest)
            $this->display_tpl('create_trash');

        if ($_POST) {

            switch ($_POST['redirect_type']) {

                case "url":
                    $array = array(
                        'trash_url' => $_POST['url'],
                        'trash_redirect_type' => $_POST['redirect_type'],
                        'trash_redirect' => $_POST['redirect_url']
                    );
                    break;

                case "product":

                    $query = $this->db->get_where('shop_products', array('id' => $_POST['products']));
                    $url = $query->row();

                    $array = array(
                        'trash_id' => $_POST['products'],
                        'trash_url' => $_POST['url'],
                        'trash_redirect_type' => $_POST['redirect_type'],
                        'trash_redirect' => site_url() . 'shop/product/' . $url->url
                    );
                    break;

                case "category":
                    $query = $this->db->get_where('shop_category', array('id' => $_POST['category']));
                    $url = $query->row();

                    $array = array(
                        'trash_id' => $_POST['category'],
                        'trash_url' => $_POST['url'],
                        'trash_redirect_type' => $_POST['redirect_type'],
                        'trash_redirect' => site_url() . 'shop/category/' . $url->full_path
                    );
                    break;

                case "basecategory":
                    $query = $this->db->get_where('category', array('id' => $_POST['category_base']));
                    $url = $query->row();

                    $array = array(
                        'trash_id' => $_POST['category_base'],
                        'trash_url' => $_POST['url'],
                        'trash_redirect_type' => $_POST['redirect_type'],
                        'trash_redirect' => site_url() . $url->name
                    );
                    break;

                case "404":
                    $array = array(
                        'trash_url' => $_POST['url'],
                        'trash_redirect_type' => $_POST['redirect_type']
                    );
                    break;
            }

            $this->db->set($array);
            $this->db->insert('trash');
            $lastId = $this->db->insert_id();

            if ($_POST['action'] == 'create')
                pjax('/admin/components/init_window/trash/edit_trash/' . $lastId);
            if ($_POST['action'] == 'exit')
                pjax('/admin/components/init_window/trash');
        }
    }

    function edit_trash($id) {
        $query = $this->db->get_where('trash', array('id' => $id));
        $this->template->add_array(array('trash' => $query->row()));

        $query = $this->db->get('shop_products_i18n');
        $this->template->add_array(array('products' => $query->result()));

        $query = $this->db->get('shop_category_i18n');
        $this->template->add_array(array('category' => $query->result()));

        $query = $this->db->get('category');
        $this->template->add_array(array('category_base' => $query->result()));

        if (!$this->ajaxRequest)
            $this->display_tpl('edit_trash');

        if ($_POST) {

            switch ($_POST['redirect_type']) {
                case "url":
                    $array = array(
                        'id' => $_POST['id'],
                        'trash_url' => $_POST['old_url'],
                        'trash_redirect_type' => $_POST['redirect_type'],
                        'trash_redirect' => prep_url($_POST['redirect_url'])
                    );
                    break;

                case "product":
                    $query = $this->db->get_where('shop_products', array('id' => $_POST['products']));
                    $url = $query->row();

                    $array = array(
                        'id' => $_POST['id'],
                        'trash_id' => $_POST['products'],
                        'trash_url' => $_POST['old_url'],
                        'trash_redirect_type' => $_POST['redirect_type'],
                        'trash_redirect' => site_url() . 'shop/product/' . $url->url
                    );
                    break;

                case "category":
                    $query = $this->db->get_where('shop_category', array('id' => $_POST['category']));
                    $url = $query->row();

                    $array = array(
                        'id' => $_POST['id'],
                        'trash_id' => $_POST['category'],
                        'trash_url' => $_POST['old_url'],
                        'trash_redirect_type' => $_POST['redirect_type'],
                        'trash_redirect' => site_url() . 'shop/category/' . $url->url
                    );
                    break;

                case "basecategory":
                    $query = $this->db->get_where('category', array('id' => $_POST['category_base']));
                    $url = $query->row();

                    $array = array(
                        'id' => $_POST['id'],
                        'trash_id' => $_POST['category_base'],
                        'trash_url' => $_POST['old_url'],
                        'trash_redirect_type' => $_POST['redirect_type'],
                        'trash_redirect' => site_url() . $url->name
                    );
                    break;

                case "404":
                    $array = array(
                        'id' => $_POST['id'],
                        'trash_url' => $_POST['old_url'],
                        'trash_redirect_type' => $_POST['redirect_type']
                    );
                    break;
            }

            $this->db->where('id', $_POST['id']);
            $this->db->update('trash', $array);
        }

        if ($_POST['action'] == 'save')
            pjax('/admin/components/init_window/trash/edit_trash/' . $_POST['id']);
        if ($_POST['action'] == 'exit')
            pjax('/admin/components/init_window/trash');
    }

    function delete_trash() {
        foreach ($_POST['ids'] as $item) {
            $this->db->where('id', $item);
            $this->db->delete('trash');
        }
    }

    /**
     * Display template file
     */
    private function display_tpl($file = '') {
        $file = realpath(dirname(__FILE__)) . '/templates/admin/' . $file;
        $this->template->show('file:' . $file);
    }

    /**
     * Fetch template file
     */
    private function fetch_tpl($file = '') {
        $file = realpath(dirname(__FILE__)) . '/templates/admin/' . $file . '.tpl';
        return $this->template->fetch('file:' . $file);
    }

}

/* End of file admin.php */