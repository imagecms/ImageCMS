<?php

namespace mod_seoexpert\classes;

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class Helper for mod_seoexpert module
 * @uses \MY_Controller
 * @author DevImageCms
 * @copyright (c) 2014, ImageCMS
 * @package ImageCMSModule
 */
class SeoHelper extends \MY_Controller {

    protected static $_instance;

    /**
     * __construct base object loaded
     * @access public
     * @author DevImageCms
     * @param ---
     * @return ---
     * @copyright (c) 2013, ImageCMS
     */
    public function __construct() {
        parent::__construct();
        /** Load model * */
        $this->load->model('seoexpert_model');
        $lang = new \MY_Lang();
        $lang->load('mod_seoexpert');
    }

    /**
     *
     * @return AdminHelper
     */
    public static function create() {
        (null !== self::$_instance) OR self::$_instance = new self();
        return self::$_instance;
    }

    /**
     * Prepare parent category name (in future all categories in full path)
     * @param int $categoryId
     * @param string $locale
     * @return boolean|array
     * - parentCategory
     */
    public function prepareCategoriesForProductCategory($categoryId = false, $locale = false) {
        $res = $this->seoexpert_model_products->getCategoryByIdAndLocale($categoryId, $locale);
      
        if ($res){
            $res['parentCategory'] = $res['name'];
            unset($res['name']);
            return $res;
        }
        return FALSE;
                
    }

    /**
     * Autocomlete categories
     * @return jsone
     */
    public function autoCompleteCategories() {
        $sCoef = $this->input->get('term');
        $sLimit = $this->input->get('limit');

        $categories = $this->seoexpert_model->getCategoriesByIdName($sCoef, $sLimit);

        if ($categories != false) {
            foreach ($categories as $category) {
                $response[] = array(
                    'value' => $category['name'],
                    'id' => $category['id'],
                );
            }
            echo json_encode($response);
            return;
        }
        echo '';
    }

}
