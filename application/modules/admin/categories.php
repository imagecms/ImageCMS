<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Categories extends BaseAdminController {

    private $temp_cats = array();

    protected $multi = false;

    protected $level = -1;

    protected $path = array();

    protected $pathIds = array();

    public function __construct() {
        parent::__construct();

        $this->load->library('DX_Auth');
        admin_or_redirect();
        $this->load->library('lib_admin');
        $this->load->library('lib_category');
        $this->lib_admin->init_settings();
    }

    public function index() {
        //code
        $this->cat_list();
    }

    // Display create category form

    public function create_form($parent_id = NULL) {
        //cp_check_perm('category_create');

        $this->template->assign('tree', $this->lib_category->build());
        $this->template->assign('parent_id', $parent_id);
        $this->template->assign('include_cats', $this->sub_cats($this->lib_category->build()));
        $this->template->assign('template_files', $this->getTemplateFiles());

        /** Init Event. Pre Create Category */
        \CMSFactory\Events::create()->registerEvent('', 'BaseAdminCategory:preCreate');
        \CMSFactory\Events::runFactory();

        $this->template->show('create_cat', FALSE);
    }

    // Refresh categoies in sidebar

    public function update_block() {
        $this->template->assign('tree', $this->lib_category->build());
        $this->template->show('cats_sidebar', FALSE);
    }

    public function save_positions() {
        $positions = $this->input->post('positions');

        if (count($positions) == 0) {
            return false;
        }

        if ($this->input->post('positions')) {
            foreach ($this->input->post('positions') as $pos => $id) {
                $this->db->where('id', (int) $id);
                $this->db->set('position', $pos);
                $this->db->update('category');
            }

            showMessage(lang("The position has been successfully saved", "admin"));
        }
    }

    public function cat_list() {

        //set config lang for translating
        $this->config->set_item('cur_lang', $this->load->module('core')->def_lang[0]['id']);

        $tree = $this->lib_category->_build();

        $this->template->add_array(
            array(
                    'tree' => $tree,
                    'catTreeHTML' => $this->renderCatList($tree)
                )
        );

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

    public function sub_cats($array = array()) {
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
        if (preg_match('/^[0-9A-Za-z\_\.]{0,50}$/', $tpl)) {
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

    public function create($action, $cat_id = 0) {
        //cp_check_perm('category_create');

        $this->form_validation->set_rules('name', lang("Title", "admin"), 'trim|required|min_length[1]|max_length[160]|xss_clean');
        $this->form_validation->set_rules('url', lang("URL categories", "admin"), 'trim|min_length[1]|max_length[300]|alpha_dash');
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
        if ($cat_id) {
            $cat = $this->cms_admin->get_category($cat_id);
            $groupId = (int) $cat['category_field_group'];
            $groupId_POST = (int) $this->input->post('category_field_group');

            if ($groupId != -1 && $groupId_POST != -1) {
                ($hook = get_hook('cfcm_set_rules')) ? eval($hook) : NULL;
            }
        }
        if ($this->form_validation->run($this) == FALSE) {
            ($hook = get_hook('admin_create_cat_val_failed')) ? eval($hook) : NULL;

            showMessage(validation_errors(), false, 'r');
        } else {
            $url = $this->formUrl();

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
                'updated' => time()
            );

            $parent = $this->lib_category->get_category($data['parent_id']);

            if ($parent != 'NULL') {
                $full_path = $parent['path_url'] . $data['url'] . '/';
            } else {
                $full_path = $data['url'] . '/';
            }

            if (($this->category_exists($full_path) == TRUE) AND ( $action != 'update') AND ( $data['url'] != 'core')) {
                $data['url'] .= time();
            }

            switch ($action) {
                case 'new':

                    $pages_with_category_url = $this->db->where('url', $data['url'])->get('content');
                    if ($pages_with_category_url->num_rows()) {
                        $data['url'] .= time();
                    }

                    $data['created'] = time();
                    ($hook = get_hook('admin_create_category')) ? eval($hook) : NULL;

                    $id = $this->cms_admin->create_category($data);

                    $this->lib_admin->log(
                        lang("Category has been created", "admin") . " " .
                        '<a href="' . $BASE_URL . '/admin/categories/edit/' . $id . '"> ' . $data['name'] . '</a>'
                    );

                    /** Init Event. Create new Category */
                    \CMSFactory\Events::create()->registerEvent(array_merge($data, array('userId' => $this->dx_auth->get_user_id())));

                    /** End init Event. Create new Page */
                    showMessage(lang("Pages category created", "admin"));

                    $act = $this->input->post('action');
                    if ($act == 'close') {
                        pjax('/admin/categories/cat_list');
                    } else {
                        pjax('/admin/categories/edit/' . $id);
                    }
                    //updateDiv('page', site_url('admin/categories/edit/' . $id));
                    break;

                case 'update':

                    /** Init Event. Pre Create Category */
                    \CMSFactory\Events::create()->registerEvent(array('pageId' => $cat_id, 'url' => $cat['url']), 'Categories:preUpdate');
                    \CMSFactory\Events::runFactory();

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

                    showMessage(lang('Changes saved', 'admin'));
                    $act = $this->input->post('action');
                    if ($act == 'close') {
                        pjax('/admin/categories/cat_list');
                    } else {
                        pjax('/admin/categories/edit/' . $cat_id);
                    }

                    break;
            }

            $this->cache->delete_all();

            //updateDiv('categories', site_url('/admin/categories/update_block')); // Update categories on workspace
        }
    }

    /**
     * Form url from POST
     * @return string
     */
    private function formUrl() {
        // Create category URL
        if ($this->input->post('url') == FALSE) {
            $this->load->helper('translit');
            $url = translit_url($this->input->post('name'));
        } else {
            $url = $this->input->post('url');
        }
        $url = mb_strlen($url) === 1 ? str_repeat($url, 2) : $url;

        return $url;
    }

    public function update_urls() {
        $categories = $this->lib_category->unsorted();

        foreach ($categories as $category) {
            $this->db->where('category', $category['id']);
            $this->db->update('content', array('cat_url' => $category['path_url']));
        }
        $this->cache->delete_all();
    }

    public function category_exists($str) {
        return $this->lib_category->get_category_by('path_url', $str);
    }

    public function fast_add($action = '') {
        //cp_check_perm('category_create');

        ($hook = get_hook('admin_fast_cat_add')) ? eval($hook) : NULL;

        $this->template->add_array(
            array(
                    'tree' => $this->lib_category->build(),
                )
        );

        if ($action == '') {
            $this->template->show('fast_cat_add', FALSE);
        }

        if ($action == 'create') {
            $this->form_validation->set_rules('name', lang("Title", "admin"), 'trim|required|min_length[1]|max_length[160]');
            $this->form_validation->set_rules('parent_id', lang("Parent", "admin"), 'trim|required|integer|max_length[160]');

            if ($this->form_validation->run($this) == FALSE) {
                showMessage(validation_errors(), false, 'r');
            } else {
                $url = $this->formUrl();
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

                if (($this->category_exists($full_path) == TRUE) AND ( $action != 'update') AND ( $data['url'] != 'core')) {
                    $data['url'] .= time();
                }

                ($hook = get_hook('admin_fast_cat_insert')) ? eval($hook) : NULL;

                $id = $this->cms_admin->create_category($data);
                $this->cache->delete_all();

                $this->lib_admin->log(
                    lang("Category has been created or created a category", "admin") . " " .
                    '<a href="' . $BASE_URL . '/admin/categories/edit/' . id . '"> ' . $data['name'] . '</a>'
                );

                $this->template->add_array(
                    array(
                            'tree' => $this->lib_category->build(),
                            'sel_cat' => $id,
                        )
                );

                echo lang("Category", "admin") . ' <select name="category" ONCHANGE="change_comments_status();" id="category_selectbox">
                <option value="0">' . lang("No", "admin") . '</option>';

                $this->template->show('cats_select', FALSE);

                echo "</select>";
            }
        }
    }

    public function update_fast_block($sel_id) {
        $this->template->add_array(
            array(
                    'tree' => $this->lib_category->build(),
                    'sel_cat' => $sel_id,
                )
        );

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
    public function edit($id) {
        //cp_check_perm('category_edit');

        $cat = $this->cms_admin->get_category($id);

        /** Init Event. Pre Create Category */
        \CMSFactory\Events::create()->registerEvent(array('pageId' => $id, 'url' => $cat['url']), 'Categories:preUpdate');
        \CMSFactory\Events::runFactory();

        ($hook = get_hook('admin_edit_category')) ? eval($hook) : NULL;

        if ($cat !== FALSE) {
            // Get langs
            $langs = $this->cms_base->get_langs();
            $this->template->assign('langs', $langs);
            $settings = unserialize($cat['settings']);
            $cat['fetch_pages'] = unserialize($cat['fetch_pages']);
            $this->template->add_array($cat);

            $categories = $this->lib_category->build();

            $this->template->assign('tree', $categories);
            $this->template->assign('template_files', $this->getTemplateFiles());
            $this->template->assign('include_cats', $this->sub_cats($this->lib_category->build()));
            $this->template->assign('settings', $settings);
            ($hook = get_hook('admin_show_category_edit')) ? eval($hook) : NULL;

            $this->template->show('category_edit', FALSE);
        } else {
            return FALSE;
        }
    }

    /**
     * Return template files names for main, page or category template
     * @return array
     */
    public function getTemplateFiles() {
        $currentTemplate = \template_manager\classes\TemplateManager::getInstance()->getCurentTemplate()->name;
        $pathToFind = TEMPLATES_PATH . $currentTemplate;

        $files = [];
        foreach (new DirectoryIterator($pathToFind) as $entity) {
            if ($entity->isFile() & !$entity->isDot() & $entity->getExtension() == 'tpl') {
                $files[] = array_shift(explode('.', $entity->getFilename()));
            }
        }
        return $files;
    }

    public function create_tpl() {
        $file = trim($this->input->post('filename'));

        $this->form_validation->set_rules('filename', lang('Template name', 'admin'), 'required|alpha_numeric|min_length[1]|max_length[250]');

        if ($this->form_validation->run() == FALSE) {
            $responce = showMessage(validation_errors(), '', 'r', true);
            $result = false;
            echo json_encode(array('responce' => $responce, 'result' => $result));
            return FALSE;
        }

        $currentTemplate = \template_manager\classes\TemplateManager::getInstance()->getCurentTemplate()->name;
        $file = TEMPLATES_PATH . $currentTemplate . '/' . $file . '.tpl';

        if (!file_exists($file)) {
            $fp = fopen($file, "w");
            if ($fp) {
                $responce = showMessage(lang('The file has been successfully created', 'admin'), '', '', true);
                $result = true;
            } else {
                $responce = showMessage(lang('Could not create file', 'admin'), '', 'r', true);
                $result = false;
            }
            fwrite($fp, "/* new ImageCMS Tpl file */");
            fclose($fp);
            echo json_encode(array('responce' => $responce, 'result' => $result));
        } else {
            $responce = showMessage(lang('File with the same name is already exist.'), '', 'r', true);
            $result = false;
            echo json_encode(array('responce' => $responce, 'result' => $result));
            return FALSE;
        }
    }

    public function translate($id, $lang) {
        $cat = $this->cms_admin->get_category($id);

        ($hook = get_hook('admin_on_translate_cat')) ? eval($hook) : NULL;

        if ($this->input->post()) {
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
                $data['image'] = $this->input->post('image');
                $data['description'] = $this->input->post('description');
                $data['keywords'] = $this->input->post('keywords');
                $data['short_desc'] = $this->input->post('short_desc');
                $data['title'] = $this->input->post('title');

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

                $active = $this->input->post('action');

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
                $this->template->add_array(
                    array(
                            'cat' => $query->row_array(),
                        )
                );
            }

            $this->template->add_array(
                array(
                        'orig_cat' => $cat,
                        'lang' => $lang,
                    )
            );

            ($hook = get_hook('admin_show_cat_translate')) ? eval($hook) : NULL;

            $this->template->show('cat_translate_edit', FALSE);
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
    public function delete() {
        //cp_check_perm('category_delete');

        foreach ($this->input->post('ids') as $p) {

            $cat_id = $p;
            //if (0)
            //{
            if ($this->db->get('category')->num_rows() == 1) {
                showMessage(lang("You can not delete the last category from the list", "admin"), lang("Error", "admin"), 'r');
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

        if ($CI->db->get_where('components', array('name' => 'sitemap'))->row()) {
            $CI->load->module('sitemap')->ping_google($this);
        }

        $this->cache->delete_all();

        if (count($this->input->post('ids')) > 1) {
            showMessage(lang("Pages categories deleted", "admin"));
        } else {
            showMessage(lang("Pages category deleted", "admin"));
        }

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

    public function get_comments_status($id) {
        $this->db->select('comments_default');
        $this->db->where('id', $id);
        $query = $this->db->get('category')->row_array();

        echo json_encode($query);
    }

}

/* End of categories.php */