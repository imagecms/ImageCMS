<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Module Frame
 */
class Product_slider extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {

    }

    public function autoload() {
        
    }

    public function _install() {
        /** We recomend to use http://ellislab.com/codeigniter/user-guide/database/forge.html */
        /**
          $this->load->dbforge();

          $fields = array(
          'id' => array('type' => 'INT', 'constraint' => 11, 'auto_increment' => TRUE,),
          'name' => array('type' => 'VARCHAR', 'constraint' => 50,),
          'value' => array('type' => 'VARCHAR', 'constraint' => 100,)
          );

          $this->dbforge->add_key('id', TRUE);
          $this->dbforge->add_field($fields);
          $this->dbforge->create_table('mod_empty', TRUE);
         */
        /**
          $this->db->where('name', 'module_frame')
          ->update('components', array('autoload' => '1', 'enabled' => '1'));
         */
    }

    public function _deinstall() {
        /**
          $this->load->dbforge();
          $this->dbforge->drop_table('mod_empty');
         *
         */
    }
    
    public function show($id) {

        $id = (int) $id;
        $product = SProductsQuery::create()
                ->filterById($id)
                ->findOne();
        
        $responseData = array();
        
        $result = $this->db->select('id')
                ->where('category_id', $product->getCategoryId())
                ->get('shop_products')
                ->result_array();
        
        $ids = array();
        foreach ($result as $item)
            $ids[] = $item['id'];
        
        $key = array_search($id, $ids);
        $responseData['product'] = $product;
        $responseData['prevId']  = $ids[$key-1];
        $responseData['nextId']  = $ids[$key+1];
        
        echo \CMSFactory\assetManager::create()
                ->setData($responseData)
                ->render('product', true);
    }

}

/* End of file sample_module.php */
