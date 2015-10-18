<?php

use callbacks\Exceptions\ValidationException;
use CMSFactory\assetManager;

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Module Frame
 */
class Callbacks extends MY_Controller
{

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('callbacks');
    }

    /**
     * Render form and save callback
     *
     * @return void
     */
    public function index() {
        $this->load->library('Form_validation');
        if ($this->input->post()) {
            try {
                $success = $this->createFromPost();
                $this->session->set_flashdata('success_message', $success);
            } catch (ValidationException $e) {
                $success = false;
                $this->session->set_flashdata('success_message', $success);
            }
            redirect(site_url('/callbacks'));
        }

        assetManager::create()
            ->setData(['success' => $this->session->flashdata('success_message')])
            ->render('callback');
    }

    /**
     * Create new callback from $_POST data
     */
    public function createFromPost() {

        $this->load->library('Form_validation');

        $model = new SCallbacks;
        $this->form_validation->set_rules($model->rules());

        if (!$this->form_validation->run()) {
            throw new ValidationException(
                [
                'message' => validation_errors(),
                'errors' => $this->form_validation->getErrorsArray()
                ]
            );
        }

        $theme = SCallbackThemesQuery::create()->orderByPosition()->findOne();
        $status = SCallbackStatusesQuery::create()->filterByIsDefault(TRUE)->findOne();

        $model->fromArray($this->input->post());
        $model->setThemeId($theme ? $theme->getId() : 0);
        $model->setStatusId($status ? $status->getId() : 0);
        $model->setDate(time());
        $model->save();

        $this->sendEmail($model);
        CMSFactory\Events::create()->raiseEvent(['model' => $model], 'Shop:callback');
        return $this->getMessage();
    }

    /**
     * @todo move callback configs(success message etc.)
     *       from answer notifications && shop settings
     *       to own module configs
     *
     */
    protected function getMessage() {
        $notification = $this->db
            ->where('locale', \MY_Controller::getCurrentLocale())
            ->where('name', 'callback')->get('answer_notifications');
        if ($notification->num_rows() > 0) {
            return $notification->row()->message ?: true;
        }

    }

    protected function sendEmail(SCallbacks $callback) {
        $callback_variables = [
            'callbackStatus' => $callback->getSCallbackStatuses() ? $callback->getSCallbackStatuses()->getText() : '',
            'callbackTheme' => $callback->getSCallbackThemes() ? $callback->getSCallbackThemes()->getText() : '',
            'userName' => $callback->getName(),
            'userPhone' => $callback->getPhone(),
            'dateCreated' => date("d-m-Y H:i:s", $callback->getDate()),
            'userComment' => $callback->getComment()
        ];
        return \cmsemail\email::getInstance()->sendEmail($this->dx_auth->get_user_email(), 'callback', $callback_variables);
    }

}

/* End of file sample_module.php */