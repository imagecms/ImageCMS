<?php

namespace exchange\classes;

use CI;
use CMSFactory\ModuleSettings;
use core\models\Route;
use core\models\RouteQuery;
use Exception;
use MediaManager\Image;
use MY_Controller;
use Propel\Runtime\ActiveQuery\Criteria;
use SimpleXMLElement;

/**
 *
 * @author kolia
 */
class Products extends ExchangeBase
{

    /**
     *
     * @var array
     */
    private $additionalParentsCategories = [];

    /**
     *
     * @var array
     */
    protected $compare_exIds = [];

    /**
     *
     * @var array
     */
    protected $compare_properties = [];

    /**
     *
     * @var array
     */
    protected $compare_urls = [];

    /**
     *
     * @var array
     */
    private $existingProductsIds = [];

    /**
     *
     * @var array
     */
    protected $i18nExisting = [];

    /**
     *
     * @var boolean
     */
    private $ignoreExistingDescriptions = false;

    /**
     *
     * @var
     */
    private $ignoreExistingProducts = false;

    /**
     * If product have images, then all
     * his old images need to be deleted
     * @var array
     */
    protected $imagesToDelete = [];

    /**
     * @var array
     */
    protected $imagesToResize = [];

    /**
     * @var array
     */
    protected $imagesToResizeAdditional = [];

    /**
     *
     * @var DataCollector
     */
    protected $insertCollector;

    /**
     * Array of products main categories
     * @var array
     */
    private $parentCat = [];

    /**
     *
     * @var array
     */
    protected $productProCats = [];

    /**
     * In the xml there can be two different products with same names, this array
     * gathers just created product urls to prevent equal addresses
     * @var array
     */
    protected $productsNewUrls = [];

    /**
     *
     * @var array
     */
    protected $productss;

    /**
     *
     * @var boolean
     */
    protected $runResize = FALSE;

    /**
     * If products have 'ХарактеристикиТовара' run fix
     * @var bool
     */
    protected $runVariantsFix = false;

    /**
     * Path of folder where xml and images stored
     * @var string
     */
    protected $tempDir;

    /**
     *
     * @var DataCollector
     */
    protected $updateCollector;

    /**
     *
     * @var VariantCharacteristics
     */
    private $variantCharacteristics;

    private $categoryUrls = [];

    protected function addProductsToUpperCategories() {

        $products = $this->db->select('shop_products.id, shop_category.full_path_ids')
            ->join('shop_category', 'shop_category.id = shop_products.category_id')
            ->get('shop_products')
            ->result();

        $insertData = [];
        foreach ($products as $product) {
            $path = unserialize($product->full_path_ids);
            foreach ($path as $fpi) {
                $newData = [
                            'category_id' => $fpi,
                            'product_id'  => $product->id,
                           ];
                if ($this->isProductCategoriesRowNew($newData) == FALSE) {
                    continue;
                }
                $insertData[] = $newData;
            }
        }
        $this->insertBatch('shop_product_categories', $insertData);
    }

    protected function getUrls() {

        $productExIds = [];
        foreach ($this->products as $product) {
            if (!empty($product['external_id'])) {
                $productExIds[$product['external_id']] = $product['id'];
            }
        }
        return $productExIds;
    }

    /**
     *
     */
    protected function import_() {

        $ignoreExisting = ModuleSettings::ofModule('exchange')->get('ignore_existing');
        $this->ignoreExistingProducts = isset($ignoreExisting['products']);
        $this->ignoreExistingDescriptions = isset($ignoreExisting['description']);

        $this->insertCollector = new DataCollector();
        $this->updateCollector = new DataCollector();

        $storageFilePath = CI::$APP->config->item('characteristicsStorageFilePath');
        $this->variantCharacteristics = new VariantCharacteristics($storageFilePath);

        $this->rememberOriginAdditionalParentsCats();

        $this->getCompareData();

        $this->processProducts1();
        $this->insert1();
        $this->processProducts23_Insert23();

        if (!$this->ignoreExistingProducts) {
            $this->update();
        }
        $this->rememberOriginAdditionalParentsCats();

        $this->rebuildAdditionalParentsCats();
        $this->runResize();
        //        $this->rebuildProductProperties();
    }

