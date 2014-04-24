<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class Admin extends BaseAdminController {

    public function __construct() {
        $this->locale = MY_Controller::getCurrentLocale();
        $lang = new MY_Lang();
        $lang->load('exchangeunfu');
    }

    public function index() {
        $partners = $this->db->get('mod_exchangeunfu_partners');
        $periods = $this->db->get('mod_exchangeunfu_partners_periods')->result_array();



        foreach ($periods as $key => $value) {
            $period[$value['partner_id']][$value['type']] = $value['hour_from'] . '-' . $value['hour_to'];
        }

        if ($partners) {
            $partners = $partners->result_array();
        } else {
            $partners = array();
        }

        \CMSFactory\assetManager::create()
                ->registerScript('admin')
                ->setData('partners', $partners)
                ->setData('periods', $period)
                ->renderAdmin('partners');
    }

    public function updatePartner() {
        $name = $this->input->post('name');
        $code = $this->input->post('code');
        $prefix = $this->input->post('prefix');
        $region = $this->input->post('region');
        $partner_id = $this->input->post('partner_id');

        $this->db->where('id', $partner_id)
                ->update('mod_exchangeunfu_partners', array(
                    'name' => $name,
                    'prefix' => $prefix,
                    'region' => $region,
                    'code' => $code,
                    'external_id' => md5($name . $region)
        ));
    }

    public function updatePeriod() {

        foreach ($_POST['periods'] as $key => $value) {
            preg_match_all('/\d+/', $value, $hours);

            $this->db->query("INSERT INTO mod_exchangeunfu_partners_periods (`hour_from`, `hour_to`, `partner_id` , `type`) 
                         VALUES ('" . $hours[0][0] . "','" . $hours[0][1] . "', '" . $_POST['partnerId'] . "' ,'$key')
                         ON DUPLICATE KEY 
                         UPDATE `hour_from`= '" . $hours[0][0] . "', `hour_to` = '" . $hours[0][1] . "';");
        }

        return 1;
    }

    public function addPartner() {
        $name = $this->input->post('name');
        $code = $this->input->post('code');
        $prefix = $this->input->post('prefix');
        $region = $this->input->post('region');
        $count = $this->input->post('count');

        $result = $this->db->insert('mod_exchangeunfu_partners', array(
            'name' => $name,
            'prefix' => $prefix,
            'region' => $region,
            'code' => $code,
            'external_id' => ''
        ));

        if ($result) {
            $id = $this->db->insert_id();
            $partners = array(
                'name' => $name,
                'prefix' => $prefix,
                'region' => $region,
                'code' => $code,
                'id' => $id,
                'count' => (int) $count
            );

            \CMSFactory\assetManager::create()
                    ->setData('partner', $partners)
                    ->renderAdmin('onePartnerRow', true);
        } else {
            return FALSE;
        }
    }

    public function deletePartner() {
        $partner_id = $this->input->post('partner_id');
        return $this->db->where('id', $partner_id)->delete('mod_exchangeunfu_partners');
    }

    public function settings() {
        $settings = $this->get1CSettings();
        \CMSFactory\assetManager::create()->setData(array('settings' => $settings, 'statuses' => $this->get_orders_statuses()))
                ->renderAdmin('settings');
        $this->template->add_array(array('settings' => $settings, 'statuses' => $this->get_orders_statuses()));
    }

    private function get1CSettings() {
        $config = $this->db
                ->where('identif', 'exchangeunfu')
                ->get('components')
                ->row_array();
        if (empty($config))
            return false;
        else
            return unserialize($config['settings']);
    }

    private function get_orders_statuses() {
        return $this->db
                        ->query("SELECT * FROM `shop_order_statuses`
            JOIN `shop_order_statuses_i18n` ON shop_order_statuses.id=shop_order_statuses_i18n.id
            WHERE `locale`='" . $this->locale . "'")
                        ->result_array();
    }

    public function update_settings() {
        $for_update = $this->input->post('1CSettings');
        if ($for_update) {
            $this->load->library('form_validation');

            $config['login'] = $for_update['login'];
            $config['password'] = $for_update['password'];
            $config['usepassword'] = $for_update['usepassword'];
            $config['userstatuses_after'] = $for_update['userstatuses_after'];
            $config['userstatuses'] = $for_update['statuses'];
            $config['debug'] = $for_update['debug'];
            $config['email'] = $for_update['email'];
            $config['backup'] = $for_update['backup'];

            $this->db->where('identif', 'exchangeunfu')
                    ->update('components', array('settings' => serialize($config)));
            showMessage(lang('Settings saved', 'exchangeunfu'));
        }
    }

}

/* End of file admin.php */