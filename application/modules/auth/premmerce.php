<?php

/**
 * 
 *
 * @author kolia
 */
class Premmerce extends MY_Controller {

    const EXC_ERROR = 1;
    const EXC_SUCCESS = 2;

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index() {
        try {

            $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');
            $this->form_validation->set_rules('token', 'Token', 'trim|required|xss_clean|valid_email');

            if ($this->form_validation->run($this) !== false) {
                throw new \Exception(validation_errors(), self::EXC_ERROR);
            }

            $email = $this->input->get('email');
            $token = $this->input->get('token');

            // перевірка чи прийшов саме із premmerce.com
            // @TODO треба буде зробити якусь нормальну перевірку
            if (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], 'premmerce') !== false) {
                
            }

            if ($this->dx_auth->is_logged_in()) {
                throw new \Exception('');
            }

            $userEmail = strip_tags(trim($_POST['email']));
            $userEmail = htmlspecialchars($userEmail);
            $userEmail = mysql_escape_string($userEmail);

            $result = $this->db
                    ->select('id')
                    ->where('email', $userEmail)
                    ->limit(1)
                    ->get();

            if (!$result) {
                throw new \Exception;
            }

            $status = (int) $this->dx_auth->_create_autologin($result->row()->id);
        } catch (\Exception $ex) {
            \CMSFactory\assetManager::registerJsScript('window.close();');
        }
    }

}
