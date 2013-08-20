<?php

class serverUpdate {

    public function __construct() {
        $this->ci = & get_instance();
        $this->ftp_connect();
    }

    public function get_host() {

        $url = parse_url($_SERVER['HTTP_REFERER']);
        $this->host = str_replace('www.', '', $url['host']);
        $this->host_www = 'www.' . $this->host;
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
        if ($this->select_lic() && $this->check_paid() && $this->check_key()) {
            ftp_put($this->conn_id, $this->ci->input->post('dir') . '/update', 'index.zip', FTP_BINARY);
            ftp_put($this->conn_id, $this->ci->input->post('dir') . '/update', 'hash.txt', FTP_BINARY);
            ftp_put($this->conn_id, $this->ci->input->post('dir') . '/update', 'db.sql', FTP_BINARY);
            return true;
        } else {
            echo 'Ваша лицензия не зарегистрирована';
            //записати даний домен як піратський
        }
    }
    
    //ajax 
    public function check_new_version() {
        

        
    }


    
    
    public function ftp_connect(){
        
        $this->conn_id = ftp_connect($this->ci->input->post('ftp'));
        ftp_login($this->conn_id, $this->ci->input->post('ftp_user'), $this->ci->input->post('ftp_pass'));
        
    }


}
