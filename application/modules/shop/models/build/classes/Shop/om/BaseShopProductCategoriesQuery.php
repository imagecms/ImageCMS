<?php


/**
 * Base class that represents a query for the 'shop_product_categories' table.
 *
 * 
 *
 * @method     ShopProductCategoriesQuery orderByProductId($order = Criteria::ASC) Order by the product_id column
 * @method     ShopProductCategoriesQuery orderByCategoryId($order = Criteria::ASC) Order by the category_id column
 *
 * @method     ShopProductCategoriesQuery groupByProductId() Group by the product_id column
 * @method     ShopProductCategoriesQuery groupByCategoryId() Group by the category_id column
 *
 * @method     ShopProductCategoriesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ShopProductCategoriesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ShopProductCategoriesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ShopProductCategoriesQuery leftJoinProduct($relationAlias = null) Adds a LEFT JOIN clause to the query using the Product relation
 * @method     ShopProductCategoriesQuery rightJoinProduct($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Product relation
 * @method     ShopProductCategoriesQuery innerJoinProduct($relationAlias = null) Adds a INNER JOIN clause to the query using the Product relation
 *
 * @method     ShopProductCategoriesQuery leftJoinCategory($relationAlias = null) Adds a LEFT JOIN clause to the query using the Category relation
 * @method     ShopProductCategoriesQuery rightJoinCategory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Category relation
 * @method     ShopProductCategoriesQuery innerJoinCategory($relationAlias = null) Adds a INNER JOIN clause to the query using the Category relation
 *
 * @method     ShopProductCategories findOne(PropelPDO $con = null) Return the first ShopProductCategories matching the query
 * @method     ShopProductCategories findOneOrCreate(PropelPDO $con = null) Return the first ShopProductCategories matching the query, or a new ShopProductCategories object populated from the query conditions when no match is found
 *
 * @method     ShopProductCategories findOneByProductId(int $product_id) Return the first ShopProductCategories filtered by the product_id column
 * @method     ShopProductCategories findOneByCategoryId(int $category_id) Return the first ShopProductCategories filtered by the category_id column
 *
 * @method     array findByProductId(int $product_id) Return ShopProductCategories objects filtered by the product_id column
 * @method     array findByCategoryId(int $category_id) Return ShopProductCategories objects filtered by the category_id column
 *
 * @package    propel.generator.Shop.om
 */
abstract class BaseShopProductCategoriesQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseShopProductCategoriesQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'Shop', $modelName = 'ShopProductCategories', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new ShopProductCategoriesQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    ShopProductCategoriesQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof ShopProductCategoriesQuery) {
			return $criteria;
		}
		$query = new ShopProductCategoriesQuery();
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
	 * @param     array[$product_id, $category_id] $key Primary key to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    ShopProductCategories|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = ShopProductCategoriesPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    ShopProductCategoriesQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		$this->addUsingAlias(ShopProductCategoriesPeer::PRODUCT_ID, $key[0], Criteria::EQUAL);
		$this->addUsingAlias(ShopProductCategoriesPeer::CATEGORY_ID, $key[1], Criteria::EQUAL);
		
		return $this;
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    ShopProductCategoriesQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		if (empty($keys)) {
			return $this->add(null, '1<>1', Criteria::CUSTOM);
		}
		foreach ($keys as $key) {
			$cton0 = $this->getNewCriterion(ShopProductCategoriesPeer::PRODUCT_ID, $key[0], Criteria::EQUAL);
			$cton1 = $this->getNewCriterion(ShopProductCategoriesPeer::CATEGORY_ID, $key[1], Criteria::EQUAL);
			$cton0->addAnd($cton1);
			$this->addOr($cton0);
		}
		
		return $this;
	}

	/**
	 * Filter the query on the product_id column
	 * 
	 * @param     int|array $productId The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ShopProductCategoriesQuery The current query, for fluid interface
	 */
	public function filterByProductId($productId = null, $comparison = null)
	{
		if (is_array($productId) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(ShopProductCategoriesPeer::PRODUCT_ID, $productId, $comparison);
	}

	/**
	 * Filter the query on the category_id column
	 * 
	 * @param     int|array $categoryId The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ShopProductCategoriesQuery The current query, for fluid interface
	 */
	public function filterByCategoryId($categoryId = null, $comparison = null)
	{
		if (is_array($categoryId) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(ShopProductCategoriesPeer::CATEGORY_ID, $categoryId, $comparison);
	}

	/**
	 * Filter the query by a related SProducts object
	 *
	 * @param     SProducts $sProducts  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ShopProductCategoriesQuery The current query, for fluid interface
	 */
	public function filterByProduct($sProducts, $comparison = null)
	{
		return $this
			->addUsingAlias(ShopProductCategoriesPeer::PRODUCT_ID, $sProducts->getId(), $comparison);
	}

	/**
	 * Adds a JOIN clause to the query using the Product relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ShopProductCategoriesQuery The current query, for fluid interface
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
	 * Filter the query by a related SCategory object
	 *
	 * @param     SCategory $sCategory  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ShopProductCategoriesQuery The current query, for fluid interface
	 */
	public function filterByCategory($sCategory, $comparison = null)
	{
		return $this
			->addUsingAlias(ShopProductCategoriesPeer::CATEGORY_ID, $sCategory->getId(), $comparison);
	}

	/**
	 * Adds a JOIN clause to the query using the Category relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ShopProductCategoriesQuery The current query, for fluid interface
	 */
	public function joinCategory($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Category');
		
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
			$this->addJoinObject($join, 'Category');
		}
		
		return $this;
	}

	/**
	 * Use the Category relation SCategory object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    SCategoryQuery A secondary query class using the current class as primary query
	 */
	public function useCategoryQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinCategory($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Category', 'SCategoryQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     ShopProductCategories $shopProductCategories Object to remove from the list of results
	 *
	 * @return    ShopProductCategoriesQuery The current query, for fluid interface
	 */
	public function prune($shopProductCategories = null)
	{
		if ($shopProductCategories) {
			$this->addCond('pruneCond0', $this->getAliasedColName(ShopProductCategoriesPeer::PRODUCT_ID), $shopProductCategories->getProductId(), Criteria::NOT_EQUAL);
			$this->addCond('pruneCond1', $this->getAliasedColName(ShopProductCategoriesPeer::CATEGORY_ID), $shopProductCategories->getCategoryId(), Criteria::NOT_EQUAL);
			$this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
	  }
	  
		return $this;
	}

} // BaseShopProductCategoriesQuery
