<?php

namespace import_export\classes;

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 *
 * @property \CI_DB_active_record $db
 */
class ProductsImport extends BaseImport {

    protected static $_instance;
    private $imagetemppath = './uploads/temp/';
    private $imageOriginPath = './uploads/shop/products/origin/';
    private $mainCur = array();

    public function __construct() {
        $this->load->helper('translit');
        parent::__construct();

        $this->mainCur = $this->db
                ->get_where('shop_currencies', array('is_default' => '1'))
                ->row_array();

        ini_set('max_execution_time', 9000000);
        set_time_limit(9000000);
    }

    /**
     * Start Import process
     * @access public
     * @author Kaero
     * @copyright ImageCMS (c) 2012, Kaero <dev@imagecms.net>
     */
    public function make() {
        if (ImportBootstrap::hasErrors())
            return FALSE;
        self::create()->processBrands();
        self::create()->startCoreProcess();
//        $this->copyImages($this->imagesForImport());
    }

    /**
     * Start Core Process
     * @author Kaero
     * @copyright ImageCMS (c) 2012, Kaero <dev@imagecms.net>
     */
    private function startCoreProcess() {
        foreach (BaseImport::create()->content as $key => $node) {

            $result = $this->db
                    ->limit(1)
                    ->select('shop_product_variants.product_id as ProductId')
                    ->select('shop_products.category_id as SCategoryId')
                    ->select('shop_products_i18n.name as ProductName')
                    ->join('shop_products', 'shop_products.id = shop_product_variants.product_id', 'left outer')
                    ->join('shop_products_i18n', 'shop_products_i18n.id = shop_products.id')
                    ->where('number', $node['num'])
                    ->get('shop_product_variants')
                    ->row();

            $mas[$key] = (!($result instanceof \stdClass)) ?
                    $this->runProductInsertQuery($node) :
                    $this->runProductUpdateQuery($result->ProductId, $node);

            BaseImport::create()->content[$key]['ProductId'] = $mas[$key]['ProductId'];
            $ids[$key] = $mas[$key]['variantId'];
            BaseImport::create()->content[$key]['variantId'] = $mas[$key]['variantId'];
        }

        ImportBootstrap::addMessage(implode('/', $ids), 'content');
        $this->runCopyImages(BaseImport::create()->content);
    }

    /**
     * Run Product Update Query
     * @param array $arg Processed arguments list
     * @return bool
     * @author Kaero
     * @access private
     * @copyright ImageCMS (c) 2012, Kaero <dev@imagecms.net>
     */
    public function runProductUpdateQuery($productId, $arg) {
        if ($arg['url'] != '')
            $arg['url'] = $this->urlCheck($arg['url'], $productId);

        if ($arg['imgs'] != '')
            $arg['imgs'] = $this->runAditionalImages($arg, $productId);

        if ($arg['name'] == '')
            return;

        if ($arg['cat'] == '')
            return;


        /* START product Update query block */
        $prepareNames = $binds = $updateData = array();

        $productAlias = array(
            'act' => 'active',
            'CategoryId' => 'category_id',
            'url' => 'url',
            'oldprc' => 'old_price',
            'hit' => 'hit',
            'BrandId' => 'brand_id',
            'relp' => 'related_products',
            'mimg' => 'mainImage',
            'simg' => 'smallImage',
            'modim' => 'mainModImage',
            'modis' => 'smallModImage'
        );

        foreach ($arg as $key => $val)
            if (isset($productAlias[$key])) {
                array_push($prepareNames, $productAlias[$key]);
                $binds[$productAlias[$key]] = $val;
            }

        $prepareNames = array_merge($prepareNames, array('updated'));
        $binds = array_merge($binds, array('updated' => date('U')));

        foreach ($prepareNames as $value)
            $updateData[] = $value . '="' . $binds[$value] . '"';

        $this->db->query('UPDATE shop_products SET ' . implode(',', $updateData) . ' WHERE `id`= ?', array($productId));
        /* END product Update query block */

        /* START product i18n Update query block */
        $prepareNames = $binds = $updateData = array();

        $productAlias = array(
            'name' => 'name',
            'shdesc' => 'short_description',
            'desc' => 'full_description',
            'vimg' => 'mainImage',
            'mett' => 'meta_title',
            'metd' => 'meta_description',
            'metk' => 'meta_keywords');

        foreach ($arg as $key => $val)
            if (isset($productAlias[$key])) {
                array_push($prepareNames, $productAlias[$key]);
                $binds[$productAlias[$key]] = $val;
                $updateData[] = '`' . $productAlias[$key] . '`="' . str_replace('"', '""', $val) . '"';
            }

        $this->db->query('UPDATE shop_products_i18n SET ' . implode(',', $updateData) . ' WHERE `id`= ' . $productId . ' AND `locale`= "' . $this->languages . '"');
        /* END product i18n Update query block */

        $this->updateSProductsCategories($arg, $productId);
        $varId = $this->runProductVariantUpdateQuery($arg, $productId);

        return array(
            'ProductId' => $productId,
            'variantId' => $varId);
    }

