<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Image CMS
 */

class Admin extends MY_Controller {

	private $root_menu = array();
	private $sub_menu  = array();
	private $sub_menus  = array();
	private $padding = 0;
    private $menu_result = array();
    private $for_delete = array();

	function __construct()
	{
		parent::__construct();

		// Only admin access
        $this->load->library('DX_Auth');

        $this->cache->delete_group('menus');
		$this->load->library('Form_validation');    
        $this->load->library('lib_admin');
		$this->load->module('menu'); 
        $this->load->model('menu_model');

        $this->template->assign('langs', $this->_get_langs());
    
        $this->menu->select_hidden = TRUE; //select hidden items
	}

	function index()
	{
		$root_menus = $this->db->get('menus')->result_array();

        $this->template->assign('menus',$root_menus);
        $this->display_tpl('menu_list');
	}

    /**
     * List all menu items
     */ 
	function menu_item($name = '')
	{
		$this->menu->prepare_menu_array($name);
		$this->root_menu =& $this->menu->menu_array;
		$this->sub_menu =& $this->menu->sub_menu_array;

		$this->process_root($this->root_menu);

		$ins_id = $this->db->get_where('menus',array('name'=>$name))->row_array();

		$this->template->assign('menu_result',$this->menu_result);
		$this->template->assign('insert_id',$ins_id['id']);   

        $this->display_tpl('main');
    }

    function list_menu_items($menu_id = 0)
    {
        if ($menu_id > 0)
        {
            $this->menu_item( $this->get_name_by_id($menu_id) );
        }
    }

    /**
     * Display create_item.tpl
     */ 
    function create_item($id)
    {
        $this->template->assign('insert_id', $id);
        $this->display_tpl('create_item');
    }

    /**
     * Display template to select/edit menu item
     */ 
    function display_selector($id, $type = 'page')
    {
        $this->template->assign('insert_id',$id);

		$this->menu->prepare_menu_array( $this->get_name_by_id($id) );
		$this->root_menu =& $this->menu->menu_array;
		$this->sub_menu =& $this->menu->sub_menu_array;
        $this->process_root($this->root_menu);
		$this->template->assign('menu_result',$this->menu_result);

		// roles
		$query = $this->db->get('roles');
		$this->template->assign('roles',$query->result_array());
		// roles

        $this->load->library('lib_category');
    
        $this->template->assign('tree', $this->lib_category->build() );
        if ($type != 'category') {
            $this->template->assign('cats', $this->fetch_tpl('cats') ); 
        }

        $this->template->assign('action', 'insert');
        $this->template->assign('update_id', '0');

        switch ($type)
        {
            case 'page':
                $this->display_tpl('pages_selector');
            break;

            case 'category':
                $this->template->assign('cats_list', $this->fetch_tpl('cats_list'));
                $this->display_tpl('category_selector');
                break;

            case 'module':
                $this->template->assign('modules',$this->_load_module_list());
                $this->display_tpl('module_selector');
            break;

            case 'url':
                $this->display_tpl('url_selector');
            break;
        }
    }

    /*
     * Load all modules info
     *
     * @access private
     * @return array
     */ 
    private function _load_module_list()
    {
        $this->load->module('admin/components');

        $modules = $this->db->get('components')->result_array();
        
        $cnt = count($modules);
        for ($i = 0; $i < $cnt; $i++) {
            $info = $this->components->get_module_info($modules[$i]['name']);
            
            $modules[$i]['menu_name'] = $info['menu_name'];
            $modules[$i]['description'] = $info['description'];
        }

        unset($info);

        return $modules;
    }


    /**
     * Get menu name by ID
     *
     * @param $id integer
     * @access public
     * @return arra
     */ 
    function get_name_by_id($id)
    {
        $query = $this->db->get_where('menus',array('id' => $id))->row_array();
        return $query['name'];
    }

