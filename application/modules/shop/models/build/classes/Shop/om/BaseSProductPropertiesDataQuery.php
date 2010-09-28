<?php


/**
 * Base class that represents a query for the 'shop_product_properties_data' table.
 *
 * 
 *
 * @method     SProductPropertiesDataQuery orderByPropertyId($order = Criteria::ASC) Order by the property_id column
 * @method     SProductPropertiesDataQuery orderByProductId($order = Criteria::ASC) Order by the product_id column
 * @method     SProductPropertiesDataQuery orderByValue($order = Criteria::ASC) Order by the value column
 *
 * @method     SProductPropertiesDataQuery groupByPropertyId() Group by the property_id column
 * @method     SProductPropertiesDataQuery groupByProductId() Group by the product_id column
 * @method     SProductPropertiesDataQuery groupByValue() Group by the value column
 *
 * @method     SProductPropertiesDataQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     SProductPropertiesDataQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     SProductPropertiesDataQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     SProductPropertiesDataQuery leftJoinSProperties($relationAlias = null) Adds a LEFT JOIN clause to the query using the SProperties relation
 * @method     SProductPropertiesDataQuery rightJoinSProperties($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SProperties relation
 * @method     SProductPropertiesDataQuery innerJoinSProperties($relationAlias = null) Adds a INNER JOIN clause to the query using the SProperties relation
 *
 * @method     SProductPropertiesDataQuery leftJoinProduct($relationAlias = null) Adds a LEFT JOIN clause to the query using the Product relation
 * @method     SProductPropertiesDataQuery rightJoinProduct($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Product relation
 * @method     SProductPropertiesDataQuery innerJoinProduct($relationAlias = null) Adds a INNER JOIN clause to the query using the Product relation
 *
 * @method     SProductPropertiesData findOne(PropelPDO $con = null) Return the first SProductPropertiesData matching the query
 * @method     SProductPropertiesData findOneOrCreate(PropelPDO $con = null) Return the first SProductPropertiesData matching the query, or a new SProductPropertiesData object populated from the query conditions when no match is found
 *
 * @method     SProductPropertiesData findOneByPropertyId(int $property_id) Return the first SProductPropertiesData filtered by the property_id column
 * @method     SProductPropertiesData findOneByProductId(int $product_id) Return the first SProductPropertiesData filtered by the product_id column
 * @method     SProductPropertiesData findOneByValue(string $value) Return the first SProductPropertiesData filtered by the value column
 *
 * @method     array findByPropertyId(int $property_id) Return SProductPropertiesData objects filtered by the property_id column
 * @method     array findByProductId(int $product_id) Return SProductPropertiesData objects filtered by the product_id column
 * @method     array findByValue(string $value) Return SProductPropertiesData objects filtered by the value column
 *
 * @package    propel.generator.Shop.om
 */
abstract class BaseSProductPropertiesDataQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseSProductPropertiesDataQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'Shop', $modelName = 'SProductPropertiesData', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new SProductPropertiesDataQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    SProductPropertiesDataQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof SProductPropertiesDataQuery) {
			return $criteria;
		}
		$query = new SProductPropertiesDataQuery();
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
	 * <code>
	 * $obj = $c->findPk(array(12, 34), $con);
	 * </code>
	 * @param     array[$property_id, $product_id] $key Primary key to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    SProductPropertiesData|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = SProductPropertiesDataPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
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
	 * @return    SProductPropertiesDataQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		$this->addUsingAlias(SProductPropertiesDataPeer::PROPERTY_ID, $key[0], Criteria::EQUAL);
		$this->addUsingAlias(SProductPropertiesDataPeer::PRODUCT_ID, $key[1], Criteria::EQUAL);
		
		return $this;
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    SProductPropertiesDataQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		if (empty($keys)) {
			return $this->add(null, '1<>1', Criteria::CUSTOM);
		}
		foreach ($keys as $key) {
			$cton0 = $this->getNewCriterion(SProductPropertiesDataPeer::PROPERTY_ID, $key[0], Criteria::EQUAL);
			$cton1 = $this->getNewCriterion(SProductPropertiesDataPeer::PRODUCT_ID, $key[1], Criteria::EQUAL);
			$cton0->addAnd($cton1);
			$this->addOr($cton0);
		}
		
		return $this;
	}

	/**
	 * Filter the query on the property_id column
	 * 
	 * @param     int|array $propertyId The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SProductPropertiesDataQuery The current query, for fluid interface
	 */
	public function filterByPropertyId($propertyId = null, $comparison = null)
	{
		if (is_array($propertyId) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(SProductPropertiesDataPeer::PROPERTY_ID, $propertyId, $comparison);
	}

	/**
	 * Filter the query on the product_id column
	 * 
	 * @param     int|array $productId The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SProductPropertiesDataQuery The current query, for fluid interface
	 */
	public function filterByProductId($productId = null, $comparison = null)
	{
		if (is_array($productId) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(SProductPropertiesDataPeer::PRODUCT_ID, $productId, $comparison);
	}

	/**
	 * Filter the query on the value column
	 * 
	 * @param     string $value The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SProductPropertiesDataQuery The current query, for fluid interface
	 */
	public function filterByValue($value = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($value)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $value)) {
				$value = str_replace('*', '%', $value);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(SProductPropertiesDataPeer::VALUE, $value, $comparison);
	}

	/**
	 * Filter the query by a related SProperties object
	 *
	 * @param     SProperties $sProperties  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SProductPropertiesDataQuery The current query, for fluid interface
	 */
	public function filterBySProperties($sProperties, $comparison = null)
	{
		return $this
			->addUsingAlias(SProductPropertiesDataPeer::PROPERTY_ID, $sProperties->getId(), $comparison);
	}

	/**
	 * Adds a JOIN clause to the query using the SProperties relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    SProductPropertiesDataQuery The current query, for fluid interface
	 */
	public function joinSProperties($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('SProperties');
		
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
			$this->addJoinObject($join, 'SProperties');
		}
		
		return $this;
	}

	/**
	 * Use the SProperties relation SProperties object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    SPropertiesQuery A secondary query class using the current class as primary query
	 */
	public function useSPropertiesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinSProperties($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'SProperties', 'SPropertiesQuery');
	}

	/**
	 * Filter the query by a related SProducts object
	 *
	 * @param     SProducts $sProducts  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SProductPropertiesDataQuery The current query, for fluid interface
	 */
	public function filterByProduct($sProducts, $comparison = null)
	{
		return $this
			->addUsingAlias(SProductPropertiesDataPeer::PRODUCT_ID, $sProducts->getId(), $comparison);
	}

	/**
	 * Adds a JOIN clause to the query using the Product relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    SProductPropertiesDataQuery The current query, for fluid interface
	 */
	public function joinProduct($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Product');
		
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
			$this->addJoinObject($join, 'Product');
		}
		
		return $this;
	}

	/**
	 * Use the Product relation SProducts object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    SProductsQuery A secondary query class using the current class as primary query
	 */
	public function useProductQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinProduct($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Product', 'SProductsQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     SProductPropertiesData $sProductPropertiesData Object to remove from the list of results
	 *
	 * @return    SProductPropertiesDataQuery The current query, for fluid interface
	 */
	public function prune($sProductPropertiesData = null)
	{
		if ($sProductPropertiesData) {
			$this->addCond('pruneCond0', $this->getAliasedColName(SProductPropertiesDataPeer::PROPERTY_ID), $sProductPropertiesData->getPropertyId(), Criteria::NOT_EQUAL);
			$this->addCond('pruneCond1', $this->getAliasedColName(SProductPropertiesDataPeer::PRODUCT_ID), $sProductPropertiesData->getProductId(), Criteria::NOT_EQUAL);
			$this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
	  }
	  
		return $this;
	}

} // BaseSProductPropertiesDataQuery
