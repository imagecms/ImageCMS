<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Image CMS
 *
 * Yandex Market main model
 */

class Install extends CI_Model {

    function Install()
	{
		parent::__construct();
        }

    function make_install()
    {
        // Create mod_yandex_market table

            $this->load->dbforge();
            $field['value'] = array(
                'type' => 'text',
            );
            $this->dbforge->add_field('id');
            $this->dbforge->add_field($field);
            $this->dbforge->create_table('mod_yandex_market'); 
            $this->db->set('value', '');
            $this->db->insert('mod_yandex_market'); 
            
        // Create mod_yandex_market_adalt table
            
            $field['value'] = array(
                'type' => 'text',
            );
            $this->dbforge->add_field('id');
            $this->dbforge->add_field($field);
            $this->dbforge->create_table('mod_yandex_market_adalt'); 
            $this->db->set('value', '');
            $this->db->insert('mod_yandex_market_adalt');             

    }

    function deinstall()
    {
        $this->load->dbforge();
        $this->dbforge->drop_table('mod_yandex_market');
        $this->dbforge->drop_table('mod_yandex_market_adalt');
    } 

}

/* End of file install.php */
