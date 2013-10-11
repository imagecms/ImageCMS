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

        $lang = new MY_Lang();
        $lang->load('admin');

        $this->load->library('DX_Auth');
        admin_or_redirect();


        $this->load->library('lib_admin');
        $this->load->library('lib_category');
        $this->lib_admin->init_settings();

// 		$this->output->enable_profiler(true);
    }

    public function init() {
        if (SHOP_INSTALLED)
            redirect('/admin/components/run/shop/dashboard');
        else
            $this->index();
    }

    public function index() {
        //just show dashboard
        $this->load->module('admin/dashboard');
        $this->dashboard->index();
        exit;
    }

    /**
     * Delete cached files
     *
     * @param string
     * @access public
     * @return bool
     */
    public function delete_cache() {
        //cp_check_perm('cache_clear');

        $param = $this->input->post('param');

        $this->lib_admin->log(lang("Cleared the cache", "admin"));

        switch ($param) {
            case 'all':
                $files = $this->cache->delete_all();
                if ($files)
                    $message = lang("Files deleted", "admin") . ':' . $files;
                else
                    $message = lang("Cache has been cleared", "admin");
                break;

            case 'expried':
                $files = $this->cache->Clean();
                if ($files)
                    $message = lang("Outdated files  have been deleted", "admin") . $files;
                else
                    $message = lang("Cache has been cleared", "admin");
                break;
            default: {
                    $message = lang("Clearing cache error", "admin");
                    $result = false;
                }
        }
        echo json_encode(array(
            'message' => $message,
            'result' => $result,
            'color' => 'r',
            'filesCount' => $this->cache->cache_file()));
    }

    //initialyze elFinder
    public function elfinder_init($edMode = false) {
        $this->load->helper('path');

        if (!$edMode)
            $path = 'uploads';
        else
            $path = 'templates';

        if ($this->input->get('path'))
            $path = $this->input->get('path');



        $opts = array(
            // 'debug' => true,
            'roots' => array(
                array(
                    'driver' => 'LocalFileSystem',
                    'path' => set_realpath($path),
                    'URL' => site_url() . $path,
                    'accessControl' => 'access',
                    'attributes' => array(
                        array(
                            'pattern' => '/administrator/', //You can also set permissions for file types by adding, for example, .jpg inside pattern.
                            'read' => false,
                            'write' => false,
                            'locked' => true
                        ),
//                        array(
//                            'pattern' => '/commerce/', //You can also set permissions for file types by adding, for example, .jpg inside pattern.
//                            'read'    => true,
//                            'write'   => true,
//                            'locked'  => false
//                        )
                    )
                // more elFinder options here
                )
            )
        );
        $this->load->library('elfinder_lib', $opts);
    }

    public function get_csrf() {
        echo form_csrf();
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
        $this->lib_admin->log(lang("exited the control panel", "admin"));
        $this->dx_auth->logout();
        redirect('/admin/login', 'refresh');
    }

    public function report_bug() {
        $message = '';
        $this->load->library('email');

        $config['charset'] = 'utf-8';
        $config['mailtype'] = 'html';
        $config['wordwrap'] = TRUE;
        $this->email->initialize($config);

        /* pack message */
        $message .= lang("Site address", "admin") . trim(strip_tags($_GET['hostname'])) . ';' . lang("page", "admin") . ': ' . trim(strip_tags($_GET['pathname'])) . ';' . lang("ip-address") . ': ' . trim(strip_tags($_GET['ip_address'])) . '; ' . lang("user name", "admin") . ': ' . trim(strip_tags($_GET['user_name'])) . '; <br/> ' . lang("Message", "admin") . ': ' . trim(strip_tags($_GET['text']));
        $text = trim($_GET['text']);
        if (!empty($text)) {
            /* send message */
            $this->email->from('bugs@imagecms.net', 'Admin Robot');
            $this->email->to('report@imagecms.net');
            $this->email->bcc('dev@imagecms.net');
            $this->email->subject('Admin report from "' . trim(strip_tags($_GET['hostname'])) . '"');
            $this->email->message(stripslashes($message));
            if (!$this->email->send()) {
                echo '<div class="alert alert-error">' . lang('An error occurred while sending a message', 'admin') . '</div>';
                exit;
            }
            echo '<div class="alert alert-success">' . lang('Your message has been sent', 'admin') . '</div>';
        }
        else
            echo '<div class="alert alert-error">' . lang('Comment is a required field', 'admin') . '</div>';
    }

}

/* End of admin.php */
