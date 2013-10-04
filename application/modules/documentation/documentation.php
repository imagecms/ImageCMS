<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Module Frame 
 * @property Documentation_model $documentation_model
 */
class Documentation extends MY_Controller {

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
        if ($this->dx_auth->is_admin()) {
            \CMSFactory\assetManager::create()
                    ->registerStyle('documentation', TRUE)
                    ->registerScript('documentation', FALSE, 'before');
        }
    }

    /**
     * Create new page
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
                'lang_alias' => $mainPageId
            );

            /** If page created succesful then show page on site * */
            if (!$this->errors && $this->documentation_model->createNewPage($data)) {
                /** Get page lang identificator * */
                $currentPageLang = $this->cms_admin->get_lang($langId);

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

    public function edit_page($id = null, $langId = null) {
        /** Page not found * */
        if ($id == null) {
            $this->core->error_404();
        }

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
            $this->form_validation->set_rules('NewPage[prev_text]', lang("Content", "documentation"), 'xss_clean|trim|required');
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
                    'updated' => time(),
                    'lang' => $langId
                );

                if (!$this->errors && $this->documentation_model->updatePage($id, $langId, $data)) {
                    /** Get page lang identificator * */
                    $currentPageLang = $this->cms_admin->get_lang($langId);

                    /** Redirect to view page  * */
                    redirect(base_url($currentPageLang['identif'] . '/' . $data['cat_url'] . $data['url']));
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

    /** Install and set settings * */
    public function _install() {
        $this->documentation_model->install();
    }

    /** Deinstall * */
    public function _deinstall() {
        $this->documentation_model->install();
    }

    function ajax_translit() {
        $this->load->helper('translit');
        $str = trim($this->input->post('str'));
        echo translit_url($str);
    }

    public function create_cat() {
        var_dump($this->input->post());

        $this->form_validation->set_rules('name', lang("Name", "documentation"), 'trim|min_length[1]|max_length[256]|required|xss_clean');
        $this->form_validation->run();
        var_dump($this->form_validation->error_string());
    }

}

/* End of file documentation_module.php */
