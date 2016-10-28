<?php namespace core\src;

use core\models\Route;
use core\models\RouteQuery;

class RouteSubscriber
{

    public function getHandlers() {
        return [
                'Categories:create' => 'createCategoryRoute',
                'Categories:update' => 'updateCategoryRoute',
                'Categories:delete' => 'deleteCategoryRoute',

                'Page:create'       => 'createPageRoute',
                'Page:update'       => 'updatePageRoute',
                'Page:delete'       => 'deletePageRoute',
               ];

    }

    public function deletePageRoute($data) {
        RouteQuery::create()->filterByType(Route::TYPE_PAGE)->filterByEntityId($data['pageId'])->delete();
    }

    public function updatePageRoute($data) {
        $route = RouteQuery::create()->filterByType(Route::TYPE_PAGE)->findOneByEntityId($data['id']);

        if ($route) {
            $fullUrl = $data['cat_url'] . $data['url'];
            if ($route->getFullUrl() !== $fullUrl) {
                $route->setParentUrl(trim($data['cat_url'], '/'));
                $route->setUrl($data['url']);
                $route->save();
            }
        }
    }

    public function createPageRoute($data) {
        $route = new Route();
        $route->setEntityId($data['id'])
            ->setType(Route::TYPE_PAGE)
            ->setUrl($data['url'])
            ->setParentUrl(trim($data['cat_url'], '/'))
            ->save();

        \CI::$APP->db->where('id', $data['id'])->update('content', ['route_id' => $route->getId()]);
    }

    public function updateCategoryRoute($data) {

        $route = RouteQuery::create()->findOneById($data['route_id']);
        $parentRoute = RouteQuery::create()->filterByEntityId($data['parent_id'])->filterByType(Route::TYPE_CATEGORY)->findOne();
        $parentUrl = $parentRoute ? $parentRoute->getFullUrl() : '';
        $route->updateUrlRecursive($parentUrl, $data['url']);

    }

    public function createCategoryRoute($data) {
        $parentCategoryId = $data['parent_id'];

        $route = new Route();
        $route->setUrl($data['url']);
        $parentRoute = RouteQuery::create()->filterByEntityId($parentCategoryId)->filterByType(Route::TYPE_CATEGORY)->findOne();

        if ($parentRoute) {
            $route->setParentUrl($parentRoute->getFullUrl());
        }
        $route->setType(Route::TYPE_CATEGORY);
        $route->setEntityId($data['id']);
        $route->save();

        \CI::$APP->db->where('id', $data['id'])->update('category', ['route_id' => $route->getId()]);

    }

    public function deleteCategoryRoute($data) {
        RouteQuery::create()->filterByType(Route::TYPE_CATEGORY)->filterByEntityId($data['id'])->delete();

    }

}