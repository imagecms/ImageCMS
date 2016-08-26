<?php

use CMSFactory\assetManager;

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Sample Module Admin
 *
 */
class Admin extends BaseAdminController
{

    protected $url = 'admin/components/cp/custom_scripts';

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('custom_scripts');
    }

    public function index() {
        $model = $this->load->model('Custom_scripts_model');

        if ($this->input->post()) {
            $model->saveScript(-1, $this->input->post('header'));
            $model->saveScript(1, $this->input->post('body'));
            showMessage(lang('Saved', 'admin'), lang('Success', 'admin'));
        } else {
            assetManager::create()
                ->setData(
                    [
                     'headerScript' => $model->getScript(-1),
                     'bodyScript'   => $model->getScript(1),
                    ]
                )
                ->renderAdmin('main', false);

        }

    }

}