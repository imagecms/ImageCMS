<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Module Frame
 */
class Mod_promocode extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('mod_promocode');
    }

    public function index() {

    }

    public function autoload() {
        \CMSFactory\Events::create()->onProfileApiChangeInfo()->setListener('_setRegister');
        \CMSFactory\Events::create()->onAuthUserRegister()->setListener('_setRegisterPost');
    }

    public function _setRegisterPost($param) {
        $ci =& get_instance();
        $id_custom_field = $ci->db->where('identif', 'mod_promocode')->get('components')->row()->settings;
        if (!$id_custom_field) {
            return false;
        }

        $dataDisc = $ci->db->where('value', $_POST['custom_field'][$id_custom_field])->get('mod_promocode')->row();

        if (!$dataDisc) {
            return false;
        }
        $id = $dataDisc->id;
        $percent = $dataDisc->disc;

        $disc = $ci->db->where('name', $_POST['email'])->get('mod_shop_discounts_i18n')->row()->id;

        if ($disc) {
            return false;
        }
        $userId = $ci->db->where('email', $_POST['email'])->get('users')->row()->id;

        $ci->db->insert(
            'mod_shop_discounts',
            array(
            'key' => (string) time().rand(1, 99),
            'active' => 1,
            'date_begin' => time(),
            'date_end' => 0,
            'type_value' => 1,
            'value' => $percent, //TODO
            'type_discount' => 'user')
        );

        $last = $ci->db->order_by('id', 'desc')->get('mod_shop_discounts')->row()->id;

        $ci->db->insert('mod_shop_discounts_i18n', array('id' => $last, 'locale' => \MY_Controller::getCurrentLocale(), 'name' => $_POST['email']));
        $ci->db->insert('mod_discount_user', array('user_id' => $userId, 'discount_id' => $last));

        $ci->db->where('id', $id)->delete('mod_promocode');

    }

    public function _setRegister($param) {
        $ci =& get_instance();
        $id_custom_field = $ci->db->where('identif', 'mod_promocode')->get('components')->row()->settings;
        if (!$id_custom_field) {
            return false;
        }

        $field_data = $ci->db->where('field_id', $id_custom_field)->where('entity_id', $param['model']->getId())->get('custom_fields_data')->row()->field_data;
        if (!$field_data) {
            return false;
        }

        $dataDisc = $ci->db->where('value', $field_data)->get('mod_promocode')->row();

        if (!$dataDisc) {
            return false;
        }
        $id = $dataDisc->id;
        $percent = $dataDisc->disc;

        $disc = $ci->db->where('name', $param['model']->email)->get('mod_shop_discounts_i18n')->row()->id;

        if ($disc) {
            return false;
        }

        $ci->db->insert(
            'mod_shop_discounts',
            array(
            'key' => (string) time().rand(1, 99),
            'active' => 1,
            'date_begin' => time(),
            'date_end' => 0,
            'type_value' => 1,
            'value' => $percent, //TODO
            'type_discount' => 'user')
        );

        $last = $ci->db->order_by('id', 'desc')->get('mod_shop_discounts')->row()->id;

        $ci->db->insert('mod_shop_discounts_i18n', array('id' => $last, 'locale' => \MY_Controller::getCurrentLocale(), 'name' => $param['model']->email));
        $ci->db->insert('mod_discount_user', array('user_id' => $param['model']->getId(), 'discount_id' => $last));

        $ci->db->where('id', $id)->delete('mod_promocode');

    }

    public function checkPromocodeFront($customId) {
        $ci =& get_instance();
        $id_custom_field = $ci->db->where('identif', 'mod_promocode')->get('components')->row()->settings;
        if (!$id_custom_field) {
            return false;
        }

        if ($id_custom_field == $customId) {
            $disc = $ci->db->where('name', $ci->dx_auth->get_user_email())->get('mod_shop_discounts_i18n')->row()->id;
            if ($disc) {
                return true;
            }else{
                return false;
            }
        }
        return false;
    }

    public function _install() {
          $this->load->dbforge();

          $fields = array(
          'id' => array('type' => 'INT', 'constraint' => 11, 'auto_increment' => TRUE,),
          'value' => array('type' => 'VARCHAR', 'constraint' => 100,),
          'disc' => array('type' => 'int', 'constraint' => 3,)
          );

          $this->dbforge->add_key('id', TRUE);
          $this->dbforge->add_field($fields);
          $this->dbforge->create_table('mod_promocode', TRUE);

          $this->db->where('name', 'mod_promocode')
              ->update('components', array('autoload' => '1', 'enabled' => '1'));

    }

    public function _deinstall() {
          $this->load->dbforge();
          $this->dbforge->drop_table('mod_promocode');
    }

}

/* End of file sample_module.php */