<?php


/**
 * Base class that represents a query for the 'shop_product_variants' table.
 *
 * 
 *
 * @method     SProductVariantsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     SProductVariantsQuery orderByProductId($order = Criteria::ASC) Order by the product_id column
 * @method     SProductVariantsQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     SProductVariantsQuery orderByPrice($order = Criteria::ASC) Order by the price column
 * @method     SProductVariantsQuery orderByNumber($order = Criteria::ASC) Order by the number column
 * @method     SProductVariantsQuery orderByStock($order = Criteria::ASC) Order by the stock column
 * @method     SProductVariantsQuery orderByPosition($order = Criteria::ASC) Order by the position column
 *
 * @method     SProductVariantsQuery groupById() Group by the id column
 * @method     SProductVariantsQuery groupByProductId() Group by the product_id column
 * @method     SProductVariantsQuery groupByName() Group by the name column
 * @method     SProductVariantsQuery groupByPrice() Group by the price column
 * @method     SProductVariantsQuery groupByNumber() Group by the number column
 * @method     SProductVariantsQuery groupByStock() Group by the stock column
 * @method     SProductVariantsQuery groupByPosition() Group by the position column
 *
 * @method     SProductVariantsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     SProductVariantsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     SProductVariantsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     SProductVariantsQuery leftJoinSProducts($relationAlias = null) Adds a LEFT JOIN clause to the query using the SProducts relation
 * @method     SProductVariantsQuery rightJoinSProducts($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SProducts relation
 * @method     SProductVariantsQuery innerJoinSProducts($relationAlias = null) Adds a INNER JOIN clause to the query using the SProducts relation
 *
 * @method     SProductVariants findOne(PropelPDO $con = null) Return the first SProductVariants matching the query
 * @method     SProductVariants findOneOrCreate(PropelPDO $con = null) Return the first SProductVariants matching the query, or a new SProductVariants object populated from the query conditions when no match is found
 *
 * @method     SProductVariants findOneById(int $id) Return the first SProductVariants filtered by the id column
 * @method     SProductVariants findOneByProductId(int $product_id) Return the first SProductVariants filtered by the product_id column
 * @method     SProductVariants findOneByName(string $name) Return the first SProductVariants filtered by the name column
 * @method     SProductVariants findOneByPrice(string $price) Return the first SProductVariants filtered by the price column
 * @method     SProductVariants findOneByNumber(string $number) Return the first SProductVariants filtered by the number column
 * @method     SProductVariants findOneByStock(int $stock) Return the first SProductVariants filtered by the stock column
 * @method     SProductVariants findOneByPosition(int $position) Return the first SProductVariants filtered by the position column
 *
 * @method     array findById(int $id) Return SProductVariants objects filtered by the id column
 * @method     array findByProductId(int $product_id) Return SProductVariants objects filtered by the product_id column
 * @method     array findByName(string $name) Return SProductVariants objects filtered by the name column
 * @method     array findByPrice(string $price) Return SProductVariants objects filtered by the price column
 * @method     array findByNumber(string $number) Return SProductVariants objects filtered by the number column
 * @method     array findByStock(int $stock) Return SProductVariants objects filtered by the stock column
 * @method     array findByPosition(int $position) Return SProductVariants objects filtered by the position column
 *
 * @package    propel.generator.Shop.om
 */
abstract class BaseSProductVariantsQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseSProductVariantsQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'Shop', $modelName = 'SProductVariants', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new SProductVariantsQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    SProductVariantsQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof SProductVariantsQuery) {
			return $criteria;
		}
		$query = new SProductVariantsQuery();
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
	 * @return    SProductVariants|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = SProductVariantsPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    SProductVariantsQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(SProductVariantsPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    SProductVariantsQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(SProductVariantsPeer::ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the id column
	 * 
	 * @param     int|array $id The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SProductVariantsQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(SProductVariantsPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the product_id column
	 * 
	 * @param     int|array $productId The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SProductVariantsQuery The current query, for fluid interface
	 */
	public function filterByProductId($productId = null, $comparison = null)
	{
		if (is_array($productId)) {
			$useMinMax = false;
			if (isset($productId['min'])) {
				$this->addUsingAlias(SProductVariantsPeer::PRODUCT_ID, $productId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($productId['max'])) {
				$this->addUsingAlias(SProductVariantsPeer::PRODUCT_ID, $productId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(SProductVariantsPeer::PRODUCT_ID, $productId, $comparison);
	}

	/**
	 * Filter the query on the name column
	 * 
	 * @param     string $name The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SProductVariantsQuery The current query, for fluid interface
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
		return $this->addUsingAlias(SProductVariantsPeer::NAME, $name, $comparison);
	}

	/**
	 * Filter the query on the price column
	 * 
	 * @param     string|array $price The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SProductVariantsQuery The current query, for fluid interface
	 */
	public function filterByPrice($price = null, $comparison = null)
	{
		if (is_array($price)) {
			$useMinMax = false;
			if (isset($price['min'])) {
				$this->addUsingAlias(SProductVariantsPeer::PRICE, $price['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($price['max'])) {
				$this->addUsingAlias(SProductVariantsPeer::PRICE, $price['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(SProductVariantsPeer::PRICE, $price, $comparison);
	}

	/**
	 * Filter the query on the number column
	 * 
	 * @param     string $number The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SProductVariantsQuery The current query, for fluid interface
	 */
	public function filterByNumber($number = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($number)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $number)) {
				$number = str_replace('*', '%', $number);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(SProductVariantsPeer::NUMBER, $number, $comparison);
	}

	/**
	 * Filter the query on the stock column
	 * 
	 * @param     int|array $stock The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SProductVariantsQuery The current query, for fluid interface
	 */
	public function filterByStock($stock = null, $comparison = null)
	{
		if (is_array($stock)) {
			$useMinMax = false;
			if (isset($stock['min'])) {
				$this->addUsingAlias(SProductVariantsPeer::STOCK, $stock['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($stock['max'])) {
				$this->addUsingAlias(SProductVariantsPeer::STOCK, $stock['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(SProductVariantsPeer::STOCK, $stock, $comparison);
	}

	/**
	 * Filter the query on the position column
	 * 
	 * @param     int|array $position The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SProductVariantsQuery The current query, for fluid interface
	 */
	public function filterByPosition($position = null, $comparison = null)
	{
		if (is_array($position)) {
			$useMinMax = false;
			if (isset($position['min'])) {
				$this->addUsingAlias(SProductVariantsPeer::POSITION, $position['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($position['max'])) {
				$this->addUsingAlias(SProductVariantsPeer::POSITION, $position['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(SProductVariantsPeer::POSITION, $position, $comparison);
	}

	/**
	 * Filter the query by a related SProducts object
	 *
	 * @param     SProducts $sProducts  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SProductVariantsQuery The current query, for fluid interface
	 */
	public function filterBySProducts($sProducts, $comparison = null)
	{
		return $this
			->addUsingAlias(SProductVariantsPeer::PRODUCT_ID, $sProducts->getId(), $comparison);
	}

	/**
	 * Adds a JOIN clause to the query using the SProducts relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    SProductVariantsQuery The current query, for fluid interface
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
	 * Exclude object from result
	 *
	 * @param     SProductVariants $sProductVariants Object to remove from the list of results
	 *
	 * @return    SProductVariantsQuery The current query, for fluid interface
	 */
	public function prune($sProductVariants = null)
	{
		if ($sProductVariants) {
			$this->addUsingAlias(SProductVariantsPeer::ID, $sProductVariants->getId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseSProductVariantsQuery
