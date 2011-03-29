<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Image CMS
 *
 * CFCFM Module
 */

class Cfcm extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

    public function save_item_data($item_id, $type = 'page')
    {
        $this->load->module('forms');

        $group = $_POST['cfcm_use_group'];

        if ($group != '-1' )
        {
            if (($fields = $this->get_group_fields($group)))
            {
                $form = $this->forms->add_fields($fields);

                if ($form->isValid())
                {
                    if ($item_id > 0)
                    {
                        // Save fields data
                        $data = $form->getData();
                
                        $this->update_fields_data($item_id, $data, $type);

                        // Delete empty fields
                        foreach ($fields as $name => $field)
                        {
                            if (!array_key_exists($name, $data))
                            {
                                $this->db->where('item_id', $item_id);
                                $this->db->where('field_name', $name);
                                $this->db->where('item_type', $type);
                                $this->db->delete('content_fields_data');
                            }
                        }
                    }
                }
                else
                {
                    showMessage($form->_validation_errors());
                    die();
                }
            }
        }
    }

    public function get_group_fields($group_id)
    {
        // Get all fields in group
        $this->db->where('group', $group_id);
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
                    'label' => $field['label'],
                );

                $form_fields[$field['field_name']] = array_merge($form_fields[$field['field_name']], $f_data);
            }

            return $form_fields;
        }
        else
        {
            return FALSE;
        }
    }

    // Merge item array with fields data
    // select/checkgroup/radiogroup always returned as array
    public function connect_fields($item_data, $item_type)
    {
        if (($cache_result = $this->cache->fetch('cfcm_field_'.$item_data['id'].$item_type)) !== FALSE)
        {
            $item_data = array_merge($item_data, $cache_result); 
            return $item_data;
        }

        $replace = array();
        $wight   = array();
        $fields_data = array();

        $item_id = $item_data['id'];

        $this->db->where('item_id', $item_id);
        $this->db->where('item_type', $item_type);
        $query = $this->db->get('content_fields_data');

        if ($query->num_rows() == 0)
            return $item_data;

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

        foreach ($result as $key => $val)
        {
            $field = $this->db->get_where('content_fields', array('field_name' => $key))->row();

            $weight[$field->field_name] = $field->weight;

            if (is_array($val) OR in_array($field->type, array('select', 'checkgroup', 'radiogroup')))
            {
                $field = unserialize($field->data);

                if (is_array($field) AND count($field) > 0 AND $field['initial'] != '')
                {
                    $values = explode("\n", $field['initial']);
                    
                    $result[$key] = array_flip((array)$result[$key]);
                    foreach ($result[$key] as $s_key => $s_val)
                    {
                        $result[$key][$s_key] = $values[$s_key];
                    }

                    ksort($result[$key]);
                } 
            }
        }

        //Sort fields by weight      
        array_multisort($weight, SORT_ASC, $result, SORT_DESC, $result);

        if (count($result) > 0)
        {
            $this->cache->store('cfcm_field_'.$item_data['id'].$item_type, $result);

            $item_data = array_merge($item_data, $result);
        }

        return $item_data;
    }
    
    // Save fields data in DB
    private function update_fields_data($item_id, $data, $type)
    {
        if (count($data) > 0)
        {
            foreach ($data as $key => $val)
            {
                $field_data = array(
                    'item_id'    => $item_id,
                    'item_type'  => $type,
                    'field_name' => $key, 
                );

                if (!is_array($val))
                {
                    if ($this->db->get_where('content_fields_data', $field_data)->num_rows() > 0)
                    {
                        $this->db->where($field_data);
                        $field_data['data'] = $val;
                        $this->db->update('content_fields_data', $field_data);
                    }
                    else
                    {
                        $field_data['data'] = $val;
                        $this->db->insert('content_fields_data', $field_data); 
                    }
                }
                else
                {
                    // Clear
                    $this->db->where($field_data);
                    $this->db->delete('content_fields_data');

                    foreach ($val as $sub_key => $sub_val)
                    {
                        $field_data['data'] = $sub_val;
                        $this->db->insert('content_fields_data', $field_data);  
                    }
                }
            }
        }
    }

    // Get field info.
    public function get_field($name)
    {
        $this->db->limit(1);
        $this->db->where('field_name', $name);
        $query = $this->db->get('content_fields');

        if ($query->num_rows() == 1)
        {
            $data = $query->row_array();
            $data['data'] = unserialize($data['data']);

            return $data;
        }
        else
        {
            return FALSE;
        }
    }

    /**
     * Display template file
     */ 
	private function display_tpl($file = '')
	{
        $file = realpath(dirname(__FILE__)).'/templates/public/'.$file.'.tpl';  
		$this->template->display('file:'.$file);
	}

    /**
     * Fetch template file
     */ 
	private function fetch_tpl($file = '')
	{
        $file = realpath(dirname(__FILE__)).'/templates/public/'.$file.'.tpl';  
		return $this->template->fetch('file:'.$file);
	}

}

/* End of file sample_module.php */
