<?php

namespace mod_link\models\Base;

use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use mod_link\models\PageLink as ChildPageLink;
use mod_link\models\PageLinkQuery as ChildPageLinkQuery;
use mod_link\models\Map\PageLinkTableMap;

/**
 * Base class that represents a query for the 'page_link' table.
 *
 *
 *
 * @method     ChildPageLinkQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildPageLinkQuery orderByPageId($order = Criteria::ASC) Order by the page_id column
 * @method     ChildPageLinkQuery orderByActiveFrom($order = Criteria::ASC) Order by the active_from column
 * @method     ChildPageLinkQuery orderByActiveTo($order = Criteria::ASC) Order by the active_to column
 * @method     ChildPageLinkQuery orderByShowOn($order = Criteria::ASC) Order by the show_on column
 * @method     ChildPageLinkQuery orderByPermanent($order = Criteria::ASC) Order by the permanent column
 *
 * @method     ChildPageLinkQuery groupById() Group by the id column
 * @method     ChildPageLinkQuery groupByPageId() Group by the page_id column
 * @method     ChildPageLinkQuery groupByActiveFrom() Group by the active_from column
 * @method     ChildPageLinkQuery groupByActiveTo() Group by the active_to column
 * @method     ChildPageLinkQuery groupByShowOn() Group by the show_on column
 * @method     ChildPageLinkQuery groupByPermanent() Group by the permanent column
 *
 * @method     ChildPageLinkQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPageLinkQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPageLinkQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPageLinkQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPageLinkQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPageLinkQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPageLinkQuery leftJoinPageLinkProduct($relationAlias = null) Adds a LEFT JOIN clause to the query using the PageLinkProduct relation
 * @method     ChildPageLinkQuery rightJoinPageLinkProduct($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PageLinkProduct relation
 * @method     ChildPageLinkQuery innerJoinPageLinkProduct($relationAlias = null) Adds a INNER JOIN clause to the query using the PageLinkProduct relation
 *
 * @method     ChildPageLinkQuery joinWithPageLinkProduct($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PageLinkProduct relation
 *
 * @method     ChildPageLinkQuery leftJoinWithPageLinkProduct() Adds a LEFT JOIN clause and with to the query using the PageLinkProduct relation
 * @method     ChildPageLinkQuery rightJoinWithPageLinkProduct() Adds a RIGHT JOIN clause and with to the query using the PageLinkProduct relation
 * @method     ChildPageLinkQuery innerJoinWithPageLinkProduct() Adds a INNER JOIN clause and with to the query using the PageLinkProduct relation
 *
 * @method     \mod_link\models\PageLinkProductQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPageLink findOne(ConnectionInterface $con = null) Return the first ChildPageLink matching the query
 * @method     ChildPageLink findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPageLink matching the query, or a new ChildPageLink object populated from the query conditions when no match is found
 *
 * @method     ChildPageLink findOneById(int $id) Return the first ChildPageLink filtered by the id column
 * @method     ChildPageLink findOneByPageId(int $page_id) Return the first ChildPageLink filtered by the page_id column
 * @method     ChildPageLink findOneByActiveFrom(int $active_from) Return the first ChildPageLink filtered by the active_from column
 * @method     ChildPageLink findOneByActiveTo(int $active_to) Return the first ChildPageLink filtered by the active_to column
 * @method     ChildPageLink findOneByShowOn(boolean $show_on) Return the first ChildPageLink filtered by the show_on column
 * @method     ChildPageLink findOneByPermanent(boolean $permanent) Return the first ChildPageLink filtered by the permanent column *

 * @method     ChildPageLink requirePk($key, ConnectionInterface $con = null) Return the ChildPageLink by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPageLink requireOne(ConnectionInterface $con = null) Return the first ChildPageLink matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPageLink requireOneById(int $id) Return the first ChildPageLink filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPageLink requireOneByPageId(int $page_id) Return the first ChildPageLink filtered by the page_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPageLink requireOneByActiveFrom(int $active_from) Return the first ChildPageLink filtered by the active_from column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPageLink requireOneByActiveTo(int $active_to) Return the first ChildPageLink filtered by the active_to column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPageLink requireOneByShowOn(boolean $show_on) Return the first ChildPageLink filtered by the show_on column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPageLink requireOneByPermanent(boolean $permanent) Return the first ChildPageLink filtered by the permanent column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPageLink[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildPageLink objects based on current ModelCriteria
 * @method     ChildPageLink[]|ObjectCollection findById(int $id) Return ChildPageLink objects filtered by the id column
 * @method     ChildPageLink[]|ObjectCollection findByPageId(int $page_id) Return ChildPageLink objects filtered by the page_id column
 * @method     ChildPageLink[]|ObjectCollection findByActiveFrom(int $active_from) Return ChildPageLink objects filtered by the active_from column
 * @method     ChildPageLink[]|ObjectCollection findByActiveTo(int $active_to) Return ChildPageLink objects filtered by the active_to column
 * @method     ChildPageLink[]|ObjectCollection findByShowOn(boolean $show_on) Return ChildPageLink objects filtered by the show_on column
 * @method     ChildPageLink[]|ObjectCollection findByPermanent(boolean $permanent) Return ChildPageLink objects filtered by the permanent column
 * @method     ChildPageLink[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PageLinkQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \mod_link\models\Base\PageLinkQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'Shop', $modelName = '\\mod_link\\models\\PageLink', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPageLinkQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPageLinkQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildPageLinkQuery) {
            return $criteria;
        }
        $query = new ChildPageLinkQuery();
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
     * @return ChildPageLink|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PageLinkTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = PageLinkTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildPageLink A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, page_id, active_from, active_to, show_on, permanent FROM page_link WHERE id = :p0';
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
            /** @var ChildPageLink $obj */
            $obj = new ChildPageLink();
            $obj->hydrate($row);
            PageLinkTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildPageLink|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildPageLinkQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PageLinkTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildPageLinkQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PageLinkTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildPageLinkQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(PageLinkTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(PageLinkTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PageLinkTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the page_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPageId(1234); // WHERE page_id = 1234
     * $query->filterByPageId(array(12, 34)); // WHERE page_id IN (12, 34)
     * $query->filterByPageId(array('min' => 12)); // WHERE page_id > 12
     * </code>
     *
     * @param     mixed $pageId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPageLinkQuery The current query, for fluid interface
     */
    public function filterByPageId($pageId = null, $comparison = null)
    {
        if (is_array($pageId)) {
            $useMinMax = false;
            if (isset($pageId['min'])) {
                $this->addUsingAlias(PageLinkTableMap::COL_PAGE_ID, $pageId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($pageId['max'])) {
                $this->addUsingAlias(PageLinkTableMap::COL_PAGE_ID, $pageId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PageLinkTableMap::COL_PAGE_ID, $pageId, $comparison);
    }

    /**
     * Filter the query on the active_from column
     *
     * Example usage:
     * <code>
     * $query->filterByActiveFrom(1234); // WHERE active_from = 1234
     * $query->filterByActiveFrom(array(12, 34)); // WHERE active_from IN (12, 34)
     * $query->filterByActiveFrom(array('min' => 12)); // WHERE active_from > 12
     * </code>
     *
     * @param     mixed $activeFrom The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPageLinkQuery The current query, for fluid interface
     */
    public function filterByActiveFrom($activeFrom = null, $comparison = null)
    {
        if (is_array($activeFrom)) {
            $useMinMax = false;
            if (isset($activeFrom['min'])) {
                $this->addUsingAlias(PageLinkTableMap::COL_ACTIVE_FROM, $activeFrom['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($activeFrom['max'])) {
                $this->addUsingAlias(PageLinkTableMap::COL_ACTIVE_FROM, $activeFrom['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PageLinkTableMap::COL_ACTIVE_FROM, $activeFrom, $comparison);
    }

    /**
     * Filter the query on the active_to column
     *
     * Example usage:
     * <code>
     * $query->filterByActiveTo(1234); // WHERE active_to = 1234
     * $query->filterByActiveTo(array(12, 34)); // WHERE active_to IN (12, 34)
     * $query->filterByActiveTo(array('min' => 12)); // WHERE active_to > 12
     * </code>
     *
     * @param     mixed $activeTo The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPageLinkQuery The current query, for fluid interface
     */
    public function filterByActiveTo($activeTo = null, $comparison = null)
    {
        if (is_array($activeTo)) {
            $useMinMax = false;
            if (isset($activeTo['min'])) {
                $this->addUsingAlias(PageLinkTableMap::COL_ACTIVE_TO, $activeTo['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($activeTo['max'])) {
                $this->addUsingAlias(PageLinkTableMap::COL_ACTIVE_TO, $activeTo['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PageLinkTableMap::COL_ACTIVE_TO, $activeTo, $comparison);
    }

    /**
     * Filter the query on the show_on column
     *
     * Example usage:
     * <code>
     * $query->filterByShowOn(true); // WHERE show_on = true
     * $query->filterByShowOn('yes'); // WHERE show_on = true
     * </code>
     *
     * @param     boolean|string $showOn The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPageLinkQuery The current query, for fluid interface
     */
    public function filterByShowOn($showOn = null, $comparison = null)
    {
        if (is_string($showOn)) {
            $showOn = in_array(strtolower($showOn), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(PageLinkTableMap::COL_SHOW_ON, $showOn, $comparison);
    }

    /**
     * Filter the query on the permanent column
     *
     * Example usage:
     * <code>
     * $query->filterByPermanent(true); // WHERE permanent = true
     * $query->filterByPermanent('yes'); // WHERE permanent = true
     * </code>
     *
     * @param     boolean|string $permanent The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPageLinkQuery The current query, for fluid interface
     */
    public function filterByPermanent($permanent = null, $comparison = null)
    {
        if (is_string($permanent)) {
            $permanent = in_array(strtolower($permanent), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(PageLinkTableMap::COL_PERMANENT, $permanent, $comparison);
    }

    /**
     * Filter the query by a related \mod_link\models\PageLinkProduct object
     *
     * @param \mod_link\models\PageLinkProduct|ObjectCollection $pageLinkProduct the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPageLinkQuery The current query, for fluid interface
     */
    public function filterByPageLinkProduct($pageLinkProduct, $comparison = null)
    {
        if ($pageLinkProduct instanceof \mod_link\models\PageLinkProduct) {
            return $this
                ->addUsingAlias(PageLinkTableMap::COL_ID, $pageLinkProduct->getLinkId(), $comparison);
        } elseif ($pageLinkProduct instanceof ObjectCollection) {
            return $this
                ->usePageLinkProductQuery()
                ->filterByPrimaryKeys($pageLinkProduct->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPageLinkProduct() only accepts arguments of type \mod_link\models\PageLinkProduct or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PageLinkProduct relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPageLinkQuery The current query, for fluid interface
     */
    public function joinPageLinkProduct($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PageLinkProduct');

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
            $this->addJoinObject($join, 'PageLinkProduct');
        }

        return $this;
    }

    /**
     * Use the PageLinkProduct relation PageLinkProduct object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \mod_link\models\PageLinkProductQuery A secondary query class using the current class as primary query
     */
    public function usePageLinkProductQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPageLinkProduct($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PageLinkProduct', '\mod_link\models\PageLinkProductQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildPageLink $pageLink Object to remove from the list of results
     *
     * @return $this|ChildPageLinkQuery The current query, for fluid interface
     */
    public function prune($pageLink = null)
    {
        if ($pageLink) {
            $this->addUsingAlias(PageLinkTableMap::COL_ID, $pageLink->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the page_link table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PageLinkTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PageLinkTableMap::clearInstancePool();
            PageLinkTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PageLinkTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PageLinkTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PageLinkTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PageLinkTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // PageLinkQuery
