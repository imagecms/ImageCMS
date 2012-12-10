<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Image CMS
 */
class Admin extends MY_Controller {

    private $root_menu = array();
    private $sub_menu = array();
    private $sub_menus = array();
    private $padding = 0;
    private $menu_result = array();
    private $for_delete = array();

    function __construct() {
        parent::__construct();

        // Only admin access
        $this->load->library('DX_Auth');

        $this->cache->delete_group('menus');
        $this->load->library('Form_validation');
        $this->load->library('lib_admin');
        $this->load->module('menu');
        $this->load->model('menu_model');

        $this->template->assign('langs', $this->_get_langs());

        $this->menu->select_hidden = TRUE; //select hidden items
    }

    function index() {
        $root_menus = $this->db->get('menus')->result_array();
        $this->render('menu_list', array('menus' => $root_menus), true);
    }

    /**
     * List all menu items
     */
    function menu_item($name = '') {
        $this->menu->prepare_menu_array($name);
        $this->root_menu = & $this->menu->menu_array;
        $this->sub_menu = & $this->menu->sub_menu_array;

        $this->process_root($this->root_menu);

        $ins_id = $this->db->get_where('menus', array('name' => $name))->row_array();

        $this->template->assign('menu_result', $this->menu_result);
        $this->template->assign('insert_id', $ins_id['id']);
        $this->template->assign('menu_title', $ins_id['main_title']);
//        if ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')
//            $this->fetch_tpl('main');
//        else

        $this->template->assign('tree', $this->_printRecursiveMenuItems($this->root_menu));

        $this->display_tpl('main');
    }

    function list_menu_items($menu_id = 0) {
        if ($menu_id > 0) {
            $this->menu_item($this->get_name_by_id($menu_id));
        }
    }

