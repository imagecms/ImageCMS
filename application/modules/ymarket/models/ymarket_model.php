<?php

use Currency\Currency;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Exception\PropelException;

/**
 * @property CI_DB_active_record $db
 * @property DX_Auth $dx_auth
 * @property Cms_base cms_base
 */
class Ymarket_model extends CI_Model
{

    const DEFAULT_TYPE = 1;
    const PRICE_UA_TYPE = 2;
    const NADAVI_UA_TYPE = 3;

    public $settings;

    public function __construct() {

        parent::__construct();
    }

    /**
     * Selects the category assigned by the user
     * @param $type int
     * @return array Information about the selected category
     */
    public function init($type) {

        $temp = $this->db->where('id', $type)->get('mod_ymarket');
        $this->settings = $this->cms_base->get_settings();
        if ($temp) {
            $temp = $temp->row_array();

            $this->settings['adult'] = $temp['adult'];
            $this->settings['unserCats'] = unserialize($temp['categories']);
            $this->settings['unserBrands'] = unserialize($temp['brands']);
        }
        return $this->settings;
    }

    /**
     * Selects the category assigned by the user
     * @return object Information about the selected category
     */
    public function getBrands() {

        $temp = $this->db
            ->where('locale', MY_Controller::getCurrentLocale())
            ->get('shop_brands_i18n');

        if ($temp) {
            $temp = $temp->result_array();
        }
        return $temp;
    }

    /**
     * Selection of products in the categories specified by the user
     * @param $idsCat
     * @param bool $ignoreSettings
     * @param $brandIds
     * @return array Products and products variants
     */
    public function getProducts($idsCat, $ignoreSettings = false, $brandIds) {

        $products = SProductsQuery::create()
            ->distinct();
        if (!$ignoreSettings) {
            if ($idsCat) {
                $products->filterByCategoryId($idsCat);
            }

            if ($brandIds) {
                $products = $products->filterByBrandId($brandIds);
            }

            $products = $products
                ->useProductVariantQuery()
                ->filterByStock(['min' => 1])
                ->filterByPrice(['min' => 0.00001])
                ->endUse()
                ->filterByActive(true)
                ->filterByArchive(false);
        }
        $res = $products->find();
        $res->populateRelation('ProductVariant');
        return $res;
    }

    /**
     * Generates a name of the product depending on the name and version of the product name.
     * @param string $productName product name
     * @param string $variantName variant name
     * @return string
     */
    public function forName($productName, $variantName) {

        if (encode($productName) == encode($variantName)) {
            $name = htmlspecialchars($productName);
        } else {
            $name = htmlspecialchars($productName . ' ' . $variantName);
        }
        return $name;
    }

    /**
     * @param ObjectCollection $products - products collection
     * @return array
     * @throws PropelException
     */
    public function getProperties($products) {

        $productsIds = [];
        /** @var SProductVariants $product */
        foreach ($products as $product) {
            $productsIds[] = $product->getProductId();
        }

        $properties = SProductPropertiesDataQuery::create()
            ->select(['ProductId', 'Value', 'Name'])
            ->useSPropertiesQuery()
            ->joinWithI18n(MY_Controller::getCurrentLocale(), Criteria::INNER_JOIN)
             ->orderByPosition()
            ->endUse()
            ->useSPropertyValueQuery()
            ->joinWithI18n(MY_Controller::getCurrentLocale(), Criteria::INNER_JOIN)
             ->orderByPosition()
            ->endUse()
            ->withColumn('SProductPropertiesData.ProductId', 'ProductId')
            ->withColumn('SPropertyValueI18n.Value', 'Value')
            ->withColumn('SPropertiesI18n.Name', 'Name')
            ->filterByProductId($productsIds, Criteria::IN)
            ->where('SProperties.Active = ?', 1)
            ->where('SPropertyValueI18n.Value != ?', '')
            ->where('SProperties.ShowOnSite = ?', 1)
            ->find()->toArray();

        $productsData = [];
        array_map(
            function ($property) use (&$productsData) {
                if (!$productsData[$property['ProductId']][$property['Name']]) {
                    $productsData[$property['ProductId']][$property['Name']] = [
                                                                                'name'  => $property['Name'],
                                                                                'value' => [$property['Value']],
                                                                               ];
                } else {
                    $productsData[$property['ProductId']][$property['Name']]['value'][] = $property['Value'];
                }
            },
            $properties
        );
        $productsData = array_map(
            function ($property) {
                return array_map(
                    function ($propertyValues) {
                        $propertyValues['value'] = implode(', ', $propertyValues['value']);
                        return $propertyValues;
                    },
                    $property
                );
            },
            $productsData
        );
        return $productsData;
    }

