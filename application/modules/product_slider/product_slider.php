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
        if (!$this->input->is_ajax_request()) {
            \CMSFactory\assetManager::create()
                    ->setData('productSliderEnabled', true);
                    //->registerScript('script')
                   // ->registerScript('cloud-zoom.1.0.2.min')
                   // ->registerStyle('style');
            \CMSFactory\Events::create()->on('category:load')->setListener('loadAllProductWithoutPagina');
        }
    }

    public function loadAllProductWithoutPagina($data) {
        if (count($data['products']) > 0) {
            $where_in = array();
            foreach ($data['products'] as $p)
                $where_in[] = $p->getid();
        }
        $selectCriteria = new \Criteria();
        $selectCriteria->add(\SProductsPeer::ID, $where_in, Criteria::NOT_IN);
        $product_all = \SProductsQuery::create(null, $selectCriteria)->filterByActive(1)->filterByCategory($data['category'])->select(array('Id'))->find()->toArray();
        $ci = & get_instance();
         \CMSFactory\assetManager::create()->registerScript('script')
                    ->registerScript('cloud-zoom.1.0.2.min')
                    ->registerStyle('style');
        $ci->template->assign('product_all', $product_all);
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
        $this->db->where('name', 'product_slider')
                ->update('components', array('autoload' => '1', 'enabled' => '1'));
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
        $product = SProductsQuery::create()->joinWithI18n(MY_Controller::getCurrentLocale())
                ->filterById($id)
                ->findOne();

        $responseData = array();

        $result = $this->db->select('id')
                ->where('category_id', $product->getCategoryId())
                ->get('shop_products')
                ->result_array();

        $responseData['model'] = $product;

        \CMSFactory\assetManager::create()
                ->setData($responseData)
                ->render('product', true);
    }

    public function links($catId, $withoutIds = array(0)) {
        $ids = $this->db->select('id')
                ->where('category_id', $catId)
                ->where_not_in('id', $withoutIds)
                ->get('shop_products')
                ->result();

        $links = array();
        foreach ($ids as $id)
            $links[] = '<a class="various fancybox.ajax photo" href="/product_slider/show/' . $id->id . '" rel="productSlider">product-slider</a>';

        return $links;
    }

}

/* End of file sample_module.php */
