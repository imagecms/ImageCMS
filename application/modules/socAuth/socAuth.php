<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 *
 * Класс редиректа удаленных товаров
 */
class socAuth extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->module('core');
    }

    public function index() {
        if ($_GET) {
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, "https://oauth.vk.com/access_token?client_id=3563096&client_secret=DQ8D5Teefu1QeI8a3pF2&code=$_GET[code]&redirect_uri=http://$_SERVER[HTTP_HOST]/socAuth");
            curl_setopt($curl, CURLOPT_HEADER, 0);
            curl_setopt($curl, CURLOPT_NOBODY, 0);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_USERAGENT, 'MSIE 9');
            curl_setopt($curl, CURLOPT_REFERER, "$_SERVER[HTTP_HOST]/socAuth");
            $res = curl_exec($curl);
            $res = json_decode($res);
            var_dumps($res);
            curl_close($curl);

            $curl = curl_init();         
            curl_setopt($curl, CURLOPT_URL, "https://api.vk.com/method/users.get?uids={$res->user_id}&fields=uid,first_name,last_name,nickname,screen_name,sex,bdate,city,country,timezone,photo&access_token={$res->access_token}");
            curl_setopt($curl, CURLOPT_HEADER, 0);
            curl_setopt($curl, CURLOPT_NOBODY, 0);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_USERAGENT, 'MSIE 9');
            curl_setopt($curl, CURLOPT_REFERER, "$_SERVER[HTTP_HOST]/socAuth");
            $res = curl_exec($curl);
            $res = json_decode($res);
            var_dumps($res);
            curl_close($curl);
        }
    }

    public function vk() {
        
    }

    public function google() {
        if ($_GET) {
            $postdata = array(
                'code' => $_GET[code],
                'client_id' => '722755574018-9593c79vgr7q4iloeusolf8fk0fa204j.apps.googleusercontent.com',
                'client_secret' => 't6hUxQEv0tHdrmfjYmsA_S6y',
                'redirect_uri' => 'http://ninjatest.imagecms.net/socAuth',
                'grant_type' => 'authorization_code'
            );

            $opts = array(
                'http' => array(
                    'method' => 'POST',
                    'header' => 'Content-type:application/x-www-form-urlencoded',
                    'content' => $postdata
                )
            );

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, 'https://accounts.google.com/o/oauth2/token');
            curl_setopt($curl, CURLOPT_HEADER, 0);
            curl_setopt($curl, CURLOPT_NOBODY, 0);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $postdata);
            curl_setopt($curl, CURLOPT_REFERER, "http://ninjatest.imagecms.net/socAuth");
            $res = curl_exec($curl);
            $res = json_decode($res);

            curl_close($curl);

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, 'https://www.googleapis.com/oauth2/v1/userinfo?access_token=' . $res->access_token);
            curl_setopt($curl, CURLOPT_HEADER, 0);
            curl_setopt($curl, CURLOPT_NOBODY, 0);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_USERAGENT, 'MSIE 9');
            curl_setopt($curl, CURLOPT_REFERER, "http://ninjatest.imagecms.net/socAuth");
            $res = curl_exec($curl);
            $res = json_decode($res);

            var_dumps($res->email);
            var_dumps($res->name);

            curl_close($curl);
        }
        else
            $this->core->error_404();
    }

    public function _install() {
//        $this->load->dbforge();
//        ($this->dx_auth->is_admin()) OR exit;
        /* $fields = array(
          'id' => array(
          'type' => 'INT',
          'auto_increment' => TRUE
          ),
          'trash_id' => array(
          'type' => 'VARCHAR',
          'constraint' => '255',
          'null' => TRUE,
          ),
          'trash_url' => array(
          'type' => 'VARCHAR',
          'constraint' => '255',
          'null' => TRUE,
          ),
          'trash_redirect_type' => array(
          'type' => 'VARCHAR',
          'constraint' => '20',
          'null' => TRUE,
          ),
          'trash_redirect' => array(
          'type' => 'VARCHAR',
          'constraint' => '255',
          'null' => TRUE,
          ),
          'trash_type' => array(
          'type' => 'VARCHAR',
          'constraint' => '3',
          'null' => TRUE,
          ),
          );

          $this->dbforge->add_field($fields);
          $this->dbforge->add_key('id', TRUE);
          $this->dbforge->create_table('trash'); */

//        $this->db->where('name', 'trash');
//        $this->db->update('components', array('enabled' => 0, 'autoload' => 1));
    }

    public function _deinstall() {
        $this->load->dbforge();
        ($this->dx_auth->is_admin()) OR exit;
        //$this->dbforge->drop_table('trash');
    }

}

/* End of file trash.php */