<?php


/**
 * Base class that represents a query for the 'shop_products' table.
 *
 * 
 *
 * @method     SProductsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     SProductsQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     SProductsQuery orderByUrl($order = Criteria::ASC) Order by the url column
 * @method     SProductsQuery orderByPrice($order = Criteria::ASC) Order by the price column
 * @method     SProductsQuery orderByStock($order = Criteria::ASC) Order by the stock column
 * @method     SProductsQuery orderByNumber($order = Criteria::ASC) Order by the number column
 * @method     SProductsQuery orderByActive($order = Criteria::ASC) Order by the active column
 * @method     SProductsQuery orderByHit($order = Criteria::ASC) Order by the hit column
 * @method     SProductsQuery orderByBrandId($order = Criteria::ASC) Order by the brand_id column
 * @method     SProductsQuery orderByCategoryId($order = Criteria::ASC) Order by the category_id column
 * @method     SProductsQuery orderByRelatedProducts($order = Criteria::ASC) Order by the related_products column
 * @method     SProductsQuery orderByMainimage($order = Criteria::ASC) Order by the mainImage column
 * @method     SProductsQuery orderBySmallimage($order = Criteria::ASC) Order by the smallImage column
 * @method     SProductsQuery orderByShortDescription($order = Criteria::ASC) Order by the short_description column
 * @method     SProductsQuery orderByFullDescription($order = Criteria::ASC) Order by the full_description column
 * @method     SProductsQuery orderByMetaTitle($order = Criteria::ASC) Order by the meta_title column
 * @method     SProductsQuery orderByMetaDescription($order = Criteria::ASC) Order by the meta_description column
 * @method     SProductsQuery orderByMetaKeywords($order = Criteria::ASC) Order by the meta_keywords column
 * @method     SProductsQuery orderByCreated($order = Criteria::ASC) Order by the created column
 * @method     SProductsQuery orderByUpdated($order = Criteria::ASC) Order by the updated column
 *
 * @method     SProductsQuery groupById() Group by the id column
 * @method     SProductsQuery groupByName() Group by the name column
 * @method     SProductsQuery groupByUrl() Group by the url column
 * @method     SProductsQuery groupByPrice() Group by the price column
 * @method     SProductsQuery groupByStock() Group by the stock column
 * @method     SProductsQuery groupByNumber() Group by the number column
 * @method     SProductsQuery groupByActive() Group by the active column
 * @method     SProductsQuery groupByHit() Group by the hit column
 * @method     SProductsQuery groupByBrandId() Group by the brand_id column
 * @method     SProductsQuery groupByCategoryId() Group by the category_id column
 * @method     SProductsQuery groupByRelatedProducts() Group by the related_products column
 * @method     SProductsQuery groupByMainimage() Group by the mainImage column
 * @method     SProductsQuery groupBySmallimage() Group by the smallImage column
 * @method     SProductsQuery groupByShortDescription() Group by the short_description column
 * @method     SProductsQuery groupByFullDescription() Group by the full_description column
 * @method     SProductsQuery groupByMetaTitle() Group by the meta_title column
 * @method     SProductsQuery groupByMetaDescription() Group by the meta_description column
 * @method     SProductsQuery groupByMetaKeywords() Group by the meta_keywords column
 * @method     SProductsQuery groupByCreated() Group by the created column
 * @method     SProductsQuery groupByUpdated() Group by the updated column
 *
 * @method     SProductsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     SProductsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     SProductsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     SProductsQuery leftJoinBrand($relationAlias = null) Adds a LEFT JOIN clause to the query using the Brand relation
 * @method     SProductsQuery rightJoinBrand($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Brand relation
 * @method     SProductsQuery innerJoinBrand($relationAlias = null) Adds a INNER JOIN clause to the query using the Brand relation
 *
 * @method     SProductsQuery leftJoinMainCategory($relationAlias = null) Adds a LEFT JOIN clause to the query using the MainCategory relation
 * @method     SProductsQuery rightJoinMainCategory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the MainCategory relation
 * @method     SProductsQuery innerJoinMainCategory($relationAlias = null) Adds a INNER JOIN clause to the query using the MainCategory relation
 *
 * @method     SProductsQuery leftJoinProductVariant($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProductVariant relation
 * @method     SProductsQuery rightJoinProductVariant($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProductVariant relation
 * @method     SProductsQuery innerJoinProductVariant($relationAlias = null) Adds a INNER JOIN clause to the query using the ProductVariant relation
 *
 * @method     SProductsQuery leftJoinShopProductCategories($relationAlias = null) Adds a LEFT JOIN clause to the query using the ShopProductCategories relation
 * @method     SProductsQuery rightJoinShopProductCategories($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ShopProductCategories relation
 * @method     SProductsQuery innerJoinShopProductCategories($relationAlias = null) Adds a INNER JOIN clause to the query using the ShopProductCategories relation
 *
 * @method     SProductsQuery leftJoinSProductPropertiesData($relationAlias = null) Adds a LEFT JOIN clause to the query using the SProductPropertiesData relation
 * @method     SProductsQuery rightJoinSProductPropertiesData($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SProductPropertiesData relation
 * @method     SProductsQuery innerJoinSProductPropertiesData($relationAlias = null) Adds a INNER JOIN clause to the query using the SProductPropertiesData relation
 *
 * @method     SProducts findOne(PropelPDO $con = null) Return the first SProducts matching the query
 * @method     SProducts findOneOrCreate(PropelPDO $con = null) Return the first SProducts matching the query, or a new SProducts object populated from the query conditions when no match is found
 *
 * @method     SProducts findOneById(int $id) Return the first SProducts filtered by the id column
 * @method     SProducts findOneByName(string $name) Return the first SProducts filtered by the name column
 * @method     SProducts findOneByUrl(string $url) Return the first SProducts filtered by the url column
 * @method     SProducts findOneByPrice(string $price) Return the first SProducts filtered by the price column
 * @method     SProducts findOneByStock(int $stock) Return the first SProducts filtered by the stock column
 * @method     SProducts findOneByNumber(string $number) Return the first SProducts filtered by the number column
 * @method     SProducts findOneByActive(boolean $active) Return the first SProducts filtered by the active column
 * @method     SProducts findOneByHit(boolean $hit) Return the first SProducts filtered by the hit column
 * @method     SProducts findOneByBrandId(int $brand_id) Return the first SProducts filtered by the brand_id column
 * @method     SProducts findOneByCategoryId(int $category_id) Return the first SProducts filtered by the category_id column
 * @method     SProducts findOneByRelatedProducts(string $related_products) Return the first SProducts filtered by the related_products column
 * @method     SProducts findOneByMainimage(boolean $mainImage) Return the first SProducts filtered by the mainImage column
 * @method     SProducts findOneBySmallimage(boolean $smallImage) Return the first SProducts filtered by the smallImage column
 * @method     SProducts findOneByShortDescription(string $short_description) Return the first SProducts filtered by the short_description column
 * @method     SProducts findOneByFullDescription(string $full_description) Return the first SProducts filtered by the full_description column
 * @method     SProducts findOneByMetaTitle(string $meta_title) Return the first SProducts filtered by the meta_title column
 * @method     SProducts findOneByMetaDescription(string $meta_description) Return the first SProducts filtered by the meta_description column
 * @method     SProducts findOneByMetaKeywords(string $meta_keywords) Return the first SProducts filtered by the meta_keywords column
 * @method     SProducts findOneByCreated(int $created) Return the first SProducts filtered by the created column
 * @method     SProducts findOneByUpdated(int $updated) Return the first SProducts filtered by the updated column
 *
 * @method     array findById(int $id) Return SProducts objects filtered by the id column
 * @method     array findByName(string $name) Return SProducts objects filtered by the name column
 * @method     array findByUrl(string $url) Return SProducts objects filtered by the url column
 * @method     array findByPrice(string $price) Return SProducts objects filtered by the price column
 * @method     array findByStock(int $stock) Return SProducts objects filtered by the stock column
 * @method     array findByNumber(string $number) Return SProducts objects filtered by the number column
 * @method     array findByActive(boolean $active) Return SProducts objects filtered by the active column
 * @method     array findByHit(boolean $hit) Return SProducts objects filtered by the hit column
 * @method     array findByBrandId(int $brand_id) Return SProducts objects filtered by the brand_id column
 * @method     array findByCategoryId(int $category_id) Return SProducts objects filtered by the category_id column
 * @method     array findByRelatedProducts(string $related_products) Return SProducts objects filtered by the related_products column
 * @method     array findByMainimage(boolean $mainImage) Return SProducts objects filtered by the mainImage column
 * @method     array findBySmallimage(boolean $smallImage) Return SProducts objects filtered by the smallImage column
 * @method     array findByShortDescription(string $short_description) Return SProducts objects filtered by the short_description column
 * @method     array findByFullDescription(string $full_description) Return SProducts objects filtered by the full_description column
 * @method     array findByMetaTitle(string $meta_title) Return SProducts objects filtered by the meta_title column
 * @method     array findByMetaDescription(string $meta_description) Return SProducts objects filtered by the meta_description column
 * @method     array findByMetaKeywords(string $meta_keywords) Return SProducts objects filtered by the meta_keywords column
 * @method     array findByCreated(int $created) Return SProducts objects filtered by the created column
 * @method     array findByUpdated(int $updated) Return SProducts objects filtered by the updated column
 *
 * @package    propel.generator.Shop.om
 */
