<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Email Module Admin
 * @property email_model $email_model
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
        $this->email = new Email();
    }

    public function index() {
        \CMSFactory\assetManager::create()
                ->setData('models', $this->email->email_model->getAllTemplates())
                ->renderAdmin('list');
    }

    public function settings() {
        \CMSFactory\assetManager::create()
                ->registerScript('email')
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
                    ->registerScript('email')
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
                    ->registerScript('email')
                    ->renderAdmin('edit');
    }

    /**
     * updare settings for email
     */
    public function update_settings() {
        if ($_POST) {
//            $wraper = htmlentities($_POST['settings']['wraper']);
//            var_dumps($wraper);
//            if(strstr('$content', $wraper)){
            if ($this->email_model->setSettings($_POST['settings']))
                showMessage('Настройки сохранены', 'Сообщение');
//            }else{
//                showMessage('Поле "Обвертка" должно содержать переменную <b>$content</b>', 'Ошибка', 'r');
//            }
        }
    }

    public function deleteVariable() {
        $template_id = $this->input->post('template_id');
        $variable = $this->input->post('variable');

        $this->email_model->deleteVariable($template_id, $variable);
    }

    public function updateVariable() {
        $template_id = $this->input->post('template_id');
        $variable = $this->input->post('variable');
        $variableNewValue = $this->input->post('variableValue');
        $oldVariable = $this->input->post('oldVariable');
        $this->email_model->updateVariable($template_id, $variable, $variableNewValue, $oldVariable);
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

}