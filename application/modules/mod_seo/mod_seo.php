<?php

use CMSFactory\assetManager;
use CMSFactory\Events;
use CMSFactory\MetaManipulator\ShopBrandMetaManipulator;
use CMSFactory\MetaManipulator\ShopCategoryMetaManipulator;
use CMSFactory\MetaManipulator\MetaStorage;
use CMSFactory\MetaManipulator\ShopProductMetaManipulator;
use Currency\Currency;
use Propel\Runtime\ActiveQuery\Criteria;

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 *
 * @property Smartseo_model $seoexpert_model
 * @property Seoexpert_model_products $seoexpert_model_products
 * @author <dev@imagecms.net>
 * @copyright ImageCMS (c) 2014
 */
class Mod_seo extends MY_Controller
{

    public function __construct() {

        parent::__construct();
        $this->load->model('seoexpert_model');
        $this->load->model('seoexpert_model_products');
        $this->load->helper('translit');

        $lang = new MY_Lang();
        $lang->load('mod_seo');
    }

    /**
     * Build Meta for Shop Brand
     * @param array $arg
     * @return false|null
     */
    public function _buildBrandMeta($arg) {

        $pageNumber = (int) assetManager::create()->getData('page_number');

        $local = MY_Controller::getCurrentLocale();
        /* @var $model SBrands */
        $model = $arg['model'];
        $settings = CI::$APP->seoexpert_model->getSettings($local);

        CI::$APP->seoexpert_model->setLastModified($model->getUpdated());

        if ($settings['useBrandPattern'] != 1) {
            return FALSE;
        }

        if ($settings['useBrandPatternForEmptyMeta'] == 1 && trim($model->getMetaTitle()) != '') {
            $templateTitle = trim($model->getMetaTitle());
        } else {
            $templateTitle = $settings['brandTemplate'];
        }

        if ($settings['useBrandPatternForEmptyMeta'] == 1 && trim($model->getMetaDescription()) != '') {
            $templateDesc = trim($model->getMetaDescription());
        } else {
            $templateDesc = $settings['brandTemplateDesc'];
        }

        if ($settings['useBrandPatternForEmptyMeta'] == 1 && trim($model->getMetaKeywords()) != '') {
            $templateKey = trim($model->getMetaKeywords());
        } else {
            $templateKey = $settings['brandTemplateKey'];
        }

        $descCount = $settings['brandTemplateDescCount'];
        $pagePattern = $settings['brandPaginationTemplate'];
        $pagePattern = str_replace('%number%', $pageNumber, $pagePattern);

        $template = new MetaStorage();
        $template->setTitleTemplate($templateTitle);
        $template->setDescriptionTemplate($templateDesc);
        $template->setKeywordsTemplate($templateKey);

        $metaManipulator = new ShopBrandMetaManipulator($model, $template);
        $meta = $metaManipulator->render();

        // Set meta tags
        self::setMetaTags($meta['metaTitle'], $meta['metaKeywords'], mb_substr($meta['metaDescription'], 0, $descCount));
    }

    /**
     * @param string $template
     * @param string $templateKey
     * @param string $templateDesc
     */
    private static function setMetaTags($template, $templateKey, $templateDesc) {

        //clean up unused properties
        $template = preg_replace('/%.*%/', '', $template);
        $templateKey = preg_replace('/%.*%/', '', $templateKey);
        $templateDesc = preg_replace('/%.*%/', '', $templateDesc);

        $template = str_replace('&nbsp;', ' ', $template);
        $templateKey = str_replace('&nbsp;', ' ', $templateKey);
        $templateDesc = str_replace('&nbsp;', ' ', $templateDesc);

        CI::$APP->core->set_meta_tags($template, $templateKey, mb_substr($templateDesc, 0));
    }

    /**
     * Build Meta for Shop Brands page
     * @return false|null
     */
    public function _buildBrandsMeta() {

        $local = MY_Controller::getCurrentLocale();
        $settings = CI::$APP->seoexpert_model->getSettings($local);

        if ($settings['useBrandsListPattern'] != 1) {
            return FALSE;
        }

        $template = $settings['brandsListTemplate'];
        $templateDesc = $settings['brandsListTemplateDesc'];
        $templateKey = $settings['brandsListTemplateKey'];

        self::setMetaTags($template, $templateKey, mb_substr($templateDesc, 0));
    }

