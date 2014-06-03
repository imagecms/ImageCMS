<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Image CMS
 *
 * Navigation widgets
 */
class Navigation_Widgets extends MY_Controller {

    function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('navigation');
    }

    function widget_navigation($widget = array()) {
        $this->load->module('core');

        if ($widget['settings'] == FALSE) {
            $settings = $this->defaults;
        } else {
            $settings = $widget['settings'];
        }
        if ($this->core->core_data['data_type'] == '404') {
            $data_type = $this->uri->segment(2);
        } else {
            $data_type = $this->core->core_data['data_type'];
        }

        switch ($data_type) {
            case 'category':
                $cur_category = $this->core->cat_content;

                $i = 0;
                $path_count = count($cur_category['path']);

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
                    $ci = &get_instance();
                    $brand = $ci->db->select(array('url', 'name'))
                                    ->where(array('shop_brands.id' => $this->core->core_data['id'],
                                        'shop_brands_i18n.locale' => MY_Controller::getCurrentLocale()))
                                    ->join('shop_brands_i18n', 'shop_brands_i18n.id=shop_brands.id')
                                    ->limit(1)
                                    ->get('shop_brands')->row_array();
                    $navi_cats[] = array('path_url' => 'shop/brand/', 'name' => lang('Brands', 'navigation'));
                    $navi_cats[] = array('path_url' => $brand['url'], 'name' => $brand['name']);
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
            case 'shop_category':
                if ($this->core->core_data['id'] != null && $this->core->core_data > 0) {
                    //get category object
                    $ci = &get_instance();
                    $shop_category = $ci->db->select(array('full_path_ids', 'url', 'name'))
                            ->where(array('shop_category.id' => $this->core->core_data['id'],
                                'shop_category_i18n.locale' => MY_Controller::getCurrentLocale()))
                            ->join('shop_category_i18n', 'shop_category_i18n.id=shop_category.id')
                            ->limit(1)
                            ->get('shop_category');
                    if ($shop_category) {
                        $shop_category = $shop_category->result();
                        $full_path_ids = $shop_category[0]->full_path_ids;
                        $full_path_ids = unserialize($full_path_ids);
                        $result = array();
                        if (is_array($full_path_ids) && !empty($full_path_ids)) {
                            $result = $ci->db->select('*')
                                    ->where('locale', MY_Controller::getCurrentLocale())
                                    ->where_in('shop_category.id', $full_path_ids)
                                    ->order_by('full_path_ids')
                                    ->join('shop_category_i18n', 'shop_category_i18n.id=shop_category.id')
                                    ->get('shop_category');
                            if ($result) {
                                $result = $result->result_array();
                                foreach ($result as $key => $value) {
                                    $result[$key]['path_url'] = 'shop/category/' . $result[$key]['full_path'];
                                    unset($result[$key]['url']);
                                }
                                $result[] = array('path_url' => $shop_category[0]->url,
                                    'name' => $shop_category[0]->name);
                            }
                        } else {
                            //current category is first level category
                            $result[] = array('path_url' => $shop_category[0]->url, 'name' => $shop_category[0]->name);
                        }
                        $tpl_data = array('navi_cats' => $result);
                        return $this->template->fetch('widgets/' . $widget['name'], $tpl_data);
                    } else {
                        throw new Exception("Category not found");
                    }
                }
                break;
            case 'product':
                if ($this->core->core_data['id'] != null && $this->core->core_data['id'] > 0) {
                    $ci = &get_instance();
                    //get product model
                    $product = $ci->db->select(array('name', 'category_id'))
                            ->where(array('shop_products.id' => $this->core->core_data['id'],
                                'locale' => MY_Controller::getCurrentLocale()))
                            ->join('shop_products_i18n', 'shop_products_i18n.id=shop_products.id')
                            ->get('shop_products');
                    if ($product) {
                        $product = $product->result_array();
                        $product = $product[0];

                        if ($product['category_id'] == null && $product['category_id'] == 0)
                            throw new Exception("Category not found");

                        // getting categories
                        $ci->db->cache_on();
                        $result = $ci->db
                                ->select(array('shop_category.id', 'parent_id', 'full_path', 'name'))
                                ->where(array('shop_category_i18n.locale' => MY_Controller::getCurrentLocale()))
                                ->join('shop_category_i18n', 'shop_category_i18n.id=shop_category.id')
                                ->get('shop_category');
                        $ci->db->cache_off();

                        if (!$result)
                            return;

                        $categories = array();
                        foreach ($result->result_array() as $row) {
                            $categories[$row['id']] = $row;
                        }

                        // building path 
                        $neededCid = $product['category_id'];
                        $path = array(
                            array('path_url' => '', 'name' => $product['name'])
                        );

                        while ($neededCid != 0) {
                            $path[] = array(
                                'path_url' => 'shop/category/' . $categories[$neededCid]['full_path'],
                                'name' => $categories[$neededCid]['name'],
                            );
                            $neededCid = $categories[$neededCid]['parent_id'];
                        }

                        // path is using from back, so...
                        $fromBack = array_reverse($path);

                        $tpl_data = array('navi_cats' => $fromBack);
                        return $this->template->fetch('widgets/' . $widget['name'], $tpl_data);
                    } else {
                        throw new Exception("Product not found");
                    }
                }
                break;
        }
    }

    // Template functions
    function display_tpl($file, $vars = array()) {
        $this->template->add_array($vars);

        $file = realpath(dirname(__FILE__)) . '/templates/' . $file . '.tpl';
        $this->template->display('file:' . $file);
    }

    function fetch_tpl($file, $vars = array()) {
        $this->template->add_array($vars);

        $file = realpath(dirname(__FILE__)) . '/templates/' . $file . '.tpl';
        return $this->template->fetch('file:' . $file);
    }

}

/* End of file widgets.php */
