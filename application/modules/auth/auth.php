<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Image CMS
 * auth.php
 */

class Auth extends Controller
{
	// Used for registering and changing password form validation
	public $min_username = 4;
	public $max_username = 20;
	public $min_password = 4;
	public $max_password = 20;

	public $ban_reason = NULL;

	function Auth()
	{
		parent::Controller();

        $this->load->helper('url');
        $this->load->library('Form_validation');
	}

	function index()
	{
		$this->login();
	}

	/* Callback functions */

	function username_check($username)
	{
		$result = $this->dx_auth->is_username_available($username);
		if ( ! $result)
		{
			$this->form_validation->set_message('username_check', lang('lang_login_exists'));
		}

		return $result;
	}

	function email_check($email)
	{
		$result = $this->dx_auth->is_email_available($email);
		if ( ! $result)
		{
			$this->form_validation->set_message('email_check', lang('lang_email_exists'));
		}

		return $result;
	}

	function captcha_check($code)
	{
		$result = TRUE;

		if ($this->dx_auth->is_captcha_expired())
		{
			// Will replace this error msg with $lang
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

	function recaptcha_check()
	{
		$result = $this->dx_auth->is_recaptcha_match();
		if ( ! $result)
		{
			$this->form_validation->set_message('recaptcha_check', lang('lang_captcha_error'));
		}

		return $result;
	}

	/* End of Callback functions */


	/*
	 * Login function
	 */
	function login()
    {
		if ( ! $this->dx_auth->is_logged_in())
		{
			$val = $this->form_validation;

			// Set form validation rules
			$val->set_rules('username', lang('lang_login'), 'trim|required|min_length[3]|max_length[30]|xss_clean');
			$val->set_rules('password', lang('lang_password'), 'trim|required|min_length[3]|max_length[30]|xss_clean');
			$val->set_rules('remember', 'Remember me', 'integer');

			// Set captcha rules if login attempts exceed max attempts in config
			if ($this->dx_auth->is_max_login_attempts_exceeded())
			{
				$val->set_rules('captcha', lang('lang_captcha'), 'trim|required|xss_clean|callback_captcha_check');
			}

			if ($val->run() AND $this->dx_auth->login($val->set_value('username'), $val->set_value('password'), $val->set_value('remember')))
			{
				// Redirect to homepage
				redirect('', 'location');
			}
			else
			{

			$this->template->assign('info_message',	$this->dx_auth->get_auth_error());

				// Check if the user is failed logged in because user is banned user or not
				if ($this->dx_auth->is_banned())
				{
					// Redirect to banned uri
					//$this->dx_auth->deny_access('banned');
					$this->ban_reason = $this->dx_auth->get_ban_reason();
					$this->banned();
					exit;
				}
				else
				{
					// Default is we don't show captcha until max login attempts eceeded
					$data['show_captcha'] = FALSE;

					// Show captcha if login attempts exceed max attempts in config
					if ($this->dx_auth->is_max_login_attempts_exceeded())
					{
						// Create catpcha
						$this->dx_auth->captcha();
						$this->template->assign('cap_image', $this->dx_auth->get_captcha_image());
						// Set view data to show captcha on view file
						$data['show_captcha'] = TRUE;
					}

					// Load login page view
					$this->template->show('login');
				}
			}
		}
		else
		{
			$this->template->assign('content',lang('lang_user_logged_in'));
			$this->template->show();
		}
	}

	function logout()
	{
		$this->dx_auth->logout();

        redirect('', 'location');

		//$this->template->assign('content', lang('lang_user_logged_out'));
		//$this->template->show();
	}

	function register()
    {
        $this->load->library('Form_validation');

		if ( ! $this->dx_auth->is_logged_in() AND $this->dx_auth->allow_registration)
		{
			$val = $this->form_validation;

			// Set form validation rules
			$val->set_rules('username', lang('lang_login'), 'trim|required|xss_clean|min_length['.$this->min_username.']|max_length['.$this->max_username.']|callback_username_check|alpha_dash');
			$val->set_rules('password', lang('lang_password'), 'trim|required|xss_clean|min_length['.$this->min_password.']|max_length['.$this->max_password.']|matches[confirm_password]');
			$val->set_rules('confirm_password', lang('lang_confirm_password'), 'trim|required|xss_clean');
			$val->set_rules('email', lang('lang_email'), 'trim|required|xss_clean|valid_email|callback_email_check');

			if ($this->dx_auth->captcha_registration)
			{
				$val->set_rules('captcha', lang('lang_captcha'), 'trim|xss_clean|required|callback_captcha_check');
			}

			// Run form validation and register user if it's pass the validation
			if ($val->run() AND $this->dx_auth->register($val->set_value('username'), $val->set_value('password'), $val->set_value('email')))
			{
				// Set success message accordingly
				if ($this->dx_auth->email_activation)
				{
					$data['auth_message'] = lang('lang_check_mail_acc');
				}
				else
				{
					$data['auth_message'] = lang('lang_reg_success').anchor(site_url($this->dx_auth->login_uri), lang('lang_login'));
				}

				// Load registration success page
				$this->template->assign('content',$data['auth_message']);
				$this->template->show();
			}
			else
			{

			$this->template->assign('info_message',	$this->dx_auth->get_auth_error());

				// Is registration using captcha
				if ($this->dx_auth->captcha_registration)
				{
					$this->dx_auth->captcha();
					$this->template->assign('cap_image', $this->dx_auth->get_captcha_image());
				}

				// Load registration page
				//$this->load->view($this->dx_auth->register_view);
				$this->template->show('register');
			}
		}
		elseif ( ! $this->dx_auth->allow_registration)
		{
			$data['auth_message'] = lang('lang_register_off');

			$this->template->assign('content',$data['auth_message']);
			$this->template->show();
		}
		else
		{
			$data['auth_message'] = lang('lang_logout_to_reg');

			$this->template->assign('content',$data['auth_message']);
			$this->template->show();
		}
	}

	function activate()
	{
		// Get username and key
		$username = $this->uri->segment(3);
		$key = $this->uri->segment(4);

		// Activate user
		if ($this->dx_auth->activate($username, $key))
		{
			$data['auth_message'] = lang('lang_acc_activated').anchor(site_url($this->dx_auth->login_uri), lang('lang_login'));

			$this->template->assign('content',$data['auth_message']);
			$this->template->show();
		}
		else
		{
			$data['auth_message'] = lang('lang_resend_acc_code');

			$this->template->assign('content',$data['auth_message']);
			$this->template->show();
		}
	}

	function forgot_password()
    {
        $this->load->library('Form_validation');

		$val = $this->form_validation;

		// Set form validation rules
		$val->set_rules('login', lang('lang_username_or_mail'), 'trim|required|xss_clean');

		// Validate rules and call forgot password function
		if ($val->run() AND $this->dx_auth->forgot_password($val->set_value('login')))
		{
			$data['auth_message'] = lang('lang_acc_mail_sent');
			$this->template->assign('info_message', $data['auth_message']);
        }

        if ( $this->dx_auth->_auth_error != NULL )
        {
            $this->template->assign('info_message', $this->dx_auth->_auth_error );
        }

    	$this->template->show('forgot_password');
	}

	function reset_password()
	{
		// Get username and key
		$username = $this->uri->segment(3);
		$key = $this->uri->segment(4);

		// Reset password
		if ($this->dx_auth->reset_password($username, $key))
		{
			$data['auth_message'] = lang('lang_pass_restored').anchor(site_url($this->dx_auth->login_uri), lang('lang_login'));

			$this->template->assign('content',$data['auth_message']);
			$this->template->show();
		}
		else
		{
			$data['auth_message'] = lang('lang_reset_failed');

			$this->template->assign('content',$data['auth_message']);
			$this->template->show();
		}
	}

	function change_password()
    {
        $this->load->library('Form_validation');

		// Check if user logged in or not
		if ($this->dx_auth->is_logged_in())
		{
			$val = $this->form_validation;

			// Set form validation
			$val->set_rules('old_password', lang('lang_old_password'), 'trim|required|xss_clean|min_length['.$this->min_password.']|max_length['.$this->max_password.']');
			$val->set_rules('new_password', lang('lang_new_password'), 'trim|required|xss_clean|min_length['.$this->min_password.']|max_length['.$this->max_password.']|matches[confirm_new_password]');
			$val->set_rules('confirm_new_password', lang('lang_confirm_new_pass'), 'trim|required|xss_clean');

			// Validate rules and change password
			if ($val->run() AND $this->dx_auth->change_password($val->set_value('old_password'), $val->set_value('new_password')))
			{
				$data['auth_message'] = lang('lang_pass_changed');

				$this->template->assign('content',$data['auth_message']);
				$this->template->show();
			}
			else
			{
				$this->template->show('change_password');
			}
		}
		else
		{
			// Redirect to login page
			$this->dx_auth->deny_access('login');
		}
	}

	function cancel_account()
    {
        $this->load->library('Form_validation');

		// Check if user logged in or not
		if ($this->dx_auth->is_logged_in())
		{
			$val = $this->form_validation;

			// Set form validation rules
			$val->set_rules('password', lang('lang_password'), "trim|required|xss_clean");

			// Validate rules and change password
			if ($val->run() AND $this->dx_auth->cancel_account($val->set_value('password')))
			{
				// Redirect to homepage
				redirect('', 'location');
			}
			else
			{
				//$this->load->view($this->dx_auth->cancel_account_view);
			}
		}
		else
		{
			// Redirect to login page
			$this->dx_auth->deny_access('login');
		}
	}

	/*
	 * Deny access
	 */
	function deny()
	{
		$this->template->assign('content',lang('lang_access_deny'));
		$this->template->show();
	}

	function banned()
	{
		echo lang('lang_user_banned');

		if($this->ban_reason != NULL)
		{
			echo '<br/>'.$this->ban_reason;
		}
	}

}

/* End of file auth.php */
