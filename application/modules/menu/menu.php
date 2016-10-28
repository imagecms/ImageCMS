<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Image CMS
 *
 * Menu module
 */
class Menu extends MY_Controller
{

    /*     * ***** Это можно редактировать *********** */
    private $tpl_folder_prefix = 'level_';

    /**
     *
     * @var array
     */
    private $tpl_file_names = [
                               'container'           => 'container',
                               'item_default'        => 'item_default',
                               'item_default_active' => 'item_default_active',
                               'item_first'          => 'item_first',
                               'item_first_active'   => 'item_first_active',
                               'item_last'           => 'item_last',
                               'item_last_active'    => 'item_last_active',
                               'item_one'            => 'item_one',
                               'item_one_active'     => 'item_one_active',
                              ];

    /*     * ***** То что ниже редактируйте осторожно, вдумчиво :) *********** */
    private $current_uri = '';

    private $tpl_folder = '';

    private $stack = [];

    private $errors = [];

    public $menu_array = []; // the root of the menu tree

    public $sub_menu_array = []; // the list of menu items

    public $select_hidden = FALSE;

    public $arranged_menu_array = [];

    public $activate_by_sub_urls = TRUE;

    private $expand = []; // items id to expand

    private $cache_key = '';

    public $menu_template_vars = [];

    private $cur_level = 0;

    public static $IS_ADMIN_PART = FALSE;

    public function __construct() {
        parent::__construct();
        $this->load->module('core');
        $this->cache_key = 'menu_data_';
        $this->cache_key = $this->cache_key . $this->dx_auth->get_role_id();
        $lang = new MY_Lang();
        $lang->load('menu');
        $this->setAdminPart();
        $this->load->helper('string');
    }

    public function index() {
        redirect();
    }

    public function autoload() {
        $this->load->helper('menu');

        $this->prepare_current_uri();
        //$this->current_uri = site_url( $this->uri->uri_string() );
    }

    /**
     * Prepare and set $this->current_uri value
     *
     * @access private
     */
    private function prepare_current_uri() {
        $lang_id = $this->config->item('cur_lang');
        $this->db->select('identif');
        $query = $this->db->get_where('languages', ['id' => $lang_id])->result();

        if ($query) {
            if ($this->uri->segment(1) == $query[0]->identif) {
                $segment_array = $this->uri->segment_array();
                array_shift($segment_array); // убираем первый элемент ( идентификатор языка ) массива сегментов uri
                $this->current_uri = site_url($segment_array);
            } else {
                $this->current_uri = site_url($this->uri->uri_string());
            }
        } else {
            // что-то не в порядке с таблицей languages или функцией $this->config->item
            return false;
        }
        return true;
    }

    /**
     * Prepare and display menu
     *
     * @param string $menu menu name
     * @access public
     */
    public function render($menu) {
        $this->clear();

        $this->prepare_current_uri(); // правильно определяет текущий uri, фикс бага многоязычности

        $this->prepare_menu_array($menu);

        $this->get_expand_items($this->current_uri);

        $array_keys = array_keys($this->menu_array);
        $start_index = $array_keys[0];
        $this->tpl_folder = $this->menu_array[$start_index]['tpl'];

        $this->prepare_menu_recursion(); // Инициализируем первый элемент для начала итераций

        $this->display_menu($this->menu_array);

        if ($this->errors) {
            $data = [
                     'menu'       => $menu,
                     'errors'     => array_unique($this->errors),
                     'tpl_folder' => $this->tpl_folder,
                    ];
            $this->display_tpl('error', $data);
        } else {
            echo $this->arranged_menu_array[-1]['html'];
        }
    }

    private function prepare_menu_recursion() {
        array_push($this->stack, -1);
        $this->arranged_menu_array[-1]['html'] = FALSE;
        $this->arranged_menu_array[-1]['level'] = -1;
    }

    private function clear() {
        $this->current_uri = '';
        $this->tpl_folder = '';
        $this->menu_array = [];
        $this->errors = [];
        $this->sub_menu_array = [];
        $this->select_hidden = FALSE;
        $this->activate_by_sub_urls = TRUE;
        $this->expand = [];
        $this->arranged_menu_array = [];
        $this->stack = [];
        $this->menu_template_vars = [];
        $this->cur_level = 0;
    }

