<?php namespace core\src;

use CI;
use CMSFactory\DependencyInjection\DependencyInjectionProvider;
use Doctrine\Common\Cache\Cache;

class CoreFactory
{

    /**
     * @var UrlParser
     */
    private static $urlParser;

    /**
     * @var CoreConfiguration
     */
    private static $configuration;

    /**
     * @var CoreModel
     */
    private static $model;

    /**
     * @var Router
     */
    private static $router;

    /**
     * @var FrontController
     */
    private static $frontController;

    /**
     * @return UrlParser
     */
    public static function getUrlParser() {
        return self::$urlParser ?: self::$urlParser = new UrlParser(self::getConfiguration());
    }

    /**
     * @return CoreConfiguration
     */
    public static function getConfiguration() {
        if (!self::$configuration) {
            self::$configuration = new CoreConfiguration();
            $settings = CI::$APP->load->model('cms_base')->get_settings();

            if (!\MY_Controller::isCorporateCMS()) {
                $settings['urlProductPrefix'] = \ShopCore::app()->SSettings->getUrlProductPrefix();
                $settings['urlProductParent'] = \ShopCore::app()->SSettings->getUrlProductParent();
                $settings['urlShopCategoryPrefix'] = \ShopCore::app()->SSettings->getUrlShopCategoryPrefix();
                $settings['urlShopCategoryParent'] = \ShopCore::app()->SSettings->getUrlShopCategoryParent();
            }

            self::$configuration->setSettings($settings);
            self::$configuration->setLanguages(self::getModel()->getLanguages());
            self::$configuration->setDefaultLanguage(self::getModel()->getDefaultLanguage());
        }
        return self::$configuration;
    }

    /**
     * @return CoreModel
     */
    public static function getModel() {
        return self::$model ?: self::$model = new CoreModel(CI::$APP, self::getCache());
    }

    /**
     * @return Router
     */
    public static function getRouter() {
        return self::$router ?: self::$router = new Router();
    }

    /**
     * @return Cache
     */
    public static function getCache() {
        return DependencyInjectionProvider::getContainer()->get('cache');
    }

    /**
     * @return FrontController
     */
    public static function getFrontController() {
        return self::$frontController ?: self::$frontController = new FrontController(CI::$APP, self::getModel(), self::getRouter());
    }

}