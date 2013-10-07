<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS 
 * Sample Module Admin
 */
class Admin extends BaseAdminController {

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('module_frame');
        $this->load->model('documentation_model');
    }

    public function index() {
        $this->byCategory();
    }

    public function create() {
        \CMSFactory\assetManager::create()
                ->setData(array(
                    'content' => $templateContent
                ))
                ->renderAdmin("main");
    }

    public function edit($pageId) {

        $pageData = $this->documentation_model->getPageData($pageId);

        $categoriesTree = \CMSFactory\assetManager::create()
                ->setData(array('tree' => $this->lib_category->build(), 'sel_cat' => $pageData['category']))
                ->fetchAdminTemplate('cats_select');

        \CMSFactory\assetManager::create()
                ->setData(array(
                    'page' => $pageData,
                    'categoriesTree' => $categoriesTree,
                ))
                ->renderAdmin('edit');
    }

    /**
     * Display list of categories
     * @param type $cat_id
     * @param type $cur_page
     */
    public function byCategory($cat_id = 'all', $cur_page = 0) {

        if ($cat_id != 'all') {
            $db_where = array(
                'category' => $cat_id,
                'lang_alias' => 0
            );
        } else {
            $db_where = array(
                'lang_alias' => 0
            );
        }

        ($hook = get_hook('admin_get_pages_by_cat')) ? eval($hook) : NULL;

        $pageNum = $this->uri->segment(7) == FALSE ? 0 : $this->uri->segment(7);

        $per_page = 12;

        $result = $this->db
                ->limit($per_page, $per_page * $pageNum)
                ->where($db_where)
                ->get('content');

        // count of all pages for pagination
        $total_pages = $this->documentation_model->getContentsCount($db_where);

        if ($result->num_rows > 0) {
            // Begin pagination
            $paginationConfig = array(
                'base_url' => site_url('admin/components/cp/documentation/byCategory/' . $cat_id . '/'),
                'container' => 'page',
                'uri_segment' => 7,
                'total_rows' => $total_pages,
                'per_page' => $per_page,
                'separate_controls' => true,
                'full_tag_open' => '<div class="pagination pull-left"><ul>',
                'full_tag_close' => '</ul></div>',
                'controls_tag_open' => '<div class="pagination pull-right"><ul>',
                'controls_tag_close' => '</ul></div>',
                'next_link' => lang('Next', 'admin') . '&nbsp;&gt;',
                'prev_link' => '&lt;&nbsp;' . lang('Prev', 'admin'),
                'cur_tag_open' => '<li class="btn-primary active"><span>',
                'cur_tag_close' => '</span></li>',
                'prev_tag_open' => '<li>',
                'prev_tag_close' => '</li>',
                'next_tag_open' => '<li>',
                'next_tag_close' => '</li>',
                'num_tag_close' => '</li>',
                'num_tag_open' => '<li>',
                'num_tag_close' => '</li>'
            );

            $this->load->library('pagination');
            $this->pagination->num_links = 5;
            $this->pagination->initialize($paginationConfig);
            // End pagination

            $pages = $result->result_array();

            $data = array(
                'paginator' => $this->pagination->create_links_ajax(),
                'pages' => $pages,
                'cat_id' => $cat_id,
                'tree' => $this->lib_category->build(),
                'show_cat_list' => 'yes',
            );
        } else {
            $data = array('no_pages' => TRUE,
                'tree' => $this->lib_category->build(),
                'cat_id' => $cat_id,
                'show_cat_list' => 'yes',
            );
        }

        \CMSFactory\assetManager::create()
                ->setData($data)
                ->registerStyle('admin')
                ->registerScript('admin')
                ->renderAdmin("list");
    }

}