    /**
     *
     */
    protected function rememberOriginAdditionalParentsCats() {

        $result = $this->db
            ->select(['shop_products.id', 'shop_category.full_path_ids'])
            ->join('shop_category', 'shop_category.id=shop_products.category_id')
            ->get('shop_products');

        if (!$result) {
            return;
        }

        $result = $result->result_array();
        foreach ($result as $row) {
            $this->additionalParentsCategories[$row['id']] = unserialize($row['full_path_ids']);
        }
    }

    /**
     * Getting from base data of product for fast compare (external_ids, urls...)
     * @param integer $type if empty = all,
     *  1 - only external_ids,
     *  2 - only urls,
     *  3 - only properties
     */
    protected function getCompareData($type = NULL) {

        foreach ($this->products as $product) {
            // external ids of products
            if (!empty($product['external_id']) & ($type == NULL || (int) $type == 1)) {
                $this->compare_exIds[$product['external_id']] = $product['id'];
            }
            if ($type == NULL || (int) $type == 2) {
                $this->compare_urls[$product['url']] = $product['external_id'];
            }
        }
        if ($type == NULL || (int) $type == 3) {
            foreach ($this->properties as $property) {
                if (!empty($property['external_id'])) {
                    $this->compare_properties[$property['external_id']] = $property;
                }
            }
        }
    }

