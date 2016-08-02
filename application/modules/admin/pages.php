<?php

use CMSFactory\Events;

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * @property Lib_admin $lib_admin
 * @property Cms_admin $cms_admin
 * @property Lib_category $lib_category
 * @property Lib_seo $lib_seo
 */
class Pages extends BaseAdminController
{

    public $_Config = ['per_page' => 20];

    public function __construct() {

        parent::__construct();

        $this->load->library('DX_Auth');
        admin_or_redirect();

        $this->load->library('lib_admin');
        $this->load->library('lib_category');
        $this->load->library('pagination');
        $this->load->library('lib_seo');
        $this->lib_admin->init_settings();
    }

    public function index() {

        // Set roles
        $locale = $this->cms_admin->get_default_lang();
        $locale = $locale['identif'];

        $query = $this->db->query("SELECT * FROM `shop_rbac_roles` JOIN `shop_rbac_roles_i18n` ON shop_rbac_roles.id=shop_rbac_roles_i18n.id WHERE `locale`='" . $locale . "'");
        $this->template->assign('roles', $query->result_array());

        $uri_segs = $this->uri->uri_to_assoc(2);

        $this->template->add_array(
            [
             'tree'     => $this->lib_category->build(), // Load category tree
             'cur_time' => date('H:i:s'),
             'cur_date' => date('Y-m-d'),
             'sel_cat'  => $uri_segs['category'],
            ]
        );
        /** Init Event. Pre Create Page */
        Events::create()->registerEvent('', 'BaseAdminPage:preCreate');
        Events::runFactory();

        $this->template->show('add_page', FALSE);
    }

    /*     * **************************************************
     * PAGE EVENTS
     * ************************************************* */

    /**
     * Validation for template name field
     * @param string $tpl
     * @return bool
     */
    public function tpl_validation($tpl) {

        if (preg_match('/^[A-Za-z\_\.]{0,50}$/', $tpl)) {
            return TRUE;
        }
        $this->form_validation->set_message('tpl_validation', lang('The %s field can only contain Latin characters', 'admin'));
        return FALSE;
    }

