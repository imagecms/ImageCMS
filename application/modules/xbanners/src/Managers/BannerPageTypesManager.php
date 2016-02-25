<?php
namespace xbanners\src\Managers;

class BannerPageTypesManager
{

    const PAGE_TYPE_MAIN = 'main';
    const PAGE_TYPE_SHOP_CATEGORY = 'shop_category';
    const PAGE_TYPE_PRODUCT = 'product';
    const PAGE_TYPE_CATEGORY = 'category';
    const PAGE_TYPE_PAGE = 'page';
    const PAGE_TYPE_BRAND = 'brand';
    const PAGE_TYPE_SEARCH = 'search';

    /**
     * @var BannerPageTypesManager instance
     */
    private static $instance = NULL;

    private function __construct() {

    }

    /**
     * Get BannerPageTypesManager instance
     * @return BannerPageTypesManager instance
     */
    public static function getInstance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Get banner pages type|types: ['main', 'shop_category', 'product',...] on nothing to get all types array
     * @param string $type - banner type
     * @return array
     */
    public function getPagesTypes($type = NULL) {
        $pageTypes = [
            'main' => [
                'name' => lang('Main', 'xbanners'),
                'class' => NULL
            ],
            'shop_category' => [
                'name' => lang('Product category', 'xbanners'),
                'class' => '\xbanners\src\BannerPagesTypes\ShopCategory'
            ],
            'product' => [
                'name' => lang('Product', 'xbanners'),
                'class' => '\xbanners\src\BannerPagesTypes\Product'
            ],
            'category' => [
                'name' => lang('Page category', 'xbanners'),
                'class' => '\xbanners\src\BannerPagesTypes\Category'
            ],
            'page' => [
                'name' => lang('Page', 'xbanners'),
                'class' => '\xbanners\src\BannerPagesTypes\Page'
            ],
            'brand' => [
                'name' => lang('Product brand', 'xbanners'),
                'class' => '\xbanners\src\BannerPagesTypes\Brand'
            ],
            'search' => [
                'name' => lang('Search page', 'xbanners'),
                'class' => NULL
            ],
        ];

        return $type ? $pageTypes[$type] : $pageTypes;
    }

    /**
     * Get banner type view
     * @param string $type - banner page type name type: ['main', 'shop_category', 'product',...]
     * @param string $locale - locale name
     * @return array
     */
    public function getView($type, $locale = NULL) {
        $locale = $locale ? $locale : \MY_Controller::defaultLocale();
        $type = $this->getPagesTypes($type);

        if (!$type OR !$type['class'] OR !class_exists($type['class'])) {
            return NULL;
        }

        $typeObj = new $type['class']($locale);

        return $typeObj->getView();
    }

    /**
     * Get banner page type allowed pages list
     * @param string $type - banner page type name type: ['main', 'shop_category', 'product',...]
     * @param string $locale - locale name
     * @return array
     */
    public function getPages($type, $locale = NULL) {
        $locale = $locale ? $locale : \MY_Controller::defaultLocale();
        $type = $this->getPagesTypes($type);

        if (!$type OR !$type['class'] OR !class_exists($type['class'])) {
            return NULL;
        }

        $typeObj = new $type['class']($locale);

        return $typeObj->getPages();
    }
}