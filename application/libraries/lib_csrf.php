<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Image CMS
 * CSRF Library Beta.
 */

class Lib_csrf {

    public $ci = NULL;

    private $enc_key  = '';
    private $tokens   = array();     // User token.
    private $sess_id  = NULL;     // Session id.
    private $hidden_name = 'cms_token';
    private $max_tokens = 10;
    public  $log_errors = FALSE;
    public  $log_ajax_requests = FALSE;

    public function Lib_csrf()
    {
        $this->ci =& get_instance();

        $this->_generate_token();

        if ($this->check_token() === FALSE)
        {
            if ($this->log_errors === TRUE)
            {
                $this->_write_message('Wrong code.'); 
            }

            $err_text = 'Подозрение на атаку Cross-Site Request Forgery.'; 
            show_error($err_text);
            die();
        }
    }

    private function check_token()
    {
        if (count($_POST) > 0)
        {
            if (defined('ICMS_DISBALE_CSRF') AND ICMS_DISBALE_CSRF === TRUE)
            {
                return TRUE;
            }

            // Don't check ajax requests
            if (isset($_SERVER['HTTP_X_REQUESTED_WITH']))
            {
                if (strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
                {
                    if ($this->log_ajax_requests === TRUE)
                    {
                        $this->_write_message('Ajax Request');
                    }
                    return TRUE;
                }
            }
                
            $post_token = $this->ci->input->post($this->hidden_name);

            if ( array_search($post_token, $this->tokens) == FALSE)
            {
                if ($this->tokens[0] != $post_token)
                {
                    return FALSE;
                }
            }
        }

        return TRUE;
    }

    /**
     * Create input hidden
     */
    public function create_hidden_html()
    {
        if ( count($this->tokens) == 0 )
        {
            $this->_generate_token();
        }

        $token = array_pop($this->tokens);

        return '<input type="hidden" value="'.$token.'" name="'.$this->hidden_name.'" />';
    }

    private function _write_message($text)
    {
        $this->ci->load->helper('file');

        $post_data = '<br/>Post data:<br/>';
        foreach($_POST as $k => $v)
        {
            $post_data .= $k.': '.$v.'<br/>';
        }

        $request_uri = 'Request uri: '.$_SERVER['REQUEST_URI'].'<br/><br/>';

        $new_text = '<p>'.date('d-m-Y H:i:s').' IP:'.$_SERVER['REMOTE_ADDR'].' Referer: '.$_SERVER['HTTP_REFERER'].'<br/>'.$request_uri.$text.$post_data.'<br/>________________</p>';

        @write_file('./application/logs/csrf.html', $new_text, 'a');
    }

    private function _generate_token()
    {
        $this->sess_id = $this->_get_sess_id();
        $n_token = md5($this->sess_id . $this->enc_key);

        $this->tokens = $this->ci->session->userdata('ci_tokens');

        if (is_array($this->tokens) AND count($this->tokens) > $this->max_tokens)
        {
            $this->tokens = array_slice($this->tokens, -3, 3); 
        }

        if (is_array($this->tokens))
        {
            if( array_search($n_token, $this->tokens) === FALSE )
            {
                $this->tokens[] = $n_token;
            }
        }
        else
        {
            $this->tokens = array();
            $this->tokens[] = $n_token; 
        }

        $this->ci->session->set_userdata('ci_tokens', $this->tokens);
    }

    public function get_token()
    {
        return $this->token;
    }

    private function _get_sess_id()
    {
        return $this->ci->session->userdata('session_id');
    }

}

/* End of file lib_csfr.php */