    /**
     * Add new page
     * Language default
     */
    public function add() {

        $this->form_validation->set_rules('page_title', lang('Title', 'admin'), 'trim|required|min_length[1]|max_length[500]');
        $this->form_validation->set_rules('page_url', lang('URL', 'admin'), 'alpha_dash|least_one_symbol');
        $this->form_validation->set_rules('prev_text', lang('Preliminary contents', 'admin'), 'trim|required');
        $this->form_validation->set_rules('page_description', lang('Description ', 'admin'), 'trim');
        $this->form_validation->set_rules('full_tpl', lang('Page template', 'admin'), 'trim|max_length[150]|min_length[2]|callback_tpl_validation');
        $this->form_validation->set_rules('create_date', lang('Creation date', 'admin'), 'required');
        $this->form_validation->set_rules('create_time', lang('Creation time', 'admin'), 'required');
        $this->form_validation->set_rules('publish_date', lang('Publication date', 'admin'), 'required');
        $this->form_validation->set_rules('publish_time', lang('Publication time', 'admin'), 'required');

        $this->form_validation->set_rules('main_tpl', lang('Main page template', 'admin'), 'trim|max_length[50]|min_length[2]|callback_tpl_validation');

        if ($this->form_validation->run($this) == FALSE) {
            $error = $this->form_validation->error_string('<p>', '</p>');

            showMessage(lang('From validation error: <br />', 'admin') . $error, false, 'r');
        } else {
            // load site settings
            $settings = $this->cms_admin->get_settings();

            $def_lang = $this->cms_admin->get_default_lang();

            if ($this->input->post('page_url') == '' or $this->input->post('page_url') == NULL) {
                $url = $this->createUrl($this->input->post('page_title'));
            } else {
                $url = $this->input->post('page_url');
            }

            // check if we have existing module with entered URL
            $this->db->where('name', $url);
            $query = $this->db->get('components');

            if ($query->num_rows() > 0) {
                showMessage(lang('Reserved the same name module', 'admin'), false, 'r');
                return;
            }
            // end module check
            // check if we have existing category with entered URL
            $this->db->where('url', $url);
            $query = $this->db->get('category', 1);

            if ($query->num_rows() > 0) {
                showMessage(lang('Category or page with such url already exist', 'admin'), false, 'r');
                return;
            }
            // end check
            // check if we have existing page with entered URL
            $this->db->select('id, lang, url');
            $this->db->where('url', $url);
            $this->db->where('lang', $def_lang['id']);
            $this->db->where('category', $this->input->post('category'));
            $query = $this->db->get('content', 1);

            if ($query->num_rows() > 0) {
                showMessage(lang('Page with the same URL has been created yet. Specify or select another URL', 'admin'), false, 'r');
                return;
            }
            // end check

            $full_url = $this->lib_category->GetValue($this->input->post('category'), 'path_url');

            if ($full_url == FALSE) {
                $full_url = '';
            }

            $keywords = $this->lib_admin->db_post('page_keywords');
            $description = $this->lib_admin->db_post('page_description');

            // create keywords
            if ($keywords == '' AND $settings['create_keywords'] == 'auto') {
                $keywords = $this->lib_seo->get_keywords($this->input->post('prev_text') . ' ' . $this->input->post('full_text'));
            }

            // create description
            if ($description == '' AND $settings['create_description'] == 'auto') {
                $description = $this->lib_seo->get_description($this->input->post('prev_text') . ' ' . $this->input->post('full_text'));
            }

            mb_substr($keywords, -1) == ',' ? $keywords = mb_substr($keywords, 0, -1) : TRUE;

            $publish_date = $this->input->post('publish_date') . ' ' . $this->input->post('publish_time');
            $create_date = $this->input->post('create_date') . ' ' . $this->input->post('create_time');

            /** @var array $category_default_comments */
            $category_default_comments = $this->lib_category->get_category($this->input->post('category'));

            $data = [
                     'title'           => trim($this->input->post('page_title')),
                     'meta_title'      => trim($this->input->post('meta_title')),
                     'url'             => str_replace('.', '', trim($url)), //Delete dots from url
                     'cat_url'         => $full_url,
                     'keywords'        => $keywords,
                     'description'     => $description,
                //'full_text' => htmlspecialchars(trim($this->input->post('full_text'))),
                     'full_text'       => trim($this->input->post('full_text')),
                     'prev_text'       => trim($this->lib_admin->db_post('prev_text')),
                //'prev_text' => htmlspecialchars(trim($this->lib_admin->db_post('prev_text'))),
                     'category'        => $this->input->post('category'),
                     'full_tpl'        => $this->input->post('full_tpl'),
                     'main_tpl'        => $this->input->post('main_tpl'),
                     'comments_status' => $category_default_comments['comments_default']?: 0,
                     'post_status'     => $this->input->post('post_status'),
                     'author'          => $this->dx_auth->get_username(),
                     'publish_date'    => strtotime($publish_date),
                     'created'         => strtotime($create_date),
                     'lang'            => $def_lang['id'],
                    ];

            $page_id = $this->cms_admin->add_page($data);

            $data['id'] = $page_id;

            $this->load->module('cfcm')->save_item_data($page_id, 'page');

            $this->cache->delete_all();

            $this->on_page_add($data);

            $this->lib_admin->log(
                lang('Created a page', 'admin') .
                " <a href='/admin/pages/edit/$page_id'>{$data['title']}</a>"
            );

            $action = $this->input->post('action');
            $path = '/admin/pages/GetPagesByCategory';

            if ($action == 'edit') {
                $path = '/admin/pages/edit/' . $page_id;
            }

            showMessage(lang('Page has been created', 'admin'));
            pjax($path);
        }
    }

    /**
     * Crete url with at least one symbol
     * @param $str
     * @return string
     */
    private function createUrl($str) {

        $this->load->helper('translit');
        is_numeric($str) && $str = 'p' . $str;
        return translit_url($str);
    }

    /*     * **************************************************
     * END PAGE EVENTS
     * ************************************************* */

    /**
     * This event occurs right after page inserted in DB
     */
    private function on_page_add($page) {

        $this->load->module('cfcm')->save_item_data($page['id'], 'page');

        /** Set page roles */
        $this->_set_page_roles($page['id'], $this->input->post('roles'));

        /** Set page tags */
        $this->load->module('tags')->_set_page_tags($this->input->post('search_tags'), $page['id']);

        /** Init CMS Events system */
        Events::create()->registerEvent($page, 'Page:create');
    }

