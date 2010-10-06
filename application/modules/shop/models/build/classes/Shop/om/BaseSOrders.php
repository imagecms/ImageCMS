<?php


/**
 * Base class that represents a row from the 'shop_orders' table.
 *
 * 
 *
 * @package    propel.generator.Shop.om
 */
abstract class BaseSOrders extends ShopBaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
  const PEER = 'SOrdersPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        SOrdersPeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the key field.
	 * @var        string
	 */
	protected $key;

	/**
	 * The value for the delivery_method field.
	 * @var        int
	 */
	protected $delivery_method;

	/**
	 * The value for the delivery_price field.
	 * @var        string
	 */
	protected $delivery_price;

	/**
	 * The value for the status field.
	 * @var        int
	 */
	protected $status;

	/**
	 * The value for the paid field.
	 * @var        boolean
	 */
	protected $paid;

	/**
	 * The value for the user_full_name field.
	 * @var        string
	 */
	protected $user_full_name;

	/**
	 * The value for the user_email field.
	 * @var        string
	 */
	protected $user_email;

	/**
	 * The value for the user_phone field.
	 * @var        string
	 */
	protected $user_phone;

	/**
	 * The value for the user_deliver_to field.
	 * @var        string
	 */
	protected $user_deliver_to;

	/**
	 * The value for the user_comment field.
	 * @var        string
	 */
	protected $user_comment;

	/**
	 * The value for the date_created field.
	 * @var        int
	 */
	protected $date_created;

	/**
	 * The value for the date_updated field.
	 * @var        int
	 */
	protected $date_updated;

	/**
	 * The value for the user_ip field.
	 * @var        string
	 */
	protected $user_ip;

	/**
	 * @var        SDeliveryMethods
	 */
	protected $aSDeliveryMethods;

	/**
	 * @var        array SOrderProducts[] Collection to store aggregation of SOrderProducts objects.
	 */
	protected $collSOrderProductss;

	/**
	 * Flag to prevent endless save loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInSave = false;

	/**
	 * Flag to prevent endless validation loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInValidation = false;

	/**
	 * Get the [id] column value.
	 * 
	 * @return     int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Get the [key] column value.
	 * 
	 * @return     string
	 */
	public function getKey()
	{
		return $this->key;
	}

	/**
	 * Get the [delivery_method] column value.
	 * 
	 * @return     int
	 */
	public function getDeliveryMethod()
	{
		return $this->delivery_method;
	}

	/**
	 * Get the [delivery_price] column value.
	 * 
	 * @return     string
	 */
	public function getDeliveryPrice()
	{
		return $this->delivery_price;
	}

	/**
	 * Get the [status] column value.
	 * 
	 * @return     int
	 */
	public function getStatus()
	{
		return $this->status;
	}

	/**
	 * Get the [paid] column value.
	 * 
	 * @return     boolean
	 */
	public function getPaid()
	{
		return $this->paid;
	}

	/**
	 * Get the [user_full_name] column value.
	 * 
	 * @return     string
	 */
	public function getUserFullName()
	{
		return $this->user_full_name;
	}

	/**
	 * Get the [user_email] column value.
	 * 
	 * @return     string
	 */
	public function getUserEmail()
	{
		return $this->user_email;
	}

	/**
	 * Get the [user_phone] column value.
	 * 
	 * @return     string
	 */
	public function getUserPhone()
	{
		return $this->user_phone;
	}

	/**
	 * Get the [user_deliver_to] column value.
	 * 
	 * @return     string
	 */
	public function getUserDeliverTo()
	{
		return $this->user_deliver_to;
	}

	/**
	 * Get the [user_comment] column value.
	 * 
	 * @return     string
	 */
	public function getUserComment()
	{
		return $this->user_comment;
	}

	/**
	 * Get the [date_created] column value.
	 * 
	 * @return     int
	 */
	public function getDateCreated()
	{
		return $this->date_created;
	}

	/**
	 * Get the [date_updated] column value.
	 * 
	 * @return     int
	 */
	public function getDateUpdated()
	{
		return $this->date_updated;
	}

	/**
	 * Get the [user_ip] column value.
	 * 
	 * @return     string
	 */
	public function getUserIp()
	{
		return $this->user_ip;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     SOrders The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = SOrdersPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [key] column.
	 * 
	 * @param      string $v new value
	 * @return     SOrders The current object (for fluent API support)
	 */
	public function setKey($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->key !== $v) {
			$this->key = $v;
			$this->modifiedColumns[] = SOrdersPeer::KEY;
		}

		return $this;
	} // setKey()

	/**
	 * Set the value of [delivery_method] column.
	 * 
	 * @param      int $v new value
	 * @return     SOrders The current object (for fluent API support)
	 */
	public function setDeliveryMethod($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->delivery_method !== $v) {
			$this->delivery_method = $v;
			$this->modifiedColumns[] = SOrdersPeer::DELIVERY_METHOD;
		}

		if ($this->aSDeliveryMethods !== null && $this->aSDeliveryMethods->getId() !== $v) {
			$this->aSDeliveryMethods = null;
		}

		return $this;
	} // setDeliveryMethod()

	/**
	 * Set the value of [delivery_price] column.
	 * 
	 * @param      string $v new value
	 * @return     SOrders The current object (for fluent API support)
	 */
	public function setDeliveryPrice($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->delivery_price !== $v) {
			$this->delivery_price = $v;
			$this->modifiedColumns[] = SOrdersPeer::DELIVERY_PRICE;
		}

		return $this;
	} // setDeliveryPrice()

	/**
	 * Set the value of [status] column.
	 * 
	 * @param      int $v new value
	 * @return     SOrders The current object (for fluent API support)
	 */
	public function setStatus($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->status !== $v) {
			$this->status = $v;
			$this->modifiedColumns[] = SOrdersPeer::STATUS;
		}

		return $this;
	} // setStatus()

	/**
	 * Set the value of [paid] column.
	 * 
	 * @param      boolean $v new value
	 * @return     SOrders The current object (for fluent API support)
	 */
	public function setPaid($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->paid !== $v) {
			$this->paid = $v;
			$this->modifiedColumns[] = SOrdersPeer::PAID;
		}

		return $this;
	} // setPaid()

	/**
	 * Set the value of [user_full_name] column.
	 * 
	 * @param      string $v new value
	 * @return     SOrders The current object (for fluent API support)
	 */
	public function setUserFullName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->user_full_name !== $v) {
			$this->user_full_name = $v;
			$this->modifiedColumns[] = SOrdersPeer::USER_FULL_NAME;
		}

		return $this;
	} // setUserFullName()

	/**
	 * Set the value of [user_email] column.
	 * 
	 * @param      string $v new value
	 * @return     SOrders The current object (for fluent API support)
	 */
	public function setUserEmail($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->user_email !== $v) {
			$this->user_email = $v;
			$this->modifiedColumns[] = SOrdersPeer::USER_EMAIL;
		}

		return $this;
	} // setUserEmail()

	/**
	 * Set the value of [user_phone] column.
	 * 
	 * @param      string $v new value
	 * @return     SOrders The current object (for fluent API support)
	 */
	public function setUserPhone($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->user_phone !== $v) {
			$this->user_phone = $v;
			$this->modifiedColumns[] = SOrdersPeer::USER_PHONE;
		}

		return $this;
	} // setUserPhone()

	/**
	 * Set the value of [user_deliver_to] column.
	 * 
	 * @param      string $v new value
	 * @return     SOrders The current object (for fluent API support)
	 */
	public function setUserDeliverTo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->user_deliver_to !== $v) {
			$this->user_deliver_to = $v;
			$this->modifiedColumns[] = SOrdersPeer::USER_DELIVER_TO;
		}

		return $this;
	} // setUserDeliverTo()

	/**
	 * Set the value of [user_comment] column.
	 * 
	 * @param      string $v new value
	 * @return     SOrders The current object (for fluent API support)
	 */
	public function setUserComment($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->user_comment !== $v) {
			$this->user_comment = $v;
			$this->modifiedColumns[] = SOrdersPeer::USER_COMMENT;
		}

		return $this;
	} // setUserComment()

	/**
	 * Set the value of [date_created] column.
	 * 
	 * @param      int $v new value
	 * @return     SOrders The current object (for fluent API support)
	 */
	public function setDateCreated($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->date_created !== $v) {
			$this->date_created = $v;
			$this->modifiedColumns[] = SOrdersPeer::DATE_CREATED;
		}

		return $this;
	} // setDateCreated()

	/**
	 * Set the value of [date_updated] column.
	 * 
	 * @param      int $v new value
	 * @return     SOrders The current object (for fluent API support)
	 */
	public function setDateUpdated($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->date_updated !== $v) {
			$this->date_updated = $v;
			$this->modifiedColumns[] = SOrdersPeer::DATE_UPDATED;
		}

		return $this;
	} // setDateUpdated()

	/**
	 * Set the value of [user_ip] column.
	 * 
	 * @param      string $v new value
	 * @return     SOrders The current object (for fluent API support)
	 */
	public function setUserIp($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->user_ip !== $v) {
			$this->user_ip = $v;
			$this->modifiedColumns[] = SOrdersPeer::USER_IP;
		}

		return $this;
	} // setUserIp()

	/**
	 * Indicates whether the columns in this object are only set to default values.
	 *
	 * This method can be used in conjunction with isModified() to indicate whether an object is both
	 * modified _and_ has some values set which are non-default.
	 *
	 * @return     boolean Whether the columns in this object are only been set with default values.
	 */
	public function hasOnlyDefaultValues()
	{
		// otherwise, everything was equal, so return TRUE
		return true;
	} // hasOnlyDefaultValues()

	/**
	 * Hydrates (populates) the object variables with values from the database resultset.
	 *
	 * An offset (0-based "start column") is specified so that objects can be hydrated
	 * with a subset of the columns in the resultset rows.  This is needed, for example,
	 * for results of JOIN queries where the resultset row includes columns from two or
	 * more tables.
	 *
	 * @param      array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
	 * @param      int $startcol 0-based offset column which indicates which restultset column to start with.
	 * @param      boolean $rehydrate Whether this object is being re-hydrated from the database.
	 * @return     int next starting column
	 * @throws     PropelException  - Any caught Exception will be rewrapped as a PropelException.
	 */
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->key = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->delivery_method = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->delivery_price = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->status = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
			$this->paid = ($row[$startcol + 5] !== null) ? (boolean) $row[$startcol + 5] : null;
			$this->user_full_name = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->user_email = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->user_phone = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->user_deliver_to = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->user_comment = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->date_created = ($row[$startcol + 11] !== null) ? (int) $row[$startcol + 11] : null;
			$this->date_updated = ($row[$startcol + 12] !== null) ? (int) $row[$startcol + 12] : null;
			$this->user_ip = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 14; // 14 = SOrdersPeer::NUM_COLUMNS - SOrdersPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating SOrders object", $e);
		}
	}

	/**
	 * Checks and repairs the internal consistency of the object.
	 *
	 * This method is executed after an already-instantiated object is re-hydrated
	 * from the database.  It exists to check any foreign keys to make sure that
	 * the objects related to the current object are correct based on foreign key.
	 *
	 * You can override this method in the stub class, but you should always invoke
	 * the base method from the overridden method (i.e. parent::ensureConsistency()),
	 * in case your model changes.
	 *
	 * @throws     PropelException
	 */
	public function ensureConsistency()
	{

		if ($this->aSDeliveryMethods !== null && $this->delivery_method !== $this->aSDeliveryMethods->getId()) {
			$this->aSDeliveryMethods = null;
		}
	} // ensureConsistency

	/**
	 * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
	 *
	 * This will only work if the object has been saved and has a valid primary key set.
	 *
	 * @param      boolean $deep (optional) Whether to also de-associated any related objects.
	 * @param      PropelPDO $con (optional) The PropelPDO connection to use.
	 * @return     void
	 * @throws     PropelException - if this object is deleted, unsaved or doesn't have pk match in db
	 */
	public function reload($deep = false, PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("Cannot reload a deleted object.");
		}

		if ($this->isNew()) {
			throw new PropelException("Cannot reload an unsaved object.");
		}

		if ($con === null) {
			$con = Propel::getConnection(SOrdersPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = SOrdersPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aSDeliveryMethods = null;
			$this->collSOrderProductss = null;

		} // if (deep)
	}

	/**
	 * Removes this object from datastore and sets delete attribute.
	 *
	 * @param      PropelPDO $con
	 * @return     void
	 * @throws     PropelException
	 * @see        BaseObject::setDeleted()
	 * @see        BaseObject::isDeleted()
	 */
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(SOrdersPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			if ($ret) {
				SOrdersQuery::create()
					->filterByPrimaryKey($this->getPrimaryKey())
					->delete($con);
				$this->postDelete($con);
				$con->commit();
				$this->setDeleted(true);
			} else {
				$con->commit();
			}
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Persists this object to the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All modified related objects will also be persisted in the doSave()
	 * method.  This method wraps all precipitate database operations in a
	 * single transaction.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        doSave()
	 */
	public function save(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(SOrdersPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		$isInsert = $this->isNew();
		try {
			$ret = $this->preSave($con);
			if ($isInsert) {
				$ret = $ret && $this->preInsert($con);
			} else {
				$ret = $ret && $this->preUpdate($con);
			}
			if ($ret) {
				$affectedRows = $this->doSave($con);
				if ($isInsert) {
					$this->postInsert($con);
				} else {
					$this->postUpdate($con);
				}
				$this->postSave($con);
				SOrdersPeer::addInstanceToPool($this);
			} else {
				$affectedRows = 0;
			}
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Performs the work of inserting or updating the row in the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All related objects are also updated in this method.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        save()
	 */
	protected function doSave(PropelPDO $con)
	{
		$affectedRows = 0; // initialize var to track total num of affected rows
		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;

			// We call the save method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aSDeliveryMethods !== null) {
				if ($this->aSDeliveryMethods->isModified() || $this->aSDeliveryMethods->isNew()) {
					$affectedRows += $this->aSDeliveryMethods->save($con);
				}
				$this->setSDeliveryMethods($this->aSDeliveryMethods);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = SOrdersPeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$criteria = $this->buildCriteria();
					if ($criteria->keyContainsValue(SOrdersPeer::ID) ) {
						throw new PropelException('Cannot insert a value for auto-increment primary key ('.SOrdersPeer::ID.')');
					}

					$pk = BasePeer::doInsert($criteria, $con);
					$affectedRows += 1;
					$this->setId($pk);  //[IMV] update autoincrement primary key
					$this->setNew(false);
				} else {
					$affectedRows += SOrdersPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collSOrderProductss !== null) {
				foreach ($this->collSOrderProductss as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			$this->alreadyInSave = false;

		}
		return $affectedRows;
	} // doSave()

	/**
	 * Array of ValidationFailed objects.
	 * @var        array ValidationFailed[]
	 */
	protected $validationFailures = array();

	/**
	 * Gets any ValidationFailed objects that resulted from last call to validate().
	 *
	 *
	 * @return     array ValidationFailed[]
	 * @see        validate()
	 */
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	/**
	 * Validates the objects modified field values and all objects related to this table.
	 *
	 * If $columns is either a column name or an array of column names
	 * only those columns are validated.
	 *
	 * @param      mixed $columns Column name or an array of column names.
	 * @return     boolean Whether all columns pass validation.
	 * @see        doValidate()
	 * @see        getValidationFailures()
	 */
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	/**
	 * This function performs the validation work for complex object models.
	 *
	 * In addition to checking the current object, all related objects will
	 * also be validated.  If all pass then <code>true</code> is returned; otherwise
	 * an aggreagated array of ValidationFailed objects will be returned.
	 *
	 * @param      array $columns Array of column names to validate.
	 * @return     mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
	 */
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


			// We call the validate method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aSDeliveryMethods !== null) {
				if (!$this->aSDeliveryMethods->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aSDeliveryMethods->getValidationFailures());
				}
			}


			if (($retval = SOrdersPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collSOrderProductss !== null) {
					foreach ($this->collSOrderProductss as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	/**
	 * Retrieves a field from the object by name passed in as a string.
	 *
	 * @param      string $name name
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     mixed Value of field.
	 */
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SOrdersPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	/**
	 * Retrieves a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @return     mixed Value of field at $pos
	 */
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getKey();
				break;
			case 2:
				return $this->getDeliveryMethod();
				break;
			case 3:
				return $this->getDeliveryPrice();
				break;
			case 4:
				return $this->getStatus();
				break;
			case 5:
				return $this->getPaid();
				break;
			case 6:
				return $this->getUserFullName();
				break;
			case 7:
				return $this->getUserEmail();
				break;
			case 8:
				return $this->getUserPhone();
				break;
			case 9:
				return $this->getUserDeliverTo();
				break;
			case 10:
				return $this->getUserComment();
				break;
			case 11:
				return $this->getDateCreated();
				break;
			case 12:
				return $this->getDateUpdated();
				break;
			case 13:
				return $this->getUserIp();
				break;
			default:
				return null;
				break;
		} // switch()
	}

	/**
	 * Exports the object as an array.
	 *
	 * You can specify the key type of the array by passing one of the class
	 * type constants.
	 *
	 * @param     string  $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
	 *                    BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. 
	 *                    Defaults to BasePeer::TYPE_PHPNAME.
	 * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
	 * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
	 *
	 * @return    array an associative array containing the field names (as keys) and field values
	 */
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true, $includeForeignObjects = false)
	{
		$keys = SOrdersPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getKey(),
			$keys[2] => $this->getDeliveryMethod(),
			$keys[3] => $this->getDeliveryPrice(),
			$keys[4] => $this->getStatus(),
			$keys[5] => $this->getPaid(),
			$keys[6] => $this->getUserFullName(),
			$keys[7] => $this->getUserEmail(),
			$keys[8] => $this->getUserPhone(),
			$keys[9] => $this->getUserDeliverTo(),
			$keys[10] => $this->getUserComment(),
			$keys[11] => $this->getDateCreated(),
			$keys[12] => $this->getDateUpdated(),
			$keys[13] => $this->getUserIp(),
		);
		if ($includeForeignObjects) {
			if (null !== $this->aSDeliveryMethods) {
				$result['SDeliveryMethods'] = $this->aSDeliveryMethods->toArray($keyType, $includeLazyLoadColumns, true);
			}
		}
		return $result;
	}

	/**
	 * Sets a field from the object by name passed in as a string.
	 *
	 * @param      string $name peer name
	 * @param      mixed $value field value
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     void
	 */
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SOrdersPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	/**
	 * Sets a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @param      mixed $value field value
	 * @return     void
	 */
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setKey($value);
				break;
			case 2:
				$this->setDeliveryMethod($value);
				break;
			case 3:
				$this->setDeliveryPrice($value);
				break;
			case 4:
				$this->setStatus($value);
				break;
			case 5:
				$this->setPaid($value);
				break;
			case 6:
				$this->setUserFullName($value);
				break;
			case 7:
				$this->setUserEmail($value);
				break;
			case 8:
				$this->setUserPhone($value);
				break;
			case 9:
				$this->setUserDeliverTo($value);
				break;
			case 10:
				$this->setUserComment($value);
				break;
			case 11:
				$this->setDateCreated($value);
				break;
			case 12:
				$this->setDateUpdated($value);
				break;
			case 13:
				$this->setUserIp($value);
				break;
		} // switch()
	}

	/**
	 * Populates the object using an array.
	 *
	 * This is particularly useful when populating an object from one of the
	 * request arrays (e.g. $_POST).  This method goes through the column
	 * names, checking to see whether a matching key exists in populated
	 * array. If so the setByName() method is called for that column.
	 *
	 * You can specify the key type of the array by additionally passing one
	 * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
	 * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
	 * The default key type is the column's phpname (e.g. 'AuthorId')
	 *
	 * @param      array  $arr     An array to populate the object from.
	 * @param      string $keyType The type of keys the array uses.
	 * @return     void
	 */
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SOrdersPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setKey($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setDeliveryMethod($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setDeliveryPrice($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setStatus($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setPaid($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setUserFullName($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setUserEmail($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setUserPhone($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setUserDeliverTo($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setUserComment($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setDateCreated($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setDateUpdated($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setUserIp($arr[$keys[13]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(SOrdersPeer::DATABASE_NAME);

		if ($this->isColumnModified(SOrdersPeer::ID)) $criteria->add(SOrdersPeer::ID, $this->id);
		if ($this->isColumnModified(SOrdersPeer::KEY)) $criteria->add(SOrdersPeer::KEY, $this->key);
		if ($this->isColumnModified(SOrdersPeer::DELIVERY_METHOD)) $criteria->add(SOrdersPeer::DELIVERY_METHOD, $this->delivery_method);
		if ($this->isColumnModified(SOrdersPeer::DELIVERY_PRICE)) $criteria->add(SOrdersPeer::DELIVERY_PRICE, $this->delivery_price);
		if ($this->isColumnModified(SOrdersPeer::STATUS)) $criteria->add(SOrdersPeer::STATUS, $this->status);
		if ($this->isColumnModified(SOrdersPeer::PAID)) $criteria->add(SOrdersPeer::PAID, $this->paid);
		if ($this->isColumnModified(SOrdersPeer::USER_FULL_NAME)) $criteria->add(SOrdersPeer::USER_FULL_NAME, $this->user_full_name);
		if ($this->isColumnModified(SOrdersPeer::USER_EMAIL)) $criteria->add(SOrdersPeer::USER_EMAIL, $this->user_email);
		if ($this->isColumnModified(SOrdersPeer::USER_PHONE)) $criteria->add(SOrdersPeer::USER_PHONE, $this->user_phone);
		if ($this->isColumnModified(SOrdersPeer::USER_DELIVER_TO)) $criteria->add(SOrdersPeer::USER_DELIVER_TO, $this->user_deliver_to);
		if ($this->isColumnModified(SOrdersPeer::USER_COMMENT)) $criteria->add(SOrdersPeer::USER_COMMENT, $this->user_comment);
		if ($this->isColumnModified(SOrdersPeer::DATE_CREATED)) $criteria->add(SOrdersPeer::DATE_CREATED, $this->date_created);
		if ($this->isColumnModified(SOrdersPeer::DATE_UPDATED)) $criteria->add(SOrdersPeer::DATE_UPDATED, $this->date_updated);
		if ($this->isColumnModified(SOrdersPeer::USER_IP)) $criteria->add(SOrdersPeer::USER_IP, $this->user_ip);

		return $criteria;
	}

	/**
	 * Builds a Criteria object containing the primary key for this object.
	 *
	 * Unlike buildCriteria() this method includes the primary key values regardless
	 * of whether or not they have been modified.
	 *
	 * @return     Criteria The Criteria object containing value(s) for primary key(s).
	 */
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(SOrdersPeer::DATABASE_NAME);
		$criteria->add(SOrdersPeer::ID, $this->id);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	/**
	 * Generic method to set the primary key (id column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	/**
	 * Returns true if the primary key for this object is null.
	 * @return     boolean
	 */
	public function isPrimaryKeyNull()
	{
		return null === $this->getId();
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of SOrders (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{
		$copyObj->setKey($this->key);
		$copyObj->setDeliveryMethod($this->delivery_method);
		$copyObj->setDeliveryPrice($this->delivery_price);
		$copyObj->setStatus($this->status);
		$copyObj->setPaid($this->paid);
		$copyObj->setUserFullName($this->user_full_name);
		$copyObj->setUserEmail($this->user_email);
		$copyObj->setUserPhone($this->user_phone);
		$copyObj->setUserDeliverTo($this->user_deliver_to);
		$copyObj->setUserComment($this->user_comment);
		$copyObj->setDateCreated($this->date_created);
		$copyObj->setDateUpdated($this->date_updated);
		$copyObj->setUserIp($this->user_ip);

		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getSOrderProductss() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addSOrderProducts($relObj->copy($deepCopy));
				}
			}

		} // if ($deepCopy)


		$copyObj->setNew(true);
		$copyObj->setId(NULL); // this is a auto-increment column, so set to default value
	}

	/**
	 * Makes a copy of this object that will be inserted as a new row in table when saved.
	 * It creates a new object filling in the simple attributes, but skipping any primary
	 * keys that are defined for the table.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @return     SOrders Clone of current object.
	 * @throws     PropelException
	 */
	public function copy($deepCopy = false)
	{
		// we use get_class(), because this might be a subclass
		$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	/**
	 * Returns a peer instance associated with this om.
	 *
	 * Since Peer classes are not to have any instance attributes, this method returns the
	 * same instance for all member of this class. The method could therefore
	 * be static, but this would prevent one from overriding the behavior.
	 *
	 * @return     SOrdersPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new SOrdersPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a SDeliveryMethods object.
	 *
	 * @param      SDeliveryMethods $v
	 * @return     SOrders The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setSDeliveryMethods(SDeliveryMethods $v = null)
	{
		if ($v === null) {
			$this->setDeliveryMethod(NULL);
		} else {
			$this->setDeliveryMethod($v->getId());
		}

		$this->aSDeliveryMethods = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the SDeliveryMethods object, it will not be re-added.
		if ($v !== null) {
			$v->addSOrders($this);
		}

		return $this;
	}


	/**
	 * Get the associated SDeliveryMethods object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     SDeliveryMethods The associated SDeliveryMethods object.
	 * @throws     PropelException
	 */
	public function getSDeliveryMethods(PropelPDO $con = null)
	{
		if ($this->aSDeliveryMethods === null && ($this->delivery_method !== null)) {
			$this->aSDeliveryMethods = SDeliveryMethodsQuery::create()->findPk($this->delivery_method, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aSDeliveryMethods->addSOrderss($this);
			 */
		}
		return $this->aSDeliveryMethods;
	}

	/**
	 * Clears out the collSOrderProductss collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addSOrderProductss()
	 */
	public function clearSOrderProductss()
	{
		$this->collSOrderProductss = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collSOrderProductss collection.
	 *
	 * By default this just sets the collSOrderProductss collection to an empty array (like clearcollSOrderProductss());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initSOrderProductss()
	{
		$this->collSOrderProductss = new PropelObjectCollection();
		$this->collSOrderProductss->setModel('SOrderProducts');
	}

	/**
	 * Gets an array of SOrderProducts objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this SOrders is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array SOrderProducts[] List of SOrderProducts objects
	 * @throws     PropelException
	 */
	public function getSOrderProductss($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collSOrderProductss || null !== $criteria) {
			if ($this->isNew() && null === $this->collSOrderProductss) {
				// return empty collection
				$this->initSOrderProductss();
			} else {
				$collSOrderProductss = SOrderProductsQuery::create(null, $criteria)
					->filterBySOrders($this)
					->find($con);
				if (null !== $criteria) {
					return $collSOrderProductss;
				}
				$this->collSOrderProductss = $collSOrderProductss;
			}
		}
		return $this->collSOrderProductss;
	}

	/**
	 * Returns the number of related SOrderProducts objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related SOrderProducts objects.
	 * @throws     PropelException
	 */
	public function countSOrderProductss(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collSOrderProductss || null !== $criteria) {
			if ($this->isNew() && null === $this->collSOrderProductss) {
				return 0;
			} else {
				$query = SOrderProductsQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterBySOrders($this)
					->count($con);
			}
		} else {
			return count($this->collSOrderProductss);
		}
	}

	/**
	 * Method called to associate a SOrderProducts object to this object
	 * through the SOrderProducts foreign key attribute.
	 *
	 * @param      SOrderProducts $l SOrderProducts
	 * @return     void
	 * @throws     PropelException
	 */
	public function addSOrderProducts(SOrderProducts $l)
	{
		if ($this->collSOrderProductss === null) {
			$this->initSOrderProductss();
		}
		if (!$this->collSOrderProductss->contains($l)) { // only add it if the **same** object is not already associated
			$this->collSOrderProductss[]= $l;
			$l->setSOrders($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this SOrders is new, it will return
	 * an empty collection; or if this SOrders has previously
	 * been saved, it will retrieve related SOrderProductss from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in SOrders.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array SOrderProducts[] List of SOrderProducts objects
	 */
	public function getSOrderProductssJoinSProducts($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = SOrderProductsQuery::create(null, $criteria);
		$query->joinWith('SProducts', $join_behavior);

		return $this->getSOrderProductss($query, $con);
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->id = null;
		$this->key = null;
		$this->delivery_method = null;
		$this->delivery_price = null;
		$this->status = null;
		$this->paid = null;
		$this->user_full_name = null;
		$this->user_email = null;
		$this->user_phone = null;
		$this->user_deliver_to = null;
		$this->user_comment = null;
		$this->date_created = null;
		$this->date_updated = null;
		$this->user_ip = null;
		$this->alreadyInSave = false;
		$this->alreadyInValidation = false;
		$this->clearAllReferences();
		$this->resetModified();
		$this->setNew(true);
		$this->setDeleted(false);
	}

	/**
	 * Resets all collections of referencing foreign keys.
	 *
	 * This method is a user-space workaround for PHP's inability to garbage collect objects
	 * with circular references.  This is currently necessary when using Propel in certain
	 * daemon or large-volumne/high-memory operations.
	 *
	 * @param      boolean $deep Whether to also clear the references on all associated objects.
	 */
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collSOrderProductss) {
				foreach ((array) $this->collSOrderProductss as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collSOrderProductss = null;
		$this->aSDeliveryMethods = null;
	}

	/**
	 * Catches calls to virtual methods
	 */
	public function __call($name, $params)
	{
		if (preg_match('/get(\w+)/', $name, $matches)) {
			$virtualColumn = $matches[1];
			if ($this->hasVirtualColumn($virtualColumn)) {
				return $this->getVirtualColumn($virtualColumn);
			}
			// no lcfirst in php<5.3...
			$virtualColumn[0] = strtolower($virtualColumn[0]);
			if ($this->hasVirtualColumn($virtualColumn)) {
				return $this->getVirtualColumn($virtualColumn);
			}
		}
		return parent::__call($name, $params);
	}

} // BaseSOrders
