<?php

namespace core\src;

use core\models\Route;
use core\models\RouteQuery;
use core\src\Exception\PageNotFoundException;


/**
 * Class Router
 * @package core\src
 * @todo remove PageException and url check
 */
class Router
{

    private $modules = [];

    private $deniedSegments = [
                               '_install',
                               '_deinstall',
                               '_install_rules',
                               'autoload',
                               '__construct',
                              ];

    public function setModules(array $modules) {
        $this->modules = $modules;
    }

    public function findRoute($url) {
        $this->checkUrl($url);
        $url = trim($url, '/');

        if ($route = $this->isMainPage($url)) {
            return $route;
        }

        if ($route = $this->isRoute($url)) {
            return $route;
        }

        if ($route = $this->isModule($url)) {
            return $route;
        }
    }

    private function checkUrl($url) {
        if (strpos($url, '//') !== false) {
            throw new PageNotFoundException();
        }

        if (count(explode('/_', $url)) > 1) {
            throw  new PageNotFoundException();
        }

        foreach ($this->segments as $segment) {
            if (in_array($segment, $this->deniedSegments) == TRUE) {
                throw new PageNotFoundException();
            }
        }
    }

    private function isMainPage($url) {
        if ($url == '') {
            $route = new Route();
            $route->setType(Route::TYPE_MAIN);
            return $route;
        }
    }

    private function isRoute($url) {
        $routeUrl = explode('/', $url);
        $last = array_pop($routeUrl);

        $route = RouteQuery::create()->filterByUrl($last)
            ->findOne();

        if ($route && $this->checkRoute($route, $url)) {
            return $route;
        }
    }

    private function checkRoute(Route $route, $url) {
        if ($route->getRouteUrl() !== $url) {
            throw new PageNotFoundException();
        }
        return true;

    }

    /**
     * @param $url
     * @return Route
     */
    private function isModule($url) {

        $moduleSegments = explode('/', $url);
        $moduleName = array_shift($moduleSegments);

        foreach ($this->modules as $module) {
            if ($module['identif'] === $moduleName AND $module['enabled'] == 1) {

                $route = new Route();
                $route->setType(Route::TYPE_MODULE);
                $route->setUrl($url);
                return $route;
            }
        }
    }

}