<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS 
 * Sample Module Admin
 * @property Documentation_model $documentation_model
 */
class Admin extends BaseAdminController {

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('documentation');
        $this->load->model('documentation_model');
        $this->load->library('pagination');
    }

    public function index() {
        $this->byCategory();
    }

    public function history($pageId) {
        $per_page = 12;

        $pageNum = $this->uri->segment(7) == FALSE ? 0 : $this->uri->segment(7);

        $pageData = $this->documentation_model->getPageById($pageId);
        $pageHistory = $this->documentation_model->getPageHistory($pageId, $per_page, $pageNum);

        $total_pages = $this->documentation_model->getPageHistoryCount(array('page_id' => $pageId));

        $paginationConfig = array(
            'base_url' => site_url('admin/components/cp/documentation/history/' . $pageId . '/'),
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
            'first_tag_open' => '<li>',
            'first_tag_close' => '</li>',
            'last_tag_open' => '<li>',
            'last_tag_close' => '</li>'
        );

        $this->pagination->num_links = 5;
        $this->pagination->initialize($paginationConfig);
        // End pagination

        $paginator = $this->pagination->create_links_ajax();

        \CMSFactory\assetManager::create()
                ->setData(array(
                    'page' => $pageData,
                    'history' => $pageHistory,
                    'paginator' => $paginator,
                ))
                ->registerStyle('admin')
                ->registerScript('dmp')
                ->registerScript('admin')
                ->renderAdmin('history');
    }

    /**
     * Включає відображення статтей всіх підкатегорій в категоріях 
     */
    public function include_all_subcategories() {
        $categories = $this->documentation_model->getCategories();

        $innerCategories = array();
        // Отримання структури
        foreach ($categories as $id => $parentId) {
            foreach ($categories as $id_ => $parentId_) {
                if ($id == $parentId_) {
                    $innerCategories[$id][] = $id_;
                }
            }
        }
        // включення під-під... категорій
        do {
            $wasChanges = FALSE;
            foreach ($innerCategories as $parentId => $childs) {
                foreach ($childs as $id) {
                    if (key_exists($id, $innerCategories)) {
                        if (!in_array($innerCategories[$id][0], $childs)) {
                            $wasChanges = TRUE;
                            $innerCategories[$parentId] = array_merge($innerCategories[$parentId], $innerCategories[$id]);
                        }
                    }
                }
            }
        } while ($wasChanges == TRUE);

        // серіалізація всіх категорій
        $innerCatsSerialized = array();
        foreach ($innerCategories as $parentId => $allInners) {
            $innerCatsSerialized[$parentId] = serialize($allInners);
        }

        echo '<h3>Categories map</h3>';
        echo '<pre>';
        print_r($innerCategories);
        echo '</pre>';

        // зміна значень в БД
        $this->documentation_model->includeAllInnerCategories($innerCatsSerialized);
    }

    public function settings($action = NULL) {
        $settings = $this->documentation_model->getSettings();

        $roles = $this->documentation_model->getRoles();
        foreach ($roles as $key => $role) {
            if (in_array($role['id'], $settings)) {
                $roles[$key]['edit'] = '1';
            } else {
                $roles[$key]['edit'] = '0';
            }
        }
        \CMSFactory\assetManager::create()
                ->registerScript('admin')
                ->setData('roles', $roles)
                ->renderAdmin('settings');
    }

    public function saveSettings() {
        if ($_POST['action'] == 'save') {
            $this->documentation_model->setSettings($_POST['ids']);
        }
        showMessage(lang("Saved", 'documentation'));
    }

    public function makeRelevant($pageId, $historyId) {
        $this->documentation_model->restoreArticleFromHistory($pageId, $historyId);
    }

    public function deleteHistoryRow($historyId) {
        $this->documentation_model->deleteHistoryRow($historyId);
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

        $offset = $this->uri->segment(7) == FALSE ? 0 : $this->uri->segment(7);

        $per_page = 12;

        $result = $this->db
                ->limit($per_page, $offset)
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
                'num_tag_close' => '</li>',
                'first_tag_open' => '<li>',
                'first_tag_close' => '</li>',
                'last_tag_open' => '<li>',
                'last_tag_close' => '</li>',
            );


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
                'categories' => $this->documentation_model->getFirstLevelCategories(),
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

    public function ajaxUpdateMenuCategory() {
        $id = $this->input->post('id');
        $newValue = $this->input->post('newValue');
        if ($id != null) {
            $data = array(
                'menu_cat' => $newValue
            );

            $this->documentation_model->updateMenuCategory($data, $id);
            echo 'true';
            return;
        }
        echo 'false';
    }

}