    /**
     * Set roles for page
     * @param integer $page_id
     * @param array $roles
     * @return bool
     */
    public function _set_page_roles($page_id, $roles) {

        if ($roles[0] != '') {
            $page_roles = [];

            foreach ($roles as $k) {
                $data = ['role_id' => $k];
                array_push($page_roles, $data);
            }

            $n_data = [
                       'page_id' => $page_id,
                       'data'    => serialize($page_roles),
                      ];

            // Delete page roles
            $this->db->where('page_id', $page_id);
            $this->db->delete('content_permissions');

            // Insert new page roles
            $this->db->insert('content_permissions', $n_data);
        } else {

            if ($this->db->get_where('content_permissions', ['page_id' => $page_id])->num_rows() > 0) {
                $this->db->where('page_id', $page_id);
                $this->db->delete('content_permissions');
            }
        }

        return TRUE;
    }

    /**
     * Show edit_page form
     *
     * @access public
     * @param integer $page_id
     * @param int $lang
     */
    public function edit($page_id, $lang = 0) {
        $this->cms_base->setLocaleId($lang);

        if ($this->cms_admin->get_page($page_id) == FALSE) {
            showMessage(lang('Page', 'admin') . $page_id . lang('Not found', 'admin'), false, 'r');
            return;
        }

        // Get page data
        $data = $this->db->get_where('content', ['id' => $page_id])->row_array();

        if ($data['lang_alias'] != 0) {
            redirect('/admin/pages/edit/' . $data['lang_alias'] . '/' . $data['lang']);
        }

        if ($lang != 0 AND $lang != $data['lang']) {
            $data = $this->db->get_where('content', ['lang_alias' => $page_id, 'lang' => $lang]);

            if ($data->num_rows() > 0) {
                $data = $data->row_array();
            } else {
                $data = FALSE;
            }
        }
        /** Init Event. Pre Edit Page */
        Events::create()->registerEvent(['pageId' => $page_id, 'url' => $data['url']], 'BaseAdminPage:preUpdate');
        Events::runFactory();

        $pageExists = 1;
        if (!$data) {
            $defpage = $this->cms_admin->get_page($page_id);
            $defpage['author'] = $this->dx_auth->get_username();
            $defpage['lang'] = $lang;
            $defpage['title'] = '';
            $defpage['keywords'] = '';
            $defpage['description'] = '';
            $defpage['prev_text'] = '';
            $defpage['full_text'] = '';
            $defpage['meta_title'] = '';
            $data = $defpage;
            $pageExists = 0;
        }

        if ($data) {
            $this->template->assign('page_id', $page_id);
            $this->template->assign('update_page_id', $data['id']);

            $this->template->add_array($data);

            $this->load->module('tags');
            $this->template->assign('tags', $this->tags->get_page_tags($data['id']));

            // Roles
            $this->db->where('page_id', $page_id);
            $query = $this->db->get('content_permissions', 1);
            $page_roles = $query->row_array();
            $page_roles = unserialize($page_roles['data']);

            // Set roles
            $locale = MY_Controller::defaultLocale();
            $g_query = $this->db->query("SELECT * FROM `shop_rbac_roles` JOIN `shop_rbac_roles_i18n` ON shop_rbac_roles.id=shop_rbac_roles_i18n.id WHERE locale='$locale'");
            $roles = $g_query->result_array();

            if ($roles != FALSE) {
                for ($i = 0, $cnt = count($roles); $i < $cnt; $i++) {
                    for ($i2 = 0, $cnt2 = count($page_roles); $i2 < $cnt2; $i2++) {
                        if ($page_roles[$i2]['role_id'] == $roles[$i]['id']) {
                            $roles[$i]['selected'] = 'selected="true"';
                        }
                        if ($page_roles[$i2]['role_id'] == '0') {
                            $this->template->assign('all_selected', 'selected="true"');
                        }
                    }
                }
            }

            $this->template->assign('roles', $roles);
            // roles
            // explode publush_date to date and time
            $this->template->assign('publish_date', date('Y-m-d', $data['publish_date']));
            $this->template->assign('publish_time', date('H:i:s', $data['publish_date']));
            $this->template->assign('create_date', date('Y-m-d', $data['created']));
            $this->template->assign('create_time', date('H:i:s', $data['created']));
            // end
            // set langs
            $langs = $this->cms_admin->get_langs();

            if (count($langs) > 1) {
                $this->template->assign('show_langs', 1);
            }

            // Load category
            $category = $this->lib_category->get_category($data['category']);

            $pagesPagination = $this->session->userdata('pages_pag_url');
            $pagesPagination = $pagesPagination ? $pagesPagination : null;

            $this->template->add_array(
                [
                 'page_lang'       => $data['lang'],
                 'page_identif'    => $data['identif'],
                 'tree'            => $this->lib_category->build(),
                 'parent_id'       => $data['category'],
                 'langs'           => $langs,
                    //                    'defLang' => $def_lang, //??
                 'category'        => $category,
                 'pageExists'      => $pageExists,
                 'pagesPagination' => $pagesPagination,
                ]
            );

            if ($data['lang_alias'] != 0) {
                $orig_page = $this->cms_admin->get_page($data['lang_alias']);

                $this->template->assign('orig_page', $orig_page);
            }

            $this->template->show('edit_page', FALSE);
        }
    }

