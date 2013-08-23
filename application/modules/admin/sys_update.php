<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @property CI_Input $input
 * @property CI_DB_active_record $db
 */
class Sys_update extends BaseAdminController {

    private $upgrade_server = 'http://imagecms.net/upgrades/';

    /**
     * instance of Update library
     * @var Update
     */
    private $update;

    public function __construct() {
        parent::__construct();
        $this->update = new Update();

        $this->load->library('lib_admin');
        $this->lib_admin->init_settings();
    }

    public function index() {
        if(!extension_loaded('soap')){
            exit;
        }

        ini_set("soap.wsdl_cache_enabled", "0");

        $array = $this->update->getStatus();
        if ($array) {
            $data = array(
                'build' => $array['build'],
                'date' => date("Y-m-d", $array['date']),
                'size' => $array['size'],
                'newRelise' => 1,
            );
        } else {
            $data = array(
                'newRelise' => 0,
            );
        }

        $this->template->show('sys_update_info', FALSE, $data);
    }

    public function do_update() {
        $this->update->getUpdate();
        $this->update->restoreFromZIP('./application/backups/updates.zip');
        pjax('/admin');
    }

    public function update($sort_by = "create_date", $order = 'asc') {
        // Show upgrade window;
        $result = $this->update->getHashSum();
        $array = $this->update->parse_md5();
        $diff = array_diff($array, $result);

        if (!$result['error'])
            $data = array(
                'filesCount' => count($diff),
                'sort_by' => $sort_by,
                'order' => $order,
                'diff_files_dates' => $this->update->get_files_dates(),
                'diff_files' => $diff,
                'restore_files' => $this->sort($this->update->restore_files_list(), $sort_by, $order)
            );
        else
            $data = array(
                'restore_files' => $this->sort($this->update->restore_files_list(), $sort_by, $order),
                'error' => $result['error']
            );
        $this->template->show('sys_update', FALSE, $data);
    }

    public function restore() {
        echo $this->update->restoreFromZIP($_POST['file_name']);
    }

    public function renderFile() {
        $file_path = $this->input->post('file_path');
        if (file_exists('.' . $file_path))
            echo htmlspecialchars(file_get_contents('.' . $file_path));
        else
            echo '';
    }

    public function properties() {
        if ($this->input->post("careKey")) {
            ShopCore::app()->SSettings->set("careKey", $this->input->post("careKey"));
        } else {
            $data = array(
                'careKey' => ShopCore::app()->SSettings->__get("careKey")
            );
            $this->template->show('sys_update_properties', FALSE, $data);
        }
    }

    public function get_license() {
        if (file_exists('application/modules/shop/license.key'))
            echo file_get_contents('application/modules/shop/license.key');
        else
            echo 0;
    }

    public function get_update() { // method controller's server's update
        ini_set("soap.wsdl_cache_enabled", "0");
        try {

            $client = new SoapClient("http://imagecms.loc/application/modules/shop/admin/UpdateService.wsdl");

            $domen = $_SERVER['SERVER_NAME'];

            $result = $client->getStatus($domen, BUILD_ID);
            var_dump($result);

            $key = 123456;
            $result = $client->getHashSum($domen, IMAGECMS_NUMBER, BUILD_ID, $key);
            $result = json_decode($result);
            if ($er = $result->error)
                echo $er;
            else {
                var_dump($result);
                $href = $client->getUpdate($domen, IMAGECMS_NUMBER, BUILD_ID, $key);
                $all_href = 'http://imagecms.loc/admin/server_update/takeUpdate/' . $href . '/' . $domen;
                echo $all_href;
                //file_put_contents('updates', file_get_contents($all_href));
            }
        } catch (SoapFault $exception) {
            echo $exception->getMessage();
        }
    }

    public function backup() {
        $this->update->createBackUp();
        redirect('/admin/sys_update/update');
    }

    public function sort($array, $sort_by, $order) {
        for ($i = 0; $i < count($array); $i++) {
            for ($y = ($i + 1); $y < count($array); $y++) {
                if ($order == 'asc') {
                    if ($array[$i][$sort_by] < $array[$y][$sort_by]) {
                        $c = $array[$i];
                        $array[$i] = $array[$y];
                        $array[$y] = $c;
                    }
                } else {
                    if ($array[$i][$sort_by] > $array[$y][$sort_by]) {
                        $c = $array[$i];
                        $array[$i] = $array[$y];
                        $array[$y] = $c;
                    }
                }
            }
        }
        return $array;
    }

    public function delete_backup($file_name) {
        echo unlink('./application/backups/' . $file_name);
    }

    public function test() { // method controller's server's update
        $obj = new serverUpdate();
        $mess = $obj->get_update();
        if ($mess !== TRUE)
            echo json_encode(array(
                'error' => 1,
                'mess' => $mess,
            ));
    }

}