    /**
     * Recursive function to display menu ul list
     * TODO: Rewrite this part of code to display valid html list
     *
     * @param array $menu_array
     * @access public
     */
    public function display_menu($menu_array) {

        $array_keys = array_keys($menu_array);
        $start_index = $array_keys[0];
        $end_index = $array_keys[count($array_keys) - 1];

        foreach ($menu_array as $item) {
            if (!$item['hidden']) {

                $arranged_items_count = count($this->arranged_menu_array);
                $this->arranged_menu_array[$arranged_items_count]['level'] = $this->cur_level;
                $this->arranged_menu_array[$arranged_items_count]['tpl'] = $item['tpl'];

                // Translate title
                if (isset($item['lang_title_' . $this->config->item('cur_lang')])) {
                    $item['title'] = $item['lang_title_' . $this->config->item('cur_lang')];
                }

                if ($item['item_type'] != 'url') {
                    $site_url = site_url($item['link']);
                } else {
                    $site_url = $item['link'];
                }

                if ($this->activate_by_sub_urls === TRUE) {
                    $exp = explode('/', trim_slashes($this->uri->uri_string()));
                    $exp2 = explode('/', trim_slashes($item['link']));

                    $matches = 0;
                    foreach ($exp2 as $k => $v) {
                        if ($v == $exp[$k]) {
                            $matches++;
                        }
                    }

                    if ($matches == count($exp2)) {
                        $active_cur = TRUE;
                    } else {
                        $active_cur = FALSE;
                    }
                }

                if ($this->cur_level < ($item['expand_level'])) {
                    $this->expand[$item['id']] = TRUE; // to expand tree
                } if ($site_url == $this->current_uri OR $active_cur === TRUE) {
                    $this->expand[$item['id']] = TRUE;
                    $is_active = TRUE;
                    $this->arranged_menu_array[$arranged_items_count]['is_active'] = TRUE;
                } else {
                    // Make link active if link is / and no segments in url
                    // if ($item['link'] == '/' AND $this->uri->total_segments() == 0) {
                    if ($item['link'] == '/' AND get_main_lang('identif') == $this->uri->segment(1) AND $this->uri->total_segments() == 1 or $item['link'] == '/' AND get_main_lang('identif') != $this->uri->segment(1) AND $this->uri->total_segments() == 0 or $item['item_type'] == 'url' AND $item['link'] != '/' AND strstr($this->input->server('REQUEST_URI'), $item['link'])) {
                        $is_active = TRUE;
                        $this->arranged_menu_array[$arranged_items_count]['is_active'] = TRUE;
                    } else {
                        $is_active = FALSE;
                        $this->arranged_menu_array[$arranged_items_count]['is_active'] = FALSE;
                    }
                }

                //$item['item_type'] == 'url' ? $href = $item['link'] : $href = site_url($item['link']);
                //echo $item['item_type'];
                if ($item['item_type'] == 'url' && strstr($item['link'], 'http://') or $item['item_type'] == 'url' && strstr($item['link'], 'www')) {
                    $href = $item['link'];
                } else {
                    $href = rtrim(site_url($item['link']), '/');
                }

                $this->arranged_menu_array[$arranged_items_count]['link'] = $href;
                $this->arranged_menu_array[$arranged_items_count]['id'] = $item['id'];
                $this->arranged_menu_array[$arranged_items_count]['title'] = $item['title'];
                $this->arranged_menu_array[$arranged_items_count]['image'] = $item['image'];
                if (!is_array($item['add_data'])) {
                    $item['add_data'] = unserialize($item['add_data']);
                    $item['add_data']['newpage'] == '1' ? $this->arranged_menu_array[$arranged_items_count]['target'] = 'target="_blank"' : $this->arranged_menu_array[$arranged_items_count]['target'] = 'target="_self"';
                } else {
                    $item['add_data']['newpage'] == '1' ? $this->arranged_menu_array[$arranged_items_count]['target'] = 'target="_blank"' : $this->arranged_menu_array[$arranged_items_count]['target'] = 'target="_self"';
                }

                if (($menu_array[$start_index]['position'] != $item['position']) AND ( $menu_array[$end_index]['position'] != $item['position'])) {
                    $this->arranged_menu_array[$arranged_items_count]['edge'] = 'default';
                }

                if (($menu_array[$start_index]['position'] == $item['position']) AND ( $menu_array[$end_index]['position'] != $item['position'])) {
                    $this->arranged_menu_array[$arranged_items_count]['edge'] = 'first';
                }

                if (($menu_array[$start_index]['position'] != $item['position']) AND ( $menu_array[$end_index]['position'] == $item['position'])) {
                    $this->arranged_menu_array[$arranged_items_count]['edge'] = 'last';
                }

                if (($menu_array[$start_index]['position'] == $item['position']) AND ( $menu_array[$end_index]['position'] == $item['position'])) {
                    $this->arranged_menu_array[$arranged_items_count]['edge'] = 'one';
                }

                $sub_menus = $this->_get_sub_menus($item['id']);

                $this->arranged_menu_array[$arranged_items_count]['has_childs'] = count($sub_menus) > 0 ? 1 : 0;

                if (isset($this->expand[$item['id']]) AND $this->expand[$item['id']] == TRUE AND count($sub_menus) > 0) {
                    $this->cur_level++;
                    array_push($this->stack, $arranged_items_count);

                    $this->display_menu($sub_menus);
                } else {
                    $this->_prepare_item_tpl($arranged_items_count);
                }
            }
        }

        $wrapper = '';
        $stack_item = array_pop($this->stack);
        for ($i = $stack_item + 1; $i <= $arranged_items_count; $i++) {
            if ($this->arranged_menu_array[$i]['level'] <= $this->arranged_menu_array[$stack_item]['level'] + 1) {
                $wrapper .= $this->arranged_menu_array[$i]['html'] . "\n";
            }
        }

        $this->_prepare_item_tpl($stack_item, $wrapper);

        $this->cur_level--;
    }