    /**
     * Update existing page by ID
     *
     * @access public
     * @param integer $page_id
     */
    public function update($page_id) {

        $pagesPagination = $this->session->userdata('pages_pag_url');
        $pagesPagination = $pagesPagination ? $pagesPagination : null;

        //cp_check_perm('page_edit');

        $data = $this->db->get_where('content', ['id' => $page_id]);

        if ($data->num_rows() > 0) {
            $data = $data->row_array();
        } else {
            $data = FALSE;
        }
        /** Init Event. Pre Edit Page */
        Events::create()->registerEvent(['pageId' => $page_id, 'url' => $data['url']], 'BaseAdminPage:preUpdate');
        Events::runFactory();

        $this->form_validation->set_rules('page_title', lang('Title', 'admin'), 'trim|required|min_length[1]|max_length[500]');
        $this->form_validation->set_rules('page_url', lang('URL', 'admin'), 'alpha_dash|least_one_symbol');
        $this->form_validation->set_rules('page_keywords', lang('Keywords', 'admin'), 'trim');
        $this->form_validation->set_rules('prev_text', lang('Preliminary contents', 'admin'), 'trim|required');
        $this->form_validation->set_rules('page_description', lang('Description ', 'admin'), 'trim');
        $this->form_validation->set_rules('full_tpl', lang('Page template', 'admin'), 'trim|max_length[50]|min_length[2]|callback_tpl_validation');
        $this->form_validation->set_rules('main_tpl', lang('Main page template ', 'admin'), 'trim|max_length[50]|min_length[2]|callback_tpl_validation');
        $this->form_validation->set_rules('create_date', lang('Creation date', 'admin'), 'required');
        $this->form_validation->set_rules('create_time', lang('Creation time', 'admin'), 'required');
        $this->form_validation->set_rules('publish_date', lang('Publication date', 'admin'), 'required');
        $this->form_validation->set_rules('publish_time', lang('Publication time', 'admin'), 'required');

        $page_category = $this->cms_admin->get_category($data['category']);

        if ($page_category['field_group'] != -1 && $page_category) {
            $groupId = $page_category['field_group'];
            $fields = $this->db
                ->where("content_fields.data like '%required%'")
                ->or_where("content_fields.data like '%validation%'")
                ->where('group_id', $groupId)
                ->join('content_fields', 'content_fields.field_name = content_fields_groups_relations.field_name')
                ->get('content_fields_groups_relations')
                ->result_array();

            foreach ($fields as $field) {
                if ($groupId == $field['group_id']) {
                    $data = unserialize($field['data']);
                    $str = '';
                    if ($data['required']) {
                        $str .= 'required|';
                    }
                    if ($data['validation']) {
                        $str .= $data['validation'];
                    }

                    $this->form_validation->set_rules($field['field_name'], $data['label'], $str);
                }
            }
        }

        if ($this->form_validation->run($this) == FALSE) {
            showMessage(validation_errors(), false, 'r');
        } else {
            if ($this->input->post('page_url') == '' or $this->input->post('page_url') == NULL) {
                $url = $this->createUrl($this->input->post('page_title'));
            } else {
                $url = $this->input->post('page_url');
            }

            // check if we have existing module with entered URL
            $this->db->where('name', $url);
            $query = $this->db->get('components');

            if ($query->num_rows() > 0) {
                showMessage(lang('Reserved the same name module', 'admin'), false, 'r');
                return;
            }
            // end module check
            // check if we have existing category with entered URL
            $this->db->where('url', $url);
            $query = $this->db->get('category', 1);

            if ($query->num_rows() > 0) {
                showMessage(lang('Reserved of the same name category', 'admin'), false, 'r');
                return;
            }
            // end check
            // check if we have existing page with entered URL
            $b_page = $this->cms_admin->get_page($page_id);

            $this->db->where('url', $url);
            $this->db->where('category', $this->input->post('category'));
            $this->db->where('category !=', $b_page['category']);
            $this->db->where('lang', $b_page['lang']);
            $query = $this->db->get('content', 1);

            if ($query->num_rows() > 0) {
                showMessage(lang('Page with the same URL in this category has been created yet. Specify or select another URL', 'admin'), false, 'r');
                return;
            }
            // end check

            $full_url = $this->lib_category->GetValue($this->input->post('category'), 'path_url');

            if ($full_url == FALSE) {
                $full_url = '';
            }

            $keywords = $this->lib_admin->db_post('page_keywords');
            $description = $this->lib_admin->db_post('page_description');

            $publish_date = $this->input->post('publish_date') . ' ' . $this->input->post('publish_time');
            $create_date = $this->input->post('create_date') . ' ' . $this->input->post('create_time');

            $data = [
                     'title'           => trim($this->input->post('page_title')),
                     'meta_title'      => trim($this->input->post('meta_title')),
                     'url'             => str_replace('.', '', trim($url)), //Delete dots from url
                     'cat_url'         => $full_url,
                     'keywords'        => $keywords,
                     'description'     => $description,
                     'full_text'       => trim($this->input->post('full_text')),
                     'prev_text'       => trim($this->lib_admin->db_post('prev_text')),
                     'category'        => $this->input->post('category'),
                     'full_tpl'        => $this->input->post('full_tpl'),
                     'main_tpl'        => $this->input->post('main_tpl'),
                     'comments_status' => $this->input->post('comments_status'),
                     'post_status'     => $this->input->post('post_status'),
                     'author'          => $this->dx_auth->get_username(),
                     'publish_date'    => strtotime($publish_date),
                     'created'         => strtotime($create_date),
                     'updated'         => time(),
                    ];

            $data['id'] = $page_id;

            if ($b_page['lang_alias'] != 0) {
                $data['url'] = $b_page['url'];
            }

            $this->on_page_update($data);

            $last_id = $this->cms_admin->update_page($page_id, $data);

            if ($last_id >= 1) {
                $this->load->module('cfcm')->save_item_data($last_id, 'page');

                $this->cache->delete_all();

                $this->lib_admin->log(
                    lang('Changed the page', 'admin') .
                    " <a href='/admin/pages/edit/$page_id>'{$data['title']}</a>"
                );

                $action = $this->input->post('action');
                $path = '/admin/pages/GetPagesByCategory/all/' . $pagesPagination;

                if ($action == 'edit') {
                    $path = "/admin/pages/edit/$page_id";
                }

                showMessage(lang('Page contents have been updated', 'admin'));

                $page = $this->cms_admin->get_page($page_id);
                if ($page) {
                    $page_id = $page['lang_alias'] ? $page['lang_alias'] : $page_id;
                    $lang_id = $this->input->post('lang_id');
                    if ($action == 'edit') {
                        $path = "/admin/pages/edit/$page_id/$lang_id";
                    }
                }

                pjax($path);
            } else {
                showMessage('Error', false, 'r');
            }
        }
    }

