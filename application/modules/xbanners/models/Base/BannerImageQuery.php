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
use xbanners\models\BannerImage as ChildBannerImage;
use xbanners\models\BannerImageI18nQuery as ChildBannerImageI18nQuery;
use xbanners\models\BannerImageQuery as ChildBannerImageQuery;
use xbanners\models\Map\BannerImageI18nTableMap;
use xbanners\models\Map\BannerImageTableMap;

/**
 * Base class that represents a query for the 'banner_image' table.
 *
 *
 *
 * @method     ChildBannerImageQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildBannerImageQuery orderByBannerId($order = Criteria::ASC) Order by the banner_id column
 * @method     ChildBannerImageQuery orderByTarget($order = Criteria::ASC) Order by the target column
 * @method     ChildBannerImageQuery orderByUrl($order = Criteria::ASC) Order by the url column
 * @method     ChildBannerImageQuery orderByAllowedPage($order = Criteria::ASC) Order by the allowed_page column
 * @method     ChildBannerImageQuery orderByPosition($order = Criteria::ASC) Order by the position column
 * @method     ChildBannerImageQuery orderByActiveFrom($order = Criteria::ASC) Order by the active_from column
 * @method     ChildBannerImageQuery orderByActiveTo($order = Criteria::ASC) Order by the active_to column
 * @method     ChildBannerImageQuery orderByActive($order = Criteria::ASC) Order by the active column
 * @method     ChildBannerImageQuery orderByPermanent($order = Criteria::ASC) Order by the permanent column
 *
 * @method     ChildBannerImageQuery groupById() Group by the id column
 * @method     ChildBannerImageQuery groupByBannerId() Group by the banner_id column
 * @method     ChildBannerImageQuery groupByTarget() Group by the target column
 * @method     ChildBannerImageQuery groupByUrl() Group by the url column
 * @method     ChildBannerImageQuery groupByAllowedPage() Group by the allowed_page column
 * @method     ChildBannerImageQuery groupByPosition() Group by the position column
 * @method     ChildBannerImageQuery groupByActiveFrom() Group by the active_from column
 * @method     ChildBannerImageQuery groupByActiveTo() Group by the active_to column
 * @method     ChildBannerImageQuery groupByActive() Group by the active column
 * @method     ChildBannerImageQuery groupByPermanent() Group by the permanent column
 *
 * @method     ChildBannerImageQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildBannerImageQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildBannerImageQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildBannerImageQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildBannerImageQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildBannerImageQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildBannerImageQuery leftJoinBanners($relationAlias = null) Adds a LEFT JOIN clause to the query using the Banners relation
 * @method     ChildBannerImageQuery rightJoinBanners($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Banners relation
 * @method     ChildBannerImageQuery innerJoinBanners($relationAlias = null) Adds a INNER JOIN clause to the query using the Banners relation
 *
 * @method     ChildBannerImageQuery joinWithBanners($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Banners relation
 *
 * @method     ChildBannerImageQuery leftJoinWithBanners() Adds a LEFT JOIN clause and with to the query using the Banners relation
 * @method     ChildBannerImageQuery rightJoinWithBanners() Adds a RIGHT JOIN clause and with to the query using the Banners relation
 * @method     ChildBannerImageQuery innerJoinWithBanners() Adds a INNER JOIN clause and with to the query using the Banners relation
 *
 * @method     ChildBannerImageQuery leftJoinBannerImageI18n($relationAlias = null) Adds a LEFT JOIN clause to the query using the BannerImageI18n relation
 * @method     ChildBannerImageQuery rightJoinBannerImageI18n($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BannerImageI18n relation
 * @method     ChildBannerImageQuery innerJoinBannerImageI18n($relationAlias = null) Adds a INNER JOIN clause to the query using the BannerImageI18n relation
 *
 * @method     ChildBannerImageQuery joinWithBannerImageI18n($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BannerImageI18n relation
 *
 * @method     ChildBannerImageQuery leftJoinWithBannerImageI18n() Adds a LEFT JOIN clause and with to the query using the BannerImageI18n relation
 * @method     ChildBannerImageQuery rightJoinWithBannerImageI18n() Adds a RIGHT JOIN clause and with to the query using the BannerImageI18n relation
 * @method     ChildBannerImageQuery innerJoinWithBannerImageI18n() Adds a INNER JOIN clause and with to the query using the BannerImageI18n relation
 *
 * @method     \xbanners\models\BannersQuery|\xbanners\models\BannerImageI18nQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildBannerImage findOne(ConnectionInterface $con = null) Return the first ChildBannerImage matching the query
 * @method     ChildBannerImage findOneOrCreate(ConnectionInterface $con = null) Return the first ChildBannerImage matching the query, or a new ChildBannerImage object populated from the query conditions when no match is found
 *
 * @method     ChildBannerImage findOneById(int $id) Return the first ChildBannerImage filtered by the id column
 * @method     ChildBannerImage findOneByBannerId(int $banner_id) Return the first ChildBannerImage filtered by the banner_id column
 * @method     ChildBannerImage findOneByTarget(int $target) Return the first ChildBannerImage filtered by the target column
 * @method     ChildBannerImage findOneByUrl(string $url) Return the first ChildBannerImage filtered by the url column
 * @method     ChildBannerImage findOneByAllowedPage(int $allowed_page) Return the first ChildBannerImage filtered by the allowed_page column
 * @method     ChildBannerImage findOneByPosition(int $position) Return the first ChildBannerImage filtered by the position column
 * @method     ChildBannerImage findOneByActiveFrom(int $active_from) Return the first ChildBannerImage filtered by the active_from column
 * @method     ChildBannerImage findOneByActiveTo(int $active_to) Return the first ChildBannerImage filtered by the active_to column
 * @method     ChildBannerImage findOneByActive(int $active) Return the first ChildBannerImage filtered by the active column
 * @method     ChildBannerImage findOneByPermanent(int $permanent) Return the first ChildBannerImage filtered by the permanent column *

 * @method     ChildBannerImage requirePk($key, ConnectionInterface $con = null) Return the ChildBannerImage by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBannerImage requireOne(ConnectionInterface $con = null) Return the first ChildBannerImage matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBannerImage requireOneById(int $id) Return the first ChildBannerImage filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBannerImage requireOneByBannerId(int $banner_id) Return the first ChildBannerImage filtered by the banner_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBannerImage requireOneByTarget(int $target) Return the first ChildBannerImage filtered by the target column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBannerImage requireOneByUrl(string $url) Return the first ChildBannerImage filtered by the url column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBannerImage requireOneByAllowedPage(int $allowed_page) Return the first ChildBannerImage filtered by the allowed_page column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBannerImage requireOneByPosition(int $position) Return the first ChildBannerImage filtered by the position column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBannerImage requireOneByActiveFrom(int $active_from) Return the first ChildBannerImage filtered by the active_from column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBannerImage requireOneByActiveTo(int $active_to) Return the first ChildBannerImage filtered by the active_to column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBannerImage requireOneByActive(int $active) Return the first ChildBannerImage filtered by the active column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBannerImage requireOneByPermanent(int $permanent) Return the first ChildBannerImage filtered by the permanent column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBannerImage[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildBannerImage objects based on current ModelCriteria
 * @method     ChildBannerImage[]|ObjectCollection findById(int $id) Return ChildBannerImage objects filtered by the id column
 * @method     ChildBannerImage[]|ObjectCollection findByBannerId(int $banner_id) Return ChildBannerImage objects filtered by the banner_id column
 * @method     ChildBannerImage[]|ObjectCollection findByTarget(int $target) Return ChildBannerImage objects filtered by the target column
 * @method     ChildBannerImage[]|ObjectCollection findByUrl(string $url) Return ChildBannerImage objects filtered by the url column
 * @method     ChildBannerImage[]|ObjectCollection findByAllowedPage(int $allowed_page) Return ChildBannerImage objects filtered by the allowed_page column
 * @method     ChildBannerImage[]|ObjectCollection findByPosition(int $position) Return ChildBannerImage objects filtered by the position column
 * @method     ChildBannerImage[]|ObjectCollection findByActiveFrom(int $active_from) Return ChildBannerImage objects filtered by the active_from column
 * @method     ChildBannerImage[]|ObjectCollection findByActiveTo(int $active_to) Return ChildBannerImage objects filtered by the active_to column
 * @method     ChildBannerImage[]|ObjectCollection findByActive(int $active) Return ChildBannerImage objects filtered by the active column
 * @method     ChildBannerImage[]|ObjectCollection findByPermanent(int $permanent) Return ChildBannerImage objects filtered by the permanent column
 * @method     ChildBannerImage[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class BannerImageQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \xbanners\models\Base\BannerImageQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'Shop', $modelName = '\\xbanners\\models\\BannerImage', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildBannerImageQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildBannerImageQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildBannerImageQuery) {
            return $criteria;
        }
        $query = new ChildBannerImageQuery();
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
     * @return ChildBannerImage|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(BannerImageTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = BannerImageTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildBannerImage A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, banner_id, target, url, allowed_page, position, active_from, active_to, active, permanent FROM banner_image WHERE id = :p0';
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
            /** @var ChildBannerImage $obj */
            $obj = new ChildBannerImage();
            $obj->hydrate($row);
            BannerImageTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildBannerImage|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildBannerImageQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(BannerImageTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildBannerImageQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(BannerImageTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildBannerImageQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(BannerImageTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(BannerImageTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BannerImageTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the banner_id column
     *
     * Example usage:
     * <code>
     * $query->filterByBannerId(1234); // WHERE banner_id = 1234
     * $query->filterByBannerId(array(12, 34)); // WHERE banner_id IN (12, 34)
     * $query->filterByBannerId(array('min' => 12)); // WHERE banner_id > 12
     * </code>
     *
     * @see       filterByBanners()
     *
     * @param     mixed $bannerId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBannerImageQuery The current query, for fluid interface
     */
    public function filterByBannerId($bannerId = null, $comparison = null)
    {
        if (is_array($bannerId)) {
            $useMinMax = false;
            if (isset($bannerId['min'])) {
                $this->addUsingAlias(BannerImageTableMap::COL_BANNER_ID, $bannerId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($bannerId['max'])) {
                $this->addUsingAlias(BannerImageTableMap::COL_BANNER_ID, $bannerId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BannerImageTableMap::COL_BANNER_ID, $bannerId, $comparison);
    }

    /**
     * Filter the query on the target column
     *
     * Example usage:
     * <code>
     * $query->filterByTarget(1234); // WHERE target = 1234
     * $query->filterByTarget(array(12, 34)); // WHERE target IN (12, 34)
     * $query->filterByTarget(array('min' => 12)); // WHERE target > 12
     * </code>
     *
     * @param     mixed $target The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBannerImageQuery The current query, for fluid interface
     */
    public function filterByTarget($target = null, $comparison = null)
    {
        if (is_array($target)) {
            $useMinMax = false;
            if (isset($target['min'])) {
                $this->addUsingAlias(BannerImageTableMap::COL_TARGET, $target['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($target['max'])) {
                $this->addUsingAlias(BannerImageTableMap::COL_TARGET, $target['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BannerImageTableMap::COL_TARGET, $target, $comparison);
    }

    /**
     * Filter the query on the url column
     *
     * Example usage:
     * <code>
     * $query->filterByUrl('fooValue');   // WHERE url = 'fooValue'
     * $query->filterByUrl('%fooValue%', Criteria::LIKE); // WHERE url LIKE '%fooValue%'
     * </code>
     *
     * @param     string $url The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBannerImageQuery The current query, for fluid interface
     */
    public function filterByUrl($url = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($url)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BannerImageTableMap::COL_URL, $url, $comparison);
    }

    /**
     * Filter the query on the allowed_page column
     *
     * Example usage:
     * <code>
     * $query->filterByAllowedPage(1234); // WHERE allowed_page = 1234
     * $query->filterByAllowedPage(array(12, 34)); // WHERE allowed_page IN (12, 34)
     * $query->filterByAllowedPage(array('min' => 12)); // WHERE allowed_page > 12
     * </code>
     *
     * @param     mixed $allowedPage The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBannerImageQuery The current query, for fluid interface
     */
    public function filterByAllowedPage($allowedPage = null, $comparison = null)
    {
        if (is_array($allowedPage)) {
            $useMinMax = false;
            if (isset($allowedPage['min'])) {
                $this->addUsingAlias(BannerImageTableMap::COL_ALLOWED_PAGE, $allowedPage['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($allowedPage['max'])) {
                $this->addUsingAlias(BannerImageTableMap::COL_ALLOWED_PAGE, $allowedPage['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BannerImageTableMap::COL_ALLOWED_PAGE, $allowedPage, $comparison);
    }

    /**
     * Filter the query on the position column
     *
     * Example usage:
     * <code>
     * $query->filterByPosition(1234); // WHERE position = 1234
     * $query->filterByPosition(array(12, 34)); // WHERE position IN (12, 34)
     * $query->filterByPosition(array('min' => 12)); // WHERE position > 12
     * </code>
     *
     * @param     mixed $position The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBannerImageQuery The current query, for fluid interface
     */
    public function filterByPosition($position = null, $comparison = null)
    {
        if (is_array($position)) {
            $useMinMax = false;
            if (isset($position['min'])) {
                $this->addUsingAlias(BannerImageTableMap::COL_POSITION, $position['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($position['max'])) {
                $this->addUsingAlias(BannerImageTableMap::COL_POSITION, $position['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BannerImageTableMap::COL_POSITION, $position, $comparison);
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
     * @return $this|ChildBannerImageQuery The current query, for fluid interface
     */
    public function filterByActiveFrom($activeFrom = null, $comparison = null)
    {
        if (is_array($activeFrom)) {
            $useMinMax = false;
            if (isset($activeFrom['min'])) {
                $this->addUsingAlias(BannerImageTableMap::COL_ACTIVE_FROM, $activeFrom['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($activeFrom['max'])) {
                $this->addUsingAlias(BannerImageTableMap::COL_ACTIVE_FROM, $activeFrom['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BannerImageTableMap::COL_ACTIVE_FROM, $activeFrom, $comparison);
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
     * @return $this|ChildBannerImageQuery The current query, for fluid interface
     */
    public function filterByActiveTo($activeTo = null, $comparison = null)
    {
        if (is_array($activeTo)) {
            $useMinMax = false;
            if (isset($activeTo['min'])) {
                $this->addUsingAlias(BannerImageTableMap::COL_ACTIVE_TO, $activeTo['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($activeTo['max'])) {
                $this->addUsingAlias(BannerImageTableMap::COL_ACTIVE_TO, $activeTo['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BannerImageTableMap::COL_ACTIVE_TO, $activeTo, $comparison);
    }

    /**
     * Filter the query on the active column
     *
     * Example usage:
     * <code>
     * $query->filterByActive(1234); // WHERE active = 1234
     * $query->filterByActive(array(12, 34)); // WHERE active IN (12, 34)
     * $query->filterByActive(array('min' => 12)); // WHERE active > 12
     * </code>
     *
     * @param     mixed $active The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBannerImageQuery The current query, for fluid interface
     */
    public function filterByActive($active = null, $comparison = null)
    {
        if (is_array($active)) {
            $useMinMax = false;
            if (isset($active['min'])) {
                $this->addUsingAlias(BannerImageTableMap::COL_ACTIVE, $active['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($active['max'])) {
                $this->addUsingAlias(BannerImageTableMap::COL_ACTIVE, $active['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BannerImageTableMap::COL_ACTIVE, $active, $comparison);
    }

    /**
     * Filter the query on the permanent column
     *
     * Example usage:
     * <code>
     * $query->filterByPermanent(1234); // WHERE permanent = 1234
     * $query->filterByPermanent(array(12, 34)); // WHERE permanent IN (12, 34)
     * $query->filterByPermanent(array('min' => 12)); // WHERE permanent > 12
     * </code>
     *
     * @param     mixed $permanent The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBannerImageQuery The current query, for fluid interface
     */
    public function filterByPermanent($permanent = null, $comparison = null)
    {
        if (is_array($permanent)) {
            $useMinMax = false;
            if (isset($permanent['min'])) {
                $this->addUsingAlias(BannerImageTableMap::COL_PERMANENT, $permanent['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($permanent['max'])) {
                $this->addUsingAlias(BannerImageTableMap::COL_PERMANENT, $permanent['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BannerImageTableMap::COL_PERMANENT, $permanent, $comparison);
    }

    /**
     * Filter the query by a related \xbanners\models\Banners object
     *
     * @param \xbanners\models\Banners|ObjectCollection $banners The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildBannerImageQuery The current query, for fluid interface
     */
    public function filterByBanners($banners, $comparison = null)
    {
        if ($banners instanceof \xbanners\models\Banners) {
            return $this
                ->addUsingAlias(BannerImageTableMap::COL_BANNER_ID, $banners->getId(), $comparison);
        } elseif ($banners instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BannerImageTableMap::COL_BANNER_ID, $banners->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByBanners() only accepts arguments of type \xbanners\models\Banners or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Banners relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildBannerImageQuery The current query, for fluid interface
     */
    public function joinBanners($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Banners');

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
            $this->addJoinObject($join, 'Banners');
        }

        return $this;
    }

    /**
     * Use the Banners relation Banners object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \xbanners\models\BannersQuery A secondary query class using the current class as primary query
     */
    public function useBannersQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinBanners($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Banners', '\xbanners\models\BannersQuery');
    }

    /**
     * Filter the query by a related \xbanners\models\BannerImageI18n object
     *
     * @param \xbanners\models\BannerImageI18n|ObjectCollection $bannerImageI18n the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildBannerImageQuery The current query, for fluid interface
     */
    public function filterByBannerImageI18n($bannerImageI18n, $comparison = null)
    {
        if ($bannerImageI18n instanceof \xbanners\models\BannerImageI18n) {
            return $this
                ->addUsingAlias(BannerImageTableMap::COL_ID, $bannerImageI18n->getId(), $comparison);
        } elseif ($bannerImageI18n instanceof ObjectCollection) {
            return $this
                ->useBannerImageI18nQuery()
                ->filterByPrimaryKeys($bannerImageI18n->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByBannerImageI18n() only accepts arguments of type \xbanners\models\BannerImageI18n or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BannerImageI18n relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildBannerImageQuery The current query, for fluid interface
     */
    public function joinBannerImageI18n($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BannerImageI18n');

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
            $this->addJoinObject($join, 'BannerImageI18n');
        }

        return $this;
    }

    /**
     * Use the BannerImageI18n relation BannerImageI18n object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \xbanners\models\BannerImageI18nQuery A secondary query class using the current class as primary query
     */
    public function useBannerImageI18nQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinBannerImageI18n($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BannerImageI18n', '\xbanners\models\BannerImageI18nQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildBannerImage $bannerImage Object to remove from the list of results
     *
     * @return $this|ChildBannerImageQuery The current query, for fluid interface
     */
    public function prune($bannerImage = null)
    {
        if ($bannerImage) {
            $this->addUsingAlias(BannerImageTableMap::COL_ID, $bannerImage->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the banner_image table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BannerImageTableMap::DATABASE_NAME);
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
            BannerImageTableMap::clearInstancePool();
            BannerImageTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(BannerImageTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(BannerImageTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            // cloning the Criteria in case it's modified by doSelect() or doSelectStmt()
            $c = clone $criteria;
            $affectedRows += $c->doOnDeleteCascade($con);

            BannerImageTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            BannerImageTableMap::clearRelatedInstancePool();

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
        $objects = ChildBannerImageQuery::create(null, $this)->find($con);
        foreach ($objects as $obj) {


            // delete related BannerImageI18n objects
            $query = new \xbanners\models\BannerImageI18nQuery;

            $query->add(BannerImageI18nTableMap::COL_ID, $obj->getId());
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
     * @return    ChildBannerImageQuery The current query, for fluid interface
     */
    public function joinI18n($locale = 'ru', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $relationName = $relationAlias ? $relationAlias : 'BannerImageI18n';

        return $this
            ->joinBannerImageI18n($relationAlias, $joinType)
            ->addJoinCondition($relationName, $relationName . '.Locale = ?', $locale);
    }

    /**
     * Adds a JOIN clause to the query and hydrates the related I18n object.
     * Shortcut for $c->joinI18n($locale)->with()
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    $this|ChildBannerImageQuery The current query, for fluid interface
     */
    public function joinWithI18n($locale = 'ru', $joinType = Criteria::LEFT_JOIN)
    {
        $this
            ->joinI18n($locale, null, $joinType)
            ->with('BannerImageI18n');
        $this->with['BannerImageI18n']->setIsWithOneToMany(false);

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
     * @return    ChildBannerImageI18nQuery A secondary query class using the current class as primary query
     */
    public function useI18nQuery($locale = 'ru', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinI18n($locale, $relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BannerImageI18n', '\xbanners\models\BannerImageI18nQuery');
    }

} // BannerImageQuery
