<?php

use template_manager\classes\Template;

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * @property CI_Cache $cache
 * @property Cms_admin $cms_admin
 * @property Lib_admin $lib_admin
 * @property SiteInfo $siteinfo
 * @property Lib_category $lib_category
 */
class Settings extends BaseAdminController
{

    /**
     * If TRUE then data will be save for each locale separately
     * @var boolean
     */
    protected $siteInfoLocales = FALSE;

    /**
     * Upload path for images (logo and favicon)
     * @var string
     */
    protected $uploadPath = 'uploads/images/';

    public function __construct() {

        parent::__construct();

        $this->load->library('DX_Auth');
        admin_or_redirect();

        $this->load->library('lib_admin');
        $this->load->library('lib_category');
        $this->lib_admin->init_settings();
    }

    public function index() {

        $settings = $this->cms_admin->get_settings();
        unset($settings['siteinfo']);

        $locale = $this->db->select('identif')->where('default', 1)->get('languages')->row_array();
        $this->load->library('SiteInfo', $locale['identif']);

        $siteinfo = $siteinfo = $this->siteinfo->getSiteInfoData(TRUE);

        /// Вибірка сторінок по мові \\\\\\\
        $language = MY_Controller::getCurrentLanguage();
        $query = $this->db->select('*')->where('lang', $language['id'])->get('content');
        $pages = $query->result_array();
        $this->template->assign('pages', $pages);

        if (is_array($siteinfo)) {
            $this->template->add_array($siteinfo);
        }

        $this->template->assign('pageSetting', $settings['main_page_id']);
        $this->template->add_array($settings);
        $this->template->assign('templates', $this->_get_templates());
        $this->template->assign('template_selected', $settings['site_template']);

        // Передає змінну статусу роботів

        $this->template->assign('robots_settings_status', $settings['robots_settings_status']);
        $this->template->assign('robots_settings', $settings['robots_settings']);
        $this->template->assign('robots_status', $settings['robots_status']);

        $this->template->assign('work_values', ['yes' => lang('Yes', 'admin'), 'no' => lang('No', 'admin')]);
        $this->template->assign('site_offline', $settings['site_offline']);

        $this->config->set_item('cur_lang', $this->load->module('core')->def_lang[0]['id']);
        $this->template->assign('tree', $this->lib_category->build());

        $this->template->assign('parent_id', $settings['main_page_cat']);
        $this->template->assign('www_redirect', $settings['www_redirect']);
        $this->template->assign('id', 0);

        ///++++++++++++++++++++

        $langs = $this->db->get('languages')->result_array();
        $lang_meta = [];
        foreach ($langs as $lang) {
            $meta = $this->db->where('lang_ident', $lang['id'])->limit(1)->get('settings_i18n')->result_array();
            if (count($meta) > 0) {
                $lang_meta[$lang['id']] = $meta[0];
            } else {
                $lang_meta[$lang['id']] = null;
            }
        }

        $this->template->assign('langs', $langs);

        $this->template->assign('meta_langs', $lang_meta);
        $this->template->assign('users_roles', Permitions::getRoles());
        $this->template->assign('users_registration_role_id', $settings['users_registration_role_id']);

        //++++++++++++++++++++
        // Load modules list
        $notAvailableModules = [
            'mainsaas', 'saas', 'translator', 'auth', 'user_manager', 'comments', 'navigation', 'tags', 'rss', 'menu', 'sitemap', 'search', 'template_editor',
            'filter', 'cfcm', 'sample_mail', 'mailer', 'share', 'banners', 'new_level', 'shop_news', 'categories_settings', 'exchange', 'cmsemail', 'mod_stats',
            'mod_seo', 'mod_discount', 'smart_filter', 'mobile', 'trash', 'language_switch', 'star_rating', 'imagebox', 'sample_module', 'template_manager',
            'payment_method_2checkout', 'payment_method_oschadbank', 'payment_method_robokassa', 'payment_method_webmoney', 'payment_method_paypal',
            'payment_method_liqpay', 'payment_method_privat24', 'payment_method_sberbank', 'payment_method_qiwi', 'payment_method_interkassa',
            'import_export', 'admin_menu', 'related_products', 'ymarket', 'xbanners', 'moy_sklad','custom_scripts','ga_dashboard', 'seo_snippets', 'payment_method_yakassa'
        ];
        $this->template->assign('modules', $this->db->where_not_in('name', $notAvailableModules)->get('components')->result_array());

        $this->template->show('settings_site', FALSE);
    }

    //++++++++++++++