    /**
     * This event occurs right after page updated
     * @param array $page
     */
    private function on_page_update($page) {

        /** Update page roles */
        $this->_set_page_roles($page['id'], $this->input->post('roles'));

        /** Update page tags */
        $this->load->module('tags')->_set_page_tags($this->input->post('search_tags'), (int) $page['id']);

        /** Init CMS Events system */
        Events::create()->registerEvent($page, 'Page:update');
    }

    /**
     * Translit title to url
     */
    public function ajax_translit() {

        echo $this->createUrl($this->input->post('str'));
    }

    public function save_positions() {

        foreach ($this->input->post('pages_pos') as $k => $v) {
            $item = explode('_', substr($v, 4));

            $data = ['position' => $k];
            $this->db->where('id', $item[0]);
            //            $this->db->or_where('lang_alias', $item[1]);
            $this->db->update('content', $data);
        }
    }

    public function delete_pages() {

        $ids = $this->input->post('pages');

        if (count($ids) > 0) {
            foreach ($ids as $v) {
                $page_id = substr($v, 5);
                $res[$page_id] = $this->delete($page_id, FALSE);
            }
        }

        if (in_array(false, $res)) {
            showMessage(lang('Can not delete main page', 'admin'), lang('Message'), 'r');
        }
        if (in_array(true, $res)) {
            showMessage(lang('Successful delete', 'admin'));
        }
        pjax($this->input->server('HTTP_REFERER'));
    }