    /**
     * @param SProductVariants $variants
     * @return array
     */
    public function getAdditionalImagesBYVariants($variants) {

        $productsIds = [];
        foreach ($variants as $variant) {
            $productsIds[] = $variant->getProductId();
        }
        $images = $this->db->where_in('product_id', $productsIds)->get('shop_product_images');
        $images = $images ? $images->result_array() : [];
        $productsData = [];
        array_map(
            function ($image) use (&$productsData) {
                $productsData[$image['product_id']][] = productImageUrl('products/additional/' . $image['image_name']);
            },
            $images
        );
        return $productsData;
    }

    /**
     * Generate offers data
     * @param boolean $ignoreSettings
     * @param array $productFields
     * @return array
     * @throws PropelException
     */
    public function formOffers($ignoreSettings, $productFields) {

        $variants = $this->getVariants($this->settings['unserCats'], $ignoreSettings, $this->settings['unserBrands']);

        $params = $this->getProperties($variants);
        $additionalImages = $this->getAdditionalImagesBYVariants($variants);

        $offers = [];
        list($currencies, $mainCurr) = $this->makeCurrency();

        /** @var SProductVariants $variant */
        foreach ($variants as $variant) {
            $unique_id = $variant->getId();
            $offers[$unique_id]['url'] = base_url('shop/product/' . $variant->getSProducts()->getUrl());
            $offers[$unique_id]['price'] = $variant->getPriceInMain();
            if (!$currencies[$variant->getCurrency()]['code']) {
                $currencyId = $mainCurr['code'];
            } else {
                $currencyId = $currencies[$variant->getCurrency()]['code'];
            }

            $mainPhoto = $variant->getMainimage() ? productImageUrl('products/main/' . $variant->getMainimage()) : null;
            $photos = $additionalImages[$variant->getProductId()] ?: [];

            $offers[$unique_id]['currencyId'] = $currencyId;
            $offers[$unique_id]['categoryId'] = $variant->getSProducts()->getCategoryId();
            $offers[$unique_id]['picture'] = array_merge([$mainPhoto], $photos);
            $offers[$unique_id]['name'] = $this->forName($variant->getSProducts()->getName(), $variant->getName());
            $offers[$unique_id]['vendor'] = $variant->getSProducts()->getBrand() ? htmlspecialchars($variant->getSProducts()->getBrand()->getName()) : '';
            $offers[$unique_id]['vendorCode'] = $variant->getNumber() ?: '';
            $offers[$unique_id]['description'] = htmlspecialchars($variant->getSProducts()->getFullDescription());
            $offers[$unique_id]['cpa'] = $variant->getStock() ? 1 : 0;
            if ($this->uri->uri_string() !== 'ymarket') {
                $offers[$unique_id]['quantity'] = $variant->getStock();
            }

            if ($productFields[$variant->getProductId()]) {
                foreach (['country_of_origin', 'manufacturer_warranty', 'seller_warranty'] as $value) {
                    if ($productFields[$variant->getProductId()][$value]) {
                        $offers[$unique_id][$value] = $productFields[$variant->getProductId()][$value];
                    }
                }
            }

            if ($this->settings['adult']) {
                $offers[$unique_id]['adult'] = 'true';
            }

            if ($params[$variant->getProductId()]) {
                $offers[$unique_id]['param'] = $params[$variant->getProductId()];
            }
        }

        return $offers;
    }

