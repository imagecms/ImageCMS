<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Image CMS
 * Comments admin
 */
class Admin extends BaseAdminController {

    function __construct() {
        parent::__construct();
    }
    
    private function init() {
        \CMSFactory\assetManager::create()
                ->registerScript('scripts');
    }
    
    public function index() {
        $this->init();
        
//        $this->load->library('pagination');
//        $config['base_url'] = $this->createUrl('products/index/', array('catId' => $model->getId()));
//        $config['container'] = 'shopAdminPage';
//        $config['uri_segment'] = 8;
//        $config['total_rows'] = $totalProducts;
//        $config['per_page'] = $this->per_page;
//        $config['suffix'] = ($orderField != '') ? $orderField . '/' . $orderCriteria : '';
//        $this->pagination->num_links = 6;
//        $this->pagination->initialize($config);
        
        $data = $this->db->get('mod_found_less_expensive')->result_array();
        $this->template->
                add_array(array('data' => $data,
//                                'pagination' => $this->pagination->create_links_ajax(),
                ));
        $this->display_tpl('list');
    }
    
    public function changeProcessed(){
        $id = $this->input->post('fleId');
        $status = $this->input->post('status');
        var_dump($id.$status);
    }

    private function display_tpl($file = '') {
        $file = realpath(dirname(__FILE__)) . '/assets/admin/' . $file;
        $this->template->show('file:' . $file);
    }
}