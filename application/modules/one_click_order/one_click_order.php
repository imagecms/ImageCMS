<?php

use CMSFactory\assetManager;
use CMSFactory\Events;
use mod_discount\Discount_product;

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * One click order
 * Usage
 * {echo $CI->load->module('one_click_order')->showButton($model->firstVariant->getId())}
 *
 *
 */
class One_click_order extends MY_Controller {

    protected $response;

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('one_click_order');
    }

    /**
     * @param $variantId
     * @return string
     */
    public function showButton($variantId) {
        return assetManager::create()
                        ->setData(['variant_id' => $variantId])
                        ->fetchTemplate('button');
    }

    public function make_order($variantId = false) {
        $variantId = $variantId ? : $this->input->post('variant_id');
        if ($this->input->post()) {
            $response = $this->validate();
            $productVariant = SProductVariantsQuery::create()
                    ->findOneById($variantId);

            if ($response['success'] && $productVariant) {
                $this->createOrder($productVariant);
                $response['message'] = lang("Order successfully created", 'one_click_order');
            } else {
                $response['success'] = false;
                $response['message'] = lang("Order error", 'one_click_order');
            }
            return $response;
        } else {
            assetManager::create()
                    ->setData(['variant_id' => $variantId])
                    ->render('form', true);
        }
    }

    protected function createOrder(SProductVariants $productVariant) {

        $userName = $this->input->post('name');
        $userPhone = $this->input->post('phone');
        $userEmail = $this->dx_auth->get_user_email() ? : null;
        $userId = $this->dx_auth->get_user_id() ? : null;
        $userIp = $this->input->ip_address() ? : null;

        $orderProducts = new SOrderProducts();
        $orderProducts->setVariantId($productVariant->getId())
            ->setProductId($productVariant->getProductId())
            ->setProductName($productVariant->getSProducts()->getName())
            ->setVariantName($productVariant->getName())
            ->setPrice($productVariant->getPrice() - $this->getProductDiscount($productVariant))
            ->setQuantity(1)
            ->setOriginPrice($productVariant->getPrice());

        $order = new SOrders();
        $order->setKey(createOrderCode())
            ->setStatus(1)
            ->setPaid(false)
            ->setUserComment(lang('One click order'))
            ->setUserFullName($userName)
            ->setUserEmail($userEmail)
            ->setUserIp($userIp)
            ->setUserId($userId)
            ->setUserPhone($userPhone)
            ->setDateCreated(time())
            ->setDateUpdated(time())
            ->setDiscount($this->getDiscount($productVariant) ? : null)
            ->setTotalPrice($productVariant->getPrice() - $this->getDiscount($productVariant))
            ->setOriginPrice($productVariant->getPrice())
            ->addSOrderProducts($orderProducts);
        $order->save();

        $orderStatus = new SOrderStatusHistory();
        $orderStatus->setOrderId($order->getId())
            ->setStatusId(1)
            ->setUserId($userId)
            ->setDateCreated(time())
            ->setComment("")
            ->save();
        Events::create()->raiseEvent(['order' => $order, 'price' => $order->getTotalPrice()], 'Cart:MakeOrder');
    }

    protected function validate() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', lang("Name", "one_click_order"), 'required');
        $this->form_validation->set_rules('phone', lang("Phone", "one_click_order"), 'required|phone');
        $this->form_validation->set_rules('variant_id', lang("Product variant", "one_click_order"), 'required');
        $response = ['success' => true];
        if (!$this->form_validation->run()) {
            $response = $this->form_validation->getErrorsArray();
            $response['success'] = false;
        }
        return $response;
    }

    protected function getDiscount(SProductVariants $variant) {
        if (count($this->db->where('name', 'mod_discount')->get('components')->result_array()) != 0) {

            $productDiscount = $this->getProductDiscount($variant);
            $noProductDiscount = $this->getNoProductDiscount($variant);

            return $productDiscount > $noProductDiscount ? $productDiscount : $noProductDiscount;
        }
    }

    protected function getProductDiscount(SProductVariants $variant) {

        $arr_for_discount = [
            'product_id' => $variant->getSProducts()->getId(),
            'category_id' => $variant->getSProducts()->getCategoryId(),
            'brand_id' => $variant->getSProducts()->getBrandId(),
            'vid' => $variant->getId(),
            'id' => $variant->getSProducts()->getid()
        ];
        assetManager::create()->discount = 0;

        Discount_product::create()->getProductDiscount($arr_for_discount);
        $discount = assetManager::create()->discount;
        return isset($discount['discount_value']) ? $discount['discount_value'] : 0;
    }

    protected function getNoProductDiscount(SProductVariants $variant) {
        $user_id = $this->dx_auth->get_user_id();
        $option = [
            'price' => $variant->getPrice(),
            'userId' => $user_id,
            'ignoreCart' => 1,
            'reBuild' => 1
        ];

        $discount = $this->load->module('mod_discount/discount_api')->getDiscount($option, TRUE);
        return isset($discount['sum_discount_no_product']) ? $discount['sum_discount_no_product'] : 0;
    }

}

/* End of file sample_module.php */