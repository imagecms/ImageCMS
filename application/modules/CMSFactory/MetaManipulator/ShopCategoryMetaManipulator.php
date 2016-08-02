<?php

namespace CMSFactory\MetaManipulator;

use Currency\Currency;
use MY_Controller;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\Exception\PropelException;
use SProductsQuery;

/**
 * Class ShopCategoryMetaManipulator
 * @package CMSFactory\MetaManipulator
 */
class ShopCategoryMetaManipulator extends MetaManipulator
{

    /**
     * @var string
     */
    protected $H1;

    /**
     * @var string
     */
    protected $brandName;

    /**
     * @var string
     */
    protected $brands;

    /**
     * @var int
     */
    protected $brandsCount = 3;

    /**
     * @var string
     */
    protected $maxPrice;

    /**
     * @var string
     */
    protected $minPrice;

    /**
     * @var string
     */
    protected $propertyName;

    /**
     * @var string
     */
    protected $propertyValue;

    /**
     * @var string
     */
    protected $seoText;

    public function __construct($model, MetaStorage $storage) {
        parent::__construct($model, $storage);
        $this->setSeoText($this->getStorage()->getSeoTextTemplate());
        $this->setMetaArray(['seoText']);

    }

    /**
     * @return string
     */
    public function getBrandName() {

        return $this->brandName;
    }

    /**
     * @param string $brandName
     */
    public function setBrandName($brandName) {

        $this->brandName = $brandName;
    }

    /**
     * @return string
     * @throws PropelException
     */
    public function getBrands() {

        if (!$this->brands) {

            $locale = MY_Controller::getCurrentLocale();

            $query = SProductsQuery::create()
                ->select('shop_brands_i18n.name')
                ->withColumn('COUNT(shop_products.brand_id)', 'count_brands')
                ->limit($this->getBrandsCount())
                ->joinBrand()
                ->joinShopProductCategories()
                ->useShopProductCategoriesQuery()
                ->distinct()
                ->filterByCategoryId($this->getModel()->getId())
                ->endUse()
                ->useBrandQuery()
                ->joinI18n($locale)
                ->endUse()
                ->groupByBrandId()
                ->orderBy('count_brands', Criteria::DESC)
                ->orderBy('shop_brands_i18n.name', Criteria::ASC)
                ->find()
                ->toKeyValue('shop_brands_i18n.name', 'count_brands');

            $this->setBrands(implode(', ', array_keys($query)));
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
     * @return int
     */
    public function getBrandsCount() {

        return $this->brandsCount;
    }

    /**
     * @param int $brandsCount
     */
    public function setBrandsCount($brandsCount) {

        $this->brandsCount = $brandsCount ?: 3;
    }

    /**
     * @return string
     */
    public function getDescription() {

        if (!$this->description) {
            $this->setDescription($this->getModel()->getDescription());
        }
        return $this->description;
    }

    /**
     * @return string
     */
    public function getH1() {

        if (!$this->H1) {
            $this->setH1($this->getModel()->getH1() ?: $this->getModel()->getName());
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
    public function getID() {

        if (!$this->ID) {
            $this->setID($this->getModel()->getId());
        }
        return $this->ID;
    }

    /**
     * @return string
     * @throws PropelException
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
    public function setMaxMinPrice() {

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

        if (!isset($this->maxPrice)) {
             $this->setMaxPrice(Currency::create()->convert($data['maxPrice']));
        }

        if (!isset($this->minPrice)) {
            $this->setMinPrice(Currency::create()->convert($data['minPrice']));
        }
    }

    /**
     * @return string
     * @throws PropelException
     */
    public function getMinPrice() {

        if (!$this->minPrice) {
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

    /**
     * @return string
     */
    public function getName() {

        if (!$this->name) {
            $this->setName($this->getModel()->getName());
        }
        return $this->name;
    }

    /**
     * @return string
     */
    public function getPropertyName() {

        return $this->propertyName;
    }

    /**
     * @param string $propertyName
     */
    public function setPropertyName($propertyName) {

        $this->propertyName = $propertyName;
    }

    /**
     * @return string
     */
    public function getPropertyValue() {

        return $this->propertyValue;
    }

    /**
     * @param string $propertyValue
     */
    public function setPropertyValue($propertyValue) {

        $this->propertyValue = $propertyValue;
    }

    /**
     * @return string
     */
    public function getSeoText() {
        return $this->seoText;
    }

    /**
     * @param string $seoText
     */
    public function setSeoText($seoText) {
        $this->seoText = $seoText;
    }

}