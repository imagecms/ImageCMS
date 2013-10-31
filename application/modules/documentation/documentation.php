<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Module Frame 
 * @property Documentation_model $documentation_model
 */
class Documentation extends \MY_Controller {

    private $errors = false;
    private $defaultLang = false;

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('documentation');

        /** Load libraries, helpers and models * */
        $this->load->library('form_validation');
        $this->load->library('lib_category');

        $this->load->helper('translit');

        $this->load->model('documentation_model');
        $this->load->model('cms_admin');

        /** Get default lang * */
        $this->defaultLang = $this->cms_admin->get_default_lang();
    }

    /**
     * Autoload function
     */
    public function autoload() {
//        $this->recent_news();
//        $this->recent_forum();

        $top_menu = array(
            'begin-work' => 'Начало работы',
            'manage' => 'Администрирование',
            'step-by-step' => 'Пошаговые инструкции',
            'developers' => 'Разработчикам',
            'templates' => 'Работа с шаблонами',
        );
        
        \CMSFactory\assetManager::create()
                ->setData('hasCRUDAccess', $this->hasCRUDAccess())
                ->setData('top_menu', $top_menu);



        if (!$this->input->is_ajax_request()) {

            \CMSFactory\assetManager::create()
                    ->setData('hasCRUDAccess', $this->hasCRUDAccess());

            if ($this->hasCRUDAccess()) {
                \CMSFactory\assetManager::create()
                        ->registerStyle('documentation', TRUE)
                        ->registerScript('documentation', FALSE, 'before');
            }
        }
    }

    public function preTags($text) {
        if (strpos("<pre><code class='php'>") !== FALSE) {
            return $text;
        }
        return preg_replace_callback("/<pre>(.*?)[^>]<\/pre>/si", function($matches) {
                    return "<pre><code class='php'>" . htmlspecialchars($matches[1]) . "</code></pre>";
                }, $text);
    }

    public function hasCRUDAccess() {
        $settings = $this->documentation_model->getSettings();
        if (in_array($this->dx_auth->get_role_id(), $settings)) {
            return TRUE;
        }
        return FALSE;
    }

    /**
     * Create page
     * @param int $mainPageId
     * @param int $langId
     */
    public function create_new_page($mainPageId = 0, $langId = null) {

        /** If not langId then set default language id * */
        if ($langId == null) {
            $langId = $this->defaultLang['id'];
        }

        /** New page data from post array * */
        $dataPost = $this->input->post('NewPage');

        /** Register meta tags * */
        $this->template->registerMeta("ROBOTS", "NOINDEX, NOFOLLOW");

        $this->core->set_meta_tags(lang("Page Create", "documentation"));

        /** Set form validation rules * */
        $this->form_validation->set_rules('NewPage[title]', lang("Name", "documentation"), 'trim|required|min_length[1]|max_length[254]|xss_clean');
        $this->form_validation->set_rules('NewPage[url]', lang("URL", "documentation"), 'xss_clean|max_length[254]');
        $this->form_validation->set_rules('NewPage[prev_text]', lang("Content", "documentation"), 'trim|required|xss_clean');
        $this->form_validation->set_rules('NewPage[keywords]', lang("Keywords", "documentation"), 'xss_clean|trim');
        $this->form_validation->set_rules('NewPage[description]', lang("Description", "documentation"), 'xss_clean|trim');

        /** If not validation errors * */
        if ($dataPost != null && $this->form_validation->run() != FALSE) {

            /** Check repeat url or not  * */
            if ($this->documentation_model->checkUrl($dataPost['Url'])) {
                $this->errors .= "<p>" . lang("URL can not be repeated", "documentation") . "</p>";
            }

            /** Translit url * */
            $dataPost['url'] = translit_url($dataPost['url']);

            /** Check if url is empty then use translit * */
            if ($dataPost['url'] == null) {
                $dataPost['url'] = translit_url($dataPost['title']);
            }

            /** Prepare category full url * */
            $fullUrl = $this->lib_category->GetValue($dataPost['category'], 'path_url');
            if ($fullUrl == FALSE) {
                $fullUrl = '';
            }

            /** Prepare data for inserting into database * */
            $data = array(
                'title' => trim($dataPost['title']),
                'url' => str_replace('.', '', trim($dataPost['url'])),
                'cat_url' => $fullUrl,
                'keywords' => ($dataPost['keywords'] != null ? trim($dataPost['keywords']) : trim($this->lib_seo->get_keywords($dataPost['prev_text']))),
                'description' => ($dataPost['description'] != null ? trim($dataPost['description']) : trim($this->lib_seo->get_description($dataPost['prev_text']))),
                'full_text' => trim($dataPost['prev_text']),
                'prev_text' => trim($dataPost['prev_text']),
                'category' => $dataPost['category'],
                'author' => $this->dx_auth->get_username(),
                'post_status' => 'publish',
                'publish_date' => time(),
                'created' => time(),
                'lang' => $langId,
                'lang_alias' => $mainPageId,
                'updated' => time(),
                'comments_status' => '1'
            );

            /** If page created succesful then show page on site * */
            if (!$this->errors && $this->documentation_model->createNewPage($data)) {
                /** Get page lang identificator * */
                $currentPageLang = $this->cms_admin->get_lang($langId);

                $this->cache->delete_all();

                /** Redirect to view page  * */
                redirect(base_url($currentPageLang['identif'] . '/' . $data['cat_url'] . $data['url']));
            }
        } else {
            $this->errors .= $this->form_validation->error_string();
        }

        /** For form submit * */
        $params = "";
        if ($mainPageId != null) {
            $params = "/" . $mainPageId . "/" . $langId;
        }

        /** Page data by id * */
        if ($mainPageId != 0) {
            $mainPage = $this->documentation_model->getPageById($mainPageId);
        }

        /** Set template data and show template * */
        if ($this->dx_auth->is_admin()) {
            \CMSFactory\assetManager::create()
                    ->setData('tree', $this->lib_category->build()) // Load category tree)
                    ->setData('errors', $this->errors)
                    ->setData('mainPage', $mainPage)
                    ->setData('params', $params)
                    ->render('create_new_page');
        } else {
            $this->core->error_404();
        }
    }

    /**
     * Edit page
     * @param int $id
     * @param int $langId
     */
    public function edit_page($id = null, $langId = null) {
        /** Page not found * */
        if ($id == null) {
            $this->core->error_404();
        }

        $this->core->set_meta_tags(lang("Page edit", "documentation"));

        /** If not langId then set default language id * */
        if ($langId == null) {
            $langId = $this->defaultLang['id'];
        }

        /** If not page id and not any page with $id  * */
        if (!$this->documentation_model->getPageById($id, $langId)) {

            redirect(base_url('documentation/create_new_page/' . $id . '/' . $langId));
        } else {

            /** New page data from post array * */
            $dataPost = $this->input->post('NewPage');

            /** Register meta tags * */
            $this->template->registerMeta("ROBOTS", "NOINDEX, NOFOLLOW");

            /** Set form validation rules * */
            $this->form_validation->set_rules('NewPage[title]', lang("Name", "documentation"), 'xss_clean|trim|required|min_length[1]|max_length[254]');
            $this->form_validation->set_rules('NewPage[url]', lang("URL", "documentation"), 'xss_clean|max_length[254]');
            $this->form_validation->set_rules('NewPage[full_text]', lang("Content", "documentation"), 'xss_clean|trim|required');
            $this->form_validation->set_rules('NewPage[keywords]', lang("Keywords", "documentation"), 'xss_clean|trim');
            $this->form_validation->set_rules('NewPage[description]', lang("Description", "documentation"), 'xss_clean|trim');

            /** If not validation errors * */
            if ($dataPost != null && $this->form_validation->run() != FALSE) {

                /** Check repeat url or not  * */
                if ($this->documentation_model->checkUrl($dataPost['Url'])) {
                    $this->errors .= "<p>" . lang("URL can not be repeated", "documentation") . "</p>";
                }

                /** Translit url * */
                $dataPost['url'] = translit_url($dataPost['url']);

                /** Check if url is empty then use translit * */
                if ($dataPost['url'] == null) {
                    $dataPost['url'] = translit_url($dataPost['title']);
                }

                /** Prepare category full url * */
                $fullUrl = $this->lib_category->GetValue($dataPost['category'], 'path_url');
                if ($fullUrl == FALSE) {
                    $fullUrl = '';
                }

                /** Prepare data for inserting into database * */
                $data = array(
                    'title' => trim($dataPost['title']),
                    'url' => str_replace('.', '', trim($dataPost['url'])),
                    'cat_url' => $fullUrl,
                    'keywords' => ($dataPost['keywords'] != null ? trim($dataPost['keywords']) : trim($this->lib_seo->get_keywords($dataPost['prev_text']))),
                    'description' => ($dataPost['description'] != null ? trim($dataPost['description']) : trim($this->lib_seo->get_description($dataPost['prev_text']))),
                    'full_text' => trim($dataPost['full_text']),
                    'prev_text' => trim($dataPost['full_text']),
                    'category' => $dataPost['category'],
                    'updated' => time(),
                    'lang' => $langId
                );

                /** Check for errors and make backup * */
                if (!$this->errors && $this->documentation_model->make_backup($this->documentation_model->getPageIdByMainPageIdAndLangId($id, $langId))) {

                    /** Update page * */
                    if ($this->documentation_model->updatePage($id, $langId, $data)) {

                        /** Get page lang identificator * */
                        $currentPageLang = $this->cms_admin->get_lang($langId);

                        $this->cache->delete_all();

                        /** Redirect to view page  * */
                        redirect(base_url($currentPageLang['identif'] . '/' . $data['cat_url'] . $data['url']));
                    }
                }
            } else {
                $this->errors .= $this->form_validation->error_string();
            }

            /** Page data by id * */
            $page = $this->documentation_model->getPageById($id, $langId);

            /** For form submit * */
            $params = "/" . $langId;

            /** Set template data and show template * */
            if ($this->dx_auth->is_admin()) {
                \CMSFactory\assetManager::create()
                        ->setData('langs', $this->documentation_model->getLangs())
                        ->setData('tree', $this->lib_category->build()) // Load category tree
                        ->setData('page', $page)
                        ->setData('params', $params)
                        ->setData('defaultLang', $this->defaultLang)
                        ->setData('errors', $this->errors)
                        ->render('edit_page');
            } else {
                $this->core->error_404();
            }
        }
    }

    public function save_desc() {
        $this->documentation_model->make_backup();

        $this->db
                ->where('id', $this->input->post('id'))
                ->set('full_text', $this->input->post('desc'))
                ->update('content');
    }

    public function save_title() {
        $this->documentation_model->make_backup();

        $this->db
                ->where('id', $this->input->post('id'))
                ->set('title', $this->input->post('h1'))
                ->update('content');
    }

    function ajax_translit() {
        $this->load->helper('translit');
        $str = trim($this->input->post('str'));
        echo translit_url($str);
    }

    public function create_cat() {
        $this->load->library('lib_admin');

        $this->form_validation->set_rules('name', lang("Name", "documentation"), 'trim|min_length[1]|max_length[256]|required|xss_clean');
        $this->form_validation->set_rules('url', lang("URL", "documentation"), 'xss_clean|max_length[256]');
        $this->form_validation->run();

        if (!$this->form_validation->error_string()) {
            if ($this->input->post('url') == FALSE) {
                $url = translit_url($this->input->post('name'));
            } else {
                $url = translit_url($this->input->post('url'));
            }

            $data = array(
                'name' => $this->input->post('name'),
                'url' => $url,
                'title' => $this->input->post('meta_title'),
                'keywords' => $this->input->post('keywords'),
                'description' => $this->input->post('description'),
                'parent_id' => $this->input->post('category'),
                'order_by' => 'publish_date',
                'sort_order' => 'desc',
                'tpl' => 'category'
            );

            $parent = $this->lib_category->get_category($data['parent_id']);

            if ($parent != 'NULL') {
                $full_path = $parent['path_url'] . $data['url'] . '/';
            } else {
                $full_path = $data['url'] . '/';
            }

            if (($this->category_exists($full_path) == TRUE) AND ($data['url'] != 'core')) {
                $data['url'] .= time();
            }

            $id = $this->cms_admin->create_category($data);
            $responseArray = array();

            /** Return true if category created success and return errors* */
            if ($id != null) {
                $responseArray['success'] = 'true';
                $responseArray['errors'] = 'false';
                $this->cache->delete_all();
                echo json_encode($responseArray);
            } else {
                $responseArray['success'] = 'false';
                $responseArray['errors'] = lang("Ошибка при создании категории", "documentation");
                echo json_encode($responseArray);
            }


            /** Init Event. Create new Category */
            \CMSFactory\Events::create()->registerEvent(array_merge($data, array('userId' => $this->dx_auth->get_user_id())));
        } else {
            $responseArray['success'] = 'false';
            $responseArray['errors'] = $this->form_validation->error_string();
            echo json_encode($responseArray);
        }
    }

    public function edit_cat($id = null) {
        if ($id == null) {
            return;
        }

        $this->load->library('lib_admin');

        $this->form_validation->set_rules('name', lang("Name", "documentation"), 'trim|min_length[1]|max_length[127]|required|xss_clean');
        $this->form_validation->set_rules('url', lang("URL", "documentation"), 'xss_clean|max_length[127]');
        $this->form_validation->run();

        if (!$this->form_validation->error_string()) {
            if ($this->input->post('url') == FALSE) {
                $url = translit_url($this->input->post('name'));
            } else {
                $url = translit_url($this->input->post('url'));
            }

            $data = array(
                'name' => $this->input->post('name'),
                'url' => $url,
                'keywords' => $this->input->post('keywords'),
                'description' => $this->input->post('description'),
                'parent_id' => $this->input->post('category')
            );

            $parent = $this->lib_category->get_category($data['parent_id']);

            if ($parent != 'NULL') {
                $full_path = $parent['path_url'] . $data['url'] . '/';
            } else {
                $full_path = $data['url'] . '/';
            }

            if (($this->category_exists($full_path) == TRUE) AND ($data['url'] != 'core')) {
                $data['url'] .= time();
            }

            $category = $this->documentation_model->updateCategory($data, $id);

            /** Prepare and return answer * */
            $responseArray = array();
            $responseArray['success'] = 'true';
            $responseArray['errors'] = 'false';
            $responseArray['data']['full_url'] = $category['full_url'];
            $this->cache->delete_all();
            echo json_encode($responseArray);
        } else {
            $responseArray['success'] = 'false';
            $responseArray['errors'] = $this->form_validation->error_string();
            echo json_encode($responseArray);
        }
    }

    /**
     * Check if category exists
     * @param type $str
     * @return type
     */
    function category_exists($str) {
        return $this->lib_category->get_category_by('path_url', $str);
    }

    /**
     * Load category menu
     * @param string $groupId
     */
    public function load_category_menu($group = false) {

        $categoryData = array();
        /** Full path if data_type is page * */
        if ($this->core->core_data['data_type'] == 'page') {
            $data = $this->documentation_model->getPageById($this->core->core_data['id']);
            $category = $this->lib_category->get_category($data['category']);

            /** Prepare category info * */
            $categoryData['id'] = $data['category'];
            $categoryData['url'] = $data['cat_url'];
            $categoryData['url_simple'] = $category['url'];
            $categoryData['name'] = $category['name'];
            $categoryData['parent_id'] = $category['parent_id'];
            $categoryData['description'] = $category['description'];
            $categoryData['keywords'] = $category['keywords'];
        }

        /** Full path if data_type is category * */
        if ($this->core->core_data['data_type'] == 'category') {
            $category = $this->lib_category->get_category($this->core->core_data['id']);
            $parent = $this->lib_category->get_category($category['parent_id']);

            /** Prepare category info * */
            $categoryData['id'] = $this->core->core_data['id'];
            $categoryData['name'] = $category['name'];
            $categoryData['parent_id'] = $category['parent_id'];
            $categoryData['url_simple'] = $category['url'];
            $categoryData['description'] = $category['description'];
            $categoryData['keywords'] = $category['keywords'];

            /** build category fullpath * */
            if ($parent != 'NULL') {
                $full_path = $parent['path_url'] . $category['url'] . '/';
            } else {
                $full_path = $category['url'] . '/';
            }
            $categoryData['url'] = $full_path;
        }

        $tree = $this->lib_category->_build();

        /** Render category menu * */
        \CMSFactory\assetManager::create()
                ->setData('tree', $tree)
                ->setData('group', $group)
                ->setData('categoryData', $categoryData)
                ->render('left_menu', true);
    }

    public function delete_page($id = null) {
        if ($id == null) {
            return false;
        } else {
            $page = $this->documentation_model->getPageById($id);
            $this->documentation_model->deletePage($id);
            $this->cache->delete_all();
            redirect(base_url($page['cat_url']));
        }
    }

    public function recent_forum() {
        $forum = $this->load->database('forum', true, true);

        $model = $forum
                ->order_by('last_post', 'desc')
                ->get('topics', 4);
        $this->template->assign('forumThemes', $model->result_array());
    }

    public function recent_news() {
        $this->load->helper('../modules/documentation/helpers/documentation');
        $settings = array(
            'news_count' => 3,
            'max_symdols' => 150,
            'display' => 'recent' //possible values: recent/popular
        );

        $imagecms = $this->load->database('imagecms', true, true);

        $imagecms->select('content.id as id, CONCAT_WS("", cat_url, url) as full_url, title, prev_text, publish_date, author, data', FALSE);
        $imagecms->where('post_status', 'publish');
        $imagecms->join('content_fields_data', 'content_fields_data.item_id=content.id');
        $imagecms->where('prev_text !=', 'null');
        $imagecms->where('publish_date <=', time());
        $imagecms->where('lang', $this->config->item('cur_lang'));
        $imagecms->where('content_fields_data.field_name', 'field_promo_pic');

        /*  Remove records with "ACTION" marker in additional fields */
        $imagecms->where('(SELECT content_fields_data.id FROM content_fields_data WHERE content_fields_data.item_id = content.id AND field_name = "field_is_promo") IS NULL');

        if (count($settings['categories']) > 0) {
            $imagecms->where_in('category', $settings['categories']);
        }

        if ($settings['display'] == 'recent') {
            $imagecms->order_by('publish_date', 'desc'); // Recent news
        } elseif ($settings['display'] == 'popular') {
            $imagecms->order_by('showed', 'desc'); // Pupular news
        }

        $query = $imagecms->get('content', $settings['news_count']);

        if ($query->num_rows() > 0) {
            $news = $query->result_array();

            $cnt = count($news);
            for ($i = 0; $i < $cnt; $i++) {
                $news[$i]['prev_text'] = htmlspecialchars_decode($news[$i]['prev_text']);

                // Truncate text
                if ($settings['max_symdols'] > 0 AND mb_strlen($news[$i]['prev_text'], 'utf-8') > $settings['max_symdols']) {
                    $news[$i]['prev_text'] = strip_tags(mb_substr($news[$i]['prev_text'], 0, $settings['max_symdols'], 'utf-8')) . '...';
                }
            }

            $this->template->assign('news', $news);
        } else {
            return '';
        }
    }

    public function get_pages_in_category($id) {
        return $this->documentation_model->getPagesInCategory($id, $this->defaultLang['id']);
    }

    /** Install and set settings * */
    public function _install() {
        $this->documentation_model->install();
    }

    /** Deinstall * */
    public function _deinstall() {
        $this->documentation_model->install();
    }

}

/* End of file documentation_module.php */
