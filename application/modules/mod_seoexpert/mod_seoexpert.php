<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * 
 * @property Smartseo_model $seoexpert_model
 * @property Seoexpert_model_products $seoexpert_model_products
 * @author dev@imagecms.net
 * @copyright ImageCMS (c) 2014
 */
class Mod_seoexpert extends \MY_Controller {

//    public $storage = 1;

    public function __construct() {
        parent::__construct();
        $this->load->model('seoexpert_model');
        $this->load->model('seoexpert_model_products');
        $lang = new MY_Lang();
        $lang->load('mod_seoexpert');
    }

    public function index() {
        
    }

    public function autoload() {
        // Shop
        \CMSFactory\Events::create()->onSearchPageLoad()->setListener('_buildSearchMeta');
        \CMSFactory\Events::create()->onBrandPageLoad()->setListener('_buildBrandMeta');
        \CMSFactory\Events::create()->onProductPageLoad()->setListener('_buildProductsMeta');
        \CMSFactory\Events::create()->onCategoryPageLoad()->setListener('_buildCategoryMeta');

        // Core
//        \CMSFactory\Events::create()->on('Core:_mainPage')->setListener('_test');
        \CMSFactory\Events::create()->on('Core:_displayPage')->setListener('_buildPageMeta');
//        \CMSFactory\Events::create()->on('Core:_displayCategory')->setListener('_test');
    }
   
    public function _buildPageMeta($data) {
        var_dumps(11);
        //Set meta tags
        ShopCore::$ci->core->set_meta_tags("aaaaaaaaa", "324234","213123");
    }
    
    
//    public function _test($data) {
//        var_dump($data);
//    }

    /**
     * Buld Meta tags for Shop Product
     * @param array $arg
     * @return boolean
     */
    public function _buildProductsMeta($arg) {

        $model = $arg['model'];
        $local = \MY_Controller::getCurrentLocale();

        // Get categories ids which has unique settings
        $uniqueCategories = \ShopCore::$ci->seoexpert_model_products->getCategoriesArray();

        // Check is common category or uniq
        if (in_array($model->getCategoryId(), $uniqueCategories)) {
            $settings = ShopCore::$ci->seoexpert_model_products->getProductCategory($model->getCategoryId(), $local);
            $settings = $settings['settings'];
        } else {
            $settings = ShopCore::$ci->seoexpert_model->getSettings($local);
        }

        // Is active
        if ($settings['useProductPattern'] != 1) {
            return FALSE;
        }

        // Use for Empty meta
        if ($settings['useProductPatternForEmptyMeta'] == 1 && trim($model->getMetaTitle()) != '') {
            return FALSE;
        }


        if ($model->getBrand()) {
            $brand = $model->getBrand()->getName();
        } else {
            $brand = '';
        }

        // Get meta templates from settings
        $template = $settings['productTemplate'];
        $templateDesc = $settings['productTemplateDesc'];
        $templateKey = $settings['productTemplateKey'];
        $descCount = $settings['productTemplateDescCount'];


        // Replace variables for title
        $template = str_replace('%ID%', $model->getId(), $template);
        $template = str_replace('%name%', $model->getName(), $template);
        $template = str_replace('%category%', $model->getMainCategory()->getName(), $template);
        $template = str_replace('%brand%', $brand, $template);
        $template = str_replace('%price%', $model->firstVariant->toCurrency(), $template);
        $template = str_replace('%CS%', ShopCore::app()->SCurrencyHelper->getSymbol(), $template);

        // Replace variables for description
        $templateDesc = str_replace('%ID%', $model->getId(), $templateDesc);
        $templateDesc = str_replace('%name%', $model->getName(), $templateDesc);
        $templateDesc = str_replace('%category%', $model->getMainCategory()->getName(), $templateDesc);
        $templateDesc = str_replace('%brand%', $brand, $templateDesc);
        $templateDesc = str_replace('%desc%', substr(strip_tags($model->getShortDescription()), 0, intval($descCount)), $templateDesc);
        $templateDesc = str_replace('%price%', $model->firstVariant->toCurrency(), $templateDesc);
        $templateDesc = str_replace('%CS%', ShopCore::app()->SCurrencyHelper->getSymbol(), $templateDesc);

        // Replace variables for key
        $templateKey = str_replace('%name%', $model->getName(), $templateKey);
        $templateKey = str_replace('%category%', $model->getMainCategory()->getName(), $templateKey);
        $templateKey = str_replace('%brand%', $brand, $templateKey);

        //Replace product properties by  property ID
        $productProperties = $model->getSProductPropertiesDatas();
        foreach ($productProperties as $key => $value) {
            $template = str_replace('%p_' . $value->getPropertyId() . '%', $value->getValue(), $template);
            $templateDesc = str_replace('%p_' . $value->getPropertyId() . '%', $value->getValue(), $templateDesc);
            $templateKey = str_replace('%p_' . $value->getPropertyId() . '%', $value->getValue(), $templateKey);
        }

        //Set meta tags
        ShopCore::$ci->core->set_meta_tags($template, $templateKey, substr(strip_tags($templateDesc), 0, -1));
    }