    /**
     * Натягивает шаблон на данные и запихивает всю эту красоту в this->arranged_menu_array[$arranged_items_count]['html']. версия для элемента списка
     *
     * @param integer $index номер элемента для натягивания шаблона
     * @param string $wrapper натянутые шаблоны на всех всех наследников
     * @access private
     * @return string|false
     */
    private function _prepare_container_tpl($index = 0, $wrapper = FALSE) {
        $data = ['wrapper' => $wrapper];

        $tpl_path = $this->_get_real_tpl($index, 'container');
        if ($tpl_path) {
            return $this->fetch_tpl($tpl_path, $data);
        } else {
            return FALSE;
        }
    }

    /**
     * Натягивает данные на шаблон и запихивает всю эту красоту в this->arranged_menu_array[$arranged_items_count]['html']. версия для элемента списка
     *
     * @param integer $index номер элемента для натягивания шаблона
     * @param string $wrapper натянутые шаблоны на всех всех наследников
     * @access private
     * @return TRUE
     */
    private function _prepare_item_tpl($index = 0, $wrapper = FALSE) {
        if ($wrapper == TRUE) {
            $wrapper = $this->_prepare_container_tpl($index, $wrapper);
        }

        $is_active_hard = $this->arranged_menu_array[$index]['link'] == $this->current_uri ? 1 : 0;

        $data = [
                 'id'             => $this->arranged_menu_array[$index]['id'],
                 'title'          => $this->arranged_menu_array[$index]['title'],
                 'link'           => $this->arranged_menu_array[$index]['link'],
                 'image'          => $this->arranged_menu_array[$index]['image'],
                 'wrapper'        => $wrapper,
                 'target'         => $this->arranged_menu_array[$index]['target'],
                 'has_childs'     => $this->arranged_menu_array[$index]['has_childs'],
                 'is_active_hard' => $is_active_hard,
                ];

        if ($index == -1) {
            $this->arranged_menu_array[$index]['html'] = $wrapper;
        } else {
            $tpl_path = $this->_get_real_tpl($index);
            if ($tpl_path) {
                $this->arranged_menu_array[$index]['html'] = $this->fetch_tpl($tpl_path, $data);
            }
        }

        return TRUE;
    }