    /**
     * Delete menu item and its sub items
     *
     * @access public
     * @return bool
     */
	function delete_item($id)
	{
        cp_check_perm('menu_edit');

		if ($id > 0)
		{
			$this->db->where('id', $id);
			$this->db->limit(1);
			$this->db->delete('menus_data');

            $this->_get_delete_items($id);
            
            foreach($this->for_delete as $item_id)
            {
                $this->menu_model->delete_menu_item($item_id);                
            }

            return TRUE;
        }else{
            return FALSE;
        }
    }

    /**
     * Find sub items for delete
     *
     * @param $id integer - item id
     * @access private
     * @return array
     */  
    private function _get_delete_items($id)
    {
        $items = $this->menu_model->get_parent_items($id);   
        
        if ($items !=  FALSE)
        {
            foreach($items as $item)
            {
                $this->for_delete[] = $item['id'];
                $this->_get_delete_items( $item['id'] );
            }
        }
    }

    /**
     * Find all subitems and push in $this->sub_menus array
     *
     * @param $id integer - item id
     * @access private
     */  
    private function _get_sub_items($id)
    {
        $items = $this->menu_model->get_parent_items($id);   
        
        if ($items !=  FALSE)
        {
            foreach($items as $item)
            {
                $this->sub_menus[] = $item['id'];
                $this->_get_sub_items( $item['id'] );
            }
        }
    }



    /**
     * Display edit item window
     */ 
	function edit_item($item_id,$menu_name)
	{
        cp_check_perm('menu_edit');

		$this->menu->prepare_menu_array($menu_name);
		$this->root_menu =& $this->menu->menu_array;
		$this->sub_menu =& $this->menu->sub_menu_array;
		$this->process_root($this->root_menu);
		$this->template->assign('menu_result',$this->menu_result);

        $item = $this->menu_model->get_item($item_id);

		$this->template->add_array($item);
		$this->display_tpl('edit_item');
	}

	function process_root($array)
	{
		foreach ($array as $item)
		{
			$sub_menus = $this->menu->_get_sub_menus($item['id']);

			$item['padding'] = $this->padding;
			$item['url'] = $item['link'];
			$item['link'] = site_url( $item['link'] );

			array_push($this->menu_result, $item);

				if ($sub_menus != NULL)
				{
					$this->padding += 1;
					$this->process_root($sub_menus);
				}
		}
		$this->padding -= 1;
	}

