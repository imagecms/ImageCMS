<?php

use CMSFactory\Events;
use CMSFactory\MetaManipulator\GalleryMetaManipulator;
use CMSFactory\MetaManipulator\MetaManipulator;
use CMSFactory\MetaManipulator\MetaStorage;
use CMSFactory\MetaManipulator\PageCategoryMetaManipulator;
use CMSFactory\MetaManipulator\PageMetaManipulator;
use CMSFactory\MetaManipulator\ShopBrandMetaManipulator;
use CMSFactory\MetaManipulator\ShopCategoryMetaManipulator;
use CMSFactory\MetaManipulator\ShopProductMetaManipulator;

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 *
 * @property Seoexpert_model $seoexpert_model
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
    public static function _buildBrandMeta($arg) {

        $local = MY_Controller::getCurrentLocale();
        /* @var $model SBrands */
        $model = $arg['model'];
        $settings = CI::$APP->seoexpert_model->getSettings($local);

        CI::$APP->core->setLastModified($model->getUpdated());

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

        $metaStorage = new MetaStorage();
        $metaStorage->setTitleTemplate($templateTitle);
        $metaStorage->setDescriptionTemplate($templateDesc);
        $metaStorage->setKeywordsTemplate($templateKey);

        $metaManipulator = new ShopBrandMetaManipulator($model, $metaStorage);
        $metaManipulator->setDescLength($settings['brandTemplateDescCount']);
        $metaManipulator->setPageNumber($settings['brandPaginationTemplate']);
        $meta = $metaManipulator->render();

        // Set meta tags
        self::setMetaTags($meta['metaTitle'], $meta['metaKeywords'], $meta['metaDescription']);
    }

    /**
     * @param string $template
     * @param string $templateKey
     * @param string $templateDesc
     */
    private static function setMetaTags($template, $templateKey, $templateDesc) {

        CI::$APP->core->set_meta_tags($template, $templateKey, $templateDesc);
    }

    /**
     * Build Meta for Shop Brands page
     * @return false|null
     */
    public static function _buildBrandsMeta() {

        $local = MY_Controller::getCurrentLocale();
        $settings = CI::$APP->seoexpert_model->getSettings($local);

        if ($settings['useBrandsListPattern'] != 1) {
            return FALSE;
        }

        // Set meta tags
        self::setMetaTags($settings['brandsListTemplate'], $settings['brandsListTemplateKey'], $settings['brandsListTemplateDesc']);
    }

    /**
     * Build Meta for Shop Category
     * @param Category $categoryObj
     * @return false|null
     */
    public static function _buildCategoryMeta($categoryObj) {

        CI::$APP->load->helper('array_helper');

        $local = MY_Controller::getCurrentLocale();
        /* @var $model SCategory */
        $model = $categoryObj->data['category'];

        CI::$APP->core->setLastModified($model->getUpdated());

        $settings = ShopCore::$ci->seoexpert_model->getSettings($local);

        if ($model->getParentId() > 0) {
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
            $brandsCount = $settings['subcategoryTemplateBrandsCount'];
            $paginationTemplate = $settings['subcategoryTemplatePaginationTemplate'];
            $descCount = $settings['subcategoryTemplateDescCount'];
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
            $brandsCount = $settings['categoryTemplateBrandsCount'];
            $paginationTemplate = $settings['categoryTemplatePaginationTemplate'];
            $descCount = $settings['categoryTemplateDescCount'];
        }

        $metaStorage = new MetaStorage();
        $metaStorage->setTitleTemplate($templateTitle);
        $metaStorage->setDescriptionTemplate($templateDesc);
        $metaStorage->setKeywordsTemplate($templateKey);

        $metaManipulator = new ShopCategoryMetaManipulator($model, $metaStorage);
        $metaManipulator->setPageNumber($paginationTemplate);
        $metaManipulator->setBrandsCount($brandsCount);
        $metaManipulator->setDescLength($descCount);
        $meta = $metaManipulator->render();

        // Set meta tags
        self::setMetaTags($meta['metaTitle'], $meta['metaKeywords'], $meta['metaDescription']);
    }

    /**
     * Change page category meta tags
     *
     * @param array $model
     * @return false|null
     */
    public static function _buildPageCategoryMeta($model) {

        $local = MY_Controller::getCurrentLocale();

        CI::$APP->core->setLastModified($model['updated']);

        $settings = CI::$APP->seoexpert_model->getSettings($local);

        if ($settings['usePageCategoryPattern'] != 1) {
            return FALSE;
        }

        // Use for Empty meta
        if ($settings['usePageCategoryPatternForEmptyMeta'] == 1 && trim($model['title']) != '') {
            $templateTitle = trim($model['title']);
        } else {
            $templateTitle = $settings['pageCategoryTemplateTitle'];
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

        $metaStorage = new MetaStorage();
        $metaStorage->setTitleTemplate($templateTitle);
        $metaStorage->setDescriptionTemplate($templateDesc);
        $metaStorage->setKeywordsTemplate($templateKey);

        $metaManipulator = new PageCategoryMetaManipulator($model, $metaStorage);
        $metaManipulator->setPageNumber($settings['pageCategoryTemplatePaginationTemplate']);
        $metaManipulator->setDescLength($settings['pageCategoryTemplateDescCount']);
        $meta = $metaManipulator->render();

        self::setMetaTags($meta['metaTitle'], $meta['metaKeywords'], $meta['metaDescription']);
    }

    /**
     * Change simple page meta tags
     *
     * @param array $model
     * @return false|null
     */
    public static function _buildPageMeta($model) {

        CI::$APP->core->setLastModified($model['updated']);

        $local = MY_Controller::getCurrentLocale();
        $settings = CI::$APP->seoexpert_model->getSettings($local);

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

        $metaStorage = new MetaStorage();
        $metaStorage->setTitleTemplate($templateTitle);
        $metaStorage->setDescriptionTemplate($templateDesc);
        $metaStorage->setKeywordsTemplate($templateKey);

        $metaManipulator = new PageMetaManipulator($model, $metaStorage);
        $metaManipulator->setDescLength($settings['pageTemplateDescCount']);
        $meta = $metaManipulator->render();

        // Set meta tags
        self::setMetaTags($meta['metaTitle'], $meta['metaKeywords'], $meta['metaDescription']);
    }

    /**
     * Build Meta tags for Shop Product
     * @param array $arg
     * @return false|null
     */
    public static function _buildProductsMeta($arg) {

        /* @var $model SProducts */
        $model = $arg['model'];
        $local = MY_Controller::getCurrentLocale();

        CI::$APP->core->setLastModified($model->getUpdated());

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
        $metaManipulator->setDescLength($descCount);
        $meta = $metaManipulator->render();

        // Set meta tags
        self::setMetaTags($meta['metaTitle'], $meta['metaKeywords'], $meta['metaDescription']);
    }

    /**
     * @return bool
     */
    public static function _buildSearchMeta() {

        $local = MY_Controller::getCurrentLocale();
        $settings = CI::$APP->seoexpert_model->getSettings($local);

        if ($settings['useSearchPattern'] != 1) {
            return FALSE;
        }

        $metaStorage = new MetaStorage();
        $metaStorage->setTitleTemplate($settings['searchTemplate']);
        $metaStorage->setDescriptionTemplate($settings['searchTemplateDesc']);
        $metaStorage->setKeywordsTemplate($settings['searchTemplateKey']);

        $metaManipulator = new MetaManipulator([], $metaStorage);
        $meta = $metaManipulator->render();

        self::setMetaTags($meta['metaTitle'], $meta['metaKeywords'], $meta['metaDescription']);
    }

    /**
     * @return bool
     */
    public static function _buildGalleryMeta() {

        $local = MY_Controller::getCurrentLocale();
        $settings = CI::$APP->seoexpert_model->getSettings($local);

        if ($settings['useGalleryPattern'] != 1) {
            return FALSE;
        }

        $metaStorage = new MetaStorage();
        $metaStorage->setTitleTemplate($settings['galleryTemplate']);
        $metaStorage->setDescriptionTemplate($settings['galleryTemplateDesc']);
        $metaStorage->setKeywordsTemplate($settings['galleryTemplateKey']);

        $metaManipulator = new MetaManipulator([], $metaStorage);
        $meta = $metaManipulator->render();

        self::setMetaTags($meta['metaTitle'], $meta['metaKeywords'], $meta['metaDescription']);
    }

    /**
     * @param array $data
     * @return bool
     */
    public static function _buildGalleryCategoryMeta($data) {

        $local = MY_Controller::getCurrentLocale();
        $settings = CI::$APP->seoexpert_model->getSettings($local);

        if ($settings['useGalleryCategoryPattern'] != 1) {
            return FALSE;
        }

        $metaStorage = new MetaStorage();
        $metaStorage->setTitleTemplate($settings['galleryCategoryTemplate']);
        $metaStorage->setDescriptionTemplate($settings['galleryCategoryTemplateDesc']);
        $metaStorage->setKeywordsTemplate($settings['galleryCategoryTemplateKey']);

        $metaManipulator = new GalleryMetaManipulator($data['current_category'], $metaStorage);
        $metaManipulator->setDescLength($settings['galleryCategoryTemplateDescCount']);
        $meta = $metaManipulator->render();

        self::setMetaTags($meta['metaTitle'], $meta['metaKeywords'], $meta['metaDescription']);
    }

    /**
     * @param array $data
     * @return bool
     */
    public static function _buildGalleryAlbumMeta($data) {

        /** Передаем имя категории в дату, которая передается в качестве модели*/
        $data['album']['category_name'] = $data['current_category']['name'];

        $local = MY_Controller::getCurrentLocale();
        $settings = CI::$APP->seoexpert_model->getSettings($local);

        if ($settings['useGalleryAlbumPattern'] != 1) {
            return FALSE;
        }

        $metaStorage = new MetaStorage();
        $metaStorage->setTitleTemplate($settings['galleryAlbumTemplate']);
        $metaStorage->setDescriptionTemplate($settings['galleryAlbumTemplateDesc']);
        $metaStorage->setKeywordsTemplate($settings['galleryAlbumTemplateKey']);

        $metaManipulator = new GalleryMetaManipulator($data['album'], $metaStorage);
        $metaManipulator->setDescLength($settings['galleryAlbumTemplateDescCount']);
        $meta = $metaManipulator->render();

        self::setMetaTags($meta['metaTitle'], $meta['metaKeywords'], $meta['metaDescription']);
    }

    /**
     * @param array $data
     * @return bool
     */
    public static function _buildActionSearchMeta($data) {

        $local = MY_Controller::getCurrentLocale();
        $settings = CI::$APP->seoexpert_model->getSettings($local);

        $new_setting = CI::$APP->seoexpert_model->Actions_settings($settings, $data['type']);

        if ($new_setting['usePattern'] != 1) {
            return FALSE;
        }

        $metaStorage = new MetaStorage();
        $metaStorage->setTitleTemplate($new_setting['TitleTemplate']);
        $metaStorage->setDescriptionTemplate($new_setting['TemplateDesc']);
        $metaStorage->setKeywordsTemplate($new_setting['KeywordsTemplate']);

        $metaManipulator = new MetaManipulator([], $metaStorage);
        $meta = $metaManipulator->render();

        self::setMetaTags($meta['metaTitle'], $meta['metaKeywords'], $meta['metaDescription']);
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
        Events::create()->onActionTypeSearch()->setListener('_buildActionSearchMeta');

        // Core
        Events::create()->onPageLoad()->setListener('_buildPageMeta');
        Events::create()->onPageCategoryLoad()->setListener('_buildPageCategoryMeta');
        Events::create()->onGalleryLoad()->setListener('_buildGalleryMeta');
        Events::create()->onGalleryCategoryLoad()->setListener('_buildGalleryCategoryMeta');
        Events::create()->onGalleryAlbumLoad()->setListener('_buildGalleryAlbumMeta');

    }
}