<?php


/**
 * Base class that represents a query for the 'shop_delivery_methods' table.
 *
 * 
 *
 * @method     SDeliveryMethodsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     SDeliveryMethodsQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     SDeliveryMethodsQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     SDeliveryMethodsQuery orderByPrice($order = Criteria::ASC) Order by the price column
 * @method     SDeliveryMethodsQuery orderByFreeFrom($order = Criteria::ASC) Order by the free_from column
 * @method     SDeliveryMethodsQuery orderByEnabled($order = Criteria::ASC) Order by the enabled column
 *
 * @method     SDeliveryMethodsQuery groupById() Group by the id column
 * @method     SDeliveryMethodsQuery groupByName() Group by the name column
 * @method     SDeliveryMethodsQuery groupByDescription() Group by the description column
 * @method     SDeliveryMethodsQuery groupByPrice() Group by the price column
 * @method     SDeliveryMethodsQuery groupByFreeFrom() Group by the free_from column
 * @method     SDeliveryMethodsQuery groupByEnabled() Group by the enabled column
 *
 * @method     SDeliveryMethodsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     SDeliveryMethodsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     SDeliveryMethodsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     SDeliveryMethodsQuery leftJoinSOrders($relationAlias = null) Adds a LEFT JOIN clause to the query using the SOrders relation
 * @method     SDeliveryMethodsQuery rightJoinSOrders($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SOrders relation
 * @method     SDeliveryMethodsQuery innerJoinSOrders($relationAlias = null) Adds a INNER JOIN clause to the query using the SOrders relation
 *
 * @method     SDeliveryMethods findOne(PropelPDO $con = null) Return the first SDeliveryMethods matching the query
 * @method     SDeliveryMethods findOneOrCreate(PropelPDO $con = null) Return the first SDeliveryMethods matching the query, or a new SDeliveryMethods object populated from the query conditions when no match is found
 *
 * @method     SDeliveryMethods findOneById(int $id) Return the first SDeliveryMethods filtered by the id column
 * @method     SDeliveryMethods findOneByName(string $name) Return the first SDeliveryMethods filtered by the name column
 * @method     SDeliveryMethods findOneByDescription(string $description) Return the first SDeliveryMethods filtered by the description column
 * @method     SDeliveryMethods findOneByPrice(string $price) Return the first SDeliveryMethods filtered by the price column
 * @method     SDeliveryMethods findOneByFreeFrom(string $free_from) Return the first SDeliveryMethods filtered by the free_from column
 * @method     SDeliveryMethods findOneByEnabled(boolean $enabled) Return the first SDeliveryMethods filtered by the enabled column
 *
 * @method     array findById(int $id) Return SDeliveryMethods objects filtered by the id column
 * @method     array findByName(string $name) Return SDeliveryMethods objects filtered by the name column
 * @method     array findByDescription(string $description) Return SDeliveryMethods objects filtered by the description column
 * @method     array findByPrice(string $price) Return SDeliveryMethods objects filtered by the price column
 * @method     array findByFreeFrom(string $free_from) Return SDeliveryMethods objects filtered by the free_from column
 * @method     array findByEnabled(boolean $enabled) Return SDeliveryMethods objects filtered by the enabled column
 *
 * @package    propel.generator.Shop.om
 */
abstract class BaseSDeliveryMethodsQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseSDeliveryMethodsQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'Shop', $modelName = 'SDeliveryMethods', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new SDeliveryMethodsQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    SDeliveryMethodsQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof SDeliveryMethodsQuery) {
			return $criteria;
		}
		$query = new SDeliveryMethodsQuery();
		if (null !== $modelAlias) {
			$query->setModelAlias($modelAlias);
		}
		if ($criteria instanceof Criteria) {
			$query->mergeWith($criteria);
		}
		return $query;
	}

	/**
	 * Find object by primary key
	 * Use instance pooling to avoid a database query if the object exists
	 * <code>
	 * $obj  = $c->findPk(12, $con);
	 * </code>
	 * @param     mixed $key Primary key to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    SDeliveryMethods|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = SDeliveryMethodsPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
			// the object is alredy in the instance pool
			return $obj;
		} else {
			// the object has not been requested yet, or the formatter is not an object formatter
			$criteria = $this->isKeepQuery() ? clone $this : $this;
			$stmt = $criteria
				->filterByPrimaryKey($key)
				->getSelectStatement($con);
			return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
		}
	}

	/**
	 * Find objects by primary key
	 * <code>
	 * $objs = $c->findPks(array(12, 56, 832), $con);
	 * </code>
	 * @param     array $keys Primary keys to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    PropelObjectCollection|array|mixed the list of results, formatted by the current formatter
	 */
	public function findPks($keys, $con = null)
	{	
		$criteria = $this->isKeepQuery() ? clone $this : $this;
		return $this
			->filterByPrimaryKeys($keys)
			->find($con);
	}

	/**
	 * Filter the query by primary key
	 *
	 * @param     mixed $key Primary key to use for the query
	 *
	 * @return    SDeliveryMethodsQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(SDeliveryMethodsPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    SDeliveryMethodsQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(SDeliveryMethodsPeer::ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the id column
	 * 
	 * @param     int|array $id The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SDeliveryMethodsQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(SDeliveryMethodsPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the name column
	 * 
	 * @param     string $name The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SDeliveryMethodsQuery The current query, for fluid interface
	 */
	public function filterByName($name = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($name)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $name)) {
				$name = str_replace('*', '%', $name);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(SDeliveryMethodsPeer::NAME, $name, $comparison);
	}

	/**
	 * Filter the query on the description column
	 * 
	 * @param     string $description The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SDeliveryMethodsQuery The current query, for fluid interface
	 */
	public function filterByDescription($description = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($description)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $description)) {
				$description = str_replace('*', '%', $description);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(SDeliveryMethodsPeer::DESCRIPTION, $description, $comparison);
	}

	/**
	 * Filter the query on the price column
	 * 
	 * @param     string|array $price The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SDeliveryMethodsQuery The current query, for fluid interface
	 */
	public function filterByPrice($price = null, $comparison = null)
	{
		if (is_array($price)) {
			$useMinMax = false;
			if (isset($price['min'])) {
				$this->addUsingAlias(SDeliveryMethodsPeer::PRICE, $price['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($price['max'])) {
				$this->addUsingAlias(SDeliveryMethodsPeer::PRICE, $price['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(SDeliveryMethodsPeer::PRICE, $price, $comparison);
	}

	/**
	 * Filter the query on the free_from column
	 * 
	 * @param     string|array $freeFrom The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SDeliveryMethodsQuery The current query, for fluid interface
	 */
	public function filterByFreeFrom($freeFrom = null, $comparison = null)
	{
		if (is_array($freeFrom)) {
			$useMinMax = false;
			if (isset($freeFrom['min'])) {
				$this->addUsingAlias(SDeliveryMethodsPeer::FREE_FROM, $freeFrom['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($freeFrom['max'])) {
				$this->addUsingAlias(SDeliveryMethodsPeer::FREE_FROM, $freeFrom['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(SDeliveryMethodsPeer::FREE_FROM, $freeFrom, $comparison);
	}

	/**
	 * Filter the query on the enabled column
	 * 
	 * @param     boolean|string $enabled The value to use as filter.
	 *            Accepts strings ('false', 'off', '-', 'no', 'n', and '0' are false, the rest is true)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SDeliveryMethodsQuery The current query, for fluid interface
	 */
	public function filterByEnabled($enabled = null, $comparison = null)
	{
		if (is_string($enabled)) {
			$enabled = in_array(strtolower($enabled), array('false', 'off', '-', 'no', 'n', '0')) ? false : true;
		}
		return $this->addUsingAlias(SDeliveryMethodsPeer::ENABLED, $enabled, $comparison);
	}

	/**
	 * Filter the query by a related SOrders object
	 *
	 * @param     SOrders $sOrders  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SDeliveryMethodsQuery The current query, for fluid interface
	 */
	public function filterBySOrders($sOrders, $comparison = null)
	{
		return $this
			->addUsingAlias(SDeliveryMethodsPeer::ID, $sOrders->getDeliveryMethod(), $comparison);
	}

	/**
	 * Adds a JOIN clause to the query using the SOrders relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    SDeliveryMethodsQuery The current query, for fluid interface
	 */
	public function joinSOrders($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('SOrders');
		
		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}
		
		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'SOrders');
		}
		
		return $this;
	}

	/**
	 * Use the SOrders relation SOrders object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    SOrdersQuery A secondary query class using the current class as primary query
	 */
	public function useSOrdersQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinSOrders($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'SOrders', 'SOrdersQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     SDeliveryMethods $sDeliveryMethods Object to remove from the list of results
	 *
	 * @return    SDeliveryMethodsQuery The current query, for fluid interface
	 */
	public function prune($sDeliveryMethods = null)
	{
		if ($sDeliveryMethods) {
			$this->addUsingAlias(SDeliveryMethodsPeer::ID, $sDeliveryMethods->getId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseSDeliveryMethodsQuery
