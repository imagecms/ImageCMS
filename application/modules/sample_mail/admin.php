<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @property Sample_mail_model $sample_mail_model
 * @property Cms_admin $cms_admin
 */
class Admin extends BaseAdminController {

    private $locale;

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('sample_mail');

        //loading model for work with emails
        $this->load->model('sample_mail_model');

        $this->load->library('form_validation');
        $this->load->module('core');
        $this->locale = $this->core->def_lang[0]['identif'];
    }

    //creating new email template



    public function create() {
        if (empty($_POST)) {
            $this->render('create');
        } else {
            $this->form_validation->set_rules('mail_name', lang('Template name'), 'required|xss_clean');
            $this->form_validation->set_rules('mail_theme', lang('Tempalate theme'), 'xss_clean');
            $this->form_validation->set_rules('sender_name', lang('From'), 'xss_clean');
            $this->form_validation->set_rules('from_email', lang('From (email)'), 'xss_clean|valid_email');
            $this->form_validation->set_rules('mail_text', lang('Message template'), 'xss_clean');
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
                $this->sample_mail_model->fromArray($data);
                showMessage(lang('Template created'));
                if ($this->input->post('action') == 'tomain')
                    pjax('/admin/components/cp/sample_mail/index');
            }
        }
    }

    // editing email template according to its name and locale

    public function edit($name, $locale = null) {
        if ($locale == null)
            $locale = MY_Controller::getCurrentLocale();
        if ($name != '') {
            $model = $this->sample_mail_model->getMailArray($name, $locale);
            if (empty($model))
                $model = $this->sample_mail_model->getMailArray($name, MY_Controller::getCurrentLocale());
        }
        $settings = unserialize($model['settings']);
        if (empty($_POST)) {
            $this->render('edit', array('model' => $model,
                'settings' => $settings,
                'languages' => $this->cms_admin->get_langs(),
                'locale' => $locale,
            ));
        } else {
            $this->form_validation->set_rules('mail_name', lang('Template name'), 'required|xss_clean');
            $this->form_validation->set_rules('mail_theme', lang('Tempalate theme'), 'xss_clean');
            $this->form_validation->set_rules('sender_name', lang('From'), 'xss_clean');
            $this->form_validation->set_rules('from_email', lang('From (email)'), 'xss_clean|valid_email');
            $this->form_validation->set_rules('mail_text', lang('Message template'), 'xss_clean');
            if ($this->form_validation->run($this) == FALSE) {
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
                    $this->sample_mail_model->fromArray($data);
                    showMessage(lang('Template successfully edited'));
                    if ($this->input->post('action') == 'tomain')
                        pjax('/admin/components/cp/sample_mail/index');
                }
            }
        }
    }

    public function render($viewName, array $data = array(), $return = false) {
        if (!empty($data))
            $this->template->add_array($data);
        $this->template->show('file:' . 'application/' . getModContDirName('sample_mail') . '/sample_mail/templates/admin/' . $viewName);
        exit;
        if ($return === false)
            $this->template->show('file:' . 'application/' . getModContDirName('sample_mail') . '/sample_mail/templates/admin/' . $viewName);
        else
            return $this->template->fetch('file:' . 'application/' . getModContDirName('sample_mail') . '/sample_mail/templates/admin/' . $viewName);
    }

    public function index() {
        $locale = MY_Controller::getCurrentLocale();
        $models = $this->sample_mail_model->getList($locale);
        $this->render('list', array('models' => $models, 'locale' => $locale));
    }

    public function delete() {
        $names = $this->input->post('ids');
        if (count($names) > 0) {
            $this->sample_mail_model->delete($names);
            showMessage(lang('Templates deleted'));
        } else {
            return false;
        }
    }

}

?>
