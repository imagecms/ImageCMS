<?php


/**
 * Base class that represents a query for the 'shop_orders_products' table.
 *
 * 
 *
 * @method     SOrderProductsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     SOrderProductsQuery orderByOrderId($order = Criteria::ASC) Order by the order_id column
 * @method     SOrderProductsQuery orderByProductId($order = Criteria::ASC) Order by the product_id column
 * @method     SOrderProductsQuery orderByVariantId($order = Criteria::ASC) Order by the variant_id column
 * @method     SOrderProductsQuery orderByProductName($order = Criteria::ASC) Order by the product_name column
 * @method     SOrderProductsQuery orderByVariantName($order = Criteria::ASC) Order by the variant_name column
 * @method     SOrderProductsQuery orderByPrice($order = Criteria::ASC) Order by the price column
 * @method     SOrderProductsQuery orderByQuantity($order = Criteria::ASC) Order by the quantity column
 *
 * @method     SOrderProductsQuery groupById() Group by the id column
 * @method     SOrderProductsQuery groupByOrderId() Group by the order_id column
 * @method     SOrderProductsQuery groupByProductId() Group by the product_id column
 * @method     SOrderProductsQuery groupByVariantId() Group by the variant_id column
 * @method     SOrderProductsQuery groupByProductName() Group by the product_name column
 * @method     SOrderProductsQuery groupByVariantName() Group by the variant_name column
 * @method     SOrderProductsQuery groupByPrice() Group by the price column
 * @method     SOrderProductsQuery groupByQuantity() Group by the quantity column
 *
 * @method     SOrderProductsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     SOrderProductsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     SOrderProductsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     SOrderProductsQuery leftJoinSProducts($relationAlias = null) Adds a LEFT JOIN clause to the query using the SProducts relation
 * @method     SOrderProductsQuery rightJoinSProducts($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SProducts relation
 * @method     SOrderProductsQuery innerJoinSProducts($relationAlias = null) Adds a INNER JOIN clause to the query using the SProducts relation
 *
 * @method     SOrderProductsQuery leftJoinSOrders($relationAlias = null) Adds a LEFT JOIN clause to the query using the SOrders relation
 * @method     SOrderProductsQuery rightJoinSOrders($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SOrders relation
 * @method     SOrderProductsQuery innerJoinSOrders($relationAlias = null) Adds a INNER JOIN clause to the query using the SOrders relation
 *
 * @method     SOrderProducts findOne(PropelPDO $con = null) Return the first SOrderProducts matching the query
 * @method     SOrderProducts findOneOrCreate(PropelPDO $con = null) Return the first SOrderProducts matching the query, or a new SOrderProducts object populated from the query conditions when no match is found
 *
 * @method     SOrderProducts findOneById(int $id) Return the first SOrderProducts filtered by the id column
 * @method     SOrderProducts findOneByOrderId(int $order_id) Return the first SOrderProducts filtered by the order_id column
 * @method     SOrderProducts findOneByProductId(int $product_id) Return the first SOrderProducts filtered by the product_id column
 * @method     SOrderProducts findOneByVariantId(int $variant_id) Return the first SOrderProducts filtered by the variant_id column
 * @method     SOrderProducts findOneByProductName(string $product_name) Return the first SOrderProducts filtered by the product_name column
 * @method     SOrderProducts findOneByVariantName(string $variant_name) Return the first SOrderProducts filtered by the variant_name column
 * @method     SOrderProducts findOneByPrice(string $price) Return the first SOrderProducts filtered by the price column
 * @method     SOrderProducts findOneByQuantity(int $quantity) Return the first SOrderProducts filtered by the quantity column
 *
 * @method     array findById(int $id) Return SOrderProducts objects filtered by the id column
 * @method     array findByOrderId(int $order_id) Return SOrderProducts objects filtered by the order_id column
 * @method     array findByProductId(int $product_id) Return SOrderProducts objects filtered by the product_id column
 * @method     array findByVariantId(int $variant_id) Return SOrderProducts objects filtered by the variant_id column
 * @method     array findByProductName(string $product_name) Return SOrderProducts objects filtered by the product_name column
 * @method     array findByVariantName(string $variant_name) Return SOrderProducts objects filtered by the variant_name column
 * @method     array findByPrice(string $price) Return SOrderProducts objects filtered by the price column
 * @method     array findByQuantity(int $quantity) Return SOrderProducts objects filtered by the quantity column
 *
 * @package    propel.generator.Shop.om
 */