    /**
     * Insert link into menu
     * Set positions
     */     
    function insert_menu_item()
    {
	
	var_dump($_POST);
	
        cp_check_perm('menu_edit');

        $roles = $_POST['roles'];
        if ($roles == NULL)
        {
            $roles = '';
        }else{
            $roles = serialize($_POST['roles']);
        }

        // Item position
        if ($_POST['position_after'] > 0)
        {
            $after_pos = $this->menu_model->get_item_position($_POST['position_after']);
            $after_pos = $after_pos['position'];
    
                if($after_pos != FALSE)
                {
                    $position = $after_pos + 1;

                    $sql = "UPDATE `menus_data` 
                            SET `position`=`position` + 1 
                            WHERE `position` > '$after_pos' 
                            AND `menu_id`='".$this->input->post('menu_id')."' 
                            AND `parent_id`='".$this->input->post('parent_id')."' 
                            ";
                    $this->db->query($sql);
                }
        }
        
        if($_POST['position_after'] == 0)
        {
            $this->db->select_max('position');
            $this->db->where('menu_id', $_POST['menu_id']);
            $this->db->where('parent_id', $_POST['parent_id']);
            $query = $this->db->get('menus_data')->row_array();

            if ($query['position'] == NULL)
            {
                $position = 1;
            }else{
                $position = $query['position'] + 1;
            }
        }
       
        if($_POST['position_after'] == 'first')
        {
            $this->db->select_min('position');
            $this->db->where('menu_id', $_POST['menu_id']);
            $this->db->where('parent_id', $_POST['parent_id']);
            $query = $this->db->get('menus_data')->row_array();

            if ($query['position'] == NULL)
            {
                $position = 1;
            }else{
                $position = $query['position'] - 1;
            }
                
        }
         
        $item_data = array(
                    'menu_id'   => $_POST['menu_id'],
                    'item_id'   => $_POST['item_id'],
                    'item_type' => $_POST['item_type'],
                    'title'     => htmlentities($_POST['title'], ENT_QUOTES, 'UTF-8'),
                    'hidden'    => $_POST['hidden'],
        			'item_image'=> $_POST['item_image'],
                    'roles'     => $roles,
                    'parent_id' => $_POST['parent_id'],
                    'position'  => $position,
                    );

        if ($item_data['item_type'] == 'module')
        {
            $mod_info = array(
                        'mod_name' => $_POST['item_id'],       
                        'method' => trim($_POST['method']),
			'newpage' => $_POST['newpage']
                    );

            $item_data['item_id']  = 0;
            $item_data['add_data'] = serialize($mod_info);
        }

        if ($item_data['item_type'] == 'url')
        {
            $item_data['item_id'] = 0;
            $item_data['add_data'] = serialize(array('url' => $_POST['url'], 'newpage' => $_POST['newpage']));
        }
	
	if (!isset($item_data['add_data'])) $item_data['add_data'] = serialize(array('newpage'=>$_POST['newpage'])) ;

        if ($_POST['update_id'] == 0)
        {  
            // Insert new item  
            $this->menu_model->insert_item($item_data);        
        }else{
            // Update item
            $error = FALSE;

            // Error: wrong parent id
            if ($_POST['update_id'] == $_POST['parent_id'])
            {
                $error = TRUE;
            }

            // Error: don't place root menu in sub
            $item = $this->menu_model->get_item($_POST['update_id']);
            if ($item['parent_id'] == 0)
            {
                $this->_get_sub_items($_POST['update_id']);         

                foreach ($this->sub_menus as $k => $v)
                {
                    if ($v == $_POST['parent_id'])
                    {
                        $error = TRUE;
                    }
                }
            }
 
            if ($_POST['position_after'] == 0) unset($item_data['position']);

            if ($error == TRUE)
            {
                return FALSE;
            }else{
                $this->db->where('id',$_POST['update_id']);
                $this->db->update('menus_data', $item_data);
            }
        }
    }

    function save_positions()
    {
        cp_check_perm('menu_edit');

        foreach ($_POST['items_pos'] as $k => $v)
        {
            $item = explode('_', substr($v, 4));
            $this->menu_model->set_item_position( (int) $item[0],$item[1]);
        }
    }

    /**
     * Create new menu
     *
     * @access public
     */ 
	function create_menu()
	{
        cp_check_perm('menu_create');

        $this->check_menu_data();

		$val = $this->form_validation;
		$val->set_rules('menu_name', 'Имя', 'required|min_length[2]|max_length[25]|alpha_dash');
		$val->set_rules('main_title', 'Название', 'required|max_length[100]');
		$val->set_rules('menu_desc', 'Описание', 'max_length[500]');
		$val->set_rules('menu_tpl', 'Шаблон', 'max_length[500]');
		$val->set_rules('menu_expand_level', 'Уровень раскрытия', 'numeric|max_length[2]');


		if ($this->form_validation->run($this) == FALSE)
		{
			showMessage ( validation_errors() );
		}else{

			$data = array(
				'name' => $this->input->post('menu_name'),
				'main_title' => $this->input->post('main_title'),				
				'description' => $_POST['menu_desc'],
				'tpl' => $this->input->post('menu_tpl'),
				'expand_level' => $this->input->post('menu_expand_level'),
				'created' => date('Y-m-d H:i:s')
			);

            $this->menu_model->insert_menu($data);

            // Update menu list and close window
            updateDiv('menu_module_block',site_url('admin/components/cp/menu/index'));
            closeWindow('create_menu_w'); 
		}
	}

