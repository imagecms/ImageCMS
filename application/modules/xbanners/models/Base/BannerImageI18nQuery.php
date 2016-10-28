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
use xbanners\models\BannerImageI18n as ChildBannerImageI18n;
use xbanners\models\BannerImageI18nQuery as ChildBannerImageI18nQuery;
use xbanners\models\Map\BannerImageI18nTableMap;

/**
 * Base class that represents a query for the 'banner_image_i18n' table.
 *
 *
 *
 * @method     ChildBannerImageI18nQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildBannerImageI18nQuery orderByLocale($order = Criteria::ASC) Order by the locale column
 * @method     ChildBannerImageI18nQuery orderBySrc($order = Criteria::ASC) Order by the src column
 * @method     ChildBannerImageI18nQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildBannerImageI18nQuery orderByClicks($order = Criteria::ASC) Order by the clicks column
 * @method     ChildBannerImageI18nQuery orderByDescription($order = Criteria::ASC) Order by the description column
 *
 * @method     ChildBannerImageI18nQuery groupById() Group by the id column
 * @method     ChildBannerImageI18nQuery groupByLocale() Group by the locale column
 * @method     ChildBannerImageI18nQuery groupBySrc() Group by the src column
 * @method     ChildBannerImageI18nQuery groupByName() Group by the name column
 * @method     ChildBannerImageI18nQuery groupByClicks() Group by the clicks column
 * @method     ChildBannerImageI18nQuery groupByDescription() Group by the description column
 *
 * @method     ChildBannerImageI18nQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildBannerImageI18nQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildBannerImageI18nQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildBannerImageI18nQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildBannerImageI18nQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildBannerImageI18nQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildBannerImageI18nQuery leftJoinBannerImage($relationAlias = null) Adds a LEFT JOIN clause to the query using the BannerImage relation
 * @method     ChildBannerImageI18nQuery rightJoinBannerImage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BannerImage relation
 * @method     ChildBannerImageI18nQuery innerJoinBannerImage($relationAlias = null) Adds a INNER JOIN clause to the query using the BannerImage relation
 *
 * @method     ChildBannerImageI18nQuery joinWithBannerImage($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BannerImage relation
 *
 * @method     ChildBannerImageI18nQuery leftJoinWithBannerImage() Adds a LEFT JOIN clause and with to the query using the BannerImage relation
 * @method     ChildBannerImageI18nQuery rightJoinWithBannerImage() Adds a RIGHT JOIN clause and with to the query using the BannerImage relation
 * @method     ChildBannerImageI18nQuery innerJoinWithBannerImage() Adds a INNER JOIN clause and with to the query using the BannerImage relation
 *
 * @method     \xbanners\models\BannerImageQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildBannerImageI18n findOne(ConnectionInterface $con = null) Return the first ChildBannerImageI18n matching the query
 * @method     ChildBannerImageI18n findOneOrCreate(ConnectionInterface $con = null) Return the first ChildBannerImageI18n matching the query, or a new ChildBannerImageI18n object populated from the query conditions when no match is found
 *
 * @method     ChildBannerImageI18n findOneById(int $id) Return the first ChildBannerImageI18n filtered by the id column
 * @method     ChildBannerImageI18n findOneByLocale(string $locale) Return the first ChildBannerImageI18n filtered by the locale column
 * @method     ChildBannerImageI18n findOneBySrc(string $src) Return the first ChildBannerImageI18n filtered by the src column
 * @method     ChildBannerImageI18n findOneByName(string $name) Return the first ChildBannerImageI18n filtered by the name column
 * @method     ChildBannerImageI18n findOneByClicks(int $clicks) Return the first ChildBannerImageI18n filtered by the clicks column
 * @method     ChildBannerImageI18n findOneByDescription(string $description) Return the first ChildBannerImageI18n filtered by the description column *

 * @method     ChildBannerImageI18n requirePk($key, ConnectionInterface $con = null) Return the ChildBannerImageI18n by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBannerImageI18n requireOne(ConnectionInterface $con = null) Return the first ChildBannerImageI18n matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBannerImageI18n requireOneById(int $id) Return the first ChildBannerImageI18n filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBannerImageI18n requireOneByLocale(string $locale) Return the first ChildBannerImageI18n filtered by the locale column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBannerImageI18n requireOneBySrc(string $src) Return the first ChildBannerImageI18n filtered by the src column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBannerImageI18n requireOneByName(string $name) Return the first ChildBannerImageI18n filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBannerImageI18n requireOneByClicks(int $clicks) Return the first ChildBannerImageI18n filtered by the clicks column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBannerImageI18n requireOneByDescription(string $description) Return the first ChildBannerImageI18n filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBannerImageI18n[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildBannerImageI18n objects based on current ModelCriteria
 * @method     ChildBannerImageI18n[]|ObjectCollection findById(int $id) Return ChildBannerImageI18n objects filtered by the id column
 * @method     ChildBannerImageI18n[]|ObjectCollection findByLocale(string $locale) Return ChildBannerImageI18n objects filtered by the locale column
 * @method     ChildBannerImageI18n[]|ObjectCollection findBySrc(string $src) Return ChildBannerImageI18n objects filtered by the src column
 * @method     ChildBannerImageI18n[]|ObjectCollection findByName(string $name) Return ChildBannerImageI18n objects filtered by the name column
 * @method     ChildBannerImageI18n[]|ObjectCollection findByClicks(int $clicks) Return ChildBannerImageI18n objects filtered by the clicks column
 * @method     ChildBannerImageI18n[]|ObjectCollection findByDescription(string $description) Return ChildBannerImageI18n objects filtered by the description column
 * @method     ChildBannerImageI18n[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class BannerImageI18nQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \xbanners\models\Base\BannerImageI18nQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'Shop', $modelName = '\\xbanners\\models\\BannerImageI18n', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildBannerImageI18nQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildBannerImageI18nQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildBannerImageI18nQuery) {
            return $criteria;
        }
        $query = new ChildBannerImageI18nQuery();
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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array[$id, $locale] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildBannerImageI18n|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(BannerImageI18nTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = BannerImageI18nTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildBannerImageI18n A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, locale, src, name, clicks, description FROM banner_image_i18n WHERE id = :p0 AND locale = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildBannerImageI18n $obj */
            $obj = new ChildBannerImageI18n();
            $obj->hydrate($row);
            BannerImageI18nTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildBannerImageI18n|array|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
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
     * @return $this|ChildBannerImageI18nQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(BannerImageI18nTableMap::COL_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(BannerImageI18nTableMap::COL_LOCALE, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildBannerImageI18nQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(BannerImageI18nTableMap::COL_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(BannerImageI18nTableMap::COL_LOCALE, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
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
     * @see       filterByBannerImage()
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBannerImageI18nQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(BannerImageI18nTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(BannerImageI18nTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BannerImageI18nTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the locale column
     *
     * Example usage:
     * <code>
     * $query->filterByLocale('fooValue');   // WHERE locale = 'fooValue'
     * $query->filterByLocale('%fooValue%', Criteria::LIKE); // WHERE locale LIKE '%fooValue%'
     * </code>
     *
     * @param     string $locale The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBannerImageI18nQuery The current query, for fluid interface
     */
    public function filterByLocale($locale = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($locale)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BannerImageI18nTableMap::COL_LOCALE, $locale, $comparison);
    }

    /**
     * Filter the query on the src column
     *
     * Example usage:
     * <code>
     * $query->filterBySrc('fooValue');   // WHERE src = 'fooValue'
     * $query->filterBySrc('%fooValue%', Criteria::LIKE); // WHERE src LIKE '%fooValue%'
     * </code>
     *
     * @param     string $src The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBannerImageI18nQuery The current query, for fluid interface
     */
    public function filterBySrc($src = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($src)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BannerImageI18nTableMap::COL_SRC, $src, $comparison);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%', Criteria::LIKE); // WHERE name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBannerImageI18nQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BannerImageI18nTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the clicks column
     *
     * Example usage:
     * <code>
     * $query->filterByClicks(1234); // WHERE clicks = 1234
     * $query->filterByClicks(array(12, 34)); // WHERE clicks IN (12, 34)
     * $query->filterByClicks(array('min' => 12)); // WHERE clicks > 12
     * </code>
     *
     * @param     mixed $clicks The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBannerImageI18nQuery The current query, for fluid interface
     */
    public function filterByClicks($clicks = null, $comparison = null)
    {
        if (is_array($clicks)) {
            $useMinMax = false;
            if (isset($clicks['min'])) {
                $this->addUsingAlias(BannerImageI18nTableMap::COL_CLICKS, $clicks['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($clicks['max'])) {
                $this->addUsingAlias(BannerImageI18nTableMap::COL_CLICKS, $clicks['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BannerImageI18nTableMap::COL_CLICKS, $clicks, $comparison);
    }

    /**
     * Filter the query on the description column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE description = 'fooValue'
     * $query->filterByDescription('%fooValue%', Criteria::LIKE); // WHERE description LIKE '%fooValue%'
     * </code>
     *
     * @param     string $description The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBannerImageI18nQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BannerImageI18nTableMap::COL_DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query by a related \xbanners\models\BannerImage object
     *
     * @param \xbanners\models\BannerImage|ObjectCollection $bannerImage The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildBannerImageI18nQuery The current query, for fluid interface
     */
    public function filterByBannerImage($bannerImage, $comparison = null)
    {
        if ($bannerImage instanceof \xbanners\models\BannerImage) {
            return $this
                ->addUsingAlias(BannerImageI18nTableMap::COL_ID, $bannerImage->getId(), $comparison);
        } elseif ($bannerImage instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BannerImageI18nTableMap::COL_ID, $bannerImage->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildBannerImageI18nQuery The current query, for fluid interface
     */
    public function joinBannerImage($relationAlias = null, $joinType = 'LEFT JOIN')
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
    public function useBannerImageQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinBannerImage($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BannerImage', '\xbanners\models\BannerImageQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildBannerImageI18n $bannerImageI18n Object to remove from the list of results
     *
     * @return $this|ChildBannerImageI18nQuery The current query, for fluid interface
     */
    public function prune($bannerImageI18n = null)
    {
        if ($bannerImageI18n) {
            $this->addCond('pruneCond0', $this->getAliasedColName(BannerImageI18nTableMap::COL_ID), $bannerImageI18n->getId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(BannerImageI18nTableMap::COL_LOCALE), $bannerImageI18n->getLocale(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the banner_image_i18n table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BannerImageI18nTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            BannerImageI18nTableMap::clearInstancePool();
            BannerImageI18nTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(BannerImageI18nTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(BannerImageI18nTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            BannerImageI18nTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            BannerImageI18nTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // BannerImageI18nQuery
