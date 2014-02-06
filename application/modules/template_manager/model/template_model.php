<?php

/**
 * 
 *
 * @author 
 */
class Template_model extends CI_Model {

    /**
     * 
     * @param int $handlerId
     * @param string $paramName
     * @param string $paramValue
     */
    public function setParam($handlerId, $paramName, $paramValue) {
        
    }

    /**
     * 
     * @param int $handlerId
     * @param string $key
     */
    public function getParams($handlerId, $key = NULL) {
        
    }

    public function install() {
        ($this->dx_auth->is_admin()) OR exit;
        $this->load->dbforge();

        $fields = array(
            'id' => array(
                'type' => 'INT',
                'auto_increment' => TRUE
            ),
            'handler_id' => array(
                'type' => 'int',
                'constraint' => '5',
                'null' => FALSE,
            ),
            'key' => array(
                'type' => 'varchar',
                'constraint' => '15',
                'null' => FALSE,
            ),
            'value' => array(
                'type' => 'varchar',
                'constraint' => '300',
                'null' => FALSE,
            )
        );
        $this->dbforge->add_field($fields);
        $this->dbforge->create_table('mod_template_manager');
    }

}

?>