    /**
     * Build Meta for Shop Category
     * @param array $categoryObj
     * @return false|null
     */
    public static function _buildCategoryMeta($categoryObj) {

        CI::$APP->load->helper('array_helper');

        $local = MY_Controller::getCurrentLocale();
        /* @var $model SCategory */
        $model = $categoryObj->data['category'];

        CI::$APP->seoexpert_model->setLastModified($model->getUpdated());

        $settings = ShopCore::$ci->seoexpert_model->getSettings($local);
        $pageNumber = (int) assetManager::create()->getData('page_number');

        $obj = new Mod_seo();

        if ($model->getParentId()) {
            if ($settings['usesubcategoryPattern'] != 1) {
                return FALSE;
            }
            if ($settings['usesubcategoryPatternForEmptyMeta'] == 1 && trim($model->getMetaTitle()) != '') {
                $templateTitle = trim($model->getMetaTitle());
            } else {
                $templateTitle = $settings['subcategoryTemplate'];
            }

            if ($settings['usesubcategoryPatternForEmptyMeta'] == 1 && trim($model->getMetaDesc()) != '') {
                $templateDesc = trim($model->getMetaDesc());
            } else {
                $templateDesc = $settings['subcategoryTemplateDesc'];
            }

            if ($settings['usesubcategoryPatternForEmptyMeta'] == 1 && trim($model->getMetaKeywords()) != '') {
                $templateKey = trim($model->getMetaKeywords());
            } else {
                $templateKey = $settings['subcategoryTemplateKey'];
            }

            $descCount = $settings['subcategoryTemplateDescCount'];
            $brandsCount = $settings['subcategoryTemplateBrandsCount'];
            $pagePattern = $settings['subcategoryTemplatePaginationTemplate'];
            $pagePattern = str_replace('%number%', $pageNumber, $pagePattern);
        } else {
            if ($settings['useCategoryPattern'] != 1) {
                return FALSE;
            }

            if ($settings['useCategoryPatternForEmptyMeta'] == 1 && trim($model->getMetaTitle()) != '') {
                $templateTitle = trim($model->getMetaTitle());
            } else {
                $templateTitle = $settings['categoryTemplate'];
            }

            if ($settings['useCategoryPatternForEmptyMeta'] == 1 && trim($model->getMetaDesc()) != '') {
                $templateDesc = trim($model->getMetaDesc());
            } else {
                $templateDesc = $settings['categoryTemplateDesc'];
            }

            if ($settings['useCategoryPatternForEmptyMeta'] == 1 && trim($model->getMetaKeywords()) != '') {
                $templateKey = trim($model->getMetaKeywords());
            } else {
                $templateKey = $settings['categoryTemplateKey'];
            }

            $descCount = $settings['categoryTemplateDescCount'];
            $brandsCount = $settings['categoryTemplateBrandsCount'];
            $pagePattern = $settings['categoryTemplatePaginationTemplate'];
            $pagePattern = str_replace('%number%', $pageNumber, $pagePattern);
        }

        $metaStorage = new MetaStorage();
        $metaStorage->setTitleTemplate($templateTitle);
        $metaStorage->setDescriptionTemplate($templateDesc);
        $metaStorage->setKeywordsTemplate($templateKey);

        $metaManipulator = new ShopCategoryMetaManipulator($model, $metaStorage);
        $meta = $metaManipulator->render();

        // Set meta tags
        self::setMetaTags($meta['metaTitle'], $meta['metaKeywords'], mb_substr($meta['metaDescription'], 0, $descCount));
    }

    /**
     * Inflect words
     * @param string $what
     * @param integer $inflection_id (1-6) - the cases of words
     * @return string
     */
    public function inflect($what, $inflection_id) {

        $resInflected = $this->db
            ->where('original', $what)
            ->where('inflection_id', $inflection_id)
            ->get('mod_seo_inflect')
            ->row_array();

        $foundRes = FALSE;
        if ($resInflected) {
            $inflected = $resInflected['inflected'];
        } else {
            $parser = xml_parser_create();
            $data = @file_get_contents('http://export.yandex.ru/inflect.xml?name=' . urlencode($what));
            if ($data) {
                xml_parse_into_struct($parser, $data, $structure);

                if ($structure) {
                    foreach ($structure as $key) {

                        if (!isset($key['tag']) || !isset($key['value'])) {
                            continue;
                        } elseif ($key['tag'] == 'INFLECTION') {

                            if ($key['attributes']['CASE'] == $inflection_id) {
                                $foundRes = TRUE;

                                $inflected = $key['value'];
                                $dataArray = [
                                    'original' => $what,
                                    'inflection_id' => $inflection_id,
                                    'inflected' => $inflected,
                                ];

                                $this->db->insert('mod_seo_inflect', $dataArray);
                            }
                        }
                    }

                    if ($foundRes !== TRUE) {
                        for ($i = 2; $i <= 6; $i++) {
                            $dataArray = [
                                'original' => $what,
                                'inflection_id' => $i,
                                'inflected' => $what,
                            ];

                            $this->db->insert('mod_seo_inflect', $dataArray);
                        }
                    }
                }
            }
            xml_parser_free($parser);
        }
        if ($inflected == "") {
            $inflected = $what;
        }

        return $inflected;
    }

