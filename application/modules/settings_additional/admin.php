<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS 
 * Product slider admin
 */
class Admin extends BaseAdminController {

    public function __construct() {
        parent::__construct();
    }

    public function change_sub_style() {
        $templ = $_POST['templ'];

        return json_encode($this->getstyle($templ));
    }

    public function getstyle($path) {
        $new_arr = array();

        if ($handle = opendir(TEMPLATES_PATH . $path . '/stylesets')) {
            while (false !== ($file = readdir($handle))) {
                if ($file != "." && $file != "..") {
                    if (!is_file(TEMPLATES_PATH . $file)) {
                        $new_arr[$path . '/stylesets/' . $file] = "$file";
                    }
                }
            }
            closedir($handle);
        }

        return $new_arr;
    }

    public function index() {

        if ($_POST) {

            $sett_templ = $_POST['templ'];
            $sett_templ_shop = "./templates/$sett_templ/shop";


            $sql = "update shop_settings set value = '$sett_templ_shop' where name = 'systemTemplatePath'";
            $this->db->query($sql);

            $sql = "update settings set site_template = '$sett_templ'";
            $this->db->query($sql);

            $sql = "update components set settings = '" . serialize($_POST) . "' where name = 'settings_additional'";
            $this->db->query($sql);
            showMessage('Даные сохранены');
        } else {

            $this->settings = $this->cms_base->get_settings();

            $path = $this->settings['site_template'];

            $settings = $this->db->where('name', 'settings_additional')->get('components')->result_array();
            $settings = unserialize($settings[0]['settings']);
            if (!$settings['templ']) {
                $templ = $this->db->get('settings')->result_array();
                $settings['templ'] = $templ[0]['site_template'];
            }

            //var_dump($this->db->get('settings')->result()->site_template);


            $new_arr = $this->getstyle($path);


            if ($handle = opendir(TEMPLATES_PATH)) {
                while (false !== ($file = readdir($handle))) {
                    if ($file != "." && $file != "..") {
                        if (!is_file(TEMPLATES_PATH . $file)) {
                            if (is_dir(TEMPLATES_PATH . $file . '/shop'))
                                $new_arr_2["./templates/$file/shop/"] = "$file";
                        }
                    }
                }
                closedir($handle);
            }
            \CMSFactory\assetManager::create()
                    ->registerScript('script')
                    ->setData(array('data' => $settings, 'subStyle' => $new_arr, 'templ' => $new_arr_2))
                    ->renderAdmin('settings');
        }
    }

    public function heder() {
        
        $templ = $this->cms_base->get_settings();
        $templ = $templ['site_template'];
        
        
        $text = file_get_contents("templates/$templ/widgets/heder.tpl");
        
        //var_dump($text);

        if ($_POST) {
            file_put_contents("templates/$templ/widgets/heder.tpl", $_POST['heder']);
            showMessage('Даные сохранены');
            
        } else {

            \CMSFactory\assetManager::create()->setData(array('text'=>$text))
                    ->renderAdmin('heder');
        }
    }
}