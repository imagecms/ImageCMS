<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Base extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	function get($item_id, $status = 0)
	{
        $this->db->where('item_id', $item_id);
        $this->db->where('status', $status);
        $this->db->order_by('date','asc');
		$query = $this->db->get('comments');

		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}

		return FALSE;
	}

    function get_one($id)
    {
        $this->db->limit(1);
        return $this->db->get_where('comments', array('id' => $id))->row_array();
    }

	function add($data)
	{
        $this->db->insert('comments',$data);

        return $this->db->insert_id();
    }

    function all($row_count, $offset)
    {
        $this->db->order_by('date', 'desc');

        if ($row_count > 0 AND $offset >= 0)
        {
            $query = $this->db->get('comments', $row_count, $offset);
        }else{
            $query = $this->db->get('comments');
        }

        if ($query->num_rows() > 0)
        {
            return $query->result_array();
        }else{
            return FALSE;
        }
    }

    function get_item_comments_status($item_id)
    {
        $this->db->select('id, comments_status');
        $this->db->where('id', $item_id);
        $query = $this->db->get('content', 1);

        if ($query->num_rows() == 1)
        {
            $status = $query->row_array();

            if ($status['comments_status'] == 1)
            {
                return TRUE;
            }
            else
            {
                return FALSE;
            }
        }
        else
        {
            return FALSE;
        }
    }

    function update($id, $data = array())
    {
        $this->db->where('id', $id);
        $this->db->update('comments', $data);

        return TRUE;
    }

    function delete($id)
    {
        $this->db->limit(1);
        $this->db->where('id', $id);
        $this->db->delete('comments');

        return TRUE;
    }

    function count_by_status($status = 0)
    {
        $this->db->where('status', $status);
        $this->db->from('comments');
        
        return $this->db->count_all_results();
    }

    function get_settings()
    {
        $this->db->where('name', 'comments');
        $query = $this->db->get('components')->row_array();

        return unserialize($query['settings']);
    }

    function save_settings($data)
    {
        $this->db->where('name', 'comments');
        $this->db->update('components', array('settings' => serialize($data)));
    }

}

/* End of base.php */
