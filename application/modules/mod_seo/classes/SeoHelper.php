<?php

namespace mod_seo\classes;

use MY_Controller;
use Seoexpert_model;
use Seoexpert_model_products;

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Class Helper for mod_seo module
 * @property Seoexpert_model_products seoexpert_model_products
 * @property Seoexpert_model seoexpert_model
 * @uses \MY_Controller
 * @author DevImageCms
 * @copyright (c) 2014, ImageCMS
 * @package ImageCMSModule
 */
class SeoHelper extends MY_Controller
{

    protected static $_instance;

    /**
     * __construct base object loaded
     * @access public
     * @author DevImageCms
     * @copyright (c) 2013, ImageCMS
     */
    public function __construct() {
        parent::__construct();
        /** Load model * */
        $this->load->model('seoexpert_model');
        $lang = new \MY_Lang();
        $lang->load('mod_seo');
    }

    /**
     * @return SeoHelper
     */
    public static function create() {
        (null !== self::$_instance) OR self::$_instance = new self();
        return self::$_instance;
    }

    /**
     * Prepare parent category name (in future all categories in full path)
     * @param bool|int $categoryId
     * @param bool|string $locale
     * @return array|bool - parentCategory
     */
    public function prepareCategoriesForProductCategory($categoryId = false, $locale = false) {
        $res = $this->seoexpert_model_products->getCategoryByIdAndLocale($categoryId, $locale);

        if ($res) {
            $res['parentCategory'] = $res['name'];
            unset($res['name']);
            return $res;
        }
        return FALSE;
    }

    /**
     * Autocomplete categories
     * @return jsone
     */
    public function autoCompleteCategories() {
        $sCoef = $this->input->get('term');
        $sLimit = $this->input->get('limit');

        $categories = $this->seoexpert_model->getCategoriesByIdName($sCoef, $sLimit);

        if ($categories != false) {
            foreach ($categories as $category) {
                $response[] = [
                               'value' => html_entity_decode($category['name']),
                               'id'    => $category['id'],
                              ];
            }
            echo json_encode($response);
            return;
        }
        echo '';
    }

    /**
     * Get base settings
     * @param bool|string $locale
     * @return array|bool
     */
    public function getBaseSettings($locale = FALSE) {
        if (!$locale) {
            $locale = MY_Controller::getCurrentLocale();
        }
        $langId = $this->seoexpert_model->getLangIdByLocale($locale);
        $res = $this->seoexpert_model->getBaseSettings($langId);

        if ($res) {
            return $res;
        }
        return FALSE;
    }

    /**
     *
     * @param bool|string $locale
     * @param bool|array $settings
     * @return bool
     */
    public function setBaseSettings($locale = FALSE, $settings = FALSE) {
        if (!$locale) {
            $locale = MY_Controller::getCurrentLocale();
        }
        $langId = $this->seoexpert_model->getLangIdByLocale($locale);

        $res = $this->seoexpert_model->setBaseSettings($langId, $settings);

        if ($res) {
            return $res;
        }
        return FALSE;
    }

}