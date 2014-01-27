<?php

/**
 * 
 *
 * @author 
 */
class ProductsController extends ControllerBase {

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
        $params = array(
            'categoryId' => isset($_GET['catId']) ? $_GET['catId'] : 0,
        );
        $catIds = $this->controller->products_model->getSubcategoriesIds($params['categoryId']);
        $categories = $this->controller->products_model->getCategoriesCountsData($catIds);

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
        $params = array(
            'topBrandsCount' => isset($_GET['stbc']) ? $_GET['stbc'] : 20,
        );

        $brands = $this->controller->products_model->getBrandsCountsData($params['topBrandsCount']);

        $chartData = parent::prepareDataForStaticChart($brands);
        echo json_encode($chartData);
    }

    /**
     * Render template with data
     * @param int $perPage
     */
    public function productInfo($perPage = 0) {

        $model = SProductsQuery::create()
                ->joinWithI18n(\MY_Controller::defaultLocale(), Criteria::LEFT_JOIN)
                ->addSelectModifier('SQL_CALC_FOUND_ROWS')
                ->leftJoinProductVariant();

        // Filter by category id
        if (isset(ShopCore::$_GET['CategoryId']) && ShopCore::$_GET['CategoryId'] > 0) {
            $category = SCategoryQuery::create()
                    ->filterById((int) ShopCore::$_GET['CategoryId'])
                    ->findOne();
            if ($category)
                $model = $model->filterByCategory($category);
        }

        // Filter by product id
        if (isset(ShopCore::$_GET['filterID']) && ShopCore::$_GET['filterID'] > 0)
            $model = $model->filterById((int) ShopCore::$_GET['filterID']);

        // Filter by name
        if (!empty(ShopCore::$_GET['text'])) {
            $text = ShopCore::$_GET['text'];
            if (!strpos($text, '%'))
                $text = '%' . $text . '%';

            $model = $model->useI18nQuery(\MY_Controller::defaultLocale())
                    ->where('SProductsI18n.Name LIKE ?', $text)
                    ->endUse()
                    ->orWhere('ProductVariant.Number = ?', $text);
        }






        if (isset(ShopCore::$_GET['orderMethod']) && ShopCore::$_GET['orderMethod'] != '') {
            $order_methods = array('Id', 'Name', 'CategoryId', 'Views', 'AddedToCartCount');
            if (in_array(ShopCore::$_GET['orderMethod'], $order_methods)) {
                switch (ShopCore::$_GET['orderMethod']) {
                    case 'Name':
                        $model = $model->useSProductsI18nQuery()->orderByName(ShopCore::$_GET['order'])->endUse();
                        break;
                    case 'Price':
                        $model = $model->useProductVariantQuery()->orderByPrice(ShopCore::$_GET['order'])->endUse();
                        break;
                    default :
                        $model = $model->orderBy(ShopCore::$_GET['orderMethod'], ShopCore::$_GET['order']);
                        break;
                }
            }
        }










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
        $config['suffix'] = '?' . http_build_query($_GET, '', "&");
        $config['uri_segment'] = 7;
        $config['total_rows'] = $totalProducts;
        $config['per_page'] = $this->perPage;

        $config['separate_controls'] = true;
        $config['first_url'] = site_url('/admin/components/cp/mod_stats/products/productInfo/0?' . http_build_query($_GET, '', "&"));
        $config['full_tag_open'] = '<div class="pagination pull-left"><ul>';
        $config['full_tag_close'] = '</ul></div>';
        $config['controls_tag_open'] = '<div class="pagination pull-right"><ul>';
        $config['controls_tag_close'] = '</ul></div>';
        $config['next_link'] = lang('Next', 'admin') . '&nbsp;&gt;';
        $config['prev_link'] = '&lt;&nbsp;' . lang('Prev', 'admin');
        $config['cur_tag_open'] = '<li class="btn-primary active"><span>';
        $config['cur_tag_close'] = '</span></li>';
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
        $connection = Propel::getConnection();
        $statement = $connection->prepare('SELECT FOUND_ROWS() as `number`');
        $statement->execute();
        $resultset = $statement->fetchAll();
        return $resultset[0]['number'];
    }

    public function attendance_test() {
        
    }

}