    /**
     * Display create_item.tpl
     */
    function create_item($id = null) {
        if (empty($_POST)) {
            $parents = $this->db->where('menu_id', $id)->get('menus_data')->result_array();
            $menu = $this->db->where('id', $id)->get('menus')->row_array();
            $cats = $this->lib_category->build();
            $pages = $this->get_pages(0, 0, 'controller');
            $query = $this->db->get('roles');
            $this->template->assign('roles', $query->result_array());
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
            $this->form_validation->set_rules('title', 'Заголовок', 'required');
            if ($_POST['item_type'] == 'page') {
                //$this->form_validation->set_rules('title', 'Заголовок', 'required');
                $this->form_validation->set_rules('item_id', 'ID страницы', 'required');
            }
            if ($_POST['item_type'] == 'category') {
                $this->form_validation->set_rules('item_id', 'ID категории', 'required');
            }
            if ($_POST['item_type'] == 'module') {
                $this->form_validation->set_rules('mod_name', 'Название модуля', 'required');
                //$this->form_validation->set_rules('mod_method', 'Метод модуля', 'required');
                $this->form_validation->set_rules('item_id', 'ID модуля', 'required');
            }
            if ($_POST['item_type'] == 'url') {
                $this->form_validation->set_rules('item_url', 'URL', 'required');
            }

            if ($this->form_validation->run($this) == FALSE) {
                showMessage(validation_errors(), '', 'r');
            } else {
                //preparing roles
                $roles = $_POST['item_roles'];
                if ($roles == NULL) {
                    $roles = '';
                } else {
                    $roles = serialize($_POST['item_roles']);
                }
                //preparing main data
                $item_data = array(
                    'menu_id' => $_POST['menu_id'],
                    'item_id' => $_POST['item_id'],
                    'item_type' => $_POST['item_type'],
                    'title' => htmlentities($_POST['title'], ENT_QUOTES, 'UTF-8'),
                    'hidden' => $_POST['hidden'],
                    'item_image' => $_POST['item_image'],
                    'roles' => $roles,
                    'parent_id' => $_POST['parent_id'],
                );

                //For position after
                switch ($_POST['position_after']) {
                    case 'first':
                        $item_data['position'] = 1;
                        $this->db->query('UPDATE `menus_data` SET `position`=`position`+1 WHERE `menu_id` = ' . $this->input->post('menu_id') . ' AND `parent_id`=' . $this->input->post('parent_id'));
                        break;
                    case '0':
                        $all_menu_items_count = count($this->db->where('menu_id', $_POST['menu_id'])->where('parent_id', $this->input->post('parent_id'))->get('menus_data')->result());
                        $item_data['position'] = $all_menu_items_count + 1;
                        break;
                    default :
                        $pos = $this->db->where('id', $_POST['position_after'])->get('menus_data')->row_array();
                        $pos = $pos['position'];
                        $item_data['position'] = $pos + 1;
                        $this->db->query('UPDATE `menus_data` SET `position`=`position`+1 WHERE `menu_id` = ' . $this->input->post('menu_id') . ' AND `position` > ' . $pos . ' AND `parent_id`=' . $this->input->post('parent_id'));
                }

                if (!isset($item_data['add_data'])) {
                    if ($_POST['item_type'] == 'module') {
                        $data['mod_name'] = $_POST['mod_name'];
                        $data['method'] = $_POST['mod_method'];
                    }
                    if ($_POST['item_type'] == 'url') {
                        $data['url'] = $_POST['item_url'];
                    }
                    $data['newpage'] = $_POST['newpage'];
                    $item_data['add_data'] = serialize($data);
                }
                // Error: wrong parent id
                if ($_POST['item_type'] != 'module' AND $_POST['item_type'] != 'url') {
                    if ($_POST['item_id'] == $_POST['parent_id']) {
                        $error = TRUE;
                    }
                }

                if ($error == TRUE) {
                    showMessage('Ошибка');
                    //return FALSE;
                } else {
                    $this->db->insert('menus_data', $item_data);
                    $lastId = $this->db->insert_id();
                    showMessage('Пункт меню успешно создан');
                    $row = $this->db->where('id', $_POST['menu_id'])->get('menus')->row_array();
                    if ($_POST['action'] == 'tomain') {
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
     */
    function display_selector($id, $type = 'page') {
        $this->template->assign('insert_id', $id);

        $this->menu->prepare_menu_array($this->get_name_by_id($id));
        $this->root_menu = & $this->menu->menu_array;
        $this->sub_menu = & $this->menu->sub_menu_array;
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

    /*
     * Load all modules info
     *
     * @access private
     * @return array
     */

    private function _load_module_list() {
        $this->load->module('admin/components');

        $modules = $this->db->get('components')->result_array();

        $cnt = count($modules);
        for ($i = 0; $i < $cnt; $i++) {
            $info = $this->components->get_module_info($modules[$i]['name']);

            $modules[$i]['menu_name'] = $info['menu_name'];
            $modules[$i]['description'] = $info['description'];
        }

        unset($info);

        return $modules;
    }

    /**
     * Get menu name by ID
     *
     * @param $id integer
     * @access public
     * @return arra
     */
    function get_name_by_id($id) {
        $query = $this->db->get_where('menus', array('id' => $id))->row_array();
        return $query['name'];
    }

    /**
     * Delete menu item and its sub items
     *
     * @access public
     * @return bool
     */
    function delete_item($id = null) {
        cp_check_perm('menu_edit');
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
        } else {
            if ($id > 0) {
                $this->db->where('id', $id);
                $this->db->limit(1);
                $this->db->delete('menus_data');

                $this->_get_delete_items($id);

                foreach ($this->for_delete as $item_id) {
                    $this->menu_model->delete_menu_item($item_id);
                }

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
     * Display edit item window
     */
    function edit_item($item_id) {
        cp_check_perm('menu_edit');
        if (empty($_POST)) {
            $item = $this->db->where('id', $item_id)->get('menus_data')->row_array();
            $parents = $this->db->where('menu_id', $item['menu_id'])->get('menus_data')->result_array();
            $menu = $this->db->where('id', $item['menu_id'])->get('menus')->row_array();
            $cats = $this->lib_category->build();
            $pages = $this->get_pages(0, 0, 'controller');
            $query = $this->db->get('roles');
            $this->template->assign('roles', $query->result_array());
            $this->template->assign('modules', $this->_load_module_list());
            $this->template->assign('cats', $cats);
            $this->template->assign('menu', $menu);
            $this->template->assign('parents', $parents);
            $this->template->assign('item', $item);
            $this->template->assign('pages', $pages);
            $this->display_tpl('edit_item');
        } else {
            $this->form_validation->set_rules('menu_id', 'Menu Id', 'required');
            $this->form_validation->set_rules('item_type', 'Item Type', 'required');
            $this->form_validation->set_rules('title', 'Заголовок', 'required');
            if ($_POST['item_type'] == 'page') {
                $this->form_validation->set_rules('title', 'Заголовок', 'required');
                $this->form_validation->set_rules('item_id', 'ID страницы', 'required');
            }
            if ($_POST['item_type'] == 'category') {
                $this->form_validation->set_rules('item_id', 'ID категории', 'required');
            }
            if ($_POST['item_type'] == 'module') {
                $this->form_validation->set_rules('mod_name', 'Название модуля', 'required');
                //$this->form_validation->set_rules('mod_method', 'Метод модуля', 'required');
                $this->form_validation->set_rules('item_id', 'ID страницы', 'required');
            }
            if ($_POST['item_type'] == 'url') {
                $this->form_validation->set_rules('item_url', 'URL', 'required');
            }

            if ($this->form_validation->run($this) == FALSE) {
                showMessage(validation_errors(), '', 'r');
            } else {
                $roles = $_POST['item_roles'];
                if ($roles == NULL) {
                    $roles = '';
                } else {
                    $roles = serialize($_POST['item_roles']);
                }
                // Item position
                if ($_POST['position_after'] > 0) {
                    $after_pos = $this->menu_model->get_item_position($_POST['position_after']);
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
                if ($_POST['position_after'] == 0) {
                    $this->db->select_max('position');
                    $this->db->where('menu_id', $_POST['menu_id']);
                    $this->db->where('parent_id', $_POST['parent_id']);
                    $query = $this->db->get('menus_data')->row_array();

                    if ($query['position'] == NULL) {
                        $position = 1;
                    } else {
                        $position = $query['position'] + 1;
                    }
                }
                if ($_POST['position_after'] == 'first') {
                    $this->db->select_min('position');
                    $this->db->where('menu_id', $_POST['menu_id']);
                    $this->db->where('parent_id', $_POST['parent_id']);
                    $query = $this->db->get('menus_data')->row_array();
                    if ($query['position'] == NULL) {
                        $position = 1;
                    } else {
                        $position = $query['position'] - 1;
                    }
                }
                $item_data = array(
                    'menu_id' => $_POST['menu_id'],
                    'item_id' => $_POST['item_id'],
                    'item_type' => $_POST['item_type'],
                    'title' => htmlentities($_POST['title'], ENT_QUOTES, 'UTF-8'),
                    'hidden' => $_POST['hidden'],
                    'item_image' => $_POST['item_image'],
                    'roles' => $roles,
                    'parent_id' => $_POST['parent_id'],
                    'position' => $position
                );

                if ($item_data['item_type'] == 'module') {
                    $data['mod_name'] = $_POST['mod_name'];
                    $data['method'] = $_POST['mod_method'];
                    $data['newpage'] = $_POST['newpage'];
                }

                if ($item_data['item_type'] == 'url') {
                    $item_data['item_id'] = 0;
                    $item_data['add_data'] = serialize(array('url' => $_POST['item_url'], 'newpage' => $_POST['newpage']));
                }
                if ($item_data['item_type'] == 'page') {
                    $item_data['add_data'] = serialize(array('page' => $_POST['item_url'], 'newpage' => $_POST['newpage']));
                }
                if (!isset($item_data['add_data']))
                    $item_data['add_data'] = serialize($data);

                // Error: wrong parent id
                if ($_POST['item_id'] != 0 && $_POST['parent_id'] != 0)
                    if ($_POST['item_id'] == $_POST['parent_id']) {
                        $error = TRUE;
                    }

                // Error: don't place root menu in sub
                $item = $this->menu_model->get_item($_POST['item_id']);
                if ($item['parent_id'] == 0) {
                    $this->_get_sub_items($_POST['item_id']);

                    foreach ($this->sub_menus as $k => $v) {
                        if ($v == $_POST['parent_id']) {
                            $error = TRUE;
                        }
                    }
                }

                if ($error == TRUE) {
                    showMessage('Ошибка');
                    return FALSE;
                } else {
                    $this->db->where('id', $item_id);
                    $this->db->update('menus_data', $item_data);
                    showMessage('Изменения успешно сохранены');
                    $row = $this->db->where('id', $_POST['menu_id'])->get('menus')->row_array();
                    if ($_POST['action'] == 'tomain') {
                        pjax('/admin/components/cp/menu/menu_item/' . $row['name']);
                    }
                }
            }
        }
    }

    private function _printRecursiveMenuItems($items) {
        $html = '';
        foreach ($items as $item) {
            $item['hasKids'] = false;
            if ($submenus = $this->menu->_get_sub_menus($item['id']))
                $item['hasKids'] = true;
//            $html .= '<div class="item">';
//            $html .= $item['title'];
            $html .= '<div>';

            $this->template->assign('item', $item);
            $html .= $this->fetch_tpl('_menulistitem');

            if ($item['hasKids']) {
                $html .= '<div class="frame_level">';
                $html .= $this->_printRecursiveMenuItems($submenus);
                $html .= '</div>';
            }

            $html .= '</div>';
        }

        return $html;
    }

    function process_root($array) {
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
        $this->padding -= 1;
    }

    /**
     * Insert link into menu
     * Set positions
     */
    function insert_menu_item() {

        cp_check_perm('menu_edit');

        $roles = $_POST['roles'];
        if ($roles == NULL) {
            $roles = '';
        } else {
            $roles = serialize($_POST['roles']);
        }

        // Item position
        if ($_POST['position_after'] > 0) {
            $after_pos = $this->menu_model->get_item_position($_POST['position_after']);
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

        if ($_POST['position_after'] == 0) {
            $this->db->select_max('position');
            $this->db->where('menu_id', $_POST['menu_id']);
            $this->db->where('parent_id', $_POST['parent_id']);
            $query = $this->db->get('menus_data')->row_array();

            if ($query['position'] == NULL) {
                $position = 1;
            } else {
                $position = $query['position'] + 1;
            }
        }

        if ($_POST['position_after'] == 'first') {
            $this->db->select_min('position');
            $this->db->where('menu_id', $_POST['menu_id']);
            $this->db->where('parent_id', $_POST['parent_id']);
            $query = $this->db->get('menus_data')->row_array();

            if ($query['position'] == NULL) {
                $position = 1;
            } else {
                $position = $query['position'] - 1;
            }
        }

        $item_data = array(
            'menu_id' => $_POST['menu_id'],
            'item_id' => $_POST['item_id'],
            'item_type' => $_POST['item_type'],
            'title' => htmlentities($_POST['title'], ENT_QUOTES, 'UTF-8'),
            'hidden' => $_POST['hidden'],
            'item_image' => $_POST['item_image'],
            'roles' => $roles,
            'parent_id' => $_POST['parent_id'],
            'position' => $position,
        );

        if ($item_data['item_type'] == 'module') {
            $mod_info = array(
                'mod_name' => $_POST['item_id'],
                'method' => trim($_POST['method']),
                'newpage' => $_POST['newpage']
            );

            $item_data['item_id'] = 0;
            $item_data['add_data'] = serialize($mod_info);
        }

        if ($item_data['item_type'] == 'url') {
            $item_data['item_id'] = 0;
            $item_data['add_data'] = serialize(array('url' => $_POST['url'], 'newpage' => $_POST['newpage']));
        }

        if (!isset($item_data['add_data']))
            $item_data['add_data'] = serialize(array('newpage' => $_POST['newpage']));

        if ($_POST['update_id'] == 0) {
            // Insert new item  
            $this->menu_model->insert_item($item_data);
        } else {
            // Update item
            $error = FALSE;

            // Error: wrong parent id
            if ($_POST['update_id'] == $_POST['parent_id']) {
                $error = TRUE;
            }

            // Error: don't place root menu in sub
            $item = $this->menu_model->get_item($_POST['update_id']);
            if ($item['parent_id'] == 0) {
                $this->_get_sub_items($_POST['update_id']);

                foreach ($this->sub_menus as $k => $v) {
                    if ($v == $_POST['parent_id']) {
                        $error = TRUE;
                    }
                }
            }

            if ($_POST['position_after'] == 0)
                unset($item_data['position']);

            if ($error == TRUE) {
                return FALSE;
            } else {
                $this->db->where('id', $_POST['update_id']);
                $this->db->update('menus_data', $item_data);
            }
        }
    }

    function save_positions() {
        cp_check_perm('menu_edit');

        foreach ($_POST['positions'] as $k => $v) {
            $k = $k + 1;
            $this->menu_model->set_item_position((int) $v, (int) $k);
        }
        showMessage(lang('a_positions_updated'));
    }

    /**
     * Create new menu
     *
     * @access public
     */
    function create_menu() {
        cp_check_perm('menu_create');
        if ($_POST['menu_name'] == NULL) {
            showMessage(lang('a_menu_field_emp'), '', 'r');

            exit;
        }
        $this->check_menu_data();

        $val = $this->form_validation;
        $val->set_rules('menu_name', lang('amt_name'), 'required|min_length[2]|max_length[25]|alpha_dash');
        $val->set_rules('main_title', lang('amt_tname'), 'required|max_length[100]');
        $val->set_rules('menu_desc', lang('amt_description'), 'max_length[500]');
        $val->set_rules('menu_tpl', lang('amt_template'), 'max_length[500]');
        $val->set_rules('menu_expand_level', lang('amt_open_level'), 'numeric|max_length[2]');

        if ($this->form_validation->run($this) == FALSE) {
            showMessage(validation_errors(), '', 'r');
        } else {
            $data = array(
                'name' => $this->input->post('menu_name'),
                'main_title' => $this->input->post('main_title'),
                'description' => $_POST['menu_desc'],
                'tpl' => $this->input->post('menu_tpl'),
                'expand_level' => $this->input->post('menu_expand_level'),
                'created' => date('Y-m-d H:i:s')
            );

            $this->menu_model->insert_menu($data);

            showMessage(lang('a_menu_create'));
            if ($this->input->post('action') == 'tomain')
                pjax('/admin/components/cp/menu');
            else
                pjax('/admin/components/cp/menu/edit_menu/' . $this->db->insert_id());
        }
    }

    function edit_menu($id) {
        cp_check_perm('menu_edit');
        $menu_data = $this->menu_model->get_menu($id);
        $this->template->add_array($menu_data);
        $this->display_tpl('edit_menu');
    }

    function update_menu($id) {
        cp_check_perm('menu_edit');

//        if ($_POST['menu_name'] == NULL) {
//            $title = lang('a_fail');
//            $message = lang('a_menu_field_emp');
//            $result = false;
//            echo json_encode(array(
//                'title' => $title,
//                'message' => $message,
//                'result' => $result,
//            ));
//            exit;
//        }

        $val = $this->form_validation;
        $val->set_rules('menu_name', lang('amt_name'), 'required|min_length[2]|max_length[25]|alpha_dash');
        $val->set_rules('main_title', lang('amt_tname'), 'required|max_length[100]');
        $val->set_rules('menu_desc', lang('amt_description'), 'max_length[500]');
        $val->set_rules('menu_tpl', lang('amt_template'), 'max_length[500]');
        $val->set_rules('menu_expand_level', lang('amt_open_level'), 'numeric|max_length[2]');


        if ($this->form_validation->run($this) == FALSE) {
            showMessage(validation_errors(), '', 'r');
//            $title = lang('a_fail');
//            $message = validation_errors();
//            $result = false;
        } else {


            $data = array(
                'name' => $this->input->post('menu_name'),
                'main_title' => $this->input->post('main_title'),
                'description' => $_POST['menu_desc'],
                'tpl' => $this->input->post('menu_tpl'),
                'expand_level' => $this->input->post('menu_expand_level'),
                'created' => date('Y-m-d H:i:s')
            );


            $this->db->where('id', $id);
            $this->db->update('menus', $data);
//            $title = lang('a_message');
//            $message = lang('a_menu_chech');
//            $result = true;
            showMessage('Изменения сохранены');
            if ($_POST['action'] == 'tomain')
                pjax('/admin/components/cp/menu');
        }


//        echo json_encode(array(
//            'title' => $title,
//            'message' => $message,
//            'result' => $result,
//        ));
    }

    function check_menu_data() {
        if ($_POST['menu_name'] == NULL) {
            //showMessage(lang('amt_name_required'),false,'r');
            exit;
        }

        if ($this->db->get_where('menus', array('name' => $_POST['menu_name']))->num_rows() > 0) {
            //showMessage(lang('amt_user_exists'),false,'r');
            exit;
        }
    }

    function delete_menu($name = null) {
        cp_check_perm('menu_delete');
        if ($name == null) {
            $name = $this->input->post('ids');
            foreach ($name as $n) {
                $this->menu->prepare_menu_array($n);
                $this->root_menu = & $this->menu->menu_array;
                $this->sub_menu = & $this->menu->sub_menu_array;
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
            showMessage(lang('a_menu_deleted'));
            pjax('/admin/components/cp/menu');
        } else {
            $this->menu->prepare_menu_array($name);
            $this->root_menu = & $this->menu->menu_array;
            $this->sub_menu = & $this->menu->sub_menu_array;
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
            showMessage(lang('a_menu_deleted'));
            pjax('/admin/components/cp/menu');
        }
    }

    function create_tpl() {
        cp_check_perm('menu_create');

        $this->display_tpl('create_menu');
    }

    /**
     * Get pages and return in JSON
     */
    function get_pages($cat_id = 0, $cur_page = 0, $referer = null) {
        $data['nav_count'] = array();
        $data['links'] = 0;
        $per_page = 10;
        if ($_POST['per_page'])
            $per_page = (int) $_POST['per_page'];
        //$per_page = (int) $_POST['per_page'];
        $this->db->select('id, title, url, cat_url');
        $this->db->order_by('created', 'desc');
        $this->db->where('lang_alias', 0);
        $this->db->where('category', $cat_id);

        if ($cur_page == 0) {
            $pages = $this->db->get('content', $per_page);
        } else {
            $pages = $this->db->get('content', $per_page, $per_page * $cur_page);
        }

        if ($pages->num_rows() > 0) {
            $pages = $pages->result_array();
            $data['pages_list'] = $pages;
            $total = $this->db->get_where('content', array('lang_alias' => 0, 'category' => $cat_id))->num_rows();

            $data['links'] = ceil($total / $per_page);
            if ($data['links'] == 1)
                $data['links'] = 0;

            if ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
                if ($referer == 'controller')
                    return $data;
                echo json_encode($data);
            }
            else
                return $data;
        }
    }

    /**
     * Search pages
     */
    function search_pages($cur_page = 0) {
        $data['nav_count'] = array();
        $data['links'] = 0;

        $per_page = (int) $_POST['per_page'];

        $this->db->select('id, title, url, cat_url, category');
        $this->db->order_by('created', 'desc');
        $this->db->where('lang_alias', 0);
        $this->db->like('title', $_POST['search']);

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
                    $pages[$i]['cat_name'] = 'Без категории &rarr; ';
                } else {
                    $pages[$i]['cat_name'] = $name;
                }
            }

            $data['pages_list'] = $pages;

            $this->db->select('id');
            $this->db->where('lang_alias', 0);
            $this->db->like('title', $_POST['search']);
            $total = $this->db->get('content')->num_rows();

            $data['links'] = ceil($total / $per_page);

            if ($data['links'] == 1)
                $data['links'] = 0;

            echo json_encode($data);
        }
    }

    /**
     * Ajax function
     * Load item data and return it in Json
     */
    function get_item() {
        $item_id = (int) $_POST['item_id'];

        $this->db->where('id', $item_id);
        $query = $this->db->get('menus_data');

        if ($query->num_rows() > 0) {
            $data = $query->row_array();

            if (!empty($data['add_data']))
                $data['add_data'] = unserialize($data['add_data']);

            $cnt = count($data);
            $data['roles'] = unserialize($data['roles']);

            if ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')
                echo json_encode($data);
            else
                return $data;
        }
    }

    // Template functions
    function display_tpl($file) {
        $file = realpath(dirname(__FILE__)) . '/templates/' . $file;
        $this->template->show('file:' . $file);
    }

    function fetch_tpl($file) {
        $file = realpath(dirname(__FILE__)) . '/templates/' . $file . '.tpl';
        return $this->template->fetch('file:' . $file);
    }

    function translate_window($id) {
        $langs = $this->_get_langs();

        $n = 0;
        foreach ($langs as $l) {
            $t = $this->db->get_where('menu_translate', array('item_id' => $id, 'lang_id' => $l['id']));

            if ($t->num_rows() == 1) {
                $t = $t->row_array();
                $langs[$n]['curt'] = $t['title'];
            }

            $n++;
        }

        $menu_id = $this->db->where('id', $id)->get('menus_data')->row();
        $menu_id = $menu_id->menu_id;
        $menu_url = $this->db->where('id', $menu_id)->get('menus')->row();
        $menu_url = $menu_url->name;

        $this->template->assign('langs', $langs);
        $this->template->assign('id', $id);
        $this->template->assign('menu_name', $menu_url);

        $this->display_tpl('translate_item');
    }

    function translate_item($id) {
        cp_check_perm('menu_edit');

        $langs = $this->_get_langs();

        $this->db->where('item_id', $id);
        $this->db->delete('menu_translate');

        foreach ($langs as $lang) {
            if (isset($_POST['lang_' . $lang['id']])) {
                if (trim($_POST['lang_' . $lang['id']]) != '') {
                    $data = array(
                        'item_id' => (int) $id,
                        'lang_id' => $lang['id'],
                        'title' => $_POST['lang_' . $lang['id']],
                    );
                    $this->db->insert('menu_translate', $data);
                }
            }
        }
        showMessage(lang('a_changes_saved'));
        //closeWindow('translate_m_Window');
    }

    function _get_langs() {
        $query = $this->db->get('languages');

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function render($viewName, array $data = array(), $return = false) {
        if (!empty($data))
            $this->template->add_array($data);
//        if ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')
//            $this->template->fetch('file:' . 'application/modules/menu/templates/' . $viewName);
//        else
        $this->template->show('file:' . 'application/modules/menu/templates/' . $viewName);
        exit;

        if ($return === false)
            $this->template->show('file:' . 'application/modules/menu/templates/' . $viewName);
        else
            return $this->template->fetch('file:' . 'application/modules/menu/templates/' . $viewName);
    }

    function change_hidden() {
        $id = $this->input->post('id');
        $hidden = $this->db->where('id', $id)->get('menus_data')->row();
        $hidden = $hidden->hidden;
        if ($hidden == 1)
            $hidden = 0;
        else
            $hidden = 1;
        $data = array('hidden' => $hidden);
        $this->menu_model->update_item($id, $data);
    }

    function get_children_items($parent_id, $menu_id) {
        $result = $this->db->select('id, title')->where('parent_id', $parent_id)->where('menu_id', $menu_id)->get('menus_data')->result_array();
        $html .= "<option value='0'> Нет </option>";
        $html .= "<option value='first'> Первый </option>";
        if (count($result) > 0) {
            foreach ($result as $item) {
                $html .= "<option value='" . $item['id'] . "'> - " . $item['title'] . "</option>";
            }
        }
        echo $html;
    }

}

/* End of file admin.php */

    