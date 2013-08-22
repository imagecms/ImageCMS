<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Server_update {

    public function __construct() {
        
    }

    function getStatus($domen, $build_id) {

        $obj = new serverUpdate();
        $res = $obj->getUpdateStatus($domen, $build_id);
        return $res;
    }

    function getHashSum($domen, $imagecmsNumber, $buildId, $careKey) {

        $obj = new serverUpdate();
        $res = $obj->getHash($domen, $imagecmsNumber, $buildId, $careKey);
        return $res;
    }

    function getUpdate($domen, $imagecmsNumber, $buildId, $careKey) {

        $ci = & get_instance();
        $ci->load->helper('download');

        $obj = new serverUpdate();
        return $obj->getUpdateFile($domen, $imagecmsNumber, $buildId, $careKey);

    }

    public function update() {

        ini_set("soap.wsdl_cache_enabled", "0");
        $server = new SoapServer("http://imagecms.loc/application/modules/shop/admin/UpdateService.wsdl");
        $server->setClass('Server_update');
        $server->handle();
    }

}
