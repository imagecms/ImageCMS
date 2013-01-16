<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_logs extends BaseAdminController {

    public $per_page = 25;

    public function __construct() {
        parent::__construct();

        $this->load->library('DX_Auth');
        admin_or_redirect();

        $this->load->library('lib_admin');
        $this->load->library('pagination');
        $this->lib_admin->init_settings();

        //cp_check_perm('logs_view');
    }

    public function index($offset = 0) {
        $this->db->order_by('date', 'DESC');
        $messages = $this->db->get('logs', (int) $this->per_page, (int) $offset);

        if ($messages->num_rows() > 0) {
            $messages = $messages->result_array();
        } else {
            $messages = FALSE;
        }
        
        $total = $this->db->get('logs')->num_rows();
        
        if ($total > $this->per_page) {
            $this->load->library('Pagination');

            $config['base_url'] = site_url('admin/admin_logs/index');
            $config['total_rows'] = $total;
            $config['per_page'] = $this->per_page;
            $config['uri_segment'] = $this->uri->total_segments();

            $config['separate_controls'] = true;
            $config['full_tag_open'] = '<div class="pagination pull-left"><ul>';
            $config['full_tag_close'] = '</ul></div>';
            $config['controls_tag_open'] = '<div class="pagination pull-right"><ul>';
            $config['controls_tag_close'] = '</ul></div>';
            $config['next_link'] = 'Next&nbsp;&gt;';
            $config['prev_link'] = '&lt;&nbsp;Prev';
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
            //$this->template->assign('paginator', $this->pagination->create_links_ajax());
        }

        $this->template->add_array(array(
            'messages' => $messages,
            'paginator' => $this->pagination->create_links_ajax(),
        ));


        $this->template->show('logs', FALSE);
    }

}
