<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Image CMS
 *
 * Navigation widgets
 */
class Navigation_Widgets extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('navigation');
    }
    
    private function pathGallery(){
        if ($this->core->langs[$this->uri->segment(1)]) {
            $data_type = $this->uri->segment(1) !== $this->defaultLocale() ? $this->uri->segment(2) : $this->uri->segment(1);
        } else {
            $data_type = $this->uri->segment(1);
        }
        return $data_type;
    }

    public function widget_navigation($widget = array()) {
        $this->load->module('core');
        
        if ($widget['settings'] == FALSE) {
            $settings = $this->defaults;
        } else {
            $settings = $widget['settings'];
        }
        
        $segmentGallery = $this->pathGallery();        
        if ($this->core->core_data['data_type'] == '404' || !$this->core->core_data['data_type'] || $segmentGallery == 'gallery') {
            $data_type = $segmentGallery;
        } else {
            $data_type = $this->core->core_data['data_type'];
        }
        
        switch ($data_type) {
            case 'category':
                $cur_category = $this->core->cat_content;
                $path_categories = $this->lib_category->get_category(array_keys($cur_category['path']));

                $tpl_data = array('navi_cats' => $path_categories);

                return $this->template->fetch('widgets/' . $widget['name'], $tpl_data);
                break;

            case 'page':
                $cur_category = $this->core->cat_content;
                $path_categories = $this->lib_category->get_category(array_keys($cur_category['path']));

                // Insert Page data
                $path_categories[] = array(
                    'path_url' => $this->core->page_content['cat_url'] . $this->core->page_content['url'],
                    'name' => $this->core->page_content['title']
                );

                $tpl_data = array('navi_cats' => $path_categories);

                return $this->template->fetch('widgets/' . $widget['name'], $tpl_data);
                break;
            case 'brand':
                if ($this->core->core_data['id'] != null) {
                    $brand = SBrandsQuery::create()->joinWithI18n(MY_Controller::getCurrentLocale())->findOneById($this->core->core_data['id']);

                    $navi_cats[] = array('path_url' => 'shop/brand/', 'name' => lang('Brands', 'navigation'));
                    $navi_cats[] = array('path_url' => 'shop/brand/' . $brand->getUrl(), 'name' => $brand->getName());

                    $tpl_data = array('navi_cats' => $navi_cats);
                    return $this->template->fetch('widgets/' . $widget['name'], $tpl_data);
                } else {
                    if ($data_type == 'brand') {
                        $navi_cats[] = array('path_url' => 'shop/brand/', 'name' => lang('Brands', 'navigation'));
                        $tpl_data = array('navi_cats' => $navi_cats);
                        return $this->template->fetch('widgets/' . $widget['name'], $tpl_data);
                    }
                }
                break;
            case 'compare';
                $navi_cats[] = array('path_url' => 'shop/compare/', 'name' => lang('Compare', 'navigation'));
                $tpl_data = array('navi_cats' => $navi_cats);
                return $this->template->fetch('widgets/' . $widget['name'], $tpl_data);
                break;
            case 'wish_list':
                $navi_cats[] = array('path_url' => 'shop/wish_list/', 'name' => lang('Wish list', 'navigation'));
                $tpl_data = array('navi_cats' => $navi_cats);
                return $this->template->fetch('widgets/' . $widget['name'], $tpl_data);
                break;
            case 'profile':
                $navi_cats[] = array('path_url' => 'shop/profile/', 'name' => lang('Profile', 'navigation'));
                $tpl_data = array('navi_cats' => $navi_cats);
                return $this->template->fetch('widgets/' . $widget['name'], $tpl_data);
                break;
            case 'search':
                $navi_cats[] = array('path_url' => 'shop/search/', 'name' => lang('Search', 'navigation'));
                $tpl_data = array('navi_cats' => $navi_cats);
                return $this->template->fetch('widgets/' . $widget['name'], $tpl_data);
                break;
            case 'cart':
                $navi_cats[] = array('path_url' => 'shop/cart/', 'name' => lang('Cart', 'navigation'));
                $tpl_data = array('navi_cats' => $navi_cats);
                return $this->template->fetch('widgets/' . $widget['name'], $tpl_data);
                break;
            case 'feedback':
                $navi_cats[] = array('path_url' => 'feedback', 'name' => lang('Feedback', 'feedback'));
                $tpl_data = array('navi_cats' => $navi_cats);
                return $this->template->fetch('widgets/' . $widget['name'], $tpl_data);
                break;
            case 'shop_category':
                if ($this->core->core_data['id'] != null && $this->core->core_data > 0) {

                    $category = SCategoryQuery::create()->findOneById($this->core->core_data['id']);
                    $categories = $category->buildCategoryPath(\Propel\Runtime\ActiveQuery\Criteria::ASC, MY_Controller::getCurrentLocale());
                    $paths = [];

                    foreach ($categories as $category) {
                        $paths[] = [
                            'path_url' => 'shop/category/' . $category->getFullPath(),
                            'name' => $category->getName(),
                        ];
                    }

                    $tpl_data = array('navi_cats' => $paths);
                    return $this->template->fetch('widgets/' . $widget['name'], $tpl_data);
                } else {
                    throw new Exception("Category not found");
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
                            throw new Exception("Category not found");
                        }

                        $category = SCategoryQuery::create()->findOneById($product->getCategoryId());
                        $categories = $category->buildCategoryPath(\Propel\Runtime\ActiveQuery\Criteria::ASC, MY_Controller::getCurrentLocale());

                        foreach ($categories as $category) {
                            $path[] = [
                                'path_url' => 'shop/category/' . $category->getFullPath(),
                                'name' => $category->getName(),
                            ];
                        }

                        $path[] = array(
                            'path_url' => '',
                            'name' => $product->getName()
                        );

                        $tpl_data = array('navi_cats' => $path);
                        return $this->template->fetch('widgets/' . $widget['name'], $tpl_data);
                    } else {
                        throw new Exception("Product not found");
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
                            $path[] = array(
                                'path_url' => $segment,
                                'name' => lang('Gallery', 'navigation'),
                            );
                            break;
                        case 'category':
                            $path[] = array(
                                'path_url' => 'gallery/category/' . $template_vars['current_category']['id'],
                                'name' => $template_vars['current_category']['name'],
                            );
                            break;
                        case 'album':
                            $path[] = array(
                                'path_url' => 'gallery/category/' . $template_vars['current_category']['id'],
                                'name' => $template_vars['current_category']['name'],
                            );

                            $path[] = array(
                                'path_url' => "gallery/$segment/" . $template_vars['album']['id'],
                                'name' => $template_vars['album']['name'],
                            );
                            break;
                        case 'albums':
                            $path[] = array(
                                'path_url' => "gallery/$segment/",
                                'name' => lang('All albums', 'navigation'),
                            );
                            break;
                    }

                }

                $tpl_data = array('navi_cats' => $path);
                return $this->template->fetch('widgets/' . $widget['name'], $tpl_data);
                break;

            case 'auth':
                $uri_segments = $this->uri->segment_array();

                $path = [];
                foreach ($uri_segments as $segment) {
                    switch ($segment) {
                        case 'auth':
                            $path[] = array(
                                'path_url' => $segment,
                                'name' => lang('Login', 'navigation'),
                            );
                            break;
                        case 'register':
                            $path = [];
                            $path[] = array(
                                'path_url' => "auth/$segment",
                                'name' => lang('Registration', 'navigation'),
                            );
                            break;
                        case 'activate':
                            $path = [];
                            $path[] = array(
                                'path_url' => "auth/$segment",
                                'name' => lang('Activation', 'navigation'),
                            );
                            break;
                        case 'forgot_password':
                            $path = [];
                            $path[] = array(
                                'path_url' => "auth/$segment",
                                'name' => lang('Remind password', 'navigation'),
                            );
                            break;
                        case 'reset_password':
                            $path = [];
                            $path[] = array(
                                'path_url' => "auth/$segment",
                                'name' => lang('Reset password', 'navigation'),
                            );
                            break;
                        case 'change_password':
                            $path = [];
                            $path[] = array(
                                'path_url' => "auth/$segment",
                                'name' => lang('Change password', 'navigation'),
                            );
                            break;
                    }

                }

                $tpl_data = array('navi_cats' => $path);
                return $this->template->fetch('widgets/' . $widget['name'], $tpl_data);
                break;

        }
    }

    // Template functions

    public function display_tpl($file, $vars = array()) {
        $this->template->add_array($vars);

        $file = realpath(dirname(__FILE__)) . '/templates/' . $file . '.tpl';
        $this->template->display('file:' . $file);
    }

    public function fetch_tpl($file, $vars = array()) {
        $this->template->add_array($vars);

        $file = realpath(dirname(__FILE__)) . '/templates/' . $file . '.tpl';
        return $this->template->fetch('file:' . $file);
    }

}

/* End of file widgets.php */