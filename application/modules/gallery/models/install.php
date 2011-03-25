<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Image CMS
 *
 * Gallery main model
 */

class Install extends CI_Model {

	function Install()
	{
		parent::__construct();
    }

    function make_install()
    {
        // Enable url access and install default settings

        $params = array(
            'max_file_size'       => 5,
            'max_width'           => 0,
            'max_height'          => 0,
            'quality'             => 95,
            'maintain_ratio'      => TRUE,
            'maintain_ratio_prev' => TRUE,
            'maintain_ratio_icon' => TRUE,
            'prev_img_width'      => 500,
            'prev_img_height'     => 500,
            'thumb_width'         => 100,
            'thumb_height'        => 100,
            'watermark_text'      => '',
            'wm_vrt_alignment'    => 'bottom',
            'wm_hor_alignment'    => 'right',
            'watermark_font_size' => '14',
            'watermark_color'     => 'ffffff',
            'watermark_padding'   => '-5',
            'watermark_font_path' => './system/fonts/1.ttf',
            'order_by'            => 'date',
            'sort_order'          => 'desc',
            'watermark_type'      => 'text',
            'watermark_image_opacity' => 50,
            );

        $this->db->where('name', 'gallery');
        $this->db->update('components', array('enabled' => 1, 'settings' => serialize($params)));

        $this->load->dbforge();

        /* Albums table */
        $fields = array(
            'id' => array(
                         'type' => 'INT',
                         'constraint' => 11,
                         'auto_increment' => TRUE,
                     ),
            'category_id' => array(
                         'type' => 'INT',
                         'constraint' => 11,
                     ),
            'name' => array(
                         'type' => 'VARCHAR',
                         'constraint' => 250,
                     ),
            'description' => array(
                         'type' => 'VARCHAR',
                         'constraint' => 500,
                     ),
            'cover_id' => array(
                         'type' => 'INT',
                         'constraint' => 11,
                         'default' => 0,
                     ),
            'position' => array(
                         'type' => 'INT',
                         'constraint' => 9,
                         'default' => 0,
                     ),
            'created' => array(
                         'type' => 'INT',
                         'constraint' => 11,
                     ),
            'updated' => array(
                         'type' => 'INT',
                         'constraint' => 11,
                     ),
                 );
        
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field($fields);
        $this->dbforge->create_table('gallery_albums', TRUE);

        /* Images table */
        $fields2 = array(
            'id' => array(
                         'type' => 'INT',
                         'constraint' => 11,
                         'auto_increment' => TRUE,
                     ),
            'album_id' => array(
                         'type' => 'INT',
                         'constraint' => 11,
                     ),
            'file_name' => array(
                         'type' => 'VARCHAR',
                         'constraint' => 150,
                     ),
            'file_ext' => array(
                         'type' => 'VARCHAR',
                         'constraint' => 8,
                     ),
            'file_size' => array(
                         'type' => 'VARCHAR',
                         'constraint' => 20,
                     ),
            'position' => array(
                         'type' => 'INT',
                         'constraint' => 9,
                     ),
            'width' => array(
                         'type' => 'INT',
                         'constraint' => 6,
                     ),
            'height' => array(
                         'type' => 'INT',
                         'constraint' => 6,
                     ),
            'description' => array(
                         'type' => 'VARCHAR',
                         'constraint' => 500,
                     ),
            'uploaded' => array(
                         'type' => 'INT',
                         'constraint' => 11,
                     ),
            'views' => array(
                         'type' => 'INT',
                         'constraint' => 11,
                     ),
                 );
        
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field($fields2);
        $this->dbforge->create_table('gallery_images', TRUE);

        /* Categories table */
        $category = array(
            'id' => array(
                         'type' => 'INT',
                         'constraint' => 11,
                         'auto_increment' => TRUE,
                     ),
            'name' => array(
                         'type' => 'VARCHAR',
                         'constraint' => 250,
                     ),
            'description' => array(
                         'type' => 'VARCHAR',
                         'constraint' => 500,
                     ),
            'cover_id' => array(
                         'type' => 'INT',
                         'constraint' => 11,
                         'default' => 0,
                     ),
            'position' => array(
                         'type' => 'INT',
                         'constraint' => 9,
                         'default' => 0,
                     ),
            'created' => array(
                         'type' => 'INT',
                         'constraint' => 11,
                     ),
                 );
        
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field($category);
        $this->dbforge->create_table('gallery_category', TRUE);

    }

    function deinstall()
    {
        $this->load->dbforge();
        $this->dbforge->drop_table('gallery_albums');
        $this->dbforge->drop_table('gallery_images');
        $this->dbforge->drop_table('gallery_category');
    } 

}

/* End of file install.php */