    /**
     * Gather data for tables:
     *  - `shop_products` (data will be ready)
     *  - `shop_products_i18n` (after `shop_products`)
     *  - `shop_product_variants` (after `shop_products`)
     *  - `shop_product_variants_i18n` (after `shop_product_variants`)
     *  - `shop_products_categories` (after `shop_products`)
     *  - `shop_product_images` (after `shop_products`)
     *
     *  P.S. For updating all data will be ready immediately, inserting need depends on the order
     *
     */
    protected function processProducts1() {

        $propertiesDataUpdate = [];
        $productPropDTDel = [];

        // for variants
        $productsUniqueExIds = [];

        // passing each product
        foreach ($this->importData as $product) {

            if (FALSE !== strpos((string) $product->Ид, '#')) { // this is variant of product
                $exId = array_shift(explode('#', (string) $product->Ид)); // getting product id
                $variantExId = (string) $product->Ид;
            } else {
                $exId = (string) $product->Ид;
                $variantExId = NULL;
            }

            // GETTING ALL DATA
            list($products, $i18n) = $this->pass1Helper_getProductData($product, $exId);

            $isNewProduct = !isset($this->compare_exIds[$products['external_id']]);
            $isNewVariant = $variantExId == null ? false : !isset($this->variantsIds[$variantExId]);

            list($variant, $variantI18n) = $this->pass1Helper_getVariantData($product, $isNewProduct);

            try {
                $categoryId = $this->pass1Helper_getCategoryData($product);
                $products['category_id'] = $categoryId;
            } catch (Exception $e) {
                continue;
            }

            list($additionalImages, $mainImage) = $this->pass1Helper_getImagesData($product, $exId);

            $this->imagesToResize[] = $mainImage;
            foreach ($additionalImages as $addImg) {
                $this->imagesToResizeAdditional[] = $addImg['image_name'];
            }

            if ($mainImage != NULL) {
                $variant['mainImage'] = $mainImage;
            } else {
                $variant['mainImage'] = '';
            }

            list($shopProductPropertiesData, $brandId) = $this->pass1Helper_getPropertiesData($product, $categoryId);

            if ($brandId) {
                $products['brand_id'] = $brandId;
            }

            $url = translit_url((string) $product->Наименование);

            // splitting on new & existing products (by external_id)
            if ($isNewProduct) { // NEW
                // default variants values (without `product_id`)
                if (!$variantExId == NULL) { // this is variant of product
                    $this->insertCollector->addData('shop_product_variants', $variant, $variantExId);
                    $this->insertCollector->addData('shop_product_variants_i18n', $variantI18n, $variantExId);
                    if (!isset($productsUniqueExIds[$exId])) {
                        $productsUniqueExIds[$exId] = 0;
                    } else {
                        $this->insertCollector->newPass();
                        $this->updateCollector->newPass();
                        continue;
                    }
                } else {
                    $this->insertCollector->addData('shop_product_variants', $variant, $exId);
                    $this->insertCollector->addData('shop_product_variants_i18n', $variantI18n, $exId);
                }

                if (isset($this->compare_urls[$url])) {
                    if ($this->compare_urls[$url] != $exId) { // add some number to url
                        $i = 1;
                        $url_ = $url;
                        while (array_key_exists($url, $this->compare_urls)) {
                            $url = $url_ . ++$i;
                        }
                    }
                }

                $products['url'] = $url;

                $this->compare_urls[$url] = $exId;

                $this->insertCollector->addData('shop_products', $products, $exId);
                $this->insertCollector->addData('shop_products_i18n', $i18n, $exId);

                $this->insertCollector->addData('shop_product_categories', ['category_id' => $products['category_id']], $exId);
                foreach ($shopProductPropertiesData as $propertyData) {
                    $this->insertCollector->updateData('shop_product_properties_data', $propertyData, $exId);
                }
                if ($additionalImages != NULL) {
                    $this->insertCollector->addData('shop_product_images', $additionalImages, $exId);
                }
            } else { // EXISTING
                $productId = $this->compare_exIds[$exId];
                $this->existingProductsIds[] = $productId;
                $variant = array_merge($variant, ['product_id' => $productId]);

                if (isset($this->variantImages[$exId]) & empty($variant['mainImage'])) {
                    $variant['mainImage'] = $this->variantImages[$exId];
                }

                // to not drop prices on update
                unset($variant['price_in_main']);
                unset($variant['price']);

                if (!$variantExId == NULL) { // this is variant of product
                    if ($isNewVariant) {
                        $this->insertCollector->addData('shop_product_variants', $variant, $variantExId);
                        $this->insertCollector->addData('shop_product_variants_i18n', $variantI18n, $variantExId);
                    } else {
                        $this->updateCollector->addData('shop_product_variants', $variant, $variantExId);
                        $this->updateCollector->addData('shop_product_variants_i18n', $variantI18n, $variantExId);
                    }

                    if (!isset($productsUniqueExIds[$exId])) {
                        $productsUniqueExIds[$exId] = 0;
                    } else {
                        $this->insertCollector->newPass();
                        $this->updateCollector->newPass();
                        continue;
                    }
                } else {
                    $this->updateCollector->addData('shop_product_variants', array_merge($variant, ['product_id' => $productId]));
                    $this->updateCollector->addData('shop_product_variants_i18n', $variantI18n, $exId);
                }

                if (isset($products['category_id'])) { // will be updated by product_id
                    $this->updateCollector->addData(
                        'shop_product_categories',
                        [
                         'product_id'  => $productId,
                         'category_id' => $products['category_id'],
                        ]
                    );
                }
                $this->updateCollector->addData('shop_products', array_merge($products, ['id' => $productId, 'url' => $url]));
                $this->updateCollector->addData('shop_products_i18n', array_merge($i18n, ['id' => $productId]));

                foreach ($shopProductPropertiesData as $propertyData) {
                    $propertiesDataUpdate[] = array_merge($propertyData, ['product_id' => $productId]);
                }
                $productPropDTDel[] = $productId;
                if ($additionalImages != NULL) {
                    $countAddImg = count($additionalImages);
                    for ($i = 0; $i < $countAddImg; $i++) {
                        $additionalImages[$i]['product_id'] = $productId;
                    }
                    $this->updateCollector->addData('shop_product_images', $additionalImages);
                }
            }

            $this->insertCollector->newPass();
            $this->updateCollector->newPass();
        }

        if (!$this->ignoreExistingProducts and $productPropDTDel) {
            $this->db
                ->where_in('product_id', $productPropDTDel)
                ->delete('shop_product_properties_data');

            $this->insertPropertiesData('shop_product_properties_data', $propertiesDataUpdate);
        }

        $this->variantCharacteristics->saveCharacteristics();
    }

