<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Categories extends BaseAdminController {

    private $temp_cats = array();
    protected $multi = false;
    protected $level = -1;
    protected $path = array();
    protected $pathIds = array();

    function __construct() {
        parent::__construct();

        $this->load->library('DX_Auth');
        admin_or_redirect();
        $this->load->library('lib_admin');
        $this->load->library('lib_category');
        $this->lib_admin->init_settings();
    }

    function index() {
        //code
        $this->cat_list();
    }

    // Display create category form
    function create_form($parent_id = NULL) {
        //cp_check_perm('category_create');

        $this->template->assign('tree', $this->lib_category->build());
        $this->template->assign('parent_id', $parent_id);
        $this->template->assign('include_cats', $this->sub_cats($this->lib_category->build()));

        /** Init Event. Pre Create Category */
        \CMSFactory\Events::create()->registerEvent('', 'BaseAdminCategory:preCreate');
        \CMSFactory\Events::runFactory();

        $this->template->show('create_cat', FALSE);
    }

    // Refresh categoies in sidebar
    function update_block() {
        $this->template->assign('tree', $this->lib_category->build());
        $this->template->show('cats_sidebar', FALSE);
    }

    public function save_positions() {
        $positions = $_POST['positions'];

        if (sizeof($positions) == 0) {
            return false;
        }

        if ($_POST['positions']) {
            foreach ($_POST['positions'] as $pos => $id) {
                $query = "UPDATE `category` SET `position`='" . $pos . "' WHERE `id`='" . (int) $id . "';";
                $this->db->query($query);
            }

            showMessage(lang("The position has been successfully saved", "admin"));
        }
    }

    function cat_list() {
        $cats = array();

        //$tree = $this->lib_category->build();
        $tree = $this->lib_category->_build();

        $cats = $this->sub_cats($tree);

        // Get total pages in category
        $cnt = count($cats);
        for ($i = 0; $i < $cnt; $i++) {
            $this->db->where('category', $cats[$i]['position']);
            $this->db->where('lang_alias', 0);
            $this->db->from('content');
            $cats[$i]['pages'] = $this->db->count_all_results();
        }

        $this->template->add_array(array(
            'tree' => $cats,
            'catTreeHTML' => $this->renderCatList($tree)
                //'catTreeHTML' => $this->renderCatList($cats)
        ));

        $this->template->show('category_list', FALSE);
    }

    private function renderCatList($tree) {
        $html = '';

        foreach ($tree as $item) {
            $html .= '<div>';
            $html .= $this->template->fetch('_catlistitem', array('item' => $item));
            if (count($item['subtree'])) {
                $html .= '<div class="frame_level sortable" style="display:none;">';
                $html .= $this->renderCatList($item['subtree']);
                $html .= '</div>';
            }
            $html .= '</div>';
        }
        return $html;
    }

    function sub_cats($array = array()) {
        foreach ($array as $item) {
            $this->temp_cats[] = $item;

            if (count($item['subtree']) > 0) {
                $this->sub_cats($item['subtree']);
            }
        }

        return $this->temp_cats;
    }

    /**
     * Validation for template name field
     * @param string $tpl
     */
    public function tpl_validation($tpl) {
        if (preg_match('/^[A-Za-z\_\.]{0,50}$/', $tpl)) {
            return TRUE;
        }
        $this->form_validation->set_message('tpl_validation', lang('The %s field can only contain Latin characters', 'admin'));
        return FALSE;
    }

    /*
     * Create or update new category
     *
     * @access public
     */

    function create($action, $cat_id = 0) {
        //cp_check_perm('category_create');

        $this->form_validation->set_rules('name', lang("Title", "admin"), 'trim|required|min_length[1]|max_length[160]');
        $this->form_validation->set_rules('url', lang("URL categories", "admin"), 'trim|min_length[2]|max_length[300]|alpha_dash');
        $this->form_validation->set_rules('image', lang("Image", "admin"), 'max_length[250]');
        $this->form_validation->set_rules('position', lang("Position", "admin"), 'required|integer|max_length[11]');
        $this->form_validation->set_rules('parent_id', lang("Parent", "admin"), 'trim|required|integer|max_length[160]');
        $this->form_validation->set_rules('description', lang("Description ", "admin"), 'trim');
        $this->form_validation->set_rules('keywords', lang("Keywords", "admin"), 'trim');
        $this->form_validation->set_rules('short_desc', lang("Short description", "admin"), 'trim');
        $this->form_validation->set_rules('title', lang("Title", "admin"), 'trim|max_length[250]');
        $this->form_validation->set_rules('tpl', lang("Template", "admin"), 'trim|max_length[50]');
        $this->form_validation->set_rules('page_tpl', lang("Page template", "admin"), 'trim|max_length[50]|callback_tpl_validation');
        $this->form_validation->set_rules('main_tpl', lang("Main template", "admin"), 'trim|max_length[50]|callback_tpl_validation');
        $this->form_validation->set_rules('per_page', lang("Per page", "admin"), 'required|trim|integer|max_length[9]|min_length[1]|is_natural_no_zero');

        $groupId = (int) $this->input->post('category_field_group');
        ($hook = get_hook('cfcm_set_rules')) ? eval($hook) : NULL;

        if ($this->form_validation->run($this) == FALSE) {
            ($hook = get_hook('admin_create_cat_val_failed')) ? eval($hook) : NULL;

            showMessage(validation_errors(), false, 'r');
        } else {
            // Create category URL
            if ($this->input->post('url') == FALSE) {
                $this->load->helper('translit');
                $url = translit_url($this->input->post('name'));
            } else {
                $url = $this->input->post('url');
            }

            $fetch_pages = $this->input->post('fetch_pages');

            if (count($fetch_pages) > 0) {
                $fetch_pages = serialize($fetch_pages);
            }
            $settings = array(
                'category_apply_for_subcats' => $this->input->post('category_apply_for_subcats'),
                'apply_for_subcats' => $this->input->post('apply_for_subcats'),
            );
            $data = array(
                'name' => $this->input->post('name'),
                'url' => $url,
                'image' => $this->lib_admin->db_post('image'),
                'position' => $this->input->post('position'),
                'short_desc' => $this->lib_admin->db_post('short_desc'),
                'parent_id' => $this->input->post('parent_id'),
                'description' => $this->lib_admin->db_post('description'),
                'keywords' => $this->lib_admin->db_post('keywords'),
                'title' => $this->lib_admin->db_post('title'),
                'tpl' => $this->lib_admin->db_post('tpl'),
                'main_tpl' => $this->lib_admin->db_post('main_tpl'),
                'page_tpl' => $this->lib_admin->db_post('page_tpl'),
                'per_page' => $this->lib_admin->db_post('per_page'),
                'order_by' => $this->lib_admin->db_post('order_by'),
                'sort_order' => $this->lib_admin->db_post('sort_order'),
                'comments_default' => $this->lib_admin->db_post('comments_default'),
                'fetch_pages' => $fetch_pages,
                'settings' => serialize($settings),
            );

            $parent = $this->lib_category->get_category($data['parent_id']);

            if ($parent != 'NULL') {
                $full_path = $parent['path_url'] . $data['url'] . '/';
            } else {
                $full_path = $data['url'] . '/';
            }

            if (($this->category_exists($full_path) == TRUE) AND ($action != 'update') AND ($data['url'] != 'core')) {
                $data['url'] .= time();
            }

            switch ($action) {
                case 'new':
                    ($hook = get_hook('admin_create_category')) ? eval($hook) : NULL;

                    $id = $this->cms_admin->create_category($data);

                    $this->lib_admin->log(
                            lang("Category has been created or created a category", "admin") . " " .
                            '<a href="' . $BASE_URL . '/admin/categories/edit/' . $id . '"> ' . $data['name'] . '</a>'
                    );

                    /** Init Event. Create new Category */
                    \CMSFactory\Events::create()->registerEvent(array_merge($data, array('userId' => $this->dx_auth->get_user_id())));

                    /** End init Event. Create new Page */
                    showMessage(lang("Category", "admin") . ' ' . $data['name'] . ' ' . lang("Created or has been created", "admin"));

                    $act = $_POST['action'];
                    if ($act == 'close') {
                        pjax('/admin/categories/cat_list');
                    } else {
                        pjax('/admin/categories/edit/' . $id);
                    }
                    //updateDiv('page', site_url('admin/categories/edit/' . $id));
                    break;

                case 'update':
                    ($hook = get_hook('admin_update_category')) ? eval($hook) : NULL;
                    $this->cms_admin->update_category($data, $cat_id);

                    $this->load->module('cfcm')->save_item_data($cat_id, 'category');

                    $this->cache->delete_all();

                    // Clear lib_category data
                    $this->lib_category->categories = array();
                    $this->lib_category->level = 0;
                    $this->lib_category->path = array();
                    $this->lib_category->unsorted_arr = FALSE;
                    $this->lib_category->unsorted = FALSE;

                    $this->lib_category->build();

                    $this->update_urls();

                    $this->lib_admin->log(
                            lang("Changed the category", "admin") . " " .
                            '<a href="' . $BASE_URL . '/admin/categories/edit/' . $cat_id . '"> ' . $data['name'] . '</a>'
                    );

                    /** Init Event. Create new Category */
                    \CMSFactory\Events::create()->registerEvent(array_merge($data, array('userId' => $this->dx_auth->get_user_id())), 'Categories:update');

                    $act = $_POST['action'];
                    if ($act == 'close')
                        pjax('/admin/categories/cat_list');
                    else
                        pjax('/admin/categories/edit/' . $cat_id);

                    break;
            }

            $this->cache->delete_all();

            //updateDiv('categories', site_url('/admin/categories/update_block')); // Update categories on workspace
        }
    }

    function update_urls() {
        $categories = $this->lib_category->unsorted();

        foreach ($categories as $category) {
            $this->db->where('category', $category['id']);
            $this->db->update('content', array('cat_url' => $category['path_url']));
        }
        $this->cache->delete_all();
    }

    function category_exists($str) {
        return $this->lib_category->get_category_by('path_url', $str);
    }

    function fast_add($action = '') {
        //cp_check_perm('category_create');

        ($hook = get_hook('admin_fast_cat_add')) ? eval($hook) : NULL;

        $this->template->add_array(array(
            'tree' => $this->lib_category->build(),
        ));

        if ($action == '') {
            $this->template->show('fast_cat_add', FALSE);
        }

        if ($action == 'create') {
            $this->form_validation->set_rules('name', lang("Title", "admin"), 'trim|required|min_length[1]|max_length[160]');
            $this->form_validation->set_rules('parent_id', lang("Parent", "admin"), 'trim|required|integer|max_length[160]');

            if ($this->form_validation->run($this) == FALSE) {
                showMessage(validation_errors(), false, 'r');
            } else {
                // Create category URL
                if ($this->input->post('url') == FALSE) {
                    $this->load->helper('translit');
                    $url = translit_url($this->input->post('name'));
                } else {
                    $url = $this->input->post('url');
                }

                $fetch_pages = '';

                $data = array(
                    'name' => $this->input->post('name'),
                    'url' => $url,
                    'position' => '0',
                    'short_desc' => '',
                    'parent_id' => $this->input->post('parent_id'),
                    'description' => '',
                    'keywords' => '',
                    'title' => '',
                    'tpl' => '',
                    'main_tpl' => '',
                    'page_tpl' => '',
                    'per_page' => 15,
                    'order_by' => 'publish_date',
                    'sort_order' => 'desc',
                    'comments_default' => '1',
                    'fetch_pages' => $fetch_pages,
                );

                $parent = $this->lib_category->get_category($data['parent_id']);

                if ($parent != 'NULL') {
                    $full_path = $parent['path_url'] . $data['url'] . '/';
                } else {
                    $full_path = $data['url'] . '/';
                }

                if (($this->category_exists($full_path) == TRUE) AND ($action != 'update') AND ($data['url'] != 'core')) {
                    $data['url'] .= time();
                }

                ($hook = get_hook('admin_fast_cat_insert')) ? eval($hook) : NULL;

                $id = $this->cms_admin->create_category($data);
                $this->cache->delete_all();

                $this->lib_admin->log(
                        lang("Category has been created or created a category", "admin") . " " .
                        '<a href="' . $BASE_URL . '/admin/categories/edit/' . id . '"> ' . $data['name'] . '</a>'
                );

                echo json_encode(array('data' => $id));
                //updateDiv('categories', site_url('/admin/categories/update_block'));
                //updateDiv('fast_category_list', site_url('/admin/categories/update_fast_block/' . $id));
                //closeWindow('fast_add_cat_w');
                //jsCode("$('comments_status').checked = true;");
            }
        }
    }

    function update_fast_block($sel_id) {
        $this->template->add_array(array(
            'tree' => $this->lib_category->build(),
            'sel_cat' => $sel_id,
        ));

        echo lang("Category", "admin") . ' <select name="category" ONCHANGE="change_comments_status();" id="category_selectbox">
                <option value="0">' . lang("No", "admin") . '</option>';

        $this->template->show('cats_select', FALSE);

        echo "</select>";
    }

    /**
     * Show edit category window
     *
     * @access public
     */
    function edit($id) {
        //cp_check_perm('category_edit');

        $cat = $this->cms_admin->get_category($id);

        /** Init Event. Pre Create Category */
        \CMSFactory\Events::create()->registerEvent(array('pageId' => $id), 'Categories:preUpdate');
        \CMSFactory\Events::runFactory();

        ($hook = get_hook('admin_edit_category')) ? eval($hook) : NULL;

        if ($cat !== FALSE) {
            // Get langs
            $langs = $this->cms_base->get_langs();
            $this->template->assign('langs', $langs);
            $settings = unserialize($cat['settings']);
            $cat['fetch_pages'] = unserialize($cat['fetch_pages']);
            $this->template->add_array($cat);
            $this->template->assign('tree', $this->lib_category->build());
            $this->template->assign('include_cats', $this->sub_cats($this->lib_category->build()));
            $this->template->assign('settings', $settings);
            ($hook = get_hook('admin_show_category_edit')) ? eval($hook) : NULL;

            $this->template->show('category_edit', FALSE);
        } else {
            return FALSE;
        }
    }

    function translate($id, $lang) {
        $cat = $this->cms_admin->get_category($id);

        ($hook = get_hook('admin_on_translate_cat')) ? eval($hook) : NULL;

        if (count($_POST) > 0) {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('name', lang("Title", "admin"), 'trim|required|min_length[1]|max_length[160]');
            $this->form_validation->set_rules('image', lang("Image", "admin"), 'max_length[250]');
            $this->form_validation->set_rules('description', lang("Description ", "admin"), 'trim');
            $this->form_validation->set_rules('keywords', lang("Keywords", "admin"), 'trim');
            $this->form_validation->set_rules('short_desc', lang("Short description", "admin"), 'trim');
            $this->form_validation->set_rules('title', lang("Meta title", "admin"), 'trim|max_length[250]');

            ($hook = get_hook('admin_set_cat_translate_rules')) ? eval($hook) : NULL;

            if ($this->form_validation->run($this) == FALSE) {
                showMessage(validation_errors(), '' . 'r');
            } else {
                $data = array();
                $data['alias'] = $id;
                $data['lang'] = $lang;
                $data['name'] = $this->input->post('name');
                $data['image'] = $_POST['image'];
                $data['description'] = $_POST['description'];
                $data['keywords'] = $_POST['keywords'];
                $data['short_desc'] = $_POST['short_desc'];
                $data['title'] = $_POST['title'];

                $this->db->where('alias', $id);
                $this->db->where('lang', $lang);
                $query = $this->db->get('category_translate');

                if ($query->num_rows() == 0) {
                    $this->lib_admin->log(
                            lang("Translated the category", "admin") . " " .
                            '<a href="' . $BASE_URL . '/admin/categories/edit/' . $cat['id'] . '"> ' . $cat['name'] . '</a>'
                    );

                    ($hook = get_hook('admin_insert_cat_translation')) ? eval($hook) : NULL;

                    $this->db->insert('category_translate', $data);
                } else {
                    $this->lib_admin->log(
                            lang("Changed the category translation", "admin") . " " .
                            '<a href="' . $BASE_URL . '/admin/categories/edit/' . $cat['id'] . '"> ' . $cat['name'] . '</a>'
                    );

                    ($hook = get_hook('admin_update_cat_translation')) ? eval($hook) : NULL;

                    $this->db->where('alias', $id);
                    $this->db->where('lang', $lang);
                    $this->db->update('category_translate', $data);
                }


                $this->cache->delete_all();
                showMessage(lang("Category translation updated", "admin"));

                $active = $_POST['action'];

                if ($active == 'close') {
                    pjax('/admin/categories/translate/' . $id . '/' . $lang);
                } else {
                    pjax('/admin/categories/edit/' . $id);
                }
            }

            exit;
        }

        if ($cat !== FALSE) {
            // Get translated category
            $this->db->where('alias', $id);
            $this->db->where('lang', $lang);
            $query = $this->db->get('category_translate');

            // Get langs
            $langs = $this->cms_base->get_langs();
            $this->template->assign('langs', $langs);

            if ($query->num_rows() > 0) {
                $this->template->add_array(array(
                    'cat' => $query->row_array(),
                ));
            }

            $this->template->add_array(array(
                'orig_cat' => $cat,
                'lang' => $lang,
            ));

            ($hook = get_hook('admin_show_cat_translate')) ? eval($hook) : NULL;

            $this->template->show('cat_translate', FALSE);
        } else {
            return FALSE;
        }
    }

    /**
     * Delete category and its pages
     *
     * @param integer $cat_id
     * @access public
     */
    function delete() {
        //cp_check_perm('category_delete');


        foreach ($_POST['ids'] as $p) {

            $cat_id = $p;
//if (0)
//{
            if ($this->db->get('category')->num_rows() == 1) {
                showMessage(lang("Category deletion error", "admin"), lang("Error", "admin"), 'r');
                exit;
            }

            ($hook = get_hook('admin_category_delete')) ? eval($hook) : NULL;

            // Delete Category
            $this->db->limit(1);
            $this->db->where('id', $cat_id);
            $this->db->delete('category');

            $this->lib_admin->log(lang("Deleted ID category or ID category has been deleted", "admin") . " " . $cat_id);

            // Delete translates
            $this->db->where('alias', $cat_id);
            $this->db->delete('category_translate');

            // Delete pages
            $this->db->where('category', $cat_id);
            $pages = $this->db->get('content');

            if ($pages->num_rows() > 0) {
                $this->load->module('admin/pages', 'pages');
                foreach ($pages->result_array() as $page) {
                    $this->pages->delete($page['id'], FALSE);
                }
            }

            // Delete sub cats
            $this->sub_cats = array();
            $this->categories = $this->db->get('category')->result_array();
            $this->_get_sub_cats($cat_id);

            if (count($this->sub_cats) > 0) {
                foreach ($this->sub_cats as $key => $cat_id) {

                    ($hook = get_hook('admin_sub_category_delete')) ? eval($hook) : NULL;

                    // Delete Category
                    $this->db->limit(1);
                    $this->db->where('id', $cat_id);
                    $this->db->delete('category');

                    $this->lib_admin->log(lang("Deleted ID category or ID category has been deleted", "admin") . " " . $cat_id);

                    // Delete translates
                    $this->db->where('alias', $cat_id);
                    $this->db->delete('category_translate');

                    // Delete pages
                    $this->db->where('category', $cat_id);
                    $pages = $this->db->get('content');

                    if ($pages->num_rows() > 0) {
                        $this->load->module('admin/pages', 'pages');
                        foreach ($pages->result_array() as $page) {
                            $this->pages->delete($page['id'], FALSE);
                        }
                    }
                }
            }
        }

        $CI = &get_instance();

        if ($CI->db->get_where('components', array('name' => 'sitemap'))->row())
            $CI->load->module('sitemap')->ping_google($this);


        $this->cache->delete_all();

        showMessage(lang("Category deleted", "admin"));

        return TRUE;
    }

    public function _get_sub_cats($id) {
        foreach ($this->categories as $cat) {
            if ($cat['parent_id'] == $id) {
                $this->sub_cats[] = $cat['id'];
                $this->_get_sub_cats($cat['id']);
            }
        }
    }

    function get_comments_status($id) {
        $this->db->select('comments_default');
        $this->db->where('id', $id);
        $query = $this->db->get('category')->row_array();

        echo json_encode($query);
    }

}

/* End of categories.php */