    public function translate_meta() {

        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', lang('Name', 'admin'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('short_name', lang('Short name', 'admin'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('description', lang('Description', 'admin'), 'trim|xss_clean');
        $this->form_validation->set_rules('keywords', lang('Keywords', 'admin'), 'trim|xss_clean');

        if ($this->form_validation->run($this) == FALSE) {
            showMessage(validation_errors(), false, 'r');
        } else {
            $name = $this->input->post('name');
            $short_name = $this->input->post('short_name');
            $desk = $this->input->post('description');
            $key = $this->input->post('keywords');
            $lang = $this->input->post('lang_ident');
            if (count($this->db->where('lang_ident', $lang)->get('settings_i18n')->result_array())) {
                $this->db->query(
                    "UPDATE settings_i18n
                                                            SET
                                                                name = '$name',
                                                                short_name = '$short_name',
                                                                description = '$desk',
                                                                keywords = '$key'
                                                            WHERE lang_ident = '$lang'"
                );
            } else {
                $this->db->query(
                    "INSERT INTO settings_i18n(
                                                                lang_ident,
                                                                name,
                                                                short_name,
                                                                description,
                                                                keywords
                                                                )
                                                            VALUES(
                                                                '$lang',
                                                                '$name',
                                                                '$short_name',
                                                                '$desk',
                                                                '$key')"
                );
            }
        }
    }

    //+++++++++++++++++++++++++++++++++++++++++

    /**
     * Main Page settings
     */
    public function main_page() {

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
    public function _get_templates() {

        return get_templates();
    }

    /**
     * Save site settings
     *
     * @access public
     */
    public function save() {
        //cp_check_perm('cp_site_settings');

        $this->form_validation->set_rules('siteinfo_adminemail', lang('Admin email', 'admin'), 'trim|valid_email');
        if (!$this->form_validation->run($this)) {
            showMessage(validation_errors(), lang('Error', 'admin'), 'r');
            return;
        }
        switch ($this->input->post('main_type')) {
            case 'category':
                $data = [
                    'main_type' => 'category',
                    'main_page_cat' => $this->input->post('main_page_cat'),
                ];

                $this->cms_admin->save_settings($data);
                break;

            case 'page':
                if ($this->cms_admin->page_exists($this->input->post('main_page_pid'))) {
                    $data = [
                        'main_type' => 'page',
                        'main_page_id' => $this->input->post('main_page_pid')
                    ];

                    $this->cms_admin->save_settings($data);
                } else {
                    showMessage(lang('Page has not been found', 'admin'), false, 'r');
                    exit;
                }
                break;

            case 'module':
                $data = [
                    'main_type' => 'module',
                    'main_page_module' => $this->input->post('main_page_module'),
                ];
                $this->cms_admin->save_settings($data);
                break;
        }

        $this->processSiteInfo();

        $data_m = [
            'create_keywords' => $this->input->post('create_keywords'),
            'create_description' => $this->input->post('create_description'),
            'create_cat_keywords' => $this->input->post('create_cat_keywords'),
            'create_cat_description' => $this->input->post('create_cat_description'),
            'add_site_name' => $this->input->post('add_site_name'),
            'add_site_name_to_cat' => $this->input->post('add_site_name_to_cat'),
            'delimiter' => $this->input->post('delimiter'),
            'cat_list' => $this->input->post('cat_list'),
            'editor_theme' => $this->input->post('editor_theme'),
            'site_offline' => $this->input->post('site_offline'),
            'google_analytics_id' => $this->input->post('google_analytics_id'),
            'google_webmaster' => $this->input->post('google_webmaster'),
            'yandex_webmaster' => $this->input->post('yandex_webmaster'),
            'yandex_metric' => $this->input->post('yandex_metric'),
            'site_template' => $this->input->post('template'),
            'lang_sel' => $this->input->post('lang_sel'),
            'text_editor' => $this->input->post('text_editor'),
            'robots_status' => (int) $this->input->post('robots_status'),
            'robots_settings_status' => (int) $this->input->post('robots_settings_status'),
            'robots_settings' => $this->input->post('robots_settings'),
            'google_analytics_ee' => $this->input->post('google_analytics_ee') == 'on' ? 1 : 0,
            'www_redirect' => $this->input->post('www_redirect'),
            'users_registration_role_id' => $this->input->post('users_registration_role_id'),
        ];

        /** Save template path for shop * */
        if ($this->db->table_exists('shop_settings')) {
            $shopTemplatePath = './templates/' . $this->input->post('template') . '/shop/';
            $this->db->where('name', 'systemTemplatePath')->update('shop_settings', ['value' => $shopTemplatePath]);
        }

        $this->translate_meta();

        $this->cms_admin->save_settings($data_m);

        $this->cache->delete_all();

        $this->lib_admin->log(lang('Changed wesite settings', 'admin'));

        echo "<script>var textEditor = '{$data_m['text_editor']}';</script>";
        if (!validation_errors()) {
            showMessage(lang('Settings have been saved', 'admin'));
        }
    }

    /**
     * Getting values of "siteinfo" from POST
     * Uploads logo and favicon (if present)
     * @return boolean whatever data was saved or not
     */
    protected function processSiteInfo() {

        $this->load->library('SiteInfo', $this->input->post('siteinfo_locale'));

        // getting all parameters with keys
        $siteInfo = [];
        $postData = $this->input->post();
        unset($postData['siteinfo_locale']);
        foreach ($postData as $key => $value) {
            if (0 === strpos($key, 'siteinfo_')) {
                $siteInfo[$key] = $value;
                unset($postData[$key]);
            }
        }

        // remap additional fields
        $additional = [];
        $countKeys = count($siteInfo['siteinfo_contactkey']);
        $countValues = count($siteInfo['siteinfo_contactvalue']);
        if ($countKeys == $countValues & $countValues > 0) {
            for ($i = 0; $i < $countKeys; $i++) {
                if (!empty($siteInfo['siteinfo_contactkey'][$i])) {
                    $additional[$siteInfo['siteinfo_contactkey'][$i]] = $siteInfo['siteinfo_contactvalue'][$i];
                }
            }
        }

        unset($siteInfo['siteinfo_contactkey']);
        unset($siteInfo['siteinfo_contactvalue']);

        $siteInfo['contacts'] = $additional;

        $upload_path = rtrim(FCPATH, '/') . $this->siteinfo->imagesPath;

        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = 'jpg|jpeg|png|ico|gif';
        $config['overwrite'] = TRUE;
        $this->load->library('upload', $config);

        // upload or delete (or do nothing) favicon and logo
        if ($this->input->post('si_delete_favicon') == 1) {
            if (isset($siteInfo['siteinfo_favicon'])) {
                unset($siteInfo['siteinfo_favicon']);
            }
        } else {
            $this->processLogoOrFavicon('siteinfo_favicon', $siteInfo);
        }

        if ($this->input->post('si_delete_logo') == 1) {
            if (isset($siteInfo['siteinfo_logo'])) {
                unset($siteInfo['siteinfo_logo']);
            }
        } else {
            $this->processLogoOrFavicon('siteinfo_logo', $siteInfo);
        }

        // saving admin's email in application/config/auth.php
        $authFullPath = './application/config/auth.php';
        $authContents = file_get_contents($authFullPath);
        $pattern = '/(\$config\[\'DX_webmaster_email\'\][\s\=]{1,})[\'\"0-9A-Za-z\@\.\-\_]+/i';
        $replacement = '$1\'' . $siteInfo['siteinfo_adminemail'] . '\'';
        $newAuthContents = preg_replace($pattern, $replacement, $authContents);
        if (is_writable($authFullPath)) {
            $this->load->helper('file');
            write_file($authFullPath, $newAuthContents);
        }

        $this->siteinfo->setSiteInfoData($siteInfo);
        if ($this->input->post('si_delete_favicon') == 1) {
            $this->siteinfo->deleteSiteInfoValue('favicon');
        }
        if ($this->input->post('si_delete_logo') == 1) {
            $this->siteinfo->deleteSiteInfoValue('logo');
        }
        return $this->siteinfo->save();
    }

    public function getSiteInfoDataJson() {

        $this->load->library('SiteInfo', $this->input->post('locale'));
        $data = $this->siteinfo->getSiteInfoData(TRUE);
        echo json_encode(array_merge($data, ['locale' => $this->input->post('locale')]));
    }

    /**
     *
     * @param string $paramName
     * @param array $siteinfo
     */
    protected function processLogoOrFavicon($paramName, &$siteinfo) {

        // setting old value
        $oldValue = $this->siteinfo->getSiteInfo($paramName);
        $siteinfo[$paramName] = !empty($oldValue) ? $oldValue : '';
        if (isset($_FILES[$paramName])) {
            if (!$this->upload->do_upload($paramName)) {
                echo $this->upload->display_errors('', '');
            } else {
                $uploadData = $this->upload->data();
                $siteinfo[$paramName] = $uploadData['file_name'];
            }
        }
    }

    public function switch_admin_lang($lang) {

        if ($lang) {
            $this->db->set('lang_sel', $lang)
                ->update('settings');
            $this->session->set_userdata('language', $lang);
        }
        redirect($this->input->server('HTTP_REFERER') ?: '/admin/dashboard');
    }

    /**
     * Returns license agreement from template, or default agreement
     * @return string
     */
    public function license_agreement() {

        header('Content-Type: text/plain; charset=utf-8');
        $template = new Template($this->input->get('template_name'));
        echo $template->getLicenseAgreement();
    }

    /**
     * @param null|string $templateName
     */
    public function template_has_license($templateName = null) {

        if (!$templateName) {
            $templateName = $this->input->get('template_name');
        }

        if (empty($templateName)) {
            echo 0;
            return;
        }
        if (false == class_exists('\\template_manager\\classes\\Template')) {
            echo 0;
            return;
        }
        $template = new Template($templateName);
        $license = $template->getLicenseAgreement();
        echo empty($license) ? 0 : 1;
    }

}

/* End of settings.php */