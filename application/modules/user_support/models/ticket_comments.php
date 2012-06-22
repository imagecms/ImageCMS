<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Ticket_comments extends CI_Model {

    public $table = 'support_comments';

	function Ticket_comments()
	{
		parent::__construct();
    }

    function create($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    function get($ticket_id)
    {
        $this->db->where('ticket_id', $ticket_id);
        $this->db->order_by('date', 'asc');
        return $this->db->get($this->table);
    }

    function delete($id)
    {
        $this->db->limit(1);
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }

    function delete_ticket_comments($id)
    {
        $this->db->where('ticket_id', $id);
        return $this->db->delete($this->table);
    }

}

/* End of tickets.php */
