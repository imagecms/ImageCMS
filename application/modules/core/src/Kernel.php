<?php namespace core\src;

use CI;
use CMSFactory\Events;
use core\src\Exception\PageNotFoundException;
use Doctrine\Common\Cache\CacheProvider;

use Symfony\Component\Debug\Debug;
use Symfony\Component\Debug\DebugClassLoader;
use Symfony\Component\Debug\ErrorHandler;
use Symfony\Component\Debug\ExceptionHandler;

class Kernel
{

    /**
     * @var CI
     */
    private $ci;

    /**
     * @var CacheProvider
     */
    private $cache;

    /**
     * @var array
     */
    private $modules;

    /**
     * @var array
     */
    private $templateData;

    /**
     * @var CoreModel
     */
    private $codeModel;

    /**
     * @var CoreConfiguration
     */
    private $configuration;

    /**
     * @var UrlParser
     */
    private $urlParser;

    /**
     * @var \Core
     */
    private $core;

    /**
     * Kernel constructor.
     * @param \Core $core
     * @param CI $ci
     */
    public function __construct($core, CI $ci) {

        $this->ci = $ci;
        $this->core = $core;
        $this->configuration = CoreFactory::getConfiguration();
        $this->cache = CoreFactory::getCache();
        $this->codeModel = CoreFactory::getModel();
        $this->urlParser = CoreFactory::getUrlParser();

        $this->configuration->setLanguages($this->codeModel->getLanguages());
        $this->configuration->setDefaultLanguage($this->codeModel->getDefaultLanguage());

        $this->ci->config->set_item('template', $this->configuration->getSettings()['site_template']);

        $this->ci->load->module('cfcm');
        $this->ci->load->library('template');
        $this->ci->load->library('lib_seo');
        $this->ci->load->library('DX_Auth');

        $this->ci->lib_seo->init($core->settings);

    }

    public function run() {

        try {

            $this->registerErrorHandler();

            $url = $this->ci->input->server('REQUEST_URI');

            if(!$url && $this->ci->input->is_cli_request()) {
                $url = $this->ci->uri->uri_string();
            }

            $this->urlParser->parse($url);

            $this->setLanguage();

            $this->loadFunctionsFile();

            $this->checkOffline();

            SHOP_INSTALLED && class_exists('\ShopCore') && \ShopCore::initEnviroment();

            $this->initModules();

            $this->assignTemplateData();

            Events::create()->registerEvent(NULL, 'Core:pageLoaded');

            CoreFactory::getRouter()->setModules($this->modules);
            $this->configuration->setModules($this->modules);
            $this->ci->template->add_array($this->templateData);

            CoreFactory::getFrontController()->display($this->urlParser->getUrl());
        } catch (PageNotFoundException $e) {
            $this->core->core_data['data_type'] = '404';
            $this->core->core_data['id'] = null;
            $this->core->error_404();
        }

    }

    private function registerErrorHandler() {
        if (ENVIRONMENT === 'development') {
            Debug::enable(E_ERROR | E_PARSE);
            ErrorHandler::register();
            ExceptionHandler::register();
            DebugClassLoader::enable();
        }
    }

    private function assignTemplateData() {
        if ($this->ci->dx_auth->is_logged_in() == TRUE) {
            $this->templateData['is_logged_in'] = TRUE;
            $this->templateData['username'] = $this->ci->dx_auth->get_username();
        }
        $this->ci->template->add_array(['agent' => $this->user_browser()]);

        if ($this->dx_auth->use_recaptcha) {
            $this->templateData['captcha_type'] = 'recaptcha';
        } else {
            $this->templateData['captcha_type'] = 'captcha';
        }
    }

    private function user_browser() {

        $agent = $this->ci->load->library('user_agent');
        $browserIn = [
                      '0' => $agent->browser(),
                      '1' => $agent->version(),
                     ];
        return $browserIn;
    }

    private function initModules() {

        $query = $this->ci->cms_base->get_modules();

        if ($query->num_rows() > 0) {
            $this->modules = $query->result_array();

            foreach ($this->modules as $module) {
                $moduleLinks[$module['name']] = '/' . $module['identif'];
            }

            $this->templateData['modules'] = $moduleLinks;
        }

        foreach ($this->modules as $module) {
            if ($module['autoload'] == 1) {
                $mod_name = $module['name'];

                $module = $this->ci->load->module($mod_name);
                if (method_exists($module, 'autoload') === TRUE) {
                    $this->core_data['module'] = $mod_name;
                    $module->autoload();
                }
            }
        }
    }

    /**
     * Show offline page if site in offline mode
     */
    private function checkOffline() {
        $isMainSaasRequest = 0 === strpos($this->ci->input->server('PATH_INFO'), '/mainsaas');
        $siteIsOffline = $this->configuration->getSettings()['site_offline'] == 'yes';
        $isAdmin = $this->ci->session->userdata('DX_role_id') == 1;
        if ($siteIsOffline && !$isMainSaasRequest && !$isAdmin) {
            header('HTTP/1.1 503 Service Unavailable');
            $this->ci->template->display('offline');
            exit;
        }
    }

    /**
     * Reset template path
     * and configurations
     * @return string|null
     */
    private function setLanguage() {

        if ($locale = $this->urlParser->getLocale()) {
            $defaultLanguage = $this->configuration->getDefaultLanguage();

            if ($locale == $defaultLanguage['identif']) {
                $this->redirectWithoutLocale();
            }

            $this->setLanguageConfiguration($this->configuration->getLanguages()[$locale]);

            // Reload template settings
            $this->ci->template->set_config_value('tpl_path', TEMPLATES_PATH . $this->configuration->getSettings()['site_template'] . '/');
            $this->ci->template->load();
            // Add language identifier to base_url
            $this->ci->config->set_item('base_url', base_url() . $locale);

        } else {
            $this->setLanguageConfiguration($this->configuration->getDefaultLanguage());
        }

    }

    /**
     * redirect to url without default lang segment
     */
    private function redirectWithoutLocale() {

        $get = $this->ci->input->server('QUERY_STRING') ? '?' . $this->ci->input->server('QUERY_STRING') : '';
        $url = implode('/', array_slice($this->ci->uri->segment_array(), 1));
        header('Location:/' . $url . $get);
        exit;

    }

    /**
     * @param array $language
     */
    private function setLanguageConfiguration(array $language) {
        $this->configuration->setCurrentLanguage($language);
        $this->ci->config->set_item('language', $language['folder']);
        $this->ci->config->set_item('cur_lang', $language['id']);
        $this->ci->lang->load('main', $language['folder']);
    }

    /**
     * Include functions from template
     */
    private function loadFunctionsFile() {

        $settings = $this->configuration->getSettings();
        $full_path = './templates/' . $settings['site_template'] . '/functions.php';

        if (file_exists($full_path)) {
            include_once $full_path;
        }
    }

}