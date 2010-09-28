<?php


/**
 * Base class that represents a row from the 'shop_category' table.
 *
 * 
 *
 * @package    propel.generator.Shop.om
 */
abstract class BaseSCategory extends ShopBaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
  const PEER = 'SCategoryPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        SCategoryPeer
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
	 * The value for the url field.
	 * @var        string
	 */
	protected $url;

	/**
	 * The value for the description field.
	 * @var        string
	 */
	protected $description;

	/**
	 * The value for the meta_desc field.
	 * @var        string
	 */
	protected $meta_desc;

	/**
	 * The value for the meta_title field.
	 * @var        string
	 */
	protected $meta_title;

	/**
	 * The value for the parent_id field.
	 * @var        int
	 */
	protected $parent_id;

	/**
	 * The value for the position field.
	 * @var        int
	 */
	protected $position;

	/**
	 * The value for the full_path field.
	 * @var        string
	 */
	protected $full_path;

	/**
	 * The value for the full_path_ids field.
	 * @var        string
	 */
	protected $full_path_ids;

	/**
	 * @var        array SProducts[] Collection to store aggregation of SProducts objects.
	 */
	protected $collSProductss;

	/**
	 * @var        array ShopProductCategories[] Collection to store aggregation of ShopProductCategories objects.
	 */
	protected $collShopProductCategoriess;

	/**
	 * @var        array ShopProductPropertiesCategories[] Collection to store aggregation of ShopProductPropertiesCategories objects.
	 */
	protected $collShopProductPropertiesCategoriess;

	/**
	 * @var        array SProducts[] Collection to store aggregation of SProducts objects.
	 */
	protected $collProducts;

	/**
	 * @var        array SProperties[] Collection to store aggregation of SProperties objects.
	 */
	protected $collPropertys;

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
	 * Get the [url] column value.
	 * 
	 * @return     string
	 */
	public function getUrl()
	{
		return $this->url;
	}

	/**
	 * Get the [description] column value.
	 * 
	 * @return     string
	 */
	public function getDescription()
	{
		return $this->description;
	}

	/**
	 * Get the [meta_desc] column value.
	 * 
	 * @return     string
	 */
	public function getMetaDesc()
	{
		return $this->meta_desc;
	}

	/**
	 * Get the [meta_title] column value.
	 * 
	 * @return     string
	 */
	public function getMetaTitle()
	{
		return $this->meta_title;
	}

	/**
	 * Get the [parent_id] column value.
	 * 
	 * @return     int
	 */
	public function getParentId()
	{
		return $this->parent_id;
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
	 * Get the [full_path] column value.
	 * 
	 * @return     string
	 */
	public function getFullPath()
	{
		return $this->full_path;
	}

	/**
	 * Get the [full_path_ids] column value.
	 * 
	 * @return     string
	 */
	public function getFullPathIds()
	{
		return $this->full_path_ids;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     SCategory The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = SCategoryPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [name] column.
	 * 
	 * @param      string $v new value
	 * @return     SCategory The current object (for fluent API support)
	 */
	public function setName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = SCategoryPeer::NAME;
		}

		return $this;
	} // setName()

	/**
	 * Set the value of [url] column.
	 * 
	 * @param      string $v new value
	 * @return     SCategory The current object (for fluent API support)
	 */
	public function setUrl($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->url !== $v) {
			$this->url = $v;
			$this->modifiedColumns[] = SCategoryPeer::URL;
		}

		return $this;
	} // setUrl()

	/**
	 * Set the value of [description] column.
	 * 
	 * @param      string $v new value
	 * @return     SCategory The current object (for fluent API support)
	 */
	public function setDescription($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = SCategoryPeer::DESCRIPTION;
		}

		return $this;
	} // setDescription()

	/**
	 * Set the value of [meta_desc] column.
	 * 
	 * @param      string $v new value
	 * @return     SCategory The current object (for fluent API support)
	 */
	public function setMetaDesc($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->meta_desc !== $v) {
			$this->meta_desc = $v;
			$this->modifiedColumns[] = SCategoryPeer::META_DESC;
		}

		return $this;
	} // setMetaDesc()

	/**
	 * Set the value of [meta_title] column.
	 * 
	 * @param      string $v new value
	 * @return     SCategory The current object (for fluent API support)
	 */
	public function setMetaTitle($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->meta_title !== $v) {
			$this->meta_title = $v;
			$this->modifiedColumns[] = SCategoryPeer::META_TITLE;
		}

		return $this;
	} // setMetaTitle()

	/**
	 * Set the value of [parent_id] column.
	 * 
	 * @param      int $v new value
	 * @return     SCategory The current object (for fluent API support)
	 */
	public function setParentId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->parent_id !== $v) {
			$this->parent_id = $v;
			$this->modifiedColumns[] = SCategoryPeer::PARENT_ID;
		}

		return $this;
	} // setParentId()

	/**
	 * Set the value of [position] column.
	 * 
	 * @param      int $v new value
	 * @return     SCategory The current object (for fluent API support)
	 */
	public function setPosition($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->position !== $v) {
			$this->position = $v;
			$this->modifiedColumns[] = SCategoryPeer::POSITION;
		}

		return $this;
	} // setPosition()

	/**
	 * Set the value of [full_path] column.
	 * 
	 * @param      string $v new value
	 * @return     SCategory The current object (for fluent API support)
	 */
	public function setFullPath($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->full_path !== $v) {
			$this->full_path = $v;
			$this->modifiedColumns[] = SCategoryPeer::FULL_PATH;
		}

		return $this;
	} // setFullPath()

	/**
	 * Set the value of [full_path_ids] column.
	 * 
	 * @param      string $v new value
	 * @return     SCategory The current object (for fluent API support)
	 */
	public function setFullPathIds($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->full_path_ids !== $v) {
			$this->full_path_ids = $v;
			$this->modifiedColumns[] = SCategoryPeer::FULL_PATH_IDS;
		}

		return $this;
	} // setFullPathIds()

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
			$this->url = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->description = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->meta_desc = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->meta_title = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->parent_id = ($row[$startcol + 6] !== null) ? (int) $row[$startcol + 6] : null;
			$this->position = ($row[$startcol + 7] !== null) ? (int) $row[$startcol + 7] : null;
			$this->full_path = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->full_path_ids = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 10; // 10 = SCategoryPeer::NUM_COLUMNS - SCategoryPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating SCategory object", $e);
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
			$con = Propel::getConnection(SCategoryPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = SCategoryPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->collSProductss = null;

			$this->collShopProductCategoriess = null;

			$this->collShopProductPropertiesCategoriess = null;

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
			$con = Propel::getConnection(SCategoryPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			if ($ret) {
				SCategoryQuery::create()
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
			$con = Propel::getConnection(SCategoryPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				SCategoryPeer::addInstanceToPool($this);
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
				$this->modifiedColumns[] = SCategoryPeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$criteria = $this->buildCriteria();
					if ($criteria->keyContainsValue(SCategoryPeer::ID) ) {
						throw new PropelException('Cannot insert a value for auto-increment primary key ('.SCategoryPeer::ID.')');
					}

					$pk = BasePeer::doInsert($criteria, $con);
					$affectedRows = 1;
					$this->setId($pk);  //[IMV] update autoincrement primary key
					$this->setNew(false);
				} else {
					$affectedRows = SCategoryPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collSProductss !== null) {
				foreach ($this->collSProductss as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collShopProductCategoriess !== null) {
				foreach ($this->collShopProductCategoriess as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collShopProductPropertiesCategoriess !== null) {
				foreach ($this->collShopProductPropertiesCategoriess as $referrerFK) {
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


			if (($retval = SCategoryPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collSProductss !== null) {
					foreach ($this->collSProductss as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collShopProductCategoriess !== null) {
					foreach ($this->collShopProductCategoriess as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collShopProductPropertiesCategoriess !== null) {
					foreach ($this->collShopProductPropertiesCategoriess as $referrerFK) {
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
		$pos = SCategoryPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getUrl();
				break;
			case 3:
				return $this->getDescription();
				break;
			case 4:
				return $this->getMetaDesc();
				break;
			case 5:
				return $this->getMetaTitle();
				break;
			case 6:
				return $this->getParentId();
				break;
			case 7:
				return $this->getPosition();
				break;
			case 8:
				return $this->getFullPath();
				break;
			case 9:
				return $this->getFullPathIds();
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
		$keys = SCategoryPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getName(),
			$keys[2] => $this->getUrl(),
			$keys[3] => $this->getDescription(),
			$keys[4] => $this->getMetaDesc(),
			$keys[5] => $this->getMetaTitle(),
			$keys[6] => $this->getParentId(),
			$keys[7] => $this->getPosition(),
			$keys[8] => $this->getFullPath(),
			$keys[9] => $this->getFullPathIds(),
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
		$pos = SCategoryPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setUrl($value);
				break;
			case 3:
				$this->setDescription($value);
				break;
			case 4:
				$this->setMetaDesc($value);
				break;
			case 5:
				$this->setMetaTitle($value);
				break;
			case 6:
				$this->setParentId($value);
				break;
			case 7:
				$this->setPosition($value);
				break;
			case 8:
				$this->setFullPath($value);
				break;
			case 9:
				$this->setFullPathIds($value);
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
		$keys = SCategoryPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setUrl($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setDescription($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setMetaDesc($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setMetaTitle($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setParentId($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setPosition($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setFullPath($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setFullPathIds($arr[$keys[9]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(SCategoryPeer::DATABASE_NAME);

		if ($this->isColumnModified(SCategoryPeer::ID)) $criteria->add(SCategoryPeer::ID, $this->id);
		if ($this->isColumnModified(SCategoryPeer::NAME)) $criteria->add(SCategoryPeer::NAME, $this->name);
		if ($this->isColumnModified(SCategoryPeer::URL)) $criteria->add(SCategoryPeer::URL, $this->url);
		if ($this->isColumnModified(SCategoryPeer::DESCRIPTION)) $criteria->add(SCategoryPeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(SCategoryPeer::META_DESC)) $criteria->add(SCategoryPeer::META_DESC, $this->meta_desc);
		if ($this->isColumnModified(SCategoryPeer::META_TITLE)) $criteria->add(SCategoryPeer::META_TITLE, $this->meta_title);
		if ($this->isColumnModified(SCategoryPeer::PARENT_ID)) $criteria->add(SCategoryPeer::PARENT_ID, $this->parent_id);
		if ($this->isColumnModified(SCategoryPeer::POSITION)) $criteria->add(SCategoryPeer::POSITION, $this->position);
		if ($this->isColumnModified(SCategoryPeer::FULL_PATH)) $criteria->add(SCategoryPeer::FULL_PATH, $this->full_path);
		if ($this->isColumnModified(SCategoryPeer::FULL_PATH_IDS)) $criteria->add(SCategoryPeer::FULL_PATH_IDS, $this->full_path_ids);

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
		$criteria = new Criteria(SCategoryPeer::DATABASE_NAME);
		$criteria->add(SCategoryPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of SCategory (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{
		$copyObj->setName($this->name);
		$copyObj->setUrl($this->url);
		$copyObj->setDescription($this->description);
		$copyObj->setMetaDesc($this->meta_desc);
		$copyObj->setMetaTitle($this->meta_title);
		$copyObj->setParentId($this->parent_id);
		$copyObj->setPosition($this->position);
		$copyObj->setFullPath($this->full_path);
		$copyObj->setFullPathIds($this->full_path_ids);

		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getSProductss() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addSProducts($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getShopProductCategoriess() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addShopProductCategories($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getShopProductPropertiesCategoriess() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addShopProductPropertiesCategories($relObj->copy($deepCopy));
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
	 * @return     SCategory Clone of current object.
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
	 * @return     SCategoryPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new SCategoryPeer();
		}
		return self::$peer;
	}

	/**
	 * Clears out the collSProductss collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addSProductss()
	 */
	public function clearSProductss()
	{
		$this->collSProductss = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collSProductss collection.
	 *
	 * By default this just sets the collSProductss collection to an empty array (like clearcollSProductss());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initSProductss()
	{
		$this->collSProductss = new PropelObjectCollection();
		$this->collSProductss->setModel('SProducts');
	}

	/**
	 * Gets an array of SProducts objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this SCategory is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array SProducts[] List of SProducts objects
	 * @throws     PropelException
	 */
	public function getSProductss($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collSProductss || null !== $criteria) {
			if ($this->isNew() && null === $this->collSProductss) {
				// return empty collection
				$this->initSProductss();
			} else {
				$collSProductss = SProductsQuery::create(null, $criteria)
					->filterByMainCategory($this)
					->find($con);
				if (null !== $criteria) {
					return $collSProductss;
				}
				$this->collSProductss = $collSProductss;
			}
		}
		return $this->collSProductss;
	}

	/**
	 * Returns the number of related SProducts objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related SProducts objects.
	 * @throws     PropelException
	 */
	public function countSProductss(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collSProductss || null !== $criteria) {
			if ($this->isNew() && null === $this->collSProductss) {
				return 0;
			} else {
				$query = SProductsQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByMainCategory($this)
					->count($con);
			}
		} else {
			return count($this->collSProductss);
		}
	}

	/**
	 * Method called to associate a SProducts object to this object
	 * through the SProducts foreign key attribute.
	 *
	 * @param      SProducts $l SProducts
	 * @return     void
	 * @throws     PropelException
	 */
	public function addSProducts(SProducts $l)
	{
		if ($this->collSProductss === null) {
			$this->initSProductss();
		}
		if (!$this->collSProductss->contains($l)) { // only add it if the **same** object is not already associated
			$this->collSProductss[]= $l;
			$l->setMainCategory($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this SCategory is new, it will return
	 * an empty collection; or if this SCategory has previously
	 * been saved, it will retrieve related SProductss from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in SCategory.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array SProducts[] List of SProducts objects
	 */
	public function getSProductssJoinBrand($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = SProductsQuery::create(null, $criteria);
		$query->joinWith('Brand', $join_behavior);

		return $this->getSProductss($query, $con);
	}

	/**
	 * Clears out the collShopProductCategoriess collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addShopProductCategoriess()
	 */
	public function clearShopProductCategoriess()
	{
		$this->collShopProductCategoriess = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collShopProductCategoriess collection.
	 *
	 * By default this just sets the collShopProductCategoriess collection to an empty array (like clearcollShopProductCategoriess());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initShopProductCategoriess()
	{
		$this->collShopProductCategoriess = new PropelObjectCollection();
		$this->collShopProductCategoriess->setModel('ShopProductCategories');
	}

	/**
	 * Gets an array of ShopProductCategories objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this SCategory is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array ShopProductCategories[] List of ShopProductCategories objects
	 * @throws     PropelException
	 */
	public function getShopProductCategoriess($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collShopProductCategoriess || null !== $criteria) {
			if ($this->isNew() && null === $this->collShopProductCategoriess) {
				// return empty collection
				$this->initShopProductCategoriess();
			} else {
				$collShopProductCategoriess = ShopProductCategoriesQuery::create(null, $criteria)
					->filterByCategory($this)
					->find($con);
				if (null !== $criteria) {
					return $collShopProductCategoriess;
				}
				$this->collShopProductCategoriess = $collShopProductCategoriess;
			}
		}
		return $this->collShopProductCategoriess;
	}

	/**
	 * Returns the number of related ShopProductCategories objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related ShopProductCategories objects.
	 * @throws     PropelException
	 */
	public function countShopProductCategoriess(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collShopProductCategoriess || null !== $criteria) {
			if ($this->isNew() && null === $this->collShopProductCategoriess) {
				return 0;
			} else {
				$query = ShopProductCategoriesQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByCategory($this)
					->count($con);
			}
		} else {
			return count($this->collShopProductCategoriess);
		}
	}

	/**
	 * Method called to associate a ShopProductCategories object to this object
	 * through the ShopProductCategories foreign key attribute.
	 *
	 * @param      ShopProductCategories $l ShopProductCategories
	 * @return     void
	 * @throws     PropelException
	 */
	public function addShopProductCategories(ShopProductCategories $l)
	{
		if ($this->collShopProductCategoriess === null) {
			$this->initShopProductCategoriess();
		}
		if (!$this->collShopProductCategoriess->contains($l)) { // only add it if the **same** object is not already associated
			$this->collShopProductCategoriess[]= $l;
			$l->setCategory($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this SCategory is new, it will return
	 * an empty collection; or if this SCategory has previously
	 * been saved, it will retrieve related ShopProductCategoriess from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in SCategory.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array ShopProductCategories[] List of ShopProductCategories objects
	 */
	public function getShopProductCategoriessJoinProduct($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = ShopProductCategoriesQuery::create(null, $criteria);
		$query->joinWith('Product', $join_behavior);

		return $this->getShopProductCategoriess($query, $con);
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
	 * If this SCategory is new, it will return
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
					->filterByPropertyCategory($this)
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
					->filterByPropertyCategory($this)
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
			$l->setPropertyCategory($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this SCategory is new, it will return
	 * an empty collection; or if this SCategory has previously
	 * been saved, it will retrieve related ShopProductPropertiesCategoriess from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in SCategory.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array ShopProductPropertiesCategories[] List of ShopProductPropertiesCategories objects
	 */
	public function getShopProductPropertiesCategoriessJoinProperty($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = ShopProductPropertiesCategoriesQuery::create(null, $criteria);
		$query->joinWith('Property', $join_behavior);

		return $this->getShopProductPropertiesCategoriess($query, $con);
	}

	/**
	 * Clears out the collProducts collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addProducts()
	 */
	public function clearProducts()
	{
		$this->collProducts = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collProducts collection.
	 *
	 * By default this just sets the collProducts collection to an empty collection (like clearProducts());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initProducts()
	{
		$this->collProducts = new PropelObjectCollection();
		$this->collProducts->setModel('SProducts');
	}

	/**
	 * Gets a collection of SProducts objects related by a many-to-many relationship
	 * to the current object by way of the shop_product_categories cross-reference table.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this SCategory is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria Optional query object to filter the query
	 * @param      PropelPDO $con Optional connection object
	 *
	 * @return     PropelCollection|array SProducts[] List of SProducts objects
	 */
	public function getProducts($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collProducts || null !== $criteria) {
			if ($this->isNew() && null === $this->collProducts) {
				// return empty collection
				$this->initProducts();
			} else {
				$collProducts = SProductsQuery::create(null, $criteria)
					->filterByCategory($this)
					->find($con);
				if (null !== $criteria) {
					return $collProducts;
				}
				$this->collProducts = $collProducts;
			}
		}
		return $this->collProducts;
	}

	/**
	 * Gets the number of SProducts objects related by a many-to-many relationship
	 * to the current object by way of the shop_product_categories cross-reference table.
	 *
	 * @param      Criteria $criteria Optional query object to filter the query
	 * @param      boolean $distinct Set to true to force count distinct
	 * @param      PropelPDO $con Optional connection object
	 *
	 * @return     int the number of related SProducts objects
	 */
	public function countProducts($criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collProducts || null !== $criteria) {
			if ($this->isNew() && null === $this->collProducts) {
				return 0;
			} else {
				$query = SProductsQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByCategory($this)
					->count($con);
			}
		} else {
			return count($this->collProducts);
		}
	}

	/**
	 * Associate a SProducts object to this object
	 * through the shop_product_categories cross reference table.
	 *
	 * @param      SProducts $sProducts The ShopProductCategories object to relate
	 * @return     void
	 */
	public function addProduct($sProducts)
	{
		if ($this->collProducts === null) {
			$this->initProducts();
		}
		if (!$this->collProducts->contains($sProducts)) { // only add it if the **same** object is not already associated
			$shopProductCategories = new ShopProductCategories();
			$shopProductCategories->setProduct($sProducts);
			$this->addShopProductCategories($shopProductCategories);
			
			$this->collProducts[]= $sProducts;
		}
	}

	/**
	 * Clears out the collPropertys collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addPropertys()
	 */
	public function clearPropertys()
	{
		$this->collPropertys = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collPropertys collection.
	 *
	 * By default this just sets the collPropertys collection to an empty collection (like clearPropertys());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initPropertys()
	{
		$this->collPropertys = new PropelObjectCollection();
		$this->collPropertys->setModel('SProperties');
	}

	/**
	 * Gets a collection of SProperties objects related by a many-to-many relationship
	 * to the current object by way of the shop_product_properties_categories cross-reference table.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this SCategory is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria Optional query object to filter the query
	 * @param      PropelPDO $con Optional connection object
	 *
	 * @return     PropelCollection|array SProperties[] List of SProperties objects
	 */
	public function getPropertys($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collPropertys || null !== $criteria) {
			if ($this->isNew() && null === $this->collPropertys) {
				// return empty collection
				$this->initPropertys();
			} else {
				$collPropertys = SPropertiesQuery::create(null, $criteria)
					->filterByPropertyCategory($this)
					->find($con);
				if (null !== $criteria) {
					return $collPropertys;
				}
				$this->collPropertys = $collPropertys;
			}
		}
		return $this->collPropertys;
	}

	/**
	 * Gets the number of SProperties objects related by a many-to-many relationship
	 * to the current object by way of the shop_product_properties_categories cross-reference table.
	 *
	 * @param      Criteria $criteria Optional query object to filter the query
	 * @param      boolean $distinct Set to true to force count distinct
	 * @param      PropelPDO $con Optional connection object
	 *
	 * @return     int the number of related SProperties objects
	 */
	public function countPropertys($criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collPropertys || null !== $criteria) {
			if ($this->isNew() && null === $this->collPropertys) {
				return 0;
			} else {
				$query = SPropertiesQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByPropertyCategory($this)
					->count($con);
			}
		} else {
			return count($this->collPropertys);
		}
	}

	/**
	 * Associate a SProperties object to this object
	 * through the shop_product_properties_categories cross reference table.
	 *
	 * @param      SProperties $sProperties The ShopProductPropertiesCategories object to relate
	 * @return     void
	 */
	public function addProperty($sProperties)
	{
		if ($this->collPropertys === null) {
			$this->initPropertys();
		}
		if (!$this->collPropertys->contains($sProperties)) { // only add it if the **same** object is not already associated
			$shopProductPropertiesCategories = new ShopProductPropertiesCategories();
			$shopProductPropertiesCategories->setProperty($sProperties);
			$this->addShopProductPropertiesCategories($shopProductPropertiesCategories);
			
			$this->collPropertys[]= $sProperties;
		}
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->id = null;
		$this->name = null;
		$this->url = null;
		$this->description = null;
		$this->meta_desc = null;
		$this->meta_title = null;
		$this->parent_id = null;
		$this->position = null;
		$this->full_path = null;
		$this->full_path_ids = null;
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
			if ($this->collSProductss) {
				foreach ((array) $this->collSProductss as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collShopProductCategoriess) {
				foreach ((array) $this->collShopProductCategoriess as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collShopProductPropertiesCategoriess) {
				foreach ((array) $this->collShopProductPropertiesCategoriess as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collSProductss = null;
		$this->collShopProductCategoriess = null;
		$this->collShopProductPropertiesCategoriess = null;
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

} // BaseSCategory