    /**
     * Method-helper for simplify processProducts1 method
     * @param SimpleXMLElement $product
     * @param string $exId
     * @return array
     */
    protected function pass1Helper_getProductData(SimpleXMLElement $product, $exId) {

        $products = [
                     'external_id' => $exId,
                     'active'      => (string) $product->Статус == 'Удален' ? 0 : 1,
                    ];
        $i18n = [
                 'locale' => $this->locale,
                 'name'   => (string) $product->Наименование,
                ];

        $hasDescription = false;

        if (isset($product->Описание)) {
            $hasDescription = true;
            $description = (string) $product->Описание;
        } elseif (isset($product->ЗначенияРеквизитов->ЗначениеРеквизита->Наименование)) {
            foreach ($product->ЗначенияРеквизитов->ЗначениеРеквизита as $recVal) {
                if ((string) $recVal->Наименование == 'Полное наименование') {
                    $hasDescription = true;
                    $description = (string) $recVal->Значение;
                }
            }
        }

        if ($hasDescription) {
            $locale = MY_Controller::defaultLocale();
            $res = $this->db
                ->select('shop_products_i18n.short_description, shop_products_i18n.full_description')
                ->from('shop_products')
                ->where('external_id', $exId)
                ->where('shop_products_i18n.locale', $locale)
                ->join('shop_products_i18n', 'shop_products_i18n.id = shop_products.id')
                ->get();

            if ($res->num_rows() > 0) {
                $desc = $res->row_array();
                $shortDescIsEmpty = ('' == $desc['short_description']);
                $FullDescIsEmpty = ('' == $desc['full_description']);
            }
            if ($this->ignoreExistingDescriptions) {
                $shortDescIsEmpty && $i18n['short_description'] = $description;
                $FullDescIsEmpty && $i18n['full_description'] = $description;
            } else {
                $i18n['short_description'] = $description;
                $i18n['full_description'] = $description;
            }
        }

        return [
                $products,
                $i18n,
               ];
    }

    /**
     * Method-helper for simplify processProducts1 method
     * @param SimpleXMLElement $product
     * @param bool $isNew
     * @return array
     */
    protected function pass1Helper_getVariantData(SimpleXMLElement $product, $isNew = true) {

        $variant = [
                    'external_id' => (string) $product->Ид,
                    'number'      => (string) $product->Артикул,
                    'currency'    => $this->mainCurrencyId,
                   ];

        //$name = (string) $product->Наименование;
        $name = '';
        if (isset($product->ХарактеристикиТовара)) {
            foreach ($product->ХарактеристикиТовара->ХарактеристикаТовара as $value) {
                $chName = (string) $value->Наименование;
                $chValue = (string) $value->Значение;

                $name .= ' ' . $chValue;
                $this->variantCharacteristics->addCharacteristic($chName, $chValue);
            }
        }

        $variantI18n = [
                        'locale' => $this->locale,
                        'name'   => trim($name),
                       ];

        if ($isNew) {
            $defaultVariantsValues = [
                                      'price'         => '0.00000',
                                      'stock'         => 0,
                                      'position'      => 0,
                                      'price_in_main' => '0.00000',
                                     ];
        } else {
            $defaultVariantsValues = [];
        }

        return [
                array_merge($variant, $defaultVariantsValues),
                $variantI18n,
               ];
    }

    /**
     * Method-helper for simplify processProducts1 method
     * @param SimpleXMLElement $product
     * @return int
     * @throws Exception
     */
    protected function pass1Helper_getCategoryData(SimpleXMLElement $product) {

        $categoryId = NULL;
        if (isset($product->Группы)) {
            $categoryExId = (string) $product->Группы->Ид;
            $categoryId = Categories::getInstance()->categoryExists2($categoryExId, TRUE);
            if (!$categoryId) {
                throw new Exception(sprintf('Error! Product category with id [%s] not found in file', $categoryExId));
            }
        } else {
            throw new Exception(sprintf('Error! Product "%s" category not found in file', $product->Наименование));
        }

        return $categoryId;
    }

