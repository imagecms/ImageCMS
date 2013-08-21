<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Server_update  {
    
    public function __construct() {
        
    }
      

    function getPath($license, $upd_key) {
        
        $obj = new serverUpdate();
        $res = $obj->get_update($license, $upd_key);
        return serialize($_SERVER);

    }

    public function update() {

        ini_set("soap.wsdl_cache_enabled", "0");
        $server = new SoapServer("http://pftest.imagecms.net/application/modules/shop/admin/UpdateService.wsdl");
        $server->setClass('Server_update');
        $server->handle();
    }

}
