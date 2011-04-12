<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Image CMS
 *
 * Feedback module
 */

class Feedback extends MY_Controller {

    public $username_max_len = 30;
    public $message_max_len  = 600;
    public $theme_max_len    = 150;

    public $admin_mail = 'admin@localhost';

	public function __construct()
	{
		parent::__construct();
		$this->load->module('core');
        $this->load_settings();
	}

	// Index function
	public function index()
	{
        $this->core->set_meta_tags('Обратная Связь');

        $tpl_data = array();
        $this->load->library('form_validation');
        $this->form_validation->CI =& $this;

        if (count($_POST) > 0)
        {
            $this->form_validation->set_rules('name',  'Имя', 'trim|required|min_length[3]|max_length['.$this->username_max_len.']|xss_clean'); 
            $this->form_validation->set_rules('email', 'E-Mail', 'trim|required|valid_email|xss_clean'); 
            $this->form_validation->set_rules('theme', 'Тема', 'trim|required|max_length['.$this->theme_max_len.']|xss_clean');
	    
	    if ($this->dx_auth->use_recaptcha)
		$this->form_validation->set_rules('recaptcha_response_field', lang('lang_captcha'), 'trim|xss_clean|required|callback_captcha_check');
	    else
		$this->form_validation->set_rules('captcha', lang('lang_captcha'), 'trim|required|xss_clean|callback_captcha_check');
		
            $this->form_validation->set_rules('message', 'Сообщение', 'trim|required|max_length['.$this->message_max_len.']|xss_clean');

            if ($this->form_validation->run($this) == FALSE)
            {
                $tpl_data['form_errors'] = validation_errors();
            }
            else
            {
                $this->_send_message();
            }
        }

        // Create captcha
        $this->dx_auth->captcha();
        $tpl_data['cap_image'] = $this->dx_auth->get_captcha_image(); 

	    $this->template->add_array($tpl_data);

        $this->display_tpl('feedback');
	}

    // Send e-mail
    private function _send_message()
    {
        $config['charset'] = 'UTF-8';
        $config['wordwrap'] = FALSE;

        $this->load->library('email');
        $this->email->initialize($config);

        $this->email->from($this->input->post('email'), $this->input->post('name'));
        $this->email->to($this->admin_mail); 

        $this->email->subject($this->input->post('theme'));
        $this->email->message($this->input->post('message'));	

        $this->email->send();

        $this->template->assign('message_sent', TRUE);
    }

    private function load_settings()
    {
        $this->db->limit(1);
        $this->db->where('name', 'feedback');
        $query = $this->db->get('components')->row_array();

        $settings = unserialize($query['settings']);

        if (is_int($settings['message_max_len']))
        {
            $this->message_max_len = $settings['message_max_len'];
        }

        if ($settings['email'])
        {
            $this->admin_mail = $settings['email'];
        }
    }

	public function captcha_check($code)
	{
	    if (!$this->dx_auth->captcha_check($code))
		return FALSE;
	    else
		return TRUE;
	}
    

    /**
     * Display template file
     */ 
	private function display_tpl($file = '')
	{
        $file = realpath(dirname(__FILE__)).'/templates/'.$file;  
		$this->template->show('file:'.$file);
	}

}

/* End of file sample_module.php */
