<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Module Frame
 */
class Documentation extends MY_Controller {

    private $errors = false;
    private $defaultLang = false;
    
    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('documentation');
        
        /** Load libraries and models **/
        $this->load->library('form_validation');
        $this->load->library('lib_category');
        $this->load->model('documentation_model');
        $this->load->model('cms_admin');
        
        /** Get default lang **/
        $this->defaultLang = $this->cms_admin->get_default_lang();
    }

    public function create_new_page() {

//        var_dump($this->input->post('NewPage'));

        /** New page data from post array * */
        $dataPost = $this->input->post('NewPage');

        /** Register meta tags * */
        $this->template->registerMeta("ROBOTS", "NOINDEX, NOFOLLOW");

        /** Prepare array with categories ids and names * */
        $categories = $this->documentation_model->getPagesCategories();

        /** Set form validation rules * */
        $this->form_validation->set_rules('NewPage[title]', lang("Name", "documentation"), 'trim|required|min_length[1]|max_length[100]');
        $this->form_validation->set_rules('NewPage[url]', lang("URL", "documentation"), 'alpha_dash|required');
        $this->form_validation->set_rules('NewPage[prev_text]', lang("Contents", "documentation"), 'trim|required');
        
        
        /** Prepare category full url **/
        $fullUrl = $this->lib_category->GetValue($dataPost['category'], 'path_url');
        if ($fullUrl == FALSE) {
            $fullUrl = '';
        }
        
        /** If not validation errors * */
        if ($this->form_validation->run() != FALSE) {
            /** Check repeat url or not  * */
            if ($this->documentation_model->checkUrl($dataPost['Url'])) {
                $this->errors .= "<p>" . lang("URL can not be repeated", "documentation") . "</p>";
            }
            
            
            /** Prepare data for inserting into database **/
            $data = array(
                'title' => trim($dataPost['title']),
                'url' => str_replace('.', '', trim($dataPost['url'])),
                'cat_url' => $fullUrl,
                'keywords' => $this->lib_seo->get_keywords($dataPost['prev_text']),
                'description' => $this->lib_seo->get_description($dataPost['prev_text']),
                'full_text' => trim($dataPost['prev_text']),
                'prev_text' => trim($dataPost['prev_text']),
                'category' => $dataPost['category'],
                'author' => $this->dx_auth->get_username(),
                'post_status' => 'publish',
                'publish_date' => time(),
                'created' =>time(),
                'lang' => $this->defaultLang['id']
            );
            
            /** If page created succesful then show page on site * */
            if (!$this->errors && $this->documentation_model->createNewPage($data)) {
                redirect(base_url($data['cat_url'].$data['url']));
            }
        } else {
            $this->errors .= $this->form_validation->error_string();
        }

        if ($this->dx_auth->is_admin()) {
            \CMSFactory\assetManager::create()
                    ->registerScript('scripts')
                    ->registerStyle('style', TRUE)
                    ->setData('tree', $this->lib_category->build()) // Load category tree)
                    ->setData('errors', $this->errors)
                    ->render('create_new_page');
        }
        else
            $this->core->error_404();
    }

    public function _install() {
        /** We recomend to use http://ellislab.com/codeigniter/user-guide/database/forge.html */
        /**
          $this->load->dbforge();

          $fields = array(
          'id' => array('type' => 'INT', 'constraint' => 11, 'auto_increment' => TRUE,),
          'name' => array('type' => 'VARCHAR', 'constraint' => 50,),
          'value' => array('type' => 'VARCHAR', 'constraint' => 100,)
          );

          $this->dbforge->add_key('id', TRUE);
          $this->dbforge->add_field($fields);
          $this->dbforge->create_table('mod_empty', TRUE);
         */
        /**
          $this->db->where('name', 'module_frame')
          ->update('components', array('autoload' => '1', 'enabled' => '1'));
         */
    }

    public function _deinstall() {
        /**
          $this->load->dbforge();
          $this->dbforge->drop_table('mod_empty');
         *
         */
    }

}

/* End of file sample_module.php */
