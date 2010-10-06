<?php


/**
 * Base class that represents a row from the 'shop_orders_products' table.
 *
 * 
 *
 * @package    propel.generator.Shop.om
 */
abstract class BaseSOrderProducts extends ShopBaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
  const PEER = 'SOrderProductsPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        SOrderProductsPeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the order_id field.
	 * @var        int
	 */
	protected $order_id;

	/**
	 * The value for the product_id field.
	 * @var        int
	 */
	protected $product_id;

	/**
	 * The value for the variant_id field.
	 * @var        int
	 */
	protected $variant_id;

	/**
	 * The value for the product_name field.
	 * @var        string
	 */
	protected $product_name;

	/**
	 * The value for the variant_name field.
	 * @var        string
	 */
	protected $variant_name;

	/**
	 * The value for the price field.
	 * @var        string
	 */
	protected $price;

	/**
	 * The value for the quantity field.
	 * @var        int
	 */
	protected $quantity;

	/**
	 * @var        SProducts
	 */
	protected $aSProducts;

	/**
	 * @var        SOrders
	 */
	protected $aSOrders;

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
	 * Get the [order_id] column value.
	 * 
	 * @return     int
	 */
	public function getOrderId()
	{
		return $this->order_id;
	}

	/**
	 * Get the [product_id] column value.
	 * 
	 * @return     int
	 */
	public function getProductId()
	{
		return $this->product_id;
	}

	/**
	 * Get the [variant_id] column value.
	 * 
	 * @return     int
	 */
	public function getVariantId()
	{
		return $this->variant_id;
	}

	/**
	 * Get the [product_name] column value.
	 * 
	 * @return     string
	 */
	public function getProductName()
	{
		return $this->product_name;
	}

	/**
	 * Get the [variant_name] column value.
	 * 
	 * @return     string
	 */
	public function getVariantName()
	{
		return $this->variant_name;
	}

	/**
	 * Get the [price] column value.
	 * 
	 * @return     string
	 */
	public function getPrice()
	{
		return $this->price;
	}

	/**
	 * Get the [quantity] column value.
	 * 
	 * @return     int
	 */
	public function getQuantity()
	{
		return $this->quantity;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     SOrderProducts The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = SOrderProductsPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [order_id] column.
	 * 
	 * @param      int $v new value
	 * @return     SOrderProducts The current object (for fluent API support)
	 */
	public function setOrderId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->order_id !== $v) {
			$this->order_id = $v;
			$this->modifiedColumns[] = SOrderProductsPeer::ORDER_ID;
		}

		if ($this->aSOrders !== null && $this->aSOrders->getId() !== $v) {
			$this->aSOrders = null;
		}

		return $this;
	} // setOrderId()

	/**
	 * Set the value of [product_id] column.
	 * 
	 * @param      int $v new value
	 * @return     SOrderProducts The current object (for fluent API support)
	 */
	public function setProductId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->product_id !== $v) {
			$this->product_id = $v;
			$this->modifiedColumns[] = SOrderProductsPeer::PRODUCT_ID;
		}

		if ($this->aSProducts !== null && $this->aSProducts->getId() !== $v) {
			$this->aSProducts = null;
		}

		return $this;
	} // setProductId()

	/**
	 * Set the value of [variant_id] column.
	 * 
	 * @param      int $v new value
	 * @return     SOrderProducts The current object (for fluent API support)
	 */
	public function setVariantId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->variant_id !== $v) {
			$this->variant_id = $v;
			$this->modifiedColumns[] = SOrderProductsPeer::VARIANT_ID;
		}

		return $this;
	} // setVariantId()

	/**
	 * Set the value of [product_name] column.
	 * 
	 * @param      string $v new value
	 * @return     SOrderProducts The current object (for fluent API support)
	 */
	public function setProductName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->product_name !== $v) {
			$this->product_name = $v;
			$this->modifiedColumns[] = SOrderProductsPeer::PRODUCT_NAME;
		}

		return $this;
	} // setProductName()

	/**
	 * Set the value of [variant_name] column.
	 * 
	 * @param      string $v new value
	 * @return     SOrderProducts The current object (for fluent API support)
	 */
	public function setVariantName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->variant_name !== $v) {
			$this->variant_name = $v;
			$this->modifiedColumns[] = SOrderProductsPeer::VARIANT_NAME;
		}

		return $this;
	} // setVariantName()

	/**
	 * Set the value of [price] column.
	 * 
	 * @param      string $v new value
	 * @return     SOrderProducts The current object (for fluent API support)
	 */
	public function setPrice($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->price !== $v) {
			$this->price = $v;
			$this->modifiedColumns[] = SOrderProductsPeer::PRICE;
		}

		return $this;
	} // setPrice()

	/**
	 * Set the value of [quantity] column.
	 * 
	 * @param      int $v new value
	 * @return     SOrderProducts The current object (for fluent API support)
	 */
	public function setQuantity($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->quantity !== $v) {
			$this->quantity = $v;
			$this->modifiedColumns[] = SOrderProductsPeer::QUANTITY;
		}

		return $this;
	} // setQuantity()

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
			$this->order_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->product_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->variant_id = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->product_name = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->variant_name = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->price = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->quantity = ($row[$startcol + 7] !== null) ? (int) $row[$startcol + 7] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 8; // 8 = SOrderProductsPeer::NUM_COLUMNS - SOrderProductsPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating SOrderProducts object", $e);
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

		if ($this->aSOrders !== null && $this->order_id !== $this->aSOrders->getId()) {
			$this->aSOrders = null;
		}
		if ($this->aSProducts !== null && $this->product_id !== $this->aSProducts->getId()) {
			$this->aSProducts = null;
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
			$con = Propel::getConnection(SOrderProductsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = SOrderProductsPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aSProducts = null;
			$this->aSOrders = null;
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
			$con = Propel::getConnection(SOrderProductsPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			if ($ret) {
				SOrderProductsQuery::create()
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
			$con = Propel::getConnection(SOrderProductsPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				SOrderProductsPeer::addInstanceToPool($this);
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

			if ($this->aSProducts !== null) {
				if ($this->aSProducts->isModified() || $this->aSProducts->isNew()) {
					$affectedRows += $this->aSProducts->save($con);
				}
				$this->setSProducts($this->aSProducts);
			}

			if ($this->aSOrders !== null) {
				if ($this->aSOrders->isModified() || $this->aSOrders->isNew()) {
					$affectedRows += $this->aSOrders->save($con);
				}
				$this->setSOrders($this->aSOrders);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = SOrderProductsPeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$criteria = $this->buildCriteria();
					if ($criteria->keyContainsValue(SOrderProductsPeer::ID) ) {
						throw new PropelException('Cannot insert a value for auto-increment primary key ('.SOrderProductsPeer::ID.')');
					}

					$pk = BasePeer::doInsert($criteria, $con);
					$affectedRows += 1;
					$this->setId($pk);  //[IMV] update autoincrement primary key
					$this->setNew(false);
				} else {
					$affectedRows += SOrderProductsPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
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

			if ($this->aSProducts !== null) {
				if (!$this->aSProducts->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aSProducts->getValidationFailures());
				}
			}

			if ($this->aSOrders !== null) {
				if (!$this->aSOrders->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aSOrders->getValidationFailures());
				}
			}


			if (($retval = SOrderProductsPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
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
		$pos = SOrderProductsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getOrderId();
				break;
			case 2:
				return $this->getProductId();
				break;
			case 3:
				return $this->getVariantId();
				break;
			case 4:
				return $this->getProductName();
				break;
			case 5:
				return $this->getVariantName();
				break;
			case 6:
				return $this->getPrice();
				break;
			case 7:
				return $this->getQuantity();
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
		$keys = SOrderProductsPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getOrderId(),
			$keys[2] => $this->getProductId(),
			$keys[3] => $this->getVariantId(),
			$keys[4] => $this->getProductName(),
			$keys[5] => $this->getVariantName(),
			$keys[6] => $this->getPrice(),
			$keys[7] => $this->getQuantity(),
		);
		if ($includeForeignObjects) {
			if (null !== $this->aSProducts) {
				$result['SProducts'] = $this->aSProducts->toArray($keyType, $includeLazyLoadColumns, true);
			}
			if (null !== $this->aSOrders) {
				$result['SOrders'] = $this->aSOrders->toArray($keyType, $includeLazyLoadColumns, true);
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
		$pos = SOrderProductsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setOrderId($value);
				break;
			case 2:
				$this->setProductId($value);
				break;
			case 3:
				$this->setVariantId($value);
				break;
			case 4:
				$this->setProductName($value);
				break;
			case 5:
				$this->setVariantName($value);
				break;
			case 6:
				$this->setPrice($value);
				break;
			case 7:
				$this->setQuantity($value);
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
		$keys = SOrderProductsPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setOrderId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setProductId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setVariantId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setProductName($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setVariantName($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setPrice($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setQuantity($arr[$keys[7]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(SOrderProductsPeer::DATABASE_NAME);

		if ($this->isColumnModified(SOrderProductsPeer::ID)) $criteria->add(SOrderProductsPeer::ID, $this->id);
		if ($this->isColumnModified(SOrderProductsPeer::ORDER_ID)) $criteria->add(SOrderProductsPeer::ORDER_ID, $this->order_id);
		if ($this->isColumnModified(SOrderProductsPeer::PRODUCT_ID)) $criteria->add(SOrderProductsPeer::PRODUCT_ID, $this->product_id);
		if ($this->isColumnModified(SOrderProductsPeer::VARIANT_ID)) $criteria->add(SOrderProductsPeer::VARIANT_ID, $this->variant_id);
		if ($this->isColumnModified(SOrderProductsPeer::PRODUCT_NAME)) $criteria->add(SOrderProductsPeer::PRODUCT_NAME, $this->product_name);
		if ($this->isColumnModified(SOrderProductsPeer::VARIANT_NAME)) $criteria->add(SOrderProductsPeer::VARIANT_NAME, $this->variant_name);
		if ($this->isColumnModified(SOrderProductsPeer::PRICE)) $criteria->add(SOrderProductsPeer::PRICE, $this->price);
		if ($this->isColumnModified(SOrderProductsPeer::QUANTITY)) $criteria->add(SOrderProductsPeer::QUANTITY, $this->quantity);

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
		$criteria = new Criteria(SOrderProductsPeer::DATABASE_NAME);
		$criteria->add(SOrderProductsPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of SOrderProducts (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{
		$copyObj->setOrderId($this->order_id);
		$copyObj->setProductId($this->product_id);
		$copyObj->setVariantId($this->variant_id);
		$copyObj->setProductName($this->product_name);
		$copyObj->setVariantName($this->variant_name);
		$copyObj->setPrice($this->price);
		$copyObj->setQuantity($this->quantity);

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
	 * @return     SOrderProducts Clone of current object.
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
	 * @return     SOrderProductsPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new SOrderProductsPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a SProducts object.
	 *
	 * @param      SProducts $v
	 * @return     SOrderProducts The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setSProducts(SProducts $v = null)
	{
		if ($v === null) {
			$this->setProductId(NULL);
		} else {
			$this->setProductId($v->getId());
		}

		$this->aSProducts = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the SProducts object, it will not be re-added.
		if ($v !== null) {
			$v->addSOrderProducts($this);
		}

		return $this;
	}


	/**
	 * Get the associated SProducts object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     SProducts The associated SProducts object.
	 * @throws     PropelException
	 */
	public function getSProducts(PropelPDO $con = null)
	{
		if ($this->aSProducts === null && ($this->product_id !== null)) {
			$this->aSProducts = SProductsQuery::create()->findPk($this->product_id, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aSProducts->addSOrderProductss($this);
			 */
		}
		return $this->aSProducts;
	}

	/**
	 * Declares an association between this object and a SOrders object.
	 *
	 * @param      SOrders $v
	 * @return     SOrderProducts The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setSOrders(SOrders $v = null)
	{
		if ($v === null) {
			$this->setOrderId(NULL);
		} else {
			$this->setOrderId($v->getId());
		}

		$this->aSOrders = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the SOrders object, it will not be re-added.
		if ($v !== null) {
			$v->addSOrderProducts($this);
		}

		return $this;
	}


	/**
	 * Get the associated SOrders object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     SOrders The associated SOrders object.
	 * @throws     PropelException
	 */
	public function getSOrders(PropelPDO $con = null)
	{
		if ($this->aSOrders === null && ($this->order_id !== null)) {
			$this->aSOrders = SOrdersQuery::create()->findPk($this->order_id, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aSOrders->addSOrderProductss($this);
			 */
		}
		return $this->aSOrders;
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->id = null;
		$this->order_id = null;
		$this->product_id = null;
		$this->variant_id = null;
		$this->product_name = null;
		$this->variant_name = null;
		$this->price = null;
		$this->quantity = null;
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
		} // if ($deep)

		$this->aSProducts = null;
		$this->aSOrders = null;
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

} // BaseSOrderProducts
