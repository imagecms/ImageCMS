<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Admin Class Mobile version for Shop Module
 * @uses BaseAdminController
 * @author <dev@imagecms.net>
 * @copyright (c) 2013, ImageCMS
 * @package Shop.ImageCMSModule
 */
class Admin extends BaseAdminController {

    public function __construct() {
        parent::__construct();
    }

    /**
     * @author <dev@imagecms.net>
     * @copyright (c) 2013, ImageCMS
     */
    public function index() {
        \CMSFactory\assetManager::create()->renderAdmin('main');
    }

}