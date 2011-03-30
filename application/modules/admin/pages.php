<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends MY_Controller{


	var $_Config = array(
						 'per_page' => 20 // Show news per one page
						 );


	function __construct()
	{
		parent::__construct();

        $this->load->library('DX_Auth');
        admin_or_redirect();

		$this->load->library('lib_admin');
		$this->load->library('lib_editor');
		$this->load->library('lib_category');
		$this->load->library('pagination');
		$this->load->library('lib_seo');
		$this->lib_admin->init_settings();
	}

	function index($params = array())
	{
        cp_check_perm('page_create');

		// Set roles
		$query = $this->db->get('roles');
		$this->template->assign('roles',$query->result_array());

        $uri_segs = $this->uri->uri_to_assoc(2);

        $this->template->add_array(array(
                'tree'     => $this->lib_category->build(), // Load category tree
                'editor'   => $this->lib_editor->init(),    // Load editor javascript code
                'cur_time' => date('H:i:s'),
                'cur_date' => date('Y-m-d'),
                'sel_cat'  => $uri_segs['category']
            ));

        ($hook = get_hook('admin_show_add_page')) ? eval($hook) : NULL;

		$this->template->show('add_page', FALSE);
	}


	/****************************************************
	 * PAGE EVENTS
	 ***************************************************/

	/**
	 * This event occurs right after page inserted in DB
	 */
	private function on_page_add($page)
	{
       ($hook = get_hook('admin_on_page_add')) ? eval($hook) : NULL;
 
		// Set page roles
		$this->_set_page_roles($page['id'],$this->input->post('roles'));

		// Set page tags
        $this->load->module('tags')->_set_page_tags($_POST['search_tags'], $page['id']);

		//$this->load->module('xfields/admin')->set_page_xfields($page['id']);
	}

	/**
	 * This event occurs right after page updated
	 */
	private function on_page_update($page)
	{
       ($hook = get_hook('admin_on_page_update')) ? eval($hook) : NULL;

		// Update page roless
		$this->_set_page_roles($page['id'],$this->input->post('roles'));

		// Update page tags
	
        $this->load->module('tags')->_set_page_tags($_POST['search_tags'], (int)$page['id']);

		//$this->load->module('xfields/admin')->set_page_xfields($page['id']);
	}

	/**
	 * This event occurs right after page deleted
	 */
	private function on_page_delete($page_id)
	{
        ($hook = get_hook('admin_on_page_delete')) ? eval($hook) : NULL;

        $this->lib_admin->log('Удалил страницу ID '.$page_id);

		// Delete content_permissions
		$this->db->where('page_id',$page_id);
		$this->db->delete('content_permissions');

		// Delete page tags
		$this->db->where('page_id', $page_id);
		$this->db->delete('content_tags');

        $this->load->module('tags')->_remove_orphans();

		// Delete page xfields
		//$this->load->module('xfields/admin')->delete_page_xfields($page_id);
	}

	/****************************************************
	 * END PAGE EVENTS
	 ***************************************************/

	/**
	 * Add new page
	 * Language default
	 */
	public function add()
	{
		
        cp_check_perm('page_create');

		$this->form_validation->set_rules('page_title', 'Заголовок', 'trim|required|min_length[1]|max_length[500]');
		$this->form_validation->set_rules('page_url', 'URL', 'alpha_dash');
		$this->form_validation->set_rules('page_keywords', 'Ключевые слова', 'trim');
		$this->form_validation->set_rules('prev_text', 'Пред. Содержание', 'trim|required');
		$this->form_validation->set_rules('page_description', 'Описание', 'trim');
		$this->form_validation->set_rules('full_tpl', 'Шаблон Страницы', 'trim|max_length[150]|min_length[2]');
		$this->form_validation->set_rules('create_date', 'Дата создания', 'required|valid_date');
		$this->form_validation->set_rules('create_time', 'Время создания', 'required|valid_time');
		$this->form_validation->set_rules('publish_date', 'Дата создания', 'required|valid_date');
		$this->form_validation->set_rules('publish_time', 'Время создания', 'required|valid_time');
		
        $this->form_validation->set_rules('main_tpl', 'Главный шаблон страницы', 'trim|max_length[50]|min_length[2]');

        ($hook = get_hook('admin_page_add_set_rules')) ? eval($hook) : NULL;

		if ($this->form_validation->run($this) == FALSE)
		{
			
            ($hook = get_hook('admin_page_add_val_failed')) ? eval($hook) : NULL;
			showMessage (validation_errors());
		}else
        {
		
            // load site settings
   			$settings = $this->cms_admin->get_settings();


			$def_lang = $this->cms_admin->get_default_lang();

			if($this->input->post('page_url') == '' or $this->input->post('page_url') == NULL)
			{
				$this->load->helper('translit');
				$url = translit_url($this->input->post('page_title'));
			}else{
				$url = $this->input->post('page_url');
			}

            // check if we have existing page with entered URL
            $this->db->select('id, lang, url');
            $this->db->where('url',$url);
            $this->db->where('lang', $def_lang['id']);
			$this->db->where('category',$this->input->post('category'));
			$query = $this->db->get('content', 1);

			if($query->num_rows() > 0)
			{
				showMessage ('Страница c таким URL уже существует! Укажите другой URL.','Ошибка');
				exit;
			}
			// end check

			$full_url = $this->lib_category->GetValue($this->input->post('category'),'path_url');

            if ($full_url == FALSE)
            {
                $full_url = '';
            }

			$keywords = $this->lib_admin->db_post('page_keywords');
			$description = $this->lib_admin->db_post('page_description');

            // create keywords
            if ($keywords == '' AND $settings['create_keywords'] == 'auto')
            {
                $keywords = $this->lib_seo->get_keywords($this->input->post('prev_text').' '.$this->input->post('full_text')); 
            }

            // create description
			if( $description == '' AND $settings['create_description'] == 'auto' )
			{
    			$description = $this->lib_seo->get_description($this->input->post('prev_text').' '.$this->input->post('full_text'));
            }

            mb_substr($keywords, -1) == ',' ? $keywords = mb_substr($keywords, 0 , -1): TRUE;

			$publish_date = $this->input->post('publish_date').' '.$this->input->post('publish_time');
			$create_date  = $this->input->post('create_date').' '.$this->input->post('create_time');
		
			
			$data = array(
                'title' => trim($this->input->post('page_title')),
                'meta_title' => trim($this->input->post('meta_title')),
				'url' => str_replace('.', '', trim($url)), //Delete dots from url
				'cat_url' => $full_url,
				'keywords' => $keywords,
				'description' => $description,
				//'full_text' => htmlspecialchars(trim($this->input->post('full_text'))),
				'full_text' => trim($this->input->post('full_text')),
				'prev_text' => trim($this->lib_admin->db_post('prev_text')),
				//'prev_text' => htmlspecialchars(trim($this->lib_admin->db_post('prev_text'))),
				'category' => $this->input->post('category'),
				'full_tpl' => $_POST['full_tpl'],
				'main_tpl' => $_POST['main_tpl'],
				'comments_status' => $this->input->post('comments_status'),
				'post_status' => $this->input->post('post_status'),
				'author' => $this->dx_auth->get_username(),
				'publish_date' => strtotime($publish_date),
				'created' => strtotime($create_date),
				'lang' => $def_lang['id']
			);

            ($hook = get_hook('admin_page_insert')) ? eval($hook) : NULL;

			$page_id = $this->cms_admin->add_page($data);

			$data['id'] = $page_id;

			$this->on_page_add($data);

            $this->lib_admin->log('
            Создал страницу 
            <a href="#" onclick="ajax_div(\'page\',\''.site_url('admin/pages/edit/'.$page_id).'\'); return false;">'.$data['title'].'</a>'
            );

			showMessage ('Страница создана');
			updateDiv('page',site_url('admin/pages/edit/'.$page_id.'/'.$data['lang']));
		}
	}

	/*
	 * Set roles for page
	 */
	function _set_page_roles($page_id, $roles)
    {
        ($hook = get_hook('admin_page_set_roles')) ? eval($hook) : NULL; 

		//if ( count($roles) > 0 )
		if ( $roles[0] != '' )
		{
			$page_roles = array();

			foreach($roles as $k)
			{
				$data = array('role_id' => $k);
				array_push($page_roles,$data);
			}

			$n_data = array('page_id' => $page_id,
							'data' => serialize($page_roles) );

            // Delete page roles
            $this->db->where('page_id',$page_id);
            $this->db->delete('content_permissions');

            // Insert new page roles
            $this->db->insert('content_permissions',$n_data);
        }else{

            if ( $this->db->get_where('content_permissions',array('page_id' => $page_id))->num_rows() > 0)
            {
                $this->db->where('page_id',$page_id);
                $this->db->delete('content_permissions');
            }

        }

		return TRUE;
	}

	/**
	 * Show edit_page form
	 *
	 * @access public
	 */
	function edit($page_id, $lang = 0)
	{
        cp_check_perm('page_edit');

		if($this->cms_admin->get_page($page_id) == FALSE)
		{
			showMessage('Страница '.$page_id.' не найдена');
			exit;
		}

		$def_lang = $this->cms_admin->get_default_lang();

        // Get page data
        $data = $this->db->get_where('content', array('id' => $page_id))->row_array();

        if ($lang != 0 AND $lang != $data['lang'])
        {
            $data = $this->db->get_where('content', array('lang_alias' => $page_id, 'lang' => $lang));

            if ($data->num_rows() > 0)
            {
                $data = $data->row_array();
            }else{
                $data = FALSE;
            }
        }

        ($hook = get_hook('admin_page_edit_found')) ? eval($hook) : NULL; 

		if ($data)
        {
    		$this->template->assign('page_id', $page_id);
			$this->template->assign('update_page_id', $data['id']);

			$this->template->add_array($data);

			$this->load->module('tags');
			$this->template->assign('tags', $this->tags->get_page_tags($data['id']));

			// Roles
			$this->db->where('page_id',$page_id);
			$query = $this->db->get('content_permissions',1);
			$page_roles = $query->row_array();
			$page_roles = unserialize($page_roles['data']);

			$g_query = $this->db->get('roles');
			$roles = $g_query->result_array();

			if($roles != FALSE)
			{
				for ($i = 0, $cnt = count($roles); $i < $cnt; $i++)
				{
					for ($i2 = 0, $cnt2 = count($page_roles); $i2 < $cnt2; $i2++)
					{
						if($page_roles[$i2]['role_id'] == $roles[$i]['id'])
						{
							$roles[$i]['selected'] = 'selected="true"';
						}
						if($page_roles[$i2]['role_id'] == '0')
						{
							$this->template->assign('all_selected','selected="true"');
						}
					}
				}
			}

			$this->template->assign('roles', $roles);
			// roles

			// explode publush_date to date and time
			$this->template->assign('publish_date', date('Y-m-d', $data['publish_date']));
			$this->template->assign('publish_time', date('H:i:s', $data['publish_date']));
			$this->template->assign('create_date', date('Y-m-d', $data['created']));
			$this->template->assign('create_time', date('H:i:s', $data['created']));
			// end

			// set langs
			$langs = $this->cms_admin->get_langs();

            if(count($langs) > 1) $this->template->assign('show_langs',1);

            // Load category
            $category = $this->lib_category->get_category($data['category']);

            $this->template->add_array(array(
                'page_lang' => $data['lang'],
                'tree'      => $this->lib_category->build(),
                'parent_id' => $data['category'],
                'langs'     => $langs,
                'category'  => $category
            ));

            if ($data['lang_alias'] != 0)
            {
                $orig_page = $this->cms_admin->get_page($data['lang_alias']);

                $this->template->assign('orig_page', $orig_page);
            }

            ($hook = get_hook('admin_show_edit_page_tpl')) ? eval($hook) : NULL; 

			$this->template->show('edit_page', FALSE);
		}else{

			// create page copy for $lang
			$cur_lang = $this->cms_admin->get_lang($lang);

			if($cur_lang != FALSE) // lang exists
			{
				$defpage = $this->cms_admin->get_page($page_id);

					$new_data = array(
							'author'          => $this->dx_auth->get_username(),
							'comments_status' => $defpage['comments_status'],
                            'category'        => $defpage['category'],
                            'cat_url'         => $defpage['cat_url'],
                            'url'             => $defpage['url'],
							'created'         => $defpage['created'],
							'publish_date'    => $defpage['publish_date'],
							'post_status'     => $defpage['post_status'],
							'lang'            => $lang,
							'lang_alias'      => $defpage['id'],
							'full_tpl'        => $defpage['full_tpl'],
                            'main_tpl'        => $defpage['main_tpl'],
					);

                    ($hook = get_hook('admin_page_create_empty_translation')) ? eval($hook) : NULL;

					$new_p_id = $this->cms_admin->add_page($new_data);

					if($new_p_id > 0)
					{
						showMessage('Страница на языке <b>'.$cur_lang['lang_name']. '</b> создана. ID: <b>'.$new_p_id.'</b>');
						updateDiv('page',site_url('admin/pages/edit/'.$page_id.'/'.$lang));
						exit;
					}else{
						die('Cant get page id!');
					}
			}
		}

	}

	 /**
	 * Update existing page by ID
	 *
	 * @access public
	 */
	function update($page_id)
	{
		
        cp_check_perm('page_edit');

		$this->form_validation->set_rules('page_title', 'Заголовок', 'trim|required|min_length[1]|max_length[500]');
		$this->form_validation->set_rules('page_url', 'URL', 'alpha_dash');
		$this->form_validation->set_rules('page_keywords', 'Ключевые слова', 'trim');
		$this->form_validation->set_rules('prev_text', 'Пред. Содержание', 'trim|required');
		$this->form_validation->set_rules('page_description', 'Описание', 'trim');
		$this->form_validation->set_rules('full_tpl', 'Шаблон Страницы', 'trim|max_length[50]|min_length[2]');
		$this->form_validation->set_rules('main_tpl', 'Главный шаблон cтраницы', 'trim|max_length[50]|min_length[2]');
		$this->form_validation->set_rules('create_date', 'Дата создания', 'required|valid_date');
		$this->form_validation->set_rules('create_time', 'Время создания', 'required|valid_time');
		$this->form_validation->set_rules('publish_date', 'Дата создания', 'required|valid_date');
		$this->form_validation->set_rules('publish_time', 'Время создания', 'required|valid_time');

        ($hook = get_hook('admin_page_update_set_rules')) ? eval($hook) : NULL;

		if ($this->form_validation->run($this) == FALSE)
		{
                ($hook = get_hook('admin_page_update_val_failed')) ? eval($hook) : NULL;
				showMessage (validation_errors());
		}else{

            // load site settings
   			$settings = $this->cms_admin->get_settings();

			if($this->input->post('page_url') == '' or $this->input->post('page_url') == NULL)
			{
				$this->load->helper('translit');
				$url = translit_url($this->input->post('page_title'));
			}else{
				$url = $this->input->post('page_url');
			}

			// check if we have existing page with entered URL
			$b_page = $this->cms_admin->get_page($page_id);

			$this->db->where('url', $url);
			$this->db->where('category', $this->input->post('category'));
            $this->db->where('category !=', $b_page['category']);
            $this->db->where('lang', $b_page['lang']);
			$query = $this->db->get('content',1);

			if($query->num_rows() > 0)
			{
				showMessage ('Страница c URL: <b>'.$url.'</b> в категории ID: '.$this->input->post('category').' уже существует! Укажите другой URL.','Ошибка');
				exit;
			}
			// end check

			$full_url = $this->lib_category->GetValue($this->input->post('category'),'path_url');

            if ($full_url == FALSE)
            {
                $full_url = '';
            }

			$keywords = $this->lib_admin->db_post('page_keywords');
			$description = $this->lib_admin->db_post('page_description');

            // create keywords
            if ($keywords == '' AND $settings['create_keywords'] == 'auto')
            {
                $keywords = $this->lib_seo->get_keywords($this->input->post('prev_text').' '.$this->input->post('full_text')); 
            }

            // create description
			if( $description == '' AND $settings['create_description'] == 'auto' )
			{
    			$description = $this->lib_seo->get_description($this->input->post('prev_text').' '.$this->input->post('full_text'));
		    }	

			mb_substr($keywords, -1) == ',' ? $keywords = mb_substr($keywords, 0 , -1): TRUE;



			$publish_date = $this->input->post('publish_date').' '.$this->input->post('publish_time');
			$create_date = $this->input->post('create_date').' '.$this->input->post('create_time');

			$data = array(
                'title' => trim($this->input->post('page_title')),
                'meta_title' => trim($this->input->post('meta_title')),
				'url' => str_replace('.', '', trim($url)), //Delete dots from url
				'cat_url' => $full_url,
				'keywords' => $keywords,
				'description' => $description,
				//'full_text' => htmlspecialchars(trim($this->input->post('full_text'))),
				'full_text' => trim($this->input->post('full_text')),
				'prev_text' => trim($this->lib_admin->db_post('prev_text')),
				//'prev_text' => htmlspecialchars(trim($this->lib_admin->db_post('prev_text'))),
				'category' => $this->input->post('category'),
				'full_tpl' => $_POST['full_tpl'],
                'main_tpl' => $_POST['main_tpl'],
				'comments_status' => $this->input->post('comments_status'),
				'post_status' => $this->input->post('post_status'),
				'author' => $this->dx_auth->get_username(),
				'publish_date' => strtotime($publish_date),
				'created'	=> strtotime($create_date),
				'updated' => time()
			);

			$data['id'] = $page_id;
			$this->on_page_update($data);

            ($hook = get_hook('admin_page_update')) ? eval($hook) : NULL;


			if ($this->cms_admin->update_page($page_id, $data) >= 1)
			{

            $this->lib_admin->log('
            Изменил страницу  
            <a href="#" onclick="ajax_div(\'page\',\''.site_url('admin/pages/edit/'.$page_id).'\'); return false;">'.$data['title'].'</a>'
            );

				showMessage ('Содержание страницы обновлено.');
			}else{
				showMessage ('Ошибка.');
			}
		}
	}

	/**
	 * Delete page
	 *
	 * @access public
	 */
	function delete($page_id,$show_messages = TRUE)
	{
        cp_check_perm('page_delete');

		$settings = $this->cms_admin->get_settings();

		if($settings['main_page_id'] == $page_id AND $settings['main_type'] == 'page')
		{
			jsCode("alertBox.alert('<h1>Ошибка</h1>Нельзя удалить заглавную страницу!');");
			return FALSE;
		}

		$this->db->where('id',$page_id);
		$query = $this->db->get('content',1);
		$page = $query->row_array();

		if($page['lang_alias'] == 0)
		{
			$this->db->where('id',$page['id']);
			$this->db->delete('content');

			$this->db->where('lang_alias',$page['id']);
			$this->db->delete('content');

			$this->on_page_delete($page['id']);

			if ($show_messages == TRUE)
			{
				showMessage('Страница удалена.');
				updateDiv('page',site_url('admin/pages/GetPagesByCategory/'.$page['category']));
			}
			return TRUE;
		}

		$root_page = $this->cms_admin->get_page($page['lang_alias']);

        ($hook = get_hook('admin_page_delete')) ? eval($hook) : NULL;

		// delete page
		$this->db->where('id',$page['id']);
		$this->db->delete('content');

		$this->on_page_delete($page_id);

		if ($show_messages == TRUE)
		{
			showMessage('Страница удалена.');
			updateDiv('page',site_url('admin/pages/edit/'.$root_page['id'].'/'.$root_page['lang']));
		}
	}

	/**
	 * Transilt title to url
	 */
	function ajax_translit()
	{
		$this->load->helper('translit');
        $str = $this->input->post('str');
		echo translit_url($str);
    }

    function save_positions()
    {      
        cp_check_perm('page_edit');

        ($hook = get_hook('admin_update_page_positions')) ? eval($hook) : NULL;

        foreach ($_POST['pages_pos'] as $k => $v)
        {
            $item = explode('_', substr($v, 4));

            $data = array(
                    'position' => $item[1]
                    );
            
            $this->db->where('id', $item[0]);
            $this->db->update('content', $data);
        }
    }

    function delete_pages()
    {
        cp_check_perm('page_delete');

        $ids = $_POST['pages'];

        ($hook = get_hook('admin_pages_delete_many')) ? eval($hook) : NULL;

        if (count($ids) > 0)
        {
            foreach($ids as $k => $v)
            {
                $page_id = substr($v,5);
                $this->delete($page_id, FALSE);
            }
        }
    }

    function move_pages($action)
    {
        cp_check_perm('page_edit');

        $ids = $_POST['pages']; 

        $this->db->select('category');
        $page = $this->db->get_where('content', array('id' => substr($_POST['pages'][0],5)))->row_array();

        $category = $this->lib_category->get_category($_POST['new_cat']);
      
        if (count($ids) > 0)
        {
            foreach($ids as $k => $v)
            {
                $page_id = substr($v,5);

                $data = array(
                        'category' => $category['id'],
                        'cat_url'  => $category['path_url']
                        );

                switch ($action)
                {
                    case 'move':
                        ($hook = get_hook('admin_pages_move')) ? eval($hook) : NULL;

                        $this->db->where('id', $page_id);
                        $this->db->update('content', $data);
                    break;

                    case 'copy':
                        $page = $this->db->get_where('content', array('id' => $page_id))->row_array();

                        $page['category']       = $data['category'];
                        $page['cat_url']        = $data['cat_url'];
                        $page['lang_alias']     = 0;
                        $page['comments_count'] = 0;

                        $this->db->like('url', $page['url']);
                        $new_url = $this->db->get('content')->num_rows();

                        $page['url'] .= $new_url + 1;

                        unset($page['id']);

                        ($hook = get_hook('admin_pages_copy')) ? eval($hook) : NULL;

                        $this->db->insert('content', $page);
                    break;
                }
            }
        }

        updateDiv('page', site_url('admin/pages/GetPagesByCategory/'.$page['category']));
    }

    /**
     * Display window to move pages to some category
     */ 
    function show_move_window($action = 'move')
    {
        $this->template->assign('action', $action);
    	$this->template->assign('tree',$this->lib_category->build());
        $this->template->show('move_pages', FALSE);
    }

	/**
	 * Return tags in JSON
	 */
	function json_tags()
	{
		$this->load->module('tags');
		$new_tags = array();

		$search = $this->input->post('search_tags');

		if (mb_strlen($search) > 1)
		{
			    $tags = $this->tags->search_tags($search);

				foreach ($tags as $tag)
				{
					$new_tags[] = $tag['value'];
				}

			echo json_encode(array_unique($new_tags));
		}
	}


	/**
	 * Create keywords
	 */
	function ajax_create_keywords()
	{
		$text = $this->input->post('keys');

		if($text == '')
		{
			echo 'Передана пустая строка';
			exit;
		}

		$keywords = $this->lib_seo->get_keywords($text,TRUE);

			foreach ($keywords as $key=>$val)
			{
				if($val < 3)
				{
					$size=14 + $val;
				}
				if($val == 1)
				{
					$size=12;
				}
				if($val == 4)
				{
					$size=13;
				}
				if($val > 3)
				{
					$size=22;
				}

				echo '<a class="underline" onclick="$(\'page_keywords\').value = $(\'page_keywords\').value + \''.$key.', \' " style="font-size:'.$size.'px">'.$key.'</a> &nbsp;';
			}
	}

	/**
	 * Create description
	 */
	function ajax_create_description()
	{
		$desc = $this->lib_seo->get_description( $this->input->post('text') );
		echo $desc;
	}

	/**
	 * Change page post_status
	 */
	function ajax_change_status($page_id)
	{
        cp_check_perm('page_edit');

		$page = $this->cms_admin->get_page($page_id);

        ($hook = get_hook('admin_page_change_status')) ? eval($hook) : NULL;

		switch($page['post_status'])
		{
			case 'publish':
				$data = array('post_status' => 'pending');
				$this->cms_admin->update_page($page['id'],$data);

				jsCode(" $('p_status_".$page_id."').src = theme + '/images/pending.png'; ");
				jsCode(" $('p_status_".$page_id."').title = 'Ожидает Одобрения'; ");
			break;

			case 'pending':
				$data = array('post_status' => 'draft');
				$this->cms_admin->update_page($page['id'],$data);

				jsCode(" $('p_status_".$page_id."').src = theme + '/images/draft.png'; ");
				jsCode(" $('p_status_".$page_id."').title = 'Не опубликовано'; ");
			break;

			case 'draft':
				$data = array('post_status' => 'publish');
				$this->cms_admin->update_page($page['id'],$data);

				jsCode(" $('p_status_".$page_id."').src = theme + '/images/publish.png'; ");
				jsCode(" $('p_status_".$page_id."').title = 'Опубликовано'; ");
			break;
		}
	}

	/**
	 * Display pages by Category ID
	 *
	 * @access public
	 * @cat_id int
	 * @cur_page int
	 */
	function GetPagesByCategory($cat_id, $cur_page = 0)
	{
        $db_where = array(
                    'category' => $cat_id,
                    'lang_alias' => 0 
                    );


        ($hook = get_hook('admin_get_pages_by_cat')) ? eval($hook) : NULL;

        $offset = $this->uri->segment( 5 );    
        $offset == FALSE ? $offset = 0 : TRUE;

        $row_count = $this->_Config['per_page'];

        $category = $this->lib_category->get_category($cat_id); 

        if ($cat_id != 0)
        {    
            if ($category['order_by'] == NULL OR $category['sort_order'] == NULL)
            {
                $category['order_by'] = 'created';
                $category['sort_order'] = 'desc';
            }

            $this->db->order_by($category['order_by'], $category['sort_order']);
        }else{
            $this->db->order_by('created', 'desc');
        }

        $query = $this->db->get_where('content', $db_where, $row_count, $offset); 

        $this->db->where($db_where);
        $this->db->from('content');
        $total_pages = $this->db->count_all_results();

		if($query->num_rows > 0)
		{
    		// Begin pagination
			$config['base_url'] = site_url('admin/pages/GetPagesByCategory/'.$cat_id.'/');
			$config['container'] = 'page';
			$config['uri_segment'] = 5;
			$config['total_rows'] = $total_pages;
            $config['per_page'] = $this->_Config['per_page'];
            $this->pagination->num_links = 5;
			$this->pagination->initialize($config);
			// End pagination
    
            $pages = $query->result_array();

            $this->template->add_array(array(
                    'paginator' => $this->pagination->create_links_ajax(),
                    'pages'     => $pages,
                    'cat_id'    => $cat_id
                ));

			$this->template->show('pages', FALSE);
		}else{

            $this->template->assign('no_pages', TRUE);
            $this->template->assign('category', $category);

            $this->template->show('pages', FALSE);
		}
	}
}

/* End of pages.php */
