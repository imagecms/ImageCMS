<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Module Frame
 */
class Digital_products extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('digital_products');
    }

    public function index() {
        
    }

    public static function adminAutoload() {
        \CMSFactory\Events::create()->on('ShopAdminProducts:preEdit')->setListener('_extendProductAdmin');
    }

    public function autoload() {
        if (!$this->input->is_ajax_request())
            \CMSFactory\assetManager::create()->registerScript('script');
    }

    public function _extendProductAdmin($data) {
        $model = $data['model'];

        \CMSFactory\assetManager::create()
                ->appendData('customAdminInterface', ShopCore::app()
                        ->CustomFieldsHelper
                        ->getCustomField(ShopCore::app()
                                ->SSettings
                                ->DPLinkCFID, 'product', $model
                                ->getId())
                        ->asAdminHtml());
    }

    public function get_link($identifier = null) {

        $outputData = array(
            'paid' => false,
        );

        if ($identifier) {
            $row = $this->db->select('custom_fields_data.field_data, shop_products.id')
                    ->where('url', $identifier)
                    ->join('custom_fields_data', 'custom_fields_data.entity_id = shop_products.id')
                    ->where('field_id', ShopCore::app()->SSettings->DPLinkCFID)
                    ->get('shop_products')
                    ->row();

            if ((bool) $row) {

                $order = $this->db->select('paid')
                        ->where('product_id', $row->id)
                        ->join('shop_orders_products', 'shop_orders_products.order_id = shop_orders.id')
                        ->where('user_id', $this->dx_auth->get_user_id())
                        ->get('shop_orders')
                        ->row();

                if ($order && $order->paid) {
                    $outputData['paid'] = true;
                    $outputData['link'] = $row->field_data;
                }
            }
        }

        \CMSFactory\assetManager::create()->setData($outputData)
                ->render('dl_block', true);
    }

    public function _install() {


        $this->db->where('name', 'digital_products')
                ->update('components', array('autoload' => '1', 'enabled' => '1'));


        $field = new CustomFields();

        $field->setEntity('Product')
                ->setIsActive(true)
                ->setname('dplink')
                ->setfLabel('Link to digital content')
                ->settypeId(3);

        $field->save();

        ShopCore::app()->SSettings->set('DPLinkCFID', $field->getId());

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