    /**
     * Delete page
     *
     * @access public
     * @param string $page_id
     * @param bool $show_messages
     * @return bool
     */
    public function delete($page_id, $show_messages = TRUE) {

        //cp_check_perm('page_delete');

        $settings = $this->cms_admin->get_settings();

        if ($settings['main_page_id'] == $page_id AND $settings['main_type'] == 'page') {
            return FALSE;
        }

        $this->db->where('id', $page_id);
        $query = $this->db->get('content', 1);
        $page = $query->row_array();

        if ($page['lang_alias'] == 0) {
            $this->db->where('id', $page['id']);
            $this->db->delete('content');

            $this->db->where('lang_alias', $page['id']);
            $this->db->delete('content');

            $this->on_page_delete($page['id']);

            if ($show_messages == TRUE) {
                showMessage(lang('Page has been deleted.', 'admin'));
                updateDiv('page', site_url('admin/pages/GetPagesByCategory/' . $page['category']));
            }
            return TRUE;
        }

        $root_page = $this->cms_admin->get_page($page['lang_alias']);

        //         delete page
        $this->db->where('id', $page['id']);
        $this->db->delete('content');

        $this->on_page_delete($page_id);

        if ($show_messages == TRUE) {
            showMessage(lang('Page has been deleted.', 'admin'));
            updateDiv('page', site_url('admin/pages/edit/' . $root_page['id'] . '/' . $root_page['lang']));
        }
    }

    /**
     * This event occurs right after page deleted
     * @param integer $page_id
     */
    private function on_page_delete($page_id) {

        $this->db->where('item_id', $page_id);
        $this->db->where('item_type', 'page');
        $this->db->delete('content_fields_data');
        $this->cache->delete('cfcm_field_' . $page_id . 'page');

        $this->lib_admin->log(lang('Deleted ID page', 'admin') . ' ' . $page_id);

        // Delete content_permissions
        $this->db->where('page_id', $page_id);
        $this->db->delete('content_permissions');

        // Delete page tags
        $this->load->module('tags')->_remove_orphans($page_id);

        /** Init CMS Events system */
        Events::create()->registerEvent(['pageId' => $page_id, 'userId' => $this->dx_auth->get_user_id()], 'Page:delete');
    }

    /**
     * @param string $action
     */
    public function move_pages($action) {

        $ids = $this->input->post('pages');
        $ids_key = array_flip($this->input->post('pages'));

        $this->db->select('category');
        $page = $this->db->get_where('content', ['id' => substr($this->input->post('pages')[0], 5)])->row_array();

        if ((int) $this->input->post('new_cat') > 0) {
            $category = $this->lib_category->get_category($this->input->post('new_cat'));
        } else {
            $category['id'] = 0;
            $category['path_url'] = '';
        }

        if (count($ids) > 0) {
            foreach ($ids as $v) {
                $page_id = substr($v, 5);

                $data = [
                         'category' => $category['id'],
                         'cat_url'  => $category['path_url'],
                        ];

                switch ($action) {
                    case 'move':
                        $this->db->where('id', $page_id);
                        $this->db->update('content', $data);

                        $this->db->where('lang_alias', $page_id);
                        $this->db->update('content', $data);

                        break;

                    case 'copy':
                        $page = $this->db->get_where('content', ['id' => $page_id])->row_array();
                        $page['category'] = $data['category'];
                        $page['cat_url'] = $data['cat_url'];
                        $page['lang_alias'] = 0;
                        $page['comments_count'] = 0;

                        $this->db->like('url', $page['url']);
                        $new_url = $this->db->get('content')->num_rows();

                        $page['url'] .= $new_url + 1;

                        unset($page['id']);

                        $this->db->insert('content', $page);
                        $new_id = $this->db->insert_id();
                        $this->_copy_content_fields($page_id, $new_id);

                        // Copy page to other languages
                        $pages = $this->db->get_where('content', ['lang_alias' => $page_id])->result_array();

                        foreach ($pages as $page) {
                            unset($page['id']);
                            $page['category'] = $data['category'];
                            $page['cat_url'] = $data['cat_url'];
                            $page['comments_count'] = 0;
                            $page['lang_alias'] = $new_id;
                            $page['url'] = $page['url'] . time();
                            $this->db->insert('content', $page);
                            $this->_copy_content_fields($page_id, $this->db->insert_id());
                        }

                        break;
                }
            }
            $catName = $category['name'] ? ' -> ' . $category['name'] : '';
            if ($action == 'copy') {
                showMessage(lang('Page successfuly copied', 'admin'));
                $this->lib_admin->log(lang('Pages was copied', 'admin') . '. Id: ' . implode(', ', $ids_key) . '' . $catName);
            } else if ($action == 'move') {
                showMessage(lang('Successfull moving', 'admin'));
                $this->lib_admin->log(lang('Pages was moving', 'admin') . '. Id: ' . implode(', ', $ids_key) . '' . $catName);
            }
            pjax($this->input->server('HTTP_REFERER'));
        } else {
            showMessage(lang('The operation error', 'admin'));
        }
    }

