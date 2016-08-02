<?php

use CMSFactory\assetManager;

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Image CMS
 * @param lib_category Lib_category
 * @param menu Menu
 */
class Admin extends BaseAdminController
{

    /**
     *
     * @var array
     */
    private $root_menu = [];

    /**
     *
     * @var array
     */
    private $sub_menu = [];

    /**
     *
     * @var array
     */
    private $sub_menus = [];

    /**
     *
     * @var integer
     */
    private $padding = 0;

    /**
     *
     * @var array
     */
    private $menu_result = [];

    /**
     *
     * @var array
     */
    private $for_delete = [];

    /**
     *
     * @var string
     */
    private $default_lang_id;

    /**
     * Admin constructor.
     */
    public function __construct() {

        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('menu');

        // Only admin access
        $this->load->library('DX_Auth');

        $this->cache->delete_all();
        $this->load->library('Form_validation');
        $this->load->library('lib_admin');
        $this->load->module('menu');
        $this->load->model('menu_model');

        $this->template->assign('langs', $this->_get_langs());

        $this->menu->select_hidden = TRUE; //select hidden items
        $this->default_lang_id = $this->load->module('core')->def_lang[0]['id'];
    }

    public function index() {

        $root_menus = $this->db->get('menus')->result_array();
        assetManager::create()
            ->setData('menus', $root_menus)
            ->renderAdmin('menu_list');
    }

    public function chose_hidden() {

        $status = $this->input->post('status') === 'false' ? 0 : 1;
        $id = $this->input->post('id');
        $this->db->query("update menus_data set hidden = '$status' where id = '$id'");
        $this->lib_admin->log(lang('Status menus item was changed', 'menu') . '. Id: ' . $id);
    }

    /**
     * List all menu items
     *
     * @param string $name
     */
    public function menu_item($name = '') {

        $this->menu->prepare_menu_array($name);
        $this->root_menu = &$this->menu->menu_array;
        $this->sub_menu = &$this->menu->sub_menu_array;

        $this->process_root($this->root_menu);
        $ins_id = $this->db->get_where('menus', ['name' => $name])->row_array();

        $this->template->assign('menu_result', $this->menu_result);
        $this->template->assign('insert_id', $ins_id['id']);
        $this->template->assign('menu_title', $ins_id['main_title']);
        $this->template->assign('tree', $this->_printRecursiveMenuItems($this->root_menu));

        $this->display_tpl('main');
    }

    public function list_menu_items($menu_id = 0) {

        if ($menu_id > 0) {
            $this->menu_item($this->get_name_by_id($menu_id));
        }
    }

