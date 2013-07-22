<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Email Module Admin
 * @property email_model $email_model
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
        $this->load->model('email_model');
        $this->email = Email::getInstance();
    }

    public function index() {
        \CMSFactory\assetManager::create()
                ->setData('models', $this->email->email_model->getAllTemplates())
                ->renderAdmin('list');
    }

    public function settings() {
        \CMSFactory\assetManager::create()
                ->registerScript('email', TRUE)
                ->registerStyle('style')
                ->setData('settings', $this->email_model->getSettings())
                ->renderAdmin('settings');
    }

    public function create() {
        if ($_POST) {
            if ($this->email->create()) {

                showMessage("Шаблон создан");
                if ($this->input->post('action') == 'tomain')
                    pjax('/admin/components/cp/email/index');

                if ($this->input->post('action') == 'save')
                    pjax('/admin/components/cp/email/edit/' . $this->db->insert_id());
            }
            else {
                showMessage($this->email->errors, '', 'r');
            }
        }
        else
            \CMSFactory\assetManager::create()
                    ->registerScript('email', TRUE)
                    ->setData('settings', $this->email_model->getSettings())
                    ->renderAdmin('create');
    }

    public function delete() {
        $this->email->delete($_POST['ids']);
    }

    public function edit($id) {
        $model = $this->email_model->getTemplateById($id);
        $variables = unserialize($model['variables']);

        if ($_POST) {
            if ($this->email->edit($id)) {
                showMessage("Шаблон отредактирован");

                if ($this->input->post('action') == 'tomain')
                    pjax('/admin/components/cp/email/index');
            }
            else {
                showMessage($this->email->errors, '', 'r');
            }
        }
        else
            \CMSFactory\assetManager::create()
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
            $this->form_validation->set_rules('settings[admin_email]', 'Емейл администратора', 'required|xss_clean|valid_email');
            $this->form_validation->set_rules('settings[from_email]', 'Емейл отправителя', 'required|xss_clean|valid_email');
            $this->form_validation->set_rules('settings[from]', 'От кого', 'required|xss_clean');
            $this->form_validation->set_rules('settings[theme]', 'Тема письма', 'xss_clean|required');

            if ($_POST['settings']['wraper_activ'])
                $this->form_validation->set_rules('settings[wraper]', 'Обгортка', 'required|xss_clean|callback_wraper_check');
            else
                $this->form_validation->set_rules('settings[wraper]', 'Обгортка', 'xss_clean');

            if ($this->form_validation->run($this) == FALSE) {
                showMessage(validation_errors(), 'Сообщение', 'r');
            } else {
                if ($this->email_model->setSettings($_POST['settings']))
                    showMessage('Настройки сохранены', 'Сообщение');
            }

            $this->cache->delete_all();
        }
    }

    public function wraper_check($wraper) {
        if (preg_match('/\$content/', htmlentities($wraper))) {
            return TRUE;
        } else {
            $this->form_validation->set_message('wraper_check', 'Поле %s должно содержать переменную $content');
            return FALSE;
        }
    }

    public function deleteVariable() {
        $template_id = $this->input->post('template_id');
        $variable = $this->input->post('variable');

        return  $this->email_model->deleteVariable($template_id, $variable);
    }

    public function updateVariable() {
        $template_id = $this->input->post('template_id');
        $variable = $this->input->post('variable');
        $variableNewValue = $this->input->post('variableValue');
        $oldVariable = $this->input->post('oldVariable');
        return $this->email_model->updateVariable($template_id, $variable, $variableNewValue, $oldVariable);
    }

    public function addVariable() {
        $template_id = $this->input->post('template_id');
        $variable = $this->input->post('variable');
        $variableValue = $this->input->post('variableValue');

        if ($this->email_model->addVariable($template_id, $variable, $variableValue)) {
            return \CMSFactory\assetManager::create()
                            ->setData('template_id', $template_id)
                            ->setData('variable', $variable)
                            ->setData('variable_value', $variableValue)
                            ->render('newVariable', true);
        } else {
            return FALSE;
        }
    }

    public function getTemplateVariables() {
        $template_id = $this->input->post('template_id');
        $variables = $this->email_model->getTemplateVariables($template_id);
        if ($variables) {
            return \CMSFactory\assetManager::create()
                            ->setData('variables', $variables)
                            ->render('variablesSelectOptions', true);
        } else {
            return FALSE;
        }
    }

}