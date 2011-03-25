<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_logs extends MY_Controller {

    public $per_page = 25;

	public function __construct()
	{
		parent::__construct();

		$this->load->library('DX_Auth');
        admin_or_redirect(); 

		$this->load->library('lib_admin');
		$this->load->library('pagination');
		$this->lib_admin->init_settings();

        cp_check_perm('logs_view');
	}

    public function index($offset = 0)
    {
        $this->db->order_by('date', 'DESC');
        $messages = $this->db->get('logs', (int) $this->per_page, (int) $offset);

        if ($messages->num_rows() > 0)
        {
            $messages = $messages->result_array();
        }
        else
        {
            $messages = FALSE;
        }

        // Pagination
    	$config['base_url'] = site_url('admin/admin_logs/index');
		$config['container'] = 'page';
		$config['uri_segment'] = 4;
		$config['total_rows'] =  $this->db->get('logs')->num_rows();
		$config['per_page'] = $this->per_page;
		$this->pagination->initialize($config);

        $this->template->add_array(array(
            'messages'  => $messages,
            'paginator' => $this->pagination->create_links_ajax(), 
        ));


        $this->template->show('logs', FALSE);
    }
}
