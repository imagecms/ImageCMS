<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Image CMS
 *
 * User support module
 *
 */
class Banners extends MY_Controller {

    public $no_install = true;

    public function __construct() {
        parent::__construct();
        if (count($this->db->where('name', 'banners')->get('components')->result_array()) == 0)
            $this->no_install = false;
        $this->load->module('core');
        $this->load->model('banner_model');
    }

    public function index() {
        if ($this->no_install === false)
            return false;
    }

    public function render($id = 0) {
        /* $id - це ід сущности, тобто iд бренду, категорії, товару, сторінки .... для головної ід = 0 */
        if ($this->no_install === false)
            return false;

        $type = $this->core->core_data['data_type'];
        $lang = $this->get_main_lang('identif');
        $painting = $type . '_' . $id;
        $banners = $this->banner_model->get_all_banner($lang);
        foreach ($banners as $banner) {
            $data = unserialize($banner['where_show']);
            if (in_array($painting, $data) && $banner['active'] && time() < $banner['active_to'])
                $ban[] = $banner;
        }

        if (count($ban) > 0) {


            /*
             * $tpl = $type . '_slider'; // если нужно для различных страниц - разные тпл - раскомментировать, строка 54 закомментировать.
             * Для этого нужно будет в папке assets создать соответствующие тпл (product_slider, brand_slider, main_slider, 
             *  page_slider, category_slider, shop_category_slider)
             */
            $tpl = 'slider'; // по дефолту

            \CMSFactory\assetManager::create()
                    ->registerStyle('style')
                    ->registerScript('main')
                    ->registerScript('cycle')
                    ->setData(array('banners' => $ban))
                    ->render($tpl, TRUE);
        }
        else
            return fales;
    }

    public function _install() {

        $sql = "CREATE TABLE IF NOT EXISTS `mod_banner` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `url` text CHARACTER SET utf8,
          `active` tinyint(4) NOT NULL,
          `active_to` int(11) DEFAULT NULL,
          `where_show` text CHARACTER SET utf8,
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

        $this->db->query($sql);

        $sql = "CREATE TABLE IF NOT EXISTS `mod_banner_i18n` (
          `id` int(11) NOT NULL,
          `locale` varchar(5) CHARACTER SET utf8 NOT NULL,
          `name` varchar(25) CHARACTER SET utf8 DEFAULT NULL,
          `description` text CHARACTER SET utf8,
          `photo` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
          KEY `id` (`id`,`locale`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

        $this->db->query($sql);


        $this->db->where('name', 'banners');
        $this->db->update('components', array('enabled' => 1));
    }

    public function _deinstall() {
        if ($this->dx_auth->is_admin() == FALSE)
            exit;

        $this->load->dbforge();
        $this->dbforge->drop_table('mod_banner');
        $this->dbforge->drop_table('mod_banner_i18n');
    }

    public function get_main_lang($flag = null) {
        $lang = $this->db->get('languages')->result_array();
        $lan_array = array();
        foreach ($lang as $l) {
            $lan_array[$l['identif']] = $l['id'];
            $lan_array_rev[$l['id']] = $l['identif'];
        }

        $lang_uri = $this->uri->segment(1);
        if (in_array($lang_uri, $lan_array_rev)) {
            $lang_id = $lan_array[$lang_uri];
            $lang_ident = $lang_uri;
        } else {
            $lang = $this->db->where('default', 1)->get('languages')->result_array();
            $lang_id = $lang[0]['id'];
            $lang_ident = $lang[0]['identif'];
        }
        if ($flag == 'id')
            return $lang_id;
        if ($flag == 'identif')
            return $lang_ident;
        if ($flag == null)
            return array('id' => $lang_id, 'identif' => $lang_ident);
    }

}

/* End of file user_support.php */
