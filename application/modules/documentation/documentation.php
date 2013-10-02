<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Module Frame
 */
class Documentation extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('documentation');
        $this->load->library('form_validation');
        $this->load->model('documentation_model');
        $this->load->library('lib_category');
    }

    public function create_new_page() {

        var_dump($this->input->post('NewPage'));

        /** Register meta tags * */
        $this->template->registerMeta("ROBOTS", "NOINDEX, NOFOLLOW");

        /** Prepare array with categories ids and names * */
        $categories = $this->documentation_model->getPagesCategories();

        /** Set form validation rules * */
        $this->form_validation->set_rules('Name', lang("Name", "documentation"), 'trim|required|min_length[1]|max_length[100]');
        $this->form_validation->set_rules('Url', lang("URL", "documentation"), 'alpha_dash|required');
        $this->form_validation->set_rules('Content', lang("Contents", "documentation"), 'trim|required');

        /** If not validation errors * */
        if ($this->form_validation->run() != FALSE) {

            if ($this->documentation_model->create_new_page($this->input->post('NewPage'))) {
                
            }
        }

        if ($this->dx_auth->is_admin()) {
            \CMSFactory\assetManager::create()
                    ->registerScript('scripts')
                    ->registerStyle('style', TRUE)
                    ->setData('tree', $this->lib_category->build()) // Load category tree)
                    ->setData('errors', $this->form_validation->error_string())
                    ->setData('pageCategories', $categories)
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