    /**
     * Method-helper for simplify processProducts1 method
     * @param SimpleXMLElement $product
     * @param string $exId
     * @return array
     */
    protected function pass1Helper_getImagesData(SimpleXMLElement $product, $exId) {

        $additionalImages = NULL;
        $mainImage = NULL;

        if (count($product->Картинка) > 1) {
            $this->imagesToDelete[$exId] = NULL;
        }
        $i = 0;
        foreach ((array) $product->Картинка as $image) {
            $path = (string) $image;
            $fileName = pathinfo($path, PATHINFO_BASENAME);
            if ($i == 0) { // main image
                if (file_exists($this->tempDir . $path) and !file_exists('./uploads/shop/products/origin/' . $fileName)) {
                    $copied = copy($this->tempDir . $path, './uploads/shop/products/origin/' . $fileName);
                    if ($copied != FALSE) {
                        $mainImage = $fileName;
                    }
                } elseif (file_exists('./uploads/shop/products/origin/' . $fileName)) {
                    $mainImage = $fileName;
                }
            } else { // rest of images will be an additional
                if (file_exists($this->tempDir . $path) and !file_exists('./uploads/shop/products/origin/additional/' . $fileName)) {
                    $copied = copy($this->tempDir . $path, './uploads/shop/products/origin/additional/' . $fileName);
                    if ($copied != FALSE) {
                        $additionalImages[] = [
                                               'position'   => $i - 1,
                                               'image_name' => $fileName,
                                              ];
                    }
                } elseif (file_exists('./uploads/shop/products/origin/additional/' . $fileName)) {
                    $additionalImages[] = [
                                           'position'   => $i - 1,
                                           'image_name' => $fileName,
                                          ];
                }
            }
            $i++;
        }

        return [
                $additionalImages,
                $mainImage,
               ];
    }

    /**
     * Method-helper for simplify processProducts1 method
     * @param SimpleXMLElement $product
     * @param int $categoryId
     * @return array
     */
    protected function pass1Helper_getPropertiesData(SimpleXMLElement $product, $categoryId) {

        $brandIdentif = Properties::getInstance()->getBrandIdentif();
        $brandId = '';

        $shopProductPropertiesData = [];
        // processing properties of product
        if (isset($product->ЗначенияСвойств)) {
            foreach ($product->ЗначенияСвойств->ЗначенияСвойства as $property) {
                $propertyValue = (string) $property->Значение;
                if (empty($propertyValue)) {
                    continue;
                }
                // check for "brand"
                $propertyExId = (string) $property->Ид;
                if ($propertyExId == $brandIdentif) {
                    $brandId = Properties::getInstance()->getBrandIdByExId($propertyValue) ?: Properties::getInstance()->getBrandIdByName($propertyValue);
                    continue;
                }

                if (!isset($this->compare_properties[$propertyExId])) {
                    continue;
                }

                $propertyId = $this->compare_properties[$propertyExId]['id'];

                // if property is multiple, then correting value
                if (Properties::getInstance()->dictionaryProperties[$propertyExId]) {
                    $propertyValue = Properties::getInstance()->dictionaryProperties[$propertyExId][$propertyValue];
                }

                $shopProductPropertiesData[] = [
                                                'property_id' => $propertyId,
                                                'value'       => $propertyValue,
                                                'locale'      => $this->locale,
                                               ];

                if ($categoryId != NULL) {
                    $newRow = TRUE;
                    foreach ($this->productProCats as $row) {
                        if ($row['property_id'] == $propertyId & $row['category_id'] == $categoryId) {
                            $newRow = FALSE;
                            break;
                        }
                    }
                    if ($newRow == TRUE) {
                        $this->productProCats[] = [
                                                   'property_id' => $propertyId,
                                                   'category_id' => $categoryId,
                                                  ]; // TODO: то тоже тре бде потім розібрати
                    }
                }
            }
        }

        return [
                $shopProductPropertiesData,
                $brandId,
               ];
    }

    // ------------------------------ HELPERS ------------------------------

    /**
     * Inserting data into `shop_products`
     */
    protected function insert1() {

        $this->insertProducts($this->insertCollector->getData('shop_products'));
        $this->dataLoad->getNewData('products');

        // properties-categories relations
        if (count($this->productProCats) > 0) {
            $epc = $this->db->get('shop_product_properties_categories')->result_array();
            foreach ($this->productProCats as $key => $newRowData) {
                $newRowIsReallyNew = TRUE;
                foreach ($epc as $rowData) {
                    if ($newRowData['property_id'] == $rowData['property_id'] & $newRowData['category_id'] == $rowData['category_id']) {
                        unset($this->productProCats[$key]);
                        $newRowIsReallyNew = FALSE;
                        break;
                    }
                }
                if ($newRowIsReallyNew == FALSE) {
                    continue;
                }
            }
            $this->insertBatch('shop_product_properties_categories', $this->productProCats);
        }
    }