    /**
     * Build Meta for Shop Category
     * @param array $arg
     * @return boolean
     */
    public function _buildCategoryMeta($arg) {

        $local = MY_Controller::getCurrentLocale();
        $model = $arg['category'];
        $settings = ShopCore::$ci->seoexpert_model->getSettings($local);

        if ($settings['useCategoryPattern'] != 1) {
            return FALSE;
        }

        if ($settings['useCategoryPatternForEmptyMeta'] == 1 && trim($model->getMetaTitle()) != '') {
            return FALSE;
        }


        // Get settings
        $template = $settings['categoryTemplate'];
        $templateDesc = $settings['categoryTemplateDesc'];
        $templateKey = $settings['categoryTemplateKey'];
        $descCount = $settings['categoryTemplateDescCount'];
        $brandsCount = $settings['categoryTemplateBrandsCount'];

        //Replace title variables
        $template = str_replace('%ID%', $model->getId(), $template);
        $template = str_replace('%name%', $model->getName(), $template);
        $template = str_replace('%desc%', substr(strip_tags($model->getDescription()), 0, intval($descCount)), $template);
        $template = str_replace('%H1%', $model->getH1(), $template);

        //Replace description variables
        $templateDesc = str_replace('%ID%', $model->getId(), $templateDesc);
        $templateDesc = str_replace('%name%', $model->getName(), $templateDesc);
        $templateDesc = str_replace('%desc%', substr(strip_tags($model->getDescription()), 0, intval($descCount)), $templateDesc);
        $templateDesc = str_replace('%H1%', $model->getH1(), $templateDesc);

        ////Replace keywords variables
        $templateKey = str_replace('%ID%', $model->getId(), $templateKey);
        $templateKey = str_replace('%name%', $model->getName(), $templateKey);
        $templateKey = str_replace('%desc%', substr(strip_tags($model->getDescription()), 0, intval($descCount)), $templateKey);
        $templateKey = str_replace('%H1%', $model->getH1(), $templateKey);



        // Prepare brands for meta
        $brands = ShopCore::$ci->seoexpert_model->getTopBrandsInCategory($model->getId(), $brandsCount);
        $brandsString = "";
        foreach ($brands as $key => $value) {
            $brandsString[] = $value['name'];
        }
        $brandsString = implode(',', $brandsString);

        $template = str_replace('%brands%', $brandsString, $template);
        $templateDesc = str_replace('%brands%', $brandsString, $templateDesc);
        $templateKey = str_replace('%brands%', $brandsString, $templateKey);

        // Set meta tags
        ShopCore::$ci->core->set_meta_tags($template, $templateKey, iconv('utf-8', 'utf-8', substr($templateDesc, 0, -2)));
    }
    
    /**
     * Build Meta for Shop Brand
     * @param array $arg
     * @return boolean
     */
    public function _buildBrandMeta($arg) {
        /**
         * Let's do the harlem shake!!!
         */
        if (++ShopCore::$ci->mod_seoexpert->storage > 2) {
            return FALSE;
        }

        $local = MY_Controller::getCurrentLocale();
        $model = $arg['model'];
        $settings = ShopCore::$ci->seoexpert_model->getSettings($local);

        if ($settings['useBrandPattern'] != 1) {
            return FALSE;
        }

        if ($settings['useBrandPatternForEmptyMeta'] == 1 && trim($model->getMetaTitle()) != '') {
            return FALSE;
        }

        $template = $settings['brandTemplate'];
        $templateDesc = $settings['brandTemplateDesc'];
        $templateKey = $settings['brandTemplateKey'];
        $descCount = $settings['brandTemplateDescCount'];

        $template = str_replace('%ID%', $model->getId(), $template);
        $template = str_replace('%name%', $model->getName(), $template);
        $template = str_replace('%desc%', substr(strip_tags($model->getDescription()), 0, intval($descCount)), $template);

        $templateDesc = str_replace('%ID%', $model->getId(), $templateDesc);
        $templateDesc = str_replace('%name%', $model->getName(), $templateDesc);
        $templateDesc = str_replace('%desc%', substr(strip_tags($model->getDescription()), 0, intval($descCount)), $templateDesc);

        $templateKey = str_replace('%name%', $model->getName(), $templateKey);

        ShopCore::$ci->core->set_meta_tags($template, $templateKey, iconv('utf-8', 'utf-8', substr($templateDesc, 0, -2)));
    }

    public function _buildSearchMeta($arg) {
        /**
         * Let's do the harlem shake!!!
         */
        if (++ShopCore::$ci->mod_seoexpert->storage > 2) {
            return FALSE;
        }

        $local = MY_Controller::getCurrentLocale();
        $settings = ShopCore::$ci->seoexpert_model->getSettings($local);

        if ($settings['useSearchPattern'] != 1) {
            return FALSE;
        }

        $template = $settings['searchTemplate'];
        $templateDesc = $settings['searchTemplateDesc'];
        $templateKey = $settings['searchTemplateKey'];

        ShopCore::$ci->core->set_meta_tags($template, $templateKey, iconv('utf-8', 'utf-8', substr($templateDesc, 0, -2)));
    }

    public function _install() {
        ShopCore::$ci->seoexpert_model->install();
    }

    public function _deinstall() {
        ShopCore::$ci->seoexpert_model->deinstall();
    }

}

/* End of file mod_smart_seo.php */
