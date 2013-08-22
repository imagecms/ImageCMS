<?php

class serverUpdate {

    public $path_to_corp = 'update/Corporate/';
    public $path_to_pro = 'update/Pro/';
    public $path_to_prem = 'update/Premium/';

    public function __construct() {
        $this->ci = & get_instance();
    }

    public function getUpdateStatus($domen, $buildId) {

        $current_build_update = 4451235; // select from bd last build

        if ($buildId < $current_build_update)
            return 1;
        else
            return 0;
    }

    public function check_rule($domen, $careKey) {

        $sql = "select * from update_user where `key` = '$careKey' and domen = '$domen'";
        if ($this->ci->db->query($sql)->num_rows() > 0)
            return true;
        else
            return false;

        return true;
    }

    public function getHash($domen, $imagecmsNumber, $buildId, $careKey) {

        if (strstr($imagecmsNumber, 'Premium')) {
            if ($this->check_rule($domen, $careKey))
                return file_get_contents($this->path_to_prem . 'md5_pre.txt');
            else
                return json_encode(array(
                    'error' => 'Не верный ключ'
                ));
        }elseif (strstr($imagecmsNumber, 'Pro')) {
            if ($this->check_rule($domen, $careKey))
                return file_get_contents($this->path_to_pro . 'md5_pro.txt');
            else
                return json_encode(array(
                    'error' => 'Не верный ключ'
                ));
        }else {
            return file_get_contents($this->path_to_corp . 'md5_corp.txt');
        }
    }

    public function generateHref($version, $domen) {
        
        
        $href = $this->generateSymbol();
        $sql = "update update_user set href = '$href', active = 1, version = '$version' where domen = '$domen'";
        $this->ci->db->query($sql);
        return $href;
    }

    public function generateSymbol($length = 25) {
        $chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
        $numChars = strlen($chars);
        $string = '';
        for ($i = 0; $i < $length; $i++) {
            $string .= substr($chars, rand(1, $numChars) - 1, 1);
        }
        return $string;
    }

    public function put_file($href, $domen) {

        $sql = "select * from update_user where href = '$href' and domen = '$domen' and active = 1";
       
        if ($this->ci->db->query($sql)->num_rows() > 0) {
            $res = $this->ci->db->query($sql)->row();
            $this->ci->db->query("update update_user set active = 0 where domen = '$domen'");
            return $res->version;
        }
        else
            return false;
    }

    public function getUpdateFile($domen, $imagecmsNumber, $buildId, $careKey) {


        if (strstr($imagecmsNumber, 'Premium')) {
            if ($this->check_rule($domen, $careKey))
                return $this->generateHref('Premium', $domen);
            else
                return false;
        }elseif (strstr($imagecmsNumber, 'Pro')) {
            if ($this->check_rule($domen, $careKey))
                return $this->generateHref('Pro', $domen);
            else
                return false;
        }else {
            return $this->generateHref('Corporate', $domen);
        }
    }

}