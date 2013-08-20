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

        $ch = curl_init($this->host_www . '/shop/cart');
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $res = curl_exec($ch);
        if (strstr($res, 'HTTP/1.1 200 OK'))
            $this->shop = true;
        curl_close($ch);
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
                return 'Ваша лицензия не зарегистрирована!';
                //записати даний домен як піратський
            }
        }
    }

    public function upload_corporate() {

        ftp_put($this->conn_id, '/update', 'index.zip', FTP_BINARY);
        ftp_put($this->conn_id, '/update', 'hash.txt', FTP_BINARY);
        ftp_put($this->conn_id, '/update', 'db.sql', FTP_BINARY);
    }
    
    public function upload_shop() {

        ftp_put($this->conn_id, '/update', 'index.zip', FTP_BINARY);
        ftp_put($this->conn_id, '/update', 'hash.txt', FTP_BINARY);
        ftp_put($this->conn_id, '/update', 'db.sql', FTP_BINARY);
    }

    //ajax 
    public function check_new_version() {
        
    }

    public function ftp_connect() {

        $this->conn_id = ftp_connect($this->ci->input->post('ftp'));
        $login_result = ftp_login($this->conn_id, $this->ci->input->post('ftp_user'), $this->ci->input->post('ftp_pass'));

        if ((!$this->conn_id ) || (!$login_result))
            return 'Не удалось установить соединение с FTP сервером!';
        else
            return TRUE;
    }

}
