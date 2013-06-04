<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Module Frame
 */
class Settings_additional extends MY_Controller {



    public function __construct() {
        parent::__construct();


        $this->load->module('core');
    }
    
    public function index(){
        
    }
    
    public function autoload() {
        $ci = & get_instance();
        
        if ($settings = $this->_get_settings_()){       
            $subStyle = $settings['substyle'];
            $this->template->assign('subStyle', $subStyle);
        }
        if (!$ci->input->is_ajax_request()) 
            \CMSFactory\assetManager::create()->registerScript('webinger_scripts');
        
        
        
        
         
    }
    
    public static function adminAutoload() {
        \CMSFactory\Events::create()->on('ShopAdminProducts:preEdit')->setListener('loadProductParametr');
        
    }
    
    public function loadProductParametr($data){
        
        $ci = & get_instance();
        $model = $data['model'];
        
        $parametr = $ci->db->query("select * from shop_product_variants 
                                                left join product_variant_paramert on product_variant_paramert.id = shop_product_variants.id 
                                                join shop_product_variants_i18n on shop_product_variants_i18n.id = shop_product_variants.id
                                                where shop_product_variants_i18n.locale = '" . MY_Controller::getCurrentLocale() . "'
                                                      and shop_product_variants.product_id = '" . $model->getid() . "'")->result_array();
            if (count($parametr) > 0){                                             
                $buffer = \CMSFactory\assetManager::create()->setData(array('parametr' => $parametr))->registerScript('script')->fetchTemplate('product_parametr');
                \CMSFactory\assetManager::create()->appendData('moduleAdditions', $buffer);                
            }
                
    }
    
    public function ProductOn(){
        $ci = & get_instance();
        $id = (int)$this->input->post('id');
        $status = ($this->input->post('status')) === 'false' ? 1 : 0;
        $sql_is = "select * from product_variant_paramert where id = '$id'";
        $sql = count($ci->db->query($sql_is)->result_array()) > 0 ? "update `product_variant_paramert` set `on` = '$status' where `id` = '$id'" : "INSERT INTO `product_variant_paramert`(`id`, `on`, `in_stock`) VALUES ('$id','$status','0')";
        $ci->db->query($sql);

        
    }
    public function InStock(){
        $ci = & get_instance();
        $id = (int)$this->input->post('id');
        $status = ($this->input->post('status')) === 'false' ? 1 : 0;
        $sql_is = "select * from product_variant_paramert where id = '$id'";
        $sql = count($ci->db->query($sql_is)->result_array()) > 0 ? "update `product_variant_paramert` set `in_stock` = '$status' where `id` = '$id'" : "INSERT INTO `product_variant_paramert`(`id`, `on`, `in_stock`) VALUES ('$id','0','$status')";
        $ci->db->query($sql);

        
    }
    
    protected function _get_settings_(){
        
        $this->db->where('name','settings_additional');
        $sett = $this->db->get('components')->result_array();
        if (count($sett) > 0)
            return unserialize($sett[0]['settings']);
        else             
            return false;
            
        
    }


    public function _install() {

        
          $this->db->where('name', 'settings_additional')
          ->update('components', array('autoload' => '1', 'enabled' => '1'));
    }

    public function _deinstall() {

    }


}

/* End of file sample_module.php */
