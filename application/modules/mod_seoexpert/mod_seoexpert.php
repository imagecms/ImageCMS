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
        $this->load->helper('translit');

        $lang = new MY_Lang();
        $lang->load('mod_seoexpert');

//        $text = "плеер";
//
//        echo "Родительный падеж : " . $this->inflect($text, 2) . "<br/>";
//        echo "Дательный падеж : " . $this->inflect($text, 3) . "<br/>";
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
//        \CMSFactory\Events::create()->on('Core:_displayPage')->setListener('_buildPageMeta');
//        \CMSFactory\Events::create()->on('Core:_displayCategory')->setListener('_test');
    }

    /**
     * Buld Meta tags for Shop Product
     * @param array $arg
     * @return boolean
     */
    public function _buildProductsMeta($arg) {

        $model = $arg['model'];
        $local = \MY_Controller::getCurrentLocale();

        $obj = new Mod_seoexpert();

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
        // Product name translit
        $template = str_replace('%name[t]%', translit($model->getName()), $template);

        $template = str_replace('%category%', $model->getMainCategory()->getName(), $template);
        // category name translit
        $template = str_replace('%category[t]%', translit($model->getMainCategory()->getName()), $template);

        // the cases of words
        $template = str_replace('%category[1]%', $obj->inflect($model->getMainCategory()->getName(), 1), $template);
        $template = str_replace('%category[2]%', $obj->inflect($model->getMainCategory()->getName(), 2), $template);
        $template = str_replace('%category[3]%', $obj->inflect($model->getMainCategory()->getName(), 3), $template);
        $template = str_replace('%category[4]%', $obj->inflect($model->getMainCategory()->getName(), 4), $template);
        $template = str_replace('%category[5]%', $obj->inflect($model->getMainCategory()->getName(), 5), $template);
        $template = str_replace('%category[6]%', $obj->inflect($model->getMainCategory()->getName(), 6), $template);

        // the cases of words and translit
        $template = str_replace(array('%category[1][t]%', '%category[t][1]%'), translit($obj->inflect($model->getMainCategory()->getName(), 1)), $template);
        $template = str_replace(array('%category[2][t]%', '%category[t][2]%'), translit($obj->inflect($model->getMainCategory()->getName(), 2)), $template);
        $template = str_replace(array('%category[3][t]%', '%category[t][3]%'), translit($obj->inflect($model->getMainCategory()->getName(), 3)), $template);
        $template = str_replace(array('%category[4][t]%', '%category[t][4]%'), translit($obj->inflect($model->getMainCategory()->getName(), 4)), $template);
        $template = str_replace(array('%category[5][t]%', '%category[t][5]%'), translit($obj->inflect($model->getMainCategory()->getName(), 5)), $template);
        $template = str_replace(array('%category[6][t]%', '%category[t][6]%'), translit($obj->inflect($model->getMainCategory()->getName(), 6)), $template);


        $template = str_replace('%brand%', $brand, $template);
        $template = str_replace('%brand[t]%', translit($brand), $template);

        $template = str_replace('%price%', $model->firstVariant->toCurrency(), $template);
        $template = str_replace('%CS%', ShopCore::app()->SCurrencyHelper->getSymbol(), $template);

        // Replace variables for description
        $templateDesc = str_replace('%ID%', $model->getId(), $templateDesc);
        $templateDesc = str_replace('%name%', $model->getName(), $templateDesc);
        $templateDesc = str_replace('%name[t]%', translit($model->getName()), $templateDesc);

        $templateDesc = str_replace('%category%', $model->getMainCategory()->getName(), $templateDesc);
        $templateDesc = str_replace('%brand%', $brand, $templateDesc);
        $templateDesc = str_replace('%brand[t]%', translit($brand), $templateDesc);

        $templateDesc = str_replace('%desc%', substr(strip_tags($model->getShortDescription()), 0, intval($descCount)), $templateDesc);
        $templateDesc = str_replace('%price%', $model->firstVariant->toCurrency(), $templateDesc);
        $templateDesc = str_replace('%CS%', ShopCore::app()->SCurrencyHelper->getSymbol(), $templateDesc);


        // category name translit
        $templateDesc = str_replace('%category[t]%', translit($model->getMainCategory()->getName()), $templateDesc);

        // the cases of words
        $templateDesc = str_replace('%category[1]%', $obj->inflect($model->getMainCategory()->getName(), 1), $templateDesc);
        $templateDesc = str_replace('%category[2]%', $obj->inflect($model->getMainCategory()->getName(), 2), $templateDesc);
        $templateDesc = str_replace('%category[3]%', $obj->inflect($model->getMainCategory()->getName(), 3), $templateDesc);
        $templateDesc = str_replace('%category[4]%', $obj->inflect($model->getMainCategory()->getName(), 4), $templateDesc);
        $templateDesc = str_replace('%category[5]%', $obj->inflect($model->getMainCategory()->getName(), 5), $templateDesc);
        $templateDesc = str_replace('%category[6]%', $obj->inflect($model->getMainCategory()->getName(), 6), $templateDesc);

        // the cases of words and translit
        $templateDesc = str_replace(array('%category[1][t]%', '%category[t][1]%'), translit($obj->inflect($model->getMainCategory()->getName(), 1)), $templateDesc);
        $templateDesc = str_replace(array('%category[2][t]%', '%category[t][2]%'), translit($obj->inflect($model->getMainCategory()->getName(), 2)), $templateDesc);
        $templateDesc = str_replace(array('%category[3][t]%', '%category[t][3]%'), translit($obj->inflect($model->getMainCategory()->getName(), 3)), $templateDesc);
        $templateDesc = str_replace(array('%category[4][t]%', '%category[t][4]%'), translit($obj->inflect($model->getMainCategory()->getName(), 4)), $templateDesc);
        $templateDesc = str_replace(array('%category[5][t]%', '%category[t][5]%'), translit($obj->inflect($model->getMainCategory()->getName(), 5)), $templateDesc);
        $templateDesc = str_replace(array('%category[6][t]%', '%category[t][6]%'), translit($obj->inflect($model->getMainCategory()->getName(), 6)), $templateDesc);


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
        ShopCore::$ci->core->set_meta_tags($template, $templateKey, substr(strip_tags($templateDesc), 0));
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

        $obj = new Mod_seoexpert();

        if ($model->getParentId()) {
            if ($settings['usesubcategoryPattern'] != 1) {
                return FALSE;
            }

            if ($settings['usesubcategoryPatternForEmptyMeta'] == 1 && trim($model->getMetaTitle()) != '') {
                return FALSE;
            }

            // Get settings
            $template = $settings['subcategoryTemplate'];
            $templateDesc = $settings['subcategoryTemplateDesc'];
            $templateKey = $settings['subcategoryTemplateKey'];
            $descCount = $settings['subcategoryTemplateDescCount'];
            $brandsCount = $settings['subcategoryTemplateBrandsCount'];
        } else {
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
        }
        //Replace title variables
        $template = str_replace('%ID%', $model->getId(), $template);
        $template = str_replace('%name%', $model->getName(), $template);
        $template = str_replace('%desc%', substr(strip_tags($model->getDescription()), 0, intval($descCount)), $template);
        $template = str_replace('%H1%', $model->getH1(), $template);
        // category name translit
        $template = str_replace('%category[t]%', translit($model->getName()), $template);

        // the cases of words
        $template = str_replace('%category[1]%', $obj->inflect($model->getName(), 1), $template);
        $template = str_replace('%category[2]%', $obj->inflect($model->getName(), 2), $template);
        $template = str_replace('%category[3]%', $obj->inflect($model->getName(), 3), $template);
        $template = str_replace('%category[4]%', $obj->inflect($model->getName(), 4), $template);
        $template = str_replace('%category[5]%', $obj->inflect($model->getName(), 5), $template);
        $template = str_replace('%category[6]%', $obj->inflect($model->getName(), 6), $template);

        // the cases of words and translit
        $template = str_replace(array('%category[1][t]%', '%category[t][1]%'), translit($obj->inflect($model->getName(), 1)), $template);
        $template = str_replace(array('%category[2][t]%', '%category[t][2]%'), translit($obj->inflect($model->getName(), 2)), $template);
        $template = str_replace(array('%category[3][t]%', '%category[t][3]%'), translit($obj->inflect($model->getName(), 3)), $template);
        $template = str_replace(array('%category[4][t]%', '%category[t][4]%'), translit($obj->inflect($model->getName(), 4)), $template);
        $template = str_replace(array('%category[5][t]%', '%category[t][5]%'), translit($obj->inflect($model->getName(), 5)), $template);
        $template = str_replace(array('%category[6][t]%', '%category[t][6]%'), translit($obj->inflect($model->getName(), 6)), $template);





        //Replace description variables
        $templateDesc = str_replace('%ID%', $model->getId(), $templateDesc);
        $templateDesc = str_replace('%name%', $model->getName(), $templateDesc);
        $templateDesc = str_replace('%desc%', substr(strip_tags($model->getDescription()), 0, intval($descCount)), $templateDesc);
        $templateDesc = str_replace('%H1%', $model->getH1(), $templateDesc);
        // category name translit
        $templateDesc = str_replace('%category[t]%', translit($model->getName()), $templateDesc);

        // the cases of words
        $templateDesc = str_replace('%category[1]%', $obj->inflect($model->getName(), 1), $templateDesc);
        $templateDesc = str_replace('%category[2]%', $obj->inflect($model->getName(), 2), $templateDesc);
        $templateDesc = str_replace('%category[3]%', $obj->inflect($model->getName(), 3), $templateDesc);
        $templateDesc = str_replace('%category[4]%', $obj->inflect($model->getName(), 4), $templateDesc);
        $templateDesc = str_replace('%category[5]%', $obj->inflect($model->getName(), 5), $templateDesc);
        $templateDesc = str_replace('%category[6]%', $obj->inflect($model->getName(), 6), $templateDesc);

        // the cases of words and translit
        $templateDesc = str_replace(array('%category[1][t]%', '%category[t][1]%'), translit($obj->inflect($model->getName(), 1)), $templateDesc);
        $templateDesc = str_replace(array('%category[2][t]%', '%category[t][2]%'), translit($obj->inflect($model->getName(), 2)), $templateDesc);
        $templateDesc = str_replace(array('%category[3][t]%', '%category[t][3]%'), translit($obj->inflect($model->getName(), 3)), $templateDesc);
        $templateDesc = str_replace(array('%category[4][t]%', '%category[t][4]%'), translit($obj->inflect($model->getName(), 4)), $templateDesc);
        $templateDesc = str_replace(array('%category[5][t]%', '%category[t][5]%'), translit($obj->inflect($model->getName(), 5)), $templateDesc);
        $templateDesc = str_replace(array('%category[6][t]%', '%category[t][6]%'), translit($obj->inflect($model->getName(), 6)), $templateDesc);






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
        $template = str_replace('%name[t]%', translit($model->getName()), $template);
        $template = str_replace('%desc%', substr(strip_tags($model->getDescription()), 0, intval($descCount)), $template);

        $templateDesc = str_replace('%ID%', $model->getId(), $templateDesc);
        $templateDesc = str_replace('%name%', $model->getName(), $templateDesc);
        $templateDesc = str_replace('%name[t]%', translit($model->getName()), $templateDesc);
        $templateDesc = str_replace('%desc%', substr(strip_tags($model->getDescription()), 0, intval($descCount)), $templateDesc);

        $templateKey = str_replace('%name%', $model->getName(), $templateKey);
        $templateKey = str_replace('%name[t]%', translit($model->getName()), $templateKey);

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

    /**
     * Inflect words
     * @param string $what
     * @param int $inflection_id (1-6) - the cases of words
     * @return string
     */
    private function inflect($what, $inflection_id) {
        $resInflected = $this->db
                ->where('original', $what)
                ->where('inflection_id', $inflection_id)
                ->get('mod_seoexpert_inflect')
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

                        if (!isset($key['tag']) || !isset($key['value']))
                            continue;
                        elseif ($key['tag'] == 'INFLECTION') {

                            
                            if ($key['attributes']['CASE'] == $inflection_id) {
                                $foundRes = TRUE;

                                $inflected = $key['value'];
                                $dataArray = array(
                                    'original' => $what,
                                    'inflection_id' => $inflection_id,
                                    'inflected' => $inflected,
                                );

                                $res_inflected = $this->db
                                        ->insert('mod_seoexpert_inflect', $dataArray);
                            }
                        }
                    }


                    if ($foundRes !== TRUE) {
                        for ($i = 2; $i<=6; $i++) {
                            $dataArray = array(
                                    'original' => $what,
                                    'inflection_id' => $i,
                                    'inflected' => $what,
                                );
                            
                            $this->db
                                    ->insert('mod_seoexpert_inflect', $dataArray);
                        }
                    }
                    
                }
            }
            xml_parser_free($parser);
        }
        if ($inflected == "")
            $inflected = $what;

        return $inflected;
    }

    public function _install() {
        ShopCore::$ci->seoexpert_model->install();
    }

    public function _deinstall() {
        ShopCore::$ci->seoexpert_model->deinstall();
    }

}

/* End of file mod_smart_seo.php */
