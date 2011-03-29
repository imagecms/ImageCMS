<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Image CMS
 *
 * CFCM Admin
*/

class Admin extends MY_Controller {

	public function __construct()
	{
		parent::__construct();

        $this->load->library('DX_Auth');
        cp_check_perm('module_admin');

		parent::__construct();

		$this->load->module('forms');
		$this->load->library('form_validation');
        $this->_set_forms_config();
	}

    public function _set_forms_config()
    {
        $config = array();
        $config['filter_xss_post'] = TRUE;
        $config['error_inline'] = TRUE;
        $config['upload_file'] = array(
                    'upload_path'   => './uploads/files',
                    'allowed_types' => 'zip|rar|txt',
                    'max_size'	    => '2048',
                );
        $config['upload_image'] = array(
                    'upload_path'   => './uploads/images',
                    'allowed_types' => 'gif|jpg|png',
                    'max_size'	    => '2048',
                    'max_width'     => '1024',
                    'max_height'    => '768',
                );
        $config['error_inline_html'] = '<div class="error_field_text el_magrin">%s</div>';
        $config['error_block_html'] = '<div class="errors">%s</div>';
        $config['help_text_html']   = '<br/><span class="help_text">%s</span>';
        $config['validation_errors_prefix'] = '';
        $config['validation_errors_suffix'] = '<br />';
        $config['field_error_class'] = 'field_error';
        $config['element_prefix'] 	= '<p class="clear">';
        $config['element_suffix'] 	= '</p>';
        $config['label_class'] = 'left';
        $config['required_flag'] = ' *';
        $config['required_label_class'] = 'required';
        $config['checkgroup_delimiter'] = '';
        $config['radiogroup_delimiter'] = '';
        $config['default_attr'] = array(
            'textarea' => array(
                'attributes' => 'rows="10" cols="50"',
            ),
            'text' => array(
                'class' => 'textbox_long',
            ),
            'captcha' => array(
                'label' => 'Код протекции',
            ),
        );

        $this->forms->set_config($config);
    }

	public function index()
	{
        $this->template->add_array(array(
            'top_navigation' => $this->fetch_tpl('top_navigation'),
            'fields'         => $this->db->order_by('weight', 'ASC')->get('content_fields')->result_array(),
            'groups'         => $this->load->module('cfcm/cfcm_forms')->prepare_groups_select(), 
        ));

	    $this->display_tpl('index');
	}

    public function create_field()
    {
        $form = $this->get_form('create_field');
        $form->action = $this->get_url('create_field'); 
        $form->title = 'Создание Поля';

        if ($_POST)
            if ($form->isValid())
            {
                $data = $form->getData();
                $data['field_name'] = 'field_'.$data['field_name'];

                if ($this->db->get_where('content_fields', array('field_name' => $data['field_name']))->num_rows() > 0)
                {
                    showMessage('Выберите другое имя.');
                }
                else
                {
                    // Set field weight.
                    $this->db->select_max('weight');
                    $query = $this->db->get('content_fields')->row();
                    $data['weight'] = $query->weight + 1;

                    $this->db->insert('content_fields', $data);
                    showMessage('После создано.');

                    updateDiv('page', $this->get_url('edit_field/'.$data['field_name']));
                }
            }
            else
            {
                showMessage($form->_validation_errors());
            }

        $this->template->add_array(array(
            'form'   => $form,
        ));

        $this->display_tpl('top_navigation');
        $this->display_tpl('_form');
    }

    public function edit_field_data_type($field_name)
    {
        $form = $this->get_form('create_field');
        $form->action = $this->get_url('edit_field_data_type/'.$field_name);
        $form->title = 'Редактирование Поля';

        $field = $this->db->get_where('content_fields', array('field_name' => $field_name))->row_array();

        if ($_POST)
        {
            $_POST['field_name'] = $field['field_name'];

            if ($form->isValid())
            {
                $data = $form->getData();
                unset($data['field_name']);

                if (!$data['in_search']) $data['in_search'] = 0;

                $this->db->limit(1);
                $this->db->where('field_name', $field_name);
                $this->db->update('content_fields', $data);
                
                showMessage('После обновлено.');
                updateDiv('page', $this->get_url('index'));
            }
            else
            {
                showMessage($form->_validation_errors());
                exit;
            }
        }

        $form->setAttributes($field);
        $form->field_name->field->attributes = 'disabled="disabled"';

        $this->template->add_array(array(
            'form' => $form,
        ));

        $this->display_tpl('top_navigation');
        $this->display_tpl('_form');
    }

