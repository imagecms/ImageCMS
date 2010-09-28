<?php


/**
 * Base class that represents a query for the 'shop_product_properties' table.
 *
 * 
 *
 * @method     SPropertiesQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     SPropertiesQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     SPropertiesQuery orderByActive($order = Criteria::ASC) Order by the active column
 * @method     SPropertiesQuery orderByShowInCompare($order = Criteria::ASC) Order by the show_in_compare column
 * @method     SPropertiesQuery orderByPosition($order = Criteria::ASC) Order by the position column
 * @method     SPropertiesQuery orderByData($order = Criteria::ASC) Order by the data column
 *
 * @method     SPropertiesQuery groupById() Group by the id column
 * @method     SPropertiesQuery groupByName() Group by the name column
 * @method     SPropertiesQuery groupByActive() Group by the active column
 * @method     SPropertiesQuery groupByShowInCompare() Group by the show_in_compare column
 * @method     SPropertiesQuery groupByPosition() Group by the position column
 * @method     SPropertiesQuery groupByData() Group by the data column
 *
 * @method     SPropertiesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     SPropertiesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     SPropertiesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     SPropertiesQuery leftJoinShopProductPropertiesCategories($relationAlias = null) Adds a LEFT JOIN clause to the query using the ShopProductPropertiesCategories relation
 * @method     SPropertiesQuery rightJoinShopProductPropertiesCategories($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ShopProductPropertiesCategories relation
 * @method     SPropertiesQuery innerJoinShopProductPropertiesCategories($relationAlias = null) Adds a INNER JOIN clause to the query using the ShopProductPropertiesCategories relation
 *
 * @method     SPropertiesQuery leftJoinSProductPropertiesData($relationAlias = null) Adds a LEFT JOIN clause to the query using the SProductPropertiesData relation
 * @method     SPropertiesQuery rightJoinSProductPropertiesData($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SProductPropertiesData relation
 * @method     SPropertiesQuery innerJoinSProductPropertiesData($relationAlias = null) Adds a INNER JOIN clause to the query using the SProductPropertiesData relation
 *
 * @method     SProperties findOne(PropelPDO $con = null) Return the first SProperties matching the query
 * @method     SProperties findOneOrCreate(PropelPDO $con = null) Return the first SProperties matching the query, or a new SProperties object populated from the query conditions when no match is found
 *
 * @method     SProperties findOneById(int $id) Return the first SProperties filtered by the id column
 * @method     SProperties findOneByName(string $name) Return the first SProperties filtered by the name column
 * @method     SProperties findOneByActive(boolean $active) Return the first SProperties filtered by the active column
 * @method     SProperties findOneByShowInCompare(boolean $show_in_compare) Return the first SProperties filtered by the show_in_compare column
 * @method     SProperties findOneByPosition(int $position) Return the first SProperties filtered by the position column
 * @method     SProperties findOneByData(string $data) Return the first SProperties filtered by the data column
 *
 * @method     array findById(int $id) Return SProperties objects filtered by the id column
 * @method     array findByName(string $name) Return SProperties objects filtered by the name column
 * @method     array findByActive(boolean $active) Return SProperties objects filtered by the active column
 * @method     array findByShowInCompare(boolean $show_in_compare) Return SProperties objects filtered by the show_in_compare column
 * @method     array findByPosition(int $position) Return SProperties objects filtered by the position column
 * @method     array findByData(string $data) Return SProperties objects filtered by the data column
 *
 * @package    propel.generator.Shop.om
 */
