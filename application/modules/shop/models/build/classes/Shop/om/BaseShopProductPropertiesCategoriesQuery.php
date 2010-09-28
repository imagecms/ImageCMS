<?php


/**
 * Base class that represents a query for the 'shop_product_properties_categories' table.
 *
 * 
 *
 * @method     ShopProductPropertiesCategoriesQuery orderByPropertyId($order = Criteria::ASC) Order by the property_id column
 * @method     ShopProductPropertiesCategoriesQuery orderByCategoryId($order = Criteria::ASC) Order by the category_id column
 *
 * @method     ShopProductPropertiesCategoriesQuery groupByPropertyId() Group by the property_id column
 * @method     ShopProductPropertiesCategoriesQuery groupByCategoryId() Group by the category_id column
 *
 * @method     ShopProductPropertiesCategoriesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ShopProductPropertiesCategoriesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ShopProductPropertiesCategoriesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ShopProductPropertiesCategoriesQuery leftJoinProperty($relationAlias = null) Adds a LEFT JOIN clause to the query using the Property relation
 * @method     ShopProductPropertiesCategoriesQuery rightJoinProperty($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Property relation
 * @method     ShopProductPropertiesCategoriesQuery innerJoinProperty($relationAlias = null) Adds a INNER JOIN clause to the query using the Property relation
 *
 * @method     ShopProductPropertiesCategoriesQuery leftJoinPropertyCategory($relationAlias = null) Adds a LEFT JOIN clause to the query using the PropertyCategory relation
 * @method     ShopProductPropertiesCategoriesQuery rightJoinPropertyCategory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PropertyCategory relation
 * @method     ShopProductPropertiesCategoriesQuery innerJoinPropertyCategory($relationAlias = null) Adds a INNER JOIN clause to the query using the PropertyCategory relation
 *
 * @method     ShopProductPropertiesCategories findOne(PropelPDO $con = null) Return the first ShopProductPropertiesCategories matching the query
 * @method     ShopProductPropertiesCategories findOneOrCreate(PropelPDO $con = null) Return the first ShopProductPropertiesCategories matching the query, or a new ShopProductPropertiesCategories object populated from the query conditions when no match is found
 *
 * @method     ShopProductPropertiesCategories findOneByPropertyId(int $property_id) Return the first ShopProductPropertiesCategories filtered by the property_id column
 * @method     ShopProductPropertiesCategories findOneByCategoryId(int $category_id) Return the first ShopProductPropertiesCategories filtered by the category_id column
 *
 * @method     array findByPropertyId(int $property_id) Return ShopProductPropertiesCategories objects filtered by the property_id column
 * @method     array findByCategoryId(int $category_id) Return ShopProductPropertiesCategories objects filtered by the category_id column
 *
 * @package    propel.generator.Shop.om
 */
