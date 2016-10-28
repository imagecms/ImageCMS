<?php namespace core\src;

use CI;
use CMSFactory\Events;
use core\models\Route;
use core\src\Controller\CategoryController;
use core\src\Controller\PageController;
use core\src\Exception\PageNotFoundException;

class FrontController
{

    /**
     * @var CI
     */
    private $ci;

    /**
     * @var CoreModel
     */
    private $frontModel;

    /**
     * @var Router
     */
    private $router;

    /**
     * FrontController constructor.
     * @param CI $ci
     * @param CoreModel $frontModel
     * @param Router $router
     */
    public function __construct(CI $ci, CoreModel $frontModel, Router $router) {
        $this->ci = $ci;
        $this->frontModel = $frontModel;
        $this->router = $router;
    }

    /**
     * @param string $url
     * @throws PageNotFoundException
     */
    public function display($url) {

        $route = $this->router->findRoute($url);

        if (!$route) {
            throw new PageNotFoundException();
        }

        $this->ci->core->core_data['data_type'] = $route->getType();
        $id = $route->getEntityId();
        $this->ci->core->core_data['id'] = $id;

        CoreFactory::getConfiguration()->setCurrentEntityType($route->getType());
        CoreFactory::getConfiguration()->setCurrentEntityId($id);

        switch ($route->getType()) {
            case Route::TYPE_MAIN:
                $this->main();
                break;
            case Route::TYPE_PRODUCT:
                $this->product($id);
                break;
            case Route::TYPE_SHOP_CATEGORY:
                $this->shopCategory($id);
                break;
            case Route::TYPE_CATEGORY:
                $this->category($id);
                break;
            case Route::TYPE_PAGE:
                $this->page($id);
                break;
            case Route::TYPE_MODULE:
                $this->module($route->getUrl());
                break;
            default:
                throw new PageNotFoundException();

        }
    }

    private function main() {

        if ($this->ci->input->get() || strstr($this->ci->input->server('REQUEST_URI'), '?')) {
            $this->ci->template->registerCanonical(site_url());
        }

        Events::create()->registerEvent(NULL, 'Core:_mainPage')->runFactory();

        $settings = CoreFactory::getConfiguration()->getSettings();

        switch ($settings['main_type']) {
            case 'page':
                Events::create()->registerEvent(NULL, 'Core:_mainPage')->runFactory();
                $this->page($settings['main_page_id']);
                break;
            case 'category':
                $this->category($settings['main_page_cat']);
                break;
            case 'module':
                $this->module($settings['main_page_module']);
                break;
        }
    }

    /**
     * @param int $id
     */
    private function page($id) {

        (new PageController($this->ci, $this->frontModel))->index($id);
    }

    /**
     * @param int $id
     */
    private function category($id) {
        (new CategoryController($this->ci, $this->frontModel))->index($id);
    }

    /**
     * @param int $id
     */
    private function shopCategory($id) {
        $this->module('shop/category/index/' . $id);
    }

    /**
     * @param int $id
     */
    private function product($id) {

        if ($this->ci->input->get() || strstr($this->ci->input->server('REQUEST_URI'), '?')) {
            $this->ci->template->registerCanonical(site_url($this->ci->uri->uri_string()));
        }

        $this->module('shop/product/index/' . $id);

    }

    /**
     * @param string $url
     * @throws PageNotFoundException
     */
    private function module($url) {

        $moduleSegments = explode('/', $url);

        $moduleName = array_shift($moduleSegments);
        $moduleMethod = array_shift($moduleSegments);
        if ($moduleMethod == FALSE) {
            $moduleMethod = 'index';
        }

        $file = getModulePath($moduleName) . $moduleMethod . EXT;
        $this->core_data['module'] = $moduleName;

        if (file_exists($file)) {
            $moduleAction = array_shift($moduleSegments) ?: 'index';
            $moduleFullPath = $moduleName . '/' . $moduleMethod;
            $module = $this->ci->load->module($moduleName . '/' . $moduleMethod);

        } else {
            $moduleAction = $moduleMethod;
            $moduleFullPath = $moduleName . '/' . $moduleName;
            $module = $this->ci->load->module($moduleName);
        }

        $args = $moduleSegments;
        if (method_exists($module, $moduleAction)) {
            echo \modules::run($moduleFullPath . '/' . $moduleAction, $args);
        } else {
            throw new PageNotFoundException();
        }
    }

}