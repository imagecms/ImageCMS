<?php

namespace mobile\collection;

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @uses Products.BaseProducts
 * @author A.Gula <dev@imagecms.net>
 * @copyright (c) 2013, ImageCMS
 * @package Shop.ImageCMSModule
 */
class Mobile_product extends \Products\BaseProducts {

    protected static $_instance;

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->data['delivery_methods'] = \SDeliveryMethodsQuery::create()->find();
        $this->data['payments_methods'] = \SPaymentMethodsQuery::create()->find();

        $this->render($this->templateFile, $this->data);
    }

    /**
     * @return bool
     * @access public
     * @author Kaero
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    public static function init() {
        (null !== self::$_instance) OR self::$_instance = new self();
        return TRUE;
    }

}