<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

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
        if (!extension_loaded('soap')) {
            exit;
        }

        ini_set("soap.wsdl_cache_enabled", "0");

        if (extension_loaded('soap')) {
            $array = $this->update->getStatus();
        }

        if ($array) {
            $data = array(
                'build' => $array['build_id'],
                'date' => date("Y-m-d", $array['time']),
                'size' => number_format($array['size'] / 1024 / 1024, 3),
                'newRelise' => 1,
            );
        } else {
            $data = array(
                'newRelise' => 0,
            );
        }

        $this->template->show('sys_update_info', FALSE, $data);
    }

    /**
     * initiate update process
     */
    public function do_update() {
        set_time_limit(99999999999999);
        $this->update->createBackUp();
        $this->update->getUpdate();
        $this->cache->delete_all();
//        $this->update->restoreFromZIP('./application/backups/updates.zip');
//        showMessage('Обновление успешно');
//        pjax('/admin');
    }

    public function update($sort_by = "create_date", $order = 'asc', $newRelise = false) {
        // Show upgrade window;
        $status = $this->update->getStatus();
        $result = $this->update->getHashSum();

//        $array = $this->update->parse_md5();
//        $diff = array_diff($array, $result);

        if (!$result['error'])
            $data = array(
                'filesCount' => count($result),
                'sort_by' => $sort_by,
                'order' => $order,
                'diff_files_dates' => $this->update->get_files_dates(),
                'diff_files' => $result,
                'restore_files' => $this->sort($this->update->restore_files_list(), $sort_by, $order),
                'new_version' => $status ? 1 : 0
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
            ShopCore::app()->SSettings->set("careKey", trim($this->input->post("careKey")));
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

    public function getQuerys($file = 'backup.sql') {
        $restore = file_get_contents($file);

        $string_query = rtrim($restore, "\n;");
        $array_query = explode(";\n", $string_query);
//        var_dump($array_query);

        echo json_encode($array_query);
    }

    public function Querys() {
//        foreach ($_POST['data'] as $query) {
//            if ($query) {
//                if (!$this->db->query($query)) {
//                    echo 'Невозможно виполнить запрос: <br>';
//                    var_dumps($query);
//                    return FALSE;
//                } else {
////                    echo 'ok';
////                    return TRUE;
//                }
//            }
//        }
//        echo $this->db->total_queries();
    }

}
