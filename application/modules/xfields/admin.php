<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Image CMS
 * xfileds module beta
 */

class Admin extends Controller {

	private $mod_name = 'xfields';
	private $update = FALSE;
	private $field_id = 0;

	function __construct()
	{
		parent::Controller();
		if( $this->dx_auth->is_admin() == FALSE) exit;

		//$this->load->model('fields');
		$this->load->model('xfields_admin');
        $this->load->module('xfields/xfields','xfields'); 
	}

	function index()
	{
        $this->template->assign('create_tpl', $this->fetch_tpl('create_item'));

        $groups = $this->db->get('xfields_groups')->result_array();
        $this->template->assign('groups', $groups);
        $this->template->assign('groups_tpl', $this->fetch_tpl('groups'));

        $this->display_tpl('index');
    }

    function update_groups_list()
    {
        $groups = $this->db->get('xfields_groups')->result_array();
        $this->template->assign('groups', $groups);
        $this->template->assign('groups_tpl', $this->fetch_tpl('groups'));

        $this->display_tpl('groups');
    }

    /**
     * Display table with all fields
     */ 
    function fields_list()
    {
        $fields = $this->xfields_admin->get_all_fields();
        $groups = $this->db->get('xfields_groups')->result_array();

        $cnt = count($fields);
        for ($i = 0; $i < $cnt; $i++) {
            if ($fields[$i]['group_id'] != 0)
            {
                foreach ($groups as $group)
                {
                    if ($fields[$i]['group_id'] == $group['id'])
                    {
                        $fields[$i]['group'] = $group['title']; 
                    }
                }
            }
        }
    
        $this->template->assign('fields', $fields);
        $this->display_tpl('fields_list');
    }

	/**
	 * Create new custom field
	 *
	 * @access public
	 */
	function create($type = FALSE)
	{
        $data = array();

        // Check if field name is aviable
		if ( $this->xfields_admin->check_name( $this->input->post('name') ) == FALSE  AND $this->update == FALSE )
			$this->show_name_error();

        $this->load->library('form_validation');

        if ($this->form_validation->alpha_numeric( $this->input->post('name') ) == FALSE)
        {
            showMessage('Имя должно содержать только латинские символи и цифры.');
            exit;
        }
        

		switch ($type)
		{
			case 'textbox':
				$data = array(
				'data' => array(
						'label_text' => $this->input->post('label_text'),
						'default_value' => $this->input->post('default_value'),
						'css' => $this->input->post('css')
						),
				);
            break;

			case 'image':
				$data = array(
				'data' => array(
						'label_text' => $this->input->post('label_text'),
						'default_value' => $this->input->post('default_value'),
						'css' => $this->input->post('css')
						),
				);
			break;

			case 'user_file':
				$data = array(
				'data' => array(
						'label_text' => $this->input->post('label_text'),
						'default_value' => $this->input->post('default_value'),
						'css' => $this->input->post('css')
						),
				);
			break;

			case 'dropdown':

				 if ( $_POST['values'][0] == '' )
				 {
					showMessage('Пожалуйста, введите хотя бы одно Значение'); exit;
				 }

				$data = array(
				'data' => array(
						'label_text' => $this->input->post('label_text'),
						'values' => $this->input->post('values'),
						'css' => $this->input->post('css')
						),
				);
			break;

			case 'textarea':

				$data = array(
				'data' => array(
						'label_text' => $this->input->post('label_text'),
						'default_value' => $this->input->post('default_value'),
						'css' => $this->input->post('css')
						),
				);
			break;
		}

        $data['group_id'] = $this->input->post('group_id');
		$data['type']     = $type;
		$data['name']     = $this->input->post('name');

		if ($this->update === FALSE)
		{
			$this->xfields_admin->insert_field($data);
            updateDiv('page', site_url('admin/components/cp/xfields/'));
			showMessage('Поле добавлено.');
		}else{
			$this->xfields_admin->update_field($data,$this->field_id);
			showMessage('Изменения сохранены.');
		}

        updateDiv('xfields_list', site_url('admin/components/run/xfields/fields_list'));
	}

	private function show_name_error()
	{
		showMessage('Пожалуйста, выберите другое Имя.<br> Имя должно содержать только латинские символи и цифры.');
		die();
	}

	function update($field_id,$type)
	{
		if ($this->xfields_admin->get_field($field_id) !== FALSE)
		{
			$this->update = TRUE;
			$this->field_id = $field_id;
			$this->create($type);
		}
    }

    function edit_field($id)
    {
		$field = $this->xfields_admin->get_field($id);

			if ($field != FALSE)
			{
                $this->template->assign('type', $field['type']);

                $this->template->add_array($field);
                $this->template->assign('groups', $this->db->get('xfields_groups')->result_array() );
                $this->template->assign('tpl',$this->fetch_tpl('items'));
                $this->display_tpl('edit_field');
			}else{
				//echo 'Field not found!';
			}
    }


	/**
	 * Set page xfields
	 *
	 * @access public
	 */
    function set_page_xfields($page_id = FALSE)
	{
		$fields = $this->input->post('xfields');

		if ( $fields != FALSE )
        {
    		// Delete existing page fields
	    	$this->xfields_admin->delete_page_fields($page_id);

			foreach($fields as $k)
			{
				$field = $this->xfields_admin->get_field_name($k);
				$this->xfields_admin->set_page_field($page_id,$k,$this->input->post($field));
			}
        }else{
           $this->xfields_admin->delete_page_fields($page_id); 
        }
	}

