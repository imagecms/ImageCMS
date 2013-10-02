<?php

/**
 * @property CI_DB_active_record $db
 * @property DX_Auth $dx_auth
 */
class Documentation_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    /**
     * Get categories ids and names
     * @return boolean|array
     */
    public function getPagesCategories() {
        /** Get categories ids and names query**/
        $result = $this->db
                    ->select('id, name')
                    ->from('category')
                    ->get()
                    ->result_array();
        
        /** If are resuts the retuirn array with categories else return false**/
        if(!$result){
            return false;
        }else{
            return $result;
        }
    }
}

?>
