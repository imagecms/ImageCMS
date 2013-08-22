<?php

class serverUpdate {

    public $path_to_corp = '';
    public $path_to_pro = '';
    public $path_to_prem = '';

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
        /*
        $sql = "select from update_key where key = '$careKey' and domen = '$domen'";
        if ($this->ci->db->query($sql)->num_rows() > 0)
            return true;
        else
            return false;
         * 
         * 
         */
        return true;
    }

    public function getHash($domen, $imagecmsNumber, $buildId, $careKey) {

        if (strstr($imagecmsNumber, 'Premium')) {
            if ($this->check_rule($domen, $careKey))
                return file_get_contents($this->path_to_prem . '/md5_prem.txt');
            else
                return json_encode(array(
                    'error' => 'Не верный ключ'
                ));
        }elseif (strstr($imagecmsNumber, 'Pro')) {
            if ($this->check_rule($domen, $careKey))
                return file_get_contents($this->path_to_pro . '/md5_pro.txt');
            else
                return json_encode(array(
                    'error' => 'Не верный ключ'
                ));
        }else {
            return file_get_contents($this->path_to_corp . '/md5_corp.txt');
        }
    }
    
    public function generatePremHref(){
        
    }
    public function generateProHref(){
        
    }
    public function generateCorpHref(){
        
    }

    public function getUpdateFile($domen, $imagecmsNumber, $buildId, $careKey) {
        

        if (strstr($imagecmsNumber, 'Premium')) {
            if ($this->check_rule($domen, $careKey))
                return $this->generatePremHref();
            else
                return false;
        }elseif (strstr($imagecmsNumber, 'Pro')) {
            if ($this->check_rule($domen, $careKey))
                return $this->generateProHref();
            else
                return false;
        }else {
            return $this->generateCorpHref();
        }
    }

}