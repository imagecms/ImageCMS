<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Admin class for SmartSeo Module
 * @property Smartseo_model $seoexpert_model  
 */
class Admin extends \BaseAdminController {

    /**
     * Locale
     * @var string
     */
    private $locale;

    public function __construct() {
        parent::__construct();
        $this->load->model('seoexpert_model');
        $this->load->library('form_validation');
        
        $this->locale = \MY_Controller::getCurrentLocale();
        
        \mod_seoexpert\classes\SeoHelper::create()->test();
        \CMSFactory\assetManager::create()
                ->setData('locale', $this->locale)
                ->setData('languages', $this->cms_admin->get_langs(true))
                ->registerStyle('style')
                ->registerScript('scripts');
    }

    /**
     * Render main template and set data
     */
    public function index() {
        $settings = $this->seoexpert_model->getSettings($this->locale);
        \CMSFactory\assetManager::create()
                ->setData('settings', $settings)
                ->renderAdmin('main');
    }

    /**
     * Render advanced template for products list
     */
    public function productsCategories($locale = 'ru') {
        $this->load->model('seoexpert_model_products');
        $categories = $this->seoexpert_model_products->getAllCategories($locale);

        \CMSFactory\assetManager::create()
                ->setData('categories', $categories)
                ->renderAdmin('advanced/productsList');
    }

    /**
     * Create new params for category
     * @param string $locale
     */
    public function productCategoryCreate($locale = FALSE) {
        // Set default locale if no
        if (!$locale) {
            $locale = $this->locale;
        }

        if (!empty($_POST)) {
            $this->form_validation->set_rules('category_id', lang('Категория', 'mod_seoexpert'), 'required');

            if ($this->form_validation->run($this) == FALSE) {
                showMessage(validation_errors(), '', 'r');
            } else {
                $categories = \mod_seoexpert\classes\SeoHelper::create()->prepareCategoriesForProductCategory($this->input->post('category_id'),$locale);
                
            }
        } else {
            \CMSFactory\assetManager::create()
                    ->renderAdmin('advanced/productsCategoryCreate');
        }
    }

    /**
     * Edit params to category
     * @param int $id category ID
     * @param string $locale
     */
    public function productCategoryEdit($id = FALSE, $locale = FALSE) {
        $this->load->model('seoexpert_model_products');
        $category = $this->seoexpert_model_products->getProductCategory($id, $this->locale);

        if ($_POST) {
            
        } else {
            \CMSFactory\assetManager::create()
                    ->setData('category', $category)
                    ->renderAdmin('advanced/productsCategoryEdit');
        }
    }

    /**
     * Category autocomplete
     */
    public function categoryAutocomplete() {
        \mod_seoexpert\classes\SeoHelper::create()->autoCompleteCategories();
    }

    
    
    
    
    
    
    public function translit($locale = FALSE) {

        $settings = $this->seoexpert_model->getSettings($locale);
        \CMSFactory\assetManager::create()
                ->setData('locale', $locale)
                ->setData('languages', $this->cms_admin->get_langs(true))
                ->setData('settings', $settings)
                ->registerStyle('style')
                ->renderAdmin('main');
    }

    public function save($locale = FALSE) {
        if ($this->seoexpert_model->setSettings($this->input->post(), $locale))
            showMessage('Сохранено!');
    }

}