    /**
     * Find sub menus
     *
     * @param integer $id
     * @access public
     * @return mixed
     */
    private function _get_real_tpl($index = 0, $mode = 'item') {
        if ($mode == 'item') {
            $is_active = $this->arranged_menu_array[$index]['is_active'];
            $edge = $this->arranged_menu_array[$index]['edge'];

            switch ($edge) {
                case 'first':
                    $item_active_tpl = $this->tpl_file_names['item_first_active'];
                    $item_tpl = $this->tpl_file_names['item_first'];
                    break;
                case 'last':
                    $item_active_tpl = $this->tpl_file_names['item_last_active'];
                    $item_tpl = $this->tpl_file_names['item_last'];
                    break;
                case 'one':
                    $item_active_tpl = $this->tpl_file_names['item_one_active'];
                    $item_tpl = $this->tpl_file_names['item_one'];
                    break;
                default:
                    // ничего вроде не надо...
                    break;
            }

            /*             * *** дефолтный шаблон ***** */
            $default_item_active_tpl = $this->tpl_file_names['item_default_active'];
            $default_item_tpl = $this->tpl_file_names['item_default'];
            $is_good = FALSE;

            for ($level = $this->arranged_menu_array[$index]['level']; $level >= 0; $level--) {
                if ($is_active) {
                    if ($item_active_tpl) {
                        $tpl = $this->tpl_folder_prefix . $level . '/' . $this->tpl_file_names[$item_active_tpl];
                        if ($this->test_tpl($tpl)) {
                            $is_good = TRUE;
                            break;
                        }
                    }
                    if ($item_tpl) {
                        $tpl = $this->tpl_folder_prefix . $level . '/' . $this->tpl_file_names[$item_tpl];
                        if ($this->test_tpl($tpl)) {
                            $is_good = TRUE;
                            break;
                        }
                    }

                    $tpl = $this->tpl_folder_prefix . $level . '/' . $this->tpl_file_names[$default_item_active_tpl];
                    if ($this->test_tpl($tpl)) {
                        $is_good = TRUE;
                        break;
                    }

                    $tpl = $this->tpl_folder_prefix . $level . '/' . $this->tpl_file_names[$default_item_tpl];
                    if ($this->test_tpl($tpl)) {
                        $is_good = TRUE;
                        break;
                    }
                } else {
                    if ($item_tpl) {
                        $tpl = $this->tpl_folder_prefix . $level . '/' . $this->tpl_file_names[$item_tpl];
                        if ($this->test_tpl($tpl)) {
                            $is_good = TRUE;
                            break;
                        }
                    }
                    $tpl = $this->tpl_folder_prefix . $level . '/' . $this->tpl_file_names[$default_item_tpl];
                    if ($this->test_tpl($tpl)) {
                        $is_good = TRUE;
                        break;
                    }
                }
            }
        } else {
            for ($level = $this->arranged_menu_array[$index]['level'] + 1; $level >= 0; $level--) {
                $tpl = $this->tpl_folder_prefix . $level . '/' . $this->tpl_file_names['container'];
                if ($this->test_tpl($tpl)) {
                    $is_good = TRUE;
                    break;
                }
            }
        }

        if ($is_good) {
            return $tpl;
        } else {
            //передача управления сюда означает что один из необходимых файлов шаблона меню не найден в указанной папке

            if ($this->tpl_folder) {
                $err_data = ['user_template' => $this->tpl_folder . '/' . $tpl . '.tpl'];
            } else {
                $err_data = ['system_template' => './application/' . getModContDirName('menu') . '/menu/templates/public/' . $tpl . '.tpl'];
            }

            $this->errors[] = $err_data;
            return FALSE;
        }
    }

    /**
     * Find sub menus
     *
     * @param integer $id
     * @access public
     * @return array|false
     */
    public function _get_sub_menus($id) {
        $sub_menus = [];

        foreach ($this->sub_menu_array as $sub_menu) {
            if ($sub_menu['parent_id'] == $id) {
                array_push($sub_menus, $sub_menu);

                if (site_url($item['link']) == $this->current_uri) {
                    $this->expand[$item['id']] == TRUE;
                }
            }
        }

        if (count($sub_menus > 0)) {
            return $sub_menus;
        } else {
            return FALSE;
        }
    }

