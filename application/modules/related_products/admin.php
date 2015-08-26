<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Related_products Module Admin
 */
class Admin extends BaseAdminController {

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('related_products');
        $this->load->model('related_products_model');
    }

    public function index() {
        $this->core->error_404();
    }

    /**
     * Get products autocomplete
     * @param type $type
     */
    public function ajaxGetProductList($type = NULL) {
        $products = new SProductsQuery;
        $main_product_id = (int)$this->input->get('product_id');
        $search_forbidden = $this->related_products_model->getRelatedProdyctsIds($main_product_id);
        $search_forbidden[] = $main_product_id;

        if (!empty(ShopCore::$_GET['term'])) {
            $text = ShopCore::$_GET['term'];
            if (!strpos($text, '%'))
                $text = '%' . $text . '%';
            if ($type != 'number') {
                $products = $products
                    ->filterById(ShopCore::$_GET['term'])
                    ->_or()
                    ->useI18nQuery(MY_Controller::defaultLocale())
                    ->filterByName('%' . ShopCore::$_GET['term'] . '%')
                    ->endUse()
                    ->_or()
                    ->useProductVariantQuery()
                    ->filterByNumber('%' . ShopCore::$_GET['term'] . '%')
                    ->endUse();
            } else {
                $products = $products
                    ->useProductVariantQuery()
                    ->filterByNumber('%' . ShopCore::$_GET['term'] . '%')
                    ->endUse();
            }
        }

        $products = $products->distinct()->find();

        foreach ($products as $key => $product) {
            if (!in_array($product->getId(), $search_forbidden)) {
                $name = $product->getName();
                $lable = ShopCore::encode($product->getId() . ' - ' . $name . '(' . $product->getNumber() . ')');
                $response[] = array(
                    'label' => $lable,
                    'name' => ShopCore::encode($product->getName()),
                    'id' => $product->getId(),
                    'fronturl' => site_url('shop/product') . '/' . $product->getUrl(),
                    'adminurl' => site_url('admin/components/run/shop/products/edit') . '/' . $product->getId(),
                    'value' => $product->getId(),
                    'category' => $product->getCategoryId(),
                    'cs' => \Currency\Currency::create()->getSymbol(),
                );
            }
        }

        echo json_encode($response);
    }

    public function ajaxGetProduct() {
        $productId = $this->input->post('productId');
        $product = SProductsQuery::create()->joinWithI18n(MY_Controller::defaultLocale())->findOneById($productId);

        \CMSFactory\assetManager::create()
            ->setData('product', $product)
            ->renderAdmin('oneProductBlock');
    }

}
