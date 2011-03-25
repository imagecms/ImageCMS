<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Departments extends CI_Model {

    public $table = 'support_departments';

	function Departments()
	{
		parent::__construct();
    }

    function get_all()
    {
        $this->db->order_by('name', 'asc');
        return $this->db->get($this->table)->result_array();
    }

    function get($id)
    {
        $this->db->where('id', $id);
        return $this->db->get($this->table, 1)->row_array();
    }

}

/* End of tickets.php */
