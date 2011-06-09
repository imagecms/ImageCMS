<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Login class for administrator
 * Image CMS
 * login.php
 *
 */

class Login extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->library('DX_Auth');
        if( $this->dx_auth->is_admin() == TRUE) redirect('/admin');
        
        $this->load->library('lib_admin');
        $this->load->library('form_validation');
        $this->form_validation->CI =& $this;
        $this->lib_admin->init_settings();

		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

	}

	function index()
	{
		if ($this->dx_auth->is_max_login_attempts_exceeded())
		{
			$this->dx_auth->captcha();
			$this->template->assign('use_captcha','1');
			$this->template->assign('cap_image', $this->dx_auth->get_captcha_image() );
		}

		$this->do_login();
	}

	/**
	 * Login
	 *
	 * @access public
	 */
	function do_login()
	{
			$this->form_validation->set_rules('login', 'lang:lang_login', 'trim|required|min_length[3]|max_length[50]');
			$this->form_validation->set_rules('password', 'lang:lang_password', 'trim|required|min_length[5]|max_length[32]');

            if ($_POST['remember'] == 1)
            {
                $remember = true;
            }else{
                $remember = false;
            }

			if ($this->dx_auth->is_max_login_attempts_exceeded())
			{
				$this->form_validation->set_rules('captcha', lang('lang_captcha'), 'trim|required|xss_clean|callback_captcha_check');
			}

				if ($this->form_validation->run($this) == FALSE)
				{
					$err_object =& _get_validation_object();

					foreach($_POST as $k=>$v)
					{
						$err_text = $err_object->error($k, $prefix, $suffix);
						$this->template->assign($k.'_error', $err_text);
					}
				}
				else
				{
						$rezult = $this->dx_auth->login($this->input->post('login'), $this->input->post('password'), $remember);

						if ($rezult == TRUE)
						{
                            $this->lib_admin->log('Вошел в панель управления IP '.$this->input->ip_address());

							redirect('admin', 'refresh');
                        }
                        else
                        {
                            $this->template->assign('login_failed', $this->lang->line('error_login'));
						}
				}

			$this->template->show('login', FALSE);
	}


	function update_captcha()
	{
		$this->dx_auth->captcha();
		echo $this->dx_auth->get_captcha_image();
	}

	// callbacks
	function captcha_check($code)
	{
		$result = TRUE;

		if ($this->dx_auth->is_captcha_expired())
		{
			$this->form_validation->set_message('captcha_check', lang('lang_captcha_error'));
			$result = FALSE;
		}
		elseif ( ! $this->dx_auth->is_captcha_match($code))
		{
			$this->form_validation->set_message('captcha_check', lang('lang_captcha_error'));
			$result = FALSE;
		}

		return $result;
	}

}

/* End of login.php */
