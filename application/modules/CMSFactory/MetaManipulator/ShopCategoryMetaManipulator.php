<?php

namespace CMSFactory\MetaManipulator;

use CI;
use CMSFactory\assetManager;
use Currency\Currency;
use MY_Controller;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\Exception\PropelException;
use SCategory;
use ShopProductCategoriesQuery;
use SProductsQuery;

class ShopCategoryMetaManipulator extends MetaManipulator
{

    /**
     * @var string
     */
    protected $H1;

    /**
     * @var string
     */
    protected $brands;

    /**
     * @var array
     */
    protected $matching = [
        'desc' => 'description'
    ];

    /**
     * @var string
     */
    protected $maxPrice;

    /**
     * @var string
     */
    protected $minPrice;

    /**
     * @var SCategory
     */
    protected $model;

    /**
     * @param int $limit
     * @return string
     * @throws PropelException
     */
    public function getBrands($limit = 3) {

        if (!$this->brands) {

            $productsIds = ShopProductCategoriesQuery::create()
                ->select('ProductId')
                ->distinct()
                ->filterByCategoryId($this->getModel()->getId())
                ->find()->toArray();

            $locale = MY_Controller::getCurrentLocale();
            /* @TODO $res to propel!! */
            $res = CI::$APP->db
                ->select('shop_products.brand_id, shop_brands_i18n.name , COUNT(shop_products.brand_id) AS  count')
                ->join('shop_brands_i18n', 'shop_brands_i18n.id = shop_products.brand_id')
                ->where('shop_brands_i18n.locale', $locale)
                ->where_in('shop_products.id', $productsIds)
                ->group_by('brand_id')
                ->order_by('count', 'DESC')
                ->get('shop_products', $limit)
                ->result_array();

            $this->setBrands(implode(', ', array_column($res, 'name')));
        }

        return $this->brands;
    }

    /**
     * @param string $brands
     */
    public function setBrands($brands) {

        $this->brands = $brands;
    }

    /**
     * @return SCategory
     */
    public function getModel() {

        return $this->model;
    }

    /**
     * @param SCategory $model
     */
    public function setModel($model) {

        $this->model = $model;
    }

    /**
     * @return string
     */
    public function getH1() {

        if (!$this->H1) {
            $this->setH1($this->getModel()->getH1());
        }
        return $this->H1;
    }

    /**
     * @param string $H1
     */
    public function setH1($H1) {

        $this->H1 = $H1;
    }

    /**
     * @return string
     */
    public function getMaxPrice() {

        if (!$this->maxPrice) {
            $this->setMaxMinPrice();
        }
        return $this->maxPrice;
    }

    /**
     * @param string $maxPrice
     */
    public function setMaxPrice($maxPrice) {

        $this->maxPrice = $maxPrice;
    }

    /**
     * @throws PropelException
     */
    protected function setMaxMinPrice() {

        $data = SProductsQuery::create()
            ->select(['maxPrice', 'minPrice'])
            ->filterByActive(1)
            ->useProductVariantQuery()
            ->filterByStock(0, Criteria::GREATER_THAN)
            ->filterByPriceInMain(0.5, Criteria::GREATER_EQUAL)
            ->withColumn('max(price)', 'maxPrice')
            ->withColumn('min(price)', 'minPrice')
            ->endUse()
            ->useShopProductCategoriesQuery()
            ->filterByCategoryId($this->getModel()->getId())
            ->endUse()
            ->findOne();

        $this->setMaxPrice(Currency::create()->convert($data['maxPrice']));
        $this->setMinPrice(Currency::create()->convert($data['minPrice']));
    }

    /**
     * @return string
     */
    public function getMinPrice() {

        if (!$this->maxPrice) {
            $this->setMaxMinPrice();
        }
        return $this->minPrice;
    }

    /**
     * @param string $minPrice
     */
    public function setMinPrice($minPrice) {

        $this->minPrice = $minPrice;
    }

}