<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Image CMS
 *
 * Sample Module Admin
 */

class Admin extends MY_Controller {

	function __construct()
	{
		parent::__construct();

        $this->load->library('DX_Auth');
        cp_check_perm('module_admin'); 
	}


	function index()
    {  
        $this->load->helper('form');

        $this->template->add_array(array(
            'settings' => $this->_load_settings(),
            'changefreq_options'   => array(
                'always'  => 'always',
                'hourly'  => 'hourly',
                'daily'   => 'daily',
                'weekly'  => 'weekly',
                'monthly' => 'monthly',
                'yearly'  => 'yearly',
                'never'   => 'never'
                ),
            ));

        $this->display_tpl('settings'); 
    }

    public function _load_settings()
    {
        return $this->load->module('sitemap')->_load_settings(); 
    }

    public function update_settings()
    {
        $data = array(
            'main_page_priority'   => $this->input->post('main_page_priority'),
            'cats_priority'        => $this->input->post('cats_priority'),
            'pages_priority'       => $this->input->post('pages_priority'),
            'main_page_changefreq' => $this->input->post('main_page_changefreq'),
            'pages_changefreq'     => $this->input->post('pages_changefreq')
            );

        $this->db->limit(1);
        $this->db->where('name', 'sitemap');
        $this->db->update('components', array('settings' => serialize($data)));

        showMessage('Изменения сохранены');
    }

    /**
     * Display template file
     */ 
	public function display_tpl($file = '')
	{
        $file = realpath(dirname(__FILE__)).'/templates/admin/'.$file.'.tpl';  
		$this->template->display('file:'.$file);
	}

    /**
     * Fetch template file
     */ 
	public function fetch_tpl($file = '')
	{
        $file = realpath(dirname(__FILE__)).'/templates/admin/'.$file.'.tpl';  
		return $this->template->fetch('file:'.$file);
	}

}


/* End of file admin.php */
