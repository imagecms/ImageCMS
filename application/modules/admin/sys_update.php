<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//error_reporting(0);

class Sys_update extends BaseAdminController {

    private $upgrade_server = 'http://imagecms.net/upgrades/';
    private $update;

    public function __construct() {
        parent::__construct();
        $this->update = new Update();

        $this->load->library('lib_admin');
        $this->lib_admin->init_settings();
    }

    public function index($sort_by = "create_date", $order = 'asc') {
        // Show upgrade window;
        $old = $this->update->getOldMD5File();
        $array = $this->update->parse_md5();
//        var_dumps($array);
//        var_dumps($old);
        $diff = array_diff($array, $old);
//        var_dumps($diff);
//         $this->update->add_to_ZIP($diff);
//        var_dump(write_file('md5.txt', json_encode( $this->update->parse_md5())));
//        echo json_encode( $this->update->parse_md5());
//        $this->update->formXml();
//        $this->update->sendData();
//        $this->update->restoreFromZIP();
//        $this->update->checkForVersion();
//        $this->update->sendData();

        $this->template->assign('sort_by', $sort_by);
        $this->template->assign('order', $order);
        $this->template->assign('diff_files_dates', $this->update->get_files_dates());
        $this->template->assign('diff_files', $diff);
        $this->template->assign('restore_files', $this->sort($this->update->restore_db_files_list(), $sort_by, $order));
//        $this->template->add_array('files_dbs', $a->restore_db_files_list());
        $this->template->show('sys_update', FALSE);
    }

    public function restore($file_name) {
        echo $this->update->restoreFromZIP($file_name);
    }

    public function renderFile(){
        $file_path = $this->input->post('file_path');
         if (file_exists('.' . $file_path))
            echo htmlspecialchars(file_get_contents('.' . $file_path));
        else
            echo '';
    }

    public function get_license() {
        if (file_exists('application/modules/shop/license.key'))
            echo file_get_contents('application/modules/shop/license.key');
        else
            echo 0;
    }

    public function take_file() {
        move_uploaded_file($_FILES['Filedata1']['tmp_name'], 'uploads/file_1');
        move_uploaded_file($_FILES['Filedata2']['tmp_name'], 'uploads/file_11');
        //move_uploaded_file($_FILES['Filedata3']['tmp_name'], 'uploads/file_111');
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

    public function delete_backup($file_name){
//        echo unlink('./application/backups/' . $file_name);
    }
//    public function test() { // method controller's server's update
//
//        $obj = new serverUpdate();
//        $mess = $obj->get_update();
//        if ($mess !== TRUE)
//            echo json_encode(array(
//                'error' => 1,
//                'mess' => $mess,
//            ));
//    }
}
