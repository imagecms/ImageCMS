<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Image CMS
 * Admin Class
 * 
 * TODO:
 * check local ip; 
 *
 */

class Admin extends MY_Controller {

    private $request_url = 'http://requests.imagecms.net/index.php/requests/req';

	public function __construct()
	{
		parent::__construct();

		$this->load->library('DX_Auth');
        admin_or_redirect();

		$this->load->library('lib_admin');
		$this->load->library('lib_category');
		$this->lib_admin->init_settings();
	}

    
	public function index()
	{
        // Disable license check.
        // From version 1.3.7
        //$this->check();

		$this->load->module('admin/components');
		$components = $this->components->find_components(TRUE);

		$this->template->assign('components', $components);
		$this->template->assign('cats_unsorted',$this->lib_category->unsorted());
		$this->template->assign('tree',$this->lib_category->build());

        // load menus
        $this->load->module('menu');
        $this->template->assign('menus', $this->menu->get_all_menus());

		///TinyMCE
		$this->load->library('lib_editor');
		$this->template->assign('editor',$this->lib_editor->init());
		//////

        $this->template->assign('username', $this->dx_auth->get_username());

        ($hook = get_hook('admin_show_desktop')) ? eval($hook) : NULL;

		$this->template->show('desktop', FALSE);
	}
    
    /**
    private function check()
    {
        $s_ip = substr($_SERVER['SERVER_ADDR'], 0, strrpos($_SERVER['SERVER_ADDR'], '.'));

        switch ($s_ip)
        {
            case '127.0.0':
            case '127.0.1':
            case '10.0.0':
            case '172.16.0':
            case '192.168.0':
               return TRUE;
            break;
        }

        $ud = $this->_ud();

        if ($ud['LK'] != '')
        {
            $l_result = $this->_curl_post($this->request_url, $ud);
            $lr2 = unserialize($l_result['result']);
            
            if ($lr2['lk_result'] === TRUE)
            {
                return TRUE;
            }
        }

        if (count($_POST) > 0)
        {
            $result = $this->_curl_post($this->request_url, $ud);
        }

        $r2 = unserialize($result['result']);

        if ($r2['error'] == FALSE AND $r2['action'] == 'INSERT_DB_KEY')
        {
            $this->db->where('s_name', 'main');
            $this->db->update('settings', array('lk' => $r2['text']));

            $this->template->assign('lk_ok', 'Ваш домен активирован. <a href="'.site_url('admin').'">Панель управления.</a>');
        }

        if ($r2['error'] == FALSE AND $r2['action'] == 'INSERT_DB_KEY_PRO')
        {
            if ($r2['text'] != '')
            {
                $this->db->where('s_name', 'main');
                $this->db->update('settings', array('lk' => $r2['text']));
            }

            $this->template->assign('lk_ok', 'Для получения подробной информации о активации системы посетите страницу <a href="http://www.imagecms.net/my_sites/">оплаты</a>.');
        }

        $this->template->add_array(array(
            'show_p' => TRUE,
            'result' => $r2,
        ));

        $this->template->show('login', FALSE);
        exit;
    }
    **/

    public function sys_info($action = '')
    {
        if ($action == 'phpinfo')
        {
            ob_start();
            phpinfo();
            $contents = ob_get_contents();
            ob_end_clean();

            echo $contents;
            exit;
        }

        $folders = array(
            '/system/cache/' => FALSE,
            '/system/cache/templates_c/' => FALSE,
            '/uploads/' => FALSE,
            '/uploads/images' => FALSE,
            '/uploads/files' => FALSE,
            '/uploads/media' => FALSE,
            '/captcha/' => FALSE,
        );

        foreach ($folders as $k => $v)
        {
            $folders[$k] = is_really_writable(PUBPATH.$k);
        }

        $this->template->assign('folders', $folders);

        if ($this->db->dbdriver == 'mysql')
        {
            $this->load->helper('number');

            $sql = "SHOW TABLE STATUS FROM `".$this->db->database."`";
            $query = $this->db->query($sql)->result_array();

            // Get total DB size
            $total_size = 0;
            $total_rows = 0;
            foreach($query as $k => $v)
            {
                $total_size += $v['Data_length'] +  $v['Index_length'];
                $total_rows += $v['Rows'];
            }

            $sql = "SELECT VERSION()";
            $query = $this->db->query($sql);

            $version = $query->row_array();

            $this->template->add_array(array(
                'db_version' => $version['VERSION()'],
                'db_size'    => byte_format($total_size),
                'db_rows'    => $total_rows,
            ));
        }

        $this->template->show('sys_info', FALSE);
    }

    /**
    private function _ud()
    {
        $s = $this->cms_base->get_settings();

        $data = array(
                'USER_LOGIN'         => $this->input->post('login'),
                'USER_PASSWORD'      => $this->input->post('password'),
                'HOST'               => $_SERVER['HTTP_HOST'],               
                'SERVER_IP'          => $_SERVER['SERVER_ADDR'],
                'USER_IP'            => $this->input->ip_address(),
                'IMAGECMS_NUMBER'    => IMAGECMS_NUMBER,
                'IMAGECMS_VERSION'   => IMAGECMS_VERSION,
                'IMAGECMS_PUBLIC_ID' => IMAGECMS_PUBLIC_ID,
                'LK'                 => $s['lk'],
            );
        
        return $data;
    }
    **/

    /**
    private function _curl_post($url='', $data=array()) 
    {
        $options = array();
        $options[CURLOPT_HEADER]         = FALSE;
        $options[CURLOPT_RETURNTRANSFER] = TRUE;
        $options[CURLOPT_POST]           = TRUE;
        $options[CURLOPT_POSTFIELDS]     = $data;

        $handler = curl_init($url);

        curl_setopt_array($handler, $options);
        $resp = curl_exec($handler);

        $result['code']   = curl_getinfo($handler, CURLINFO_HTTP_CODE);
        $result['result'] = $resp;
        $result['error']  = curl_errno($handler);

        curl_close($handler);
        return $result; 
    }
    **/

	/**
	 * Delete cached files
	 *
	 * @param string
	 * @access public
	 * @return bool
	 */
	public function delete_cache()
	{
        cp_check_perm('cache_clear');

		$param = $this->input->post('param');

        $this->lib_admin->log('Очистил кеш');

		switch ($param)
		{
			case 'all':
				$files = $this->cache->delete_all();
				if ($files)
					showMessage ('Удалено файлов: '.$files);
				else
					showMessage ('Кеш очищен.');
			break;

			case 'expried':
				$files = $this->cache->Clean();
				if ($files)
					showMessage ('Удалено устаревших файлов: '.$files);
				else
				   showMessage ('Кеш очищен.');  	
			break;
		}
	}

    public function sidebar_cats()
    {
		$this->template->assign('tree', $this->lib_category->build());
        $this->template->show('cats_sidebar', FALSE);
    }

	/**
	 *Clear session data;
	 *
	 *@access public
	 */
	public function logout()
	{
        $this->lib_admin->log('Вышел из панели управления');

        $this->dx_auth->logout();
		//$this->session->sess_destroy();
		redirect('/admin/login','refresh');
	}

}

/* End of admin.php */
