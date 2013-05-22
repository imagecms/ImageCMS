<?php

namespace mobile\collection;

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * @uses Search.BaseSearch
 * @author A.Gula <dev@imagecms.net>
 * @copyright (c) 2013, ImageCMS
 * @package Shop.ImageCMSModule
 */
class Mobile_search extends \Search\BaseSearch {

    protected static $_instance;

    /**
     * @return view
     * @access public
     * @author Kaero
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * @return view
     * @access public
     * @author Kaero
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    public function index() {

        /** Build pagination */
        $this->load->library('Pagination');
        $this->pagination = new \SPagination();
        $config['base_url'] = mobile_url('search/' . $this->_getQueryString());
        $config['per_page'] = $this->perPage;
        $config['total_rows'] = $this->data[totalProducts];
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['page_query_string'] = true;
        $this->pagination->num_links = 6;
        $this->pagination->initialize($config);

        /** Register cannonical link if we are in search */
        if (isset(\ShopCore::$_GET['text']) or \ShopCore::$_GET['category'])
            $this->template->registerMeta("<link href='" . site_url($this->uri->uri_string()) . "' rel='canonical'>");

        /** And say to robot: don't index search pages */
        $this->template->registerMeta('<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW" />');

        /** Set view data */
        $this->data[pagination] = $this->pagination->create_links();

        /** Render view for user */
        $this->render('search', $this->data);
    }

    /**
     * @return bool
     * @access public
     * @author Kaero
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    public static function init() {
        (null !== self::$_instance) OR self::$_instance = new self();
        return TRUE;
    }

}