    function edit_menu($id)
    {
        cp_check_perm('menu_edit');

        $menu_data = $this->menu_model->get_menu($id);
        $this->template->add_array($menu_data);
        $this->display_tpl('edit_menu');
    }

    function update_menu($id)
    {
        cp_check_perm('menu_edit');

   		if ($_POST['menu_name'] == NULL)
		{
			showMessage('Поле Имя обязательно для заполения!.');
			exit;
		}

    	$val = $this->form_validation;
		$val->set_rules('menu_name', 'Имя', 'required|min_length[2]|max_length[25]|alpha_dash');
		$val->set_rules('main_title', 'Название', 'required|max_length[100]');
		$val->set_rules('menu_desc', 'Описание', 'max_length[500]');
		$val->set_rules('menu_tpl', 'Шаблон', 'max_length[500]');
		$val->set_rules('menu_expand_level', 'Уровень раскрытия', 'numeric|max_length[2]');


		if ($this->form_validation->run($this) == FALSE)
		{
			showMessage ( validation_errors() );
		}else{

			$data = array(
				'name' => $this->input->post('menu_name'),
				'main_title' => $this->input->post('main_title'),
				'description' => $_POST['menu_desc'],
				'tpl' => $this->input->post('menu_tpl'),
				'expand_level' => $this->input->post('menu_expand_level'),
				'created' => date('Y-m-d H:i:s')
			);

            $this->db->where('id', $id);
            $this->db->update('menus', $data);

            updateDiv('menu_module_block',site_url('admin/components/cp/menu/index'));
		}


    }

    function check_menu_data()
    {
		if ($_POST['menu_name'] == NULL)
		{
			showMessage('Поле Имя обязательно для заполения!.');
			exit;
		}

		if ( $this->db->get_where('menus',array('name'=>$_POST['menu_name']))->num_rows() > 0 )
		{
			showMessage('Меню с таким именем уже существует!');
			exit;
		}
    }

    function delete_menu($name)
    {
        cp_check_perm('menu_delete'); 

  		$this->menu->prepare_menu_array($name);
		$this->root_menu =& $this->menu->menu_array;
		$this->sub_menu =& $this->menu->sub_menu_array;

        $this->process_root($this->root_menu);  

        //root menus array
        foreach($this->root_menu as $menu)
        {
           $this->menu_model->delete_menu_item($menu['id']);
        }

        //sub menus array
        foreach($this->sub_menu as $menu)
        {
            $this->menu_model->delete_menu_item($menu['id']);
        }

        //delete main menu
        $this->menu_model->delete_menu($name);
    }
   
    function create_tpl()
    {
        cp_check_perm('menu_create');

        $this->display_tpl('create_menu');
    }

    /**
     * Get pages and return in JSON
     */ 
    function get_pages($cat_id = 0, $cur_page = 0)
    {
        $data['nav_count'] = array();
        $data['links'] = 0;

        $per_page = (int) $_POST['per_page'];

        $this->db->select('id, title, url, cat_url');
        $this->db->order_by('created','desc');
        $this->db->where('lang_alias',0);
        $this->db->where('category', $cat_id);

        if ($cur_page == 0)
        {
            $pages = $this->db->get('content', $per_page);
        }else{
            $pages = $this->db->get('content',$per_page, $per_page * $cur_page);
        }

        if ($pages->num_rows() > 0)
        {
            $pages = $pages->result_array();
            $data['pages_list'] = $pages;
            $total = $this->db->get_where('content',array('lang_alias' => 0, 'category' => $cat_id))->num_rows();

            $data['links'] = ceil($total / $per_page);
            if ($data['links'] == 1) $data['links'] = 0;
            
            echo json_encode($data);
        }
    }

