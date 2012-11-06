<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Settings extends MY_Controller {

    function __construct() {
        parent::__construct();

        $this->load->library('DX_Auth');
        admin_or_redirect();

        $this->load->library('lib_admin');
        $this->load->library('lib_category');
        $this->lib_admin->init_settings();
    }

    function index() {
        
        $this->cms_admin->get_langs();
        cp_check_perm('cp_site_settings');

        $settings = $this->cms_admin->get_settings();

        $this->template->add_array($settings);
        $this->template->assign('templates', $this->_get_templates());
        $this->template->assign('template_selected', $settings['site_template']);

        #Tiny MCE themes in lib_editor
        $themes_arr = array(
            'simple' => 'Простая',
            'advanced' => 'Расширеная',
            'full' => 'Полная'
        );

        ($hook = get_hook('admin_set_editor_theme')) ? eval($hook) : NULL;

        $this->template->assign('editor_themes', $themes_arr);
        $this->template->assign('theme_selected', $settings['editor_theme']);

        $this->template->assign('work_values', array('yes' => 'Да', 'no' => 'Нет'));
        $this->template->assign('site_offline', $settings['site_offline']);


        $this->template->assign('tree', $this->lib_category->build());

        $this->template->assign('parent_id', $settings['main_page_cat']);
        $this->template->assign('id', 0);

        ($hook = get_hook('admin_show_settings_tpl')) ? eval($hook) : NULL;

        // Load modules list
        $this->template->assign('modules', $this->db->get('components')->result_array());

        $this->template->show('settings', FALSE);
    }

    /**
     * Main Page settings
     */
    function main_page() {
        $this->template->assign('tree', $this->lib_category->build());

        $settings = $this->cms_admin->get_settings();

        $this->template->add_array($settings);
        $this->template->assign('parent_id', $settings['main_page_cat']);
        $this->template->assign('id', 0);

        $this->template->show('settings_main_page', FALSE);
    }

    /**
     * Search templates in TEMPLATES_PATH folder
     *
     * @access private
     * @return array
     */
    function _get_templates() {
        $new_arr = array();

        if ($handle = opendir(TEMPLATES_PATH)) {
            while (false !== ($file = readdir($handle))) {
                if ($file != "." && $file != ".." && $file != 'administrator' && $file != 'modules' && !stristr($file, '_mobile')) {
                    if (!is_file(TEMPLATES_PATH . $file)) {
                        $new_arr[$file] = $file;
                    }
                }
            }
            closedir($handle);
        } else {
            return FALSE;
        }
        return $new_arr;
    }

    /**
     * Save site settings
     *
     * @access public
     */
    function save() {
        cp_check_perm('cp_site_settings');

        switch ($this->input->post('main_type')) {
            case 'category':
                $data = array(
                    'main_type' => 'category',
                    'main_page_cat' => $this->input->post('main_page_cat'),
                );

                $this->cms_admin->save_settings($data);
                break;

            case 'page':
                if ($this->cms_admin->page_exists($this->input->post('main_page_pid'))) {
                    $data = array(
                        'main_type' => 'page',
                        'main_page_id' => $this->input->post('main_page_pid')
                    );

                    $this->cms_admin->save_settings($data);
                } else {
                    showMessage(lang('ac_page_not_found'), false, 'r');
                    exit;
                }
                break;

            case 'module':
                $data = array(
                    'main_type' => 'module',
                    'main_page_module' => $this->input->post('main_page_module'),
                );
                $this->cms_admin->save_settings($data);
                break;
        }

        $data_m = array(
            'site_title' => $this->lib_admin->db_post('title'),
            'site_short_title' => $this->lib_admin->db_post('short_title'),
            'site_description' => $this->lib_admin->db_post('description'),
            'site_keywords' => $this->lib_admin->db_post('keywords'),
            'create_keywords' => $this->input->post('create_keywords'),
            'create_description' => $this->input->post('create_description'),
            'create_cat_keywords' => $this->input->post('create_cat_keywords'),
            'create_cat_description' => $this->input->post('create_cat_description'),
            'add_site_name' => $this->input->post('add_site_name'),
            'add_site_name_to_cat' => $this->input->post('add_site_name_to_cat'),
            'delimiter' => $this->input->post('delimiter'),
            'site_template' => $this->input->post('template'),
            'editor_theme' => $this->input->post('editor_theme'),
            'site_offline' => $this->input->post('site_offline'),
            'google_analytics_id' => $this->input->post('google_analytics_id'),
            'google_webmaster' => $this->input->post('google_webmaster'),
            'yandex_webmaster' => $this->input->post('yandex_webmaster'),
            'yandex_metric' => $this->input->post('yandex_metric'),
            'lang_sel' => $this->input->post('lang_sel'),
        );

        ($hook = get_hook('admin_save_settings')) ? eval($hook) : NULL;

        $this->cms_admin->save_settings($data_m);

        $this->cache->delete('main_site_settings');

        $this->lib_admin->log(lang('ac_changed_site_sett'));

        showMessage(lang('ac_sett_saved'));
        $action = $_POST['action'];
        if($action == 'edit'){
            pjax('/admin/settings');
        }else{
            pjax('/admin');
        }
        
    }
    
    public function switch_admin_lang($lang)
    {
        $langs = Array(
            'english',
            'russian'
        );
        
        if (in_array($lang, $langs) && $this->config->item('language') != $lang)
        {
            $this->db->set('lang_sel', $lang.'_lang')
                ->update('settings');
        }
        
        redirect($_SERVER['HTTP_REFERER']?$_SERVER['HTTP_REFERER']:'/admin/dashboard');
    }

    /**
     * Save main page settings
     *
     * @access public
     */
    function save_main() {
        
    }

}

/* End of settings.php */
