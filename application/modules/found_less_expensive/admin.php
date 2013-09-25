<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Image CMS
 * Comments admin
 */
class Admin extends BaseAdminController {

    private $per_page = 12;

    function __construct() {
        parent::__construct();
    }

    /**
     * Init 
     */
    private function init() {
        \CMSFactory\assetManager::create()
                ->registerScript('scripts');
        $this->load->model('found_less_expensive_model');
        $lang = new MY_Lang();
        $lang->load('found_less_expensive');
    }

    /*
     * Show list of notifications about found less expensive
     */

    public function index() {
        $this->init();
        $status = $this->uri->segment(7);
        $off_set = $this->uri->segment(8);

        //Prepare data
        switch ($status) {
            case 'all':
                $status_all = array('0', '1');
                break;

            case 'new':
                $status_all = '0';
                break;

            case 'approved':
                $status_all = '1';
                break;

            default:
                $status_all = array('0', '1');

                break;
        }
        $data = $this->found_less_expensive_model->allByStatus($this->per_page, $off_set, $status_all);
        $total = $this->found_less_expensive_model->getCountAll($status_all);

        //Pagination
        if ($total > $this->per_page) {
            $this->load->library('pagination');

            $config['base_url'] = site_url('admin/components/cp/found_less_expensive/index/status/' . $status . '/');
            $config['total_rows'] = $total;
            $config['per_page'] = $this->per_page;
            $config['uri_segment'] = $this->uri->total_segments();

            $config['separate_controls'] = true;
            $config['full_tag_open'] = '<div class="pagination pull-left"><ul>';
            $config['full_tag_close'] = '</ul></div>';
            $config['controls_tag_open'] = '<div class="pagination pull-right"><ul>';
            $config['controls_tag_close'] = '</ul></div>';
            $config['next_link'] = lang('Next', 'admin') . '&nbsp;&gt;';
            $config['prev_link'] = '&lt;&nbsp;' . lang('Prev', 'admin');
            $config['cur_tag_open'] = '<li class="btn-primary active"><span>';
            $config['cur_tag_close'] = '</span></li>';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['num_tag_close'] = '</li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';

            $this->pagination->num_links = 5;
            $this->pagination->initialize($config);
            $pagination = $this->pagination->create_links_ajax();
        }
        // End pagination

        $this->template->
                add_array(array('data' => $data,
                    'pagination' => $pagination,
                    'status' => $status,
                    'countAll' => $this->found_less_expensive_model->getCountAll(array(0, 1)),
                    'countNew' => $this->found_less_expensive_model->getCountAll(0),
                    'countAccepted' => $this->found_less_expensive_model->getCountAll(1),
        ));
        $this->display_tpl('list');
    }

    /*
     * Render settings template
     */

    public function settings() {
        $this->init();
        $data = $this->found_less_expensive_model->getModuleSettings();
        $this->template->
                add_array(array('settings' => $data,
        ));
        $this->display_tpl('settings');
    }

    /*
     * Save settings
     */

    public function ajax_save_settings() {
        $value = serialize($this->input->post());
        $this->db->where('name', 'found_less_expensive')->update('components', array('settings' => $value));
        showMessage(lang('Settings saved!', 'found_less_expensive'));
    }

    /**
     *  Delete comment
     */
    public function ajax_delete() {
        $id = $this->input->post('id');

        $this->db->delete('mod_found_less_expensive', array('id' => $id));
        showMessage(lang('Succesful deleting', 'found_less_expensive'));
    }

    /**
     * Chenge status
     */
    public function ajax_change_status() {
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $this->db->where('id', $id)->update('mod_found_less_expensive', array('status' => $status));
        showMessage(lang('Status changed', 'found_less_expensive'));
    }

    /**
     * 
     * @param string $file
     */
    private function display_tpl($file = '') {
        $file = realpath(dirname(__FILE__)) . '/assets/admin/' . $file;
        $this->template->show('file:' . $file);
    }

}