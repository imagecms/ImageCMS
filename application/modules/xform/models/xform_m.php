<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Xform_m extends CI_Model {

	function Base()
	{
		parent::__construct();
    }

    function get_all_form() 
	{
		return $this->db->get('xform')->result_array();
	}
	
	function get_all_field($id)
	{
		return $this->db->where('fid',$id)->order_by('position','asc')->get('xform_field')->result_array();
	}
	
	function get_field($id,$type='id')
	{
		if($type=='id') {
			return $this->db->where('id',$id)->get('xform_field')->row_array();
		} else {
			return $this->db->where('name',$id)->get('xform_field')->row_array();
		}
	}
	
	function get_label($name)
	{
		$label = $this->db->select('label')->where('name',$name)->get('xform_field')->row_array();
		return $label['label'];
	}
	
	function get_form($id)
	{
		return $this->db->where('id',$id)->get('xform')->row_array();
	}
	
	function get_form_name($id)
	{
		$q = $this->db->select('title')->where('id',$id)->get('xform')->row_array();
		return $q['title'];
	}
	
	function get_form_id($url)
	{
		$id = $this->db->select('id')->where('url',$url)->get('xform')->row_array();
		return $id['id'];
	}
	

}

/* End of file gallery_m.php */
