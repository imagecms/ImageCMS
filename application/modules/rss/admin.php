<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Image CMS
 *
 * Sample Module Admin
 */

class Admin extends Controller {

	function __construct()
	{
		parent::Controller();

        // Only admin access 
        // Do not delete this code !
		if( $this->dx_auth->is_admin() == FALSE) exit;
	}


	public function index()
    {
        $this->load->library('lib_category');
        $cats = $this->lib_category->build();

        //var_dump($this->get_settings());

        $this->template->add_array(array(
            'cats'     => $cats,
            'settings' => $this->get_settings()
            ));

        $this->display_tpl('settings');	
    }


    public function settings_update()
    {
        $data = array(
                'title'       => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'categories'  => $this->input->post('categories'),
                'cache_ttl'   => (int) $this->input->post('cache_ttl'),
                'pages_count' => (int) $this->input->post('pages_count'),
            );

        $this->db->where('name', 'rss');
        $this->db->update('components', array('settings' => serialize($data)));

        showMessage('Изменения сохранены.');
    }

    private function get_settings()
    {
        return $this->load->module('rss')->_load_settings();
    }

    /**
     * Display template file
     */ 
	function display_tpl($file = '')
	{
        $file = realpath(dirname(__FILE__)).'/templates/admin/'.$file.'.tpl';  
		$this->template->display('file:'.$file);
	}

    /**
     * Fetch template file
     */ 
	function fetch_tpl($file = '')
	{
        $file = realpath(dirname(__FILE__)).'/templates/admin/'.$file.'.tpl';  
		return $this->template->fetch('file:'.$file);
	}

}


/* End of file admin.php */
