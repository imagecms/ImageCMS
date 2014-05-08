<?php

namespace mod_discount\classes;

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * 
 */
class ApplyChecker {

    private static $instance;
    private $allDiscount;
    private $cartItems;
    private $appliesLeft;

    private function __construct() {
        $this->allDiscount = \mod_discount\classes\BaseDiscount::create()->allDiscount;
        $cartItems = \Cart\BaseCart::getInstance()->getItems();
        $this->cartItems = $cartItems['data'];
        $this->appliesLeft = $this->appliesLeftAll();
    }

    private function __clone() {
        ;
    }

    /**
     * 
     * @return ApplyChecker
     */
    public static function getInstance() {
        if (is_null(self::$instance)) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function getApplyOverloadInfo() {
        $applies = array();
        foreach ($this->cartItems as $item) {
            if (!isset($applies[$item->discountKey])) {
                $applies[$item->discountKey] = 0;
            }
            $applies[$item->discountKey] += $item->quantity;
        }
        $typesNames = \mod_discount\classes\BaseDiscount::getDiscountsLabels();
        $overloadedDiscounts = array();
        foreach ($applies as $discountKey => $appliesCount) {
            if ($appliesCount > $this->appliesLeft[$discountKey]) {
                $dName = $typesNames[$this->getDiscountField($discountKey, 'type_discount')];
                if (!empty($dName))
                    $overloadedDiscounts[$dName] = $leftApplies;
            }
        }
        return $overloadedDiscounts;
    }

    public function changeCartItemsOveralPrice() {
        $appliesLeft = $this->appliesLeftAll();
        $discountApplies = array();
        foreach ($this->cartItems as $key => $item) {
            if (is_null($item->discountKey)) {
                continue;
            }

            if ($item->quantity > $appliesLeft[$item->discountKey]) {
                $withDiscount = $item->price * $appliesLeft[$item->discountKey];
                $diff = $item->quantity - $appliesLeft[$item->discountKey];
                $withoutDiscount = $item->originPrice * $diff;
                $this->cartItems[$key]->overallPrice = $withoutDiscount + $withDiscount;
            }

            $appliesLeft[$item->discountKey] -= $item->quantity;
            if ($appliesLeft[$item->discountKey] < 0) {
                $appliesLeft[$item->discountKey] = 0;
            }
        }
    }

    // 4 = 11 - 7
    // 
    private function appliesLeftAll() {
        $appliesLeft = array();
        foreach ($this->allDiscount as $row) {
            $appliesLeft[$row['key']] = $row['max_apply'] - $row['count_apply'];
        }
        return $appliesLeft;
    }

    private function getDiscountField($key, $fieldName) {
        foreach ($this->allDiscount as $row) {
            if ($row['key'] == $key) {
                return $row[$fieldName];
            }
        }
        return false;
    }

    /**
     * Returns the number of uses of discounts (only in cart) (grouped by key of discounts)
     * @return array array(discountKey => array(productId => quantity in cart))
     */
    public function getAppliesCart() {
        $cartItems = \Cart\BaseCart::getInstance()->getItems('SProducts');
        $discountQuantities = array();
        foreach ($cartItems['data'] as $item) {
            if (is_null($item->discountKey)) {
                continue;
            }

            if (!isset($discountQuantities[$item->discountKey])) {
                $discountQuantities[$item->discountKey] = array();
            }

            $discountQuantities[$item->discountKey][] = array(
                'productId' => $item->id,
                'quantity' => $item->quantity,
                'price' => $item->price,
                'originPrice' => $item->originPrice,
            );
        }
        return $discountQuantities;
    }

    /**
     * 
     * @param type $discountCounts
     * @return type
     */
    public function getAppliesOverloadDifference() {
        $discountCounts = $this->getAppliesCart();
        $dTypes = BaseDiscount::create()->allDiscount;
        $overload = 0;
        foreach ($dTypes as $discount) {
            $key = $discount['key'];
            if (isset($discountCounts[$key]) && $discount['max_apply'] > 0) {
                $appliesLeftDB = $discount['max_apply'] - $discount['count_apply'];
                $currentDiscountApplies = 0;
                $currentDiscountOverload = 0;
                foreach ($discountCounts[$key] as $product) {
                    $currentDiscountApplies += $product['quantity'];
                    if ($currentDiscountApplies > $appliesLeftDB && $product['originPrice'] > $product['price']) {
                        $count = $currentDiscountApplies - $appliesLeftDB;
                        $currentDiscountOverload += ($product['originPrice'] - $product['price']) * $count;
                        $this->aplyOverloadProducts[] = $product['productId'];
                    }
                }
                $overload += $currentDiscountOverload;
            }
        }
        return $overload;
    }

// */
}

?>