    /**
     * Run Product Variant Update Query
     * @param array $arg Processed arguments list
     * @param int $productId Product Id for alias
     * @return bool
     * @access private
     * @author Kaero
     * @copyright ImageCMS (c) 2012, Kaero <dev@imagecms.net>
     */
    private function runProductVariantUpdateQuery(&$arg, &$productId) {
        /* START product variant insert query block */
        if ($arg['name'] == '')
            return;

        $prepareNames = $binds = $updateData = array();

        $productAlias = array(
            'stk' => 'stock',
            'prc' => 'price',
            'num' => 'number');

        if (isset($arg['prc'])) {
            $arg['prc'] = str_replace(',', '.', $arg['prc']);
        }

        foreach ($arg as $key => $val)
            if (isset($productAlias[$key])) {
                array_push($prepareNames, $productAlias[$key]);
                $binds[$productAlias[$key]] = $val;
            }

        $prepareNames = array_merge($prepareNames, array('currency', 'price_in_main'));

        $cur = $this->db->select('id')
                        ->get_where('shop_currencies', array('id' => $arg['cur']))
                        ->row()->id;

        if ($cur == null)
            $cur = $this->mainCur['id'];

        $binds = array_merge($binds, array(
            'currency' => $cur,
            'price_in_main' => $arg['prc']));

        foreach ($prepareNames as $value)
            $updateData[] = $value . '="' . $binds[$value] . '"';

        $this->db->query('UPDATE shop_product_variants SET ' . implode(',', $updateData) . ' WHERE `number`= ? AND `product_id` = ?', array($arg['num'], $productId));

        $variantModel = $this->db->query('SELECT id FROM shop_product_variants WHERE `number` = ? AND `product_id` = ?', array($arg['num'], $productId))->row();
        /* END product variant insert query block */

        /* START product variant i18n insert query block */
        $prepareNames = $binds = $updateData = array();
        $productAlias = (isset($arg['var'])) ? array('var' => 'name') : array('name' => 'name');

        foreach ($arg as $key => $val)
            if (isset($productAlias[$key])) {
                array_push($prepareNames, $productAlias[$key]);
                $binds[$productAlias[$key]] = $val;
                $updateData[] = $productAlias[$key] . '="' . str_replace('"', '""', $val) . '"';
            }

        $this->db->query('UPDATE shop_product_variants_i18n SET ' . implode(',', $updateData) . ' WHERE `locale`= ? AND `id` = ?', array($this->languages, $variantModel->id));
        /* END product variant i18n insert query block */

        return $variantModel->id;
    }

