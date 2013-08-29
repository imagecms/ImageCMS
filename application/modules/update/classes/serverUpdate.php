<?php

namespace update\classes;

class serverUpdate extends \MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function select_version($imagecmsNumber) {

        if (strstr($imagecmsNumber, 'Premium')) {
            return 'premium';
        } elseif (strstr($imagecmsNumber, 'Professional')) {
            return 'pro';
        } else {
            return 'corp';
        }
    }

    public function check_rule($domen, $careKey, $version) {

        $sql = "select * from update_user where domen = '$domen'";
        $res = $this->db->query($sql)->row();
        if (count($res) > 0) {
            if ($res->key == $careKey and $res->version == $version)
                return true;
            else
                return false;
        }
        else
            return false;
    }

    public function message($domen, $imagecmsnum, $build) {

        $sql = "select * from update_user where domen = '$domen'";
        $res = $this->db->query($sql)->row();

        $ver = $this->select_version($imagecmsnum);
        if ($ver == 'pro' and $ver == 'premium' and !$res->domen) 
            $mess .= 'Ваш домен не внесен в базу даних. ';
        

        if ($ver == 'corp' and !$res->domen) 
            $mess .= 'Новий корпоративний домен. ';
        

        if ($res->domen and $res->version != $ver) 
            $mess .= 'Версия вашей системи не совпадает с версией сервера. ';
        

        $build = str_replace('.', '', $build);
        if (!is_numeric($build)) 
            $mess .= 'Не верний номер сборки вашего пакета. ';
        


        if ($mess)
            file_put_contents('application/modules/update/logs/' . $domen . '_' . time(), $mess);
    }

    public function getBuild($buildId, $version) {

        $sql = "select * from update_file where version = '$version'";
        $upd = $this->db->query($sql)->result_array();


        $buildId = $this->to_int($buildId);


        foreach ($upd as $key => $u) {
            $build_bd = $this->to_int($u['build_id']);
            if ($buildId >= $build_bd)
                unset($upd[$key]);
        }
        $min = 999999999999;
        if (count($upd)) {
            foreach ($upd as $key => $u) {
                $build_bd = $this->to_int($u['build_id']);
                if ($build_bd < $min) {
                    $min = $build_bd;
                    $key_min = $key;
                }
            }
            return $upd[$key_min];
        }
        else
            return false;
    }

    public function getUpdateStatus($domen, $buildId, $imagecmsNumber) {

        $this->message($domen, $imagecmsNumber, $buildId);

        $version = $this->select_version($imagecmsNumber);
        $data = $this->getBuild($buildId, $version);

        if ($data) {
            $size = stat($data['path_zip']);
            $data['size'] = $size['size'];
            unset($data['version']);
            unset($data['path_zip']);
            unset($data['path_hash']);
            return serialize($data);
        } else {
            return 0;
        }
    }

    public function getHash($domen, $imagecmsNumber, $buildId, $careKey) {

        $version = $this->select_version($imagecmsNumber);

        $data = $this->getBuild($buildId, $version);

        if ($version == 'pro' or $version == 'premium') {
            if ($this->check_rule($domen, $careKey, $version))
                return file_get_contents($data['path_hash']);
            else
                return json_encode(array(
                    'error' => 'Не верный ключ'
                ));
        }
        else
            return file_get_contents($data['path_hash']);
    }

    public function getUpdateFile($domen, $imagecmsNumber, $careKey) {


        $version = $this->select_version($imagecmsNumber);

        if ($version == 'pro' or $version == 'premium') {
            if ($this->check_rule($domen, $careKey, $version))
                return $this->generateHref($version, $domen);
            else
                return false;
        }
        else
            return $this->generateHref($version, $domen);
    }

    public function put_file($href, $domen, $imagecmsNumber, $buildId) {

        $version = $this->select_version($imagecmsNumber);
        $data = $this->getBuild($buildId, $version);

        $time = time();
        $sql = "select * from update_user where href = '$href' and domen = '$domen' and active = 1 and `time` >= '$time'";

        if ($this->db->query($sql)->num_rows() > 0) {
            $res = $this->db->query($sql)->row();
            $this->db->query("update update_user set active = 0 where domen = '$domen'");
            if ($res->version == $version)
                return $data;
            else
                return false;
        }
        else
            return false;
    }

    public function generateHref($version, $domen) {

        if ($version != 'premium' and $version != 'pro') {
            $dom = $this->db->query("select * from update_user where domen = '$domen'")->row();
            if (!$dom->domen)
                $this->db->query("insert into update_user (domen, version) values('$domen', '$version')");
        }

        $time = time() + 36000;
        $href = $this->generateSymbol();
        $sql = "update update_user set href = '$href', active = 1, `time` = '$time' where domen = '$domen'";
        $this->db->query($sql);
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

    public function getSettings() {

        $sett = $this->db->query("select settings from components where name = 'update'")->row();
        $sett = unserialize($sett->settings);
        return $sett;
    }

    public function setSettings($data) {

        $this->db->query("update components set settings = '" . serialize($data) . "' where name = 'update'");
    }

    public function to_int($b) {

        $buildId = str_replace('.', '', $b);
        $buildId = (int) $buildId;

        return $buildId;
    }

}