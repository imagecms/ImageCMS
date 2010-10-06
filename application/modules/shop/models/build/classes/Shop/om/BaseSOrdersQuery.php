<?php


/**
 * Base class that represents a query for the 'shop_orders' table.
 *
 * 
 *
 * @method     SOrdersQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     SOrdersQuery orderByKey($order = Criteria::ASC) Order by the key column
 * @method     SOrdersQuery orderByDeliveryMethod($order = Criteria::ASC) Order by the delivery_method column
 * @method     SOrdersQuery orderByDeliveryPrice($order = Criteria::ASC) Order by the delivery_price column
 * @method     SOrdersQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     SOrdersQuery orderByPaid($order = Criteria::ASC) Order by the paid column
 * @method     SOrdersQuery orderByUserFullName($order = Criteria::ASC) Order by the user_full_name column
 * @method     SOrdersQuery orderByUserEmail($order = Criteria::ASC) Order by the user_email column
 * @method     SOrdersQuery orderByUserPhone($order = Criteria::ASC) Order by the user_phone column
 * @method     SOrdersQuery orderByUserDeliverTo($order = Criteria::ASC) Order by the user_deliver_to column
 * @method     SOrdersQuery orderByUserComment($order = Criteria::ASC) Order by the user_comment column
 * @method     SOrdersQuery orderByDateCreated($order = Criteria::ASC) Order by the date_created column
 * @method     SOrdersQuery orderByDateUpdated($order = Criteria::ASC) Order by the date_updated column
 * @method     SOrdersQuery orderByUserIp($order = Criteria::ASC) Order by the user_ip column
 *
 * @method     SOrdersQuery groupById() Group by the id column
 * @method     SOrdersQuery groupByKey() Group by the key column
 * @method     SOrdersQuery groupByDeliveryMethod() Group by the delivery_method column
 * @method     SOrdersQuery groupByDeliveryPrice() Group by the delivery_price column
 * @method     SOrdersQuery groupByStatus() Group by the status column
 * @method     SOrdersQuery groupByPaid() Group by the paid column
 * @method     SOrdersQuery groupByUserFullName() Group by the user_full_name column
 * @method     SOrdersQuery groupByUserEmail() Group by the user_email column
 * @method     SOrdersQuery groupByUserPhone() Group by the user_phone column
 * @method     SOrdersQuery groupByUserDeliverTo() Group by the user_deliver_to column
 * @method     SOrdersQuery groupByUserComment() Group by the user_comment column
 * @method     SOrdersQuery groupByDateCreated() Group by the date_created column
 * @method     SOrdersQuery groupByDateUpdated() Group by the date_updated column
 * @method     SOrdersQuery groupByUserIp() Group by the user_ip column
 *
 * @method     SOrdersQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     SOrdersQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     SOrdersQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     SOrdersQuery leftJoinSDeliveryMethods($relationAlias = null) Adds a LEFT JOIN clause to the query using the SDeliveryMethods relation
 * @method     SOrdersQuery rightJoinSDeliveryMethods($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SDeliveryMethods relation
 * @method     SOrdersQuery innerJoinSDeliveryMethods($relationAlias = null) Adds a INNER JOIN clause to the query using the SDeliveryMethods relation
 *
 * @method     SOrdersQuery leftJoinSOrderProducts($relationAlias = null) Adds a LEFT JOIN clause to the query using the SOrderProducts relation
 * @method     SOrdersQuery rightJoinSOrderProducts($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SOrderProducts relation
 * @method     SOrdersQuery innerJoinSOrderProducts($relationAlias = null) Adds a INNER JOIN clause to the query using the SOrderProducts relation
 *
 * @method     SOrders findOne(PropelPDO $con = null) Return the first SOrders matching the query
 * @method     SOrders findOneOrCreate(PropelPDO $con = null) Return the first SOrders matching the query, or a new SOrders object populated from the query conditions when no match is found
 *
 * @method     SOrders findOneById(int $id) Return the first SOrders filtered by the id column
 * @method     SOrders findOneByKey(string $key) Return the first SOrders filtered by the key column
 * @method     SOrders findOneByDeliveryMethod(int $delivery_method) Return the first SOrders filtered by the delivery_method column
 * @method     SOrders findOneByDeliveryPrice(string $delivery_price) Return the first SOrders filtered by the delivery_price column
 * @method     SOrders findOneByStatus(int $status) Return the first SOrders filtered by the status column
 * @method     SOrders findOneByPaid(boolean $paid) Return the first SOrders filtered by the paid column
 * @method     SOrders findOneByUserFullName(string $user_full_name) Return the first SOrders filtered by the user_full_name column
 * @method     SOrders findOneByUserEmail(string $user_email) Return the first SOrders filtered by the user_email column
 * @method     SOrders findOneByUserPhone(string $user_phone) Return the first SOrders filtered by the user_phone column
 * @method     SOrders findOneByUserDeliverTo(string $user_deliver_to) Return the first SOrders filtered by the user_deliver_to column
 * @method     SOrders findOneByUserComment(string $user_comment) Return the first SOrders filtered by the user_comment column
 * @method     SOrders findOneByDateCreated(int $date_created) Return the first SOrders filtered by the date_created column
 * @method     SOrders findOneByDateUpdated(int $date_updated) Return the first SOrders filtered by the date_updated column
 * @method     SOrders findOneByUserIp(string $user_ip) Return the first SOrders filtered by the user_ip column
 *
 * @method     array findById(int $id) Return SOrders objects filtered by the id column
 * @method     array findByKey(string $key) Return SOrders objects filtered by the key column
 * @method     array findByDeliveryMethod(int $delivery_method) Return SOrders objects filtered by the delivery_method column
 * @method     array findByDeliveryPrice(string $delivery_price) Return SOrders objects filtered by the delivery_price column
 * @method     array findByStatus(int $status) Return SOrders objects filtered by the status column
 * @method     array findByPaid(boolean $paid) Return SOrders objects filtered by the paid column
 * @method     array findByUserFullName(string $user_full_name) Return SOrders objects filtered by the user_full_name column
 * @method     array findByUserEmail(string $user_email) Return SOrders objects filtered by the user_email column
 * @method     array findByUserPhone(string $user_phone) Return SOrders objects filtered by the user_phone column
 * @method     array findByUserDeliverTo(string $user_deliver_to) Return SOrders objects filtered by the user_deliver_to column
 * @method     array findByUserComment(string $user_comment) Return SOrders objects filtered by the user_comment column
 * @method     array findByDateCreated(int $date_created) Return SOrders objects filtered by the date_created column
 * @method     array findByDateUpdated(int $date_updated) Return SOrders objects filtered by the date_updated column
 * @method     array findByUserIp(string $user_ip) Return SOrders objects filtered by the user_ip column
 *
 * @package    propel.generator.Shop.om
 */