	/**
	 * Prepare and display all xfields
	 *
	 * @access public
	 */
	function list_all_fields($page_id = 0)
	{
        $group_fields = array();
        $none_group_fields = array();

        $fields = $this->xfields_admin->get_all_fields();
        $groups = $this->db->get('xfields_groups');

		if ($fields != FALSE)
		{
			foreach ( $fields as $field )
			{
				$this->xfields->fields_arr[$field['name']] = $field;
					if ($page_id != 0)
					{
						$this->xfields->fields_arr[$field['name']]['field_data'] = $this->xfields_admin->get_field_value($page_id,$field['id']);
					}
			}

				$cnt = count($fields);
				for ($i = 0; $i < $cnt; $i++)
				{
					$this->xfields->page_id = $page_id;
					$fields[$i]['html'] = $this->xfields->generate_field($fields[$i]['name']);

						if( $this->db->get_where('xfields_sets',array('page_id' => $page_id, 'field_id' => $fields[$i]['id'] ))->num_rows() > 0 )
						{
							$fields[$i]['checked'] = ' checked="checked" ';
						}
				}

                // Separate fields by groups
                if ($groups->num_rows() > 0)
                {
                    $groups = $groups->result_array();
                    
                    $cnt = count($groups);
                    for ($i = 0; $i < $cnt; $i++)
                    {
                        foreach ($fields as $field)
                        {
                            if ($field['group_id'] == $groups[$i]['id'])
                            {
                                //$group_fields[ $group['id'] ][ $field['id'] ] = $field;
                                $groups[$i]['fields'][] = $field;
                            }
                            if ($field['group_id'] == 0)
                            {
                                $none_group_fields[ $field['id'] ] = $field;
                            }
                        }
                    }
                }else{
                    $none_group_fields = $fields;
                    $groups = array();
                }

                $this->template->assign('none_group', $none_group_fields);
                $this->template->assign('groups', $groups);

				$this->display_tpl('all_fields');
			}
	}


    /**
     * Create new group
     *
     * TODO: validation
     */ 
    function create_group()
    {
		$this->form_validation->set_rules('name', 'Имя', 'required|alpha_dash|max_length[100]');
		$this->form_validation->set_rules('title', 'Заголовок', 'required|max_length[100]');

		if ($this->form_validation->run() == FALSE)
		{
	    	showMessage (validation_errors());
        }else{

        $data = array(
                'name' => $_POST['name'],
                'title' => $_POST['title'],
                );
        
        $this->db->insert('xfields_groups', $data);

        showMessage('Группа создана'); 
        updateDiv('xfield_groups', site_url('admin/components/cp/xfields/update_groups_list'));
        }
    }

    function edit_group($id = FALSE)
    {
        if ($id != FALSE)
        {
            $group = $this->db->get_where('xfields_groups', array('id' => $id))->row_array();
            $this->template->assign('group', $group);
            $this->display_tpl('edit_group');
        }
    }

    function update_group($id = FALSE)
    {
		$this->form_validation->set_rules('name', 'Имя', 'required|alpha_dash|max_length[100]');
		$this->form_validation->set_rules('title', 'Заголовок', 'required|max_length[100]');

		if ($this->form_validation->run() == FALSE)
		{
	    	showMessage (validation_errors());
        }else{
            $data = array(
                    'name' => $this->input->post('name'),
                    'title' => $this->input->post('title')
                );
            
            $this->db->where('id', $id);
            $this->db->update('xfields_groups', $data);

            updateDiv('xfield_groups', site_url('admin/components/cp/xfields/update_groups_list'));
        }
    }

    function delete_group($id = FALSE)
    {
        if ($id != FALSE)
        {
            $this->db->where('id', $id);
            $this->db->delete('xfields_groups');

            $this->db->where('group_id', $id);
            $this->db->update('xfields', array('group_id' => '0' ));
        }
    }

    function set_fields_position()
    {
        $fields = $this->input->post('fields');

        foreach ($fields as $k => $v)
        {
            $item = explode('_', substr($v, 6));

            $this->db->where('id', $item[0]);
            $this->db->update('xfields', array('position' => $item[1]));
        }
    }

	function edit($id)
	{
		$field = $this->xfields_admin->get_field($id);

			if ($field != FALSE)
			{
				$this->template->assign('type',$field['type']);
				$this->template->add_array($field);
				$this->display_tpl('items');
			}else{
				echo 'Field not found!';
			}
	}

	function delete_page_xfields($page_id)
	{
		$this->xfields_admin->delete_page_fields($page_id);
	}

	private function alfa_numeric($str)
	{
		return ( ! preg_match("/^([a-z0-9])+$/i", $str)) ? FALSE : TRUE;
    }

    function delete_field($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('xfields');

        $this->db->where('field_id', $id);
        $this->db->delete('xfields_sets');

        return TRUE;
    }

    function move_fields_window()
    {
        $groups = $this->db->get('xfields_groups')->result_array();
        $this->template->assign('groups', $groups);

        $this->display_tpl('move_window');
    }

    function set_fields_group()
    {
        $group = $this->input->post('group_id');
        $fields = $this->input->post('fields');

        foreach ($fields as $k => $v)
        {
            $id = substr($v,5); 

            $this->db->where('id', $id);
            $this->db->update('xfields', array('group_id' => $group));
        }
    }    

    function delete_fields()
    {
        $fields = $this->input->post('fields');

        foreach ($fields as $k => $v)
        {
            $id = substr($v,5); 
            $this->delete_field($id); 
        }

    }

	// Template functions
    function create_page_tab()
    {
        $this->db->from('xfields');
        $total = $this->db->count_all_results(); 

        if ($total > 0)
        {
            $this->display_tpl('tab');
        }
    }

    function load_item_tpl($type = 'textbox')
	{
        $this->template->assign('groups', $this->db->get('xfields_groups')->result_array());    
        $this->template->assign('type',$type);
		$this->display_tpl('items');
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

}

/* End of file admin.php */