    /**
     * Display create_item.tpl
     * @param null|int $id
     */
    public function create_item($id = null) {

        if (!$this->input->post()) {
            $parents = $this->db
                ->where('menu_id', $id)
                ->select('menus_data.*, menu_translate.title')
                ->join('menu_translate', 'menus_data.id = menu_translate.item_id')
                ->where('lang_id', $this->default_lang_id)
                ->get('menus_data')->result_array();

            $menu = $this->db->where('id', $id)->get('menus')->row_array();
            $cats = $this->lib_category->build();
            $pages = $this->get_pages(0, 0, 'controller');
            //$query = $this->db->get('shop_rbac_roles');
            $locale = MY_Controller::getCurrentLocale();
            $this->db->select('shop_rbac_roles.*', FALSE);
            $this->db->select('shop_rbac_roles_i18n.alt_name', FALSE);
            $this->db->where('locale', $locale);
            $this->db->join('shop_rbac_roles_i18n', 'shop_rbac_roles_i18n.id = shop_rbac_roles.id');
            $role = $this->db->get('shop_rbac_roles')->result_array();

            $this->template->assign('roles', $role);
            $this->template->assign('modules', $this->_load_module_list());
            $this->template->assign('cats', $cats);
            $this->template->assign('menu', $menu);
            $this->template->assign('parents', $parents);
            $this->template->assign('pages', $pages);
            $this->template->assign('insert_id', $id);
            $this->display_tpl('create_item');
        } else {
            $this->form_validation->set_rules('menu_id', 'Menu Id', 'required');
            $this->form_validation->set_rules('item_type', 'Item Type', 'required');
            $this->form_validation->set_rules('title', lang('Title', 'menu'), 'required');
            if ($this->input->post('item_type') == 'page') {
                //$this->form_validation->set_rules('title', 'Заголовок', 'required');
                $this->form_validation->set_rules('item_id', lang('Page ID', 'menu'), 'required');
            }
            if ($this->input->post('item_type') == 'category') {
                $this->form_validation->set_rules('item_id', lang('category ID', 'menu'), 'required');
            }
            if ($this->input->post('item_type') == 'module') {
                $this->form_validation->set_rules('mod_name', lang('Module name', 'menu'), 'required');
                //$this->form_validation->set_rules('mod_method', 'Метод модуля', 'required');
                $this->form_validation->set_rules('item_id', lang('Module ID', 'menu'), 'required');
            }
            if ($this->input->post('item_type') == 'url') {
                $this->form_validation->set_rules('item_url', 'URL', 'required');
            }

            if ($this->form_validation->run($this) == FALSE) {
                showMessage(validation_errors(), '', 'r');
            } else {

                if ($this->input->post('page_hidden')) {
                    $hidden = $this->input->post('page_hidden');
                } elseif ($this->input->post('cat_hidden')) {
                    $hidden = $this->input->post('cat_hidden');
                } elseif ($this->input->post('module_hidden')) {
                    $hidden = $this->input->post('module_hidden');
                } elseif ($this->input->post('url_hidden')) {
                    $hidden = $this->input->post('url_hidden');
                }

                if ($this->input->post('page_item_image')) {
                    $image = $this->input->post('page_item_image');
                } elseif ($this->input->post('cat_item_image')) {
                    $image = $this->input->post('cat_item_image');
                } elseif ($this->input->post('module_item_image')) {
                    $image = $this->input->post('module_item_image');
                } elseif ($this->input->post('url_item_image')) {
                    $image = $this->input->post('url_item_image');
                } else {
                    $image = '';
                }

                if ($this->input->post('page_newpage')) {
                    $newpage = $this->input->post('page_newpage');
                } elseif ($this->input->post('cat_newpage')) {
                    $newpage = $this->input->post('cat_newpage');
                } elseif ($this->input->post('module_newpage')) {
                    $newpage = $this->input->post('module_newpage');
                } elseif ($this->input->post('url_newpage')) {
                    $newpage = $this->input->post('url_newpage');
                }

                //preparing roles
                $roles = $this->input->post('item_roles');
                if ($roles == NULL) {
                    $roles = '';
                } else {
                    $roles = serialize($this->input->post('item_roles'));
                }

                //preparing main data
                $item_data = [
                              'menu_id'    => $this->input->post('menu_id'),
                              'item_id'    => $this->input->post('item_id'),
                              'item_type'  => $this->input->post('item_type'),
                              'title'      => htmlentities($this->input->post('title'), ENT_QUOTES, 'UTF-8'),
                              'hidden'     => (int) $hidden,
                              'item_image' => $image,
                              'roles'      => $roles,
                              'parent_id'  => $this->input->post('parent_id'),
                             ];

                //                $item_data['position'] = $all_menu_items_count + 1;
                $last_item_position = $this->db->where('menu_id', $this->input->post('menu_id'))
                    ->where('parent_id', $this->input->post('parent_id'))
                    ->select_max('position')
                    ->get('menus_data')->result_array();
                $newItemPosition = $last_item_position[0]['position'] + 1;
                $item_data['position'] = $newItemPosition;

                if (!isset($item_data['add_data'])) {
                    if ($this->input->post('item_type') == 'module') {
                        $data['mod_name'] = $this->input->post('mod_name');
                        $data['method'] = $this->input->post('mod_method');
                    }
                    if ($this->input->post('item_type') == 'url') {
                        $data['url'] = $this->input->post('item_url');
                    }
                    $data['newpage'] = (int) $newpage;
                    $item_data['add_data'] = serialize($data);
                }
                // Error: wrong parent id
                if ($this->input->post('item_type') != 'module' AND $this->input->post('item_type') != 'url') {
                    if ($this->input->post('item_id') == $this->input->post('parent_id')) {
                        $error = TRUE;
                    }
                }

                if ($error == TRUE) {
                    showMessage(lang('Error', 'menu'));
                    //return FALSE;
                } else {
                    $this->db->insert('menus_data', $item_data);
                    $lastId = $this->db->insert_id();
                    $translate = [
                                  'item_id' => $lastId,
                                  'title'   => $item_data['title'],
                                  'lang_id' => $this->default_lang_id,
                                 ];
                    $this->db->insert('menu_translate', $translate);
                    $this->lib_admin->log(lang('The menu item was successfully created', 'menu') . '. Id: ' . $lastId);
                    showMessage(lang('The menu item was successfully created', 'menu'));
                    $row = $this->db->where('id', $this->input->post('menu_id'))->get('menus')->row_array();
                    if ($this->input->post('action') == 'tomain') {
                        pjax('/admin/components/cp/menu/menu_item/' . $row['name']);
                    } else {
                        pjax('/admin/components/cp/menu/edit_item/' . $lastId . '/' . $row['name']);
                    }
                }
            }
        }
    }

    /**
     * Display template to select/edit menu item
     * @param int $id
     * @param string $type
     */
    public function display_selector($id, $type = 'page') {

        $this->template->assign('insert_id', $id);

        $this->menu->prepare_menu_array($this->get_name_by_id($id));
        $this->root_menu = &$this->menu->menu_array;
        $this->sub_menu = &$this->menu->sub_menu_array;
        $this->process_root($this->root_menu);
        $this->template->assign('menu_result', $this->menu_result);

        $item = $this->menu_model->get_item($id);
        $parents = $this->db->where('menu_id', $item['menu_id'])->get('menus_data')->result_array();
        $this->template->assign('parents', $parents);
        $this->template->add_array($item);

        // roles
        $query = $this->db->get('roles');
        $this->template->assign('roles', $query->result_array());
        // roles

        $this->load->library('lib_category');

        $this->template->assign('tree', $this->lib_category->build());
        if ($type != 'category') {
            $this->template->assign('cats', $this->fetch_tpl('cats'));
        }

        $this->template->assign('action', 'insert');
        $this->template->assign('update_id', '0');

        switch ($type) {
            case 'page':
                $this->display_tpl('pages_selector');
                break;

            case 'category':
                $this->template->assign('cats_list', $this->fetch_tpl('cats_list'));
                $this->display_tpl('category_selector');
                break;

            case 'module':
                $this->template->assign('modules', $this->_load_module_list());
                $this->display_tpl('module_selector');
                break;

            case 'url':
                $this->display_tpl('url_selector');
                break;
        }
    }