abstract class BaseShopProductPropertiesCategoriesQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseShopProductPropertiesCategoriesQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'Shop', $modelName = 'ShopProductPropertiesCategories', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new ShopProductPropertiesCategoriesQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    ShopProductPropertiesCategoriesQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof ShopProductPropertiesCategoriesQuery) {
			return $criteria;
		}
		$query = new ShopProductPropertiesCategoriesQuery();
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
	 * @param     array[$property_id, $category_id] $key Primary key to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    ShopProductPropertiesCategories|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = ShopProductPropertiesCategoriesPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    ShopProductPropertiesCategoriesQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		$this->addUsingAlias(ShopProductPropertiesCategoriesPeer::PROPERTY_ID, $key[0], Criteria::EQUAL);
		$this->addUsingAlias(ShopProductPropertiesCategoriesPeer::CATEGORY_ID, $key[1], Criteria::EQUAL);
		
		return $this;
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    ShopProductPropertiesCategoriesQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		if (empty($keys)) {
			return $this->add(null, '1<>1', Criteria::CUSTOM);
		}
		foreach ($keys as $key) {
			$cton0 = $this->getNewCriterion(ShopProductPropertiesCategoriesPeer::PROPERTY_ID, $key[0], Criteria::EQUAL);
			$cton1 = $this->getNewCriterion(ShopProductPropertiesCategoriesPeer::CATEGORY_ID, $key[1], Criteria::EQUAL);
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
	 * @return    ShopProductPropertiesCategoriesQuery The current query, for fluid interface
	 */
	public function filterByPropertyId($propertyId = null, $comparison = null)
	{
		if (is_array($propertyId) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(ShopProductPropertiesCategoriesPeer::PROPERTY_ID, $propertyId, $comparison);
	}

	/**
	 * Filter the query on the category_id column
	 * 
	 * @param     int|array $categoryId The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ShopProductPropertiesCategoriesQuery The current query, for fluid interface
	 */
	public function filterByCategoryId($categoryId = null, $comparison = null)
	{
		if (is_array($categoryId) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(ShopProductPropertiesCategoriesPeer::CATEGORY_ID, $categoryId, $comparison);
	}

	/**
	 * Filter the query by a related SProperties object
	 *
	 * @param     SProperties $sProperties  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ShopProductPropertiesCategoriesQuery The current query, for fluid interface
	 */
	public function filterByProperty($sProperties, $comparison = null)
	{
		return $this
			->addUsingAlias(ShopProductPropertiesCategoriesPeer::PROPERTY_ID, $sProperties->getId(), $comparison);
	}

	/**
	 * Adds a JOIN clause to the query using the Property relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ShopProductPropertiesCategoriesQuery The current query, for fluid interface
	 */
	public function joinProperty($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Property');
		
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
			$this->addJoinObject($join, 'Property');
		}
		
		return $this;
	}

	/**
	 * Use the Property relation SProperties object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    SPropertiesQuery A secondary query class using the current class as primary query
	 */
	public function usePropertyQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinProperty($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Property', 'SPropertiesQuery');
	}

	/**
	 * Filter the query by a related SCategory object
	 *
	 * @param     SCategory $sCategory  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ShopProductPropertiesCategoriesQuery The current query, for fluid interface
	 */
	public function filterByPropertyCategory($sCategory, $comparison = null)
	{
		return $this
			->addUsingAlias(ShopProductPropertiesCategoriesPeer::CATEGORY_ID, $sCategory->getId(), $comparison);
	}

	/**
	 * Adds a JOIN clause to the query using the PropertyCategory relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ShopProductPropertiesCategoriesQuery The current query, for fluid interface
	 */
	public function joinPropertyCategory($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('PropertyCategory');
		
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
			$this->addJoinObject($join, 'PropertyCategory');
		}
		
		return $this;
	}

	/**
	 * Use the PropertyCategory relation SCategory object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    SCategoryQuery A secondary query class using the current class as primary query
	 */
	public function usePropertyCategoryQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinPropertyCategory($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'PropertyCategory', 'SCategoryQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     ShopProductPropertiesCategories $shopProductPropertiesCategories Object to remove from the list of results
	 *
	 * @return    ShopProductPropertiesCategoriesQuery The current query, for fluid interface
	 */
	public function prune($shopProductPropertiesCategories = null)
	{
		if ($shopProductPropertiesCategories) {
			$this->addCond('pruneCond0', $this->getAliasedColName(ShopProductPropertiesCategoriesPeer::PROPERTY_ID), $shopProductPropertiesCategories->getPropertyId(), Criteria::NOT_EQUAL);
			$this->addCond('pruneCond1', $this->getAliasedColName(ShopProductPropertiesCategoriesPeer::CATEGORY_ID), $shopProductPropertiesCategories->getCategoryId(), Criteria::NOT_EQUAL);
			$this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
	  }
	  
		return $this;
	}

} // BaseShopProductPropertiesCategoriesQuery
