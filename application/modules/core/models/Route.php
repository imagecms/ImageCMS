<?php

namespace core\models;

use core\models\Base\Route as BaseRoute;
use core\src\CoreConfiguration;
use core\src\CoreFactory;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\Collection\ObjectCollection;

/**
 * Skeleton subclass for representing a row from the 'route' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class Route extends BaseRoute
{
    const TYPE_SHOP_CATEGORY = 'shop_category';
    const TYPE_PRODUCT = 'product';
    const TYPE_CATEGORY = 'category';
    const TYPE_PAGE = 'page';
    const TYPE_MAIN = 'main';
    const TYPE_MODULE = 'module';

    /**
     * @param string $newParentUrl
     * @param string $newUrl
     */
    public function updateUrlRecursive($newParentUrl, $newUrl) {

        $oldUrl = $this->getFullUrl();

        if ($oldUrl !== $newParentUrl . '/' . $newUrl) {
            $this->setParentUrl($newParentUrl);
            $this->setUrl($newUrl);
            $this->save();
            RouteQuery::create()->updateParentUrl($oldUrl, $this->getFullUrl());
        }

    }

    /**
     * @return string
     */
    public function getRouteUrl() {
        return self::createRouteUrl($this->getUrl(), $this->getParentUrl(), $this->getType());
    }

    /**
     * @return string
     */
    public function getFullUrl() {
        $url = $this->getParentUrl() ? $this->getParentUrl() . '/' . $this->getUrl() : $this->getUrl();
        return $url;
    }

    /**
     * @return Route[]|ObjectCollection
     */
    public function getPathRoutes() {
        $parent = $this->getParentUrl();

        $collection = new ObjectCollection();
        $collection->setModel(get_class($this));

        if ($parent) {
            $segments = explode('/', $parent);
            $collection = RouteQuery::create()->orderByParentUrl(Criteria::ASC)->filterByUrl($segments, Criteria::IN)->find();
        }

        $collection->append($this);

        return $collection;
    }

    /**
     * @param string $url
     * @param string $parentUrl
     * @param int $type
     * @return string
     */
    public static function createRouteUrl($url, $parentUrl, $type) {
        $urlConfiguration = CoreFactory::getConfiguration()->getUrlRules();

        if (array_key_exists($type, $urlConfiguration)) {
            $rules = $urlConfiguration[$type];
        } else {
            $rules = [
                      'prefix' => '',
                      'parent' => true,
                     ];
        }

        if ($rules['parent'] && $parentUrl) {
            $url = $parentUrl . '/' . $url;
        }

        if ($rules['prefix']) {
            $url = $rules['prefix'] . '/' . $url;
        }

        return $url;
    }

}