    /**
     * Copy content field on page copy
     * @param $page_id
     * @param string $original_id
     */
    protected function _copy_content_fields($original_id, $new_id) {

        $fields = $this->db->get_where('content_fields_data', ['item_id' => $original_id, 'item_type' => 'page'])->result_array();

        foreach ($fields as $field) {
            unset($field['id']);
            $field['item_id'] = $new_id;
            $this->db->insert('content_fields_data', $field);
        }
    }

    /**
     * Display window to move pages to some category
     * @param string $action
     */
    public function show_move_window($action = 'move') {

        $this->template->assign('action', $action);
        $this->template->assign('tree', $this->lib_category->build());
        $this->template->show('move_pages', FALSE);
    }

    /**
     * Return tags in JSON
     */
    public function json_tags() {

        $this->load->module('tags');
        $new_tags = [];

        $search = $this->input->post('search_tags');

        if (mb_strlen($search) > 1) {
            $tags = $this->tags->search_tags($search);

            foreach ($tags as $tag) {
                $new_tags[] = $tag['value'];
            }

            echo json_encode(array_unique($new_tags));
        }
    }

    /**
     * Create keywords
     */
    public function ajax_create_keywords() {

        $text = $this->input->post('keys');

        if ($text == '') {
            echo lang('Zero-length string', 'admin');
            return;
        }

        $keywords = $this->lib_seo->get_keywords($text, TRUE);

        foreach ($keywords as $key => $val) {
            if ($val < 3) {
                $size = 14 + $val;
            }

            if ($val == 1) {
                $size = 12;
            }

            if ($val == 4) {
                $size = 13;
            }

            if ($val > 3) {
                $size = 22;
            }

            $append = $key . ', ';
            echo '<a class="underline" onclick="$(\'#page_keywords\').append(\'' . $append . '\' );" style="font-size:' . $size . 'px">' . $key . '</a> &nbsp;';
        }
    }

    /**
     * Create description
     */
    public function ajax_create_description() {

        $desc = $this->lib_seo->get_description($this->input->post('text'));
        echo $desc;
    }

    /**
     * Change page post_status
     */
    public function ajax_change_status($page_id) {

        $exsists = true;
        $page = $this->cms_admin->get_page($page_id);

        switch ($page['post_status']) {
            case 'publish':
                //$data = array('post_status' => 'pending');
                $data = $page;
                $data['post_status'] = 'draft';
                $this->cms_admin->update_page($page['id'], $data, $exsists);
                break;

            case 'pending':
                $data = $page;
                $data['post_status'] = 'publish';
                $this->cms_admin->update_page($page['id'], $data, $exsists);

                break;

            case 'draft':
                $data = $page;
                $data['post_status'] = 'publish';
                $this->cms_admin->update_page($page['id'], $data, $exsists);

                break;
            default :
                $data = $page;
                $data['post_status'] = 'publish';
                $this->cms_admin->update_page($page['id'], $data, $exsists);
                break;
        }
        showMessage(lang('Status change success', 'admin'));
    }