    /**
     * Change page category meta tags
     *
     * @param array $model
     * @return false|null
     */
    public static function _buildPageCategoryMeta($model) {

        $local = MY_Controller::getCurrentLocale();

        CI::$APP->seoexpert_model->setLastModified($model['updated']);

        $settings = CI::$APP->seoexpert_model->getSettings($local);
        $obj = new Mod_seo();

        if ($settings['usePageCategoryPattern'] != 1) {
            return FALSE;
        }

        // Use for Empty meta
        if ($settings['usePageCategoryPatternForEmptyMeta'] == 1 && trim($model['title']) != '') {
            $template = trim($model['title']);
        } else {
            $template = $settings['pageCategoryTemplateTitle'];
        }

        if ($settings['usePageCategoryPatternForEmptyMeta'] == 1 && trim($model['description']) != '') {
            $templateDesc = trim($model['description']);
        } else {
            $templateDesc = $settings['pageCategoryTemplateDesc'];
        }

        if ($settings['usePageCategoryPatternForEmptyMeta'] == 1 && trim($model['keywords']) != '') {
            $templateKey = trim($model['keywords']);
        } else {
            $templateKey = $settings['pageCategoryTemplateKey'];
        }

        $pageNumber = (int) assetManager::create()->getData('page_number');
        $pagePattern = $settings['pageCategoryTemplatePaginationTemplate'];
        $pagePattern = str_replace('%number%', $pageNumber, $pagePattern);

        if ($pageNumber <= 1) {
            $pagePattern = '';
        }
        // Replace variables for title

        $template = (strstr($template, '%name%')) ? str_replace('%name%', $model['name'], $template) : $template;
        $template = (strstr($template, '%pagenumber%')) ? str_replace('%pagenumber%', $pagePattern, $template) : $template;
        // category name translit
        $template = (strstr($template, '%name[t]%')) ? str_replace('%name[t]%', translit($model['name']), $template) : $template;

        // the cases of words
        $template = (strstr($template, '%name[1]%')) ? str_replace('%name[1]%', $obj->inflect($model['name'], 1), $template) : $template;
        $template = (strstr($template, '%name[2]%')) ? str_replace('%name[2]%', $obj->inflect($model['name'], 2), $template) : $template;
        $template = (strstr($template, '%name[3]%')) ? str_replace('%name[3]%', $obj->inflect($model['name'], 3), $template) : $template;
        $template = (strstr($template, '%name[4]%')) ? str_replace('%name[4]%', $obj->inflect($model['name'], 4), $template) : $template;
        $template = (strstr($template, '%name[5]%')) ? str_replace('%name[5]%', $obj->inflect($model['name'], 5), $template) : $template;
        $template = (strstr($template, '%name[6]%')) ? str_replace('%name[6]%', $obj->inflect($model['name'], 6), $template) : $template;

        // the cases of words and translit
        $template = (strstr($template, '%name[1][t]%') || strstr($template, '%name[t][1]%')) ? str_replace(['%name[1][t]%', '%name[t][1]%'], translit($obj->inflect($model['name'], 1)), $template) : $template;
        $template = (strstr($template, '%name[2][t]%') || strstr($template, '%name[t][2]%')) ? str_replace(['%name[2][t]%', '%name[t][2]%'], translit($obj->inflect($model['name'], 2)), $template) : $template;
        $template = (strstr($template, '%name[3][t]%') || strstr($template, '%name[t][3]%')) ? str_replace(['%name[3][t]%', '%name[t][3]%'], translit($obj->inflect($model['name'], 3)), $template) : $template;
        $template = (strstr($template, '%name[4][t]%') || strstr($template, '%name[t][4]%')) ? str_replace(['%name[4][t]%', '%name[t][4]%'], translit($obj->inflect($model['name'], 4)), $template) : $template;
        $template = (strstr($template, '%name[5][t]%') || strstr($template, '%name[t][5]%')) ? str_replace(['%name[5][t]%', '%name[t][5]%'], translit($obj->inflect($model['name'], 5)), $template) : $template;
        $template = (strstr($template, '%name[6][t]%') || strstr($template, '%name[t][6]%')) ? str_replace(['%name[6][t]%', '%name[t][6]%'], translit($obj->inflect($model['name'], 6)), $template) : $template;

        // Replace variables for description
        $templateDesc = (strstr($templateDesc, '%desc%')) ? str_replace('%desc%', mb_substr(strip_tags($model['short_desc']), 0, intval($settings['pageCategoryTemplateDescCount'])), $templateDesc) : $templateDesc;
        $templateDesc = (strstr($templateDesc, '%pagenumber%')) ? str_replace('%pagenumber%', $pagePattern, $templateDesc) : $templateDesc;

        $templateDesc = (strstr($templateDesc, '%name%')) ? str_replace('%name%', $model['name'], $templateDesc) : $templateDesc;
        // category name translit
        $templateDesc = (strstr($templateDesc, '%name[t]%')) ? str_replace('%name[t]%', translit($model['name']), $templateDesc) : $templateDesc;

        // the cases of words
        $templateDesc = (strstr($templateDesc, '%name[1]%')) ? str_replace('%name[1]%', $obj->inflect($model['name'], 1), $templateDesc) : $templateDesc;
        $templateDesc = (strstr($templateDesc, '%name[2]%')) ? str_replace('%name[2]%', $obj->inflect($model['name'], 2), $templateDesc) : $templateDesc;
        $templateDesc = (strstr($templateDesc, '%name[3]%')) ? str_replace('%name[3]%', $obj->inflect($model['name'], 3), $templateDesc) : $templateDesc;
        $templateDesc = (strstr($templateDesc, '%name[4]%')) ? str_replace('%name[4]%', $obj->inflect($model['name'], 4), $templateDesc) : $templateDesc;
        $templateDesc = (strstr($templateDesc, '%name[5]%')) ? str_replace('%name[5]%', $obj->inflect($model['name'], 5), $templateDesc) : $templateDesc;
        $templateDesc = (strstr($templateDesc, '%name[6]%')) ? str_replace('%name[6]%', $obj->inflect($model['name'], 6), $templateDesc) : $templateDesc;

        // the cases of words and translit
        $templateDesc = (strstr($templateDesc, '%name[1][t]%') || strstr($templateDesc, '%name[t][1]%')) ? str_replace(['%name[1][t]%', '%name[t][1]%'], translit($obj->inflect($model['name'], 1)), $templateDesc) : $templateDesc;
        $templateDesc = (strstr($templateDesc, '%name[2][t]%') || strstr($templateDesc, '%name[t][2]%')) ? str_replace(['%name[2][t]%', '%name[t][2]%'], translit($obj->inflect($model['name'], 2)), $templateDesc) : $templateDesc;
        $templateDesc = (strstr($templateDesc, '%name[3][t]%') || strstr($templateDesc, '%name[t][3]%')) ? str_replace(['%name[3][t]%', '%name[t][3]%'], translit($obj->inflect($model['name'], 3)), $templateDesc) : $templateDesc;
        $templateDesc = (strstr($templateDesc, '%name[4][t]%') || strstr($templateDesc, '%name[t][4]%')) ? str_replace(['%name[4][t]%', '%name[t][4]%'], translit($obj->inflect($model['name'], 4)), $templateDesc) : $templateDesc;
        $templateDesc = (strstr($templateDesc, '%name[5][t]%') || strstr($templateDesc, '%name[t][5]%')) ? str_replace(['%name[5][t]%', '%name[t][5]%'], translit($obj->inflect($model['name'], 5)), $templateDesc) : $templateDesc;
        $templateDesc = (strstr($templateDesc, '%name[6][t]%') || strstr($templateDesc, '%name[t][6]%')) ? str_replace(['%name[6][t]%', '%name[t][6]%'], translit($obj->inflect($model['name'], 6)), $templateDesc) : $templateDesc;

        $templateDesc = (strstr($templateDesc, '%pagenumber%')) ? str_replace('%pagenumber%', $pageNumber, $templateDesc) : $templateDesc;

        // Replace variables for keywords

        $templateKey = (strstr($templateKey, '%name%')) ? str_replace('%name%', $model['name'], $templateKey) : $templateKey;
        $templateKey = (strstr($templateKey, '%pagenumber%')) ? str_replace('%pagenumber%', $pagePattern, $templateKey) : $templateKey;

        // category name translit
        $templateKey = (strstr($templateKey, '%name[t]%')) ? str_replace('%name[t]%', translit($model['name']), $templateKey) : $templateKey;

        // the cases of words
        $templateKey = (strstr($templateKey, '%name[1]%')) ? str_replace('%name[1]%', $obj->inflect($model['name'], 1), $templateKey) : $templateKey;
        $templateKey = (strstr($templateKey, '%name[2]%')) ? str_replace('%name[2]%', $obj->inflect($model['name'], 2), $templateKey) : $templateKey;
        $templateKey = (strstr($templateKey, '%name[3]%')) ? str_replace('%name[3]%', $obj->inflect($model['name'], 3), $templateKey) : $templateKey;
        $templateKey = (strstr($templateKey, '%name[4]%')) ? str_replace('%name[4]%', $obj->inflect($model['name'], 4), $templateKey) : $templateKey;
        $templateKey = (strstr($templateKey, '%name[5]%')) ? str_replace('%name[5]%', $obj->inflect($model['name'], 5), $templateKey) : $templateKey;
        $templateKey = (strstr($templateKey, '%name[6]%')) ? str_replace('%name[6]%', $obj->inflect($model['name'], 6), $templateKey) : $templateKey;

        // the cases of words and translit
        $templateKey = (strstr($templateKey, '%name[1][t]%') || strstr($templateKey, '%name[t][1]%')) ? str_replace(['%name[1][t]%', '%name[t][1]%'], translit($obj->inflect($model['name'], 1)), $templateKey) : $templateKey;
        $templateKey = (strstr($templateKey, '%name[2][t]%') || strstr($templateKey, '%name[t][2]%')) ? str_replace(['%name[2][t]%', '%name[t][2]%'], translit($obj->inflect($model['name'], 2)), $templateKey) : $templateKey;
        $templateKey = (strstr($templateKey, '%name[3][t]%') || strstr($templateKey, '%name[t][3]%')) ? str_replace(['%name[3][t]%', '%name[t][3]%'], translit($obj->inflect($model['name'], 3)), $templateKey) : $templateKey;
        $templateKey = (strstr($templateKey, '%name[4][t]%') || strstr($templateKey, '%name[t][4]%')) ? str_replace(['%name[4][t]%', '%name[t][4]%'], translit($obj->inflect($model['name'], 4)), $templateKey) : $templateKey;
        $templateKey = (strstr($templateKey, '%name[5][t]%') || strstr($templateKey, '%name[t][5]%')) ? str_replace(['%name[5][t]%', '%name[t][5]%'], translit($obj->inflect($model['name'], 5)), $templateKey) : $templateKey;
        $templateKey = (strstr($templateKey, '%name[6][t]%') || strstr($templateKey, '%name[t][6]%')) ? str_replace(['%name[6][t]%', '%name[t][6]%'], translit($obj->inflect($model['name'], 6)), $templateKey) : $templateKey;

        $templateKey = (strstr($templateKey, '%pagenumber%')) ? str_replace('%pagenumber%', $pageNumber, $templateKey) : $templateKey;

        self::setMetaTags($template, $templateKey, mb_substr($templateDesc, 0));
    }