    /**
     * Find menus ids we must open
     *
     * @param string $url
     * @access private
     * @return bool
     */
    private function get_expand_items($url) {
        foreach ($this->sub_menu_array as $item) {
            if (site_url($item['link']) == $url AND $item['parent_id'] != 0 and ! empty($item['link'])) {
                $this->expand[$item['parent_id']] = TRUE;
                $this->get_expand_items(site_url($this->sub_menu_array[$item['parent_id']]['link']));
            }
        }
        return TRUE;
    }

    /**
     * Select menu data from DB and separate menus is two arrays: root and submenus.
     *
     * @param string $menu - menu name
     * @access public
     */
    public function prepare_menu_array($menu) {
        $menu_cache_key = $this->cache_key . $menu . self::getCurrentLocale();
        if (($menu_data = $this->cache->fetch($menu_cache_key, 'menus')) !== FALSE) {
            $this->menu_array = $menu_data['menu_array'];
            $this->sub_menu_array = $menu_data['sub_menu_array'];
        } else {
            $this->db->select('menus.name', FALSE);
            $this->db->select('menus.tpl AS tpl', FALSE);
            $this->db->select('menus.expand_level AS expand_level', FALSE);
            //$this->db->select('menus.main_title', FALSE);
            $this->db->select('menus_data.id AS id', FALSE);
            $this->db->select('menus_data.menu_id AS menu_id', FALSE);
            $this->db->select('menus_data.item_type AS item_type', FALSE);
            $this->db->select('menus_data.item_id AS item_id', FALSE);
            $this->db->select('menus_data.title AS title', FALSE);
            $this->db->select('menus_data.hidden AS hidden', FALSE);
            $this->db->select('menus_data.position AS position', FALSE);
            $this->db->select('menus_data.roles AS roles', FALSE);
            $this->db->select('menus_data.parent_id AS parent_id', FALSE);
            $this->db->select('menus_data.description AS description', FALSE);
            $this->db->select('menus_data.add_data AS add_data', FALSE);
            $this->db->select('menus_data.item_image AS image', FALSE);

            $this->db->join('menus_data', 'menus_data.menu_id = menus.id');
            $this->db->where('menus.name', $menu);
            $this->db->where('menus_data.hidden', 0);
            $this->db->order_by('position', 'asc');

            // Select hidden items
            if ($this->select_hidden == TRUE) {
                $this->db->or_where('menus_data.hidden', 1);
                $this->db->where('menus.name', $menu);
            }

            $menus = $this->db->get('menus');

            if ($menus->num_rows() == 0) {
                //echo 'Ошибка загрузки меню '.$menu;
                return FALSE;
            } else {
                $menus = $menus->result_array();
            }

            // detect roles
            $cnt = count($menus);
            for ($i = 0; $i < $cnt; $i++) {
                if ($menus[$i]['roles'] != FALSE) {
                    $access = $this->_check_roles(unserialize($menus[$i]['roles']));
                    if ($access == FALSE) {
                        unset($menus[$i]);
                    }
                }
            }

            $this->cur_menu_id = $menus[0]['menu_id'];
            $this->load->model('menu_model', 'item');

            $menus = array_values($menus);

            $langs = $this->db->get('languages');

            if ($langs->num_rows() > 0) {
                $langs = $langs->result_array();
            } else {
                $langs = FALSE;
            }

            // Create links
            $cnt = count($menus);
            for ($i = 0; $i < $cnt; $i++) {
                switch ($menus[$i]['item_type']) {
                    case 'page':

                        $url = $this->item->get_page_url($menus[$i]['item_id']);
                        $menus[$i]['link'] = $url['cat_url'] . '/' . $url['url'];
                        break;

                    case 'category':
                        $category = $this->lib_category->get_category($menus[$i]['item_id']);
                        $menus[$i]['link'] = $category['path_url'];
                        break;

                    case 'module':
                        $mod_info = unserialize($menus[$i]['add_data']);
                        $mod_url = $this->item->get_module_link($mod_info['mod_name']);

                        if ($menus[$i]['add_data'] != NULL) {
                            $method = $mod_info['method'];

                            if (substr($method, 0, 1) == '/') {
                                $url = $mod_url . $method;
                            } else {
                                $url = $mod_url . '/' . $method;
                            }
                        }

                        $menus[$i]['link'] = $url;
                        break;

                    case 'url':
                        $menus[$i]['add_data'] = unserialize($menus[$i]['add_data']);
                        $menus[$i]['link'] = $menus[$i]['add_data']['url'];
                        break;
                }

                if ($langs != FALSE) {
                    foreach ($langs as $lang) {

                        if (self::getCurrentLocale($lang)) {
                            $this->db->where('item_id', $menus[$i]['id']);
                            $this->db->where('lang_id', $lang['id']);
                            $t_query = $this->db->get('menu_translate');

                            if ($t_query->num_rows() == 1) {
                                $n_title = $t_query->row_array();
                                if ($n_title['title']) {
                                    $menus[$i]['title'] = $n_title['title'];
                                }
                            }
                        }
                    }
                }

                if ($menus[$i]['parent_id'] == 0) {
                    $this->menu_array[$menus[$i]['id']] = $menus[$i];
                } else {
                    $this->sub_menu_array[$menus[$i]['id']] = $menus[$i];
                }
            }

            $data = [
                     'menu_array'     => $this->menu_array,
                     'sub_menu_array' => $this->sub_menu_array,
                    ];

            $this->cache->store($menu_cache_key, $data, FALSE, 'menus');
        }
    }

