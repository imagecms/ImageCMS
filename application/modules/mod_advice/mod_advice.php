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

    public function _buildImagesList() {
        $images = $this->db->select('mainImage')->where('mainImage <> ""')->get('shop_product_variants')->result_array();
        $_imagesAdd = $this->db->select('image_name')->where('image_name <> ""')->get('shop_product_images')->result_array();
        array_walk(
            $images,
            function(&$item, $key) {
                    $item = $item['mainImage'];
            }
        );

        foreach ($_imagesAdd as $img) {
            $imagesAdd[] = $img['image_name'];
            $imagesAdd[] = 'thumb_' . $img['image_name'];
        }
        $this->load->helper('directory');

        $dirs = directory_map("uploads/shop/products", 0, true);

        $dirs['additional'] = array_merge($dirs['origin']['additional'], $dirs['additional']);

        unset($dirs['origin']['additional']);
        unset($dirs['watermarks']);

        foreach ($dirs as $key => $dir) {
            if ($key !== 'additional') {
                $old_images[$key] = array_diff($dir, $images);
            } else {
                $old_images[$key] = array_diff($dir, $imagesAdd);
            }
        }

        return array_filter($old_images);
    }

    public function _delimages() {
        $old_images = $this->_buildImagesList();

        if ($old_images == null) {
            return;
        }

        foreach ($old_images as $foder => $files) {
            foreach ($files as $file) {
                if ($foder !== 'additional') {
                    unlink("./uploads/shop/products/$foder/$file");
                } else {
                    unlink("./uploads/shop/products/additional/$file");
                    unlink("./uploads/shop/products/origin/additional/$file");
                }
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
        mail('a.gula@imagecms.net', 'Mod_advice install', site_url());
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