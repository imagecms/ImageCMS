<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

use Banners\Installers\BannersModuleManager;
use Banners\Installers\TemplatePlacesInstaller;
use Banners\Statistic\ClickStatistic;
use template_manager\classes\Template;
use CMSFactory\Events;

/**
 * -----------------------------------------------------------------------------
 *                      USAGE(Interface):
 * -----------------------------------------------------------------------------
 *  1. Helper:    { echo getBanner('main_top') }               (front-end only!)
 *      get rendered tpl of Banner translated into current locale
 *          - string|null   getBanner(string $place, 'view'); default
 *      get translated into current Banner locale with all relations inside:
 *          - object|null   getBanner(string $place, 'object');
 *          - array|null    getBanner(string $place, 'array');
 * -----------------------------------------------------------------------------
 *  2. Queries:
 *      get Banner with all relations inside translated into passed lang or defaultLocale as defautl:
 *          - Banner BannersQuery::create()->getTranslatedByPlace(string $place, string $lang = null)
 * -----------------------------------------------------------------------------
 *  3. Banner object Methods:
 *      get array from concrete object with only initialized relations:
 *          - Banner $banner->asArray()
 *      get redrered tpl of concrete Banner object
 *          - Banner $banner->show()
 * -----------------------------------------------------------------------------
 *  4. Controller Methods:
 *      same functionality as p.1
 *          - Banner CI::$APP->load->module('xbanners')->getBanner(string $place)
 *          - string CI::$APP->load->module('xbanners')->getBanner(string $place)->show()
 *          - array  CI::$APP->load->module('xbanners')->gerBanner(string $place)->asArray()
 * -----------------------------------------------------------------------------
 */
class Xbanners extends MY_Controller {

    protected $moduleName = 'xbanners';

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load($this->moduleName);
        self::registerNameSpaces();
    }

    public function index() {
        $this->core->error_404();
    }

    /**
     * @uses xbanners_helper.php getBanner()
     * @param string $place
     * @return Banners\Models\Banners
     */
    public function getBanner($place) {
        $locale = MY_Controller::getCurrentLocale();
        $pageId = \CI::$APP->core->core_data['id'];
        return \Banners\Models\BannersQuery::create()
                        ->getTranslatedByPlace($place, $locale, $pageId);
    }

    /**
     * Front End Autoload
     */
    public function autoload() {
        $this->load->helper($this->moduleName);
    }

    /**
     * Install Module
     */
    public function _install() {
        $man = new BannersModuleManager();
        try {
            $man->install();
            $man->installTemplatePlaces();
        } catch (Exception $e) {

        }
    }

    /**
     * Uninstall Module
     */
    public function _deinstall() {
        try {
            (new BannersModuleManager())->deinstall();
        } catch (Exception $exc) {
            if ('development' === ENVIRONMENT) {
                echo $exc->getMessage();
            }
        }
    }

    /**
     * Admin Autoload Method
     *
     * Register Event Listener
     *      self::postTemplateInstallListener()
     */
    public static function adminAutoload() {
        Events::create()
                ->on("postTemplateInstall")
                ->setListener('postTemplateInstallListener');
    }

    /**
     * Event listener
     *
     * Listen TemplateManager::setTemplate() "postTemplateInstall" event
     * @param template_manager\classes\Template $template
     * @uses BannersInstaller
     */
    public static function postTemplateInstallListener(Template $template) {
        try {
            self::registerNameSpaces();
            $installer = new TemplatePlacesInstaller($template->name);
            $installer->install();
        } catch (Exception $exc) {
            if ('development' === ENVIRONMENT) {
                showMessage($exc->getMessage(), lang('Error', 'xbanners'), 'r');
            }
        }
    }

    /**
     * Go to banner url and run click statistic
     * @param int $imageId - banner image Id
     */
    public function go($imageId) {
        if ($imageId) {
            $click = new ClickStatistic($imageId);
            $click->run();
        } else {
            $this->core->error_404();
        }
    }

    protected static function registerNameSpaces() {
        ClassLoader::getInstance()
                ->registerNamespacedPath(__DIR__ . '/models/propel/generated-classes')
                ->registerAlias(__DIR__ . '/src', 'Banners');
    }

    public function show($data) {
        return CMSFactory\assetManager::create()
                        ->setData($data)
                        ->registerScript('slick.min')
                        ->fetchTemplate('banner');
    }

    /** -----------------------TEST AREA------------------------------------- */
    /** -----------------------TEST AREA------------------------------------- */
}