<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Menu_model extends CI_Model{

	function Menu_model()
	{
		parent::__construct();
	}

    function delete_menu_item($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('menus_data');
    }

    function delete_menu($name)
    {
        $this->db->limit(1);
        $this->db->delete('menus',array('name' => $name));
    }

    function get_parent_items($id)
    {
        $this->db->where('parent_id', $id);
        $query = $this->db->get('menus_data');

        if ($query->num_rows > 0)
        {
            return $query->result_array();
        }else{
            return FALSE;
        }
    }

    function get_item($id)
    {
        return $this->db->get_where('menus_data',array('id' => $id))->row_array();
    }

    function update_item($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('menus_data',$data);

        return TRUE;
    }

    function insert_item($data = array())
    {
        if (is_array($data))
        {
            $this->db->insert('menus_data',$data);
        }
    }

    function get_menu($id)
    {
        $this->db->where('id',$id);
        $query = $this->db->get('menus');

        return $query->row_array();
    }

    function insert_menu($data)
    {
        if (is_array($data))
        {
            $this->db->insert('menus',$data);
        }
    }

    function set_item_position($item_id = FALSE, $pos = FALSE)
    {
        if ($item_id != FALSE AND $pos != FALSE)
        {
            $this->db->where('id',$item_id);
            $this->db->update('menus_data', array('position' => $pos ));

            return TRUE;
        }else{
            return FALSE;
        }
    }

    function get_item_position($id)
    {
        $this->db->select('position');
        $this->db->where('id', $id);
        $query = $this->db->get('menus_data',1);

        if ($query->num_rows() > 0)
        {
            return $query->row_array();
        }else{
            return FALSE;
        }
    }

    // Return url to page
    function get_page_url($page_id)
    {
        $this->db->select('url, cat_url');
        $this->db->where('id', $page_id);
        $query = $this->db->get('content',1);

        if ($query->num_rows() == 1)
        {
            return $query->row_array();
        }else{
            return FALSE;
        }
    }

    // Return link to module
    function get_module_link($name)
    {
        $this->db->select('identif');
        $this->db->where('name', $name);
        $query = $this->db->get('components', 1);

        if ($query->num_rows() == 1)
        {
            $data = $query->row_array();
           return $data['identif']; 
        }else{
            return FALSE;
        }
    }

}
/* End of Menu_model.php */
