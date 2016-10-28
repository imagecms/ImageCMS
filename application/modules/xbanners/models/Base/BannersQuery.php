<?php

namespace xbanners\models\Base;

use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use xbanners\models\Banners as ChildBanners;
use xbanners\models\BannersI18nQuery as ChildBannersI18nQuery;
use xbanners\models\BannersQuery as ChildBannersQuery;
use xbanners\models\Map\BannerImageTableMap;
use xbanners\models\Map\BannersI18nTableMap;
use xbanners\models\Map\BannersTableMap;

/**
 * Base class that represents a query for the 'banners' table.
 *
 *
 *
 * @method     ChildBannersQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildBannersQuery orderByPlace($order = Criteria::ASC) Order by the place column
 * @method     ChildBannersQuery orderByWidth($order = Criteria::ASC) Order by the width column
 * @method     ChildBannersQuery orderByHeight($order = Criteria::ASC) Order by the height column
 * @method     ChildBannersQuery orderByEffects($order = Criteria::ASC) Order by the effects column
 * @method     ChildBannersQuery orderByPageType($order = Criteria::ASC) Order by the page_type column
 *
 * @method     ChildBannersQuery groupById() Group by the id column
 * @method     ChildBannersQuery groupByPlace() Group by the place column
 * @method     ChildBannersQuery groupByWidth() Group by the width column
 * @method     ChildBannersQuery groupByHeight() Group by the height column
 * @method     ChildBannersQuery groupByEffects() Group by the effects column
 * @method     ChildBannersQuery groupByPageType() Group by the page_type column
 *
 * @method     ChildBannersQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildBannersQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildBannersQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildBannersQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildBannersQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildBannersQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildBannersQuery leftJoinBannerImage($relationAlias = null) Adds a LEFT JOIN clause to the query using the BannerImage relation
 * @method     ChildBannersQuery rightJoinBannerImage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BannerImage relation
 * @method     ChildBannersQuery innerJoinBannerImage($relationAlias = null) Adds a INNER JOIN clause to the query using the BannerImage relation
 *
 * @method     ChildBannersQuery joinWithBannerImage($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BannerImage relation
 *
 * @method     ChildBannersQuery leftJoinWithBannerImage() Adds a LEFT JOIN clause and with to the query using the BannerImage relation
 * @method     ChildBannersQuery rightJoinWithBannerImage() Adds a RIGHT JOIN clause and with to the query using the BannerImage relation
 * @method     ChildBannersQuery innerJoinWithBannerImage() Adds a INNER JOIN clause and with to the query using the BannerImage relation
 *
 * @method     ChildBannersQuery leftJoinBannersI18n($relationAlias = null) Adds a LEFT JOIN clause to the query using the BannersI18n relation
 * @method     ChildBannersQuery rightJoinBannersI18n($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BannersI18n relation
 * @method     ChildBannersQuery innerJoinBannersI18n($relationAlias = null) Adds a INNER JOIN clause to the query using the BannersI18n relation
 *
 * @method     ChildBannersQuery joinWithBannersI18n($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BannersI18n relation
 *
 * @method     ChildBannersQuery leftJoinWithBannersI18n() Adds a LEFT JOIN clause and with to the query using the BannersI18n relation
 * @method     ChildBannersQuery rightJoinWithBannersI18n() Adds a RIGHT JOIN clause and with to the query using the BannersI18n relation
 * @method     ChildBannersQuery innerJoinWithBannersI18n() Adds a INNER JOIN clause and with to the query using the BannersI18n relation
 *
 * @method     \xbanners\models\BannerImageQuery|\xbanners\models\BannersI18nQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildBanners findOne(ConnectionInterface $con = null) Return the first ChildBanners matching the query
 * @method     ChildBanners findOneOrCreate(ConnectionInterface $con = null) Return the first ChildBanners matching the query, or a new ChildBanners object populated from the query conditions when no match is found
 *
 * @method     ChildBanners findOneById(int $id) Return the first ChildBanners filtered by the id column
 * @method     ChildBanners findOneByPlace(string $place) Return the first ChildBanners filtered by the place column
 * @method     ChildBanners findOneByWidth(int $width) Return the first ChildBanners filtered by the width column
 * @method     ChildBanners findOneByHeight(int $height) Return the first ChildBanners filtered by the height column
 * @method     ChildBanners findOneByEffects(string $effects) Return the first ChildBanners filtered by the effects column
 * @method     ChildBanners findOneByPageType(string $page_type) Return the first ChildBanners filtered by the page_type column *

 * @method     ChildBanners requirePk($key, ConnectionInterface $con = null) Return the ChildBanners by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBanners requireOne(ConnectionInterface $con = null) Return the first ChildBanners matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBanners requireOneById(int $id) Return the first ChildBanners filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBanners requireOneByPlace(string $place) Return the first ChildBanners filtered by the place column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBanners requireOneByWidth(int $width) Return the first ChildBanners filtered by the width column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBanners requireOneByHeight(int $height) Return the first ChildBanners filtered by the height column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBanners requireOneByEffects(string $effects) Return the first ChildBanners filtered by the effects column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBanners requireOneByPageType(string $page_type) Return the first ChildBanners filtered by the page_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBanners[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildBanners objects based on current ModelCriteria
 * @method     ChildBanners[]|ObjectCollection findById(int $id) Return ChildBanners objects filtered by the id column
 * @method     ChildBanners[]|ObjectCollection findByPlace(string $place) Return ChildBanners objects filtered by the place column
 * @method     ChildBanners[]|ObjectCollection findByWidth(int $width) Return ChildBanners objects filtered by the width column
 * @method     ChildBanners[]|ObjectCollection findByHeight(int $height) Return ChildBanners objects filtered by the height column
 * @method     ChildBanners[]|ObjectCollection findByEffects(string $effects) Return ChildBanners objects filtered by the effects column
 * @method     ChildBanners[]|ObjectCollection findByPageType(string $page_type) Return ChildBanners objects filtered by the page_type column
 * @method     ChildBanners[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class BannersQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \xbanners\models\Base\BannersQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'Shop', $modelName = '\\xbanners\\models\\Banners', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildBannersQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildBannersQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildBannersQuery) {
            return $criteria;
        }
        $query = new ChildBannersQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildBanners|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(BannersTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = BannersTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildBanners A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, place, width, height, effects, page_type FROM banners WHERE id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildBanners $obj */
            $obj = new ChildBanners();
            $obj->hydrate($row);
            BannersTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildBanners|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildBannersQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(BannersTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildBannersQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(BannersTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBannersQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(BannersTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(BannersTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BannersTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the place column
     *
     * Example usage:
     * <code>
     * $query->filterByPlace('fooValue');   // WHERE place = 'fooValue'
     * $query->filterByPlace('%fooValue%', Criteria::LIKE); // WHERE place LIKE '%fooValue%'
     * </code>
     *
     * @param     string $place The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBannersQuery The current query, for fluid interface
     */
    public function filterByPlace($place = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($place)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BannersTableMap::COL_PLACE, $place, $comparison);
    }

    /**
     * Filter the query on the width column
     *
     * Example usage:
     * <code>
     * $query->filterByWidth(1234); // WHERE width = 1234
     * $query->filterByWidth(array(12, 34)); // WHERE width IN (12, 34)
     * $query->filterByWidth(array('min' => 12)); // WHERE width > 12
     * </code>
     *
     * @param     mixed $width The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBannersQuery The current query, for fluid interface
     */
    public function filterByWidth($width = null, $comparison = null)
    {
        if (is_array($width)) {
            $useMinMax = false;
            if (isset($width['min'])) {
                $this->addUsingAlias(BannersTableMap::COL_WIDTH, $width['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($width['max'])) {
                $this->addUsingAlias(BannersTableMap::COL_WIDTH, $width['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BannersTableMap::COL_WIDTH, $width, $comparison);
    }

    /**
     * Filter the query on the height column
     *
     * Example usage:
     * <code>
     * $query->filterByHeight(1234); // WHERE height = 1234
     * $query->filterByHeight(array(12, 34)); // WHERE height IN (12, 34)
     * $query->filterByHeight(array('min' => 12)); // WHERE height > 12
     * </code>
     *
     * @param     mixed $height The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBannersQuery The current query, for fluid interface
     */
    public function filterByHeight($height = null, $comparison = null)
    {
        if (is_array($height)) {
            $useMinMax = false;
            if (isset($height['min'])) {
                $this->addUsingAlias(BannersTableMap::COL_HEIGHT, $height['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($height['max'])) {
                $this->addUsingAlias(BannersTableMap::COL_HEIGHT, $height['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BannersTableMap::COL_HEIGHT, $height, $comparison);
    }

    /**
     * Filter the query on the effects column
     *
     * Example usage:
     * <code>
     * $query->filterByEffects('fooValue');   // WHERE effects = 'fooValue'
     * $query->filterByEffects('%fooValue%', Criteria::LIKE); // WHERE effects LIKE '%fooValue%'
     * </code>
     *
     * @param     string $effects The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBannersQuery The current query, for fluid interface
     */
    public function filterByEffects($effects = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($effects)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BannersTableMap::COL_EFFECTS, $effects, $comparison);
    }

    /**
     * Filter the query on the page_type column
     *
     * Example usage:
     * <code>
     * $query->filterByPageType('fooValue');   // WHERE page_type = 'fooValue'
     * $query->filterByPageType('%fooValue%', Criteria::LIKE); // WHERE page_type LIKE '%fooValue%'
     * </code>
     *
     * @param     string $pageType The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBannersQuery The current query, for fluid interface
     */
    public function filterByPageType($pageType = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($pageType)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BannersTableMap::COL_PAGE_TYPE, $pageType, $comparison);
    }

    /**
     * Filter the query by a related \xbanners\models\BannerImage object
     *
     * @param \xbanners\models\BannerImage|ObjectCollection $bannerImage the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildBannersQuery The current query, for fluid interface
     */
    public function filterByBannerImage($bannerImage, $comparison = null)
    {
        if ($bannerImage instanceof \xbanners\models\BannerImage) {
            return $this
                ->addUsingAlias(BannersTableMap::COL_ID, $bannerImage->getBannerId(), $comparison);
        } elseif ($bannerImage instanceof ObjectCollection) {
            return $this
                ->useBannerImageQuery()
                ->filterByPrimaryKeys($bannerImage->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByBannerImage() only accepts arguments of type \xbanners\models\BannerImage or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BannerImage relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildBannersQuery The current query, for fluid interface
     */
    public function joinBannerImage($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BannerImage');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'BannerImage');
        }

        return $this;
    }

    /**
     * Use the BannerImage relation BannerImage object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \xbanners\models\BannerImageQuery A secondary query class using the current class as primary query
     */
    public function useBannerImageQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinBannerImage($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BannerImage', '\xbanners\models\BannerImageQuery');
    }

    /**
     * Filter the query by a related \xbanners\models\BannersI18n object
     *
     * @param \xbanners\models\BannersI18n|ObjectCollection $bannersI18n the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildBannersQuery The current query, for fluid interface
     */
    public function filterByBannersI18n($bannersI18n, $comparison = null)
    {
        if ($bannersI18n instanceof \xbanners\models\BannersI18n) {
            return $this
                ->addUsingAlias(BannersTableMap::COL_ID, $bannersI18n->getId(), $comparison);
        } elseif ($bannersI18n instanceof ObjectCollection) {
            return $this
                ->useBannersI18nQuery()
                ->filterByPrimaryKeys($bannersI18n->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByBannersI18n() only accepts arguments of type \xbanners\models\BannersI18n or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BannersI18n relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildBannersQuery The current query, for fluid interface
     */
    public function joinBannersI18n($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BannersI18n');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'BannersI18n');
        }

        return $this;
    }

    /**
     * Use the BannersI18n relation BannersI18n object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \xbanners\models\BannersI18nQuery A secondary query class using the current class as primary query
     */
    public function useBannersI18nQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinBannersI18n($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BannersI18n', '\xbanners\models\BannersI18nQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildBanners $banners Object to remove from the list of results
     *
     * @return $this|ChildBannersQuery The current query, for fluid interface
     */
    public function prune($banners = null)
    {
        if ($banners) {
            $this->addUsingAlias(BannersTableMap::COL_ID, $banners->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the banners table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BannersTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += $this->doOnDeleteCascade($con);
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            BannersTableMap::clearInstancePool();
            BannersTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BannersTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(BannersTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            // cloning the Criteria in case it's modified by doSelect() or doSelectStmt()
            $c = clone $criteria;
            $affectedRows += $c->doOnDeleteCascade($con);

            BannersTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            BannersTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * This is a method for emulating ON DELETE CASCADE for DBs that don't support this
     * feature (like MySQL or SQLite).
     *
     * This method is not very speedy because it must perform a query first to get
     * the implicated records and then perform the deletes by calling those Query classes.
     *
     * This method should be used within a transaction if possible.
     *
     * @param ConnectionInterface $con
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    protected function doOnDeleteCascade(ConnectionInterface $con)
    {
        // initialize var to track total num of affected rows
        $affectedRows = 0;

        // first find the objects that are implicated by the $this
        $objects = ChildBannersQuery::create(null, $this)->find($con);
        foreach ($objects as $obj) {


            // delete related BannerImage objects
            $query = new \xbanners\models\BannerImageQuery;

            $query->add(BannerImageTableMap::COL_BANNER_ID, $obj->getId());
            $affectedRows += $query->delete($con);

            // delete related BannersI18n objects
            $query = new \xbanners\models\BannersI18nQuery;

            $query->add(BannersI18nTableMap::COL_ID, $obj->getId());
            $affectedRows += $query->delete($con);
        }

        return $affectedRows;
    }

    // i18n behavior

    /**
     * Adds a JOIN clause to the query using the i18n relation
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    ChildBannersQuery The current query, for fluid interface
     */
    public function joinI18n($locale = 'ru', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $relationName = $relationAlias ? $relationAlias : 'BannersI18n';

        return $this
            ->joinBannersI18n($relationAlias, $joinType)
            ->addJoinCondition($relationName, $relationName . '.Locale = ?', $locale);
    }

    /**
     * Adds a JOIN clause to the query and hydrates the related I18n object.
     * Shortcut for $c->joinI18n($locale)->with()
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    $this|ChildBannersQuery The current query, for fluid interface
     */
    public function joinWithI18n($locale = 'ru', $joinType = Criteria::LEFT_JOIN)
    {
        $this
            ->joinI18n($locale, null, $joinType)
            ->with('BannersI18n');
        $this->with['BannersI18n']->setIsWithOneToMany(false);

        return $this;
    }

    /**
     * Use the I18n relation query object
     *
     * @see       useQuery()
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    ChildBannersI18nQuery A secondary query class using the current class as primary query
     */
    public function useI18nQuery($locale = 'ru', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinI18n($locale, $relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BannersI18n', '\xbanners\models\BannersI18nQuery');
    }

} // BannersQuery
