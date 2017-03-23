<?php

/**
 * @property Lib_admin lib_admin
 */
class BaseAdminController extends MY_Controller
{

    /**
     * @var string
     */
    public static $currentLocale;

    /**
     * @var bool
     */
    private static $adminAutoLoaded = false;

    public function __construct() {
        parent::__construct();

        $lang = new MY_Lang();
        $lang->load('admin');

        $this->load->library('Permitions');
        if (PHP_SAPI != 'cli') {
            Permitions::checkPermitions();
        }

        $this->load->library('lib_admin');
        $this->lib_admin->init_settings();
        \CMSFactory\AdminLoader::getInstance()->adminAutoload();
    }

}