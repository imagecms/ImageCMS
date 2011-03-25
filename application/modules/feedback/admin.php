<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Image CMS
 *
 * Feedback Module
 */

class Admin extends MY_Controller {
   
	public function __construct()
	{
		parent::__construct();

        // Only admin access 
        $this->load->library('DX_Auth');
        cp_check_perm('module_admin'); 
	}


    // Display settings form
	public function index()
	{
        $this->template->assign('settings', $this->settings());
	    $this->display_tpl('admin/settings');
	}

    public function settings($action = 'get')
    {
        switch ($action)
        {
            case 'get':
                $this->db->limit(1);
                $this->db->where('name', 'feedback');
                $query = $this->db->get('components');

                if ($query->num_rows() == 1)
                {
                    $query = $query->row_array();
                    return unserialize($query['settings']);
                }
            break;

            case 'update':
                if (count($_POST) > 0)
                {
                    $this->load->library('form_validation');

                    $this->form_validation->set_rules('email', 'E-mail', 'trim|valid_email|required|xss_clean');
                    $this->form_validation->set_rules('message_max_len', 'Макс. длина сообщения', 'trim|integer|required|xss_clean');

                    if ($this->form_validation->run($this) == FALSE)
                    {
                        showMessage( validation_errors() );
                    }
                    else
                    {
                        $data = array(
                            'email' => $this->input->post('email'),
                            'message_max_len' => (int)$this->input->post('message_max_len'),
                        );
                        $this->db->where('name', 'feedback');
                        $this->db->update('components', array('settings' => serialize($data)));

                        showMessage('Настройки сохрарены');
                    }
                }
            break;
        }
    }

    /**
     * Display template file
     */ 
	private function display_tpl($file = '')
	{
        $file = realpath(dirname(__FILE__)).'/templates/'.$file;
		$this->template->show('file:'.$file, FALSE);
	}

}


/* End of file admin.php */
