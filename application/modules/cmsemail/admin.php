<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Email Module Admin
 * @property Cache $cache
 */
class Admin extends BaseAdminController {

    /**
     * Object of Email class
     * @var Email
     */
    public $email;

    public function __construct() {
        parent::__construct();
        $this->load->language('email');
        $this->email = \cmsemail\email::getInstance();
        $lang = new MY_Lang();
        $lang->load('cmsemail');
    }

    public function index() {
        \CMSFactory\assetManager::create()
                ->setData('models', $this->email->getAllTemplates())
                ->renderAdmin('list');
    }

    public function settings() {
        \CMSFactory\assetManager::create()
                ->registerScript('email', TRUE)
                ->registerStyle('style')
                ->setData('settings', $this->email->getSettings())
                ->renderAdmin('settings');
    }

    public function create() {
        if ($_POST) {
            if ($this->email->create()) {

                showMessage(lang('Template created', 'cms_email'));

                if ($this->input->post('action') == 'save')
                    pjax('/admin/components/cp/cmsemail/index');
            }
            else {
                showMessage($this->email->errors, '', 'r');
            }
        }
        else
            \CMSFactory\assetManager::create()
                    ->registerScript('email', TRUE)
                    ->setData('settings', $this->email->getSettings())
                    ->renderAdmin('create');
    }

    public function mailTest($config) {
        lang('email_sent', 'admin');
        echo $this->email->mailTest();
    }

    public function delete() {
        $this->email->delete($_POST['ids']);
    }

    public function edit($id, $locale = null) {
        if(null === $locale)
            $locale = chose_language();
        
        $model = $this->email->getTemplateById($id, $locale);
        
        if(!$model){
            $this->load->module('core');
            $this->core->error_404();
            exit;
        }
        $variables = unserialize($model['variables']);

        if ($_POST) {
            if ($this->email->edit($id, array(), $locale)) {
                showMessage(lang('Template edited', 'cmsemail'));

                if ($this->input->post('action') == 'tomain')
                    pjax('/admin/components/cp/cmsemail/index');
            }
            else {
                showMessage($this->email->errors, '', 'r');
            }
        }
        else
            \CMSFactory\assetManager::create()
                    ->setData('locale', $locale)
                    ->setData('languages',  $this->db->get('languages')->result_array())
                    ->setData('model', $model)
                    ->setData('variables', $variables)
                    ->registerScript('email', TRUE)
                    ->renderAdmin('edit');
    }

    /**
     * updare settings for email
     */
    public function update_settings() {
        if ($_POST) {
            $this->form_validation->set_rules('settings[admin_email]', lang('Admin email', 'cmsemail'), 'required|xss_clean|valid_email');
            $this->form_validation->set_rules('settings[from_email]', lang('Email sender', 'cmsemail'), 'required|xss_clean|valid_email');
            $this->form_validation->set_rules('settings[from]', lang('From', 'cmsemail'), 'required|xss_clean');
            $this->form_validation->set_rules('settings[theme]', lang('From email', 'cmsemail'), 'xss_clean|required');

            if ($_POST['settings']['wraper_activ'])
                $this->form_validation->set_rules('settings[wraper]', lang('Wraper', 'cmsemail'), 'required|xss_clean|callback_wraper_check');
            else
                $this->form_validation->set_rules('settings[wraper]', lang('Wraper', 'cmsemail'), 'xss_clean');

            if ($this->form_validation->run($this) == FALSE) {
                showMessage(validation_errors(), lang('Message', 'cmsemail'), 'r');
            } else {
                if ($this->email->setSettings($_POST['settings']))
                    showMessage(lang('Settings saved', 'cmsemail'), lang('Message', 'cmsemail'));
            }

            $this->cache->delete_all();
        }
    }

    public function wraper_check($wraper) {
        if (preg_match('/\$content/', htmlentities($wraper))) {
            return TRUE;
        } else {
            $this->form_validation->set_message('wraper_check', lang('Field', 'cmsemail') . ' %s ' . lang('Must contain variable', 'cmsemail') . ' $content');
            return FALSE;
        }
    }

    public function deleteVariable($locale = null) {
        if (null === $locale)
            $locale = chose_language();
        $template_id = $this->input->post('template_id');
        $variable = $this->input->post('variable');

        return $this->email->deleteVariable($template_id, $variable, $locale);
    }

    public function updateVariable($locale = null) {
        if (null === $locale)
            $locale = chose_language();
        $template_id = $this->input->post('template_id');
        $variable = $this->input->post('variable');
        $variableNewValue = $this->input->post('variableValue');
        $oldVariable = $this->input->post('oldVariable');
        return $this->email->updateVariable($template_id, $variable, $variableNewValue, $oldVariable, $locale);
    }

    public function addVariable($locale = null) {
        if (null === $locale)
            $locale = chose_language();
        $template_id = $this->input->post('template_id');
        $variable = $this->input->post('variable');
        $variableValue = $this->input->post('variableValue');

        if ($this->email->addVariable($template_id, $variable, $variableValue, $locale)) {
            \CMSFactory\assetManager::create()
                    ->setData('template_id', $template_id)
                    ->setData('variable', $variable)
                    ->setData('variable_value', $variableValue)
                    ->render('newVariable', true);
        } else {
            return FALSE;
        }
    }

    public function getTemplateVariables($locale = null) {
        if (null === $locale)
            $locale = chose_language ();
        $template_id = $this->input->post('template_id');
        $variables = $this->email->getTemplateVariables($template_id, $locale);
        if ($variables) {
            return \CMSFactory\assetManager::create()
                            ->setData('variables', $variables)
                            ->render('variablesSelectOptions', true);
        } else {
            return FALSE;
        }
    }

    /**
     * import templates from file
     */
    public function import_templates(){
        $this->db->where_in('id', array(1,2,3,4,5,6,7))->delete('mod_email_paterns');
        $file = $this->load->file(dirname(__FILE__) . '/models/paterns.sql', true);
        $this->db->query($file);
        $file = $this->load->file(dirname(__FILE__) . '/models/patterns_i18n.sql', true);
        $this->db->query($file);
        redirect('/admin/components/cp/cmsemail/');
        
    }

}