    /**
     * Change simple page meta tags
     *
     * @param array $model
     * @return false|null
     */
    public function _buildPageMeta($model) {

        CI::$APP->seoexpert_model->setLastModified($model['updated']);

        if (($cat = CI::$APP->load->model('cms_base')->get_category_by_id($model['category']))) {
            $categoryName = $cat['name'];
        }

        $local = MY_Controller::getCurrentLocale();
        $settings = CI::$APP->seoexpert_model->getSettings($local);
        $obj = new Mod_seo();

        if ($settings['usePagePattern'] != 1) {
            return FALSE;
        }

        // Use for Empty meta
        if ($settings['usePagePatternForEmptyMeta'] == 1 && trim($model['meta_title']) != '') {
            $templateTitle = trim($model['meta_title']);
        } else {
            $templateTitle = $settings['pageTemplateTitle'];
        }

        if ($settings['usePagePatternForEmptyMeta'] == 1 && trim($model['description']) != '') {
            $templateDesc = trim($model['description']);
        } else {
            $templateDesc = $settings['pageTemplateDesc'];
        }

        if ($settings['usePagePatternForEmptyMeta'] == 1 && trim($model['keywords']) != '') {
            $templateKey = trim($model['keywords']);
        } else {
            $templateKey = $settings['pageTemplateKey'];
        }
        $descCount = 100;

        $storage = new MetaStorage();
        $storage->setTitleTemplate($templateTitle);
        $storage->setDescriptionTemplate($templateDesc);
        $storage->setKeywordsTemplate($templateKey);

        $metaManipulator = new \CMSFactory\MetaManipulator\PageMetaManipulator($model, $storage);
        $meta = $metaManipulator->render();

        // Set meta tags
        self::setMetaTags($meta['metaTitle'], $meta['metaKeywords'], mb_substr($meta['metaDescription'], 0, $descCount));

    }