    /**
     *
     * @return array<string,string>[]
     */
    public function makeCurrency() {

        $_currencies = Currency::create()->getCurrencies();

        $checkRUB = false;
        $rates = [];
        $mainCurr = [];
        $currencies = [];

        foreach ($_currencies as $value) {
            $isoNEW = $value->getCode() == 'RUB' ? 'RUR' : $value->getCode();
            $rates[$isoNEW]['rate'] = $value->getRate();
            $rates[$isoNEW]['main'] = $value->getMain();
            if ($isoNEW == 'RUR') {
                $checkRUB = true;
                break;
            }
        }
        //Перегонка рейтов чтобы главным был рубль
        if (isset($rates['RUR'])) {
            if (!$rates['RUR']['main'] && (int) $rates['RUR']['rate'] != 1) {
                foreach ($rates as $iso => $data) {
                    //Перегонка
                    $rurRate = $rates['RUR']['rate'];
                    if ($iso != 'RUR') {
                        $rates[$iso]['rate'] = $rurRate / $data['rate'];
                    }
                }
                $rates['RUR']['rate'] = 1;
            }
        }

        foreach ($_currencies as $value) {
            if ($checkRUB) {
                if ($value->getCode() == 'RUR' || $value->getCode() == 'RUB') {
                    $mainCurr['code'] = 'RUR';
                    $rate = $rates['RUR']['rate'] ? $rates['RUR']['rate'] : 1 / $value->getRate();
                    $mainCurr['rate'] = number_format($rate, 3);
                    continue;
                }
            } else {
                if ($value->getMain()) {
                    $mainCurr['code'] = $value->getCode() == 'RUB' ? 'RUR' : $value->getCode();
                    $rate = $rates[$mainCurr['code']]['rate'] ? $rates[$mainCurr['code']]['rate'] : 1 / $value->getRate();
                    $mainCurr['rate'] = number_format($rate, 3);
                    continue;
                }
            }

            $currencies[$value->getId()]['code'] = $value->getCode();
            $rate = $rates[$value->getCode()]['rate'] ?: 1 / $value->getRate();
            $currencies[$value->getId()]['rate'] = number_format($rate, 3);
        }
        return [
                $currencies,
                $mainCurr,
               ];
    }

    /**
     *
     * @param integer $idsCat
     * @param boolean $ignoreSettings
     * @param array $brandIds
     * @return SProductVariants
     */
    public function getVariants($idsCat, $ignoreSettings = false, $brandIds) {

        if (!$ignoreSettings) {
            $variants = SProductVariantsQuery::create()
                ->useSProductsQuery()
                ->filterByActive(true)
                ->filterByArchive(false)
                ->_if($idsCat)
                ->filterByCategoryId($idsCat)
                ->_endif()
                ->_if($brandIds)
                ->filterByBrandId($brandIds)
                ->_endif()
                ->distinct()
                ->endUse()
                ->filterByStock(['min' => 1])
                ->filterByPrice(['min' => 0.00001])
                ->find();
        } else {
            $variants = SProductVariantsQuery::create()
                ->useSProductsQuery()
                ->distinct()
                ->endUse()
                ->find();
        }
        return $variants;
    }

    /**
     * Model saves the selected user categories in the table
     */
    public function setCategories() {

        $tempCats = $this->input->post('displayedCats') ? serialize($this->input->post('displayedCats')) : '';
        $displayedBrands = $this->input->post('displayedBrands') ? serialize($this->input->post('displayedBrands')) : '';
        $tempAdult = $this->input->post('adult') ? 1 : 0;

        $tempCatsPriceUa = $this->input->post('displayedCatsPriceUa') ? serialize($this->input->post('displayedCatsPriceUa')) : '';
        $displayedBrandsPriceUa = $this->input->post('displayedBrandsPriceUa') ? serialize($this->input->post('displayedBrandsPriceUa')) : '';

        $tempCatsNadaviUa = $this->input->post('displayedCatsNadaviUa') ? serialize($this->input->post('displayedCatsNadaviUa')) : '';
        $displayedBrandsNadaviUa = $this->input->post('displayedBrandsNadaviUa') ? serialize($this->input->post('displayedBrandsNadaviUa')) : '';

        $idsTemp = $this->db->select('id')->get('mod_ymarket')->result_array();
        $ids = [];
        foreach ($idsTemp as $v) {
            $ids[] = $v['id'];
        }

        $data = [
                 'id'         => self::DEFAULT_TYPE,
                 'categories' => $tempCats,
                 'brands'     => $displayedBrands,
                 'adult'      => $tempAdult,
                ];
        $this->saveCategoriesSettings($data, in_array(self::DEFAULT_TYPE, $ids));

        $data = [
                 'id'         => self::PRICE_UA_TYPE,
                 'categories' => $tempCatsPriceUa,
                 'brands'     => $displayedBrandsPriceUa,
                 'adult'      => 0,
                ];
        $this->saveCategoriesSettings($data, in_array(self::PRICE_UA_TYPE, $ids));

        $data = [
                 'id'         => self::NADAVI_UA_TYPE,
                 'categories' => $tempCatsNadaviUa,
                 'brands'     => $displayedBrandsNadaviUa,
                 'adult'      => 0,
                ];
        $this->saveCategoriesSettings($data, in_array(self::NADAVI_UA_TYPE, $ids));
    }

    /**
     * @param $data - array to save into DB
     * @param bool $update - update or insert, default update
     */
    private function saveCategoriesSettings($data, $update = true) {

        if ($update) {
            $this->db->where('id', $data['id'])
                ->update('mod_ymarket', $data);
        } else {
            $this->db->insert('mod_ymarket', $data);
        }
    }

}