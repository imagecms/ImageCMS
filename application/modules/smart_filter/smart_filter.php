<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Module Frame
 */
class Smart_filter extends \Category\BaseCategory {

    public function __construct() {
        if ($this->uri->segments[2] == 'category' || $this->uri->segments[2] == 'filter' || $this->uri->segments[2] == 'pre_filter') {
            parent::__construct();
            $lang = new MY_Lang();
            $lang->load('smart_filter');
        }
    }

    public function index() {
        //parent::index();
        //parent::__CMSCore__();
        return true;
//
//
//        if ($this->input->is_ajax_request())
//        else
    }

    public function init() {

        $this->set_price();

        return \CMSFactory\assetManager::create()
                        ->registerScript('jquery.ui-slider', TRUE)
                        ->registerScript('filter', TRUE)
                        ->render('main', true);
    }

    public function filter() {

        $this->set_price();



        return \CMSFactory\assetManager::create()
                        ->setData($this->data)
                        ->render('filter', true);
    }

    public function set_price() {
        $minPrice = (int) $this->data['priceRange']['minCost'];
        $maxPrice = (int) $this->data['priceRange']['maxCost'];

        $curMin = $_GET['lp'] ? (int) $_GET['lp'] : $minPrice;
        $curMax = $_GET['rp'] ? (int) $_GET['rp'] : $maxPrice;


        \CMSFactory\assetManager::create()->setData(array(
            'minPrice' => (int) $this->data['priceRange']['minCost'],
            'maxPrice' => (int) $this->data['priceRange']['maxCost'],
            'curMax' => $curMax,
            'curMin' => $curMin
        ));
    }
    
    
    public function pre_filter(){
        $property = $this->data['propertiesInCat'];
        $brand = $this->data['brands'];
        echo json_encode(array('prop' =>$property, 'brand' => $brand));
    }

//    public function ()

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
          $this->db->where('name', 'smart_filter')
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

}

/* End of file sample_module.php */
