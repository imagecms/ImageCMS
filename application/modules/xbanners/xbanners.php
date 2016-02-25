<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

use xbanners\src\Installers\BannersModuleManager;
use xbanners\src\Installers\TemplatePlacesInstaller;
use xbanners\models\BannersQuery;
use xbanners\src\Statistic\ClickStatistic;
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
class Xbanners extends MY_Controller
{

    protected $moduleName = 'xbanners';

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load($this->moduleName);
    }

    public function index() {
        $this->core->error_404();
    }

    /**
     * @uses xbanners_helper.php getBanner()
     * @param string $place
     * @return BannersQuery
     */
    public function getBanner($place) {
        $locale = MY_Controller::getCurrentLocale();
        $pageId = \CI::$APP->core->core_data['id'];
        return BannersQuery::create()
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
                ->on('postTemplateInstall')
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
     * @param integer $imageId - banner image Id
     */
    public function go($imageId) {
        if ($imageId) {
            $click = new ClickStatistic($imageId);
            $click->run();
        } else {
            $this->core->error_404();
        }
    }

    public function show($data) {
        return CMSFactory\assetManager::create()
                        ->setData($data)
                        ->registerScript('slick.min')
                        ->fetchTemplate('banner');
    }

}