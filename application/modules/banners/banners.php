<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class for Banners module
 * @uses MY_Controller
 * @author L.Andriy <l.andriy@siteimage.com.ua>
 * @copyright (c) 2013, ImageCMS
 * @package ImageCMSModule
 * @property Banner_model $banner_model
 */
class Banners extends MY_Controller {

    public $no_install = true;

    public function __construct() {
        parent::__construct();
        if (count($this->db->where('name', 'banners')->get('components')->result_array()) == 0)
            $this->no_install = false;
        $this->load->module('core');
        $this->load->model('banner_model');
        $lang = new MY_Lang();
        $lang->load('banners');
    }

    public function index() {
        if ($this->no_install === false)
            return false;
    }

    /**
     * Render banner into template
     * @access public
     * @param int $id is id entity (brand, category, product, page) .... for main id = 0
     * @param string $group
     * @return boolean
     * @author L.Andriy <l.andriy@siteimage.com.ua>
     * @copyright (c) 2013, ImageCMS
     */
    public function render($id = 0, $group = 0) {
        if ($this->no_install === false) {
            return false;
        }
        $type = $this->core->core_data['data_type'];
        $lang = $this->get_main_lang('identif');
        $painting = $type . '_' . (int) $id;

        $hash = 'baners' . $type . $id . \CI_Controller::get_instance()->config->item('template');
        if ($cache = Cache_html::get_html($hash)) {
            \CMSFactory\assetManager::create()
                    ->registerScript('jquery.cycle.all.min');
            echo $cache;
        } else {
            $banners = $this->banner_model->get_all_banner($lang, $group);
            foreach ($banners as $banner) {
                $data = unserialize($banner['where_show']);

                if ((in_array($painting, $data) || in_array($type . '_0', $data)) && $banner['active'] && (time() < $banner['active_to'] or $banner['active_to'] == '-1')) {
                    $ban[] = $banner;
                }
            }
            if (count($ban) > 0) {

                $tpl = $this->banner_model->get_settings_tpl() ? $type . '_slider' : 'slider';

                ob_start();
                \CMSFactory\assetManager::create()
                        ->registerStyle('style')
                        ->registerScript('jquery.cycle.all.min')
                        ->setData(array('banners' => $ban))
                        ->render($tpl, TRUE);

                $baners_view = ob_get_clean();

                Cache_html::set_html($baners_view, $hash);

                echo $baners_view;
            } else {
                return FALSE;
            }
        }
    }

    public function getByGroup($group) {
        $banners = $this->banner_model->get_all_banner(MY_Controller::getCurrentLocale(), $group);
        return $banners;
    }

    /**
     * install module and create table
     * @access public
     * @author L.Andriy <l.andriy@siteimage.com.ua>
     * @copyright (c) 2013, ImageCMS
     */
    public function _install() {


        $sql = "CREATE TABLE IF NOT EXISTS `mod_banner` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `active` tinyint(4) NOT NULL,
          `active_to` int(11) DEFAULT NULL,
          `where_show` text CHARACTER SET utf8,
          `position` int(11) DEFAULT NULL,
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

        $this->db->query($sql);

        $sql = "CREATE TABLE IF NOT EXISTS `mod_banner_i18n` (
          `id` int(11) NOT NULL,
          `url` text CHARACTER SET utf8,
          `locale` varchar(5) CHARACTER SET utf8 NOT NULL,
          `name` varchar(25) CHARACTER SET utf8 DEFAULT NULL,
          `description` text CHARACTER SET utf8,
          `photo` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
          KEY `id` (`id`,`locale`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

        $this->db->query($sql);


        $this->db->where('name', 'banners');
        $this->db->update('components', array('enabled' => 1));
        $this->banner_model->createGroupsTable();
    }

    /**
     * deinstall module and drop tables
     * @access public
     * @author L.Andriy <l.andriy@siteimage.com.ua>
     * @copyright (c) 2013, ImageCMS
     */
    public function _deinstall() {

        if ($this->dx_auth->is_admin() == FALSE) {
            exit;
        }

        $this->load->dbforge();
        $this->dbforge->drop_table('mod_banner');
        $this->dbforge->drop_table('mod_banner_i18n');
    }

    /**
     * check current language
     * @access public
     * @author L.Andriy <l.andriy@siteimage.com.ua>
     * @copyright (c) 2013, ImageCMS
     */
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
        if ($flag == 'id') {
            return $lang_id;
        }
        if ($flag == 'identif') {
            return $lang_ident;
        }
        if ($flag == null) {
            return array('id' => $lang_id, 'identif' => $lang_ident);
        }
    }

    public static function addMenu() {
//        return array(
//            1 =>
//            array(
//                'identifier' => 'banners',
//                'text' => lang("Banners management", "banners"),
//                'link' => '/admin/components/cp/banners',
//                'subMenu' =>
//                array(
//                    array(
//                        'identifier' => 'banners_man',
//                        'text' => lang("Banners management", "banners"),
//                        'link' => '/admin/components/cp/banners',
//                        'class' => '',
//                        'id' => '',
//                        'pjax' => '',
//                        'icon' => '',
//                        'divider' => false,
//                    ),
//                    array(
//                        'identifier' => 'create_banner',
//                        'text' => lang("Create a banner", "banners"),
//                        'link' => '/admin/components/init_window/banners/create',
//                        'class' => '',
//                        'id' => '',
//                        'pjax' => '',
//                        'icon' => '',
//                        'divider' => false,
//                    ),
//                ),
//            )
//        );
    }

}

/* End of file banners.php */
