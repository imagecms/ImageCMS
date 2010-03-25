<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Image CMS
 *
 * Filter Module
 */

class Filter extends Controller {

	public function __construct()
	{
		parent::Controller();
	}

	// Index function
	public function index()
	{
        var_dump($this->search_items($_POST));
	}

    // Поиск ID страниц или категорий в таблице `content_fields_data`
    // $fields - Массив field_name => value
    // $type - Возможные значения: page, category
    public function _search_items($fields, $type = 'page')
    {
        $fields = array();
        $select = array();
        $from   = array();
        $where  = array();
        $strict = array();
        $ids    = array();
       
        // Оставим поля, которые имеют префикс field_
        foreach ($_POST as $key => $val)
        {
            if ($val != '' AND substr($key, 0, 6) == 'field_')
            {
                $fields[] = $key;
            }
        }

        if (count($fields) == 0)
            return FALSE;
            
        // В поиске будут участвовать, только поля, которые присутствуют в БД. 
        $this->db->select('field_name, type');
        $this->db->where_in('field_name', (array)$fields);
        $query = $this->db->get('content_fields');

        if ($query->num_rows() == 0)
            return FALSE;
        else
            $query = $query->result_array();

 
        $n = 0;
        foreach ($query as $key => $field)
        {
            $name = $field['field_name'];
            
            $select[] = "t_$name.item_id as $name"."_item_id";
            $from[]   = "`content_fields_data` t_$name";

            if ($query[$n+1]['field_name'])
            {
                $strict[]    = "t_$name.item_id = t_".$query[$n+1]['field_name'].".item_id";
                $strict[]    = "t_$name.item_type = '".$type."'";
            }


            if (in_array($field['type'], array('select','checkgroup','radiogroup')))
            {
                $where[] = "(t_$name.field_name='$name' AND t_$name.data IN (".$this->implode($_POST[$name])."))";
            }
            elseif(in_array($field['type'], array('text','textarea')))
            {
                $where[] = "(t_$name.field_name='$name' AND t_$name.data LIKE '%".$this->db->escape_str($_POST[$name])."%')";
            }
            elseif(in_array($field['type'], array('checkbox')))
            {
                $where[] = "(t_$name.field_name='$name' AND t_$name.data = '".$this->db->escape_str($_POST[$name])."')";
            }

            $n++;
        } 

        // Если есть условия для поиска,
        // составим запрос.
        if (count($where) > 0)
        {
            $sql  = "SELECT \n".implode(",",$select)."\n";
            $sql .= "FROM \n".implode(",", $from)."\n";
            $sql .= "WHERE \n".implode("\nAND\n", $where)."\n";

            if (count($strict) > 0)
                $sql .= "AND \n".implode(" \nAND\n ", $strict)."\n";


            $query = $this->db->query($sql);

            if ($query->num_rows() > 0)
            {
                foreach ($query->result_array() as $key => $val)
                {
                    $ids = array_merge($ids, array_values($val));
                }

                $ids = array_values(array_unique($ids));
            }

            return $ids; 
        } 
        else
        {
            return FALSE;
        }
    }

    private function implode($array = array())
    {
        for ($i=0; $i<count($array); $i++)
        {
            $array[$i] = '"'.$this->db->escape_str($array[$i]).'"';
        }

       $str = implode(', ', (array) $array);
       return $str;
    }

    // Создание формы с полей группы модуля cfcm.
    public function create_group_form($group_id)
    {
        $this->load->module('forms');
        $group = $this->db->get_where('content_field_groups', array('id' => $group_id))->row();
 
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

            $form = $this->forms->add_fields($form_fields);

            // set form attrs from session data

            $this->template->add_array(array(
                'form' => $form,
            ));
        
            return $form;
        }
        else
        {
            echo 'В группе нет полей';
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

/* End of file filter.php */
