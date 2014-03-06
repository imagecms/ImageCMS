<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Admin class for SmartSeo Module
 * @property Smartseo_model $seoexpert_model
 * @property Smartseo_model_products $seoexpert_model_products  
 */
class Admin extends \BaseAdminController {

    /**
     * Locale
     * @var string
     */
    private $locale;

    public function __construct() {
        parent::__construct();
        $lang = new \MY_Lang();
        $lang->load('mod_seoexpert');

        $this->load->model('seoexpert_model');
        $this->load->model('seoexpert_model_products');
        $this->load->library('form_validation');

        $this->locale = \MY_Controller::getCurrentLocale();

        \CMSFactory\assetManager::create()
                ->setData('languages', $this->cms_admin->get_langs(true))
                ->registerStyle('style')
                ->registerScript('scripts');
    }

    /**
     * Render main template and set data
     */
    public function index($locale = FALSE) {
        if (!$locale) {
            $locale = $this->locale;
        }

        $baseSettings = \mod_seoexpert\classes\SeoHelper::create()->getBaseSettings($locale);
        $settings = $this->seoexpert_model->getSettings($locale);
        \CMSFactory\assetManager::create()
                ->setData('locale', $locale)
                ->setData('baseSettings', $baseSettings)
                ->setData('settings', $settings)
                ->renderAdmin('main');
    }

    /**
     * Render advanced template for products list
     */
    public function productsCategories($locale = 'ru') {
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
            $this->form_validation->set_rules('category_id', lang('Category', 'mod_seoexpert'), 'required|numeric');

            if ($this->form_validation->run($this) == FALSE) {
                showMessage(validation_errors(), '', 'r');
            } else {
                $categoryId = $this->input->post('category_id');
                $categories = \mod_seoexpert\classes\SeoHelper::create()->prepareCategoriesForProductCategory($categoryId, $locale);

                $data = $this->input->post();

                // Add categories to settings
                foreach ((array) $categories as $key => $value) {
                    $data[$key] = $value;
                }
                unset($data['action']);

                // Show message about result
                if ($this->seoexpert_model_products->setProductCategory($categoryId, $data, $locale) != FALSE) {
                    showMessage(lang("Changes saved", "mod_seoexpert"));
                    pjax('/admin/components/init_window/mod_seoexpert/productsCategories');
                } else {
                    showMessage(lang("Can not create", "mod_seoexpert"), '', 'r');
                }
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
        if (!$id) {
            return FALSE;
        }
        // Set default locale if no
        if (!$locale) {
            $locale = $this->locale;
        }

        $category = $this->seoexpert_model_products->getProductCategory($id, $this->locale);

        if (!empty($_POST)) {
            $this->form_validation->set_rules('category_id', lang('Category', 'mod_seoexpert'), 'required|numeric');

            if ($this->form_validation->run($this) == FALSE) {
                showMessage(validation_errors(), '', 'r');
            } else {
                $categoryId = $this->input->post('category_id');
                $categories = \mod_seoexpert\classes\SeoHelper::create()->prepareCategoriesForProductCategory($categoryId, $locale);

                $data = $this->input->post();

                // Add categories to settings
                foreach ((array) $categories as $key => $value) {
                    $data[$key] = $value;
                }
                unset($data['action']);
                // Show message about result
                if ($this->seoexpert_model_products->setProductCategory($categoryId, $data, $locale) != FALSE) {
                    showMessage(lang("Changes saved", "mod_seoexpert"));
                    $action = $_POST['action'];
                    if ($action == 'close') {
                        pjax('/admin/components/init_window/mod_seoexpert/productsCategories');
                    }
                } else {
                    showMessage(lang("Can not create", "mod_seoexpert"), '', 'r');
                }
            }
        } else {
            // Set Category Id if no (for other language)
            if (!$category) {
                $categoryDef = $this->seoexpert_model_products->getCategoryNameAndId($id);
            }

            \CMSFactory\assetManager::create()
                    ->setData('locale', $locale)
                    ->setData('category', $category)
                    ->setData('categoryDef', $categoryDef)
                    ->renderAdmin('advanced/productsCategoryEdit');
        }
    }

    /**
     * Category autocomplete
     */
    public function categoryAutocomplete() {
        \mod_seoexpert\classes\SeoHelper::create()->autoCompleteCategories();
    }

    /**
     * Save settings
     * @param string $locale
     */
    public function save($locale = FALSE) {
        $baseSettings = $this->input->post('base');

        \mod_seoexpert\classes\SeoHelper::create()->setBaseSettings($locale, $baseSettings);

        $shopSettings = $this->input->post();
        unset($shopSettings['base']);

        if ($this->seoexpert_model->setSettings($shopSettings, $locale))
            showMessage(lang("Changes saved", "mod_seoexpert"));
    }

    /**
     * Ajax delete product categories
     * @return boolean
     */
    public function ajaxDeleteProductCategories() {
        if (count($_POST['ids']) < 1) {
            return FALSE;
        }

        foreach ($_POST['ids'] as $id) {
            $this->seoexpert_model_products->deleteCategoryById($id);
        }

        showMessage(lang('Deleted complete', 'admin'));
    }

    public function ajaxChangeActiveCategory() {
        $id = $this->input->post('id');
        if (!$id) {
            return FALSE;
        }
        if ($this->seoexpert_model_products->changeActiveCategory($id)) {
            echo 'true';
        }
    }

    public function ajaxChangeEmptyMetaCategory() {
        $id = $this->input->post('id');
        if (!$id) {
            return FALSE;
        }
        if ($this->seoexpert_model_products->changeEmptyMetaCategory($id)) {
            echo 'true';
        }
    }

}
