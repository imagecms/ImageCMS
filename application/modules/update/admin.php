<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class Admin extends \ShopAdminController {

    function __construct() {
        parent::__construct();

        $this->serv_update = new \update\classes\serverUpdate();
    }

    public function index() {

        $sett = $this->serv_update->getSettings();
        if ($_POST) {
            $old_server = $sett['name_server'];
            $wsdl_path_old = $sett['wsdl_path'];

            $wsdl_path_new = strip_tags(trim($_POST['wsdl_path']));
            $s_name = strip_tags(trim($_POST['name_server']));

            if ($wsdl_path_old != $wsdl_path_new)
                copy($wsdl_path_old, $wsdl_path_new);

            $wsdl = file_get_contents($wsdl_path_old);

            $wsdl = str_replace($old_server, $s_name, $wsdl);
            $wsdl = str_replace($wsdl_path_old, $wsdl_path_new, $wsdl);

            file_put_contents($wsdl_path_new, $wsdl);

            $htacc = str_replace($wsdl_path_old, $wsdl_path_new, file_get_contents('.htaccess'));
            file_put_contents('.htaccess', $htacc);

            if ($wsdl_path_old != $wsdl_path_new)
                unlink($wsdl_path_old);

            $this->serv_update->setSettings($_POST);

            showMessage('Даные сохранены');
        } else {


            \CMSFactory\assetManager::create()
                    ->setData(array('data' => $sett))
                    ->renderAdmin('main', true);
        }
    }

    public function user_update() {


        $query = array();

        if ($dom = $_GET['domen'])
            $query[] = "domen like '$dom%'";

        if ($version = $_GET['version'])
            $query[] = "version like '$version%'";

        if ($query)
            $query = implode(' and ', $query);
        else
            $query = 1;

        if ($ord = $_GET['order'])
            $order = " order by $ord";
        else
            $order = " order by id";

        $sql = "select * from update_user where " . $query . $order;
        $user = $this->db->query($sql)->result_array();
        \CMSFactory\assetManager::create()
                ->registerScript('update')
                ->setData(array('user' => $user))
                ->renderAdmin('user_list', true);
    }

    public function delete_user() {
        $ids = $this->input->post('id');
        foreach (json_decode($ids) as $key)
            $this->db->query("delete from update_user where id = '$key'");
    }

    public function user_create() {

        if ($_POST) {

            $ver = $_POST['version'];
            if ($ver == 'premium' or $ver == 'pro') {
                $obj = new \update\classes\serverUpdate();
                $par = $obj->generateSymbol(100);
            }
            else
                $par = '';

            $dom = $this->input->post('domen');

            if (!$dom) {
                showMessage('введите домен сайта', false, 'r');
                exit();
            }

            $domen = $this->db->query("select * from update_user where domen = '$domen'")->row();
            if (!$domen->domen) {
                $this->db->query("insert into update_user(domen,`key`, version) values ('$dom','$par', '$ver')");
                showMessage('Даные сохранены');
            } else {
                showMessage('Домен уже существует', false, 'r');
            }
        } else {

            \CMSFactory\assetManager::create()
                    ->renderAdmin('user_create', true);
        }
    }

    public function file_update() {

        $query = array();

        if ($build = $_GET['build'])
            $query[] = "build_id like '$build%'";

        if ($version = $_GET['version'])
            $query[] = "version like '$version%'";

        if ($query)
            $query = implode(' and ', $query);
        else
            $query = 1;

        if ($ord = $_GET['order'])
            $order = " order by $ord";
        else
            $order = " order by id";



        $sql = "select * from update_file where " . $query . $order;

        $file = $this->db->query($sql)->result_array();
        \CMSFactory\assetManager::create()
                ->registerScript('update')
                ->setData(array('file' => $file))
                ->renderAdmin('file_list', true);
    }

    public function delete_file() {
        $ids = $this->input->post('id');
        foreach (json_decode($ids) as $key) {
            $file = $this->db->query("select * from update_file where id = '$key'")->row();
            if (file_exists($file->path_zip))
                unlink($file->path_zip);
            if (file_exists($file->path_hash))
                unlink($file->path_hash);

            $this->db->query("delete from update_file where id = '$key'");
        }
    }

    public function file_create() {

        if ($_POST) {


            $ver = $this->input->post('version');
            $build = $this->input->post('build_id');

            if (!$build) {
                showMessage('введити номер билда', false, 'r');
                exit();
            }



            $build_file = trim($build);
            $build_file = str_replace('.', '', $build_file);

            $time = time();



            if (!is_numeric($build_file)) {
                showMessage('в номере білда должни бить только цифри і точки', false, 'r');
                exit();
            }

            if (!$_FILES['path_zip']["tmp_name"] or !$_FILES['path_hash']["tmp_name"]) {
                showMessage('не вибраные файли', false, 'r');
                exit();
            }

            $path_zip = $_FILES['path_zip']['name'];
            $ext = pathinfo($path_zip, PATHINFO_EXTENSION);
            if ($ext != 'zip') {
                showMessage('файл не является zip архивом', false, 'r');
                exit();
            }
            $path_hash = $_FILES['path_hash']['name'];
            $ext = pathinfo($path_hash, PATHINFO_EXTENSION);
            if ($ext != 'txt') {
                showMessage('файл не является текстовим', false, 'r');
                exit();
            }

            $builder = $this->db->query("select * from update_file where build_id = '$build'")->row();
            if ($builder->build_id and $builder->version == $ver) {
                showMessage('даная сборка уже существует', false, 'r');
                exit();
            }
            $path_zip = 'update/' . $ver . '/' . $build_file . '.zip';
            $path_hash = 'update/' . $ver . '/' . $build_file . '_hash.txt';


            move_uploaded_file($_FILES["path_zip"]["tmp_name"], $path_zip);
            move_uploaded_file($_FILES["path_hash"]["tmp_name"], $path_hash);
            $sql = "insert into update_file(`time`,build_id,version,path_zip,path_hash) values('$time','$build','$ver','$path_zip','$path_hash')";
            $this->db->query($sql);

            showMessage('Даные сохранены');
        } else {

            \CMSFactory\assetManager::create()
                    ->renderAdmin('file_create', true);
        }
    }

}

/* End of file admin.php */