    private function insertProducts($data) {
        if (FALSE == (count($data) > 0)) {
            return;
        }

        foreach ($data as $value) {
            $routeUrl = $value['url'];
            unset($value['url']);
            $value['created'] = time();
            $value['updated'] = time();
            $this->db->set($value)->insert('shop_products');

            $id = $this->db->insert_id();

            $category_id = $value['category_id'];
            if (!array_key_exists($category_id, $this->categoryUrls)) {
                $parentRoute = RouteQuery::create()->filterByType(Route::TYPE_SHOP_CATEGORY)
                    ->findOneByEntityId($category_id);
                $this->categoryUrls[$category_id] = $parentRoute->getFullUrl();
            }

            $parentUrl = $this->categoryUrls[$category_id];

            $route = new Route();
            $route->setType(Route::TYPE_PRODUCT)
                ->setParentUrl($parentUrl)
                ->setUrl($routeUrl)
                ->setEntityId($id)
                ->save();

            $this->db->update('shop_products', ['route_id' => $route->getId()], ['id' => $id]);

        }

        $error = $this->db->_error_message();

        if (!empty($error)) {
            throw new Exception('Error on inserting into `shop_products`: ' . $error);
        }
        // gathering statistics
        ExchangeBase::$stats[] = [
                                  'query type'    => 'insert',
                                  'table name'    => 'shop_products',
                                  'affected rows' => count($data),
                                 ];
    }

    /**
     * Filling with product_id tables that need it, and inserting into other tables
     * @throws \Exception
     */
    protected function processProducts23_Insert23() {

        // process 2 (adding product_id to tables data)
        $products = &$this->insertCollector->getData('shop_products');
        $productsI18n = &$this->insertCollector->getData('shop_products_i18n');
        $variants = &$this->insertCollector->getData('shop_product_variants');
        $propertiesData = &$this->insertCollector->getData('shop_product_properties_data');
        $images = &$this->insertCollector->getData('shop_product_images');
        $productCategories = &$this->insertCollector->getData('shop_product_categories');
        $imagesToDelete = [];
        $propertiesData_ = [];
        $imagesForInsert = [];

        foreach ($this->productIds as $externalId => $productId) {
            if (FALSE == isset($products[$externalId])) {
                continue;
            }
            $productsI18n[$externalId]['id'] = $productId;
            if (isset($propertiesData[$externalId])) {
                foreach ($propertiesData[$externalId] as $oneProductPropData) {
                    $propertiesData_[] = array_merge($oneProductPropData, ['product_id' => $productId]);
                }
            }
            if (isset($images[$externalId])) {
                $countImgs = count($images[$externalId]);
                for ($i = 0; $i < $countImgs; $i++) {
                    $images[$externalId][$i]['product_id'] = $productId;
                    $imagesForInsert[] = $images[$externalId][$i];
                }
            }
            if (isset($this->imagesToDelete[$externalId])) {
                $imagesToDelete[] = $productId;
            }
            if (isset($productCategories[$externalId])) {
                $productCategories[$externalId]['product_id'] = $productId;
                if (FALSE == $this->isProductCategoriesRowNew($productCategories[$externalId])) {
                    unset($productCategories[$externalId]);
                }
            }
        }
        $this->insertCollector->unsetData('shop_product_properties_data');
        // insert 2 (inserting those which where needed product_id)
        $this->insertBatch('shop_products_i18n', $productsI18n);

        foreach ($variants as $variantExId => $variantData) {
            $productExId = array_shift(explode('#', $variantExId));
            $variants[$variantExId]['product_id'] = $this->productIds[$productExId];
        }

        $this->insertBatch('shop_product_variants', $variants);

        // adding shop_product_properties_data and shop_product_properties_data_i18n is not so ordinary...
        if (count($propertiesData_) > 0) {

            $data = $this->prepareProductPropertiesData($propertiesData_);
            $this->insertBatch('shop_product_properties_data', $data);
        }

        // inserting shop_product_categories
        $this->insertBatch('shop_product_categories', $productCategories);

        //process3 (variants)
        $variantsI18n = &$this->insertCollector->getData('shop_product_variants_i18n');

        $variantsIds = $this->dataLoad->getNewData('variantsIds');
        foreach ($variantsIds as $externalId => $variantId) {
            if (FALSE == isset($variantsI18n[$externalId])) {
                continue;
            }
            $variantsI18n[$externalId]['id'] = $variantId;
        }

        // insert 3
        $this->insertBatch('shop_product_variants_i18n', $variantsI18n);

        // deleting additional images, inserting new
        if ($imagesToDelete) {
            $this->db->where_in('product_id', $imagesToDelete)->delete('shop_product_images');
        }
        $this->insertBatch('shop_product_images', $imagesForInsert);
    }

