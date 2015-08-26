<?php

class Found_less_expensive_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    /**
     * Get 
     * @param int $row_count
     * @param int $offset
     * @param int $status
     * @return array
     */
    function allByStatus($row_count, $offset, $status) {
        $this->db->order_by('date', 'desc');
        if ($row_count > 0 AND $offset >= 0) {
            $query = $this->db->where_in('status', $status)->get('mod_found_less_expensive',$row_count, $offset)->result_array();
        } else {
            $query = $this->db->where_in('status', $status)->get('mod_found_less_expensive')->result_array();
        }

        return $query;
    }
    /**
     * Get count of all messages about found less expensive
     * @param type $status
     * @return type
     */
    public function getCountAll($status){
        $res = $this->db->where_in('status',$status)->get('mod_found_less_expensive')->result_array();
        return count($res);
    }
    /**
     * Delete 
     * @param type $id
     * @return boolean
     */
    public function deleteByIds($id){
        $this->db->delete('mytable', array('id' => $id)); 
        return true;
    }
    /**
     * Get module settings
     * @return type
     */
    public function getModuleSettings (){
    $data = $this->db->select('settings')->where('name','found_less_expensive')->get('components')->row_array();
    $data = unserialize($data['settings']);
    return $data;    
    }
}
?>
