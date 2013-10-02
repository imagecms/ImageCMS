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
     * Chech has other page url
     * @param string $url
     * @return boolean
     */
    public function checkUrl($url = ''){
        if($url != ''){
            /** Select page by url **/
            $res = $this->db->where('url',$url)->get('content')->row_array();
            if ($res != null){
                /** If has other page url **/
                return true;
            }else{
                /** If not has other page url **/
                return false;
            }
        }else{
            return false;
        }
    }
    
    /**
     * Insert data to database
     * @param array $data
     * @return boolean
     */
    public function createNewPage($data = false){
        if ($data != false){
            $this->db->insert('content', $data);
            if ($this->db->last_query()){
                return true;
            }else{
                return false;
            }
                
        }
        return false;
    }






    /*****************************************************/
    
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
        
        /** If are resuts the return array with categories else return false**/
        if(!$result){
            return false;
        }else{
            return $result;
        }
    }
}

?>
