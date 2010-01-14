<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Fields extends Model{

	function Fields()
	{
		parent::Model();
	}

    /**
     * TODO: cache
     */
	function get_page_fields($page_id)
	{ 
        $this->db->select('xfields.*', FALSE);
		$this->db->select('xfields_sets.field_data AS field_data', FALSE);
        $this->db->join('xfields_sets', 'xfields_sets.field_id = xfields.id');
        $this->db->order_by('xfields.position', 'asc'); 
		$this->db->where('xfields_sets.page_id', $page_id);

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
        }
        else
        {
			return FALSE;
		}
	}
}

/* end of fields.php */
