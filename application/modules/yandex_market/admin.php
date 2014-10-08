<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Admin Class for Yandex.Market module
 * @uses BaseAdminController
 * @author L.Andriy <a.skavronskiy@imagecms.net>
 * @copyright (c) 2014, ImageCMS
 * @package ImageCMSModule
 */
class Admin extends BaseAdminController {

        function __construct() {
            parent::__construct();
        }
        public function index() {
         
            \CMSFactory\assetManager::create()
                     ->renderAdmin('list');
        }
        
        public function update() {
        //Yandex market settings
        if($_POST['displayedCats']){
                $this->db->set('value', serialize($this->input->post('displayedCats')));
                $this->db->where('id', 1);
                $this->db->update('mod_yandex_market'); 
          
        }else{
                $this->db->set('value', '');
                $this->db->where('id', 1);
                $this->db->update('mod_yandex_market'); 
        }
        
        if($_POST['yandex']['isAdult']){
                $this->db->set('value', 1);
                $this->db->where('id', 1);
                $this->db->update('mod_yandex_market_adalt'); 

        }else{
                $this->db->set('value', 0);
                $this->db->where('id', 1);
                $this->db->update('mod_yandex_market_adalt');
        }
   }
   

        public function IsAdult() {
            $this->db->select('value');
            $this->db->where('id', 1); 
            $query = $this->db->get('mod_yandex_market_adalt');
                return $query->row_array();
        } 
        
        public function getSelectedCats()
        {
            $this->db->select('value');
            $this->db->where('id', 1); 
            $query = $this->db->get('mod_yandex_market');
            $arr = $query->row_array();
            $arr = unserialize($arr['value']);
                return $arr;
        }        

}
/* End of file admin.php */
