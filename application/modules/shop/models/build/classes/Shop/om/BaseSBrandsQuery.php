<?php


/**
 * Base class that represents a query for the 'shop_brands' table.
 *
 * 
 *
 * @method     SBrandsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     SBrandsQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     SBrandsQuery orderByUrl($order = Criteria::ASC) Order by the url column
 * @method     SBrandsQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     SBrandsQuery orderByMetaTitle($order = Criteria::ASC) Order by the meta_title column
 * @method     SBrandsQuery orderByMetaDescription($order = Criteria::ASC) Order by the meta_description column
 * @method     SBrandsQuery orderByMetaKeywords($order = Criteria::ASC) Order by the meta_keywords column
 *
 * @method     SBrandsQuery groupById() Group by the id column
 * @method     SBrandsQuery groupByName() Group by the name column
 * @method     SBrandsQuery groupByUrl() Group by the url column
 * @method     SBrandsQuery groupByDescription() Group by the description column
 * @method     SBrandsQuery groupByMetaTitle() Group by the meta_title column
 * @method     SBrandsQuery groupByMetaDescription() Group by the meta_description column
 * @method     SBrandsQuery groupByMetaKeywords() Group by the meta_keywords column
 *
 * @method     SBrandsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     SBrandsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     SBrandsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     SBrandsQuery leftJoinSProducts($relationAlias = null) Adds a LEFT JOIN clause to the query using the SProducts relation
 * @method     SBrandsQuery rightJoinSProducts($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SProducts relation
 * @method     SBrandsQuery innerJoinSProducts($relationAlias = null) Adds a INNER JOIN clause to the query using the SProducts relation
 *
 * @method     SBrands findOne(PropelPDO $con = null) Return the first SBrands matching the query
 * @method     SBrands findOneOrCreate(PropelPDO $con = null) Return the first SBrands matching the query, or a new SBrands object populated from the query conditions when no match is found
 *
 * @method     SBrands findOneById(int $id) Return the first SBrands filtered by the id column
 * @method     SBrands findOneByName(string $name) Return the first SBrands filtered by the name column
 * @method     SBrands findOneByUrl(string $url) Return the first SBrands filtered by the url column
 * @method     SBrands findOneByDescription(string $description) Return the first SBrands filtered by the description column
 * @method     SBrands findOneByMetaTitle(string $meta_title) Return the first SBrands filtered by the meta_title column
 * @method     SBrands findOneByMetaDescription(string $meta_description) Return the first SBrands filtered by the meta_description column
 * @method     SBrands findOneByMetaKeywords(string $meta_keywords) Return the first SBrands filtered by the meta_keywords column
 *
 * @method     array findById(int $id) Return SBrands objects filtered by the id column
 * @method     array findByName(string $name) Return SBrands objects filtered by the name column
 * @method     array findByUrl(string $url) Return SBrands objects filtered by the url column
 * @method     array findByDescription(string $description) Return SBrands objects filtered by the description column
 * @method     array findByMetaTitle(string $meta_title) Return SBrands objects filtered by the meta_title column
 * @method     array findByMetaDescription(string $meta_description) Return SBrands objects filtered by the meta_description column
 * @method     array findByMetaKeywords(string $meta_keywords) Return SBrands objects filtered by the meta_keywords column
 *
 * @package    propel.generator.Shop.om
 */
abstract class BaseSBrandsQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseSBrandsQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'Shop', $modelName = 'SBrands', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new SBrandsQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    SBrandsQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof SBrandsQuery) {
			return $criteria;
		}
		$query = new SBrandsQuery();
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
	 * @return    SBrands|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = SBrandsPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    SBrandsQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(SBrandsPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    SBrandsQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(SBrandsPeer::ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the id column
	 * 
	 * @param     int|array $id The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SBrandsQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(SBrandsPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the name column
	 * 
	 * @param     string $name The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SBrandsQuery The current query, for fluid interface
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
		return $this->addUsingAlias(SBrandsPeer::NAME, $name, $comparison);
	}

	/**
	 * Filter the query on the url column
	 * 
	 * @param     string $url The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SBrandsQuery The current query, for fluid interface
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
		return $this->addUsingAlias(SBrandsPeer::URL, $url, $comparison);
	}

	/**
	 * Filter the query on the description column
	 * 
	 * @param     string $description The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SBrandsQuery The current query, for fluid interface
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
		return $this->addUsingAlias(SBrandsPeer::DESCRIPTION, $description, $comparison);
	}

	/**
	 * Filter the query on the meta_title column
	 * 
	 * @param     string $metaTitle The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SBrandsQuery The current query, for fluid interface
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
		return $this->addUsingAlias(SBrandsPeer::META_TITLE, $metaTitle, $comparison);
	}

	/**
	 * Filter the query on the meta_description column
	 * 
	 * @param     string $metaDescription The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SBrandsQuery The current query, for fluid interface
	 */
	public function filterByMetaDescription($metaDescription = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($metaDescription)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $metaDescription)) {
				$metaDescription = str_replace('*', '%', $metaDescription);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(SBrandsPeer::META_DESCRIPTION, $metaDescription, $comparison);
	}

	/**
	 * Filter the query on the meta_keywords column
	 * 
	 * @param     string $metaKeywords The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SBrandsQuery The current query, for fluid interface
	 */
	public function filterByMetaKeywords($metaKeywords = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($metaKeywords)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $metaKeywords)) {
				$metaKeywords = str_replace('*', '%', $metaKeywords);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(SBrandsPeer::META_KEYWORDS, $metaKeywords, $comparison);
	}

	/**
	 * Filter the query by a related SProducts object
	 *
	 * @param     SProducts $sProducts  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SBrandsQuery The current query, for fluid interface
	 */
	public function filterBySProducts($sProducts, $comparison = null)
	{
		return $this
			->addUsingAlias(SBrandsPeer::ID, $sProducts->getBrandId(), $comparison);
	}

	/**
	 * Adds a JOIN clause to the query using the SProducts relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    SBrandsQuery The current query, for fluid interface
	 */
	public function joinSProducts($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
	public function useSProductsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinSProducts($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'SProducts', 'SProductsQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     SBrands $sBrands Object to remove from the list of results
	 *
	 * @return    SBrandsQuery The current query, for fluid interface
	 */
	public function prune($sBrands = null)
	{
		if ($sBrands) {
			$this->addUsingAlias(SBrandsPeer::ID, $sBrands->getId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseSBrandsQuery
