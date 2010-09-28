<?php


/**
 * Base class that represents a query for the 'shop_category' table.
 *
 * 
 *
 * @method     SCategoryQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     SCategoryQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     SCategoryQuery orderByUrl($order = Criteria::ASC) Order by the url column
 * @method     SCategoryQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     SCategoryQuery orderByMetaDesc($order = Criteria::ASC) Order by the meta_desc column
 * @method     SCategoryQuery orderByMetaTitle($order = Criteria::ASC) Order by the meta_title column
 * @method     SCategoryQuery orderByParentId($order = Criteria::ASC) Order by the parent_id column
 * @method     SCategoryQuery orderByPosition($order = Criteria::ASC) Order by the position column
 * @method     SCategoryQuery orderByFullPath($order = Criteria::ASC) Order by the full_path column
 * @method     SCategoryQuery orderByFullPathIds($order = Criteria::ASC) Order by the full_path_ids column
 *
 * @method     SCategoryQuery groupById() Group by the id column
 * @method     SCategoryQuery groupByName() Group by the name column
 * @method     SCategoryQuery groupByUrl() Group by the url column
 * @method     SCategoryQuery groupByDescription() Group by the description column
 * @method     SCategoryQuery groupByMetaDesc() Group by the meta_desc column
 * @method     SCategoryQuery groupByMetaTitle() Group by the meta_title column
 * @method     SCategoryQuery groupByParentId() Group by the parent_id column
 * @method     SCategoryQuery groupByPosition() Group by the position column
 * @method     SCategoryQuery groupByFullPath() Group by the full_path column
 * @method     SCategoryQuery groupByFullPathIds() Group by the full_path_ids column
 *
 * @method     SCategoryQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     SCategoryQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     SCategoryQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     SCategoryQuery leftJoinSProducts($relationAlias = null) Adds a LEFT JOIN clause to the query using the SProducts relation
 * @method     SCategoryQuery rightJoinSProducts($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SProducts relation
 * @method     SCategoryQuery innerJoinSProducts($relationAlias = null) Adds a INNER JOIN clause to the query using the SProducts relation
 *
 * @method     SCategoryQuery leftJoinShopProductCategories($relationAlias = null) Adds a LEFT JOIN clause to the query using the ShopProductCategories relation
 * @method     SCategoryQuery rightJoinShopProductCategories($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ShopProductCategories relation
 * @method     SCategoryQuery innerJoinShopProductCategories($relationAlias = null) Adds a INNER JOIN clause to the query using the ShopProductCategories relation
 *
 * @method     SCategoryQuery leftJoinShopProductPropertiesCategories($relationAlias = null) Adds a LEFT JOIN clause to the query using the ShopProductPropertiesCategories relation
 * @method     SCategoryQuery rightJoinShopProductPropertiesCategories($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ShopProductPropertiesCategories relation
 * @method     SCategoryQuery innerJoinShopProductPropertiesCategories($relationAlias = null) Adds a INNER JOIN clause to the query using the ShopProductPropertiesCategories relation
 *
 * @method     SCategory findOne(PropelPDO $con = null) Return the first SCategory matching the query
 * @method     SCategory findOneOrCreate(PropelPDO $con = null) Return the first SCategory matching the query, or a new SCategory object populated from the query conditions when no match is found
 *
 * @method     SCategory findOneById(int $id) Return the first SCategory filtered by the id column
 * @method     SCategory findOneByName(string $name) Return the first SCategory filtered by the name column
 * @method     SCategory findOneByUrl(string $url) Return the first SCategory filtered by the url column
 * @method     SCategory findOneByDescription(string $description) Return the first SCategory filtered by the description column
 * @method     SCategory findOneByMetaDesc(string $meta_desc) Return the first SCategory filtered by the meta_desc column
 * @method     SCategory findOneByMetaTitle(string $meta_title) Return the first SCategory filtered by the meta_title column
 * @method     SCategory findOneByParentId(int $parent_id) Return the first SCategory filtered by the parent_id column
 * @method     SCategory findOneByPosition(int $position) Return the first SCategory filtered by the position column
 * @method     SCategory findOneByFullPath(string $full_path) Return the first SCategory filtered by the full_path column
 * @method     SCategory findOneByFullPathIds(string $full_path_ids) Return the first SCategory filtered by the full_path_ids column
 *
 * @method     array findById(int $id) Return SCategory objects filtered by the id column
 * @method     array findByName(string $name) Return SCategory objects filtered by the name column
 * @method     array findByUrl(string $url) Return SCategory objects filtered by the url column
 * @method     array findByDescription(string $description) Return SCategory objects filtered by the description column
 * @method     array findByMetaDesc(string $meta_desc) Return SCategory objects filtered by the meta_desc column
 * @method     array findByMetaTitle(string $meta_title) Return SCategory objects filtered by the meta_title column
 * @method     array findByParentId(int $parent_id) Return SCategory objects filtered by the parent_id column
 * @method     array findByPosition(int $position) Return SCategory objects filtered by the position column
 * @method     array findByFullPath(string $full_path) Return SCategory objects filtered by the full_path column
 * @method     array findByFullPathIds(string $full_path_ids) Return SCategory objects filtered by the full_path_ids column
 *
 * @package    propel.generator.Shop.om
 */