abstract class BaseSProductsQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseSProductsQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'Shop', $modelName = 'SProducts', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new SProductsQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    SProductsQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof SProductsQuery) {
			return $criteria;
		}
		$query = new SProductsQuery();
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
	 * @return    SProducts|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = SProductsPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    SProductsQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(SProductsPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    SProductsQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(SProductsPeer::ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the id column
	 * 
	 * @param     int|array $id The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SProductsQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(SProductsPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the name column
	 * 
	 * @param     string $name The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SProductsQuery The current query, for fluid interface
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
		return $this->addUsingAlias(SProductsPeer::NAME, $name, $comparison);
	}

	/**
	 * Filter the query on the url column
	 * 
	 * @param     string $url The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SProductsQuery The current query, for fluid interface
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
		return $this->addUsingAlias(SProductsPeer::URL, $url, $comparison);
	}

	/**
	 * Filter the query on the price column
	 * 
	 * @param     string|array $price The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SProductsQuery The current query, for fluid interface
	 */
	public function filterByPrice($price = null, $comparison = null)
	{
		if (is_array($price)) {
			$useMinMax = false;
			if (isset($price['min'])) {
				$this->addUsingAlias(SProductsPeer::PRICE, $price['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($price['max'])) {
				$this->addUsingAlias(SProductsPeer::PRICE, $price['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(SProductsPeer::PRICE, $price, $comparison);
	}

	/**
	 * Filter the query on the stock column
	 * 
	 * @param     int|array $stock The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SProductsQuery The current query, for fluid interface
	 */
	public function filterByStock($stock = null, $comparison = null)
	{
		if (is_array($stock)) {
			$useMinMax = false;
			if (isset($stock['min'])) {
				$this->addUsingAlias(SProductsPeer::STOCK, $stock['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($stock['max'])) {
				$this->addUsingAlias(SProductsPeer::STOCK, $stock['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(SProductsPeer::STOCK, $stock, $comparison);
	}

	/**
	 * Filter the query on the number column
	 * 
	 * @param     string $number The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SProductsQuery The current query, for fluid interface
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
		return $this->addUsingAlias(SProductsPeer::NUMBER, $number, $comparison);
	}

	/**
	 * Filter the query on the active column
	 * 
	 * @param     boolean|string $active The value to use as filter.
	 *            Accepts strings ('false', 'off', '-', 'no', 'n', and '0' are false, the rest is true)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SProductsQuery The current query, for fluid interface
	 */
	public function filterByActive($active = null, $comparison = null)
	{
		if (is_string($active)) {
			$active = in_array(strtolower($active), array('false', 'off', '-', 'no', 'n', '0')) ? false : true;
		}
		return $this->addUsingAlias(SProductsPeer::ACTIVE, $active, $comparison);
	}

	/**
	 * Filter the query on the hit column
	 * 
	 * @param     boolean|string $hit The value to use as filter.
	 *            Accepts strings ('false', 'off', '-', 'no', 'n', and '0' are false, the rest is true)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SProductsQuery The current query, for fluid interface
	 */
	public function filterByHit($hit = null, $comparison = null)
	{
		if (is_string($hit)) {
			$hit = in_array(strtolower($hit), array('false', 'off', '-', 'no', 'n', '0')) ? false : true;
		}
		return $this->addUsingAlias(SProductsPeer::HIT, $hit, $comparison);
	}

	/**
	 * Filter the query on the brand_id column
	 * 
	 * @param     int|array $brandId The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SProductsQuery The current query, for fluid interface
	 */
	public function filterByBrandId($brandId = null, $comparison = null)
	{
		if (is_array($brandId)) {
			$useMinMax = false;
			if (isset($brandId['min'])) {
				$this->addUsingAlias(SProductsPeer::BRAND_ID, $brandId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($brandId['max'])) {
				$this->addUsingAlias(SProductsPeer::BRAND_ID, $brandId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(SProductsPeer::BRAND_ID, $brandId, $comparison);
	}

	/**
	 * Filter the query on the category_id column
	 * 
	 * @param     int|array $categoryId The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SProductsQuery The current query, for fluid interface
	 */
	public function filterByCategoryId($categoryId = null, $comparison = null)
	{
		if (is_array($categoryId)) {
			$useMinMax = false;
			if (isset($categoryId['min'])) {
				$this->addUsingAlias(SProductsPeer::CATEGORY_ID, $categoryId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($categoryId['max'])) {
				$this->addUsingAlias(SProductsPeer::CATEGORY_ID, $categoryId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(SProductsPeer::CATEGORY_ID, $categoryId, $comparison);
	}

	/**
	 * Filter the query on the related_products column
	 * 
	 * @param     string $relatedProducts The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SProductsQuery The current query, for fluid interface
	 */
	public function filterByRelatedProducts($relatedProducts = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($relatedProducts)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $relatedProducts)) {
				$relatedProducts = str_replace('*', '%', $relatedProducts);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(SProductsPeer::RELATED_PRODUCTS, $relatedProducts, $comparison);
	}

	/**
	 * Filter the query on the mainImage column
	 * 
	 * @param     boolean|string $mainimage The value to use as filter.
	 *            Accepts strings ('false', 'off', '-', 'no', 'n', and '0' are false, the rest is true)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SProductsQuery The current query, for fluid interface
	 */
	public function filterByMainimage($mainimage = null, $comparison = null)
	{
		if (is_string($mainimage)) {
			$mainImage = in_array(strtolower($mainimage), array('false', 'off', '-', 'no', 'n', '0')) ? false : true;
		}
		return $this->addUsingAlias(SProductsPeer::MAINIMAGE, $mainimage, $comparison);
	}

	/**
	 * Filter the query on the smallImage column
	 * 
	 * @param     boolean|string $smallimage The value to use as filter.
	 *            Accepts strings ('false', 'off', '-', 'no', 'n', and '0' are false, the rest is true)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SProductsQuery The current query, for fluid interface
	 */
	public function filterBySmallimage($smallimage = null, $comparison = null)
	{
		if (is_string($smallimage)) {
			$smallImage = in_array(strtolower($smallimage), array('false', 'off', '-', 'no', 'n', '0')) ? false : true;
		}
		return $this->addUsingAlias(SProductsPeer::SMALLIMAGE, $smallimage, $comparison);
	}

	/**
	 * Filter the query on the short_description column
	 * 
	 * @param     string $shortDescription The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SProductsQuery The current query, for fluid interface
	 */
	public function filterByShortDescription($shortDescription = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($shortDescription)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $shortDescription)) {
				$shortDescription = str_replace('*', '%', $shortDescription);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(SProductsPeer::SHORT_DESCRIPTION, $shortDescription, $comparison);
	}

	/**
	 * Filter the query on the full_description column
	 * 
	 * @param     string $fullDescription The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SProductsQuery The current query, for fluid interface
	 */
	public function filterByFullDescription($fullDescription = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($fullDescription)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $fullDescription)) {
				$fullDescription = str_replace('*', '%', $fullDescription);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(SProductsPeer::FULL_DESCRIPTION, $fullDescription, $comparison);
	}

	/**
	 * Filter the query on the meta_title column
	 * 
	 * @param     string $metaTitle The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SProductsQuery The current query, for fluid interface
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
		return $this->addUsingAlias(SProductsPeer::META_TITLE, $metaTitle, $comparison);
	}

	/**
	 * Filter the query on the meta_description column
	 * 
	 * @param     string $metaDescription The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SProductsQuery The current query, for fluid interface
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
		return $this->addUsingAlias(SProductsPeer::META_DESCRIPTION, $metaDescription, $comparison);
	}

	/**
	 * Filter the query on the meta_keywords column
	 * 
	 * @param     string $metaKeywords The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SProductsQuery The current query, for fluid interface
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
		return $this->addUsingAlias(SProductsPeer::META_KEYWORDS, $metaKeywords, $comparison);
	}

	/**
	 * Filter the query on the created column
	 * 
	 * @param     int|array $created The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SProductsQuery The current query, for fluid interface
	 */
	public function filterByCreated($created = null, $comparison = null)
	{
		if (is_array($created)) {
			$useMinMax = false;
			if (isset($created['min'])) {
				$this->addUsingAlias(SProductsPeer::CREATED, $created['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($created['max'])) {
				$this->addUsingAlias(SProductsPeer::CREATED, $created['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(SProductsPeer::CREATED, $created, $comparison);
	}

	/**
	 * Filter the query on the updated column
	 * 
	 * @param     int|array $updated The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SProductsQuery The current query, for fluid interface
	 */
	public function filterByUpdated($updated = null, $comparison = null)
	{
		if (is_array($updated)) {
			$useMinMax = false;
			if (isset($updated['min'])) {
				$this->addUsingAlias(SProductsPeer::UPDATED, $updated['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($updated['max'])) {
				$this->addUsingAlias(SProductsPeer::UPDATED, $updated['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(SProductsPeer::UPDATED, $updated, $comparison);
	}

	/**
	 * Filter the query by a related SBrands object
	 *
	 * @param     SBrands $sBrands  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SProductsQuery The current query, for fluid interface
	 */
	public function filterByBrand($sBrands, $comparison = null)
	{
		return $this
			->addUsingAlias(SProductsPeer::BRAND_ID, $sBrands->getId(), $comparison);
	}

	/**
	 * Adds a JOIN clause to the query using the Brand relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    SProductsQuery The current query, for fluid interface
	 */
	public function joinBrand($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Brand');
		
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
			$this->addJoinObject($join, 'Brand');
		}
		
		return $this;
	}

	/**
	 * Use the Brand relation SBrands object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    SBrandsQuery A secondary query class using the current class as primary query
	 */
	public function useBrandQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinBrand($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Brand', 'SBrandsQuery');
	}

	/**
	 * Filter the query by a related SCategory object
	 *
	 * @param     SCategory $sCategory  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SProductsQuery The current query, for fluid interface
	 */
	public function filterByMainCategory($sCategory, $comparison = null)
	{
		return $this
			->addUsingAlias(SProductsPeer::CATEGORY_ID, $sCategory->getId(), $comparison);
	}

	/**
	 * Adds a JOIN clause to the query using the MainCategory relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    SProductsQuery The current query, for fluid interface
	 */
	public function joinMainCategory($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('MainCategory');
		
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
			$this->addJoinObject($join, 'MainCategory');
		}
		
		return $this;
	}

	/**
	 * Use the MainCategory relation SCategory object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    SCategoryQuery A secondary query class using the current class as primary query
	 */
	public function useMainCategoryQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinMainCategory($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'MainCategory', 'SCategoryQuery');
	}

	/**
	 * Filter the query by a related SProductVariants object
	 *
	 * @param     SProductVariants $sProductVariants  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SProductsQuery The current query, for fluid interface
	 */
	public function filterByProductVariant($sProductVariants, $comparison = null)
	{
		return $this
			->addUsingAlias(SProductsPeer::ID, $sProductVariants->getProductId(), $comparison);
	}

	/**
	 * Adds a JOIN clause to the query using the ProductVariant relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    SProductsQuery The current query, for fluid interface
	 */
	public function joinProductVariant($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('ProductVariant');
		
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
			$this->addJoinObject($join, 'ProductVariant');
		}
		
		return $this;
	}

	/**
	 * Use the ProductVariant relation SProductVariants object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    SProductVariantsQuery A secondary query class using the current class as primary query
	 */
	public function useProductVariantQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinProductVariant($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'ProductVariant', 'SProductVariantsQuery');
	}

	/**
	 * Filter the query by a related ShopProductCategories object
	 *
	 * @param     ShopProductCategories $shopProductCategories  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SProductsQuery The current query, for fluid interface
	 */
	public function filterByShopProductCategories($shopProductCategories, $comparison = null)
	{
		return $this
			->addUsingAlias(SProductsPeer::ID, $shopProductCategories->getProductId(), $comparison);
	}

	/**
	 * Adds a JOIN clause to the query using the ShopProductCategories relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    SProductsQuery The current query, for fluid interface
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
	 * Filter the query by a related SProductPropertiesData object
	 *
	 * @param     SProductPropertiesData $sProductPropertiesData  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SProductsQuery The current query, for fluid interface
	 */
	public function filterBySProductPropertiesData($sProductPropertiesData, $comparison = null)
	{
		return $this
			->addUsingAlias(SProductsPeer::ID, $sProductPropertiesData->getProductId(), $comparison);
	}

	/**
	 * Adds a JOIN clause to the query using the SProductPropertiesData relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    SProductsQuery The current query, for fluid interface
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
	 * using the shop_product_categories table as cross reference
	 *
	 * @param     SCategory $sCategory the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SProductsQuery The current query, for fluid interface
	 */
	public function filterByCategory($sCategory, $comparison = Criteria::EQUAL)
	{
		return $this
			->useShopProductCategoriesQuery()
				->filterByCategory($sCategory, $comparison)
			->endUse();
	}
	
	/**
	 * Exclude object from result
	 *
	 * @param     SProducts $sProducts Object to remove from the list of results
	 *
	 * @return    SProductsQuery The current query, for fluid interface
	 */
	public function prune($sProducts = null)
	{
		if ($sProducts) {
			$this->addUsingAlias(SProductsPeer::ID, $sProducts->getId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseSProductsQuery
