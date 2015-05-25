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
    private $sitemap_path = './uploads/sitemap/sitemap.xml';

    /**
     * Path to folder where site_maps files exists
     * @var type 
     */
    private $site_map_folder_path = './uploads/sitemaps';

    function __construct() {
        parent::__construct();

        $this->load->library('DX_Auth');
        $this->load->model('sitemap_model');

        $lang = new MY_Lang();
        $lang->load('sitemap');
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
                $this->lib_admin->log(lang("Sitemap settings edited", "sitemap"));
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
        $lang = new MY_Lang();
        $lang->load('sitemap');
        $successMessage = lang("Site map have been saved", "sitemap");
        $successMessageTitle = lang("Site map have been saved", "sitemap");

        // Get Site Map Data
        $sitemap = file_get_contents(site_url('sitemapRegenerate.xml'));
        if ($sitemap) {
            if (!is_dir($this->site_map_folder_path)) {
                mkdir($this->site_map_folder_path, 0777);
            }

            foreach (glob($this->site_map_folder_path . '/sitemap*') as $site_map_file) {
                chmod($site_map_file, 0777);
                unlink($site_map_file);
            }

            // Create file and puts Site Map data
            if (file_put_contents($this->sitemap_path, $sitemap)) {
                chmod($this->sitemap_path, 0777);
                $this->lib_admin->log($successMessage);
                showMessage($successMessage, $successMessageTitle);
            } else {
                showMessage(lang("Site map have not been saved. Set writing permissions on module folder.", 'sitemap'), lang("Error", "sitemap"), 'r');
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
     * Site map priorities
     */
    public function priorities() {
        if ($_POST) {
            /** Priorities validation */
            $this->form_validation->set_rules('main_page_priority', lang('Main page priority', 'sitemap'), "required|callback_priority_validation");
            $this->form_validation->set_rules('cats_priority', lang('Categories priority', 'sitemap'), "required|callback_priority_validation");
            $this->form_validation->set_rules('pages_priority', lang('Regular or usual pages priority', 'sitemap'), "required|callback_priority_validation");
            $this->form_validation->set_rules('sub_cats_priority', lang('Subcategories priority', 'sitemap'), "required|callback_priority_validation");
            if (SHOP_INSTALLED) {
                $this->form_validation->set_rules('products_priority', lang('Products priority', 'sitemap'), "required|callback_priority_validation");
                $this->form_validation->set_rules('brands_priority', lang('Brands priority', 'sitemap'), "required|callback_priority_validation");
                $this->form_validation->set_rules('products_categories_priority', lang('Products categories priority', 'sitemap'), "required|callback_priority_validation");
                $this->form_validation->set_rules('products_sub_categories_priority', lang('Products subcategories priority', 'sitemap'), "required|callback_priority_validation");
            }

            if ($this->form_validation->run($this) == FALSE) {
                showMessage(validation_errors(), lang("Error", "sitemap"), 'r');
                exit;
            }

            /**
             * Prepare data to update priorities
             * 
             */
            if (SHOP_INSTALLED) {
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
            } else {
                $data = array(
                    'main_page_priority' => $this->input->post('main_page_priority'),
                    'cats_priority' => $this->input->post('cats_priority'),
                    'pages_priority' => $this->input->post('pages_priority'),
                    'sub_cats_priority' => $this->input->post('sub_cats_priority'),
                );
            }

            /** Set priorities */
            if ($this->sitemap_model->updatePriorities($data)) {
                showMessage(lang("Changes have been saved", 'sitemap'), lang("Message", "sitemap"));
                $this->lib_admin->log(lang("Sitemaps priorities was edited", "sitemap"));
            } else {
                showMessage(lang("Changes have not been saved", 'sitemap'), lang("Error", "sitemap"), 'r');
            }

            $this->_viewSiteMap();
        } else {
            $priorities = $this->sitemap_model->getPriorities();

            \CMSFactory\assetManager::create()
                    ->setData($priorities)
                    ->registerStyle('style_rating')
                    ->registerScript('rating')
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
            if (SHOP_INSTALLED) {
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
            } else {
                $data = array(
                    'main_page_changefreq' => $this->input->post('main_page_changefreq'),
                    'categories_changefreq' => $this->input->post('categories_changefreq'),
                    'pages_changefreq' => $this->input->post('pages_changefreq'),
                    'categories_changefreq' => $this->input->post('categories_changefreq'),
                );
            }

            /** Set changefreq */
            if ($this->sitemap_model->updateChangefreq($data)) {
                showMessage(lang("Changes have been saved", 'sitemap'), lang("Message", "sitemap"));
                $this->lib_admin->log(lang("Sitemaps freq was edited", "sitemap"));
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
            $robots_check = $this->input->post('robots_check');

            if ($hide_urls) {
                foreach ($hide_urls as $key => $url) {
                    if ($url) {
                        $data[] = array(
                            'url' => $url,
                            'robots_check' => $robots_check[$key + 1] ? 1 : 0
                        );
                    }
                }
            }


            $this->robotsAdd($data);

            /** Set blockedUrls */
            if ($this->sitemap_model->updateBlockedUrls($data)) {
                showMessage(lang("Changes have been saved", 'sitemap'), lang("Message", "sitemap"));
                $this->lib_admin->log(lang("Sitemap block url was edited", "sitemap"));
            } else {
                if ($data) {
                    showMessage(lang("Changes have not been saved", 'sitemap'), lang("Error", "sitemap"), 'r');
                } else {
                    showMessage(lang("Changes have been saved", 'sitemap'), lang("Message", "sitemap"));
                    $this->lib_admin->log(lang("Sitemap block url was edited", "sitemap"));
                }
            }


            $this->_viewSiteMap();
        } else {

            $blockedUrls = $this->sitemap_model->getBlockedUrls();
            \CMSFactory\assetManager::create()
                    ->registerScript('admin')
                    ->setData('hide_urls', $this->prepareUrls($blockedUrls))
                    ->renderAdmin('blocked_urls');
        }
    }

    private function prepareUrls($blockedUrls) {
        $robots = file('robots.txt');

        $existingUrls = array();
        foreach ($blockedUrls as $url) {
            $existingUrls[$url['url']] = $url['url'];
        }

        foreach ($robots as $line) {
            if (strstr($line, 'Disallow:') && trim($line) != 'Disallow:') {
                preg_match('/\/((.?){1,})/', $line, $url);
                if (!$existingUrls[$url[1]] && trim($url[1]))
                    $blockedUrls[] = array('robots_check' => 1, 'url' => $url[1], 'id' => '');
            }
        }
        return $blockedUrls;
    }

    /**
     * Check robots 
     * @param type $url
     * @return boolean
     */
    public function robotsAdd($data) {
        $robots = file('robots.txt');

        foreach ($data as $url) {
            if ($url['robots_check']) {
                $putUrl = TRUE;

                foreach ($robots as $robot) {
                    preg_match('/\/((.?){1,})/', $robot, $robotUrl);
                    if ($robotUrl[1] === $url['url']) {
                        $putUrl = FALSE;
                        break;
                    }
                }

                if ($putUrl == TRUE) {
                    if (mb_strpos($url['url'], '/') === 0) {
                        $robots[] = PHP_EOL . 'Disallow: ' . $url['url'];
                    } else {
                        $robots[] = PHP_EOL . 'Disallow: /' . $url['url'];
                    }
                }
            } else {
                foreach ($robots as $key => $robot) {
                    preg_match('/\/((.?){1,})/', $robot, $robotUrl);
                    if ($robotUrl[1] === $url['url']) {
                        unset($robots[$key]);
                        break;
                    }
                }
            }
        }

        foreach ($robots as $key => $robot) {
            if (!trim($robot)) {
                unset($robots[$key]);
            } else {
                $robots[$key] = trim($robot) . PHP_EOL;
            }

            if (!$data) {
                if (strstr($robot, 'Disallow:') && $key > 1) {
                    unset($robots[$key]);
                }
            }
        }

        return file_put_contents('robots.txt', implode('', $robots));
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

        $this->template->show('file:' . 'application/' . getModContDirName('sitemap') . '/sitemap/templates/admin/' . $viewName);
        exit;

        if ($return === false)
            $this->template->show('file:' . 'application/' . getModContDirName('sitemap') . '/sitemap/templates/admin/' . $viewName);
        else
            return $this->template->fetch('file:' . 'application/' . getModContDirName('sitemap') . '/sitemap/templates/admin/' . $viewName);
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