    /**
     * Load all modules info
     *
     * @access private
     * @return array
     */
    private function _load_module_list() {

        $this->load->module('admin/components');

        $modules = $this->db->get('components')->result_array();
        $id = $this->uri->segment(6);
        $id = (int) $id;
        $cnt = count($modules);
        for ($i = 0; $i < $cnt; $i++) {
            $info = $this->components->get_module_info($modules[$i]['name']);
            if ($info) {
                $modules[$i]['menu_name'] = $info['menu_name'];
                $modules[$i]['description'] = $info['description'];
                $modules[$i]['url_image'] = $this->db->where('id', $id)
                    ->where('title', $info['menu_name'])
                    ->select('item_image')
                    ->get('menus_data')
                    ->row()
                    ->item_image;
            } else {
                unset($modules[$i]);
            }
        }

        unset($info);

        return $modules;
    }

    /**
     * Get menu name by ID
     *
     * @param $id integer
     * @access public
     * @return array
     */
    public function get_name_by_id($id) {

        $query = $this->db->get_where('menus', ['id' => $id])->row_array();
        return $query['name'];
    }

    /**
     * Delete menu item and its sub items
     *
     * @access public
     * @return bool
     */
    public function delete_item($id = null) {

        if ($this->input->post('ids')) {
            $id = $this->input->post('ids');
            foreach ($id as $i) {
                $this->db->where('id', $i);
                $this->db->limit(1);
                $this->db->delete('menus_data');

                $this->_get_delete_items($i);

                foreach ($this->for_delete as $item_id) {
                    $this->menu_model->delete_menu_item($item_id);
                }
            }
            $this->lib_admin->log(lang('Menu item successfuly deleted', 'menu') . '. Ids ' . implode(', ', $id));
            showMessage(lang('Menu item successfuly deleted', 'menu'), '');
        } else {
            if ($id > 0) {
                $this->db->where('id', $id);
                $this->db->limit(1);
                $this->db->delete('menus_data');

                $this->_get_delete_items($id);

                foreach ($this->for_delete as $item_id) {
                    $this->menu_model->delete_menu_item($item_id);
                }

                $this->lib_admin->log(lang('Menu item successfuly deleted', 'menu') . '. Id ' . $id);
                showMessage(lang('Menu item successfuly deleted', 'menu'), '');
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }

    /**
     * Find sub items for delete
     *
     * @param $id integer - item id
     * @access private
     * @return array
     */
    private function _get_delete_items($id) {

        $items = $this->menu_model->get_parent_items($id);

        if ($items != FALSE) {
            foreach ($items as $item) {
                $this->for_delete[] = $item['id'];
                $this->_get_delete_items($item['id']);
            }
        }
    }

    /**
     * Find all subitems and push in $this->sub_menus array
     *
     * @param $id integer - item id
     * @access private
     */
    private function _get_sub_items($id) {

        $items = $this->menu_model->get_parent_items($id);

        if ($items != FALSE) {
            foreach ($items as $item) {
                $this->sub_menus[] = $item['id'];
                $this->_get_sub_items($item['id']);
            }
        }
    }

    /**
     * ajax
     */
    public function loadPathImg() {

        $pathUrl = $this->db->like('add_data', $this->input->post('title'))->where('item_type', 'module')->get('menus_data')->row()->item_image;
        if ($pathUrl) {
            echo $pathUrl;
        }
    }

    /**
     * Display edit item window
     * @param int $item_id
     */
    public function edit_item($item_id) {

        if (!$this->input->post()) {
            $item = $this->db
                ->where('menus_data.id', $item_id)
                ->select(['menus_data.*', 'menu_translate.title'])
                ->join('menu_translate', 'menus_data.id = menu_translate.item_id', 'left')
                ->where('lang_id', $this->default_lang_id)
                ->get('menus_data')->row_array();

            if (empty($item)) {
                $item = $this->db
                    ->where('menus_data.id', $item_id)
                    ->get('menus_data')->row_array();
            }

            $parents = $this->db
                ->select('menus_data.*, menu_translate.title')
                ->where('menu_id', $item['menu_id'])
                ->where('menus_data.id <>', $item['id'])
                ->join('menu_translate', 'menus_data.id = menu_translate.item_id')
                ->where('lang_id', $this->default_lang_id)
                ->get('menus_data')->result_array();
            $menu = $this->db->where('id', $item['menu_id'])->get('menus')->row_array();

            $category_id = ($item['item_type'] === 'page') ? getPageCategoryId($item['item_id']) : 0;

            $cats = $this->lib_category->build();
            $pages = $this->get_pages($category_id, 0, 'controller');
            $locale = MY_Controller::getCurrentLocale();
            $this->db->select('shop_rbac_roles.*', FALSE);
            $this->db->select('shop_rbac_roles_i18n.alt_name', FALSE);
            $this->db->where('locale', $locale);
            $this->db->join('shop_rbac_roles_i18n', 'shop_rbac_roles_i18n.id = shop_rbac_roles.id');
            $role = $this->db->get('shop_rbac_roles')->result_array();

            //$query = $this->db->get('shop_rbac_roles');
            $this->template->assign('roles', $role);
            $this->template->assign('selected_category_id', $category_id);
            $this->template->assign('modules', $this->_load_module_list());
            $this->template->assign('cats', $cats);
            $this->template->assign('menu', $menu);
            $this->template->assign('parents', $parents);
            $this->template->assign('item', $item);
            $this->template->assign('pages', $pages);
            $this->display_tpl('edit_item');
        } else {
            if ($this->input->post('page_item_type')) {
                $item_type = $this->input->post('page_item_type');
            } elseif ($this->input->post('cat_item_type')) {
                $item_type = $this->input->post('cat_item_type');
            } elseif ($this->input->post('module_item_type')) {
                $item_type = $this->input->post('module_item_type');
            } elseif ($this->input->post('url_item_type')) {
                $item_type = $this->input->post('url_item_type');
            }

            $this->form_validation->set_rules('menu_id', 'Menu Id', 'required');
            //            $this->form_validation->set_rules('item_type', 'Item Type', 'required');
            $this->form_validation->set_rules('title', lang('Title', 'menu'), 'required');
            if ($item_type == 'page') {
                $this->form_validation->set_rules('page_item_type', 'Item Type', 'required');
                $this->form_validation->set_rules('title', lang('Title', 'menu'), 'required');
                $this->form_validation->set_rules('item_id', lang('Page ID', 'menu'), 'required');
            }
            if ($item_type == 'category') {
                $this->form_validation->set_rules('cat_item_type', 'Item Type', 'required');
                $this->form_validation->set_rules('item_id', lang('Category ID', 'menu'), 'required');
            }
            if ($item_type == 'module') {
                $this->form_validation->set_rules('module_item_type', 'Item Type', 'required');
                $this->form_validation->set_rules('mod_name', lang('Module name', 'menu'), 'required');
                //$this->form_validation->set_rules('mod_method', 'Метод модуля', 'required');
                $this->form_validation->set_rules('item_id', lang('Page ID', 'menu'), 'required');
            }
            if ($item_type == 'url') {
                $this->form_validation->set_rules('url_item_type', 'Item Type', 'required');
                $this->form_validation->set_rules('item_url', 'URL', 'required');
            }

            if ($this->form_validation->run($this) == FALSE) {
                showMessage(validation_errors(), '', 'r');
            } else {

                if ($this->input->post('page_hidden')) {
                    $hidden = $this->input->post('page_hidden');
                } elseif ($this->input->post('cat_hidden')) {
                    $hidden = $this->input->post('cat_hidden');
                } elseif ($this->input->post('module_hidden')) {
                    $hidden = $this->input->post('module_hidden');
                } elseif ($this->input->post('url_hidden')) {
                    $hidden = $this->input->post('url_hidden');
                }
                if ($this->input->post('page_item_image')) {
                    $image = $this->input->post('page_item_image');
                } elseif ($this->input->post('cat_item_image')) {
                    $image = $this->input->post('cat_item_image');
                } elseif ($this->input->post('module_item_image')) {
                    $image = $this->input->post('module_item_image');
                } elseif ($this->input->post('url_item_image')) {
                    $image = $this->input->post('url_item_image');
                }
                if ($this->input->post('page_parent_id')) {
                    $parent_id = $this->input->post('page_parent_id');
                } elseif ($this->input->post('cat_parent_id')) {
                    $parent_id = $this->input->post('cat_parent_id');
                } elseif ($this->input->post('module_parent_id')) {
                    $parent_id = $this->input->post('module_parent_id');
                } elseif ($this->input->post('url_parent_id')) {
                    $parent_id = $this->input->post('url_parent_id');
                }
                if ($this->input->post('page_newpage')) {
                    $newpage = $this->input->post('page_newpage');
                } elseif ($this->input->post('cat_newpage')) {
                    $newpage = $this->input->post('cat_newpage');
                } elseif ($this->input->post('module_newpage')) {
                    $newpage = $this->input->post('module_newpage');
                } elseif ($this->input->post('url_newpage')) {
                    $newpage = $this->input->post('url_newpage');
                }

                $roles = $this->input->post('item_roles');
                if ($roles == NULL) {
                    $roles = '';
                } else {
                    $roles = serialize($this->input->post('item_roles'));
                }

                $item_data = [
                              'menu_id'    => $this->input->post('menu_id'),
                              'item_id'    => $this->input->post('item_id'),
                              'item_type'  => $item_type,
                              'title'      => htmlentities($this->input->post('title'), ENT_QUOTES, 'UTF-8'),
                              'hidden'     => (int) $hidden,
                              'item_image' => $image,
                              'roles'      => $roles,
                              'parent_id'  => (int) $parent_id,
                             ];

                if ($item_data['item_type'] == 'module') {
                    $data['mod_name'] = $this->input->post('mod_name');
                    $data['method'] = $this->input->post('mod_method');
                    $data['newpage'] = (int) $newpage;
                }

                if ($item_data['item_type'] == 'url') {
                    $item_data['item_id'] = 0;
                    $item_data['add_data'] = serialize(['url' => $this->input->post('item_url'), 'newpage' => (int) $newpage]);
                }
                if ($item_data['item_type'] == 'page') {
                    $item_data['add_data'] = serialize(['page' => $this->input->post('item_url'), 'newpage' => (int) $newpage]);
                }
                if (!isset($item_data['add_data'])) {
                    $item_data['add_data'] = serialize($data);
                }
                $errorMessage = Null;
                // Error: wrong parent id
                if ($this->input->post('item_id') != 0 && $parent_id != 0) {
                    if ($this->input->post('item_id') == $parent_id) {
                        $error = TRUE;
                        $errorMessage = 1;
                    }
                }

                // Error: don't place root menu in sub
                if ($parent_id != 0) {
                    $this->_get_sub_items($item_id);
                    foreach ($this->sub_menus as $v) {
                        if ($v == $parent_id) {
                            $error = TRUE;
                            $errorMessage = 2;
                        }
                    }
                }

                if ($error == TRUE) {
                    if ($errorMessage == 1) {
                        showMessage(lang('Invalid parent identifier', 'menu'), '', 'r');
                    }
                    if ($errorMessage == 2) {
                        showMessage(lang('Can not be root menu in subparagraph', 'menu'), '', 'r');
                    }
                    exit();
                } else {

                    $item_data_translated = ['title' => $item_data['title']];
                    $this->db->where('item_id', $item_id);
                    $this->db->where('lang_id', $this->default_lang_id);
                    $this->db->update('menu_translate', $item_data_translated);

                    $this->db->where('id', $item_id);
                    $this->db->update('menus_data', $item_data);
                    $this->lib_admin->log(lang('Menu item was edited', 'menu') . '. Id ' . $item_id);
                    showMessage(lang('Changes successfully saved', 'menu'));
                    $row = $this->db->where('id', $this->input->post('menu_id'))->get('menus')->row_array();
                    if ($this->input->post('action') == 'tomain') {
                        pjax('/admin/components/cp/menu/menu_item/' . $row['name']);
                    }
                }
            }
        }
    }

    /**
     * @param array $items
     * @return string
     */
    private function _printRecursiveMenuItems($items) {

        $html = '';
        foreach ($items as $item) {
            $item['hasKids'] = false;
            if ($submenus = $this->menu->_get_sub_menus($item['id'])) {
                $item['hasKids'] = true;
            }

            $html .= '<div>';

            $this->template->assign('item', $item);
            $html .= $this->fetch_tpl('_menulistitem');
            if ($item['hasKids']) {
                $html .= '<div class="frame_level sortable ui-sortable">';
                $html .= $this->_printRecursiveMenuItems($submenus);
                $html .= '</div>';
            }

            $html .= '</div>';
        }

        return $html;
    }

    /**
     * @param array $array
     */
    public function process_root($array) {

        foreach ($array as $item) {
            $sub_menus = $this->menu->_get_sub_menus($item['id']);

            $item['padding'] = $this->padding;
            $item['url'] = $item['link'];
            $item['link'] = site_url($item['link']);

            array_push($this->menu_result, $item);

            if ($sub_menus != NULL) {
                $this->padding += 1;
                $this->process_root($sub_menus);
            }
        }
        --$this->padding;
    }

    /**
     * Insert link into menu
     * Set positions
     */
    public function insert_menu_item() {

        $roles = $this->input->post('roles');
        if ($roles == NULL) {
            $roles = '';
        } else {
            $roles = serialize($this->input->post('roles'));
        }

        // Item position
        if ($this->input->post('position_after') > 0) {
            $after_pos = $this->menu_model->get_item_position($this->input->post('position_after'));
            $after_pos = $after_pos['position'];

            if ($after_pos != FALSE) {
                $position = $after_pos + 1;

                $sql = "UPDATE `menus_data`
                            SET `position`=`position` + 1
                            WHERE `position` > '$after_pos'
                            AND `menu_id`='" . $this->input->post('menu_id') . "'
                            AND `parent_id`='" . $this->input->post('parent_id') . "'
                            ";
                $this->db->query($sql);
            }
        }

        if ($this->input->post('position_after') == 0) {
            $this->db->select_max('position');
            $this->db->where('menu_id', $this->input->post('menu_id'));
            $this->db->where('parent_id', $this->input->post('parent_id'));
            $query = $this->db->get('menus_data')->row_array();

            if ($query['position'] == NULL) {
                $position = 1;
            } else {
                $position = $query['position'] + 1;
            }
        }

        if ($this->input->post('position_after') == 'first') {
            $this->db->select_min('position');
            $this->db->where('menu_id', $this->input->post('menu_id'));
            $this->db->where('parent_id', $this->input->post('parent_id'));
            $query = $this->db->get('menus_data')->row_array();

            if ($query['position'] == NULL) {
                $position = 1;
            } else {
                $position = $query['position'] - 1;
            }
        }

        $item_data = [
                      'menu_id'    => $this->input->post('menu_id'),
                      'item_id'    => $this->input->post('item_id'),
                      'item_type'  => $this->input->post('item_type'),
                      'title'      => htmlentities($this->input->post('title'), ENT_QUOTES, 'UTF-8'),
                      'hidden'     => $this->input->post('hidden'),
                      'item_image' => $this->input->post('item_image'),
                      'roles'      => $roles,
                      'parent_id'  => $this->input->post('parent_id'),
                      'position'   => $position,
                     ];

        if ($item_data['item_type'] == 'module') {
            $mod_info = [
                         'mod_name' => $this->input->post('item_id'),
                         'method'   => trim($this->input->post('method')),
                         'newpage'  => $this->input->post('newpage'),
                        ];

            $item_data['item_id'] = 0;
            $item_data['add_data'] = serialize($mod_info);
        }

        if ($item_data['item_type'] == 'url') {
            $item_data['item_id'] = 0;
            $item_data['add_data'] = serialize(['url' => $this->input->post('url'), 'newpage' => $this->input->post('newpage')]);
        }

        if (!isset($item_data['add_data'])) {
            $item_data['add_data'] = serialize(['newpage' => $this->input->post('newpage')]);
        }

        if ($this->input->post('update_id') == 0) {
            // Insert new item
            $this->menu_model->insert_item($item_data);
        } else {
            // Update item
            $error = FALSE;

            // Error: wrong parent id
            if ($this->input->post('update_id') == $this->input->post('parent_id')) {
                $error = TRUE;
            }

            // Error: don't place root menu in sub
            $item = $this->menu_model->get_item($this->input->post('update_id'));
            if ($item['parent_id'] == 0) {
                $this->_get_sub_items($this->input->post('update_id'));

                foreach ($this->sub_menus as $v) {
                    if ($v == $this->input->post('parent_id')) {
                        $error = TRUE;
                    }
                }
            }

            if ($this->input->post('position_after') == 0) {
                unset($item_data['position']);
            }

            if ($error == TRUE) {
                return FALSE;
            } else {
                $this->db->where('id', $this->input->post('update_id'));
                $this->db->update('menus_data', $item_data);
            }
        }
    }

    public function save_positions() {

        //cp_check_perm('menu_edit');

        foreach ($this->input->post('positions') as $k => $v) {
            $k = $k + 1;
            $this->menu_model->set_item_position((int) $v, (int) $k);
        }
        showMessage(lang('Positions updated', 'menu'));
    }

    /**
     * Create new menu
     *
     * @access public
     */
    public function create_menu() {

        //cp_check_perm('menu_create');
        if ($this->input->post('menu_name') == NULL) {
            showMessage(lang('Name field sieve', 'menu'), '', 'r');

            exit;
        }
        $this->check_menu_data();

        $val = $this->form_validation;
        $val->set_rules('menu_name', lang('Name', 'menu'), 'required|min_length[2]|max_length[25]|alpha_dash');
        $val->set_rules('main_title', lang('Name', 'menu'), 'required|max_length[100]');
        //        $val->set_rules('menu_tpl', lang("Template folder", 'menu'), 'required|max_length[255]');
        $val->set_rules('menu_desc', lang('Description', 'menu'), 'max_length[500]');
        $val->set_rules('menu_expand_level', lang('Nesting level', 'menu'), 'numeric|max_length[2]');

        if ($this->form_validation->run($this) == FALSE) {
            showMessage(validation_errors(), '', 'r');
        } else {
            $data = [
                     'name'         => $this->input->post('menu_name'),
                     'main_title'   => $this->input->post('main_title'),
                     'description'  => $this->input->post('menu_desc'),
                     'tpl'          => $this->input->post('menu_tpl'),
                     'expand_level' => $this->input->post('menu_expand_level'),
                     'created'      => date('Y-m-d H:i:s'),
                    ];

            $menu_id = $this->menu_model->insert_menu($data);

            $this->lib_admin->log(lang('Menu was created', 'menu') . '. Id: ' . $menu_id);
            showMessage(lang('Menu created', 'menu'));
            if ($this->input->post('action') == 'tomain') {
                pjax('/admin/components/cp/menu');
            } else {
                pjax('/admin/components/cp/menu/edit_menu/' . $menu_id);
            }
        }
    }

    /**
     * @param int $id
     */
    public function edit_menu($id) {

        //cp_check_perm('menu_edit');
        $menu_data = $this->menu_model->get_menu($id);
        $this->template->add_array($menu_data);
        $this->display_tpl('edit_menu');
    }

    /**
     * @param int $id
     */
    public function update_menu($id) {

        $val = $this->form_validation;
        $val->set_rules('menu_name', lang('Name', 'menu'), 'required|min_length[2]|max_length[25]|alpha_dash');
        $val->set_rules('main_title', lang('Title', 'menu'), 'required|max_length[100]');
        $val->set_rules('menu_desc', lang('Description', 'menu'), 'max_length[500]');
        $val->set_rules('menu_expand_level', lang('Nesting level', 'menu'), 'numeric|max_length[2]');

        if ($this->form_validation->run($this) == FALSE) {
            showMessage(validation_errors(), '', 'r');
        } else {

            $data = [
                     'name'         => $this->input->post('menu_name'),
                     'main_title'   => $this->input->post('main_title'),
                     'description'  => $this->input->post('menu_desc'),
                     'tpl'          => $this->input->post('menu_tpl'),
                     'expand_level' => $this->input->post('menu_expand_level'),
                     'created'      => date('Y-m-d H:i:s'),
                    ];

            $this->db->where('id', $id);
            $this->db->update('menus', $data);
            $this->lib_admin->log(lang('Menu was edited', 'menu') . '. Id: ' . $id);
            showMessage(lang('Changes saved', 'menu'));
            if ($this->input->post('action') == 'tomain') {
                pjax('/admin/components/cp/menu');
            }
        }
    }

    public function check_menu_data() {

        if ($this->input->post('menu_name') == NULL) {
            showMessage(lang('The field is required to be filled in'), false, 'r');
            exit;
        }

        if ($this->db->get_where('menus', ['name' => $this->input->post('menu_name')])->num_rows() > 0) {
            showMessage(lang('The menu with the same name has been created yet'), false, 'r');
            exit;
        }
    }

    /**
     * @param null|string $name
     */
    public function delete_menu($name = null) {

        if ($name == null) {
            $name = $this->input->post('ids');
            foreach ($name as $n) {
                $this->menu->prepare_menu_array($n);
                $this->root_menu = &$this->menu->menu_array;
                $this->sub_menu = &$this->menu->sub_menu_array;
                $this->process_root($this->root_menu);
                //root menus array
                foreach ($this->root_menu as $menu) {
                    $this->menu_model->delete_menu_item($menu['id']);
                }
                //sub menus array
                foreach ($this->sub_menu as $menu) {
                    $this->menu_model->delete_menu_item($menu['id']);
                }
                //delete main menu
                $this->menu_model->delete_menu($n);
            }
            $this->lib_admin->log(lang('Menu removed', 'menu'));
            showMessage(lang('Menu removed', 'menu'));
            pjax('/admin/components/cp/menu');
        } else {
            $this->menu->prepare_menu_array($name);
            $this->root_menu = &$this->menu->menu_array;
            $this->sub_menu = &$this->menu->sub_menu_array;
            $this->process_root($this->root_menu);
            //root menus array
            foreach ($this->root_menu as $menu) {
                $this->menu_model->delete_menu_item($menu['id']);
            }
            //sub menus array
            foreach ($this->sub_menu as $menu) {
                $this->menu_model->delete_menu_item($menu['id']);
            }
            //delete main menu
            $this->menu_model->delete_menu($name);
            $this->lib_admin->log(lang('Menu removed', 'menu') . '. Id: ' . $menu['id']);
            showMessage(lang('Menu removed', 'menu'));
            pjax('/admin/components/cp/menu');
        }
    }

    public function create_tpl() {

        assetManager::create()->renderAdmin('create_menu');
    }

    /**
     * Get pages and return in JSON
     * @param int $cat_id
     * @param int $cur_page
     * @param null $referer
     */
    public function get_pages($cat_id = 0, $cur_page = 0, $referer = null) {

        $data['nav_count'] = [];
        $data['links'] = 0;
        $per_page = 10;
        if ($this->input->post('per_page')) {
            $per_page = (int) $this->input->post('per_page');
        }
        //$per_page = (int) $this->input->post('per_page');
        $this->db->select('id, title, url, cat_url');
        $this->db->order_by('created', 'desc');
        $this->db->where('lang', $this->load->module('core')->def_lang[0]['id']);
        //        $this->db->where('lang_alias', 0);
        $this->db->where('category', $cat_id);

        if ($cur_page == 0) {
            $pages = $this->db->get('content', $per_page);
        } else {
            $pages = $this->db->get('content', $per_page, $per_page * $cur_page);
        }

        if ($pages->num_rows() > 0) {
            $pages = $pages->result_array();
            $data['pages_list'] = $pages;
            $total = $this->db->get_where('content', ['lang' => $this->default_lang_id, 'category' => $cat_id])->num_rows();

            $data['links'] = ceil($total / $per_page);
            if ($data['links'] == 1) {
                $data['links'] = 0;
            }

            if ($this->input->server('HTTP_X_REQUESTED_WITH') == 'XMLHttpRequest') {
                if ($referer == 'controller') {
                    return $data;
                }
                echo json_encode($data);
            } else {
                return $data;
            }
        }
    }

    /**
     * Search pages
     * @param int $cur_page
     */
    public function search_pages($cur_page = 0) {

        $data['nav_count'] = [];
        $data['links'] = 0;

        $per_page = (int) $this->input->post('per_page');

        $this->db->select('id, title, url, cat_url, category');
        $this->db->order_by('created', 'desc');
        //        $this->db->where('lang_alias', 0);
        $this->db->where('lang', $this->default_lang_id);
        $this->db->like('title', $this->input->post('search'));

        if ($cur_page == 0) {
            $pages = $this->db->get('content', $per_page);
        } else {
            $pages = $this->db->get('content', $per_page, $per_page * $cur_page);
        }

        if ($pages->num_rows() > 0) {
            $pages = $pages->result_array();

            // Insert category names
            $this->load->library('lib_category');
            $cnt = count($pages);
            for ($i = 0; $i < $cnt; $i++) {

                $cat = $this->lib_category->get_category($pages[$i]['category']);

                $name = '';

                if ($cat['parent_id'] != 0) {
                    foreach ($cat['path'] as $path) {
                        $c = $this->lib_category->get_category_by('url', $path);
                        $name .= $c['name'] . ' &rarr; ';
                    }
                } else {
                    $name = $cat['name'] . ' &rarr; ';
                }

                if ($pages[$i]['category'] == 0) {
                    $pages[$i]['cat_name'] = lang('Without category', 'menu') . ' &rarr; ';
                } else {
                    $pages[$i]['cat_name'] = $name;
                }
            }

            $data['pages_list'] = $pages;

            $this->db->select('id');
            $this->db->where('lang', $this->default_lang_id);
            //            $this->db->where('lang_alias', 0);
            $this->db->like('title', $this->input->post('search'));
            $total = $this->db->get('content')->num_rows();

            $data['links'] = ceil($total / $per_page);

            if ($data['links'] == 1) {
                $data['links'] = 0;
            }

            echo json_encode($data);
        }
    }

    /**
     * Ajax function
     * Load item data and return it in Json
     */
    public function get_item() {

        $item_id = (int) $this->input->post('item_id');

        $this->db->where('id', $item_id);
        $query = $this->db->get('menus_data');

        if ($query->num_rows() > 0) {
            $data = $query->row_array();

            if (!empty($data['add_data'])) {
                $data['add_data'] = unserialize($data['add_data']);
            }

            $data['roles'] = unserialize($data['roles']);

            if ($this->input->server('HTTP_X_REQUESTED_WITH') == 'XMLHttpRequest') {
                echo json_encode($data);
            } else {
                return $data;
            }
        }
    }

    /**
     *
     * @param string $file
     */
    public function display_tpl($file) {

        $file = realpath(__DIR__) . '/templates/' . $file;
        $this->template->show('file:' . $file);
    }

    public function fetch_tpl($file) {

        $file = realpath(__DIR__) . '/templates/' . $file . '.tpl';
        return $this->template->fetch('file:' . $file);
    }

    /**
     * @param int $id
     */
    public function translate_window($id) {

        $langs = $this->_get_langs();

        $n = 0;
        foreach ($langs as $l) {
            $t = $this->db->get_where('menu_translate', ['item_id' => $id, 'lang_id' => $l['id']]);

            if ($t->num_rows() == 1) {
                $t = $t->row_array();
                $langs[$n]['curt'] = $t['title'];
            }

            $n++;
        }

        $menu_id = $this->db->where('id', $id)->get('menus_data')->row()->menu_id;
        $menu_url = $this->db->where('id', $menu_id)->get('menus')->row()->name;

        assetManager::create()
            ->setData('langs', $langs)
            ->setData('id', $id)
            ->setData('menu_name', $menu_url)
            ->renderAdmin('translate_item');
    }

    /**
     * @param int $id
     */
    public function translate_item($id) {

        $langs = $this->_get_langs();

        $this->db->where('item_id', $id);
        $this->db->delete('menu_translate');

        foreach ($langs as $lang) {
            $postLang = trim($this->input->post("lang_{$lang['id']}"));

            if (isset($postLang)) {
                $data = [
                         'item_id' => (int) $id,
                         'lang_id' => $lang['id'],
                         'title'   => $postLang,
                        ];
                $this->db->insert('menu_translate', $data);
            }
        }
        showMessage(lang('Changes saved', 'menu'));
    }

    /**
     *
     * @return array
     */
    public function _get_langs() {

        $query = $this->db->get('languages');

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return [];
        }
    }

    public function change_hidden() {

        $id = $this->input->post('id');
        $hidden = $this->db->where('id', $id)->get('menus_data')->row();
        $hidden = $hidden->hidden;
        if ($hidden == 1) {
            $hidden = 0;
        } else {
            $hidden = 1;
        }
        $data = ['hidden' => $hidden];
        $this->menu_model->update_item($id, $data);
    }

    /**
     * @param int $parent_id
     * @param int $menu_id
     */
    public function get_children_items($parent_id, $menu_id) {

        $result = $this->db->select('id, title')->where('parent_id', $parent_id)->where('menu_id', $menu_id)->get('menus_data')->result_array();
        $html .= "<option value='0'> " . lang('No', 'menu') . ' </option>';
        $html .= "<option value='first'> " . lang('First', 'menu') . ' </option>';
        if (count($result) > 0) {
            foreach ($result as $item) {
                $html .= "<option value='" . $item['id'] . "'> - " . $item['title'] . '</option>';
            }
        }
        echo $html;
    }

}

/* End of file admin.php */