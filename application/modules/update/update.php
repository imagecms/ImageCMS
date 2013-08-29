<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class update {

    public function __construct() {
        
    }

    function getStatus($domen, $build_id, $imagecmsNumber) {
        $obj = new \update\classes\serverUpdate();
        $res = $obj->getUpdateStatus(str_replace('www.', '', $domen), $build_id, $imagecmsNumber);
        return $res;
    }

    function getHashSum($domen, $imagecmsNumber, $buildId, $careKey) {

        $obj = new \update\classes\serverUpdate();
        $res = $obj->getHash(str_replace('www.', '', $domen), $imagecmsNumber, $buildId, $careKey);
        return $res;
    }

    function getUpdate($domen, $imagecmsNumber, $careKey) {

        $obj = new \update\classes\serverUpdate();
        return $obj->getUpdateFile(str_replace('www.', '', $domen), $imagecmsNumber, $careKey);
    }

    public function takeUpdate($href, $domen, $imagecmsNumber, $buildId) {

        $obj = new \update\classes\serverUpdate();
        if ($data = $obj->put_file($href, str_replace('www.', '', $domen), $imagecmsNumber, $buildId)) 
            $this->send_file($data['path_zip']);
        
    }


    public function send_file($file) {

        if (file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . basename($file));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            ob_clean();
            flush();
            readfile($file);
            exit;
        }
    }

    public function updater() {

        $obj = new \update\classes\serverUpdate();
        $sett = $obj->getSettings();
        ini_set("soap.wsdl_cache_enabled", "0");
        $server = new SoapServer("http://" . $sett['name_server'] . "/" . $sett['wsdl_path']);
        $server->setClass('update');
        $server->handle();
    }

    public function _install() {

        $data = array(
            'wsdl_path' => 'application/modules/update/UpdateService.wsdl',
            'name_server' => 'imagecms.loc',
            'path_pro' => 'upadte/pro',
            'path_premium' => 'upadte/premium',
            'path_corp' => 'upadte/corp',
        );
        $sql = "update components set settings = '" . serialize($data) . "', enabled = 1 where name = 'update'";

        $ci = &get_instance();

        $ci->db->query($sql);

        $sql = "CREATE TABLE IF NOT EXISTS `update_user` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `domen` varchar(255) CHARACTER SET utf8 NOT NULL,
          `key` varchar(255) CHARACTER SET utf8,
          `href` varchar(255) CHARACTER SET utf8,
          `version` varchar(255) CHARACTER SET utf8,
          `active` int(1) NOT NULL DEFAULT 0,
          `time` int(12) NOT NULL,
          KEY `id` (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

        $ci->db->query($sql);

        $sql = "CREATE TABLE IF NOT EXISTS `update_file` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `build_id` varchar(255) CHARACTER SET utf8 NOT NULL,
          `time` varchar(255) CHARACTER SET utf8,
          `version` varchar(255) CHARACTER SET utf8,
          `path_zip` varchar(255) CHARACTER SET utf8,
          `path_hash` varchar(255) CHARACTER SET utf8,
          KEY `id` (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

        $ci->db->query($sql);
    }

    public function _deinstall() {

        $ci = &get_instance();
        $ci->db->query("drop table `update_file`");
        $ci->db->query("drop table `update_user`");
    }

}
