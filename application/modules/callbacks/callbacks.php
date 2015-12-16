<?php

use callbacks\Exceptions\ValidationException;
use cmsemail\email;
use CMSFactory\assetManager;
use Propel\Runtime\Exception\PropelException;

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Callbacks
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

        $this->core->set_meta_tags(lang('Callback', 'callback'));
        $this->load->library('Form_validation');
        if ($this->input->post()) {
            try {
                $success = $this->createFromPost();
            } catch (ValidationException $e) {
                $success = false;
            }
            if (!$this->input->is_ajax_request()) {
                $this->session->set_flashdata('success_message', $success);
                redirect(site_url('/callbacks'));
            }
        }

        $message = isset($success) ? $success : $this->session->flashdata('success_message');

        assetManager::create()
            ->setData(['success' => $message])
            ->render('callback');
    }

    /**
     * Create new callback from $_POST data
     * @return string
     * @throws ValidationException
     * @throws PropelException
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
     * @return string
     */
    protected function getMessage() {

        $notification = $this->db
            ->where('locale', \MY_Controller::getCurrentLocale())
            ->where('name', 'callback')->get('answer_notifications');

        return $notification->num_rows() > 0 ? $notification->row()->message : '';
    }

    /**
     * @param SCallbacks $callback
     * @return bool
     */
    protected function sendEmail(SCallbacks $callback) {

        $callback_variables = [
            'callbackStatus' => $callback->getSCallbackStatuses() ? $callback->getSCallbackStatuses()->getText() : '',
            'callbackTheme' => $callback->getSCallbackThemes() ? $callback->getSCallbackThemes()->getText() : '',
            'userName' => $callback->getName(),
            'userPhone' => $callback->getPhone(),
            'dateCreated' => date("d-m-Y H:i:s", $callback->getDate()),
            'userComment' => $callback->getComment()
        ];
        return email::getInstance()->sendEmail($this->dx_auth->get_user_email(), 'callback', $callback_variables);
    }

}

/* End of file callbacks.php */