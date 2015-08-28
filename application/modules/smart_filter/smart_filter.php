<?php

use CI;
use CMSFactory\Events;
use CMSFactory\assetManager as AssetManager;
use CMSFactory\ExternalTabs\ExternalTabs;
use smart_filter\classes\Filter;
use Category\BaseCategory;

class smart_filter extends \MY_Controller {

    /**
     *
     * @var boolean
     */
    private $wasAutoloaded = false;

    public function __construct() {
        parent::__construct();
        $this->load->model('module_managment');
    }

    /**
     *
     */
    public function init() {
        $this->_render();
    }

    /**
     *
     */
    public function _render() {
        if (!$this->wasAutoloaded) {
            return;
        }
        echo AssetManager::create()->fetchTemplate('main');
    }

    /**
     * Registering tab in mod_seo module
     */
    public static function adminAutoload() {
        if (parent::isPremiumCMS()) {
            smart_filter\classes\PhysicalPages::modSeoTab();
        }
    }

    /**
     * The actual filtering
     */
    public function autoload() {
        $this->wasAutoloaded = true;
        Events::create()->setListener([$this, '_onPreselectCategoryProducts'], BaseCategory::EVENT_CATEGORY_PRESELECT_PRODUCTS);

        if (parent::isPremiumCMS()) {
            $physicalPages = new smart_filter\classes\PhysicalPages();
            Events::create()->setListener([$physicalPages, '_onPreloadCategoryProducts'], BaseCategory::EVENT_CATEGORY_PRELOAD);
            Events::create()->setListener([$physicalPages, '_onLoadCategory'], BaseCategory::EVENT_CATEGORY_LOAD);
        }
    }

    public function formCategoryPath() {
        return (new smart_filter\classes\PhysicalPages())->formCategoryPath();
    }

    public function attachPages($sitemapObj) {
        $seoPages = $this->module_managment->get(MY_Controller::getCurrentLocale());
        if (!$seoPages) {
            return false;
        }

        $siteMapPages = [];
        array_map(
            function ($page) use (&$siteMapPages, $sitemapObj) {
                if ((int) $page['category_parent_id']) {
                    $changefreq = $sitemapObj->products_sub_categories_changefreq;
                    $priority = $sitemapObj->products_sub_categories_priority;
                } else {
                    $changefreq = $sitemapObj->products_categories_changefreq;
                    $priority = $sitemapObj->products_categories_priority;
                }

                if ($page['type'] === 'brand') {
                    $sitemapItem = [
                        'loc' => site_url($page['locale'] . '/shop/category/' . $page['category_full_path'] . '/brand-' . $page['brand_url']),
                        'changefreq' => $changefreq,
                        'priority' => $priority,
                        'lastmod' => date('Y-m-d', $page['updated'])
                    ];
                    array_unshift($siteMapPages, $sitemapItem);
                }

                if ($page['type'] === 'property') {
                    $productValues = $this->module_managment->getProductsValues($page['property_id'], $page['category_id']);

                    foreach ($productValues as $productValue) {
                        $sitemapItem = [
                            'loc' => site_url($page['locale'] . '/shop/category/' . $page['category_full_path'] . '/property-' . $page['property_csv_name'] . '-' . $productValue['id']),
                            'changefreq' => $changefreq,
                            'priority' => $priority,
                            'lastmod' => date('Y-m-d', $page['updated'])
                        ];
                        array_push($siteMapPages, $sitemapItem);
                    }
                }
            },
            $seoPages
        );

        $sitemapObj->items = array_merge($sitemapObj->items, $siteMapPages);
    }

    /**
     *
     * @param array $data
     */
    public function _onPreselectCategoryProducts($data) {
        $productsQuery = $data['productsQuery'];
        $categoryModel = $data['model'];

        $getParams = CI::$APP->input->get();
        $filter = new Filter($categoryModel, $getParams);
        $filter->applyFilterConditions($productsQuery);

        $priceRange = $filter->getPricerange();
        $curMin = isset($getParams['lp']) ? (int) $getParams['lp'] : (int) $priceRange['minCost'];
        $curMax = isset($getParams['rp']) ? (int) $getParams['rp'] : (int) $priceRange['maxCost'];

        AssetManager::create()
                ->registerScript('jquery.ui-slider', false, 'after')
                ->registerScript('filter', false, 'after')
                ->setData(
                    [
                            'brands' => $filter->getBrands(),
                            'propertiesInCat' => $filter->getProperties(),
                            'priceRange' => $priceRange,
                            'curMin' => $curMin,
                            'curMax' => $curMax,
                            'minPrice' => (int) $priceRange['minCost'],
                            'maxPrice' => (int) $priceRange['maxCost'],
                        ]
                );
    }

    /**
     * Processes form data from mod_seo
     */
    public function _inputHandlerCallback() {
        if (!$this->input->post()) {
            return;
        }

        // processing form will be done here (but not by me unfortunately...) =)))
    }

    public function _install() {
        $this->load->model('module_managment')->installModule();
    }

    public function _deinstall() {
        $this->load->model('module_managment')->deinstallModule();
    }

}