abstract class BaseSCategoryQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseSCategoryQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'Shop', $modelName = 'SCategory', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new SCategoryQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    SCategoryQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof SCategoryQuery) {
			return $criteria;
		}
		$query = new SCategoryQuery();
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
	 * @return    SCategory|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = SCategoryPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    SCategoryQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(SCategoryPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    SCategoryQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(SCategoryPeer::ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the id column
	 * 
	 * @param     int|array $id The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SCategoryQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(SCategoryPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the name column
	 * 
	 * @param     string $name The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SCategoryQuery The current query, for fluid interface
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
		return $this->addUsingAlias(SCategoryPeer::NAME, $name, $comparison);
	}

	/**
	 * Filter the query on the url column
	 * 
	 * @param     string $url The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SCategoryQuery The current query, for fluid interface
	 */
	public function filterByUrl($url = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($url)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $url)) {
				$url = str_replace('*', '%', $url);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(SCategoryPeer::URL, $url, $comparison);
	}

	/**
	 * Filter the query on the description column
	 * 
	 * @param     string $description The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SCategoryQuery The current query, for fluid interface
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
		return $this->addUsingAlias(SCategoryPeer::DESCRIPTION, $description, $comparison);
	}

	/**
	 * Filter the query on the meta_desc column
	 * 
	 * @param     string $metaDesc The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SCategoryQuery The current query, for fluid interface
	 */
	public function filterByMetaDesc($metaDesc = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($metaDesc)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $metaDesc)) {
				$metaDesc = str_replace('*', '%', $metaDesc);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(SCategoryPeer::META_DESC, $metaDesc, $comparison);
	}

	/**
	 * Filter the query on the meta_title column
	 * 
	 * @param     string $metaTitle The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SCategoryQuery The current query, for fluid interface
	 */
	public function filterByMetaTitle($metaTitle = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($metaTitle)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $metaTitle)) {
				$metaTitle = str_replace('*', '%', $metaTitle);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(SCategoryPeer::META_TITLE, $metaTitle, $comparison);
	}

	/**
	 * Filter the query on the parent_id column
	 * 
	 * @param     int|array $parentId The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SCategoryQuery The current query, for fluid interface
	 */
	public function filterByParentId($parentId = null, $comparison = null)
	{
		if (is_array($parentId)) {
			$useMinMax = false;
			if (isset($parentId['min'])) {
				$this->addUsingAlias(SCategoryPeer::PARENT_ID, $parentId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($parentId['max'])) {
				$this->addUsingAlias(SCategoryPeer::PARENT_ID, $parentId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(SCategoryPeer::PARENT_ID, $parentId, $comparison);
	}

	/**
	 * Filter the query on the position column
	 * 
	 * @param     int|array $position The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SCategoryQuery The current query, for fluid interface
	 */
	public function filterByPosition($position = null, $comparison = null)
	{
		if (is_array($position)) {
			$useMinMax = false;
			if (isset($position['min'])) {
				$this->addUsingAlias(SCategoryPeer::POSITION, $position['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($position['max'])) {
				$this->addUsingAlias(SCategoryPeer::POSITION, $position['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(SCategoryPeer::POSITION, $position, $comparison);
	}

	/**
	 * Filter the query on the full_path column
	 * 
	 * @param     string $fullPath The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SCategoryQuery The current query, for fluid interface
	 */
	public function filterByFullPath($fullPath = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($fullPath)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $fullPath)) {
				$fullPath = str_replace('*', '%', $fullPath);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(SCategoryPeer::FULL_PATH, $fullPath, $comparison);
	}

	/**
	 * Filter the query on the full_path_ids column
	 * 
	 * @param     string $fullPathIds The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SCategoryQuery The current query, for fluid interface
	 */
	public function filterByFullPathIds($fullPathIds = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($fullPathIds)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $fullPathIds)) {
				$fullPathIds = str_replace('*', '%', $fullPathIds);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(SCategoryPeer::FULL_PATH_IDS, $fullPathIds, $comparison);
	}

	/**
	 * Filter the query by a related SProducts object
	 *
	 * @param     SProducts $sProducts  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SCategoryQuery The current query, for fluid interface
	 */
	public function filterBySProducts($sProducts, $comparison = null)
	{
		return $this
			->addUsingAlias(SCategoryPeer::ID, $sProducts->getCategoryId(), $comparison);
	}

	/**
	 * Adds a JOIN clause to the query using the SProducts relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    SCategoryQuery The current query, for fluid interface
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
	 * Filter the query by a related ShopProductCategories object
	 *
	 * @param     ShopProductCategories $shopProductCategories  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SCategoryQuery The current query, for fluid interface
	 */
	public function filterByShopProductCategories($shopProductCategories, $comparison = null)
	{
		return $this
			->addUsingAlias(SCategoryPeer::ID, $shopProductCategories->getCategoryId(), $comparison);
	}

	/**
	 * Adds a JOIN clause to the query using the ShopProductCategories relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    SCategoryQuery The current query, for fluid interface
	 */
	public function joinShopProductCategories($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('ShopProductCategories');
		
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
			$this->addJoinObject($join, 'ShopProductCategories');
		}
		
		return $this;
	}

	/**
	 * Use the ShopProductCategories relation ShopProductCategories object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ShopProductCategoriesQuery A secondary query class using the current class as primary query
	 */
	public function useShopProductCategoriesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinShopProductCategories($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'ShopProductCategories', 'ShopProductCategoriesQuery');
	}

	/**
	 * Filter the query by a related ShopProductPropertiesCategories object
	 *
	 * @param     ShopProductPropertiesCategories $shopProductPropertiesCategories  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SCategoryQuery The current query, for fluid interface
	 */
	public function filterByShopProductPropertiesCategories($shopProductPropertiesCategories, $comparison = null)
	{
		return $this
			->addUsingAlias(SCategoryPeer::ID, $shopProductPropertiesCategories->getCategoryId(), $comparison);
	}

	/**
	 * Adds a JOIN clause to the query using the ShopProductPropertiesCategories relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    SCategoryQuery The current query, for fluid interface
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
	 * Filter the query by a related SProducts object
	 * using the shop_product_categories table as cross reference
	 *
	 * @param     SProducts $sProducts the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SCategoryQuery The current query, for fluid interface
	 */
	public function filterByProduct($sProducts, $comparison = Criteria::EQUAL)
	{
		return $this
			->useShopProductCategoriesQuery()
				->filterByProduct($sProducts, $comparison)
			->endUse();
	}
	
	/**
	 * Filter the query by a related SProperties object
	 * using the shop_product_properties_categories table as cross reference
	 *
	 * @param     SProperties $sProperties the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SCategoryQuery The current query, for fluid interface
	 */
	public function filterByProperty($sProperties, $comparison = Criteria::EQUAL)
	{
		return $this
			->useShopProductPropertiesCategoriesQuery()
				->filterByProperty($sProperties, $comparison)
			->endUse();
	}
	
	/**
	 * Exclude object from result
	 *
	 * @param     SCategory $sCategory Object to remove from the list of results
	 *
	 * @return    SCategoryQuery The current query, for fluid interface
	 */
	public function prune($sCategory = null)
	{
		if ($sCategory) {
			$this->addUsingAlias(SCategoryPeer::ID, $sCategory->getId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseSCategoryQuery
