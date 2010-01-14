<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Image CMS
 *
 * xfields module
 */

class Xfields extends Controller {

	public $page_id = 0;
	public $prefix = '';
	public $suffix = '<br/>';

	public $fields_arr = array(); // Fields to generate

	function __construct()
	{
		parent::Controller();

		$this->load->module('core');
        $this->load->model('fields');
	}

    function index()
    {
        redirect('');
    }

    /**
     * Load and process page xfields
     */ 
	function autoload()
    {
        $this->load->helper('xfields');

        if ($this->core->core_data['data_type'] == 'page')
		{
            $this->_page_fields($this->core->page_content['id']); 
        }else{
			return FALSE;
		}    
    }

    /**
     * Load and assign page fields
     */
    public function _page_fields($page_id)
    {
        $fields = $this->fields->get_page_fields($page_id);

        $this->page_id = $page_id;
        $this->prepare_arr($fields);
        return $this->assign_all();
    }

    public function _page_fields_extended($page_id)
    {
        $this->_page_fields($page_id);
        return $this->fields_arr;
    }

    /**
     * Load fields group
     */ 
    function load_group($group_name, $type = 'text')
    {
        if ($type == 'item')
        {
            $this->load->helper('form'); 
        }

        $group_fields = array();

        $group = $this->db->get_where('xfields_groups', array('name' => $group_name))->row_array();

        foreach($this->fields_arr as $field)
        {
            if ($field['group_id'] == $group['id'])
            {
                $group_fields['fields'][$field['id']] = $field;
                $field['data']['label_text'] = NULL;
                $group_fields['fields'][$field['id']]['rezult'] = $this->$field['type']($field, $type);
            }
        }

        if (count($group_fields) > 0)
        {
            $group_fields['info'] = $group;
            $this->template->assign('xfields_'.$group_name, $group_fields);
            return $group_fields;
        }else{
            $this->template->assign('xfields_'.$group_name, FALSE);
            return FALSE;
        }
    }



	/**
	 * Prepare xfields aray
	 *
	 * @access public
	 * @return bool
	 */
	function prepare_arr($fields)
    {
        $this->fields_arr = array();

		if ($fields != FALSE)
		{
			foreach ( $fields as $field )
			{
				$this->fields_arr[$field['name']] = $field;
			}

			return TRUE;
		}else{
			return FALSE;
		}
	}

	/**
     * Assign xfields
     * 
	 * @access public
	 * @return bool
	 */
	function assign_all()
    {
        $fields_arr = array();

		foreach ( $this->fields_arr as $field )
		{
            $fields_arr[$field['name']] = $this->$field['type']($field,'text');
        }

        
        $this->template->assign('xfields', $fields_arr);

        return $fields_arr;
	}

	/**
	 * Display page custom fields
	 *
	 * @access public
	 */
	function display_fields($fields = array(), $type = 'text')
	{
		if (count($fields) == 0)
		{
			$this->display_all($type);
        }
        else
        {
			foreach ($fields as $field)
			{
				echo $this->prefix.$this->generate_field($field,$type).$this->suffix;
			}
		}
	}

	/**
	 * Display all page fields
	 *
	 * @access public
	 */
	function display_all($type = 'text', $list = '')
    {
        if ($list == 'ul') echo '<ul>';

		foreach ( $this->fields_arr as $field )
        {
            if ($list == 'ul') echo '<li>';

                echo $this->prefix.$this->generate_field($field['name'],$type).$this->suffix;

            if ($list == 'ul') echo '</li>';
        }

        if ($list == 'ul') echo '</ul>';
	}

	/**
	 * Display field by name
	 * $return - possible values item/text
	 *
	 * item - will return html text of generated field
	 * text - will return only text of item value
	 *
	 * @access public
	 * @return mixed
	 */
	function generate_field($name, $return_type = 'item')
	{
		if ( isset($this->fields_arr[ $name ]) AND method_exists($this,$this->fields_arr[$name]['type']) )
		{
				$field = $this->fields_arr[$name];
				$this->load->helper('form');
				return $this->$field['type']($field,$return_type);
		}else{
			return FALSE;
        }	
    }

	/**
	 * Generate <label>
	 *
	 * @access public
	 * @return string
	 */
	function insert_label($label_content = '', $name = '')
	{
		return form_label($label_content, $name);
	}


	/**
	 * Create textbox
	 *
	 * @access public
	 * @return mixed
	 */
	function textbox($field, $return_type)
	{
		$f_data = array(
              'name'        => $field['name'],
              'id'          => $field['name'],
			  'value'       => $this->set_item_value($field),
              'style'       => $field['data']['css'],
              );

		switch ($return_type)
		{
			// Textbox for admin editing
			case 'item':
				return $field['data']['label_text'] == '' ?  form_input($f_data):
					   							         	 $this->insert_label($field['data']['label_text'],$f_data['name']).form_input($f_data);
			break;

			// Text for display on pages
			case 'text':
				return $field['data']['label_text'].' '.$f_data['value'];
			break;
		}
	}

    function image($field, $return_type)
    {
		$f_data = array(
              'name'        => $field['name'],
              'id'          => $field['name'],
			  'value'       => $this->set_item_value($field),
              'style'       => $field['data']['css'],
              );

        $btn_code = ' <input type="button" value="Выбрать Изображение"  onclick="tinyBrowserPopUp(\'image\', \''.$f_data['id'].'\');" /> ';

		switch ($return_type)
		{
			case 'item':
				return $field['data']['label_text'] == '' ?  form_input($f_data):
					   							         	 $this->insert_label($field['data']['label_text'],$f_data['name']).form_input($f_data).$btn_code;
			break;

			case 'text':
                $image = array(
                          'src' => site_url($f_data['value']),
                          'alt' => $field['data']['label_text'],
                          'title' => $field['data']['label_text'],
                );

                return '<img src="'.$image['src'].'" alt="'.$image['alt'].'" title="'.$image['title'].'"  />';

			break;
		}
    }

    function user_file($field, $return_type)
    {
		$f_data = array(
              'name'        => $field['name'],
              'id'          => $field['name'],
			  'value'       => $this->set_item_value($field),
              'style'       => $field['data']['css'], 
              );

        $btn_code = ' <input type="button" value="Выбрать Файл"  onclick="tinyBrowserPopUp(\'file\', \''.$f_data['id'].'\');" /> ';

		switch ($return_type)
		{
			case 'item':
				return $field['data']['label_text'] == '' ?  form_input($f_data):
					   							         	 $this->insert_label($field['data']['label_text'],$f_data['name']).form_input($f_data).$btn_code;
			break;

			case 'text':
                //$file_name = substr($f_data['value'], strripos($f_data['value'], '/') + 1); 
                return site_url($f_data['value']);
			break;
		}
    }    

	function textarea($field, $return_type)
	{
		$f_data = array(
              'name'        => $field['name'],
              'id'          => $field['name'],
			  'value'       => $this->set_item_value($field),
              'style'       => $field['data']['css'],
              );

		switch ($return_type)
		{
			case 'item':
				$a = $field['data']['label_text'] == '' ?  form_textarea($f_data):
					   							         	 $this->insert_label($field['data']['label_text'],$f_data['name']).form_textarea($f_data);

				$this->load->library('lib_editor');

				return $a.$this->lib_editor->init(array($field['name']));
			break;

			case 'text':
				return $field['data']['label_text'].' '.$f_data['value'];
			break;
		}
	}

	/**
	 * Create dropdown list
	 *
	 * @access public
	 * @return mixed
	 */
	function dropdown($field, $return_type)
	{

		$options = $field['data']['values'];

		$selected = $this->set_item_value($field);

			switch ($return_type)
			{
				case 'item':
					return $field['data']['label_text'] == '' ?  form_dropdown($field['name'], $options,$selected):
																 $this->insert_label($field['data']['label_text'],$field['name']).form_dropdown($field['name'], $options,$selected);
				break;

				case 'text':
					if ($selected == NULL) $selected = 0;
					return $field['data']['label_text'].' '.$field['data']['values'][$selected];
				break;
			}
	}

	/**
	 * Set value form item default or defined in xfields_sets table
	 *
	 * @access public
	 * @return string
	 */
	function set_item_value($field)
	{
		if ($this->page_id == 0)
		{
			$value = $field['data']['default_value'];
		}else{
			$value = $field['field_data'];
				if ($value == FALSE OR $value == '')
					$value = $field['data']['default_value'];
		}

		return $value;
	}


	/*******************************************************
     * INSTALL
     *
     * TODO: import tables;
	 *******************************************************/
	function _install()
    {

        if( $this->dx_auth->is_admin() == FALSE) exit;

        $this->load->dbforge();

        $fields = array(
            'id' => array(
                         'type' => 'INT',
                         'constraint' => 11,
                         'auto_increment' => TRUE,
                     ),
            'type' => array(
                         'type' => 'VARCHAR',
                         'constraint' => 25,
                     ),
            'name' => array(
                         'type' => 'VARCHAR',
                         'constraint' => 50,
                     ),
            'data' => array(
                         'type' => 'TEXT',
                     ),
            'add_data' => array(
                         'type' => 'TEXT',
                     ),
            'position' => array(
                         'type' => 'SMALLINT',
                         'constraint' => 5,
                     ),
            'group_id' => array(
                         'type' => 'INT',
                         'constraint' => 11,
                     ),
                 );
        
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field($fields);
        $this->dbforge->create_table('xfields', TRUE);

        // xfields_groups table 
        $fields = array(
            'id' => array(
                         'type' => 'INT',
                         'constraint' => 11,
                         'auto_increment' => TRUE,
                     ),
            'name' => array(
                         'type' => 'VARCHAR',
                         'constraint' => 100,
                     ),
            'title' => array(
                         'type' => 'VARCHAR',
                         'constraint' => 100,
                     ),
            );
        
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field($fields);
        $this->dbforge->create_table('xfields_groups', TRUE);

        // xfields_sets table


        $sql = "
            CREATE TABLE IF NOT EXISTS `xfields_sets` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `page_id` bigint(11) DEFAULT NULL,
              `field_id` int(11) DEFAULT NULL,
              `field_data` text,
              PRIMARY KEY (`id`)
          ) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;";


        $fields = array(
            'id' => array(
                         'type' => 'INT',
                         'constraint' => 11,
                         'auto_increment' => TRUE,
                     ),
            'page_id' => array(
                         'type' => 'BIGINT',
                         'constraint' => 11,
                     ),
            'field_id' => array(
                         'type' => 'INT',
                         'constraint' => 11,
                     ),
            'field_data' => array(
                         'type' => 'text',
                     ),
            );
        
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field($fields);
        $this->dbforge->create_table('xfields_sets', TRUE);
	}

	/**
	 * Delete xfields table
	 */
	function _deinstall()
    {
    	if( $this->dx_auth->is_admin() == FALSE) exit;
        
        $this->load->dbforge();
		$this->dbforge->drop_table('xfields');
		$this->dbforge->drop_table('xfields_sets');
		$this->dbforge->drop_table('xfields_groups');
	}

}

/* End of file tags.php */