    /**
     *
     * @param array $newRowData
     * @return boolean
     */
    protected function isProductCategoriesRowNew(array $newRowData) {

        if (!isset($this->existingRows)) {
            $this->existingRows = $this->db->get('shop_product_categories')->result_array();
        }

        foreach ($this->existingRows as $existingRowData) {
            if ($existingRowData['product_id'] == $newRowData['product_id'] & $existingRowData['category_id'] == $newRowData['category_id']) {
                return FALSE;
            }
        }
        return TRUE;
    }

    /**
     * Update all
     * @throws \Exception
     */
    protected function update() {

        // update has only two "passes" - as we already got product_id
        $this->updateFromCollector('shop_products', 'id');
        $this->updateFromCollector('shop_product_categories', 'product_id');
        $this->updateFromCollector('shop_products_i18n', 'id');
        //$this->updateFromCollector('shop_product_properties_data', 'product_id');
        //        $this->updateFromCollector('shop_product_images', 'product_id');
        $this->updateFromCollector('shop_product_variants', 'external_id');

        // get variants ids, and update variants_18n
        $variantsI18n = &$this->updateCollector->getData('shop_product_variants_i18n');

        $this->dataLoad->getNewData('variantsIds');
        foreach ($variantsI18n as $exId => $variantI18n) {
            $variantsI18n[$exId]['id'] = $this->variantsIds[$exId];
        }

        $this->updateBatch('shop_product_variants_i18n', $variantsI18n, 'id');

        $productsIdsWithImages = [];
        $additionalImages = [];
        $additionalImages_ = &$this->updateCollector->getData('shop_product_images');
        $countAddImgs = count($additionalImages_);
        for ($i = 0; $i < $countAddImgs; $i++) {
            foreach ($additionalImages_[$i] as $addImgData) {
                $productsIdsWithImages[] = $addImgData['product_id'];
            }
            $additionalImages = array_merge($additionalImages, $additionalImages_[$i]);
        }
        if ($productsIdsWithImages) {
            $this->db
                ->where_in('product_id', array_unique($productsIdsWithImages))
                ->delete('shop_product_images');
        }

        $this->insertBatch('shop_product_images', $additionalImages);
    }

    /**
     * Helper-method for updating
     * @param string $tableName
     * @param string $compareField
     * @throws \Exception
     */
    protected function updateFromCollector($tableName, $compareField) {

        $this->updateBatch($tableName, $this->updateCollector->getData($tableName), $compareField);
    }

    // ----------------------- end of HELPERS ------------------------------

    /**
     * Set shop categories for products
     * @throws Exception
     */
    public function rebuildAdditionalParentsCats() {

        $ids = [];

        foreach ($this->products as $products) {
            $ids[] = $products['id'];
        }

        $products = $this->db
            ->select('shop_products.category_id, shop_products.id, shop_category.full_path_ids, shop_category.parent_id, shop_category.id as cat_id')
            ->join('shop_category', 'shop_category.id = shop_products.category_id')
            ->where_in('shop_products.id', $ids)
            ->get('shop_products')
            ->result();

        foreach ($products as $p) {
            $this->parentCat[$p->id] = $p->category_id;
        }

        if ($this->ignoreExistingProducts) {
            // deleting only "path categories" data (parents)
            foreach ($this->additionalParentsCategories as $productId => $parentCategoriesIds) {

                array_push($parentCategoriesIds, $this->parentCat[$productId]);
                if ($parentCategoriesIds and in_array($productId, $ids)) {
                    $this->db
                        ->where('product_id', $productId)
                        ->where_in('category_id', $parentCategoriesIds)
                        ->delete('shop_product_categories');
                }
            }
        } else {
            $this->db->where_in('product_id', $ids)->delete('shop_product_categories');
        }

        foreach ($products as $product) {
            $pathIds = unserialize($product->full_path_ids);

            array_push($pathIds, $product->cat_id);
            foreach ($pathIds as $categoryId) {
                $this->db->insert(
                    'shop_product_categories',
                    [
                     'category_id' => $categoryId,
                     'product_id'  => $product->id,
                    ]
                );
            }
        }
    }

