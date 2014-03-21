<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS 
 * Sample Module Admin
 */
class Admin extends BaseAdminController {

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('sample_module');
    }

    public function index() {
        /** Для начала соберем уже сохраненную информацию з таблицы */
        $settings = $this->db->get('mod_sample_settings')->result();
        /** И соберем её в массив для передачи у вид (шаблон) */
        foreach ($settings as $item)
            $data[$item->name] = $item->value;

        /** Класс для управления шаблоном */
        \CMSFactory\assetManager::create()
                ->setData($data)
                ->renderAdmin('settings');
    }

    public function updateSettings() {
        $this->db->update('mod_sample_settings', array('value' => $this->input->post('mailTo')), array('name' => 'mailTo'));
        $this->db->update('mod_sample_settings', array('value' => $this->input->post('useEmailNotification')), array('name' => 'useEmailNotification'));
        $this->db->update('mod_sample_settings', array('value' => $this->input->post('key')), array('name' => 'key'));
        showMessage(lang('Settings saved', 'sample_module'));

        if ($_POST['action'] == 'back') {
            pjax('/admin/components/modules_table');
        }
    }

}