<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Languages extends BaseAdminController {

    function __construct() {
        parent::__construct();

        $this->load->library('DX_Auth');
        admin_or_redirect();

        $this->load->library('lib_admin');
        $this->load->library('form_validation');
        $this->lib_admin->init_settings();
    }

    function index() {
        $langs = $this->cms_admin->get_langs();
        $this->template->assign('langs', $langs);
        $this->template->show('languages', FALSE);
    }

    /**
     * return set of locales 
     * @return array - locales
     */
    function getLocales() {
        $langs_config = $this->config->item('locales');
        $langs = $langs_config;
        
        foreach ($langs as $key => $lang) {
            $locale = setlocale(LC_ALL, $lang . '.utf8', $lang . '.utf-8', $lang . '.UTF8', $lang . '.UTF-8', $lang . '.utf-8', $lang . '.UTF-8', $lang);
            if (!$locale) {
                unset($langs[$key]);
            }
        }
        if(!$lang){
            return $langs_config;
        }

        return $langs;
    }

    /**
     * Show lang_create form
     */
    function create_form() {
        //cp_check_perm('lang_create');

        $settings = $this->cms_admin->get_settings();
        $lang_folders = $this->_get_lang_folders();

        $this->template->assign('lang_folders', $lang_folders);
        $this->template->assign('templates', $this->_get_templates());
        $this->template->assign('template_selected', $settings['site_template']);

        $this->template->assign('locales', $this->getLocales());
        $this->template->assign('locale', '');
        $this->template->show('lang_create', FALSE);
    }

    /**
     * Insert new language
     */
    function insert() {
        //cp_check_perm('lang_create');

        $this->form_validation->set_rules('name', lang("Title", "admin"), 'trim|required|min_length[1]|max_length[100]');
        $this->form_validation->set_rules('identif', lang("Identifier", "admin"), 'trim|required|min_length[1]|max_length[100]|alpha_dash');
        $this->form_validation->set_rules('image', lang("Image", "admin"), 'max_length[250]');
        $this->form_validation->set_rules('locale', lang("Locale", "admin"), 'required|max_length[250]');
        $this->form_validation->set_rules('template', lang("Template", "admin"), 'required|max_length[250]');

        if ($this->form_validation->run($this) == FALSE) {
            showMessage(validation_errors(), '', 'r');
        } else {

            $data = array(
                'lang_name' => $this->input->post('name'),
                'identif' => $this->input->post('identif'),
                //'image' => $this->lib_admin->db_post('image'),
                'image' => $this->input->post('image'),
                'locale' => $this->input->post('locale'),
//                'folder' => $this->input->post('folder'),
                'template' => $this->input->post('template')
            );

            ($hook = get_hook('admin_language_create')) ? eval($hook) : NULL;

            $this->cms_admin->insert_lang($data);

            $this->lib_admin->log(lang("Create a language", "admin") . " " . $data['lang_name']);

            $this->cache->delete('main_site_langs');

            $this->createLanguageFolders($data['locale']);

            showMessage(lang("Language has been created", "admin"));

            pjax('/admin/languages/');
        }
    }

    /**
     * Create language folders for templates, front, and modules
     * @param string $lang - locale identifier: ru_RU, en_US, de_DC
     */
    function createLanguageFolders($lang) {
        $templates_dir = './templates';
        $main_dir = './application/language/main';
        $modules_dir = './application/modules';

        if (is_dir($templates_dir)) {
            $templates = scandir($templates_dir);
            foreach ($templates as $template) {
                if (is_dir($templates_dir . '/' . $template) && $template != "." && $template != '..' && $template[0] != '.') {
                    if (!is_dir($templates_dir . '/' . $template . '/language/' . $template . '/ ' . $lang)) {
                        mkdir($templates_dir . '/' . $template . '/language/' . $template . '/ ' . $lang, 0777);
                        mkdir($templates_dir . '/' . $template . '/language/' . $template . '/ ' . $lang . '/' . 'LC_MESSAGES', 0777);
                        file_put_contents($templates_dir . '/' . $template . '/language/' . $template . '/ ' . $lang . '/' . 'LC_MESSAGES/' . $template . '.po', '');
                    }
                }
            }
        }

        if (is_dir($main_dir)) {
            if (!is_dir($main_dir . '/' . $lang)) {
                mkdir($main_dir . '/' . $lang, 0777);
                mkdir($main_dir . '/' . $lang . '/LC_MESSAGES', 0777);
                file_put_contents($main_dir . '/' . $lang . '/LC_MESSAGES/main.po', '');
            }
        }

        if (is_dir($modules_dir)) {
            $modules = scandir($modules_dir);
            foreach ($modules as $module) {
                if (is_dir($modules_dir . '/' . $module . '/language') && $module != "." && $module != '..' && $module[0] != '.') {
                    if (!is_dir($modules_dir . '/' . $module . '/language/' . $lang)) {
                        mkdir($modules_dir . '/' . $module . '/language/' . $lang, 0777);
                        mkdir($modules_dir . '/' . $module . '/language/' . $lang . '/LC_MESSAGES', 0777);
                        file_put_contents($modules_dir . '/' . $module . '/language/' . $lang . '/LC_MESSAGES/main.po', '');
                        // to delete lang folders
//                         system("rm -rf " . escapeshellarg($modules_dir . '/' . $module . '/language/de_DE'));
                    }
                }
            }
        }
    }

    /**
     * Show lang_edit form
     */
    function edit($lang_id) {
        //cp_check_perm('lang_edit');
        // get lang params
        $lang = $this->cms_admin->get_lang($lang_id);
        $this->template->add_array($lang);

        $this->template->assign('lang_folders', $this->_get_lang_folders());
        $this->template->assign('templates', $this->_get_templates());

        $this->template->assign('folder_selected', $lang['folder']);
        $this->template->assign('locales', $this->getLocales());
        $this->template->assign('locale', $lang['locale']);
        $this->template->assign('template_selected', $lang['template']);

        $this->template->show('lang_edit', FALSE);
    }

    /**
     * Update language
     */
    function update($lang_id) {
        //cp_check_perm('lang_edit');

        $this->form_validation->set_rules('lang_name', lang("Title", "admin"), 'trim|required|min_length[1]|max_length[100]');
        $this->form_validation->set_rules('identif', lang("Identifier", "admin"), 'trim|required|min_length[1]|max_length[100]|alpha_dash');
        $this->form_validation->set_rules('image', lang("Image", "admin"), 'max_length[250]');
        $this->form_validation->set_rules('locale', lang("Locale", "admin"), 'required|max_length[250]');
        $this->form_validation->set_rules('template', lang("Template", "admin"), 'required|max_length[250]');

        if ($this->form_validation->run($this) == FALSE) {
            showMessage(validation_errors(), '', 'r');
        } else {

            $data = array(
                'lang_name' => $this->input->post('lang_name'),
                'identif' => $this->input->post('identif'),
                //'image' => $this->lib_admin->db_post('image'),
                'image' => $this->input->post('image'),
                'locale' => $this->input->post('locale'),
//                'folder' => $this->input->post('folder'),
                'template' => $this->input->post('template')
            );

            ($hook = get_hook('admin_language_update')) ? eval($hook) : NULL;

            $this->cms_admin->update_lang($data, $lang_id);

            $this->lib_admin->log(lang("Changed a language", "admin") . " " . $data['lang_name']);

            $this->cache->delete('main_site_langs');

            /* Create languages folders */

            $this->createLanguageFolders($data['locale']);

            showMessage(lang("Changes has been saved", "admin"));

            $action = $_POST['action'];
            if ($action == 'edit') {
                pjax('/admin/languages/edit/' . $lang_id);
            } else {
                pjax('/admin/languages');
            }
        }
    }

    /**
     * Delete language
     */
    function delete() {
        //cp_check_perm('lang_delete');
        //$id = $this->input->post('lang_id');
        $id = $this->input->post('ids');
        if (is_array($id)) {
            foreach ($id as $item) {
                $lang = $this->cms_admin->get_lang($item);
                ($hook = get_hook('admin_language_delete')) ? eval($hook) : NULL;
                if ($lang['default'] == 1) {
                    showMessage(lang("This language has been used by default and can not be deleted", "admin"), lang("Blocking", "admin"), 'r');
                    exit;
                }
                $this->cms_admin->delete_lang($item);
                // delete translated pages
                $this->db->where('lang', $item);
                $this->db->delete('content');
                $this->cache->delete('main_site_langs');
                $this->lib_admin->log(lang("Deleted the ID language", "admin") . " " . $item);
            }
        } else {
            $lang = $this->cms_admin->get_lang($id);

            ($hook = get_hook('admin_language_delete')) ? eval($hook) : NULL;

            if ($lang['default'] == 1) {
                showMessage(lang("This language has been used by default and can not be deleted", "admin"), lang("Blocking", "admin"), 'r');
                exit;
            }

            $this->cms_admin->delete_lang($id);

            // delete translated pages
            $this->db->where('lang', $id);
            $this->db->delete('content');

            $this->cache->delete('main_site_langs');

            $this->lib_admin->log(lang("Deleted the ID language", "admin") . ' ' . $id);
        }
        showMessage(lang("the language has been deleted", "admin"));
        pjax('/admin/languages');
        //updateDiv('languages_page_w_content', site_url('admin/languages/'));
    }

    /**
     * Set default language
     */
    function set_default() {
        //cp_check_perm('lang_edit');

        $lang_id = $this->input->post('lang');

        ($hook = get_hook('admin_change_def_language')) ? eval($hook) : NULL;

        $this->cache->delete('main_site_langs');

        $this->cms_admin->set_default_lang($lang_id);

        $lang = $this->cms_admin->get_lang($lang_id);

        $this->lib_admin->log(lang("Specified a language or selected a language", "admin") . " " . $lang['lang_name'] . " " . lang("by default", "admin"));

        showMessage(lang("The language has been installed by default", "admin") . ' <b> ' . $lang['lang_name'] . ' </b>');
    }

    /**
     * Search language folders
     *
     * @access private
     * @return array
     */
    private function _get_lang_folders() {
        $new_arr = array();

        if ($handle = opendir(APPPATH . 'language/')) {
            while (false !== ($file = readdir($handle))) {
                if ($file != "." && $file != ".." && $file != 'administrator') {

                    if (!is_file(APPPATH . 'language/' . $file)) {
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
     * Search templates in TEMPLATES_PATH folder
     *
     * @access private
     * @return array
     */
    private function _get_templates() {
        $new_arr = array();

        if ($handle = opendir(TEMPLATES_PATH)) {
            while (false !== ($file = readdir($handle))) {
                if ($file != "." && $file != ".." && $file != 'administrator') {
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

}

/* End of languages.php */