    /**
     * Run Product Insert Query
     * @param array $arg Processed arguments list
     * @return bool
     * @author Kaero
     * @access private
     * @copyright ImageCMS (c) 2012, Kaero <dev@imagecms.net>
     */
    private function runProductInsertQuery($arg) {
        if ($arg['name'] == '')
            return;

        if ($arg['cat'] == '')
            return;

        $this->load->helper('string');

        $result = $this->db
                ->where('name', $arg['name'])
                ->get('shop_products_i18n')
                ->row();

        if ($arg['act'] == null)
            $arg['act'] = 1;

        if ($result) {
            $this->updateSProductsCategories($arg, $result->id);
            $varId = $this->runProductVariantInsertQuery($arg, $result->id);
            return array(
                'ProductId' => $result->id,
                'variantId' => $varId);
        }

        /* START product insert query block */
        $prepareNames = $binds = array();
        $productAlias = array(
            'act' => 'active',
            'CategoryId' => 'category_id',
            'oldprc' => 'old_price',
            'hit' => 'hit',
            'BrandId' => 'brand_id',
            'relp' => 'related_products',
            'mimg' => 'mainImage',
            'simg' => 'smallImage',
            'modim' => 'mainModImage',
            'modis' => 'smallModImage');

        foreach ($arg as $key => $val)
            if (isset($productAlias[$key])) {
                array_push($prepareNames, $productAlias[$key]);
                $binds[$productAlias[$key]] = $val;
            }

        $prepareNames = array_merge($prepareNames, array('created', 'updated', 'url'));

        $binds = array_merge($binds, array(
            'created' => date('U'),
            'updated' => date('U'),
            'url' => 'temp'));

        $this->db->query('INSERT INTO shop_products (' . implode(',', $prepareNames) . ') VALUES (' . substr(str_repeat('?,', count($prepareNames)), 0, -1) . ')', $binds);
        $productId = $this->db->insert_id();

        $this->db->query('UPDATE shop_products SET `url`= ? WHERE `id`= ?', array($this->urlCheck($arg['url'], $productId, $arg['name']), $productId));
        /* END product insert query block */

        if ($arg['imgs'] != '')
            $arg['imgs'] = $this->runAditionalImages($arg, $productId);

        /* START product i18n insert query block */
        $prepareNames = $binds = array();

        $productAlias = array(
            'name' => 'name',
            'shdesc' => 'short_description',
            'desc' => 'full_description',
            'mett' => 'meta_title',
            'metd' => 'meta_description',
            'metk' => 'meta_keywords');

        foreach ($arg as $key => $val)
            if (isset($productAlias[$key])) {
                array_push($prepareNames, $productAlias[$key]);
                $binds[$productAlias[$key]] = $val;
            }
        $prepareNames = array_merge($prepareNames, array('locale', 'id'));

        $binds = array_merge($binds, array(
            'locale' => $this->languages,
            'id' => $productId));

        $this->db->query('INSERT INTO shop_products_i18n (' . implode(',', $prepareNames) . ') VALUES (' . substr(str_repeat('?,', count($prepareNames)), 0, -1) . ')', $binds);
        /* END product i18n insert query block */

        $this->updateSProductsCategories($arg, $productId);
        $varId = $this->runProductVariantInsertQuery($arg, $productId);

        return array(
            'ProductId' => $productId,
            'variantId' => $varId);
    }

