<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Email Module Admin
 * @property email_model $email_model
 */
class Admin extends BaseAdminController {

    public function __construct() {
        parent::__construct();
        $this->load->model('email_model');
    }

    public function index() {
        $email = new Email();
        \CMSFactory\assetManager::create()
                ->setData('models', $email->email_model->getAllTemplates())
                ->renderAdmin('list');
    }

    public function settings() {
//        $email = new Email();
//        var_dumps($email->sendEmail('sheme4ko@mail.ru', 'my_patern'));

        \CMSFactory\assetManager::create()
                ->registerScript('email')
                ->registerStyle('style')
                ->setData('settings', $this->email_model->getSettings())
                ->renderAdmin('settings');
    }

    public function create() {
        if ($_POST) {
            $email = new Email();
            if ($email->create()) {

                showMessage("Шаблон создан");
                if ($this->input->post('action') == 'tomain')
                    pjax('/admin/components/cp/email/index');

                if ($this->input->post('action') == 'save')
                    pjax('/admin/components/cp/email/edit/' . $this->db->insert_id());
            }
            else {
                showMessage($email->errors, '', 'r');
            }
        }
        else
            \CMSFactory\assetManager::create()
                    ->registerScript('email')
                    ->setData('settings', $this->email_model->getSettings())
                    ->renderAdmin('create');
    }

    public function delete() {
        $email = new Email();
        $email->email_model->deleteTemplate($_POST['ids']);
    }

    public function edit($id) {
        if ($_POST) {
            $email = new Email();
            if ($email->edit($id)) {
                showMessage("Шаблон отредактирован");

                if ($this->input->post('action') == 'tomain')
                    pjax('/admin/components/cp/email/index');
            }
            else {
                showMessage($email->errors, '', 'r');
            }
        }
        else
            \CMSFactory\assetManager::create()
                    ->setData('model', $this->email_model->getTemplateById($id))
                    ->registerScript('email')
                    ->renderAdmin('edit');
    }

    /**
     * updare settings for email
     */
    public function update_settings() {
        if ($_POST) {
            $wraper = htmlentities($_POST['settings']['wraper']);
            if (strstr('$content', $wraper)) {
                if ($this->email_model->setSettings($_POST['settings']))
                    showMessage('Настройки сохранены', 'Сообщение');
            }else {
                showMessage('Поле "Обгортка" должно содержать переменную <b>$content</b>', 'Ошибка', 'r');
            }
        }
    }

}