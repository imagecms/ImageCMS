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

        //return $domen . ' '  . $imagecmsNumber . ' '  . $buildId . ' '  . $careKey;
        $obj = new serverUpdate();
        $res = $obj->getHash($domen, $imagecmsNumber, $buildId, $careKey);
        return $res;
    }

    function getUpdate($domen, $imagecmsNumber, $buildId, $careKey) {

        $obj = new serverUpdate();
        return $obj->getUpdateFile($domen, $imagecmsNumber, $buildId, $careKey);
    }

    public function takeUpdate($href, $domen) {

        $obj = new serverUpdate();
        if ($ver = $obj->put_file($href,$domen)){
            //echo 'update/' . $ver . '/' .$ver . '.zip';
            $this->send_file('update/' . $ver . '/' .$ver . '.zip');
        }
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

    public function update() {

//        echo $this->getHashSum($domen, $imagecmsNumber, $buildId, $careKey);
//        exit;
        ini_set("soap.wsdl_cache_enabled", "0");
        $server = new SoapServer("http://imagecms.loc/application/modules/shop/admin/UpdateService.wsdl");
        $server->setClass('Server_update');
        $server->handle();
    }

}