    public function delete_field($field_name)
    {
        $this->db->where('field_name', $field_name);
        $this->db->delete('content_fields');

        $this->db->where('field_name', $field_name);
        $this->db->delete('content_fields_data');
    }

    public function edit_field($name = '')
    {
        $this->db->limit(1);
        $field = $this->db->get_where('content_fields', array('field_name' => (string) $name));

        if ($field->num_rows() == 1)
        {
            $field = $field->row();
            $field_data = unserialize($field->data);

            $form = $this->load->module('cfcm/cfcm_forms')->edit_field($field->type); 

            $form->title  = 'Редактирование поля '.$field->label;
            $form->action = $this->get_url('edit_field/'.$name); 

            $form->setAttributes($field_data);

            $form->validation->setInitial( str_replace('required|','', $field_data['validation']) );

            if ($_POST)
            {
                $data = $form->getData();

                if (isset($data['required']))
                    $data['validation'] = 'required|'.$data['validation'];
                    unset($data['validation_required']);

                $this->db->where('field_name', $field->field_name);
                $this->db->update('content_fields', array('data' => serialize($data)));
                showMessage('Поле обновлено.');
                updateDiv('page', $this->get_url('index'));
                exit;
            }

            $this->template->add_array(array(
                'form' => $form,
            ));

            $this->display_tpl('top_navigation');
            $this->display_tpl('_form');
        }
        else
        {
            echo 'Поле не найдено.';
        }
    }

    public function create_group()
    {
        $form = $this->get_form('create_group_form');
        $form->action = $this->get_url('create_group'); 
        $form->title = 'Создание Группы';

        if ($_POST)
            if ($form->isValid())
            {               
                $this->db->insert('content_field_groups', $form->getData());
                showMessage('Группа создана.');

                updateDiv('page', $this->get_url('edit_group/'.$this->db->insert_id()));
            }
            else
            {
                showMessage($form->_validation_errors());
            }

        $this->template->add_array(array(
            'form' => $form,
        ));

        $this->display_tpl('top_navigation');
        $this->display_tpl('_form');
    }

    public function edit_group($id)
    {
        $id = (int) $id;

        $group = $this->db->get_where('content_field_groups', array('id' => $id));
            
        if ($group->num_rows() == 1)
        {
            $group = $group->row_array();
        }
        else
        {
            showMessage('Группа не найдена.');
            exit;
        }

        $form = $this->get_form('create_group_form');
        $form->action = $this->get_url('edit_group/'.$id); 
        $form->title = 'Редактирование группы id '.$group['id'];

        if ($_POST)
            if ($form->isValid())
            {
                $data = $form->getData(); 

                $this->db->limit(1);
                $this->db->where('id', $id);
                $this->db->update('content_field_groups', $data);
                showMessage('Группа обновлена.');

                updateDiv('page', $this->get_url('list_groups'));
            }
            else
            {
                showMessage($form->_validation_errors());
            }

        $form->setAttributes($group);

        $this->template->add_array(array(
            'form' => $form,
        ));

        $this->display_tpl('top_navigation');
        $this->display_tpl('_form');
    }

    public function delete_group($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('content_field_groups');

        $this->db->where('group', $id);
        $this->db->update('content_fields', array('group' => '0'));

        $this->db->where('field_group', $id);
        $this->db->update('category', array('field_group' => '-1'));
    }

    public function list_groups()
    {
        $groups = $this->db->get('content_field_groups');

        if ($groups->num_rows() > 0)
        {
            $this->template->assign('groups', $groups->result_array());
        }

        $this->display_tpl('top_navigation');
        $this->display_tpl('group_list');
    }

