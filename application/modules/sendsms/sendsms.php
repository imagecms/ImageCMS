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
 */
class Sendsms extends MY_Controller {

    static $Stat;
    static $Exceptions;
    static $Account;
    static $Addressbook;

    public function __construct() {
        parent::__construct();

        include 'epochtasmsApi/config.php';
        include 'epochtasmsApi/Addressbook.php';
        include 'epochtasmsApi/Exceptions.php';
        include 'epochtasmsApi/Account.php';
        include 'epochtasmsApi/Stat.php';
        $sms_key_private = '010deb2628416432450a14b30577472d';
        $sms_key_public = '8007cd4a7dc247798adec2b109210404';
        $Gateway = new APISMS($sms_key_private, $sms_key_public, 'http://atompark.com/api/sms/');
        self::$Addressbook = new Addressbook($Gateway);
        self::$Exceptions = new Exceptions($Gateway);
        self::$Account = new Account($Gateway);
        self::$Stat = new Stat($Gateway);
//        $this->Stat = new Stat($Gateway);
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
        if ($data['order']->user_phone) {

            self::send_sms('заказ', $data['order']->user_phone);
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
        self::$Stat->sendSMS('budyak.net', 'text', $phone, $datetime, 0);
    }

    public function _install() {
        /** We recomend to use http://ellislab.com/codeigniter/user-guide/database/forge.html */
        /**
          $this->load->dbforge();

          $fields = array(
          'id' => array('type' => 'INT', 'constraint' => 11, 'auto_increment' => TRUE,),
          'name' => array('type' => 'VARCHAR', 'constraint' => 50,),
          'value' => array('type' => 'VARCHAR', 'constraint' => 100,)
          );

          $this->dbforge->add_key('id', TRUE);
          $this->dbforge->add_field($fields);
          $this->dbforge->create_table('mod_empty', TRUE);
         */
        /**
          $this->db->where('name', 'module_frame')
          ->update('components', array('autoload' => '1', 'enabled' => '1'));
         */
    }

    public function _deinstall() {
        /**
          $this->load->dbforge();
          $this->dbforge->drop_table('mod_empty');
         *
         */
    }

}

/* End of file Sendsms.php */
