<?php

use Propel\Runtime\ActiveQuery\Criteria;

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Image CMS
 *
 * Navigation widgets
 * @property Lib_category lib_category
 */
class Navigation_Widgets extends MY_Controller
{

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('navigation');
    }

    /**
     * @return string
     */
    private function pathGallery() {
        if ($this->core->langs[$this->uri->segment(1)]) {
            $data_type = $this->uri->segment(1) !== $this->defaultLocale() ? $this->uri->segment(2) : $this->uri->segment(1);
        } else {
            $data_type = $this->uri->segment(1);
        }
        return $data_type;
    }

    /**
     * @param array $widget
     * @return string
     * @throws Exception
     */
    public function widget_navigation($widget = []) {
        $this->load->module('core');

        $segmentGallery = $this->pathGallery();
        if ($this->core->core_data['data_type'] === '404' || !$this->core->core_data['data_type'] || $segmentGallery === 'gallery') {
            $data_type = $segmentGallery;
        } else {
            $data_type = $this->core->core_data['data_type'];
        }

        switch ($data_type) {
            case 'category':
                $cur_category = $this->core->cat_content;
                $path_categories = $this->lib_category->get_category(array_keys($cur_category['path']));

                $tpl_data = ['navi_cats' => $path_categories];

                return $this->template->fetch('widgets/' . $widget['name'], $tpl_data);

            case 'page':
                $cur_category = $this->core->cat_content;
                $path_categories = $this->lib_category->get_category(array_keys($cur_category['path']));

                // Insert Page data
                $path_categories[] = [
                                      'path_url' => $this->core->page_content['cat_url'] . $this->core->page_content['url'],
                                      'name'     => $this->core->page_content['title'],
                                     ];

                $tpl_data = ['navi_cats' => $path_categories];

                return $this->template->fetch('widgets/' . $widget['name'], $tpl_data);

            case 'brand':
                if ($this->core->core_data['id'] != null) {
                    $brand = SBrandsQuery::create()->joinWithI18n(MY_Controller::getCurrentLocale())->findOneById($this->core->core_data['id']);

                    $navi_cats[] = [
                                    'path_url' => 'shop/brand/',
                                    'name'     => lang('Brands', 'navigation'),
                                   ];
                    $navi_cats[] = [
                                    'path_url' => 'shop/brand/' . $brand->getUrl(),
                                    'name'     => $brand->getName(),
                                   ];

                    $tpl_data = ['navi_cats' => $navi_cats];
                    return $this->template->fetch('widgets/' . $widget['name'], $tpl_data);
                } else {

                    if ($data_type == 'brand') {
                        return $this->make(lang('Brands', 'navigation'), 'shop/brand/', $widget);
                    }
                }
                break;
            case 'compare';
                return $this->make(lang('Compare', 'navigation'), 'shop/compare/', $widget);
            case 'order';
                return $this->make(lang('Order details', 'navigation'), 'shop/order/', $widget);
            case 'wish_list':
                return $this->make(lang('Wish list', 'navigation'), 'shop/wish_list/', $widget);

            case 'profile':
                return $this->make(lang('Profile', 'navigation'), 'shop/profile/', $widget);

            case 'search':
                return $this->make(lang('Search', 'navigation'), 'shop/search/', $widget);

            case 'callbacks':
                return $this->make(lang('Callbacks', 'navigation'), 'callbacks', $widget);

            case 'shop':
                return $this->make(lang('Compare', 'navigation'), 'shop/compare', $widget);

            case 'wishlist':
                return $this->make(lang('Wishlist', 'navigation'), 'wishlist', $widget);

            case 'cart':
                return $this->make(lang('Cart', 'navigation'), 'shop/cart/', $widget);

            case 'feedback':
                return $this->make(lang('Feedback', 'navigation'), 'feedback', $widget);

            case 'action_type':
                return $this->make(lang('Action type', 'navigation'), 'shop/action_type/show', $widget);

            case 'shop_category':
                if ($this->core->core_data['id'] !== null && $this->core->core_data > 0) {

                    $category = SCategoryQuery::create()->findOneById($this->core->core_data['id']);
                    $categories = $category->buildCategoryPath(Criteria::ASC, MY_Controller::getCurrentLocale());
                    $paths = [];

                    foreach ($categories as $category) {
                        $paths[] = [
                                    'path_url' => 'shop/category/' . $category->getFullPath(),
                                    'name'     => $category->getName(),
                                   ];
                    }

                    $tpl_data = ['navi_cats' => $paths];
                    return $this->template->fetch('widgets/' . $widget['name'], $tpl_data);
                } else {
                    throw new Exception('Category not found');
                }

                break;
            case 'product':
                if ($this->core->core_data['id'] != null && $this->core->core_data['id'] > 0) {
                    //get product model
                    $product = SProductsQuery::create()
                            ->joinWithI18n(MY_Controller::getCurrentLocale())
                            ->findOneById($this->core->core_data['id']);

                    if ($product) {

                        if ($product->getCategoryId() == null && $product->getCategoryId() == 0) {
                            throw new Exception('Category not found');
                        }

                        $category = SCategoryQuery::create()->findOneById($product->getCategoryId());
                        $categories = $category->buildCategoryPath(Criteria::ASC, MY_Controller::getCurrentLocale());

                        foreach ($categories as $category) {
                            $path[] = [
                                       'path_url' => 'shop/category/' . $category->getFullPath(),
                                       'name'     => $category->getName(),
                                      ];
                        }

                        $path[] = [
                                   'path_url' => '',
                                   'name'     => $product->getName(),
                                  ];

                        $tpl_data = ['navi_cats' => $path];
                        return $this->template->fetch('widgets/' . $widget['name'], $tpl_data);
                    } else {
                        throw new Exception('Product not found');
                    }
                }
                break;
            case 'gallery':
                $uri_segments = $this->uri->segment_array();
                $template_vars = $this->template->get_vars();

                $path = [];
                foreach ($uri_segments as $segment) {
                    switch ($segment) {
                        case 'gallery':
                            $path[] = [
                                       'path_url' => $segment,
                                       'name'     => lang('Gallery', 'navigation'),
                                      ];
                            break;
                        case 'category':
                            $path[] = [
                                       'path_url' => 'gallery/category/' . $template_vars['current_category']['id'],
                                       'name'     => $template_vars['current_category']['name'],
                                      ];
                            break;
                        case 'album':
                            $path[] = [
                                       'path_url' => 'gallery/category/' . $template_vars['current_category']['id'],
                                       'name'     => $template_vars['current_category']['name'],
                                      ];

                            $path[] = [
                                       'path_url' => "gallery/$segment/" . $template_vars['album']['id'],
                                       'name'     => $template_vars['album']['name'],
                                      ];
                            break;
                        case 'albums':
                            $path[] = [
                                       'path_url' => "gallery/$segment/",
                                       'name'     => lang('All albums', 'navigation'),
                                      ];
                            break;
                    }
                }

                $tpl_data = ['navi_cats' => $path];
                return $this->template->fetch('widgets/' . $widget['name'], $tpl_data);

            case 'auth':
                $uri_segments = $this->uri->segment_array();

                $path = [];
                foreach ($uri_segments as $segment) {
                    switch ($segment) {
                        case 'auth':
                            $path[] = [
                                       'path_url' => $segment,
                                       'name'     => lang('Login', 'navigation'),
                                      ];
                            break;
                        case 'register':
                            $path = [];
                            $path[] = [
                                       'path_url' => "auth/$segment",
                                       'name'     => lang('Registration', 'navigation'),
                                      ];
                            break;
                        case 'activate':
                            $path = [];
                            $path[] = [
                                       'path_url' => "auth/$segment",
                                       'name'     => lang('Activation', 'navigation'),
                                      ];
                            break;
                        case 'forgot_password':
                            $path = [];
                            $path[] = [
                                       'path_url' => "auth/$segment",
                                       'name'     => lang('Remind password', 'navigation'),
                                      ];
                            break;
                        case 'reset_password':
                            $path = [];
                            $path[] = [
                                       'path_url' => "auth/$segment",
                                       'name'     => lang('Reset password', 'navigation'),
                                      ];
                            break;
                        case 'change_password':
                            $path = [];
                            $path[] = [
                                       'path_url' => "auth/$segment",
                                       'name'     => lang('Change password', 'navigation'),
                                      ];
                            break;
                    }
                }

                $tpl_data = ['navi_cats' => $path];
                return $this->template->fetch('widgets/' . $widget['name'], $tpl_data);
        }
    }

    /**
     *
     * @param string $name
     * @param string $path_url
     * @param array $widget
     * @return string
     */
    public function make($name, $path_url, $widget) {
        $navi_cats[] = [
                        'path_url' => $path_url,
                        'name'     => $name,
                       ];
        $tpl_data = ['navi_cats' => $navi_cats];
        return $this->template->fetch('widgets/' . $widget['name'], $tpl_data);
    }

}

/* End of file widgets.php */