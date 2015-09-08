<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Related_products controller
 * @property Related_products_model $related_products_model
 */
class Related_products extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('related_products');
        $this->load->model('related_products_model');
    }

    public static function adminAutoload() {
        \CMSFactory\Events::create()
                ->onShopProductPreUpdate()
                ->setListener('_extendPageAdmin');

        \CMSFactory\Events::create()
                ->onShopProductUpdate()
                ->setListener('_extendPageAdmin');
    }

    /**
     * Extend products admin page
     * @param array $data
     */
    public static function _extendPageAdmin($data) {
        $ci = & get_instance();
        $lang = new MY_Lang();
        $lang->load('related_products');
        include_once 'models/related_products_model.php';
        $related_products_model = new Related_products_model();

        if ($_POST) {
            $post = $ci->input->post('related_products');
            if ($data['model']) {
                $main_product_id = $data['model']->getId();
                $related_products_model->saveProducts($main_product_id, $post['products']);
            }
        } else {
            $related_products = $related_products_model->getProducts($data['model']->getId());
            $view = \CMSFactory\assetManager::create()
                    ->setData(
                        array(
                        'related_products' => $related_products,
                        'product' => $data['model']
                        )
                    )
                    ->registerScript('scripts')
                    ->fetchAdminTemplate('products_extend');

            \CMSFactory\assetManager::create()
                    ->appendData('moduleAdditions', $view);
        }
    }

    /**
     * Get related products array
     * @param int $product_id - main product id
     *
     * Use in template to show:
     * {echo $CI->load->module('related_products')->getRelatedProducts($product_id)}
     *
     * @return array
     */
    public function getRelatedProducts($product_id) {
        if ($product_id) {
            $related_products = $this->related_products_model->getProducts($product_id);
            $customHelper = new CustomFieldsHelper();

            foreach ($related_products as $key => $product) {
                $data = $customHelper->getCustomFielsdAsArray('product', $product->getId());

                $customFields = array();
                foreach ($data as $customField) {
                    $customFields[$customField['field_name']] = $customField;
                }
                $related_products[$key]->customFields = $customFields;
            }
            return $related_products;
        }
        return array();
    }

    /**
     * Render related products tpl
     * @param int $product_id - main product id
     * @param string $tpl - template name
     *
     * Use in template to show:
     * {echo $CI->load->module('related_products')->show($product_id)}
     *
     * @return string
     */
    public function show($product_id, $tpl = 'related_products') {
        if ($product_id) {
            $related_products = $this->getRelatedProducts($product_id);

            if (count($related_products)) {
                $view = \CMSFactory\assetManager::create()
                        ->setData(
                            array(
                            'related_products' => $related_products
                            )
                        )
                        ->fetchTemplate($tpl);

                return $view;
            }
        }
        return '';
    }

    /**
     * Render related products tpl with color custom field
     * @param int $product_id - main product id
     * @param string $tpl - template name
     *
     * Use in template to show:
     * {echo $CI->load->module('related_products')->showByColorCustomField($product_id)}
     *
     * @return string
     */
    public function showByColorCustomField($product_id, $tpl = 'color_custom_field') {
        return $this->show($product_id, $tpl);
    }

    public function index() {
        $this->core->error_404();
    }

    public function autoload() {

    }

    public function _install() {
        $this->related_products_model->install();
    }

    public function _deinstall() {
        $this->related_products_model->deinstall();
    }

}

/* End of file sample_module.php */