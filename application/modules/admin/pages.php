<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//class Pages extends MY_Controller {
class Pages extends BaseAdminController {

    public $_Config = array(
        'per_page' => 20 // Show news per one page
    );

    function __construct() {
        parent::__construct();

        $this->load->library('DX_Auth');
        admin_or_redirect();

        $this->load->library('lib_admin');
        $this->load->library('lib_category');
        $this->load->library('pagination');
        $this->load->library('lib_seo');
        $this->lib_admin->init_settings();


//
//        $this->load->library('gettext_php/gettext_extension', array(
//            'directory' => 'application/language/admin',
//            'domain'    => 'messages',
//            'locale'    => 'ru'
//        ));
//
//        $this->gettext = $this->gettext_extension->getInstance('application/language/admin', 'messages', 'ru');
//        unset($this->gettext_extension);
        //var_dump($this->gettext);
        //var_dump($this->gettext->gettext('Page creation'));
        //$this->lang->load_gettext('ru','utf-8', 'messages', 'application/language/admin');
    }

    function index($params = array()) {

        ////cp_check_perm('page_create');
        // Set roles
        $locale = $this->cms_admin->get_default_lang();
        $locale = $locale['identif'];

        $query = $this->db->query("SELECT * FROM `shop_rbac_roles` JOIN `shop_rbac_roles_i18n` ON shop_rbac_roles.id=shop_rbac_roles_i18n.id WHERE `locale`='" . $locale . "'");
        $this->template->assign('roles', $query->result_array());

        $uri_segs = $this->uri->uri_to_assoc(2);

        $this->template->add_array(array(
            'tree' => $this->lib_category->build(), // Load category tree
            'cur_time' => date('H:i:s'),
            'cur_date' => date('Y-m-d'),
            'sel_cat' => $uri_segs['category']
        ));
        /** Init Event. Pre Create Page */
        \CMSFactory\Events::create()->registerEvent('', 'BaseAdminPage:preCreate');
        \CMSFactory\Events::runFactory();

        ($hook = get_hook('admin_show_add_page')) ? eval($hook) : NULL;

        $this->template->show('add_page', FALSE);
    }

    /*     * **************************************************
     * PAGE EVENTS
     * ************************************************* */

    /**
     * This event occurs right after page inserted in DB
     */
    private function on_page_add($page) {
        ($hook = get_hook('admin_on_page_add')) ? eval($hook) : NULL;

        /** Set page roles */
        $this->_set_page_roles($page['id'], $this->input->post('roles'));

        /** Set page tags */
        $this->load->module('tags')->_set_page_tags($_POST['search_tags'], $page['id']);

        /** Init CMS Events system */
        \CMSFactory\Events::create()->registerEvent($page, 'Page:create');
    }

    /**
     * This event occurs right after page updated
     */
    private function on_page_update($page) {
        ($hook = get_hook('admin_on_page_update')) ? eval($hook) : NULL;

        /** Update page roless */
        $this->_set_page_roles($page['id'], $this->input->post('roles'));

        /** Update page tags */
        $this->load->module('tags')->_set_page_tags($_POST['search_tags'], (int) $page['id']);

        /** Init CMS Events system */
        \CMSFactory\Events::create()->registerEvent($page, 'Page:update');
    }

    /**
     * This event occurs right after page deleted
     */
    private function on_page_delete($page_id) {
        ($hook = get_hook('admin_on_page_delete')) ? eval($hook) : NULL;

        $this->lib_admin->log(lang("Deleted ID page", "admin") . " " . $page_id);

        // Delete content_permissions
        $this->db->where('page_id', $page_id);
        $this->db->delete('content_permissions');

        // Delete page tags
        $this->db->where('page_id', $page_id);
        $this->db->delete('content_tags');

        $this->load->module('tags')->_remove_orphans();

        /** Init CMS Events system */
        \CMSFactory\Events::create()->registerEvent(array('pageId' => $page_id, 'userId' => $this->dx_auth->get_user_id()), 'Page:delete');
    }

    /*     * **************************************************
     * END PAGE EVENTS
     * ************************************************* */

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

