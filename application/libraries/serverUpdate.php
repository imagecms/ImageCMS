<?php

class serverUpdate {

    public function __construct() {
        $this->ci = & get_instance();
    }

    public function get_host() {

        $url = parse_url($_SERVER['HTTP_REFERER']);
        $this->host = str_replace('www.', '', $url['host']);
        $this->host_www = 'www.' . $this->host;
    }

    public function change_shop() {
        /*
        $ch = curl_init($this->host_www . '/shop/cart');
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $res = curl_exec($ch);
        if (strstr($res, 'HTTP/1.1 200 OK'))
            $this->shop = true;
        curl_close($ch);
         * 
         */
        $this->shop = false;
    }

    public function select_lic() {

        $sql = "select * from licenses where domain = '$host' or domain = '$host_www'";
        $this->query = $this->ci->db->query($sql);
        if ($this->query->num_rows() == 1) {

            $this->row = $this->query->row();
            return true;
        }
        else
            return false;
    }

    public function check_paid() {
        if ($this->row->paid)
            return true;
        else
            return false;
    }

    public function check_key() {
        if ($this->ci->input->post('key') && $this->ci->input->post('key') == $this->row->key)
            return true;
        else
            return false;
    }

    //ajax 
    public function get_update() {

        $this->get_host();
        $this->change_shop();
        
        if (!$this->shop) {
            $this->upload_corporate();
            return true;
        } else {
            if ($this->select_lic() && $this->check_paid() && $this->check_key()) {
                $this->upload_shop();
                return true;
            } else {
                $sql = "insert into pirate(domen) values('" . $this->host . "')";
                $this->ci->db->query($sql);
                return 'Ваша лицензия не зарегистрирована!';
                
            }
        }
    }


    public function post_file($data) {
        $url = "http://pftest.imagecms.net/shop/test/server";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($ch);
        return $response;
    }

    /*
     */
    public function upload_corporate() {

        $this->post_file(array(
            'Filedata1' => '@index.php',
            'Filedata2' => '@history.txt',
            //'Filedata3' => '@',
        ));

    }

    public function upload_shop() {
        
        $this->post_file(array(
            'Filedata1' => '@history.txt',
            'Filedata2' => '@index.php',
            //'Filedata3' => '@',
        ));


    }

    //ajax 
    public function check_new_version() {
        
    }
}