abstract class BaseSOrdersQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseSOrdersQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'Shop', $modelName = 'SOrders', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new SOrdersQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    SOrdersQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof SOrdersQuery) {
			return $criteria;
		}
		$query = new SOrdersQuery();
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
	 * @return    SOrders|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = SOrdersPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    SOrdersQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(SOrdersPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    SOrdersQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(SOrdersPeer::ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the id column
	 * 
	 * @param     int|array $id The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SOrdersQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(SOrdersPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the key column
	 * 
	 * @param     string $key The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SOrdersQuery The current query, for fluid interface
	 */
	public function filterByKey($key = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($key)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $key)) {
				$key = str_replace('*', '%', $key);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(SOrdersPeer::KEY, $key, $comparison);
	}

	/**
	 * Filter the query on the delivery_method column
	 * 
	 * @param     int|array $deliveryMethod The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SOrdersQuery The current query, for fluid interface
	 */
	public function filterByDeliveryMethod($deliveryMethod = null, $comparison = null)
	{
		if (is_array($deliveryMethod)) {
			$useMinMax = false;
			if (isset($deliveryMethod['min'])) {
				$this->addUsingAlias(SOrdersPeer::DELIVERY_METHOD, $deliveryMethod['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($deliveryMethod['max'])) {
				$this->addUsingAlias(SOrdersPeer::DELIVERY_METHOD, $deliveryMethod['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(SOrdersPeer::DELIVERY_METHOD, $deliveryMethod, $comparison);
	}

	/**
	 * Filter the query on the delivery_price column
	 * 
	 * @param     string|array $deliveryPrice The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SOrdersQuery The current query, for fluid interface
	 */
	public function filterByDeliveryPrice($deliveryPrice = null, $comparison = null)
	{
		if (is_array($deliveryPrice)) {
			$useMinMax = false;
			if (isset($deliveryPrice['min'])) {
				$this->addUsingAlias(SOrdersPeer::DELIVERY_PRICE, $deliveryPrice['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($deliveryPrice['max'])) {
				$this->addUsingAlias(SOrdersPeer::DELIVERY_PRICE, $deliveryPrice['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(SOrdersPeer::DELIVERY_PRICE, $deliveryPrice, $comparison);
	}

	/**
	 * Filter the query on the status column
	 * 
	 * @param     int|array $status The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SOrdersQuery The current query, for fluid interface
	 */
	public function filterByStatus($status = null, $comparison = null)
	{
		if (is_array($status)) {
			$useMinMax = false;
			if (isset($status['min'])) {
				$this->addUsingAlias(SOrdersPeer::STATUS, $status['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($status['max'])) {
				$this->addUsingAlias(SOrdersPeer::STATUS, $status['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(SOrdersPeer::STATUS, $status, $comparison);
	}

	/**
	 * Filter the query on the paid column
	 * 
	 * @param     boolean|string $paid The value to use as filter.
	 *            Accepts strings ('false', 'off', '-', 'no', 'n', and '0' are false, the rest is true)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SOrdersQuery The current query, for fluid interface
	 */
	public function filterByPaid($paid = null, $comparison = null)
	{
		if (is_string($paid)) {
			$paid = in_array(strtolower($paid), array('false', 'off', '-', 'no', 'n', '0')) ? false : true;
		}
		return $this->addUsingAlias(SOrdersPeer::PAID, $paid, $comparison);
	}

	/**
	 * Filter the query on the user_full_name column
	 * 
	 * @param     string $userFullName The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SOrdersQuery The current query, for fluid interface
	 */
	public function filterByUserFullName($userFullName = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($userFullName)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $userFullName)) {
				$userFullName = str_replace('*', '%', $userFullName);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(SOrdersPeer::USER_FULL_NAME, $userFullName, $comparison);
	}

	/**
	 * Filter the query on the user_email column
	 * 
	 * @param     string $userEmail The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SOrdersQuery The current query, for fluid interface
	 */
	public function filterByUserEmail($userEmail = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($userEmail)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $userEmail)) {
				$userEmail = str_replace('*', '%', $userEmail);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(SOrdersPeer::USER_EMAIL, $userEmail, $comparison);
	}

	/**
	 * Filter the query on the user_phone column
	 * 
	 * @param     string $userPhone The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SOrdersQuery The current query, for fluid interface
	 */
	public function filterByUserPhone($userPhone = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($userPhone)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $userPhone)) {
				$userPhone = str_replace('*', '%', $userPhone);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(SOrdersPeer::USER_PHONE, $userPhone, $comparison);
	}

	/**
	 * Filter the query on the user_deliver_to column
	 * 
	 * @param     string $userDeliverTo The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SOrdersQuery The current query, for fluid interface
	 */
	public function filterByUserDeliverTo($userDeliverTo = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($userDeliverTo)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $userDeliverTo)) {
				$userDeliverTo = str_replace('*', '%', $userDeliverTo);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(SOrdersPeer::USER_DELIVER_TO, $userDeliverTo, $comparison);
	}

	/**
	 * Filter the query on the user_comment column
	 * 
	 * @param     string $userComment The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SOrdersQuery The current query, for fluid interface
	 */
	public function filterByUserComment($userComment = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($userComment)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $userComment)) {
				$userComment = str_replace('*', '%', $userComment);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(SOrdersPeer::USER_COMMENT, $userComment, $comparison);
	}

	/**
	 * Filter the query on the date_created column
	 * 
	 * @param     int|array $dateCreated The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SOrdersQuery The current query, for fluid interface
	 */
	public function filterByDateCreated($dateCreated = null, $comparison = null)
	{
		if (is_array($dateCreated)) {
			$useMinMax = false;
			if (isset($dateCreated['min'])) {
				$this->addUsingAlias(SOrdersPeer::DATE_CREATED, $dateCreated['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($dateCreated['max'])) {
				$this->addUsingAlias(SOrdersPeer::DATE_CREATED, $dateCreated['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(SOrdersPeer::DATE_CREATED, $dateCreated, $comparison);
	}

	/**
	 * Filter the query on the date_updated column
	 * 
	 * @param     int|array $dateUpdated The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SOrdersQuery The current query, for fluid interface
	 */
	public function filterByDateUpdated($dateUpdated = null, $comparison = null)
	{
		if (is_array($dateUpdated)) {
			$useMinMax = false;
			if (isset($dateUpdated['min'])) {
				$this->addUsingAlias(SOrdersPeer::DATE_UPDATED, $dateUpdated['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($dateUpdated['max'])) {
				$this->addUsingAlias(SOrdersPeer::DATE_UPDATED, $dateUpdated['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(SOrdersPeer::DATE_UPDATED, $dateUpdated, $comparison);
	}

	/**
	 * Filter the query on the user_ip column
	 * 
	 * @param     string $userIp The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SOrdersQuery The current query, for fluid interface
	 */
	public function filterByUserIp($userIp = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($userIp)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $userIp)) {
				$userIp = str_replace('*', '%', $userIp);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(SOrdersPeer::USER_IP, $userIp, $comparison);
	}

	/**
	 * Filter the query by a related SDeliveryMethods object
	 *
	 * @param     SDeliveryMethods $sDeliveryMethods  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SOrdersQuery The current query, for fluid interface
	 */
	public function filterBySDeliveryMethods($sDeliveryMethods, $comparison = null)
	{
		return $this
			->addUsingAlias(SOrdersPeer::DELIVERY_METHOD, $sDeliveryMethods->getId(), $comparison);
	}

	/**
	 * Adds a JOIN clause to the query using the SDeliveryMethods relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    SOrdersQuery The current query, for fluid interface
	 */
	public function joinSDeliveryMethods($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('SDeliveryMethods');
		
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
			$this->addJoinObject($join, 'SDeliveryMethods');
		}
		
		return $this;
	}

	/**
	 * Use the SDeliveryMethods relation SDeliveryMethods object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    SDeliveryMethodsQuery A secondary query class using the current class as primary query
	 */
	public function useSDeliveryMethodsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinSDeliveryMethods($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'SDeliveryMethods', 'SDeliveryMethodsQuery');
	}

	/**
	 * Filter the query by a related SOrderProducts object
	 *
	 * @param     SOrderProducts $sOrderProducts  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SOrdersQuery The current query, for fluid interface
	 */
	public function filterBySOrderProducts($sOrderProducts, $comparison = null)
	{
		return $this
			->addUsingAlias(SOrdersPeer::ID, $sOrderProducts->getOrderId(), $comparison);
	}

	/**
	 * Adds a JOIN clause to the query using the SOrderProducts relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    SOrdersQuery The current query, for fluid interface
	 */
	public function joinSOrderProducts($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('SOrderProducts');
		
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
			$this->addJoinObject($join, 'SOrderProducts');
		}
		
		return $this;
	}

	/**
	 * Use the SOrderProducts relation SOrderProducts object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    SOrderProductsQuery A secondary query class using the current class as primary query
	 */
	public function useSOrderProductsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinSOrderProducts($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'SOrderProducts', 'SOrderProductsQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     SOrders $sOrders Object to remove from the list of results
	 *
	 * @return    SOrdersQuery The current query, for fluid interface
	 */
	public function prune($sOrders = null)
	{
		if ($sOrders) {
			$this->addUsingAlias(SOrdersPeer::ID, $sOrders->getId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseSOrdersQuery
