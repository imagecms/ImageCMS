<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Languages extends MY_Controller{

	function __construct()
	{
	    parent::__construct();

	    $this->load->library('DX_Auth');
        admin_or_redirect();

	    $this->load->library('lib_admin');
	    $this->load->library('form_validation');
	    $this->lib_admin->init_settings();

	}

	function index()
	{
		$langs = $this->cms_admin->get_langs();
		$this->template->assign('langs',$langs);
        $this->template->show('languages',FALSE);
	}

	/**
	 * Show lang_create form
	 */
	function create_form()
	{
        cp_check_perm('lang_create');

		$settings = $this->cms_admin->get_settings();
		$lang_folders = $this->_get_lang_folders();

		$this->template->assign('lang_folders',$lang_folders);
		$this->template->assign('templates',$this->_get_templates());
		$this->template->assign('template_selected',$settings['site_template']);

		$this->template->show('lang_create',FALSE);
	}

	/**
	 * Insert new language
	 */
	function insert()
	{
        cp_check_perm('lang_create');

		$this->form_validation->set_rules('name', 'Название', 'trim|required|min_length[1]|max_length[100]');
		$this->form_validation->set_rules('identif', 'Идентификатор', 'trim|required|min_length[1]|max_length[100]|alpha_dash');
		$this->form_validation->set_rules('image', 'Изображение', 'max_length[250]');
		$this->form_validation->set_rules('folder', 'Папка', 'required|max_length[250]');
		$this->form_validation->set_rules('template', 'Шаблон', 'required|max_length[250]');

		if ($this->form_validation->run($this) == FALSE)
		{
			showMessage (validation_errors());
		}else{

			$data = array(
				'lang_name' => $this->input->post('name'),
				'identif'   => $this->input->post('identif'),
				'image'     => $this->lib_admin->db_post('image'),
				'folder'    => $this->input->post('folder'),
				'template'  => $this->input->post('template')
			);

            ($hook = get_hook('admin_language_create')) ? eval($hook) : NULL; 

			$this->cms_admin->insert_lang($data);

            $this->lib_admin->log('Создал язык '.$data['lang_name']);

            $this->cache->delete('main_site_langs');

			showMessage('Язык создан');
			closeWindow('languages_create_lang_w');
			updateDiv('languages_page_w_content',site_url('admin/languages/'));

		}
	}

	/**
	 * Show lang_edit form
	 */
	function edit($lang_id)
	{
        cp_check_perm('lang_edit');

		// get lang params
		$lang = $this->cms_admin->get_lang($lang_id);
		$this->template->add_array($lang);

		$this->template->assign('lang_folders',$this->_get_lang_folders());
		$this->template->assign('templates',$this->_get_templates());

		$this->template->assign('folder_selected',$lang['folder']);
		$this->template->assign('template_selected',$lang['template']);

		$this->template->show('lang_edit',FALSE);
	}

	/**
	 * Update language
	 */
	function update($lang_id)
	{
        cp_check_perm('lang_edit');

		$this->form_validation->set_rules('name', 'Название', 'trim|required|min_length[1]|max_length[100]');
		$this->form_validation->set_rules('identif', 'Идентификатор', 'trim|required|min_length[1]|max_length[100]|alpha_dash');
		$this->form_validation->set_rules('image', 'Изображение', 'max_length[250]');
		$this->form_validation->set_rules('folder', 'Папка', 'required|max_length[250]');
		$this->form_validation->set_rules('template', 'Шаблон', 'required|max_length[250]');

		if ($this->form_validation->run($this) == FALSE)
		{
			showMessage (validation_errors());
		}else{

			$data = array(
			'lang_name' => $this->input->post('name'),
			'identif' => $this->input->post('identif'),
			'image' => $this->lib_admin->db_post('image'),
			'folder' => $this->input->post('folder'),
			'template' => $this->input->post('template')
			);

            ($hook = get_hook('admin_language_update')) ? eval($hook) : NULL;

			$this->cms_admin->update_lang($data,$lang_id);

            $this->lib_admin->log('Изменил язык '.$data['lang_name']);

            $this->cache->delete('main_site_langs');

			showMessage('Изменения сохранены');
			closeWindow('edit_language_w');
			updateDiv('languages_page_w_content',site_url('admin/languages/'));

		}
	}

	/**
	 * Delete language
	 */
	function delete()
	{
        cp_check_perm('lang_delete'); 

		$id = $this->input->post('lang_id');

		$lang = $this->cms_admin->get_lang($id);

        ($hook = get_hook('admin_language_delete')) ? eval($hook) : NULL;

		if($lang['default'] == 1)
		{
			showMessage('Вы не можете удалить этот язык. Он используеться по умолчанию.');
			exit;
		}

		$this->cms_admin->delete_lang($id);

		// delete translated pages
		$this->db->where('lang',$id);
		$this->db->delete('content');

        $this->cache->delete('main_site_langs');

        $this->lib_admin->log('Удалил язык ID '.$id);

		showMessage('Язык удален!');
		updateDiv('languages_page_w_content',site_url('admin/languages/'));
	}

	/**
	 * Set default language
	 */
	function set_default()
	{
        cp_check_perm('lang_edit');

		$lang_id = $this->input->post('lang');

        ($hook = get_hook('admin_change_def_language')) ? eval($hook) : NULL; 

        $this->cache->delete('main_site_langs');

		$this->cms_admin->set_default_lang($lang_id);

		$lang = $this->cms_admin->get_lang($lang_id);

        $this->lib_admin->log('Назначил язык '.$lang['lang_name'].' по умолчанию');

		showMessage('Язык по умолчанию установлен: <b>'.$lang['lang_name'].'</b>');
	}

	/**
	 * Search language folders
	 *
	 * @access private
	 * @return array
	 */
	private function _get_lang_folders()
	{
		$new_arr = array();

		if ($handle = opendir(APPPATH.'language/')) {
		    while (false !== ($file = readdir($handle))) {
		        if ($file != "." && $file != ".." && $file != 'administrator' ) {

					if (!is_file(APPPATH.'language/'.$file))
					{
						$new_arr[$file] = $file;
					}
		        }
		    }
		    closedir($handle);
		}else{
			return FALSE;
		}
		return $new_arr;
	}

	/**
	 * Search templates in TEMPLATES_PATH folder
	 *
	 * @access private
	 * @return array
	 */
	private function _get_templates()
	{
		$new_arr = array();

		if ($handle = opendir(TEMPLATES_PATH)) {
		    while (false !== ($file = readdir($handle))) {
		        if ($file != "." && $file != ".." && $file != 'administrator' ) {
					if (!is_file(TEMPLATES_PATH.$file))
					{
						$new_arr[$file] = $file;
					}
		        }
		    }

		    closedir($handle);

		}else{
			return FALSE;
		}
		return $new_arr;
	}

}

/* End of languages.php */
