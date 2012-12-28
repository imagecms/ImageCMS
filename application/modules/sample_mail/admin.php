<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed'); 

class Admin extends BaseAdminController {

    private $locale;

    public function __construct() {
        parent::__construct();

        //loading model for work with emails
        $this->load->model('email_model');

        $this->load->library('form_validation');
        $this->load->module('core');
        $this->locale = $this->core->def_lang[0]['identif'];
    }

    //creating new email template
     
     

    public function create() {
        if (empty($_POST)) {
            $this->render('create');
        } else {
            $this->form_validation->set_rules('mail_name', 'Название шаблона', 'required|xss_clean');
            $this->form_validation->set_rules('mail_theme', 'Тема шаблона', 'xss_clean');
            $this->form_validation->set_rules('sender_name', 'От кого', 'xss_clean');
            $this->form_validation->set_rules('from_email', 'От кого(email)', 'xss_clean|valid_email');
            $this->form_validation->set_rules('mail_text', 'Шаблон письма', 'xss_clean');
            if ($this->form_validation->run($this) == FALSE) {
                showMessage(validation_errors());
            } else {
                $data['name'] = $this->input->post('mail_name');
                $data['text'] = $this->input->post('mail_text');
                $data['settings']['theme'] = $this->input->post('mail_theme');
                $data['settings']['from'] = $this->input->post('sender_name');
                $data['settings']['from_email'] = $this->input->post('from_email');
                $data['settings']['variables'] = $this->input->post('mail_variables');
                $data['settings']['mail_type'] = $this->input->post('mail_type');
                $data['locale'] = $this->locale;
                $data['description'] = $this->input->post('mail_desc');
                $this->email_model->fromArray($data);
                showMessage("Шаблон создан");
                if ($this->input->post('action') == 'tomain')
                    pjax('/admin/components/cp/sample_mail/index');
            }
        }
    }

    // editing email template according to its name and locale

    public function edit($name, $locale = null) {
        if ($locale == null)
            $locale = ShopController::getCurrentLocale();
        if ($name != '') {
            $model = $this->email_model->getMailArray($name, $locale);
            if (empty($model))
                $model = $this->email_model->getMailArray($name, ShopController::getCurrentLocale());
        }
        $settings = unserialize($model['settings']);
        if (empty($_POST)) {
            $this->render('edit', array('model' => $model,
                'settings' => $settings,
                'languages' => ShopCore::$ci->cms_admin->get_langs(),
                'locale' => $locale,
            ));
        } else {
            $this->form_validation->set_rules('mail_name', 'Название шаблона', 'required|xss_clean');
            $this->form_validation->set_rules('mail_theme', 'Тема шаблона', 'xss_clean');
            $this->form_validation->set_rules('sender_name', 'От кого', 'xss_clean');
            $this->form_validation->set_rules('from_email', 'От кого(email)', 'xss_clean|valid_email');
            $this->form_validation->set_rules('mail_text', 'Шаблон письма', 'xss_clean');
            if ($this->form_validation->run($this) == FALSE) {
                showMessage(validation_errors());
            } else {
                $data['name'] = $this->input->post('mail_name');
                $data['text'] = $this->input->post('mail_text');
                $data['settings']['theme'] = $this->input->post('mail_theme');
                $data['settings']['from'] = $this->input->post('sender_name');
                $data['settings']['from_mail'] = $this->input->post('from_email');
                $data['settings']['variables'] = $this->input->post('mail_variables');
                $data['settings']['mail_type'] = $this->input->post('mail_type');
                $data['locale'] = $locale;
                $data['description'] = $this->input->post('mail_desc');
                $this->email_model->fromArray($data);
                showMessage("Шаблон успешно отредактирован");
                if ($this->input->post('action') == 'tomain')
                    pjax('/admin/components/cp/sample_mail/index');
            }
        }
    }

    public function render($viewName, array $data = array(), $return = false) {
        if (!empty($data))
            $this->template->add_array($data);
        $this->template->show('file:' . 'application/modules/sample_mail/templates/admin/' . $viewName);
        exit;
        if ($return === false)
            $this->template->show('file:' . 'application/modules/sample_mail/templates/admin/' . $viewName);
        else
            return $this->template->fetch('file:' . 'application/modules/sample_mail/templates/admin/' . $viewName);
    }

    public function index() {
        $locale = ShopController::getCurrentLocale();
        $models = $this->email_model->getList($locale);
        $this->render('list', array('models' => $models, 'locale' => $locale));
    }

    public function delete() {
        $names = $this->input->post('ids');
        if (count($names) > 0) {
            $this->email_model->delete($names);
            showMessage("Шаблоны удалены");
        } else {
            return false;
        }
    }

}
?>