    /**
     * Get current locale for menu module
     * @param $language
     * @return string|boolean
     */
    public static function getCurrentLocale($language = NULL) {
        if ($language == null) {
            return self::$IS_ADMIN_PART ? MY_Controller::defaultLocale() : MY_Controller::getCurrentLocale();
        }

        if (self::$IS_ADMIN_PART && $language['identif'] == MY_Controller::defaultLocale()) {
            return TRUE;
        }

        if (!self::$IS_ADMIN_PART && $language['identif'] == MY_Controller::getCurrentLocale()) {
            return TRUE;
        }

        return FALSE;
    }

    private function setAdminPart() {
        return $this->uri->segment(1) === 'admin' ? TRUE : FALSE;
    }

    /**
     *
     * @param array $roles
     * @return boolean
     */
    private function _check_roles($roles = []) {
        $access = FALSE;

        foreach ($roles as $role_id) {
            $my_role = $this->dx_auth->get_role_id();

            // admin
            if ($this->dx_auth->is_admin() === TRUE) {
                $access = TRUE;
            }

            // all users
            if ($role_id == 0) {
                $access = TRUE;
            }

            if ($role_id == $my_role) {
                $access = TRUE;
            }
        }

        return $access;
    }

    public function get_all_menus() {
        $this->db->select('name, main_title');
        $query = $this->db->get('menus');

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }

    /**
     * Display template file
     */
    private function display_tpl($file = '', $data = []) {
        if (count($data) > 0) {
            $this->template->add_array($data);
        }

        $file = realpath(__DIR__) . '/templates/public/' . $file . '.tpl';

        $this->template->display('file:' . $file);
    }

    /**
     * Fetch template file
     */
    private function fetch_tpl($file = '', $data = []) {
        if (count($data) > 0) {
            $this->template->add_array($data);
        }

        if ($this->tpl_folder) {
            $file = $this->template->template_dir . $this->tpl_folder . '/' . $file . '.tpl';
        } else {
            $file = realpath(__DIR__) . '/templates/public/' . $file . '.tpl';
        }

        return $this->template->fetch('file:' . $file);
    }

    private function test_tpl($file = '') {
        if ($this->tpl_folder) {
            $file = $this->template->template_dir . $this->tpl_folder . '/' . $file . '.tpl';
        } else {
            $file = realpath(__DIR__) . '/templates/public/' . $file . '.tpl';
        }

        if (file_exists($file)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function _install() {
        $this->db->where('name', 'menu');
        $this->db->update('components', ['autoload' => 1]);
    }

}