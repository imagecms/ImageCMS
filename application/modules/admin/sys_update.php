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

    public function index() {
        // Show upgrade window;
        $update = new Update();
        $old = $update->getOldMD5File();
        $array = $update->parse_md5();
//        var_dump($array);
//        var_dump($old);
        $diff = array_diff($array, $old);
//        var_dumps($diff);
        $update->add_to_ZIP($diff);
//        var_dump(write_file('md5.txt', json_encode($update->parse_md5())));
//        echo json_encode($update->parse_md5());
//        $update->formXml();
//        $update->sendData();

//        $update->restoreFromZIP();

        $this->template->assign('files_dbs', $update->restore_db_files_list());
//        $this->template->add_array('files_dbs', $update->restore_db_files_list());

        $this->template->show('sys_update', FALSE);
    }

    public function restore_db($file_name){
        $this->update->db_restore($file_name);
    }

}