    /**
     * Build Meta tags for Shop Product
     * @param array $arg
     * @return false|null
     */
    public function _buildProductsMeta($arg) {

        /* @var $model SProducts */
        $model = $arg['model'];
        $local = MY_Controller::getCurrentLocale();

        CI::$APP->seoexpert_model->setLastModified($model->getUpdated());

        // Get categories ids which has unique settings
        $uniqueCategories = CI::$APP->seoexpert_model_products->getCategoriesArray();
        // Check is common categories or unique
        if (in_array($model->getCategoryId(), $uniqueCategories)) {
            $settings = CI::$APP->seoexpert_model_products->getProductCategory($model->getCategoryId(), $local);
            $settings = $settings['settings'];
        } else {
            $settings = CI::$APP->seoexpert_model->getSettings($local);
        }

        // Is active
        if ($settings['useProductPattern'] != 1) {
            return FALSE;
        }

        // Use for Empty meta
        if ($settings['useProductPatternForEmptyMeta'] == 1 && trim($model->getMetaTitle()) != '') {
            $templateTitle = trim($model->getMetaTitle());
        } else {
            $templateTitle = $settings['productTemplate'];
        }

        if ($settings['useProductPatternForEmptyMeta'] == 1 && trim($model->getMetaDescription()) != '') {
            $templateDesc = trim($model->getMetaDescription());
        } else {
            $templateDesc = $settings['productTemplateDesc'];
        }

        if ($settings['useProductPatternForEmptyMeta'] == 1 && trim($model->getMetaKeywords()) != '') {
            $templateKey = trim($model->getMetaKeywords());
        } else {
            $templateKey = $settings['productTemplateKey'];
        }

        $descCount = $settings['productTemplateDescCount'];

        $metaStorage = new MetaStorage();
        $metaStorage->setTitleTemplate($templateTitle);
        $metaStorage->setDescriptionTemplate($templateDesc);
        $metaStorage->setKeywordsTemplate($templateKey);

        $metaManipulator = new ShopProductMetaManipulator($model, $metaStorage);
        $meta = $metaManipulator->render();

        // Set meta tags
        self::setMetaTags($meta['metaTitle'], $meta['metaKeywords'], mb_substr($meta['metaDescription'], 0, $descCount));
    }

