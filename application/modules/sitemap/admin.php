<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Image CMS
 *
 * Sample Module Admin
 * @property sitemap_model $sitemap_model
 */
class Admin extends BaseAdminController {

    /**
     * Path to saved sitemap file
     * @var string
     */
    private $sitemap_path = './application/modules/sitemap/map/sitemap.xml';

    function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('sitemap');

        $this->load->library('DX_Auth');
        $this->load->model('sitemap_model');
        //cp_check_perm('module_admin');
    }

    /**
     * Show sitemap priorities page
     */
    function index() {
        $this->priorities();
    }

    /**
     * Validation for priority name field
     * @param string $tpl
     */
    public function priority_validation($priority) {
        if ($priority > 0 && $priority <= 1) {
            return TRUE;
        }
        $this->form_validation->set_message('priority_validation', lang('The %s field value can be in range from 0.1 to 1', 'sitemap'));
        return FALSE;
    }

    /**
     * Update settings
     */
    public function settings() {
        if ($_POST) {
            /** Data to update */
            $data = $this->input->post('settings');

            /** Update settings */
            if ($this->sitemap_model->updateSettings($data)) {
                $this->replaceRobots($data['robotsStatus']);
                showMessage(lang("Changes have been saved", 'sitemap'), lang("Message", "sitemap"));
            } else {
                showMessage(lang("Changes have not been saved", 'sitemap'), lang("Error", "sitemap"), 'r');
            }

            $this->_viewSiteMap();
        } else {
            // Get Information About Saved Site Map
            if (file_exists($this->sitemap_path)) {
                $file_data = array('url' => $this->sitemap_path, 'time' => filemtime($this->sitemap_path), 'size' => filesize($this->sitemap_path));
            } else {
                $file_data = array();
            }

            $settings = $this->sitemap_model->load_settings();
            \CMSFactory\assetManager::create()
                    ->registerScript('admin')
                    ->appendData(array(
                        'settings' => $settings,
                        'fileSiteMapData' => $file_data
                    ))
                    ->renderAdmin('settings');
        }
    }

    /**
     * Save sitemap
     */
    public function saveSiteMap() {
        // Get Site Map Data
        $sitemap = file_get_contents(site_url('sitemap.xml'));

        if ($sitemap) {
            // Create file and puts Site Map data 
            if (file_put_contents($this->sitemap_path, $sitemap)) {
                showMessage(lang("Site map have been saved", 'sitemap'), lang("Message", "sitemap"));
            } else {
                showMessage(lang("Site map have not been saved", 'sitemap'), lang("Error", "sitemap"), 'r');
            }
        } else {
            showMessage(lang("Site map have not been saved", 'sitemap'), lang("Error", "sitemap"), 'r');
        }
    }

    /**
     * Download saved sitemap xml file
     */
    public function sitemapDownload() {
        $this->load->helper('download');
        $sitemap = file_get_contents($this->sitemap_path);

        if ($sitemap) {
            force_download('sitemap.xml', $sitemap);
        } else {
            redirect(site_url('admin/components/init_window/sitemap/settings'));
        }
    }

    /**
     * Replace robots
     * @param int $robotsStatus - robots status(turn on - 1, turn off - 0)
     * @return int
     */
    public function replaceRobots($robotsStatus = 0) {
        $robots = file('robots.txt');

        if ((int) $robotsStatus) {
            // Turn on robots
            $robots[1] = 'Disallow: /';
        } else {
            // Turn off robots
            $robots[1] = 'Disallow: ';
        }

        $robots = array($robots[0], $robots[1]);

        return file_put_contents('robots.txt', $robots);
    }

    /**
     * Site map priorities
     */
    public function priorities() {
        if ($_POST) {
            /** Priorities validation */
            $this->form_validation->set_rules('main_page_priority', lang('Main page priority', 'sitemap'), "required|callback_priority_validation");
            $this->form_validation->set_rules('cats_priority', lang('Categories priority', 'sitemap'), "required|callback_priority_validation");
            $this->form_validation->set_rules('pages_priority', lang('Regular or usual pages priority', 'sitemap'), "required|callback_priority_validation");
            $this->form_validation->set_rules('sub_cats_priority', lang('Subcategories priority', 'sitemap'), "required|callback_priority_validation");
            $this->form_validation->set_rules('products_priority', lang('Products priority', 'sitemap'), "required|callback_priority_validation");
            $this->form_validation->set_rules('brands_priority', lang('Brands priority', 'sitemap'), "required|callback_priority_validation");
            $this->form_validation->set_rules('products_categories_priority', lang('Products categories priority', 'sitemap'), "required|callback_priority_validation");
            $this->form_validation->set_rules('products_sub_categories_priority', lang('Products subcategories priority', 'sitemap'), "required|callback_priority_validation");

            if ($this->form_validation->run($this) == FALSE) {
                showMessage(validation_errors(), lang("Error", "sitemap"), 'r');
                exit;
            }

            /**
             * Prepare data to update priorities
             * 
             */
            $data = array(
                'main_page_priority' => $this->input->post('main_page_priority'),
                'cats_priority' => $this->input->post('cats_priority'),
                'pages_priority' => $this->input->post('pages_priority'),
                'sub_cats_priority' => $this->input->post('sub_cats_priority'),
                'products_priority' => $this->input->post('products_priority'),
                'brands_priority' => $this->input->post('brands_priority'),
                'products_categories_priority' => $this->input->post('products_categories_priority'),
                'products_sub_categories_priority' => $this->input->post('products_sub_categories_priority'),
            );

            /** Set priorities */
            if ($this->sitemap_model->updatePriorities($data)) {
                showMessage(lang("Changes have been saved", 'sitemap'), lang("Message", "sitemap"));
            } else {
                showMessage(lang("Changes have not been saved", 'sitemap'), lang("Error", "sitemap"), 'r');
            }

            $this->_viewSiteMap();
        } else {
            $priorities = $this->sitemap_model->getPriorities();
            \CMSFactory\assetManager::create()
                    ->setData($priorities)
                    ->renderAdmin('priorities');
        }
    }

    /**
     * Site map changefreq
     */
    public function changefreq() {
        if ($_POST) {
            /**
             * Prepare data to update changefreq
             */
            $data = array(
                'main_page_changefreq' => $this->input->post('main_page_changefreq'),
                'categories_changefreq' => $this->input->post('categories_changefreq'),
                'pages_changefreq' => $this->input->post('pages_changefreq'),
                'product_changefreq' => $this->input->post('product_changefreq'),
                'categories_changefreq' => $this->input->post('categories_changefreq'),
                'products_categories_changefreq' => $this->input->post('products_categories_changefreq'),
                'products_sub_categories_changefreq' => $this->input->post('products_sub_categories_changefreq'),
                'sub_categories_changefreq' => $this->input->post('sub_categories_changefreq'),
                'brands_changefreq' => $this->input->post('brands_changefreq'),
            );

            /** Set changefreq */
            if ($this->sitemap_model->updateChangefreq($data)) {
                showMessage(lang("Changes have been saved", 'sitemap'), lang("Message", "sitemap"));
            } else {
                showMessage(lang("Changes have not been saved", 'sitemap'), lang("Error", "sitemap"), 'r');
            }


            $this->_viewSiteMap();
        } else {
            $changefreq = $this->sitemap_model->getChangefreq();
            \CMSFactory\assetManager::create()
                    ->setData($changefreq)
                    ->appendData(array(
                        'changefreq_options' => array(
                            'always' => lang('always', 'sitemap'),
                            'hourly' => lang('hourly', 'sitemap'),
                            'daily' => lang('daily', 'sitemap'),
                            'weekly' => lang('weekly', 'sitemap'),
                            'monthly' => lang('monthly', 'sitemap'),
                            'yearly' => lang('yearly', 'sitemap'),
                            'never' => lang('never', 'sitemap')
                        )
                            )
                    )
                    ->renderAdmin('changefreq');
        }
    }

    /**
     * Site map blocked urls
     */
    public function blockedUrls() {
        if ($_POST) {
            /**
             * Prepare data to update changefreq
             */
            $data = array();
            $hide_urls = $this->input->post('hide_urls');
            if ($hide_urls) {
                foreach ($hide_urls as $url) {
                    if ($url) {
                        $data[]['url'] = $url;
                    }
                }
            }

            /** Set blockedUrls */
            if ($this->sitemap_model->updateBlockedUrls($data)) {
                showMessage(lang("Changes have been saved", 'sitemap'), lang("Message", "sitemap"));
            } else {
                if ($data) {
                    showMessage(lang("Changes have not been saved", 'sitemap'), lang("Error", "sitemap"), 'r');
                } else {
                    showMessage(lang("Changes have been saved", 'sitemap'), lang("Message", "sitemap"));
                }
            }


            $this->_viewSiteMap();
        } else {
            $blockedUrls = $this->sitemap_model->getBlockedUrls();
            \CMSFactory\assetManager::create()
                    ->registerScript('admin')
                    ->setData('hide_urls', $blockedUrls)
                    ->renderAdmin('blocked_urls');
        }
    }

    /**
     * Display template file
     */
    public function display_tpl($file = '') {
        $file = realpath(dirname(__FILE__)) . '/templates/admin/' . $file . '.tpl';
        $this->template->display('file:' . $file);
    }

    /**
     * Fetch template file
     */
    public function fetch_tpl($file = '') {
        $file = realpath(dirname(__FILE__)) . '/templates/admin/' . $file . '.tpl';
        return $this->template->fetch('file:' . $file);
    }

    /**
     * Render template file
     */
    public function render($viewName, array $data = array(), $return = false) {
        if (!empty($data))
            $this->template->add_array($data);

        $this->template->show('file:' . 'application/modules/sitemap/templates/admin/' . $viewName);
        exit;

        if ($return === false)
            $this->template->show('file:' . 'application/modules/sitemap/templates/admin/' . $viewName);
        else
            return $this->template->fetch('file:' . 'application/modules/sitemap/templates/admin/' . $viewName);
    }

    /**
     * Viev site map
     */
    private function _viewSiteMap() {
        if ($this->input->post('action') == 'show_sitemap') {
            echo "<script>location.href = '" . site_url('sitemap.xml') . "';</script>;";
            exit;
        }
    }

}

/* End of file admin.php */
