<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS 
 * Sendsms Module Admin
 * @author Gula Andriw <a.gula@imagecms.net>
 * @property Addressbook $Addressbook
 * @property Exceptions $Exceptions 
 * @property Account $Account
 * @property Stat $Stat
 * 
 * @property Sendsms_model $sendsms_model
 */
class Sendsms extends MY_Controller {

    static $Stat;
    static $Exceptions;
    static $Account;
    static $Addressbook;
    static $Settings;
    static $Name;

    public function __construct() {
        parent::__construct();
        $this->load->model('sendsms_model');

        $settings = $this->sendsms_model->getApiSettings();
        self::$Name = $settings['sms_company_name'];

        $locale = MY_Controller::getCurrentLocale();
        self::$Settings = $this->sendsms_model->getTemplates($locale);

        include 'epochtasmsApi/config.php';
        include 'epochtasmsApi/Addressbook.php';
        include 'epochtasmsApi/Exceptions.php';
        include 'epochtasmsApi/Account.php';
        include 'epochtasmsApi/Stat.php';

        $sms_key_private = $settings['sms_key_private'];
        $sms_key_public = $settings['sms_key_public'];

        $Gateway = new APISMS($sms_key_private, $sms_key_public, 'http://atompark.com/api/sms/');
        self::$Addressbook = new Addressbook($Gateway);
        self::$Exceptions = new Exceptions($Gateway);
        self::$Account = new Account($Gateway);
        self::$Stat = new Stat($Gateway);
    }

    public function index() {
        $this->core->error_404();
    }

    public function autoload() {
        \CMSFactory\Events::create()->onShopMakeOrder()->setListener('shop_order');
    }

    public static function adminAutoload() {
        parent::adminAutoload();
    }

    public static function shop_order($data) {
        /* @var $order SOrders */
        $order = $data['order'];
        $text = str_replace(array('%id', '%user_id%', '%key%', '%user_full_name%', '%user_email%', '%user_phone%', '%user_deliver_to%'), array($order->getId(), $order->getUserId(), $order->getKey(), $order->getUserFullName(), $order->getUserEmail(), $order->getUserPhone(), $order->getUserDeliverTo()), self::$Settings['orderTemplate']);
        if ($data['order']->user_phone) {
            $locale = MY_Controller::getCurrentLocale();
            self::send_sms($text, $data['order']->user_phone);
        }
    }

    /**
     * s
     * @param type $text
     * @param type $phone
     */
    private static function send_sms($text, $phone) {
        $phone = str_replace(array('+', '(', ')', ' ', '-'), '', $phone);
        $phone = '38' . preg_replace('/^38/', '', $phone, -1, $count);
        self::$Stat->sendSMS(self::$Name, $text, $phone, $datetime, 0);
    }

    public function _install() {

        $sql = "CREATE TABLE IF NOT EXISTS `mod_sendsms` (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `locale` varchar(5) DEFAULT NULL,
                    `settings` text DEFAULT NULL,
                    PRIMARY KEY (`id`)
                    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

        $this->db->query($sql);

        $this->db
                ->where('name', 'mod_sendsms')
                ->update('components', array('autoload' => 1, 'in_menu' => 1));
        return TRUE;
    }

    public function _deinstall() {
        $sql = "DROP TABLE `mod_sendsms`;";
        $this->db->query($sql);
        return TRUE;
    }

}

/* End of file Sendsms.php */