    /**
     * Run Product Variant Insert Query
     * @param array $arg Processed arguments list
     * @param int $productId Product Id for alias
     * @return bool
     * @access private
     * @author Kaero
     * @copyright ImageCMS (c) 2012, Kaero <dev@imagecms.net>
     */
    private function runProductVariantInsertQuery(&$arg, &$productId) {
        if (isset($arg['prc'])) {
            $arg['prc'] = str_replace(',', '.', $arg['prc']);
        } else {
            $arg['prc'] = 0;
        }

        $arg['stk'] = isset($arg['stk']) ? $arg['stk'] : 0;

        /* START product variant insert query block */
        $prepareNames = $binds = array();
        $productAlias = array(
            'stk' => 'stock',
            'prc' => 'price',
            'num' => 'number');

        foreach ($arg as $key => $val)
            if (isset($productAlias[$key])) {
                array_push($prepareNames, $productAlias[$key]);
                $binds[$productAlias[$key]] = $val;
            }

        $cur = $this->db->select('id')
                        ->get_where('shop_currencies', array('id' => $arg['cur']))
                        ->row()->id;

        if ($cur == null)
            $cur = $this->mainCur['id'];

        $prepareNames = array_merge($prepareNames, array('product_id', 'currency', 'price_in_main', 'position'));
        $binds = array_merge($binds, array(
            'product_id' => $productId,
            'currency' => $cur,
            'price_in_main' => $arg['prc'], 0));
        $this->db->query('INSERT INTO shop_product_variants (' . implode(',', $prepareNames) . ')
            VALUES (' . substr(str_repeat('?,', count($prepareNames)), 0, -1) . ')', $binds);
        $productVariantId = $this->db->insert_id();
        /* END product variant insert query block */

        /* START product variant i18n insert query block */
        $prepareNames = $binds = array();
        $productAlias = (isset($arg['var'])) ? array('var' => 'name') : array('name' => 'name');
        foreach ($arg as $key => $val)
            if (isset($productAlias[$key])) {
                array_push($prepareNames, $productAlias[$key]);
                $binds[$productAlias[$key]] = $val;
            }

        $prepareNames = array_merge($prepareNames, array('id', 'locale'));
        $binds = array_merge($binds, array(
            'id' => $productVariantId,
            'locale' => $this->languages));
        $this->db->query('INSERT INTO shop_product_variants_i18n (' . implode(',', $prepareNames) . ')
            VALUES (' . substr(str_repeat('?,', count($prepareNames)), 0, -1) . ')', $binds);
        /* END product variant i18n insert query block */

        return $productVariantId;
    }

    /**
     * Update Shop Products Categories
     * @param array $arg Processed arguments list
     * @param int $productId Product Id for alias
     * @return bool
     * @author Kaero
     * @copyright ImageCMS (c) 2012, Kaero <dev@imagecms.net>
     */
    private function updateSProductsCategories(&$arg, $productId) {
        $this->db->delete('shop_product_categories', array('product_id' => $productId));
        foreach ($arg['CategoryIds'] as $categoryId) {
            try {
                $this->db->insert('shop_product_categories', array(
                    'product_id' => $productId,
                    'category_id' => $categoryId));
            } catch (Exception $exc) {
                echo $exc->getTraceAsString();
            }
        }
    }

    /**
     * Process Brands
     * @param int $key
     * @param array $node
     * @return type
     * @author Kaero
     * @copyright ImageCMS (c) 2012, Kaero <dev@imagecms.net>
     */
    protected function processBrands() {
        $this->load->helper('translit');
        foreach (BaseImport ::create()->content as $key => $node) {
            if (isset($node['brd']) && !empty($node['brd'])) {
                $result = $this->db->query("
                SELECT SBrands.id as BrandId
                FROM `shop_brands` as SBrands
                LEFT OUTER JOIN `shop_brands_i18n` AS SBrandsI18n ON SBrandsI18n.id = SBrands.id
                WHERE SBrandsI18n.name = ? AND locale = ?
                LIMIT 1", array($node['brd'], $this->languages))->row();
                if (!($result instanceof \stdClass)) {
                    $this->db->insert('shop_brands', array('url' => translit_url($node['brd'])));
                    $brandId = $this->db->insert_id();
                    $this->db->insert('shop_brands_i18n', array('name' => $node['brd'], 'locale' => $this->languages, 'id' => $brandId));
                    BaseImport::create()->content[$key]['BrandId'] = $brandId;
                } else {
                    BaseImport::create()->content[$key]['BrandId'] = $result->BrandId;
                }
            }
        }
    }

    /**
     * ProductsImport Singleton
     * @return ProductsImport
     * @access public
     * @author Kaero
     * @copyright ImageCMS (c) 2012, Kaero <dev@imagecms.net>
     */
    public static function create() {
        (null !== self::$_instance) OR self::$_instance = new self();
        return self::$_instance;
    }

    //return images names for import
    private function imagesForImport() {
        foreach (BaseImport ::create()->content as $key => $node) {
            if ($node['num'] != '')
                if ($node['mimg'] != '' OR $node['simg'] != '' OR $node['modim'] != '') {
                    $result[$node['num']]['mimg'] = $node['mimg'];
                    $result[$node['num']]['simg'] = $node['simg'];
                    $result[$node['num']]['modim'] = $node['modim'];
                }
        }


        return $result;
    }

    private function copyImages($result) {

        $imageNames = array(
            'mimg' => 'main',
            'simg' => 'small',
            'modim' => 'mainMod');

        if (is_array($result)) {
            foreach ($result as $key => $item) {
                $pId = $this->db->query("SELECT DISTINCT `product_id` FROM `shop_product_variants` WHERE `number`='" . $key . "'")->row_array();
                foreach ($item as $k => $v) {
                    if ($v != '')
                        if (file_exists($this->imagetemppath . $v)) {
                            if (file_exists($pId['product_id'] . "_main_origin.jpg"))
                                unlink($pId['product_id'] . "_main_origin.jpg");
                            if ($imageNames[$k] == 'main')
                                copy($this->imagetemppath . $v, 'uploads/shop/origin/' . $pId ['product_id'] . "_" . $imageNames[$k] . "_origin.jpg");
                            switch ($imageNames[$k]) {
                                case 'main': $imagename = $pId['product_id'] . '_main.jpg';
                                    break;
                                case 'small': $imagename = $pId['product_id'] . '_small.jpg';
                                    break;
                                case 'mainMod': $imagename = $pId['product_id'] . '_mainMod.jpg';
                                    break;
                            }
                            copy($this->imagetemppath . $v, 'uploads/shop/' . $imagename);
                        }
                }
            }
        } else
            return false;
    }

    private function runCopyImages($result) {
        foreach ((array) $result as $key => $item) {

            if (($item['vimg'] != '') && (file_exists($this->imagetemppath . $item['vimg']))) {

                copy($this->imagetemppath . $item['vimg'], $this->imageOriginPath . $item['vimg']);

                $this->db->set('mainImage', $item['vimg']);
                $this->db->where('id', $item['variantId']);
                $this->db->update('shop_product_variants');
            }

//            if (($item['vimg'] != '') && (file_exists($this->imagetemppath . $item['vimg']))) {
//                $ext = pathinfo($item['vimg'], PATHINFO_EXTENSION);
//                copy($this->imagetemppath . $item['vimg'], "./uploads/shop/origin/$item['ProductId']_vM$item['variantId'].$ext");
//
//                $this->db->set('mainImage', "$item['ProductId']_vM$item['variantId'].$ext");
//            } else {
//                if (file_exists($this->imagetemppath . $item['mimg'])) {
//                    $ext = pathinfo($item['mimg'], PATHINFO_EXTENSION);
//                    copy($this->imagetemppath . $item['mimg'], "./uploads/shop/origin/$item['ProductId']_vM$item['variantId'].$ext");
//
//                    $this->db->set('mainImage', "$item['ProductId']_vM$item['variantId'].$ext");
//                }
//                else
//                    $this->db->set('mainImage', null);
//            }
//
//            if (($item['vsimg'] != '') && (file_exists($this->imagetemppath . $item['vsimg']))) {
//                $ext = pathinfo($item['vsimg'], PATHINFO_EXTENSION);
//                copy($this->imagetemppath . $item['vsimg'], "./uploads/shop/origin/$item['ProductId']_vS$item['variantId'].$ext");
//
//                $this->db->set('smallImage', "$item['ProductId']_vS$item['variantId'].$ext");
//            } else {
//                if (file_exists($this->imagetemppath . $item['mimg'])) {
//                    $ext = pathinfo($item['mimg'], PATHINFO_EXTENSION);
//                    copy($this->imagetemppath . $item['mimg'], "./uploads/shop/origin/$item['ProductId']_vM$item['variantId'].$ext");
//
//                    $this->db->set('mainImage', "$item['ProductId']_vM$item['variantId'].$ext");
//                }
//                else
//                    $this->db->set('mainImage', null);
//            }
//
//            $this->db->where('id', $item['variantId']);
//            $this->db->update('shop_product_variants');
        }
    }

    function urlCheck($url, $id = '', $name = '') {

        if ($url == '')
            return translit_url(trim($name));

// Check if Url is aviable.
        $urlCheck = $this->db
                ->select('url,id')
                ->where('url ', $url)
                ->where('`id` !=' . $id)
                ->get('shop_products')
                ->row();

        if ($urlCheck->id != $id)
            return $url;
        else
            return $id . '_' . random_string('alnum', 8);
    }

    function runAditionalImages($arg, $id) {
        $this->db->delete('shop_product_images', array('product_id' => $id));

        $arg['imgs'] = explode(',', $arg['imgs']);

        foreach ((array) $arg['imgs'] as $key => $img) {
            $this->db->set('product_id', $id);
            $img = trim($img);
            if (file_exists($this->imagetemppath . $img)) {
                copy($this->imagetemppath . $img, "./uploads/shop/products/origin/additional/$img");

                $this->db->set('image_name', $img);
                $this->db->set('position', $key);
            }
            $this->db->insert('shop_product_images');
        }
    }

}
