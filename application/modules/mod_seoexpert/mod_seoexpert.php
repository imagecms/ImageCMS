<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * 
 * @property Smartseo_model $seoexpert_model
 * @author dev@imagecms.net
 * @copyright ImageCMS (c) 2014
 */
class Mod_seoexpert extends \MY_Controller {

    public $storage = 1;

    public function __construct() {
        parent::__construct();
        $this->load->model('seoexpert_model');
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
        \CMSFactory\Events::create()->on('Core:_mainPage')->setListener('_test');
        \CMSFactory\Events::create()->on('Core:_displayPage')->setListener('_test');
        \CMSFactory\Events::create()->on('Core:_displayCategory')->setListener('_test');
    }

    public function _test($data) {
        var_dump($data);
    }

    public function _buildProductsMeta($arg) {
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        /**
         * Let's do the harlem shake!!!
         */
        if (++ShopCore::$ci->mod_seoexpert->storage > 2) {
            return FALSE;
        }

        $local = \MY_Controller::getCurrentLocale();
        $model = $arg['model'];
        $settings = ShopCore::$ci->seoexpert_model->getSettings($local);

        if ($settings['useProductPattern'] != 1) {
            return FALSE;
        }

        if ($settings['useProductPatternForEmptyMeta'] == 1 && trim($model->getMetaTitle()) != '') {
            return FALSE;
        }

        $template = $settings['productTemplate'];
        $templateDesc = $settings['productTemplateDesc'];
        $templateKey = $settings['productTemplateKey'];
        $descCount = $settings['productTemplateDescCount'];

        $template = str_replace('%ID%', $model->getId(), $template);
        $template = str_replace('%name%', $model->getName(), $template);
        $template = str_replace('%category%', $model->getMainCategory()->getName(), $template);
        $template = str_replace('%price%', $model->firstVariant->toCurrency(), $template);
        $template = str_replace('%CS%', ShopCore::app()->SCurrencyHelper->getSymbol(), $template);

        $templateDesc = str_replace('%ID%', $model->getId(), $templateDesc);
        $templateDesc = str_replace('%name%', $model->getName(), $templateDesc);
        $templateDesc = str_replace('%category%', $model->getMainCategory()->getName(), $templateDesc);
        $templateDesc = str_replace('%desc%', substr(strip_tags($model->getShortDescription()), 0, intval($descCount)), $templateDesc);
        $templateDesc = str_replace('%price%', $model->firstVariant->toCurrency(), $templateDesc);
        $templateDesc = str_replace('%CS%', ShopCore::app()->SCurrencyHelper->getSymbol(), $templateDesc);

        $templateKey = str_replace('%name%', $model->getName(), $templateKey);

        ShopCore::$ci->core->set_meta_tags($template, $templateKey, substr(strip_tags($templateDesc), 0, -1));
    }

    public function _buildCategoryMeta($arg) {
        /**
         * Let's do the harlem shake!!!
         */
        if (++ShopCore::$ci->mod_seoexpert->storage > 2) {
            return FALSE;
        }
        $local = MY_Controller::getCurrentLocale();
        $model = $arg['category'];
        $settings = ShopCore::$ci->seoexpert_model->getSettings($local);

//        if ($local == 'ru') {
        if ($settings['useCategoryPattern'] != 1) {
            return FALSE;
        }

        if ($settings['useCategoryPatternForEmptyMeta'] == 1 && trim($model->getMetaTitle()) != '') {
            return FALSE;
        }

        $template = $settings['categoryTemplate'];
        $templateDesc = $settings['categoryTemplateDesc'];
        $templateKey = $settings['categoryTemplateKey'];
        $descCount = $settings['categoryTemplateDescCount'];

        $template = str_replace('%ID%', $model->getId(), $template);
        $template = str_replace('%name%', $model->getName(), $template);
        $template = str_replace('%H1%', $model->getH1(), $template);

        $templateDesc = str_replace('%ID%', $model->getId(), $templateDesc);
        $templateDesc = str_replace('%name%', $model->getName(), $templateDesc);
        $templateDesc = str_replace('%desc%', substr(strip_tags($model->getDescription()), 0, intval($descCount)), $templateDesc);
        $templateDesc = str_replace('%H1%', $model->getH1(), $templateDesc);

        $templateKey = str_replace('%name%', $model->getName(), $templateKey);

        ShopCore::$ci->core->set_meta_tags($template, $templateKey, iconv('utf-8', 'utf-8', substr($templateDesc, 0, -2)));
    }

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
//        $model = $arg['model'];
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
        $this->mod_seoexpert->install();
        
    }

    public function _deinstall() {
       $this->mod_seoexpert->deinstall();
    }

}

/* End of file mod_smart_seo.php */
