<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Xfields_admin extends Model{

	function Xfields_admin()
	{
		parent::Model();
	}

	/**
	 * Insert new field
	 *
	 * @access public
	 */
	function insert_field( $item_data = array() )
	{
		$item_data['data'] = serialize($item_data['data']);
		$this->db->insert('xfields',$item_data);
	}

	function update_field( $item_data = array() , $id)
	{
		$item_data['data'] = serialize($item_data['data']);

		$this->db->limit(1);
		$this->db->where('id',$id);
		$this->db->update('xfields',$item_data);
	}

	function check_name($name)
	{
		$this->db->where('name',$name);

		if ( $this->db->get('xfields')->num_rows() == 0 )
		{
			return TRUE;
		}else{
			return FALSE;
		}

	}

	function delete_page_fields($page_id)
	{
		$this->db->where('page_id',$page_id);
		$this->db->delete('xfields_sets');
		return TRUE;
	}

	function get_field_name($field_id)
	{
		$this->db->where('id',$field_id);
		$query = $this->db->get('xfields',1)->row_array();

		return $query['name'];
	}

	function set_page_field($page_id,$field_id,$field_data)
	{
		$data = array(
					'page_id' => $page_id,
					'field_id' => $field_id,
					'field_data' => $field_data
					);

		$this->db->insert('xfields_sets',$data);
	}

	function get_all_fields()
    {
        $this->db->order_by('position', 'asc');
		$query = $this->db->get('xfields');

		if ($query->num_rows() > 0)
		{
			$fields = $query->result_array();

			$count = count($fields);
			for ($i = 0; $i < $count; $i++)
			{
				$fields[$i]['data'] = unserialize($fields[$i]['data']);
			}

			return $fields;
		}else{
			return FALSE;
		}
	}

	function get_field_value($page_id,$field_id)
	{
		$this->db->select('xfields_sets.field_data');
		$this->db->where('page_id',$page_id);
		$this->db->where('field_id',$field_id);
		$value =  $this->db->get('xfields_sets')->row_array();
		return $value['field_data'];
	}

	function delete_field($field_id, $delete_sets = TRUE)
	{
		$this->db->limit(1);
		$this->db->where('id',$field_id);
		$this->db->delete('xfields');

		if ($delete_sets == TRUE)
		{
			$this->db->where('field_id',$field_id);
			$this->db->delete('xfields_sets');
	  	}

		return TRUE;
	}

	function get_field($field_id)
	{
		$this->db->where('id',$field_id);
		$query = $this->db->get('xfields',1);

		if ($query->num_rows() > 0)
		{
			$field = $query->row_array();
			$field['data'] = unserialize($field['data']);

			return $field;
		}else{
			return FALSE;
		}
	}

}

/* end of xfields_admin.php */