    private function runResize() {

        if ($this->runResize) {
            Image::create()
                ->resizeByName($this->imagesToResize)
                ->resizeByNameAdditional(array_unique($this->imagesToResizeAdditional));
        }
    }

    protected function rebuildProductProperties() {

        $productTableProperties = $this->db->select('shop_product_properties_data.property_id, shop_product_property_value_i18n.value, shop_product_property_value_i18n.locale')
            ->from('shop_product_properties_data')
            ->join('shop_product_property_value', 'shop_product_properties_data.value_id = shop_product_property_value.id')
            ->join('shop_product_property_value_i18n', 'shop_product_property_value.id = shop_product_property_value_i18n.id')
            ->get()->result_array();

        $propertiesTableValues = $this->db->select('id, data, locale')->get('shop_product_properties_i18n')->result_array();

        //  array:
        //      [property_id][array property_locales][array property_values]

        $productPropertiesOrdered = [];

        foreach ($productTableProperties as $one) {
            if (!isset($productPropertiesOrdered[$one['property_id']])) {
                $productPropertiesOrdered[$one['property_id']] = [];
            }
            if (!isset($productPropertiesOrdered[$one['property_id']][$one['locale']])) {
                $productPropertiesOrdered[$one['property_id']][$one['locale']] = [];
            }
            if (!in_array($one['value'], $productPropertiesOrdered[$one['property_id']][$one['locale']], true)) {
                array_push($productPropertiesOrdered[$one['property_id']][$one['locale']], $one['value']);
            }
        }

        foreach ($propertiesTableValues as $one) {
            $id = $one['id'];
            $locale = $one['locale'];
            $insertData = [];
            $res = true;
            $error = false;

            if (array_key_exists($id, $productPropertiesOrdered) && array_key_exists($locale, $productPropertiesOrdered[$id])) {
                $onePropertyValues = unserialize($one['data']) ?: [];
                $insertData['data'] = serialize(array_unique(array_merge($onePropertyValues, $productPropertiesOrdered[$id][$locale])));
                $res = $res && $this->db->where('id', $id)->update('shop_product_properties_i18n', $insertData);
                $error = $this->db->_error_message() ?: $error;
            }
        }
    }

    /**
     * @param bool $run_resize
     * @return $this
     */
    public function setResize($run_resize = FALSE) {

        $this->runResize = $run_resize;
        return $this;
    }

    /**
     * Setting temporary folder with import data. Mantadory!
     * @param string $tempDir
     * @return $this
     */
    public function setTempDir($tempDir) {

        $this->tempDir = $tempDir;
        return $this;
    }

    private function getPropertyValueIdOrCreate($propertyId, $value, $locale) {
        $valueModel = \SPropertyValueQuery::create()
            ->joinWithI18n($locale, Criteria::INNER_JOIN)
            ->useI18nQuery($locale)
            ->filterByValue($value)
            ->endUse()
            ->filterByPropertyId($propertyId)
            ->findOne();

        if (!$valueModel) {
            $valueModel = new \SPropertyValue();
            $valueModel->setPropertyId($propertyId)
                ->setValue($value)
                ->setLocale($locale)
                ->save();

        }

        return $valueModel->getId();
    }

    private function prepareProductPropertiesData($propertiesData) {

        $data = [];
        foreach ($propertiesData as $key => $item) {

            $dataItem = [
                         'property_id' => $item['property_id'],
                         'product_id'  => $item['product_id'],
                         'value_id'    => $this->getPropertyValueIdOrCreate($item['property_id'], $item['value'], $item['locale']),

                        ];
            $data[] = $dataItem;
        }

        return $data;
    }

}