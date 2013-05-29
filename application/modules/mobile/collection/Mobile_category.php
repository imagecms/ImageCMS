<?php

namespace mobile\collection;

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * @uses Category.BaseCategory
 * @author Kaero <dev@imagecms.net>
 * @copyright (c) 2013, ImageCMS
 * @package Shop.ImageCMSModule
 */
class Mobile_category extends \Category\BaseCategory {

    protected static $_instance;

    /**
     * @copyright (c) 2013, ImageCMS
     * @package Shop.ImageCMSModule
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * @return view
     * @access public
     * @author Kaero <dev@imagecms.net>
     * @copyright ImageCMS (c) 2013
     */
    public function index() {
        //reg canonical
        if (isset(\ShopCore::$_GET))
            $this->template->registerCanonical(site_url($this->uri->uri_string()));

        //for canonical (another seo block)
        $this->core->set_meta_tags(
                $this->categoryModel->makePageTitle(), $this->categoryModel->getMetaKeywords(), $this->categoryModel->makePageDesc(), $this->pagination->cur_page, $this->categoryModel->getShowSiteTitle()
        );

        if ($this->input->get('filtermobile'))
            return $this->mobileFilter();

        /** Begin pagination */
        $this->load->library('pagination');
        $this->pagination = new \SPagination();
        $config['base_url'] = site_url('mobile/category/' . $this->categoryModel->getFullPath() . \SProductsQuery::getFilterQueryString());
        $config['page_query_string'] = true;
        $config['total_rows'] = $this->data[totalProducts];
        $config['per_page'] = $this->perPage;
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $this->pagination->num_links = 6;
        $this->pagination->initialize($config);


        /** Set data */
        $this->data[pagination] = $this->pagination->create_links();
        $this->data[pageNumber] = $this->pagination->cur_page;



        /** Render view for user */
        $this->render($this->templateFile, $this->data);
    }

    /**
     * @return view
     * @access public
     * @author Kaero <dev@imagecms.net>
     * @copyright ImageCMS (c) 2013
     */
    public function mobileFilter() {

        /** Filter initializing */
        \ShopCore::app()->SFilter->init($this->categoryModel);

        /** Init Brand list */
        $brands = \ShopCore::app()->SFilter->getBrands();

        /** Set data */
        $this->data['category'] = $this->categoryModel;
        $this->data['brands'] = $brands;

        /** Render view for user */
        $this->render('filter', $this->data);
    }

    /**
     * @return bool
     * @access public
     * @author Kaero <dev@imagecms.net>
     * @copyright ImageCMS (c) 2013
     */
    public static function init() {
        (null !== self::$_instance) OR self::$_instance = new self();
        return TRUE;
    }

}