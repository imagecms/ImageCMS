<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Image CMS
 * Admin Class
 * 
 * TODO:
 * check local ip; 
 *
 */
class Admin extends MY_Controller {

    private $request_url = 'http://requests.imagecms.net/index.php/requests/req';

    public function __construct() {
        parent::__construct();

        $this->load->library('DX_Auth');
        admin_or_redirect();

        $this->load->library('lib_admin');
        $this->load->library('lib_category');
        $this->lib_admin->init_settings();

        $this->load->library('lib_admin');
        $this->load->library('lib_category');
        $this->lib_admin->init_settings();
		
	//$this->output->enable_profiler(true);
    }

    public function index() {
        // Disable license check.
        // From version 1.3.7
        //$this->check();

        $this->load->module('admin/components');
        $components = $this->components->find_components(TRUE);

        $this->template->assign('components', $components);
        $this->template->assign('cats_unsorted', $this->lib_category->unsorted());
        $this->template->assign('tree', $this->lib_category->build());

        // load menus
        $this->load->module('menu');
        $this->template->assign('menus', $this->menu->get_all_menus());

        ///TinyMCE
        $this->load->library('lib_editor');
        $this->template->assign('editor', $this->lib_editor->init());
        //////

        $this->template->assign('username', $this->dx_auth->get_username());

        ($hook = get_hook('admin_show_desktop')) ? eval($hook) : NULL;

// 		$this->template->show('desktop', FALSE);
        $this->template->show('dashboard', TRUE);
    }

    public function sys_info($action = '') {
        if ($action == 'phpinfo') {
            ob_start();
            phpinfo();
            $contents = ob_get_contents();
            ob_end_clean();
            echo $contents;
            exit;
        }

        $folders = array(
            '/system/cache/' => FALSE,
            '/system/cache/templates_c/' => FALSE,
            '/uploads/' => FALSE,
            '/uploads/images' => FALSE,
            '/uploads/files' => FALSE,
            '/uploads/media' => FALSE,
            '/captcha/' => FALSE,
        );

        foreach ($folders as $k => $v) {
            $folders[$k] = is_really_writable(PUBPATH . $k);
        }

        $this->template->assign('folders', $folders);

        if ($this->db->dbdriver == 'mysql') {
            $this->load->helper('number');

            $sql = "SHOW TABLE STATUS FROM `" . $this->db->database . "`";
            $query = $this->db->query($sql)->result_array();

            // Get total DB size
            $total_size = 0;
            $total_rows = 0;
            foreach ($query as $k => $v) {
                $total_size += $v['Data_length'] + $v['Index_length'];
                $total_rows += $v['Rows'];
            }

            $sql = "SELECT VERSION()";
            $query = $this->db->query($sql);

            $version = $query->row_array();

            $this->template->add_array(array(
                'db_version' => $version['VERSION()'],
                'db_size' => byte_format($total_size),
                'db_rows' => $total_rows,
            ));
        }

        $this->template->show('sys_info', FALSE);
    }

    /**
     * Delete cached files
     *
     * @param string
     * @access public
     * @return bool
     */
    public function delete_cache() {
        cp_check_perm('cache_clear');

        $param = $this->input->post('param');

        $this->lib_admin->log(lang('ac_cleaned_cache'));                

        switch ($param) {
            case 'all':
                $files = $this->cache->delete_all();
                if ($files)
                    $message = lang('ac_files_deleted') . ':' . $files;
                else
                    $message = lang('ac_cache_cleared');
                break;

            case 'expried':
                $files = $this->cache->Clean();
                if ($files)
                    $message = lang('ac_old_files_deleted') . $files;
                else
                    $message = lang('ac_cache_cleared');
                break;
            default: 
            {
                $message = 'Ошибка очистки кэша';
                $result = false;
            }
        }

        echo json_encode(array(
            'message' => $message,
            'result' => $result,
            'color' => 'r',
            'filesCount'=> $this->cache->cache_file()));
    }

    public function sidebar_cats() {
        echo '<div id="categories">';
        if (isset($_GET['first'])) {
            $this->db->where('name', 'shop');
            $this->db->limit(1);
            $query = $this->db->get('components');
            if ($query->num_rows() > 0) {
                ShopCore::app()->SAdminSidebarRenderer->render();
                exit;
            }
        }

        $this->template->assign('tree', $this->lib_category->build());
        $this->template->show('cats_sidebar', FALSE);
        echo '</div>';
    }

    /**
     * Clear session data;
     *
     * @access public
     */
    public function logout() {
        $this->lib_admin->log(lang('ac_admin_panel_exit'));
        $this->dx_auth->logout();
        redirect('/admin/login', 'refresh');
    }

}

/* End of admin.php */