    /**
     * Add new page
     * Language default
     */
    public function add() {

        //cp_check_perm('page_create');

        $this->form_validation->set_rules('page_title', lang("Title", "admin"), 'trim|required|min_length[1]|max_length[500]');
        $this->form_validation->set_rules('page_url', lang("URL", "admin"), 'alpha_dash');
        $this->form_validation->set_rules('prev_text', lang("Preliminary contents", "admin"), 'trim|required');
        $this->form_validation->set_rules('page_description', lang("Description ", "admin"), 'trim');
        $this->form_validation->set_rules('full_tpl', lang("Page template", "admin"), 'trim|max_length[150]|min_length[2]|callback_tpl_validation');
        $this->form_validation->set_rules('create_date', lang("Creation date", "admin"), 'required|valid_date');
        $this->form_validation->set_rules('create_time', lang("Creation time", "admin"), 'required|valid_time');
        $this->form_validation->set_rules('publish_date', lang("Publication date", "admin"), 'required|valid_date');
        $this->form_validation->set_rules('publish_time', lang("Publication time", "admin"), 'required|valid_time');

        $this->form_validation->set_rules('main_tpl', lang("Main page template", "admin"), 'trim|max_length[50]|min_length[2]|callback_tpl_validation');

        $groupId = (int) $this->input->post('cfcm_use_group');

        ($hook = get_hook('cfcm_set_rules')) ? eval($hook) : NULL;

        if ($this->form_validation->run($this) == FALSE) {
            ($hook = get_hook('admin_page_add_val_failed')) ? eval($hook) : NULL;
            $error = $this->form_validation->error_string('<p>', '</p>');

            showMessage(lang('From validation error: <br />', 'admin') . $error, false, 'r');
        } else {
            // load site settings
            $settings = $this->cms_admin->get_settings();

            $def_lang = $this->cms_admin->get_default_lang();

            if ($this->input->post('page_url') == '' or $this->input->post('page_url') == NULL) {
                $this->load->helper('translit');
                $url = translit_url($this->input->post('page_title'));
            } else {
                $url = $this->input->post('page_url');
            }

            // check if we have existing module with entered URL
            $this->db->where('name', $url);
            $query = $this->db->get('components');

            if ($query->num_rows() > 0) {
                showMessage(lang("Reserved the same name module", "admin"), false, 'r');
                exit;
            }
            // end module check
            // check if we have existing category with entered URL
            $this->db->where('url', $url);
            $query = $this->db->get('category', 1);

            if ($query->num_rows() > 0) {
                showMessage(lang("Reserved of the same name category", "admin"), false, 'r');
                exit;
            }
            // end check
            // check if we have existing page with entered URL
            $this->db->select('id, lang, url');
            $this->db->where('url', $url);
            $this->db->where('lang', $def_lang['id']);
            $this->db->where('category', $this->input->post('category'));
            $query = $this->db->get('content', 1);

            if ($query->num_rows() > 0) {
                showMessage(lang("Page with the same URL has been created yet. Specify or select another URL"), false, 'r');
                exit;
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


            $data = array(
                'title' => trim($this->input->post('page_title')),
                'meta_title' => trim($this->input->post('meta_title')),
                'url' => str_replace('.', '', trim($url)), //Delete dots from url
                'cat_url' => $full_url,
                'keywords' => $keywords,
                'description' => $description,
                //'full_text' => htmlspecialchars(trim($this->input->post('full_text'))),
                'full_text' => trim($this->input->post('full_text')),
                'prev_text' => trim($this->lib_admin->db_post('prev_text')),
                //'prev_text' => htmlspecialchars(trim($this->lib_admin->db_post('prev_text'))),
                'category' => $this->input->post('category'),
                'full_tpl' => $_POST['full_tpl'],
                'main_tpl' => $_POST['main_tpl'],
                'comments_status' => $this->input->post('comments_status'),
                'post_status' => $this->input->post('post_status'),
                'author' => $this->dx_auth->get_username(),
                'publish_date' => strtotime($publish_date),
                'created' => strtotime($create_date),
                'lang' => $def_lang['id']
            );


            //($hook = get_hook('admin_page_insert')) ? eval($hook) : NULL;

            $page_id = $this->cms_admin->add_page($data);

            $data['id'] = $page_id;

            $this->load->module('cfcm')->save_item_data($page_id, 'page');

            $this->cache->delete_all();

            $this->on_page_add($data);

            $this->lib_admin->log(
                    lang("Created a page", "admin") . " " .
                    '<a href="' . site_url('admin/pages/edit/' . $page_id) . '">' . $data['title'] . '</a>'
            );

            $action = $this->input->post('action');
            $path = '/admin/pages/GetPagesByCategory';

            if ($action == 'edit')
                $path = '/admin/pages/edit/' . $page_id;

            showMessage(lang("Page has been created", "admin"));
            pjax($path);
        }
    }

    /*
     * Set roles for page
     */

    function _set_page_roles($page_id, $roles) {
        ($hook = get_hook('admin_page_set_roles')) ? eval($hook) : NULL;

        //if ( count($roles) > 0 )
        if ($roles[0] != '') {
            $page_roles = array();

            foreach ($roles as $k) {
                $data = array('role_id' => $k);
                array_push($page_roles, $data);
            }

            $n_data = array('page_id' => $page_id,
                'data' => serialize($page_roles));

            // Delete page roles
            $this->db->where('page_id', $page_id);
            $this->db->delete('content_permissions');

            // Insert new page roles
            $this->db->insert('content_permissions', $n_data);
        } else {

            if ($this->db->get_where('content_permissions', array('page_id' => $page_id))->num_rows() > 0) {
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
     */
    function edit($page_id, $lang = 0) {
        //cp_check_perm('page_edit');
        if ($this->cms_admin->get_page($page_id) == FALSE) {
            showMessage(lang("Page", "admin") . $page_id . lang("Not found", "admin"), false, 'r');
            exit;
        }

        $def_lang = $this->cms_admin->get_default_lang();

        // Get page data
        $data = $this->db->get_where('content', array('id' => $page_id))->row_array();


        if ($data['lang_alias'] != 0)
            redirect('/admin/pages/edit/' . $data['lang_alias'] . '/' . $data['lang']);

        if ($lang != 0 AND $lang != $data['lang']) {
            $data = $this->db->get_where('content', array('lang_alias' => $page_id, 'lang' => $lang));

            if ($data->num_rows() > 0) {
                $data = $data->row_array();
            } else {
                $data = FALSE;
            }
        }
        /** Init Event. Pre Edit Page */
        \CMSFactory\Events::create()->registerEvent(array('pageId' => $page_id), 'BaseAdminPage:preUpdate');
        \CMSFactory\Events::runFactory();

        ($hook = get_hook('admin_page_edit_found')) ? eval($hook) : NULL;

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
            $locale = $this->cms_admin->get_default_lang();
            $locale = $locale['identif'];

            $g_query = $this->db->query("SELECT * FROM `shop_rbac_roles` JOIN `shop_rbac_roles_i18n` ON shop_rbac_roles.id=shop_rbac_roles_i18n.id WHERE `locale`='" . $locale . "'");
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

            if (count($langs) > 1)
                $this->template->assign('show_langs', 1);

            // Load category
            $category = $this->lib_category->get_category($data['category']);

            $this->template->add_array(array(
                'page_lang' => $data['lang'],
                'page_identif' => $data[identif],
                'tree' => $this->lib_category->build(),
                'parent_id' => $data['category'],
                'langs' => $langs,
                'defLang' => $def_lang,
                'category' => $category
            ));

            if ($data['lang_alias'] != 0) {
                $orig_page = $this->cms_admin->get_page($data['lang_alias']);

                $this->template->assign('orig_page', $orig_page);
            }

            ($hook = get_hook('admin_show_edit_page_tpl')) ? eval($hook) : NULL;

            $this->template->show('edit_page', FALSE);
        } else {

            // create page copy for $lang
            $cur_lang = $this->cms_admin->get_lang($lang);

            if ($cur_lang != FALSE) { // lang exists
                $defpage = $this->cms_admin->get_page($page_id);

                $new_data = array(
                    'author' => $this->dx_auth->get_username(),
                    'comments_status' => $defpage['comments_status'],
                    'category' => $defpage['category'],
                    'cat_url' => $defpage['cat_url'],
                    'url' => $defpage['url'],
                    'created' => $defpage['created'],
                    'publish_date' => $defpage['publish_date'],
                    'post_status' => $defpage['post_status'],
                    'lang' => $lang,
                    'lang_alias' => $defpage['id'],
                    'full_tpl' => $defpage['full_tpl'],
                    'main_tpl' => $defpage['main_tpl'],
                );

                ($hook = get_hook('admin_page_create_empty_translation')) ? eval($hook) : NULL;

                $new_p_id = $this->cms_admin->add_page($new_data);

                if ($new_p_id > 0) {
                    showMessage(lang("Language of the page", "admin") . '<b>' . $cur_lang['lang_name'] . '</b>' . lang("Created. ID") . '<b>' . $new_p_id . '</b>');
                    if ($this->pjaxRequest)
                        pjax('/admin/pages/edit/' . $page_id . '/' . $lang);
                    else
                        redirect('/admin/pages/edit/' . $page_id . '/' . $lang);
                    //exit;
                } else {
                    die('Cant get page id!');
                }
            }
        }
    }

    /**
     * Update existing page by ID
     *
     * @access public
     */
    function update($page_id) {
        //cp_check_perm('page_edit');

        $this->form_validation->set_rules('page_title', lang("Title", "admin"), 'trim|required|min_length[1]|max_length[500]');
        $this->form_validation->set_rules('page_url', lang("URL", "admin"), 'alpha_dash');
        $this->form_validation->set_rules('page_keywords', lang("Keywords", "admin"), 'trim');
        $this->form_validation->set_rules('prev_text', lang("Preliminary contents", "admin"), 'trim|required');
        $this->form_validation->set_rules('page_description', lang("Description ", "admin"), 'trim');
        $this->form_validation->set_rules('full_tpl', lang("Page template", "admin"), 'trim|max_length[50]|min_length[2]|callback_tpl_validation');
        $this->form_validation->set_rules('main_tpl', lang("Main page template ", "admin"), 'trim|max_length[50]|min_length[2]|callback_tpl_validation'); 
        $this->form_validation->set_rules('create_date', lang("Creation date", "admin"), 'required|valid_date');
        $this->form_validation->set_rules('create_time', lang("Creation time", "admin"), 'required|valid_time');
        $this->form_validation->set_rules('publish_date', lang("Publication date", "admin"), 'required|valid_date');
        $this->form_validation->set_rules('publish_time', lang("Publication time", "admin"), 'required|valid_time');

        ($hook = get_hook('admin_page_update_set_rules')) ? eval($hook) : NULL;

        $groupId = (int) $this->input->post('cfcm_use_group');

        ($hook = get_hook('cfcm_set_rules')) ? eval($hook) : NULL;

        if ($this->form_validation->run($this) == FALSE) {
            ($hook = get_hook('admin_page_update_val_failed')) ? eval($hook) : NULL;
            showMessage(validation_errors(), false, 'r');
        } else {

            // load site settings
            $settings = $this->cms_admin->get_settings();

            if ($this->input->post('page_url') == '' or $this->input->post('page_url') == NULL) {
                $this->load->helper('translit');
                $url = translit_url($this->input->post('page_title'));
            } else {
                $url = $this->input->post('page_url');
            }


            // check if we have existing module with entered URL
            $this->db->where('name', $url);
            $query = $this->db->get('components');

            if ($query->num_rows() > 0) {
                showMessage(lang("Reserved the same name module", "admin"), false, 'r');
                exit;
            }
            // end module check
            // check if we have existing category with entered URL
            $this->db->where('url', $url);
            $query = $this->db->get('category', 1);

            if ($query->num_rows() > 0) {
                showMessage(lang("Reserved of the same name category", "admin"), false, 'r');
                exit;
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
                showMessage(lang("Page with URL", "admin") . '<b>' . $url . '</b>' . lang("in ID category", "admin") . $this->input->post('category') . lang(" already exists. Specify or select another URL"), false, 'r');
                exit;
            }
            // end check

            $full_url = $this->lib_category->GetValue($this->input->post('category'), 'path_url');

            if ($full_url == FALSE) {
                $full_url = '';
            }

            $keywords = $this->lib_admin->db_post('page_keywords');
            $description = $this->lib_admin->db_post('page_description');

            // create keywords
//            if ($keywords == '' AND $settings['create_keywords'] == 'auto') {
//                $keywords = $this->lib_seo->get_keywords($this->input->post('prev_text') . ' ' . $this->input->post('full_text'));
//            }
            // create description
//            if ($description == '' AND $settings['create_description'] == 'auto') {
//                $description = $this->lib_seo->get_description($this->input->post('prev_text') . ' ' . $this->input->post('full_text'));
//            }
//            mb_substr($keywords, -1) == ',' ? $keywords = mb_substr($keywords, 0, -1) : TRUE;

            $publish_date = $this->input->post('publish_date') . ' ' . $this->input->post('publish_time');
            $create_date = $this->input->post('create_date') . ' ' . $this->input->post('create_time');

            $data = array(
                'title' => trim($this->input->post('page_title')),
                'meta_title' => trim($this->input->post('meta_title')),
                'url' => str_replace('.', '', trim($url)), //Delete dots from url
                'cat_url' => $full_url,
                'keywords' => $keywords,
                'description' => $description,
                'full_text' => trim($this->input->post('full_text')),
                'prev_text' => trim($this->lib_admin->db_post('prev_text')),
                'category' => $this->input->post('category'),
                'full_tpl' => $_POST['full_tpl'],
                'main_tpl' => $_POST['main_tpl'],
                'comments_status' => $this->input->post('comments_status'),
                'post_status' => $this->input->post('post_status'),
                'author' => $this->dx_auth->get_username(),
                'publish_date' => strtotime($publish_date),
                'created' => strtotime($create_date),
                'updated' => time()
            );

            $data['id'] = $page_id;
            $this->on_page_update($data);

            $this->load->module('cfcm')->save_item_data($page_id, 'page');

            $this->cache->delete_all();

            //($hook = get_hook('admin_page_update')) ? eval($hook) : NULL;

            if ($this->cms_admin->update_page($page_id, $data) >= 1) {
                $this->lib_admin->log(
                        lang("Changed the page", "admin") . " " .
                        '<a href="' . site_url('admin/pages/edit/' . $page_id) . '">' . $data['title'] . '</a>'
                );

                $action = $this->input->post('action');
                $path = '/admin/pages/GetPagesByCategory';

                if ($action == 'edit')
                    $path = '/admin/pages/edit/' . $page_id;

                showMessage(lang("Page contents have been updated", "admin"));
                pjax($path);
            } else {
                showMessage('', false, 'r');
            }
        }
    }

    /**
     * Delete page
     *
     * @access public
     */
    function delete($page_id, $show_messages = TRUE) {
        //cp_check_perm('page_delete');

        $settings = $this->cms_admin->get_settings();

        if ($settings['main_page_id'] == $page_id AND $settings['main_type'] == 'page') {
            jsCode("alertBox.alert(" . lang("Error: Generic page can not be deleted.") . ");");
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
                showMessage(lang("Page has been deleted.", "admin"));
                updateDiv('page', site_url('admin/pages/GetPagesByCategory/' . $page['category']));
            }
            return TRUE;
        }

        $root_page = $this->cms_admin->get_page($page['lang_alias']);

        ($hook = get_hook('admin_page_delete')) ? eval($hook) : NULL;

        // delete page
        $this->db->where('id', $page['id']);
        $this->db->delete('content');

        $this->on_page_delete($page_id);

        if ($show_messages == TRUE) {
            showMessage(lang("Page has been deleted.", "admin"));
            updateDiv('page', site_url('admin/pages/edit/' . $root_page['id'] . '/' . $root_page['lang']));
        }
    }

    /**
     * Transilt title to url
     */
    function ajax_translit() {
        $this->load->helper('translit');
        $str = trim($this->input->post('str'));
        echo translit_url($str);
    }

    function save_positions() {
        //cp_check_perm('page_edit');

        ($hook = get_hook('admin_update_page_positions')) ? eval($hook) : NULL;

        foreach ($_POST['pages_pos'] as $k => $v) {
            $item = explode('_', substr($v, 4));

            $data = array(
                'position' => $k
            );
            $this->db->where('id', $item[0]);
            $this->db->or_where('lang_alias', $item[1]);
            $this->db->update('content', $data);
        }
    }

    function delete_pages() {
        //cp_check_perm('page_delete');

        $ids = $_POST['pages'];

        ($hook = get_hook('admin_pages_delete_many')) ? eval($hook) : NULL;

        if (count($ids) > 0) {
            foreach ($ids as $k => $v) {
                $page_id = substr($v, 5);
                $this->delete($page_id, FALSE);
            }
        }

        showMessage(lang("Successful delete", "admin"));
        pjax($_SERVER["HTTP_REFERER"]);
    }

    function move_pages($action) {
        //cp_check_perm('page_edit');

        $ids = $_POST['pages'];

        $this->db->select('category');
        $page = $this->db->get_where('content', array('id' => substr($_POST['pages'][0], 5)))->row_array();

        if ((int) $_POST['new_cat'] > 0)
            $category = $this->lib_category->get_category($_POST['new_cat']);
        else {
            $category['id'] = 0;
            $category['path_url'] = '';
        }


        if (count($ids) > 0) {
            foreach ($ids as $k => $v) {
                $page_id = substr($v, 5);

                $data = array(
                    'category' => $category['id'],
                    'cat_url' => $category['path_url']
                );

                switch ($action) {
                    case 'move':
                        ($hook = get_hook('admin_pages_move')) ? eval($hook) : NULL;

                        $this->db->where('id', $page_id);
                        $this->db->update('content', $data);

                        $this->db->where('lang_alias', $page_id);
                        $this->db->update('content', $data);

                        break;

                    case 'copy':
                        $page = $this->db->get_where('content', array('id' => $page_id))->row_array();

                        $page['category'] = $data['category'];
                        $page['cat_url'] = $data['cat_url'];
                        $page['lang_alias'] = 0;
                        $page['comments_count'] = 0;

                        $this->db->like('url', $page['url']);
                        $new_url = $this->db->get('content')->num_rows();

                        $page['url'] .= $new_url + 1;

                        unset($page['id']);

                        ($hook = get_hook('admin_pages_copy')) ? eval($hook) : NULL;

                        $this->db->insert('content', $page);
                        $new_id = $this->db->insert_id();
                        $this->_copy_content_fields($page_id, $new_id);

                        // Copy page to other languages
                        $pages = $this->db->get_where('content', array('lang_alias' => $page_id))->result_array();

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

            if ($action == 'copy')
                showMessage('Successful copying');
            else if ($action == 'move')
                showMessage(lang("Successfull moving", "admin"));
            pjax($_SERVER["HTTP_REFERER"]);
        }
        else
            showMessage(lang("The operation error", "admin"));
    }

    /**
     * Copy content field on page copy
     * @param $page_id
     */
    protected function _copy_content_fields($original_id, $new_id) {
        $fields = $this->db->get_where('content_fields_data', array('item_id' => $original_id, 'item_type' => 'page'))->result_array();

        foreach ($fields as $field) {
            unset($field['id']);
            $field['item_id'] = $new_id;
            $this->db->insert('content_fields_data', $field);
        }
    }

    /**
     * Display window to move pages to some category
     */
    function show_move_window($action = 'move') {
        $this->template->assign('action', $action);
        $this->template->assign('tree', $this->lib_category->build());
        $this->template->show('move_pages', FALSE);
    }

    /**
     * Return tags in JSON
     */
    function json_tags() {
        $this->load->module('tags');
        $new_tags = array();

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
    function ajax_create_keywords() {
        $text = $this->input->post('keys');

        if ($text == '') {
            echo lang("Zero-length string", 'admin');
            exit;
        }

        $keywords = $this->lib_seo->get_keywords($text, TRUE);

        foreach ($keywords as $key => $val) {
            if ($val < 3)
                $size = 14 + $val;

            if ($val == 1)
                $size = 12;

            if ($val == 4)
                $size = 13;

            if ($val > 3)
                $size = 22;

            $append = $key . ', ';
            echo '<a class="underline" onclick="$(\'#page_keywords\').append(\'' . $append . '\' );" style="font-size:' . $size . 'px">' . $key . '</a> &nbsp;';
        }
    }

    /**
     * Create description
     */
    function ajax_create_description() {
        $desc = $this->lib_seo->get_description($this->input->post('text'));
        echo $desc;
    }

    /**
     * Change page post_status
     */
    function ajax_change_status($page_id) {
        //cp_check_perm('page_edit');

        $page = $this->cms_admin->get_page($page_id);
//        var_dump($page);

        ($hook = get_hook('admin_page_change_status')) ? eval($hook) : NULL;

        switch ($page['post_status']) {
            case 'publish':
                //$data = array('post_status' => 'pending');
                $data = $page;
                $data['post_status'] = 'draft';
                $this->cms_admin->update_page($page['id'], $data);
                /*
                  jsCode(" $('p_status_" . $page_id . "').src = theme + '/images/pending.png'; ");
                  jsCode(" $('p_status_" . $page_id . "').title = '" . lang("Pending approval","admin") . "'; ");
                 */
                break;

            case 'pending':
                //$data = array('post_status' => 'draft');
//                $data = array('post_status' => 'publish');
                $data = $page;
                $data['post_status'] = 'publish';
                $this->cms_admin->update_page($page['id'], $data);
                /*
                  jsCode(" $('p_status_" . $page_id . "').src = theme + '/images/draft.png'; ");
                  jsCode(" $('p_status_" . $page_id . "').title = '" . lang("Has not been published","admin") . "'; ");
                 */
                break;

            case 'draft':
                $data = $page;
                $data['post_status'] = 'publish';
                $this->cms_admin->update_page($page['id'], $data);
                /*
                  jsCode(" $('p_status_" . $page_id . "').src = theme + '/images/publish.png'; ");
                  jsCode(" $('p_status_" . $page_id . "').title = '" . lang("Has been published","admin") . "'; ");
                 */
                break;

            //For new admin interface
            default :
                $data = $page;
                $data['post_status'] = 'publish';
                $this->cms_admin->update_page($page['id'], $data);
                /*
                  jsCode(" $('p_status_" . $page_id . "').src = theme + '/images/publish.png'; ");
                  jsCode(" $('p_status_" . $page_id . "').title = '" . lang("Has been published","admin") . "'; ");
                 */
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
    function GetPagesByCategory($cat_id = 'all', $cur_page = 0) {
        if ($cat_id != 'all')
            $db_where = array(
                'category' => $cat_id,
                'lang_alias' => 0
            );
        else {
            //             /$this->db->select('content.*, category.name as cat_name');

            $db_where = array(
                'category >=' => 0,
                'lang_alias' => 0
            );
        }
        $main_settings = $this->cms_base->get_settings();

        ($hook = get_hook('admin_get_pages_by_cat')) ? eval($hook) : NULL;

        $offset = $this->uri->segment(5);
        $offset == FALSE ? $offset = 0 : TRUE;

        $row_count = $this->_Config['per_page'];

        if ($cat_id != 'all')
            $category = $this->lib_category->get_category($cat_id);

        //$this->db->order_by('category', 'asc');
        $this->db->order_by('content.position', 'asc');

        //filter
        if ($this->input->post('id'))
            $this->db->where('content.id', $this->input->post('id'));
        if ($this->input->post('title'))
            $this->db->where('content.title LIKE ', '%' . $this->input->post('title') . '%');
        if ($this->input->post('url'))
            $this->db->where('content.url LIKE ', '%' . $this->input->post('url') . '%');

        if ($cat_id == NULL)
            $this->db->join('category', 'category.id = content.category');

        $query = $this->db->get_where('content', $db_where, $row_count, $offset);

        $this->db->where($db_where);
        $this->db->from('content');
        $total_pages = $this->db->count_all_results();

        if ($query->num_rows > 0) {
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

            $pages = $query->result_array();

            $catsQuery = $this->db->get('category');
            $allCats = $catsQuery->result_array();

            $this->template->add_array(array(
                'paginator' => $this->pagination->create_links_ajax(),
                'pages' => $pages,
                'cat_id' => $cat_id,
                'category' => $category,
                'cats' => $allCats,
                'tree' => $this->lib_category->build(),
                'show_cat_list' => $main_settings['cat_list'],
            ));
            $this->template->show('pages_list', FALSE);
        } else {

            $this->template->add_array(array('no_pages' => TRUE,
                'category' => $category,
                'tree' => $this->lib_category->build(),
                'cat_id' => $cat_id,
                'show_cat_list' => $main_settings['cat_list'],
            ));
            $this->template->show('pages_list', FALSE);
        }
    }

}

/* End of pages.php */