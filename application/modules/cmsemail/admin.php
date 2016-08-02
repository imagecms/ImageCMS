<?php

use cmsemail\email;
use CMSFactory\assetManager;

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Email Module Admin
 * @property Cache $cache
 * @property Cms_base $cms_base
 */
class Admin extends BaseAdminController
{

    const MAX_DEFAULT_TEMPLATES_CORPORATE = 3;
    const MAX_DEFAULT_TEMPLATES_SHOP = 7;

    /**
     * Object of Email class
     * @var Email
     */
    public $email;

    public function __construct() {
        parent::__construct();
        $this->load->language('email');
        $this->email = email::getInstance();
        $lang = new MY_Lang();
        $lang->load('cmsemail');
    }

    public function index() {
        assetManager::create()
            ->setData(
                [
                 'models'                => $this->email->getAllTemplates(),
                 'defaultTemplatesCount' => $this->getMaxDefaultTemplatesCount(),
                ]
            )
            ->renderAdmin('list');
    }

    /**
     * @return int
     */
    private function getMaxDefaultTemplatesCount() {
        if (MY_Controller::isCorporateCMS()) {
            return self::MAX_DEFAULT_TEMPLATES_CORPORATE;
        }

        return self::MAX_DEFAULT_TEMPLATES_SHOP;
    }

    /**
     * @param string $locale
     */
    public function settings($locale) {

        $locale = $locale ?: MY_Controller::defaultLocale();
        $encryption = [
                       'tls',
                       'ssl',
                      ];
        assetManager::create()
            ->registerScript('email')
            ->registerStyle('style')
            ->setData('settings', $this->email->getSettings($locale))
            ->setData('languages', $this->cms_base->get_langs())
            ->setData('locale', $locale)
            ->setData('encryption', $encryption)
            ->renderAdmin('settings');
    }

    public function create() {

        if ($this->input->post()) {
            $id = $this->email->create();
            if ($id) {
                $this->lib_admin->log(lang('E-mail template created', 'cmsemail') . ' - ' . $this->input->post('mail_name'));
                showMessage(lang('Template created', 'cmsemail'));

                if ($this->input->post('action') == 'tomain') {
                    pjax('/admin/components/cp/cmsemail/index');
                } else {
                    pjax('/admin/components/cp/cmsemail/edit/' . $id . '#settings');
                }
            } else {
                showMessage($this->email->errors, '', 'r');
            }
        } else {
            assetManager::create()
                ->registerScript('email')
                ->setData('settings', $this->email->getSettings())
                ->renderAdmin('create');
        }
    }

    public function mailTest() {
        lang('email_sent', 'admin');
        echo $this->email->mailTest();
    }

    public function delete() {

        $this->db->select('name');
        foreach ($this->input->post('ids') as $id) {
            $this->db->or_where('id', $id);
        }
        $names = $this->db->get('mod_email_paterns')->result_array();
        $this->email->delete($this->input->post('ids'));
        foreach ($names as $val) {
            $logNames[] = $val['name'];
        }
        $this->lib_admin->log(lang('Email template deleted', 'cmsemail') . ' - ' . implode(', ', $logNames));
        showMessage(lang('Email template deleted', 'cmsemail'), lang('Message', 'cmsemail'));
    }

    public function edit($id, $locale = null) {

        if (null === $locale) {
            $locale = chose_language();
        }

        $model = $this->email->getTemplateById($id, $locale);

        if (!$model) {
            $this->load->module('core');
            $this->core->error_404();
            exit;
        }
        $variables = unserialize($model['variables']);

        if ($this->input->post()) {
            if ($this->email->edit($id, [], $locale)) {
                $name = $this->db->select('name')->where('id', $id)->get('mod_email_paterns')->row()->name;

                $this->lib_admin->log(lang('Email template was edited', 'cmsemail') . ' - ' . $name);
                showMessage(lang('Template edited', 'cmsemail'));

                if ($this->input->post('action') == 'tomain') {
                    pjax('/admin/components/cp/cmsemail/index');
                }
            } else {
                showMessage($this->email->errors, '', 'r');
            }
        } else {
            assetManager::create()
                ->setData('locale', $locale)
                ->setData('languages', $this->db->get('languages')->result_array())
                ->setData('model', $model)
                ->setData('variables', $variables)
                ->registerScript('email')
                ->renderAdmin('edit');
        }
    }

