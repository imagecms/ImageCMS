<?php

/**
 * @property CI_DB_active_record $db
 * @property DX_Auth $dx_auth
 */
class Admin_menu_model extends CI_Model {

    /**
     * Related_products table name
     */
    const TABLE = 'admin_menu';

    function __construct() {
        parent::__construct();
    }
    
    public function getUserModulesNames($modules_ids){
        $modules = $this->db->where_in('id', $modules_ids)->get('saas_modules');
        return $modules ? $modules->result_array() : array();
    }


    /**
     * Install module data queries
     */
    public function install() {      
        $this->db->where('name', 'admin_menu')
                ->update('components', array('autoload' => '1', 'enabled' => '1'));
     
    }

    /**
     * Deinstall module data queries
     */
    public function deinstall() {        

        $this->db->where('name', 'admin_menu')
                ->delete('components');
    }

}

?>
