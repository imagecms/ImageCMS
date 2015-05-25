<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sys_update extends BaseAdminController {

    /**
     * instance of Update library
     * @var Update
     */
    private $update;

    public function __construct() {
        if (!extension_loaded('soap')) {
            showMessage(lang('PHP SOAP extension is not installed'), '', 'r');
            pjax('/admin');
        }
        parent::__construct();
        $this->update = new Update();

        $this->load->library('lib_admin');
        $this->lib_admin->init_settings();
        ini_set("soap.wsdl_cache_enabled", "0");
    }

    public function index() {
        if (!file_exists('md5.txt')) {
            write_file('md5.txt', json_encode($this->update->parse_md5()));
        }

        if (extension_loaded('soap')) {
            $array = $this->update->getStatus();
        }

        if ($array) {
            $data = array(
                'build' => $array['build_id'],
                'date' => date("Y-m-d", $array['time']),
                'size' => number_format($array['size'] / 1024 / 1024, 3),
                'newRelise' => TRUE,
            );
        } else {
            $data = array(
                'newRelise' => FALSE,
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
        $this->update->restoreFromZIP(BACKUPFOLDER . 'updates.zip');
    }

    public function update($sort_by = "create_date", $order = 'asc') {
        // Show upgrade window;
        $status = $this->update->getStatus();
        $result = $this->update->getHashSum();

        if (!$result['error']) {
            $data = array(
                'filesCount' => count($result),
                'sort_by' => $sort_by,
                'order' => $order,
                'diff_files_dates' => $this->update->get_files_dates(),
                'diff_files' => $result,
                'restore_files' => $this->sort($this->update->restore_files_list(), $sort_by, $order),
                'new_version' => $status ? TRUE : FALSE
            );
        } else {
            $data = array(
                'restore_files' => $this->sort($this->update->restore_files_list(), $sort_by, $order),
                'error' => $result['error']
            );
//            showMessage($result['error'], 'Ошибка', 'r');
        }
        $this->template->show('sys_update', FALSE, $data);
    }

    public function restore() {
        echo $this->update->restoreFromZIP($_POST['file_name']);
    }

    public function renderFile() {
        $file_path = $this->input->post('file_path');
        if (file_exists('.' . $file_path)) {
            echo htmlspecialchars(file_get_contents('.' . $file_path));
        } else {
            echo '';
        }
    }

    public function properties() {
        if ($this->input->post()) {
            if ($this->update->setSettings(array("careKey" => trim($this->input->post("careKey"))))) {
                showMessage(lang('Changes saved', 'admin'));
            } else {
                showMessage(lang('Changes not saved', 'admin'), lang('Error', 'admin'), 'r');
            }
        } else {
            $data = array(
                'careKey' => $this->update->getSettings('careKey')
            );
            $this->template->show('sys_update_properties', FALSE, $data);
        }
    }

    public function get_license() {
        if (false === $shopPath = getModulePath('shop')) {
            echo 0;
            return;
        }
        $licenseFile = $shopPath . 'license.key';
        if (!file_exists($licenseFile)) {
            echo 0;
            return;
        }
        echo file_get_contents($licenseFile);
    }

    public function backup() {
        $this->update->createBackUp();
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
        echo unlink(BACKUPFOLDER . $file_name);
    }

    public function getQuerys($file = 'backup.sql') {
        $restore = file_get_contents($file);

        $string_query = rtrim($restore, "\n;");
        $array_query = explode(";\n", $string_query);

        echo json_encode($array_query);
    }

    public function Querys() {
        foreach ($_POST['data'] as $query) {
            if ($query) {
                if (!$this->db->query($query)) {
                    echo 'Невозможно виполнить запрос: <br>';
                    return FALSE;
                } else {
//                    echo 'ok';
//                    return TRUE;
                }
            }
        }
        echo $this->db->total_queries();
    }

}