    /**
     * update settings for email
     * @param string $locale
     */
    public function update_settings($locale) {

        $locale = $locale ?: MY_Controller::defaultLocale();

        if ($this->input->post()) {
            $this->form_validation->set_rules('settings[admin_email]', lang('Admin email', 'cmsemail'), 'required|xss_clean|valid_email');
            $this->form_validation->set_rules('settings[from_email]', lang('Email sender', 'cmsemail'), 'required|xss_clean|valid_email');
            $this->form_validation->set_rules('settings[from]', lang('From', 'cmsemail'), 'required|xss_clean');
            $this->form_validation->set_rules('settings[theme]', lang('From email', 'cmsemail'), 'xss_clean|required');

            $post_settings = $this->input->post('settings');
            if ($post_settings['wraper_activ']) {
                $this->form_validation->set_rules('settings[wraper]', lang('Wraper', 'cmsemail'), 'required|xss_clean|callback_wraper_check');
            } else {
                $this->form_validation->set_rules('settings[wraper]', lang('Wraper', 'cmsemail'), 'xss_clean');
            }

            if ($this->form_validation->run($this) == FALSE) {
                showMessage(validation_errors(), lang('Message', 'cmsemail'), 'r');
            } else {
                $data = [
                         'locale'   => $locale,
                         'settings' => $this->input->post('settings'),
                        ];

                if ($this->email->setSettings($data)) {
                    showMessage(lang('Settings saved', 'cmsemail'), lang('Message', 'cmsemail'));
                    $this->lib_admin->log(lang('Template customization mails have been changed', 'cmsemail') . '. Id: '); // . $id);??
                }
            }

            $this->cache->delete_all();
        }
    }

    /**
     * @param string $wrapper
     * @return bool
     */
    public function wraper_check($wrapper) {

        if (preg_match('/\$content/', htmlentities($wrapper))) {
            return TRUE;
        } else {
            $this->form_validation->set_message('wraper_check', lang('Field', 'cmsemail') . ' %s ' . lang('Must contain variable', 'cmsemail') . ' $content');
            return FALSE;
        }
    }

    /**
     * @param null|string $locale
     * @return bool|object
     */
    public function deleteVariable($locale = null) {

        if (null === $locale) {
            $locale = chose_language();
        }
        $template_id = $this->input->post('template_id');
        $variable = $this->input->post('variable');

        return $this->email->deleteVariable($template_id, $variable, $locale);
    }

    /**
     * @param null|string $locale
     * @return bool|object
     */
    public function updateVariable($locale = null) {

        if (null === $locale) {
            $locale = chose_language();
        }
        $template_id = $this->input->post('template_id');
        $variable = $this->input->post('variable');
        $variableNewValue = $this->input->post('variableValue');
        $oldVariable = $this->input->post('oldVariable');
        return $this->email->updateVariable($template_id, $variable, $variableNewValue, $oldVariable, $locale);
    }

    /**
     * @param null|string $locale
     * @return bool
     */
    public function addVariable($locale = null) {

        if (null === $locale) {
            $locale = chose_language();
        }
        $template_id = $this->input->post('template_id');
        $variable = $this->input->post('variable');
        $variableValue = $this->input->post('variableValue');

        if ($this->email->addVariable($template_id, $variable, $variableValue, $locale)) {
            assetManager::create()
                ->setData('template_id', $template_id)
                ->setData('variable', $variable)
                ->setData('variable_value', $variableValue)
                ->setData('locale', $locale)
                ->render('newVariable', true);
        } else {
            return FALSE;
        }
    }

    /**
     * @param null|string $locale
     * @return bool
     */
    public function getTemplateVariables($locale = null) {

        if (null === $locale) {
            $locale = chose_language();
        }
        $template_id = $this->input->post('template_id');
        $variables = $this->email->getTemplateVariables($template_id, $locale);
        if ($variables) {
            assetManager::create()
                ->setData('variables', $variables)
                ->render('variablesSelectOptions', true);
        } else {
            return FALSE;
        }
    }

    /**
     * import templates from file
     */
    public function import_templates() {

        $this->db->where_in('id', [1, 2, 3, 4, 5, 6, 7, 8, 9])->delete('mod_email_paterns');
        $this->db->where_in('id', [1, 2, 3, 4, 5, 6, 7, 8, 9])->delete('mod_email_paterns_i18n');

        if (MY_Controller::isCorporateCMS()) {
            $file = $this->load->file(__DIR__ . '/models/paterns_corporate.sql', true);
            $file_i18n = $this->load->file(__DIR__ . '/models/patterns_i18n_corporate.sql', true);
        } else {
            $file = $this->load->file(__DIR__ . '/models/paterns.sql', true);
            $file_i18n = $this->load->file(__DIR__ . '/models/patterns_i18n.sql', true);
        }
        $this->db->query($file);
        $this->db->query($file_i18n);

        $this->lib_admin->log(lang('Email templates were successfully imported', 'cmsemail'));

        redirect('/admin/components/cp/cmsemail/');
    }

}