<?php

namespace core\models;

use core\models\Base\RouteQuery as BaseRouteQuery;
use core\models\Map\RouteTableMap;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\Connection\Exception\ConnectionException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Propel;

/**
 * Skeleton subclass for performing query and update operations on the 'route' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class RouteQuery extends BaseRouteQuery
{

    /**
     * @param string $old
     * @param string $new
     * @throws ConnectionException
     */
    public function updateParentUrl($old, $new) {

        $connection = Propel::getWriteConnection(RouteTableMap::DATABASE_NAME);
        $sql = "UPDATE route SET parent_url = REPLACE(parent_url,:old,:new) WHERE parent_url LIKE CONCAT(:old ,'%')";
        $connection->prepare($sql)->execute([':old' => $old, ':new' => $new]);

    }

    /**
     * @param Route $route
     * @throws PropelException
     */
    public function deleteWithChildren(Route $route) {
        $this->filterByParentUrl($route->getFullUrl() . '%', Criteria::LIKE)->delete();
        $route->delete();
    }

}