    public function _buildSearchMeta() {

        $local = MY_Controller::getCurrentLocale();
        $settings = CI::$APP->seoexpert_model->getSettings($local);

        if ($settings['useSearchPattern'] != 1) {
            return FALSE;
        }

        $template = $settings['searchTemplate'];
        $templateDesc = $settings['searchTemplateDesc'];
        $templateKey = $settings['searchTemplateKey'];

        self::setMetaTags($template, $templateKey, mb_substr($templateDesc, 0));
    }

    public function _deinstall() {

        CI::$APP->seoexpert_model->deinstall();
    }

    public function _install() {

        CI::$APP->seoexpert_model->install();
    }

    public function autoload() {

        // Shop
        Events::create()->onSearchPageLoad()->setListener('_buildSearchMeta');
        Events::create()->onBrandPageLoad()->setListener('_buildBrandMeta');
        Events::create()->onBrandsPageLoad()->setListener('_buildBrandsMeta');
        Events::create()->onProductPageLoad()->setListener('_buildProductsMeta');
        Events::create()->onCategoryPageLoad()->setListener('_buildCategoryMeta');

        // Core
        Events::create()->on('page:load')->setListener('_buildPageMeta');
        Events::create()->on('pageCategory:load')->setListener('_buildPageCategoryMeta');
    }
}