    /**
     * Display pages by Category ID
     *
     * @access public
     * @cat_id int
     * @cur_page int
     */
    public function GetPagesByCategory($cat_id = 'all', $pagination = null) {

        //////**********  Pagination pages **********\\\\\\\
        if ($pagination) {
            $paginationSession = ['pages_pag_url' => $pagination];
            $this->session->set_userdata($paginationSession);
        } else {
            $this->session->unset_userdata('pages_pag_url');
        }

        $def_lang = $this->cms_admin->get_default_lang();
        CI::$APP->config->set_item('cur_lang', $def_lang['id']);
        if ($cat_id != 'all') {
            $db_where = [
                         'category' => $cat_id,
                //'lang_alias' => 0,
                         'lang'     => (int) $def_lang['id'],
                        ];
        } else {
            //$this->db->select('content.*, category.name as cat_name');
            $db_where = [
                         'category >=' => 0,
                //'lang_alias' => 0,
                         'lang'        => (int) $def_lang['id'],
                        ];
        }
        $main_settings = $this->cms_base->get_settings();

        $offset = $this->uri->segment(5);
        $offset == FALSE ? $offset = 0 : TRUE;

        $row_count = $this->_Config['per_page'];

        if ($cat_id != 'all') {
            $category = $this->lib_category->get_category($cat_id);
        }

        //$this->db->order_by('category', 'asc');
        $this->db->order_by('content.position', 'asc');
        $this->db->order_by('content.id', 'desc');

        //filter
        if ($this->input->post('id')) {
            $this->db->where('content.id', $this->input->post('id'));
            $flagPOST = true;
        }
        if ($this->input->post('title')) {
            $this->db->where('content.title LIKE ', '%' . $this->input->post('title') . '%');
            $flagPOST = true;
        }
        if ($this->input->post('url')) {
            $this->db->where('content.url LIKE ', '%' . $this->input->post('url') . '%');
            $flagPOST = true;
        }

        if ($cat_id == NULL) {
            $this->db->join('category', 'category.id = content.category');
        }

        if (!$flagPOST) {
            $query = $this->db->get_where('content', $db_where, $row_count, $offset);
        } else {
            $query = $this->db->get_where('content', $db_where);
        }
        $this->db->where($db_where);
        $this->db->from('content');
        $total_pages = $this->db->count_all_results();

        if ($query->num_rows > 0) {
            // При пагинации при поиске ломался поиск.
            if (!$flagPOST) {
                // Begin pagination
                $config['base_url'] = site_url('admin/pages/GetPagesByCategory/' . $cat_id . '/');
                $config['container'] = 'page';
                $config['uri_segment'] = 5;
                $config['total_rows'] = $total_pages;
                $config['per_page'] = $this->_Config['per_page'];

                $config['separate_controls'] = true;
                $config['full_tag_open'] = '<div class="pagination pull-left"><ul>';
                $config['full_tag_close'] = '</ul></div>';
                $config['controls_tag_open'] = '<div class="pagination pull-right"><ul>';
                $config['controls_tag_close'] = '</ul></div>';
                $config['next_link'] = lang('Next', 'admin') . '&nbsp;&gt;';
                $config['prev_link'] = '&lt;&nbsp;' . lang('Prev', 'admin');
                $config['cur_tag_open'] = '<li class="btn-primary active"><span>';
                $config['cur_tag_close'] = '</span></li>';
                $config['prev_tag_open'] = '<li>';
                $config['prev_tag_close'] = '</li>';
                $config['next_tag_open'] = '<li>';
                $config['next_tag_close'] = '</li>';
                $config['num_tag_close'] = '</li>';
                $config['num_tag_open'] = '<li>';
                $config['num_tag_close'] = '</li>';

                $this->pagination->num_links = 5;
                $this->pagination->initialize($config);
                // End pagination
            }

            $pages = $query->result_array();

            $catsQuery = $this->db->get('category');
            $allCats = $catsQuery->result_array();

            $this->template->add_array(
                [
                 'paginator'     => $this->pagination->create_links_ajax(),
                 'total_pages'   => $total_pages,
                 'pages'         => $pages,
                 'cat_id'        => $cat_id,
                 'category'      => $category,
                 'cats'          => $allCats,
                 'tree'          => $this->lib_category->build(),
                 'show_cat_list' => $main_settings['cat_list'],
                ]
            );
            $this->template->show('pages_list', FALSE);
        } else {

            $this->template->add_array(
                [
                 'no_pages'      => TRUE,
                 'category'      => $category,
                 'total_pages'   => $total_pages,
                 'tree'          => $this->lib_category->build(),
                 'cat_id'        => $cat_id,
                 'show_cat_list' => $main_settings['cat_list'],
                ]
            );

            $this->template->show('pages_list', FALSE);
        }
    }

}