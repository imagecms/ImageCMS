<?php


/**
 * Base class that represents a row from the 'shop_product_properties' table.
 *
 * 
 *
 * @package    propel.generator.Shop.om
 */
abstract class BaseSProperties extends ShopBaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
  const PEER = 'SPropertiesPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        SPropertiesPeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the name field.
	 * @var        string
	 */
	protected $name;

	/**
	 * The value for the active field.
	 * @var        boolean
	 */
	protected $active;

	/**
	 * The value for the show_in_compare field.
	 * @var        boolean
	 */
	protected $show_in_compare;

	/**
	 * The value for the position field.
	 * @var        int
	 */
	protected $position;

	/**
	 * The value for the data field.
	 * @var        string
	 */
	protected $data;

	/**
	 * @var        array ShopProductPropertiesCategories[] Collection to store aggregation of ShopProductPropertiesCategories objects.
	 */
	protected $collShopProductPropertiesCategoriess;

	/**
	 * @var        array SProductPropertiesData[] Collection to store aggregation of SProductPropertiesData objects.
	 */
	protected $collSProductPropertiesDatas;

	/**
	 * @var        array SCategory[] Collection to store aggregation of SCategory objects.
	 */
	protected $collPropertyCategorys;

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
	 * Get the [name] column value.
	 * 
	 * @return     string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Get the [active] column value.
	 * 
	 * @return     boolean
	 */
	public function getActive()
	{
		return $this->active;
	}

	/**
	 * Get the [show_in_compare] column value.
	 * 
	 * @return     boolean
	 */
	public function getShowInCompare()
	{
		return $this->show_in_compare;
	}

	/**
	 * Get the [position] column value.
	 * 
	 * @return     int
	 */
	public function getPosition()
	{
		return $this->position;
	}

	/**
	 * Get the [data] column value.
	 * 
	 * @return     string
	 */
	public function getData()
	{
		return $this->data;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     SProperties The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = SPropertiesPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [name] column.
	 * 
	 * @param      string $v new value
	 * @return     SProperties The current object (for fluent API support)
	 */
	public function setName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = SPropertiesPeer::NAME;
		}

		return $this;
	} // setName()

	/**
	 * Set the value of [active] column.
	 * 
	 * @param      boolean $v new value
	 * @return     SProperties The current object (for fluent API support)
	 */
	public function setActive($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->active !== $v) {
			$this->active = $v;
			$this->modifiedColumns[] = SPropertiesPeer::ACTIVE;
		}

		return $this;
	} // setActive()

	/**
	 * Set the value of [show_in_compare] column.
	 * 
	 * @param      boolean $v new value
	 * @return     SProperties The current object (for fluent API support)
	 */
	public function setShowInCompare($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->show_in_compare !== $v) {
			$this->show_in_compare = $v;
			$this->modifiedColumns[] = SPropertiesPeer::SHOW_IN_COMPARE;
		}

		return $this;
	} // setShowInCompare()

	/**
	 * Set the value of [position] column.
	 * 
	 * @param      int $v new value
	 * @return     SProperties The current object (for fluent API support)
	 */
	public function setPosition($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->position !== $v) {
			$this->position = $v;
			$this->modifiedColumns[] = SPropertiesPeer::POSITION;
		}

		return $this;
	} // setPosition()

	/**
	 * Set the value of [data] column.
	 * 
	 * @param      string $v new value
	 * @return     SProperties The current object (for fluent API support)
	 */
	public function setData($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->data !== $v) {
			$this->data = $v;
			$this->modifiedColumns[] = SPropertiesPeer::DATA;
		}

		return $this;
	} // setData()

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
			$this->name = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->active = ($row[$startcol + 2] !== null) ? (boolean) $row[$startcol + 2] : null;
			$this->show_in_compare = ($row[$startcol + 3] !== null) ? (boolean) $row[$startcol + 3] : null;
			$this->position = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
			$this->data = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 6; // 6 = SPropertiesPeer::NUM_COLUMNS - SPropertiesPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating SProperties object", $e);
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
			$con = Propel::getConnection(SPropertiesPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = SPropertiesPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->collShopProductPropertiesCategoriess = null;

			$this->collSProductPropertiesDatas = null;

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
			$con = Propel::getConnection(SPropertiesPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			if ($ret) {
				SPropertiesQuery::create()
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
			$con = Propel::getConnection(SPropertiesPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				SPropertiesPeer::addInstanceToPool($this);
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

			if ($this->isNew() ) {
				$this->modifiedColumns[] = SPropertiesPeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$criteria = $this->buildCriteria();
					if ($criteria->keyContainsValue(SPropertiesPeer::ID) ) {
						throw new PropelException('Cannot insert a value for auto-increment primary key ('.SPropertiesPeer::ID.')');
					}

					$pk = BasePeer::doInsert($criteria, $con);
					$affectedRows = 1;
					$this->setId($pk);  //[IMV] update autoincrement primary key
					$this->setNew(false);
				} else {
					$affectedRows = SPropertiesPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collShopProductPropertiesCategoriess !== null) {
				foreach ($this->collShopProductPropertiesCategoriess as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collSProductPropertiesDatas !== null) {
				foreach ($this->collSProductPropertiesDatas as $referrerFK) {
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


			if (($retval = SPropertiesPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collShopProductPropertiesCategoriess !== null) {
					foreach ($this->collShopProductPropertiesCategoriess as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collSProductPropertiesDatas !== null) {
					foreach ($this->collSProductPropertiesDatas as $referrerFK) {
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
		$pos = SPropertiesPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getName();
				break;
			case 2:
				return $this->getActive();
				break;
			case 3:
				return $this->getShowInCompare();
				break;
			case 4:
				return $this->getPosition();
				break;
			case 5:
				return $this->getData();
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
	 *
	 * @return    array an associative array containing the field names (as keys) and field values
	 */
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = SPropertiesPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getName(),
			$keys[2] => $this->getActive(),
			$keys[3] => $this->getShowInCompare(),
			$keys[4] => $this->getPosition(),
			$keys[5] => $this->getData(),
		);
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
		$pos = SPropertiesPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setName($value);
				break;
			case 2:
				$this->setActive($value);
				break;
			case 3:
				$this->setShowInCompare($value);
				break;
			case 4:
				$this->setPosition($value);
				break;
			case 5:
				$this->setData($value);
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
		$keys = SPropertiesPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setActive($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setShowInCompare($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setPosition($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setData($arr[$keys[5]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(SPropertiesPeer::DATABASE_NAME);

		if ($this->isColumnModified(SPropertiesPeer::ID)) $criteria->add(SPropertiesPeer::ID, $this->id);
		if ($this->isColumnModified(SPropertiesPeer::NAME)) $criteria->add(SPropertiesPeer::NAME, $this->name);
		if ($this->isColumnModified(SPropertiesPeer::ACTIVE)) $criteria->add(SPropertiesPeer::ACTIVE, $this->active);
		if ($this->isColumnModified(SPropertiesPeer::SHOW_IN_COMPARE)) $criteria->add(SPropertiesPeer::SHOW_IN_COMPARE, $this->show_in_compare);
		if ($this->isColumnModified(SPropertiesPeer::POSITION)) $criteria->add(SPropertiesPeer::POSITION, $this->position);
		if ($this->isColumnModified(SPropertiesPeer::DATA)) $criteria->add(SPropertiesPeer::DATA, $this->data);

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
		$criteria = new Criteria(SPropertiesPeer::DATABASE_NAME);
		$criteria->add(SPropertiesPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of SProperties (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{
		$copyObj->setName($this->name);
		$copyObj->setActive($this->active);
		$copyObj->setShowInCompare($this->show_in_compare);
		$copyObj->setPosition($this->position);
		$copyObj->setData($this->data);

		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getShopProductPropertiesCategoriess() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addShopProductPropertiesCategories($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getSProductPropertiesDatas() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addSProductPropertiesData($relObj->copy($deepCopy));
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
	 * @return     SProperties Clone of current object.
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
	 * @return     SPropertiesPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new SPropertiesPeer();
		}
		return self::$peer;
	}

	/**
	 * Clears out the collShopProductPropertiesCategoriess collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addShopProductPropertiesCategoriess()
	 */
	public function clearShopProductPropertiesCategoriess()
	{
		$this->collShopProductPropertiesCategoriess = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collShopProductPropertiesCategoriess collection.
	 *
	 * By default this just sets the collShopProductPropertiesCategoriess collection to an empty array (like clearcollShopProductPropertiesCategoriess());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initShopProductPropertiesCategoriess()
	{
		$this->collShopProductPropertiesCategoriess = new PropelObjectCollection();
		$this->collShopProductPropertiesCategoriess->setModel('ShopProductPropertiesCategories');
	}

	/**
	 * Gets an array of ShopProductPropertiesCategories objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this SProperties is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array ShopProductPropertiesCategories[] List of ShopProductPropertiesCategories objects
	 * @throws     PropelException
	 */
	public function getShopProductPropertiesCategoriess($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collShopProductPropertiesCategoriess || null !== $criteria) {
			if ($this->isNew() && null === $this->collShopProductPropertiesCategoriess) {
				// return empty collection
				$this->initShopProductPropertiesCategoriess();
			} else {
				$collShopProductPropertiesCategoriess = ShopProductPropertiesCategoriesQuery::create(null, $criteria)
					->filterByProperty($this)
					->find($con);
				if (null !== $criteria) {
					return $collShopProductPropertiesCategoriess;
				}
				$this->collShopProductPropertiesCategoriess = $collShopProductPropertiesCategoriess;
			}
		}
		return $this->collShopProductPropertiesCategoriess;
	}

	/**
	 * Returns the number of related ShopProductPropertiesCategories objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related ShopProductPropertiesCategories objects.
	 * @throws     PropelException
	 */
	public function countShopProductPropertiesCategoriess(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collShopProductPropertiesCategoriess || null !== $criteria) {
			if ($this->isNew() && null === $this->collShopProductPropertiesCategoriess) {
				return 0;
			} else {
				$query = ShopProductPropertiesCategoriesQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByProperty($this)
					->count($con);
			}
		} else {
			return count($this->collShopProductPropertiesCategoriess);
		}
	}

	/**
	 * Method called to associate a ShopProductPropertiesCategories object to this object
	 * through the ShopProductPropertiesCategories foreign key attribute.
	 *
	 * @param      ShopProductPropertiesCategories $l ShopProductPropertiesCategories
	 * @return     void
	 * @throws     PropelException
	 */
	public function addShopProductPropertiesCategories(ShopProductPropertiesCategories $l)
	{
		if ($this->collShopProductPropertiesCategoriess === null) {
			$this->initShopProductPropertiesCategoriess();
		}
		if (!$this->collShopProductPropertiesCategoriess->contains($l)) { // only add it if the **same** object is not already associated
			$this->collShopProductPropertiesCategoriess[]= $l;
			$l->setProperty($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this SProperties is new, it will return
	 * an empty collection; or if this SProperties has previously
	 * been saved, it will retrieve related ShopProductPropertiesCategoriess from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in SProperties.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array ShopProductPropertiesCategories[] List of ShopProductPropertiesCategories objects
	 */
	public function getShopProductPropertiesCategoriessJoinPropertyCategory($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = ShopProductPropertiesCategoriesQuery::create(null, $criteria);
		$query->joinWith('PropertyCategory', $join_behavior);

		return $this->getShopProductPropertiesCategoriess($query, $con);
	}

	/**
	 * Clears out the collSProductPropertiesDatas collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addSProductPropertiesDatas()
	 */
	public function clearSProductPropertiesDatas()
	{
		$this->collSProductPropertiesDatas = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collSProductPropertiesDatas collection.
	 *
	 * By default this just sets the collSProductPropertiesDatas collection to an empty array (like clearcollSProductPropertiesDatas());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initSProductPropertiesDatas()
	{
		$this->collSProductPropertiesDatas = new PropelObjectCollection();
		$this->collSProductPropertiesDatas->setModel('SProductPropertiesData');
	}

	/**
	 * Gets an array of SProductPropertiesData objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this SProperties is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array SProductPropertiesData[] List of SProductPropertiesData objects
	 * @throws     PropelException
	 */
	public function getSProductPropertiesDatas($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collSProductPropertiesDatas || null !== $criteria) {
			if ($this->isNew() && null === $this->collSProductPropertiesDatas) {
				// return empty collection
				$this->initSProductPropertiesDatas();
			} else {
				$collSProductPropertiesDatas = SProductPropertiesDataQuery::create(null, $criteria)
					->filterBySProperties($this)
					->find($con);
				if (null !== $criteria) {
					return $collSProductPropertiesDatas;
				}
				$this->collSProductPropertiesDatas = $collSProductPropertiesDatas;
			}
		}
		return $this->collSProductPropertiesDatas;
	}

	/**
	 * Returns the number of related SProductPropertiesData objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related SProductPropertiesData objects.
	 * @throws     PropelException
	 */
	public function countSProductPropertiesDatas(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collSProductPropertiesDatas || null !== $criteria) {
			if ($this->isNew() && null === $this->collSProductPropertiesDatas) {
				return 0;
			} else {
				$query = SProductPropertiesDataQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterBySProperties($this)
					->count($con);
			}
		} else {
			return count($this->collSProductPropertiesDatas);
		}
	}

	/**
	 * Method called to associate a SProductPropertiesData object to this object
	 * through the SProductPropertiesData foreign key attribute.
	 *
	 * @param      SProductPropertiesData $l SProductPropertiesData
	 * @return     void
	 * @throws     PropelException
	 */
	public function addSProductPropertiesData(SProductPropertiesData $l)
	{
		if ($this->collSProductPropertiesDatas === null) {
			$this->initSProductPropertiesDatas();
		}
		if (!$this->collSProductPropertiesDatas->contains($l)) { // only add it if the **same** object is not already associated
			$this->collSProductPropertiesDatas[]= $l;
			$l->setSProperties($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this SProperties is new, it will return
	 * an empty collection; or if this SProperties has previously
	 * been saved, it will retrieve related SProductPropertiesDatas from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in SProperties.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array SProductPropertiesData[] List of SProductPropertiesData objects
	 */
	public function getSProductPropertiesDatasJoinProduct($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = SProductPropertiesDataQuery::create(null, $criteria);
		$query->joinWith('Product', $join_behavior);

		return $this->getSProductPropertiesDatas($query, $con);
	}

	/**
	 * Clears out the collPropertyCategorys collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addPropertyCategorys()
	 */
	public function clearPropertyCategorys()
	{
		$this->collPropertyCategorys = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collPropertyCategorys collection.
	 *
	 * By default this just sets the collPropertyCategorys collection to an empty collection (like clearPropertyCategorys());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initPropertyCategorys()
	{
		$this->collPropertyCategorys = new PropelObjectCollection();
		$this->collPropertyCategorys->setModel('SCategory');
	}

	/**
	 * Gets a collection of SCategory objects related by a many-to-many relationship
	 * to the current object by way of the shop_product_properties_categories cross-reference table.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this SProperties is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria Optional query object to filter the query
	 * @param      PropelPDO $con Optional connection object
	 *
	 * @return     PropelCollection|array SCategory[] List of SCategory objects
	 */
	public function getPropertyCategorys($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collPropertyCategorys || null !== $criteria) {
			if ($this->isNew() && null === $this->collPropertyCategorys) {
				// return empty collection
				$this->initPropertyCategorys();
			} else {
				$collPropertyCategorys = SCategoryQuery::create(null, $criteria)
					->filterByProperty($this)
					->find($con);
				if (null !== $criteria) {
					return $collPropertyCategorys;
				}
				$this->collPropertyCategorys = $collPropertyCategorys;
			}
		}
		return $this->collPropertyCategorys;
	}

	/**
	 * Gets the number of SCategory objects related by a many-to-many relationship
	 * to the current object by way of the shop_product_properties_categories cross-reference table.
	 *
	 * @param      Criteria $criteria Optional query object to filter the query
	 * @param      boolean $distinct Set to true to force count distinct
	 * @param      PropelPDO $con Optional connection object
	 *
	 * @return     int the number of related SCategory objects
	 */
	public function countPropertyCategorys($criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collPropertyCategorys || null !== $criteria) {
			if ($this->isNew() && null === $this->collPropertyCategorys) {
				return 0;
			} else {
				$query = SCategoryQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByProperty($this)
					->count($con);
			}
		} else {
			return count($this->collPropertyCategorys);
		}
	}

	/**
	 * Associate a SCategory object to this object
	 * through the shop_product_properties_categories cross reference table.
	 *
	 * @param      SCategory $sCategory The ShopProductPropertiesCategories object to relate
	 * @return     void
	 */
	public function addPropertyCategory($sCategory)
	{
		if ($this->collPropertyCategorys === null) {
			$this->initPropertyCategorys();
		}
		if (!$this->collPropertyCategorys->contains($sCategory)) { // only add it if the **same** object is not already associated
			$shopProductPropertiesCategories = new ShopProductPropertiesCategories();
			$shopProductPropertiesCategories->setPropertyCategory($sCategory);
			$this->addShopProductPropertiesCategories($shopProductPropertiesCategories);
			
			$this->collPropertyCategorys[]= $sCategory;
		}
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->id = null;
		$this->name = null;
		$this->active = null;
		$this->show_in_compare = null;
		$this->position = null;
		$this->data = null;
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
			if ($this->collShopProductPropertiesCategoriess) {
				foreach ((array) $this->collShopProductPropertiesCategoriess as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collSProductPropertiesDatas) {
				foreach ((array) $this->collSProductPropertiesDatas as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collShopProductPropertiesCategoriess = null;
		$this->collSProductPropertiesDatas = null;
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

} // BaseSProperties