    // Create form from category field group
    // on add/edit page tpl.
    public function form_from_category_group($category_id = FALSE, $item_id = FALSE, $item_type = FALSE)
    {
	if ($category_id == 'page')
	{
		$item_type = 'page';
		$item_id = 0;
		$category_id = 0;
	}
	
	if ($item_id == 'page')
	{
		$item_type = 'page';
		$item_id = $category_id;
		$category_id = 0;
	}
		
        $category = (object) $this->lib_category->get_category($category_id);

        if ($item_type == 'category')
            $category->field_group = $category->category_field_group;

	if ($category_id == '0')
		$category->field_group = 0;


        if ($category->field_group != '-1')
        {
            // Get group
            $group = $this->db->get_where('content_field_groups', array('id' => $category->field_group))->row();
 
            // Get all fields in group
            $this->db->where('group', $category->field_group);
            $this->db->order_by('weight', 'ASC');
            $query = $this->db->get('content_fields');

            if ($query->num_rows() > 0)
            {
                $form_fields = array();
                $fields = $query->result_array();
                    
                foreach ($fields as $field)
                {
                    $f_data = unserialize($field['data']);
                    if ($f_data == FALSE)
                        $f_data = array();

                    $form_fields[$field['field_name']] = array(
                        'type'  => $field['type'],
                        'label' => encode($field['label']),
                    );

                    $form_fields[$field['field_name']] = array_merge($form_fields[$field['field_name']], $f_data);
                }

                $form = $this->forms->add_fields($form_fields);

                // Set form attributes
                if ($item_id != FALSE AND $item_type != FALSE)
                {
                    $attributes = $this->get_form_attributes($fields, $item_id, $item_type);
                    
                    if (count($attributes) > 0 AND is_array($attributes))
                    {
                        $form->setAttributes($attributes);
                    }
                }
                $form->title = $group->name;

                $this->template->add_array(array(
                    'form' => $form,
                ));

                $this->display_tpl('_onpage_form');
                echo '<input type="hidden" name="cfcm_use_group" value="'.$group->id.'" />';
            }
            else
            {
                echo 'В группе нет полей';
            }
        }
        else
        {
            echo 'Для категории '.$category->name.' группа полей не назначена.';
        }
    }

    public function get_form_attributes($fields, $item_id, $item_type)
    { 
        $this->db->where('item_id', $item_id);
        $this->db->where('item_type', $item_type);
        $query = $this->db->get('content_fields_data');

        if ($query->num_rows() == 0)
            return FALSE;

        $result = array();
        $data = $query->result_array();

        foreach ($data as $row)
        {
            if (!isset($result[$row['field_name']]))
            {
                $result[$row['field_name']] = $row['data'];
            }
            elseif(isset($result[$row['field_name']]))
            {
                $result[$row['field_name']] = (array) $result[$row['field_name']]; 
                $result[$row['field_name']][] = $row['data'];
            }
        }

        return $result;
    }

    public function save_weight()
    {
        if (count($_POST['fields_names']) > 0)
        {
            foreach ($_POST['fields_names'] as $k => $v)
            {
                $name   = (string)substr($v, 5);
                $weight = (int)$_POST['fields_pos'][$k];

                $this->db->where('field_name', $name);
                $this->db->update('content_fields', array('weight' => $weight));
            }
        }
    }

    /**
     * Display template file
     */ 
	private function display_tpl($file = '')
	{
        $file = realpath(dirname(__FILE__)).'/templates/admin/'.$file.'.tpl';  
		$this->template->display('file:'.$file);
	}

    /**
     * Fetch template file
     */ 
	private function fetch_tpl($file = '', $data = array())
	{
        $this->template->add_array($data);

        $file = realpath(dirname(__FILE__)).'/templates/admin/'.$file.'.tpl';  
		return $this->template->fetch('file:'.$file);
	}

    public function get_url($segments)
    {
        return site_url('admin/components/cp/cfcm/'.$segments); 
    }

    public function get_form($name)
    {
        return $this->load->module('cfcm/cfcm_forms')->$name();
    }

}


/* End of file admin.php */