abstract class BaseSPropertiesQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseSPropertiesQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'Shop', $modelName = 'SProperties', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new SPropertiesQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    SPropertiesQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof SPropertiesQuery) {
			return $criteria;
		}
		$query = new SPropertiesQuery();
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
	 * @return    SProperties|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = SPropertiesPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    SPropertiesQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(SPropertiesPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    SPropertiesQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(SPropertiesPeer::ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the id column
	 * 
	 * @param     int|array $id The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SPropertiesQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(SPropertiesPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the name column
	 * 
	 * @param     string $name The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SPropertiesQuery The current query, for fluid interface
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
		return $this->addUsingAlias(SPropertiesPeer::NAME, $name, $comparison);
	}

	/**
	 * Filter the query on the active column
	 * 
	 * @param     boolean|string $active The value to use as filter.
	 *            Accepts strings ('false', 'off', '-', 'no', 'n', and '0' are false, the rest is true)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SPropertiesQuery The current query, for fluid interface
	 */
	public function filterByActive($active = null, $comparison = null)
	{
		if (is_string($active)) {
			$active = in_array(strtolower($active), array('false', 'off', '-', 'no', 'n', '0')) ? false : true;
		}
		return $this->addUsingAlias(SPropertiesPeer::ACTIVE, $active, $comparison);
	}

	/**
	 * Filter the query on the show_in_compare column
	 * 
	 * @param     boolean|string $showInCompare The value to use as filter.
	 *            Accepts strings ('false', 'off', '-', 'no', 'n', and '0' are false, the rest is true)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SPropertiesQuery The current query, for fluid interface
	 */
	public function filterByShowInCompare($showInCompare = null, $comparison = null)
	{
		if (is_string($showInCompare)) {
			$show_in_compare = in_array(strtolower($showInCompare), array('false', 'off', '-', 'no', 'n', '0')) ? false : true;
		}
		return $this->addUsingAlias(SPropertiesPeer::SHOW_IN_COMPARE, $showInCompare, $comparison);
	}

	/**
	 * Filter the query on the position column
	 * 
	 * @param     int|array $position The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SPropertiesQuery The current query, for fluid interface
	 */
	public function filterByPosition($position = null, $comparison = null)
	{
		if (is_array($position)) {
			$useMinMax = false;
			if (isset($position['min'])) {
				$this->addUsingAlias(SPropertiesPeer::POSITION, $position['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($position['max'])) {
				$this->addUsingAlias(SPropertiesPeer::POSITION, $position['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(SPropertiesPeer::POSITION, $position, $comparison);
	}

	/**
	 * Filter the query on the data column
	 * 
	 * @param     string $data The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SPropertiesQuery The current query, for fluid interface
	 */
	public function filterByData($data = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($data)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $data)) {
				$data = str_replace('*', '%', $data);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(SPropertiesPeer::DATA, $data, $comparison);
	}

	/**
	 * Filter the query by a related ShopProductPropertiesCategories object
	 *
	 * @param     ShopProductPropertiesCategories $shopProductPropertiesCategories  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SPropertiesQuery The current query, for fluid interface
	 */
	public function filterByShopProductPropertiesCategories($shopProductPropertiesCategories, $comparison = null)
	{
		return $this
			->addUsingAlias(SPropertiesPeer::ID, $shopProductPropertiesCategories->getPropertyId(), $comparison);
	}

	/**
	 * Adds a JOIN clause to the query using the ShopProductPropertiesCategories relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    SPropertiesQuery The current query, for fluid interface
	 */
	public function joinShopProductPropertiesCategories($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('ShopProductPropertiesCategories');
		
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
			$this->addJoinObject($join, 'ShopProductPropertiesCategories');
		}
		
		return $this;
	}

	/**
	 * Use the ShopProductPropertiesCategories relation ShopProductPropertiesCategories object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ShopProductPropertiesCategoriesQuery A secondary query class using the current class as primary query
	 */
	public function useShopProductPropertiesCategoriesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinShopProductPropertiesCategories($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'ShopProductPropertiesCategories', 'ShopProductPropertiesCategoriesQuery');
	}

	/**
	 * Filter the query by a related SProductPropertiesData object
	 *
	 * @param     SProductPropertiesData $sProductPropertiesData  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SPropertiesQuery The current query, for fluid interface
	 */
	public function filterBySProductPropertiesData($sProductPropertiesData, $comparison = null)
	{
		return $this
			->addUsingAlias(SPropertiesPeer::ID, $sProductPropertiesData->getPropertyId(), $comparison);
	}

	/**
	 * Adds a JOIN clause to the query using the SProductPropertiesData relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    SPropertiesQuery The current query, for fluid interface
	 */
	public function joinSProductPropertiesData($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('SProductPropertiesData');
		
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
			$this->addJoinObject($join, 'SProductPropertiesData');
		}
		
		return $this;
	}

	/**
	 * Use the SProductPropertiesData relation SProductPropertiesData object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    SProductPropertiesDataQuery A secondary query class using the current class as primary query
	 */
	public function useSProductPropertiesDataQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinSProductPropertiesData($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'SProductPropertiesData', 'SProductPropertiesDataQuery');
	}

	/**
	 * Filter the query by a related SCategory object
	 * using the shop_product_properties_categories table as cross reference
	 *
	 * @param     SCategory $sCategory the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SPropertiesQuery The current query, for fluid interface
	 */
	public function filterByPropertyCategory($sCategory, $comparison = Criteria::EQUAL)
	{
		return $this
			->useShopProductPropertiesCategoriesQuery()
				->filterByPropertyCategory($sCategory, $comparison)
			->endUse();
	}
	
	/**
	 * Exclude object from result
	 *
	 * @param     SProperties $sProperties Object to remove from the list of results
	 *
	 * @return    SPropertiesQuery The current query, for fluid interface
	 */
	public function prune($sProperties = null)
	{
		if ($sProperties) {
			$this->addUsingAlias(SPropertiesPeer::ID, $sProperties->getId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseSPropertiesQuery
