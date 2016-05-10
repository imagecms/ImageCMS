<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * @property Cms_admin cms_admin
 */
class Languages extends BaseAdminController
{

    public function __construct() {

        parent::__construct();

        $this->load->library('DX_Auth');
        admin_or_redirect();

        $this->load->library('lib_admin');
        $this->load->library('form_validation');
        $this->lib_admin->init_settings();
    }

    public function index() {

        $settings = $this->cms_admin->get_settings();
        $this->template->assign('template_selected', $settings['site_template']);
        $langs = $this->cms_admin->get_langs();
        $this->template->assign('langs', $langs);
        $this->template->show('languages', FALSE);
    }

    /**
     * return set of locales
     * @return array - locales
     */
    public function getLocales() {

        $langs_config = $this->config->item('locales');
        $langs = $langs_config;

        foreach ($langs as $key => $lang) {
            $locale = setlocale(LC_ALL, $lang . '.utf8', $lang . '.utf-8', $lang . '.UTF8', $lang . '.UTF-8', $lang . '.utf-8', $lang . '.UTF-8', $lang);
            if (!$locale) {
                unset($langs[$key]);
            }
        }
        if (!$langs) {
            return $langs_config;
        }

        return $langs;
    }

    /**
     * Show lang_create form
     */
    public function create_form() {

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
    public function insert() {
        $this->form_validation->set_rules('name', lang('Title', 'admin'), 'trim|required|min_length[1]|max_length[100]');
        $this->form_validation->set_rules('identif', lang('Identifier', 'admin'), 'trim|required|min_length[1]|max_length[5]|alpha_dash');
        $this->form_validation->set_rules('locale', lang('Locale', 'admin'), 'required|max_length[250]');

        if ($this->form_validation->run($this) == FALSE) {
            showMessage(validation_errors(), '', 'r');
        } else {

            $data = [
                     'lang_name' => $this->input->post('name'),
                     'identif'   => $this->input->post('identif'),
                     'locale'    => $this->input->post('locale'),
                     'active'    => $this->input->post('active'),
                    ];

            $this->cms_admin->insert_lang($data);

            $this->lib_admin->log(lang('Create a language ', 'admin') . ' ' . $data['lang_name']);

            $this->cache->delete('main_site_langs');

            $this->createLanguageFolders($data['locale']);

            showMessage(lang('Language has been created', 'admin'));

            if ($this->input->post('create_exit')) {
                pjax('/admin/languages/');
            } else {
                $lastLangId = $this->db->query('SELECT id FROM languages ORDER BY id DESC')->row()->id;
                pjax('/admin/languages/edit/' . $lastLangId);
            }
        }
    }

    public function getPoFileSettingsText($lang = '', $type = '', $module = NULL) {

        $content = b"\xEF\xBB\xBF" .
            'msgid ""' . PHP_EOL .
            'msgstr ""' . PHP_EOL .
            '"Project-Id-Version: \n"' . PHP_EOL .
            '"Report-Msgid-Bugs-To: \n"' . PHP_EOL .
            '"POT-Creation-Date: ' . date('Y-m-d h:iO', time()) . '\n"' . PHP_EOL .
            '"PO-Revision-Date: ' . date('Y-m-d h:iO', time()) . '\n"' . PHP_EOL .
            '"Last-Translator:  \n"' . PHP_EOL .
            '"Language-Team:  \n"' . PHP_EOL .
            '"Language: ' . $lang . '\n"' . PHP_EOL .
            '"MIME-Version: 1.0\n"' . PHP_EOL .
            '"Content-Type: text/plain; charset=UTF-8\n"' . PHP_EOL .
            '"Content-Transfer-Encoding: 8bit\n"' . PHP_EOL .
            '"X-Poedit-KeywordsList: _;gettext;gettext_noop;lang\n"' . PHP_EOL;
        switch ($type) {
            case 'main':
                if (file_exists('./application/language/main/ru_RU/LC_MESSAGES/main.po')) {
                    $main_content = file('./application/language/main/ru_RU/LC_MESSAGES/main.po');

                    $content .= '"X-Poedit-Basepath: .\n"' . PHP_EOL .
                        '"X-Poedit-SourceCharset: utf-8\n"' . PHP_EOL .
                        '"X-Generator: Poedit 1.5.7\n"' . PHP_EOL .
                        '"X-Poedit-Language: \n"' . PHP_EOL .
                        '"X-Poedit-Country: \n"' . PHP_EOL;

                    foreach ($main_content as $line) {
                        if (strstr($line, 'X-Poedit-SearchPath')) {
                            $content .= $line;
                        }
                        if (!$line) {
                            break;
                        }
                    }
                } else {
                    $content .= '"X-Poedit-Basepath: .\n"' . PHP_EOL .
                        '"X-Poedit-SourceCharset: utf-8\n"' . PHP_EOL .
                        '"X-Generator: Poedit 1.5.7\n"' . PHP_EOL .
                        '"X-Poedit-Language: \n"' . PHP_EOL .
                        '"X-Poedit-Country: \n"' . PHP_EOL .
                        '"X-Poedit-SearchPath-0: ..\n"' . PHP_EOL;
                }

                break;
            case 'module':

                if ($module == 'admin') {
                    $content .= '"X-Poedit-Basepath: ../../..\n"' . PHP_EOL .
                        '"X-Poedit-SourceCharset: utf-8\n"' . PHP_EOL .
                        '"X-Generator: Poedit 1.5.7\n"' . PHP_EOL .
                        '"X-Poedit-Language: \n"' . PHP_EOL .
                        '"X-Poedit-Country: \n"' . PHP_EOL .
                        '"X-Poedit-SearchPath-0: .\n"' . PHP_EOL .
                        '"X-Poedit-SearchPath-1: ../../../templates/administrator\n"' . PHP_EOL .
                        '"X-Poedit-SearchPath-2: ../../' . getModContDirName('shop') . '/shop/admin\n"' . PHP_EOL .
                        'X-Poedit-SearchPath-3: ../../../application/' . getModContDirName('shop') . '/shop/models/build/classes\n' . PHP_EOL;
                } else {
                    $content .= '"X-Poedit-Basepath: ../../..\n"' . PHP_EOL .
                        '"X-Poedit-SourceCharset: utf-8\n"' . PHP_EOL .
                        '"X-Generator: Poedit 1.5.7\n"' . PHP_EOL .
                        '"X-Poedit-Language: \n"' . PHP_EOL .
                        '"X-Poedit-Country: \n"' . PHP_EOL .
                        '"X-Poedit-SearchPath-0: .\n"' . PHP_EOL;
                }

                break;
            case 'template':
                $content .= '"X-Poedit-Basepath: ../../../..\n"' . PHP_EOL .
                    '"X-Poedit-SourceCharset: utf-8\n"' . PHP_EOL .
                    '"X-Generator: Poedit 1.5.7\n"' . PHP_EOL .
                    '"X-Poedit-Language: \n"' . PHP_EOL .
                    '"X-Poedit-Country: \n"' . PHP_EOL .
                    '"X-Poedit-SearchPath-0: .\n"' . PHP_EOL;
                break;
        }
        return $content;
    }

    /**
     * Create language folders for templates, front, and modules
     * @param string $lang - locale identifier: ru_RU, en_US, de_DC
     */
    public function createLanguageFolders($lang) {

        $templates_dir = './templates';
        $main_dir = './application/language/main';
        $modules_dir = './application/modules';

        $template_content = $this->getPoFileSettingsText($lang, 'template');
        $main_content = $this->getPoFileSettingsText($lang, 'main');
        if (is_dir($templates_dir)) {
            $templates = scandir($templates_dir);
            foreach ($templates as $template) {
                if (is_dir("$templates_dir/$template") && $template != '.' && $template != '..' && $template[0] != '.') {
                    if (!is_dir("$templates_dir/$template/language/$template/$lang")) {
                        mkdir("$templates_dir/$template/language/$template/$lang", 0777);
                        mkdir("$templates_dir/$template/language/$template/$lang/LC_MESSAGES", 0777);
                        file_put_contents("$templates_dir/$template/language/$template/$lang/LC_MESSAGES/$template.po", $template_content);
                    }
                }
            }
        }

        if (is_dir($main_dir)) {
            if (!is_dir($main_dir . '/' . $lang)) {
                mkdir($main_dir . '/' . $lang, 0777);
                mkdir($main_dir . '/' . $lang . '/LC_MESSAGES', 0777);
                file_put_contents($main_dir . '/' . $lang . '/LC_MESSAGES/main.po', $main_content);
            }
        }

        if (is_dir($modules_dir)) {
            $modules = scandir($modules_dir);
            foreach ($modules as $module) {
                if (is_dir($modules_dir . '/' . $module . '/language') && $module != '.' && $module != '..' && $module[0] != '.') {
                    if (!is_dir($modules_dir . '/' . $module . '/language/' . $lang)) {
                        mkdir($modules_dir . '/' . $module . '/language/' . $lang, 0777);
                        mkdir($modules_dir . '/' . $module . '/language/' . $lang . '/LC_MESSAGES', 0777);
                        $module_content = $this->getPoFileSettingsText($lang, 'module', $module);
                        file_put_contents($modules_dir . '/' . $module . '/language/' . $lang . '/LC_MESSAGES/' . $module . '.po', $module_content);
                        // to delete lang folders
                        //                         system("rm -rf " . escapeshellarg($modules_dir . '/' . $module . '/language/de_DE'));
                    }
                }
            }
        }
    }

    /**
     * Rename locales folders (example ./application/modules/module_name/langauge/lo_LO)
     * @param string $from_locale - locale name to rename
     * @param string $to_locale - locale name rename by
     * @return boolean
     */
    private function renameLocaleFolders($from_locale, $to_locale) {

        if ($from_locale && $to_locale) {
            $templates_dir = './templates';
            $main_dir = './application/language/main';
            $modules_dir = './application/modules';

            if (is_dir($main_dir)) {
                $from_name = $main_dir . '/' . $from_locale;
                $to_name = $main_dir . '/' . $to_locale;
                if (is_dir($from_name)) {
                    chmod($from_name, 0777);
                    rename($from_name, $to_name);
                }
            }

            if (is_dir($modules_dir)) {
                foreach (new DirectoryIterator($modules_dir) as $module) {
                    $language_dir = $modules_dir . '/' . $module->getFilename() . '/language/';
                    if (is_dir($language_dir) && $module->isDir() && !$module->isDot()) {
                        $from_name = $language_dir . $from_locale;
                        $to_name = $language_dir . $to_locale;
                        if (is_dir($from_name)) {
                            chmod($from_name, 0777);
                            rename($from_name, $to_name);
                        }
                    }
                }
            }

            if (is_dir($templates_dir)) {
                foreach (new DirectoryIterator($templates_dir) as $template) {
                    if ($template->isDir() && !$template->isDot()) {
                        $from_name = $templates_dir . '/' . $template . '/language/' . $template . '/' . $from_locale;
                        $to_name = $templates_dir . '/' . $template . '/language/' . $template . '/' . $to_locale;
                        if (is_dir($from_name)) {
                            chmod($from_name, 0777);
                            rename($from_name, $to_name);
                        }
                    }
                }
            }

            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * @param string $dir
     */
    private function rrmdir($dir) {

        foreach (glob($dir . '/*') as $file) {
            if (is_dir($file)) {
                $this->rrmdir($file);
            } else {
                unlink($file);
            }
        }
        rmdir($dir);
    }

    private function deleteLanguageFolders($lang) {

        $templates_dir = './templates';
        $main_dir = './application/language/main';
        $modules_dir = './application/modules';
        if (is_dir($templates_dir)) {
            $templates = scandir($templates_dir);
            foreach ($templates as $template) {
                if (is_dir($templates_dir . '/' . $template) && $template != '.' && $template != '..' && $template[0] != '.') {
                    if (is_dir($templates_dir . '/' . $template . '/language/' . $template . '/' . $lang)) {
                        chmod($templates_dir . '/' . $template . '/language/' . $template . '/' . $lang, 0777);
                        $this->rrmdir($templates_dir . '/' . $template . '/language/' . $template . '/' . $lang);
                    }
                }
            }
        }

        if (is_dir($main_dir)) {
            if (is_dir($main_dir . '/' . $lang)) {
                chmod($main_dir . '/' . $lang, 0777);
                $this->rrmdir($main_dir . '/' . $lang);
            }
        }

        if (is_dir($modules_dir)) {
            $modules = scandir($modules_dir);
            foreach ($modules as $module) {
                if (is_dir($modules_dir . '/' . $module . '/language') && $module != '.' && $module != '..' && $module[0] != '.') {
                    if (is_dir($modules_dir . '/' . $module . '/language/' . $lang)) {
                        chmod($modules_dir . '/' . $module . '/language/' . $lang, 0777);
                        $this->rrmdir($modules_dir . '/' . $module . '/language/' . $lang);
                    }
                }
            }
        }
    }

    /**
     * Show lang_edit form
     */
    public function edit($lang_id) {

        //cp_check_perm('lang_edit');
        // get lang params
        $lang = $this->cms_admin->get_lang($lang_id);
        $this->template->add_array($lang);

        $this->template->assign('lang_folders', $this->_get_lang_folders());
        $this->template->assign('templates', $this->_get_templates());

        $this->template->assign('folder_selected', $lang['folder']);
        $this->template->assign('locales', $this->getLocales());
        $this->template->assign('locale', $lang['locale']);
        $this->template->assign('is_active', $lang['active']);
        $this->template->assign('is_default', $lang['default']);
        $this->template->assign('template_selected', $lang['template']);

        $settings = $this->cms_admin->get_settings();
        $this->template->assign('template_installed', $settings['site_template']);

        $this->template->show('lang_edit', FALSE);
    }

    /**
     * Update language
     * @param int $lang_id
     */
    public function update($lang_id) {

        //cp_check_perm('lang_edit');

        $this->form_validation->set_rules('lang_name', lang('Title', 'admin'), 'trim|required|min_length[1]|max_length[100]');
        $this->form_validation->set_rules('identif', lang('Identifier', 'admin'), 'trim|required|min_length[1]|max_length[5]|alpha_dash');
        $this->form_validation->set_rules('locale', lang('Locale', 'admin'), 'required|max_length[250]');

        if ($this->form_validation->run($this) == FALSE) {
            showMessage(validation_errors(), '', 'r');
        } else {

            $lang = $this->cms_admin->get_lang($lang_id);
            $post_locale = trim($this->input->post('locale'));

            $data = [
                     'lang_name' => $this->input->post('lang_name'),
                     'identif'   => $this->input->post('identif'),
                     'locale'    => $post_locale,
                     'active'    => $this->input->post('active'),
                    ];

            $this->cms_admin->update_lang($data, $lang_id);

            $this->lib_admin->log(lang('Changed a language', 'admin') . ' ' . $data['lang_name']);

            $this->cache->delete_all();

            /* Rename languages folders */
            if (($lang['locale'] !== $post_locale) && $post_locale) {
                $this->renameLocaleFolders($lang['locale'], $post_locale);
                $this->createLanguageFolders($post_locale);
            }

            showMessage(lang('Changes has been saved', 'admin'));

            $action = $this->input->post('action');
            if ($action == 'close') {
                pjax('/admin/languages');
            }
        }
    }

    /**
     * Delete language
     */
    public function delete() {

        //cp_check_perm('lang_delete');
        //$id = $this->input->post('lang_id');
        $id = $this->input->post('ids');
        if (is_array($id)) {
            foreach ($id as $item) {
                $lang = $this->cms_admin->get_lang($item);
                ($hook = get_hook('admin_language_delete')) ? eval($hook) : NULL;
                if ($lang['default'] == 1) {
                    showMessage(lang('This language has been used by default and can not be deleted', 'admin'), lang('Blocking', 'admin'), 'r');
                    exit;
                }
                $this->cms_admin->delete_lang($item);
                $this->deleteLanguageFolders($lang['locale']);
                // delete translated pages
                $this->db->where('lang', $item);
                $this->db->delete('content');
                $this->cache->delete('main_site_langs');
                $this->lib_admin->log(lang('Deleted the ID language', 'admin') . ' ' . $item);
            }
        } else {
            $lang = $this->cms_admin->get_lang($id);

            ($hook = get_hook('admin_language_delete')) ? eval($hook) : NULL;

            if ($lang['default'] == 1) {
                showMessage(lang('This language has been used by default and can not be deleted', 'admin'), lang('Blocking', 'admin'), 'r');
                exit;
            }

            $this->cms_admin->delete_lang($id);

            // delete translated pages
            $this->db->where('lang', $id);
            $this->db->delete('content');

            $this->deleteLanguageFolders($lang['locale']);
            $this->cache->delete('main_site_langs');

            $this->lib_admin->log(lang('Deleted the ID language', 'admin') . ' ' . $id);
        }
        showMessage(lang('the language has been deleted', 'admin'));
        pjax('/admin/languages');
        //updateDiv('languages_page_w_content', site_url('admin/languages/'));
    }

    /**
     * Set default language
     */
    public function set_default() {

        //cp_check_perm('lang_edit');

        $lang_id = $this->input->post('lang');

        ($hook = get_hook('admin_change_def_language')) ? eval($hook) : NULL;

        $this->cache->delete('main_site_langs');

        $this->cms_admin->set_default_lang($lang_id);

        $lang = $this->cms_admin->get_lang($lang_id);

        $this->lib_admin->log(lang('Specified a language or selected a language', 'admin') . ' ' . $lang['lang_name'] . ' ' . lang('by default', 'admin'));

        showMessage(lang('The language has been installed by default', 'admin') . ' <b> ' . $lang['lang_name'] . ' </b>');
    }

    /**
     * Search language folders
     *
     * @access private
     * @return array
     */
    private function _get_lang_folders() {

        $new_arr = [];

        if ($handle = opendir(APPPATH . 'language/')) {
            while (false !== ($file = readdir($handle))) {
                if ($file != '.' && $file != '..' && $file != 'administrator') {

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
    public function _get_templates() {

        return get_templates();
    }

    /**
     * Change language activity via ajax request
     */
    public function ajaxChangeActive() {
        $id = $this->input->post('id');
        $active = $this->input->post('active');

        if ($id) {
            $this->db->where('id', $id)
                ->set('active', $active)
                ->update('languages');
        }
        $this->cache->delete_all();
    }

}