    /**
     * Search pages
     */ 
    function search_pages($cur_page = 0)
    {
        $data['nav_count'] = array();
        $data['links'] = 0;

        $per_page = (int) $_POST['per_page'];

        $this->db->select('id, title, url, cat_url, category');
        $this->db->order_by('created','desc');
        $this->db->where('lang_alias',0);
        $this->db->like('title',$_POST['search']);

        if ($cur_page == 0)
        {
            $pages = $this->db->get('content', $per_page);
        }else{
            $pages = $this->db->get('content',$per_page, $per_page * $cur_page);
        }

        if ($pages->num_rows() > 0)
        {
            $pages = $pages->result_array();

            // Insert category names     
            $this->load->library('lib_category');    
            $cnt = count($pages);
            for ($i = 0;$i < $cnt; $i++) {

                $cat = $this->lib_category->get_category($pages[$i]['category']);

                $name = '';

                if ($cat['parent_id'] != 0)
                {
                    foreach($cat['path'] as $path)
                    {
                       $c = $this->lib_category->get_category_by('url',$path);
                       $name .= $c['name'].' &rarr; '; 
                    }
                }else{
                    $name = $cat['name'].' &rarr; ';
                }

                if ($pages[$i]['category'] == 0)
                {
                    $pages[$i]['cat_name'] = 'Без категории &rarr; ';
                }else{
                    $pages[$i]['cat_name'] = $name;
                }                
            }

            $data['pages_list'] = $pages;

            $this->db->select('id');
            $this->db->where('lang_alias', 0);
            $this->db->like('title',$_POST['search']);                
            $total = $this->db->get('content')->num_rows();

            $data['links'] = ceil($total / $per_page);

            if ($data['links'] == 1) $data['links'] = 0;

            echo json_encode($data);
        }
    }

    /**
     * Ajax function
     * Load item data and return it in Json
     */ 
    function get_item()
    {
        $item_id = (int) $_POST['item_id'];

        $this->db->where('id',$item_id);
        $query = $this->db->get('menus_data');

        if ($query->num_rows() > 0)
        {
            $data = $query->row_array();
		
		if(!empty($data['add_data']))
			$data['add_data'] = unserialize($data['add_data']);

            $cnt = count($data);
            $data['roles'] = unserialize($data['roles']);
            
            echo json_encode($data);
        }
    }

    // Template functions
	function display_tpl($file)
	{
        $file =  realpath(dirname(__FILE__)).'/templates/'.$file.'.tpl';  
		$this->template->display('file:'.$file);
	}

	function fetch_tpl($file)
	{
        $file =  realpath(dirname(__FILE__)).'/templates/'.$file.'.tpl';  
		return $this->template->fetch('file:'.$file);
	}

    function translate_window($id)
    {
        $langs = $this->_get_langs();

        $n=0;
        foreach ($langs as $l)
        {
            $t = $this->db->get_where('menu_translate', array('item_id' => $id, 'lang_id' => $l['id']));

            if ($t->num_rows() == 1)
            {
                $t = $t->row_array();
                $langs[$n]['curt'] = $t['title'];
            }

        $n++;
        }

        $this->template->assign('langs', $langs);
        $this->template->assign('id', $id);

        $this->display_tpl('translate_item');
    }
    
    function translate_item($id)
    {
        cp_check_perm('menu_edit');

        $langs = $this->_get_langs();

        $this->db->where('item_id', $id);
        $this->db->delete('menu_translate');

        foreach ($langs as $lang)
        {
            if (isset($_POST['lang_'.$lang['id']]))
            {
		if  ( trim( $_POST['lang_'.$lang['id']] ) != '' )
		{
			$data = array(
			    'item_id' => (int) $id,
			    'lang_id' => $lang['id'],
			    'title'   => $_POST['lang_'.$lang['id']],
			);
			$this->db->insert('menu_translate', $data);
		}
            }
        }

        closeWindow('translate_m_Window');
    }

    function _get_langs()
    {
        $query = $this->db->get('languages');

        if ($query->num_rows() > 0)
        {
            return $query->result_array();
        }
        else
        {
            return array();
        }
    }

}
/* End of file admin.php */
