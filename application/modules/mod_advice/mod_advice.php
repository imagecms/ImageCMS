<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Module Frame
 */
class Mod_advice extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('mod_advice');
    }

    public function index() {

    }

    public function autoload() {

    }

    public function buildImagesAdditionalList() {
        $images = $this->db->select('image_name')->get('shop_product_images')->result_array();
        array_walk(
            $images,
            function(&$item) {
                    $item = $item['image_name'];
            }
        );
        $this->load->helper('directory');

        $dir = directory_map('uploads/shop/products/origin/additional', 1);
        $old_additonall_images = array_diff($dir, $images);
        dump($old_additonall_images);
        return $old_additonall_images;
    }

    public function buildImagesList($folder = 'origin') {
        $images = $this->db->select('mainImage')->get('shop_product_variants')->result_array();
        array_walk(
            $images,
            function(&$item, $key) {
                    $item = $item['mainImage'];
            }
        );
        $this->load->helper('directory');

        $dir = directory_map("uploads/shop/products/$folder", 1, true);
        array_walk(
            $dir,
            function(&$item, $key) use($dir) {
                if ($item == 'additional') {

                    dump($dir[$key]);
                    unset($dir[$key]);
                }
            }
        );

        $old_images = array_diff($dir, $images);

        return $old_images;
    }

    public function delimages() {
        $old_images = $this->buildImagesList();

        foreach ($old_images as $file) {
            if ($file != 'additional') {
                unlink("./uploads/shop/products/origin/$file");
                unlink("./uploads/shop/products/main/$file");
                unlink("./uploads/shop/products/large/$file");
                unlink("./uploads/shop/products/small/$file");
                unlink("./uploads/shop/products/medium/$file");
            }
        }
    }

    public function delimagesadd() {
        $old_additonall_images = $this->buildImagesAdditionalList();

        foreach ($old_additonall_images as $file) {
            unlink("./uploads/shop/products/origin/additional/$file");
            unlink("./uploads/shop/products/additional/$file");
        }
    }

    public function _install() {
        /** We recomend to use http://ellislab.com/codeigniter/user-guide/database/forge.html */
        /**
          $this->load->dbforge();

          $fields = array(
          'id' => array('type' => 'INT', 'constraint' => 11, 'auto_increment' => TRUE,),
          'name' => array('type' => 'VARCHAR', 'constraint' => 50,),
          'value' => array('type' => 'VARCHAR', 'constraint' => 100,)
          );

          $this->dbforge->add_key('id', TRUE);
          $this->dbforge->add_field($fields);
          $this->dbforge->create_table('mod_empty', TRUE);
         */
        /**
          $this->db->where('name', 'mod_advice')
          ->update('components', array('autoload' => '1', 'enabled' => '1'));
         */
    }

    public function _deinstall() {
        /**
          $this->load->dbforge();
          $this->dbforge->drop_table('mod_empty');
         *
         */
    }

}

/* End of file sample_module.php */