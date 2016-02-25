<?php

namespace xbanners\models\Map;

use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;
use xbanners\models\BannerImage;
use xbanners\models\BannerImageQuery;


/**
 * This class defines the structure of the 'banner_image' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class BannerImageTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'xbanners.models.Map.BannerImageTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'Shop';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'banner_image';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\xbanners\\models\\BannerImage';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'xbanners.models.BannerImage';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 10;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 10;

    /**
     * the column name for the id field
     */
    const COL_ID = 'banner_image.id';

    /**
     * the column name for the banner_id field
     */
    const COL_BANNER_ID = 'banner_image.banner_id';

    /**
     * the column name for the target field
     */
    const COL_TARGET = 'banner_image.target';

    /**
     * the column name for the url field
     */
    const COL_URL = 'banner_image.url';

    /**
     * the column name for the allowed_page field
     */
    const COL_ALLOWED_PAGE = 'banner_image.allowed_page';

    /**
     * the column name for the position field
     */
    const COL_POSITION = 'banner_image.position';

    /**
     * the column name for the active_from field
     */
    const COL_ACTIVE_FROM = 'banner_image.active_from';

    /**
     * the column name for the active_to field
     */
    const COL_ACTIVE_TO = 'banner_image.active_to';

    /**
     * the column name for the active field
     */
    const COL_ACTIVE = 'banner_image.active';

    /**
     * the column name for the permanent field
     */
    const COL_PERMANENT = 'banner_image.permanent';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    // i18n behavior

    /**
     * The default locale to use for translations.
     *
     * @var string
     */
    const DEFAULT_LOCALE = 'ru';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Id', 'BannerId', 'Target', 'Url', 'AllowedPage', 'Position', 'ActiveFrom', 'ActiveTo', 'Active', 'Permanent', ),
        self::TYPE_CAMELNAME     => array('id', 'bannerId', 'target', 'url', 'allowedPage', 'position', 'activeFrom', 'activeTo', 'active', 'permanent', ),
        self::TYPE_COLNAME       => array(BannerImageTableMap::COL_ID, BannerImageTableMap::COL_BANNER_ID, BannerImageTableMap::COL_TARGET, BannerImageTableMap::COL_URL, BannerImageTableMap::COL_ALLOWED_PAGE, BannerImageTableMap::COL_POSITION, BannerImageTableMap::COL_ACTIVE_FROM, BannerImageTableMap::COL_ACTIVE_TO, BannerImageTableMap::COL_ACTIVE, BannerImageTableMap::COL_PERMANENT, ),
        self::TYPE_FIELDNAME     => array('id', 'banner_id', 'target', 'url', 'allowed_page', 'position', 'active_from', 'active_to', 'active', 'permanent', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'BannerId' => 1, 'Target' => 2, 'Url' => 3, 'AllowedPage' => 4, 'Position' => 5, 'ActiveFrom' => 6, 'ActiveTo' => 7, 'Active' => 8, 'Permanent' => 9, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'bannerId' => 1, 'target' => 2, 'url' => 3, 'allowedPage' => 4, 'position' => 5, 'activeFrom' => 6, 'activeTo' => 7, 'active' => 8, 'permanent' => 9, ),
        self::TYPE_COLNAME       => array(BannerImageTableMap::COL_ID => 0, BannerImageTableMap::COL_BANNER_ID => 1, BannerImageTableMap::COL_TARGET => 2, BannerImageTableMap::COL_URL => 3, BannerImageTableMap::COL_ALLOWED_PAGE => 4, BannerImageTableMap::COL_POSITION => 5, BannerImageTableMap::COL_ACTIVE_FROM => 6, BannerImageTableMap::COL_ACTIVE_TO => 7, BannerImageTableMap::COL_ACTIVE => 8, BannerImageTableMap::COL_PERMANENT => 9, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'banner_id' => 1, 'target' => 2, 'url' => 3, 'allowed_page' => 4, 'position' => 5, 'active_from' => 6, 'active_to' => 7, 'active' => 8, 'permanent' => 9, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('banner_image');
        $this->setPhpName('BannerImage');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\xbanners\\models\\BannerImage');
        $this->setPackage('xbanners.models');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, 11, null);
        $this->addForeignKey('banner_id', 'BannerId', 'INTEGER', 'banners', 'id', true, 11, null);
        $this->addColumn('target', 'Target', 'INTEGER', false, 2, null);
        $this->addColumn('url', 'Url', 'VARCHAR', false, 255, null);
        $this->addColumn('allowed_page', 'AllowedPage', 'INTEGER', false, 11, null);
        $this->addColumn('position', 'Position', 'INTEGER', false, 11, null);
        $this->addColumn('active_from', 'ActiveFrom', 'INTEGER', false, 11, null);
        $this->addColumn('active_to', 'ActiveTo', 'INTEGER', false, 11, null);
        $this->addColumn('active', 'Active', 'INTEGER', false, 1, null);
        $this->addColumn('permanent', 'Permanent', 'INTEGER', false, 1, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Banners', '\\xbanners\\models\\Banners', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':banner_id',
    1 => ':id',
  ),
), 'CASCADE', 'CASCADE', null, false);
        $this->addRelation('BannerImageI18n', '\\xbanners\\models\\BannerImageI18n', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':id',
    1 => ':id',
  ),
), 'CASCADE', null, 'BannerImageI18ns', false);
    } // buildRelations()

    /**
     *
     * Gets the list of behaviors registered for this table
     *
     * @return array Associative array (name => parameters) of behaviors
     */
    public function getBehaviors()
    {
        return array(
            'i18n' => array('i18n_table' => '%TABLE%_i18n', 'i18n_phpname' => '%PHPNAME%I18n', 'i18n_columns' => 'src, name, clicks, description', 'i18n_pk_column' => '', 'locale_column' => 'locale', 'locale_length' => '5', 'default_locale' => 'ru', 'locale_alias' => '', ),
        );
    } // getBehaviors()
    /**
     * Method to invalidate the instance pool of all tables related to banner_image     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        BannerImageI18nTableMap::clearInstancePool();
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? BannerImageTableMap::CLASS_DEFAULT : BannerImageTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (BannerImage object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = BannerImageTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = BannerImageTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + BannerImageTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = BannerImageTableMap::OM_CLASS;
            /** @var BannerImage $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            BannerImageTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = BannerImageTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = BannerImageTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var BannerImage $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                BannerImageTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(BannerImageTableMap::COL_ID);
            $criteria->addSelectColumn(BannerImageTableMap::COL_BANNER_ID);
            $criteria->addSelectColumn(BannerImageTableMap::COL_TARGET);
            $criteria->addSelectColumn(BannerImageTableMap::COL_URL);
            $criteria->addSelectColumn(BannerImageTableMap::COL_ALLOWED_PAGE);
            $criteria->addSelectColumn(BannerImageTableMap::COL_POSITION);
            $criteria->addSelectColumn(BannerImageTableMap::COL_ACTIVE_FROM);
            $criteria->addSelectColumn(BannerImageTableMap::COL_ACTIVE_TO);
            $criteria->addSelectColumn(BannerImageTableMap::COL_ACTIVE);
            $criteria->addSelectColumn(BannerImageTableMap::COL_PERMANENT);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.banner_id');
            $criteria->addSelectColumn($alias . '.target');
            $criteria->addSelectColumn($alias . '.url');
            $criteria->addSelectColumn($alias . '.allowed_page');
            $criteria->addSelectColumn($alias . '.position');
            $criteria->addSelectColumn($alias . '.active_from');
            $criteria->addSelectColumn($alias . '.active_to');
            $criteria->addSelectColumn($alias . '.active');
            $criteria->addSelectColumn($alias . '.permanent');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(BannerImageTableMap::DATABASE_NAME)->getTable(BannerImageTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(BannerImageTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(BannerImageTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new BannerImageTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a BannerImage or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or BannerImage object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BannerImageTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \xbanners\models\BannerImage) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(BannerImageTableMap::DATABASE_NAME);
            $criteria->add(BannerImageTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = BannerImageQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            BannerImageTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                BannerImageTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the banner_image table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return BannerImageQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a BannerImage or Criteria object.
     *
     * @param mixed               $criteria Criteria or BannerImage object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BannerImageTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from BannerImage object
        }

        if ($criteria->containsKey(BannerImageTableMap::COL_ID) && $criteria->keyContainsValue(BannerImageTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.BannerImageTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = BannerImageQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // BannerImageTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BannerImageTableMap::buildTableMap();
