<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tickets extends CI_Model {

    public $table = 'support_tickets';

	function Tickets()
	{
		parent::__construct();
    }

    function create($data)
    {
        $this->db->insert($this->table, $data);
        $id = $this->db->insert_id();

        return $id;
    }

    function update($id, $data)
    {
        $this->db->where('id', (int)$id);
        return $this->db->update($this->table, $data);
    }

    function close($id)
    {
        $data = array(
            'status' => 1
            );

        $this->db->where('id', (int)$id);
        return $this->db->update($this->table, $data);
    }

    function get($id, $where = array())
    {
        $this->db->where('id', (int)$id);

        if (is_array($where) AND count($where) > 0)
        {
            foreach ($where as $k => $v)
            {
                $this->db->where($k, $v);
            }
        }

        return $this->db->get($this->table, 1);
    }

    function get_all($where = array(), $row_count = 0, $offset = 0)
    {
        if (is_array($where) AND count($where) > 0)
        {
            foreach ($where as $k => $v)
            {
                $this->db->where($k, $v);
            }
        }

        $this->db->order_by('date', 'desc');
        return $this->db->get($this->table, $row_count, $offset);
    }


    function user_tickets($user_id, $where = array() )
    {
        $this->db->where('user_id', (int)$user_id);

        if (is_array($where) AND count($where) > 0)
        {
            foreach ($where as $k => $v)
            {
                $this->db->where($k, $v);
            }
        }

        $this->db->order_by('date', 'desc');
        return $this->db->get($this->table);
    }

    function all_my_tickets($user_id, $row_count = 0, $offset = 0)
    {
        $this->db->where('user_id', (int)$user_id);

        if (is_array($where) AND count($where) > 0)
        {
            foreach ($where as $k => $v)
            {
                $this->db->where($k, $v);
            }
        }

        $this->db->order_by('date', 'desc');
        return $this->db->get($this->table, $row_count, $offset); 
    }

    function change_update_date($id, $time)
    {
        $this->db->where('id', $id);
        $this->db->update($this->table, array('updated' => $time));
    }

    function set_last_comment_author($id, $author)
    {
        $this->db->where('id', $id);
        $this->db->update($this->table, array('last_comment_author' => $author));
    }


    function delete($id)
    {
        $this->db->limit(1);
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }


}

/* End of tickets.php */
