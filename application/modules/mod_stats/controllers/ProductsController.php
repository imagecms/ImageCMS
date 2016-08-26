<?php

use Propel\Runtime\Propel;

/**
 * Class ProductsController for mod_stats module
 * @uses ControllerBase
 * @author DevImageCms
 * @copyright (c) 2014, ImageCMS
 * @package ImageCMSModule
 */
class ProductsController extends ControllerBase
{

    public $perPage = 24;

    public function __construct($some) {
        parent::__construct($some);
        $this->controller->load->model('products_model');
    }

    /**
     * Render template with data
     */
    public function categories() {
        $firstLevelCategories = $this->controller->products_model->getFirstLevelCategories();
        $this->assetManager
            ->setData('categories', $firstLevelCategories)
            ->renderAdmin('products/categories');
    }

    /**
     * Get data for char
     */
    public function getCategoriesChartData() {
        $params = [
                   'categoryId' => isset($_GET['catId']) ? $_GET['catId'] : 0,
                  ];
        $catIds = $this->controller->products_model->getSubcategoriesIds($params['categoryId']);
        //        if (!$catIds && $params['categoryId'] != 'main' ){
        //            $catIds = array($params['categoryId']);
        //        }
        $categories = $this->controller->products_model->getCategoriesCountsData($catIds, TRUE);
        $chartData = parent::prepareDataForStaticChart($categories);

        echo json_encode($chartData);
    }

    /**
     * Render template
     */
    public function brands() {

        $this->assetManager
            ->renderAdmin('products/brands');
    }

    /**
     * Get data for char
     */
    public function getBrandsChartData() {
        $params = [
                   'topBrandsCount' => isset($_GET['stbc']) ? $_GET['stbc'] : 20,
                  ];

        $brands = $this->controller->products_model->getBrandsCountsData($params['topBrandsCount'], NULL, TRUE);

        $chartData = parent::prepareDataForStaticChart($brands);
        echo json_encode($chartData);
    }

    /**
     * Render template with data
     * @param integer $perPage
     */
    public function productInfo($perPage = 0) {
        // Get products model
        $model = SProductsQuery::create()
                ->joinWithI18n(\MY_Controller::defaultLocale())
                ->addSelectModifier('SQL_CALC_FOUND_ROWS')
                ->leftJoinProductVariant();

        // Filter by category id
        if (isset(ShopCore::$_GET['CategoryId']) && ShopCore::$_GET['CategoryId'] > 0) {
            $category = SCategoryQuery::create()
                    ->filterById((int) ShopCore::$_GET['CategoryId'])
                    ->findOne();
            if ($category) {
                $model = $model->filterByCategory($category);
            }
        }

        // Filter by product id
        if (isset(ShopCore::$_GET['filterID']) && ShopCore::$_GET['filterID'] > 0) {
            $model = $model->filterById((int) ShopCore::$_GET['filterID']);
        }

        // Filter by name
        if (!empty(ShopCore::$_GET['text'])) {
            $text = ShopCore::$_GET['text'];
            if (!strpos($text, '%')) {
                $text = '%' . $text . '%';
            }

            $model = $model->useI18nQuery(\MY_Controller::defaultLocale())
                ->where('SProductsI18n.Name LIKE ?', $text)
                ->endUse()
                ->_or()
                ->where('ProductVariant.Number = ?', $text);
        }

        //        $model = $model->orderBy('AddedToCartCount', 'DESC');
        // Order by params
        if (isset(ShopCore::$_GET['orderMethod']) && ShopCore::$_GET['orderMethod'] != '') {
            $order_methods = [
                              'Id',
                              'Name',
                              'Category',
                              'Views',
                              'AddedToCartCount',
                             ];
            if (in_array(ShopCore::$_GET['orderMethod'], $order_methods)) {
                switch (ShopCore::$_GET['orderMethod']) {
                    case 'Id':
                        $model = $model->orderById(ShopCore::$_GET['order']);
                        break;
                    case 'Name':
                        $model = $model->useI18nQuery(MY_Controller::defaultLocale())->orderByName(ShopCore::$_GET['order'])->endUse();
                        break;
                    case 'Category':
                        $model = $model->useShopProductCategoriesQuery()->orderByCategoryId(ShopCore::$_GET['order'])->endUse();
                        break;
                    case 'AddedToCartCount':
                        $model = $model->orderByAddedToCartCount(ShopCore::$_GET['order'])->orderByViews(ShopCore::$_GET['order']);
                        break;
                    case 'Views':
                        $model = $model->orderByViews(ShopCore::$_GET['order']);
                        break;
                    default :
                        $model = $model->orderByAddedToCartCount('DESC')->orderByViews('DESC');
                        break;
                }
            }
        } else {
            $model = $model->orderByAddedToCartCount('DESC')->orderByViews('DESC');
        }

        // Get results
        $model = $model
            ->offset((int) $perPage)
            ->limit($this->perPage)
            ->distinct()
            ->find();

        // Count total products
        $totalProducts = $this->getTotalRow();

        // Create pagination
        $this->controller->load->library('pagination');
        $config['base_url'] = site_url('/admin/components/cp/mod_stats/products/productInfo');
        $config['per_page'] = $this->perPage;
        $config['suffix'] = '?' . http_build_query($_GET, '', '&');
        $config['uri_segment'] = 7;
        $config['total_rows'] = $totalProducts;
        $config['per_page'] = $this->perPage;

        $config['first_url'] = site_url('/admin/components/cp/mod_stats/products/productInfo/0?' . http_build_query($_GET, '', '&'));
        $config['separate_controls'] = true;
        $config['full_tag_open'] = '<div class="pagination pull-left"><ul>';
        $config['full_tag_close'] = '</ul></div>';
        $config['controls_tag_open'] = '<div class="pagination pull-right"><ul>';
        $config['controls_tag_close'] = '</ul></div>';
        $config['cur_tag_open'] = '<li class="btn-primary active"><span>';
        $config['cur_tag_close'] = '</span></li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['num_tag_close'] = '</li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';

        $this->controller->pagination->num_links = 6;
        $this->controller->pagination->initialize($config);

        // Set data and render template
        $this->assetManager
            ->setData('categories', \ShopCore::app()->SCategoryTree->getTree())
            ->setData('pagination', $this->controller->pagination->create_links())
            ->setData('products', $model)
            ->renderAdmin('products/productInfo');
    }

    /**
     * Get total product count
     * @return int
     */
    private function getTotalRow() {
        $connection = Propel::getConnection('Shop');
        $statement = $connection->prepare('SELECT FOUND_ROWS() as `number`');
        $statement->execute();
        $resultset = $statement->fetchAll();
        return $resultset[0]['number'];
    }

    public function attendance_test() {

    }

}