abstract class BaseSOrderProductsQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseSOrderProductsQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'Shop', $modelName = 'SOrderProducts', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new SOrderProductsQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    SOrderProductsQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof SOrderProductsQuery) {
			return $criteria;
		}
		$query = new SOrderProductsQuery();
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
	 * @return    SOrderProducts|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = SOrderProductsPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    SOrderProductsQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(SOrderProductsPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    SOrderProductsQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(SOrderProductsPeer::ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the id column
	 * 
	 * @param     int|array $id The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SOrderProductsQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(SOrderProductsPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the order_id column
	 * 
	 * @param     int|array $orderId The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SOrderProductsQuery The current query, for fluid interface
	 */
	public function filterByOrderId($orderId = null, $comparison = null)
	{
		if (is_array($orderId)) {
			$useMinMax = false;
			if (isset($orderId['min'])) {
				$this->addUsingAlias(SOrderProductsPeer::ORDER_ID, $orderId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($orderId['max'])) {
				$this->addUsingAlias(SOrderProductsPeer::ORDER_ID, $orderId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(SOrderProductsPeer::ORDER_ID, $orderId, $comparison);
	}

	/**
	 * Filter the query on the product_id column
	 * 
	 * @param     int|array $productId The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SOrderProductsQuery The current query, for fluid interface
	 */
	public function filterByProductId($productId = null, $comparison = null)
	{
		if (is_array($productId)) {
			$useMinMax = false;
			if (isset($productId['min'])) {
				$this->addUsingAlias(SOrderProductsPeer::PRODUCT_ID, $productId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($productId['max'])) {
				$this->addUsingAlias(SOrderProductsPeer::PRODUCT_ID, $productId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(SOrderProductsPeer::PRODUCT_ID, $productId, $comparison);
	}

	/**
	 * Filter the query on the variant_id column
	 * 
	 * @param     int|array $variantId The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SOrderProductsQuery The current query, for fluid interface
	 */
	public function filterByVariantId($variantId = null, $comparison = null)
	{
		if (is_array($variantId)) {
			$useMinMax = false;
			if (isset($variantId['min'])) {
				$this->addUsingAlias(SOrderProductsPeer::VARIANT_ID, $variantId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($variantId['max'])) {
				$this->addUsingAlias(SOrderProductsPeer::VARIANT_ID, $variantId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(SOrderProductsPeer::VARIANT_ID, $variantId, $comparison);
	}

	/**
	 * Filter the query on the product_name column
	 * 
	 * @param     string $productName The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SOrderProductsQuery The current query, for fluid interface
	 */
	public function filterByProductName($productName = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($productName)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $productName)) {
				$productName = str_replace('*', '%', $productName);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(SOrderProductsPeer::PRODUCT_NAME, $productName, $comparison);
	}

	/**
	 * Filter the query on the variant_name column
	 * 
	 * @param     string $variantName The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SOrderProductsQuery The current query, for fluid interface
	 */
	public function filterByVariantName($variantName = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($variantName)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $variantName)) {
				$variantName = str_replace('*', '%', $variantName);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(SOrderProductsPeer::VARIANT_NAME, $variantName, $comparison);
	}

	/**
	 * Filter the query on the price column
	 * 
	 * @param     string|array $price The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SOrderProductsQuery The current query, for fluid interface
	 */
	public function filterByPrice($price = null, $comparison = null)
	{
		if (is_array($price)) {
			$useMinMax = false;
			if (isset($price['min'])) {
				$this->addUsingAlias(SOrderProductsPeer::PRICE, $price['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($price['max'])) {
				$this->addUsingAlias(SOrderProductsPeer::PRICE, $price['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(SOrderProductsPeer::PRICE, $price, $comparison);
	}

	/**
	 * Filter the query on the quantity column
	 * 
	 * @param     int|array $quantity The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SOrderProductsQuery The current query, for fluid interface
	 */
	public function filterByQuantity($quantity = null, $comparison = null)
	{
		if (is_array($quantity)) {
			$useMinMax = false;
			if (isset($quantity['min'])) {
				$this->addUsingAlias(SOrderProductsPeer::QUANTITY, $quantity['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($quantity['max'])) {
				$this->addUsingAlias(SOrderProductsPeer::QUANTITY, $quantity['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(SOrderProductsPeer::QUANTITY, $quantity, $comparison);
	}

	/**
	 * Filter the query by a related SProducts object
	 *
	 * @param     SProducts $sProducts  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SOrderProductsQuery The current query, for fluid interface
	 */
	public function filterBySProducts($sProducts, $comparison = null)
	{
		return $this
			->addUsingAlias(SOrderProductsPeer::PRODUCT_ID, $sProducts->getId(), $comparison);
	}

	/**
	 * Adds a JOIN clause to the query using the SProducts relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    SOrderProductsQuery The current query, for fluid interface
	 */
	public function joinSProducts($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('SProducts');
		
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
			$this->addJoinObject($join, 'SProducts');
		}
		
		return $this;
	}

	/**
	 * Use the SProducts relation SProducts object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    SProductsQuery A secondary query class using the current class as primary query
	 */
	public function useSProductsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinSProducts($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'SProducts', 'SProductsQuery');
	}

	/**
	 * Filter the query by a related SOrders object
	 *
	 * @param     SOrders $sOrders  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SOrderProductsQuery The current query, for fluid interface
	 */
	public function filterBySOrders($sOrders, $comparison = null)
	{
		return $this
			->addUsingAlias(SOrderProductsPeer::ORDER_ID, $sOrders->getId(), $comparison);
	}

	/**
	 * Adds a JOIN clause to the query using the SOrders relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    SOrderProductsQuery The current query, for fluid interface
	 */
	public function joinSOrders($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
	public function useSOrdersQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinSOrders($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'SOrders', 'SOrdersQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     SOrderProducts $sOrderProducts Object to remove from the list of results
	 *
	 * @return    SOrderProductsQuery The current query, for fluid interface
	 */
	public function prune($sOrderProducts = null)
	{
		if ($sOrderProducts) {
			$this->addUsingAlias(SOrderProductsPeer::ID, $sOrderProducts->getId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseSOrderProductsQuery
