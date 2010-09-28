<?php


/**
 * Base class that represents a row from the 'shop_products' table.
 *
 * 
 *
 * @package    propel.generator.Shop.om
 */
abstract class BaseSProducts extends ShopBaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
  const PEER = 'SProductsPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        SProductsPeer
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
	 * The value for the price field.
	 * @var        string
	 */
	protected $price;

	/**
	 * The value for the stock field.
	 * @var        int
	 */
	protected $stock;

	/**
	 * The value for the number field.
	 * @var        string
	 */
	protected $number;

	/**
	 * The value for the active field.
	 * @var        boolean
	 */
	protected $active;

	/**
	 * The value for the hit field.
	 * @var        boolean
	 */
	protected $hit;

	/**
	 * The value for the brand_id field.
	 * @var        int
	 */
	protected $brand_id;

	/**
	 * The value for the category_id field.
	 * @var        int
	 */
	protected $category_id;

	/**
	 * The value for the related_products field.
	 * @var        string
	 */
	protected $related_products;

	/**
	 * The value for the mainimage field.
	 * @var        boolean
	 */
	protected $mainimage;

	/**
	 * The value for the smallimage field.
	 * @var        boolean
	 */
	protected $smallimage;

	/**
	 * The value for the short_description field.
	 * @var        string
	 */
	protected $short_description;

	/**
	 * The value for the full_description field.
	 * @var        string
	 */
	protected $full_description;

	/**
	 * The value for the meta_title field.
	 * @var        string
	 */
	protected $meta_title;

	/**
	 * The value for the meta_description field.
	 * @var        string
	 */
	protected $meta_description;

	/**
	 * The value for the meta_keywords field.
	 * @var        string
	 */
	protected $meta_keywords;

	/**
	 * The value for the created field.
	 * @var        int
	 */
	protected $created;

	/**
	 * The value for the updated field.
	 * @var        int
	 */
	protected $updated;

	/**
	 * @var        SBrands
	 */
	protected $aBrand;

	/**
	 * @var        SCategory
	 */
	protected $aMainCategory;

	/**
	 * @var        array SProductVariants[] Collection to store aggregation of SProductVariants objects.
	 */
	protected $collProductVariants;

	/**
	 * @var        array ShopProductCategories[] Collection to store aggregation of ShopProductCategories objects.
	 */
	protected $collShopProductCategoriess;

	/**
	 * @var        array SProductPropertiesData[] Collection to store aggregation of SProductPropertiesData objects.
	 */
	protected $collSProductPropertiesDatas;

	/**
	 * @var        array SCategory[] Collection to store aggregation of SCategory objects.
	 */
	protected $collCategorys;

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
	 * Get the [price] column value.
	 * 
	 * @return     string
	 */
	public function getPrice()
	{
		return $this->price;
	}

	/**
	 * Get the [stock] column value.
	 * 
	 * @return     int
	 */
	public function getStock()
	{
		return $this->stock;
	}

	/**
	 * Get the [number] column value.
	 * 
	 * @return     string
	 */
	public function getNumber()
	{
		return $this->number;
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
	 * Get the [hit] column value.
	 * 
	 * @return     boolean
	 */
	public function getHit()
	{
		return $this->hit;
	}

	/**
	 * Get the [brand_id] column value.
	 * 
	 * @return     int
	 */
	public function getBrandId()
	{
		return $this->brand_id;
	}

	/**
	 * Get the [category_id] column value.
	 * 
	 * @return     int
	 */
	public function getCategoryId()
	{
		return $this->category_id;
	}

	/**
	 * Get the [related_products] column value.
	 * 
	 * @return     string
	 */
	public function getRelatedProducts()
	{
		return $this->related_products;
	}

	/**
	 * Get the [mainimage] column value.
	 * 
	 * @return     boolean
	 */
	public function getMainimage()
	{
		return $this->mainimage;
	}

	/**
	 * Get the [smallimage] column value.
	 * 
	 * @return     boolean
	 */
	public function getSmallimage()
	{
		return $this->smallimage;
	}

	/**
	 * Get the [short_description] column value.
	 * 
	 * @return     string
	 */
	public function getShortDescription()
	{
		return $this->short_description;
	}

	/**
	 * Get the [full_description] column value.
	 * 
	 * @return     string
	 */
	public function getFullDescription()
	{
		return $this->full_description;
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
	 * Get the [meta_description] column value.
	 * 
	 * @return     string
	 */
	public function getMetaDescription()
	{
		return $this->meta_description;
	}

	/**
	 * Get the [meta_keywords] column value.
	 * 
	 * @return     string
	 */
	public function getMetaKeywords()
	{
		return $this->meta_keywords;
	}

	/**
	 * Get the [created] column value.
	 * 
	 * @return     int
	 */
	public function getCreated()
	{
		return $this->created;
	}

	/**
	 * Get the [updated] column value.
	 * 
	 * @return     int
	 */
	public function getUpdated()
	{
		return $this->updated;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     SProducts The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = SProductsPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [name] column.
	 * 
	 * @param      string $v new value
	 * @return     SProducts The current object (for fluent API support)
	 */
	public function setName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = SProductsPeer::NAME;
		}

		return $this;
	} // setName()

	/**
	 * Set the value of [url] column.
	 * 
	 * @param      string $v new value
	 * @return     SProducts The current object (for fluent API support)
	 */
	public function setUrl($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->url !== $v) {
			$this->url = $v;
			$this->modifiedColumns[] = SProductsPeer::URL;
		}

		return $this;
	} // setUrl()

	/**
	 * Set the value of [price] column.
	 * 
	 * @param      string $v new value
	 * @return     SProducts The current object (for fluent API support)
	 */
	public function setPrice($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->price !== $v) {
			$this->price = $v;
			$this->modifiedColumns[] = SProductsPeer::PRICE;
		}

		return $this;
	} // setPrice()

	/**
	 * Set the value of [stock] column.
	 * 
	 * @param      int $v new value
	 * @return     SProducts The current object (for fluent API support)
	 */
	public function setStock($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->stock !== $v) {
			$this->stock = $v;
			$this->modifiedColumns[] = SProductsPeer::STOCK;
		}

		return $this;
	} // setStock()

	/**
	 * Set the value of [number] column.
	 * 
	 * @param      string $v new value
	 * @return     SProducts The current object (for fluent API support)
	 */
	public function setNumber($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->number !== $v) {
			$this->number = $v;
			$this->modifiedColumns[] = SProductsPeer::NUMBER;
		}

		return $this;
	} // setNumber()

	/**
	 * Set the value of [active] column.
	 * 
	 * @param      boolean $v new value
	 * @return     SProducts The current object (for fluent API support)
	 */
	public function setActive($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->active !== $v) {
			$this->active = $v;
			$this->modifiedColumns[] = SProductsPeer::ACTIVE;
		}

		return $this;
	} // setActive()

	/**
	 * Set the value of [hit] column.
	 * 
	 * @param      boolean $v new value
	 * @return     SProducts The current object (for fluent API support)
	 */
	public function setHit($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->hit !== $v) {
			$this->hit = $v;
			$this->modifiedColumns[] = SProductsPeer::HIT;
		}

		return $this;
	} // setHit()

	/**
	 * Set the value of [brand_id] column.
	 * 
	 * @param      int $v new value
	 * @return     SProducts The current object (for fluent API support)
	 */
	public function setBrandId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->brand_id !== $v) {
			$this->brand_id = $v;
			$this->modifiedColumns[] = SProductsPeer::BRAND_ID;
		}

		if ($this->aBrand !== null && $this->aBrand->getId() !== $v) {
			$this->aBrand = null;
		}

		return $this;
	} // setBrandId()

	/**
	 * Set the value of [category_id] column.
	 * 
	 * @param      int $v new value
	 * @return     SProducts The current object (for fluent API support)
	 */
	public function setCategoryId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->category_id !== $v) {
			$this->category_id = $v;
			$this->modifiedColumns[] = SProductsPeer::CATEGORY_ID;
		}

		if ($this->aMainCategory !== null && $this->aMainCategory->getId() !== $v) {
			$this->aMainCategory = null;
		}

		return $this;
	} // setCategoryId()

	/**
	 * Set the value of [related_products] column.
	 * 
	 * @param      string $v new value
	 * @return     SProducts The current object (for fluent API support)
	 */
	public function setRelatedProducts($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->related_products !== $v) {
			$this->related_products = $v;
			$this->modifiedColumns[] = SProductsPeer::RELATED_PRODUCTS;
		}

		return $this;
	} // setRelatedProducts()

	/**
	 * Set the value of [mainimage] column.
	 * 
	 * @param      boolean $v new value
	 * @return     SProducts The current object (for fluent API support)
	 */
	public function setMainimage($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->mainimage !== $v) {
			$this->mainimage = $v;
			$this->modifiedColumns[] = SProductsPeer::MAINIMAGE;
		}

		return $this;
	} // setMainimage()

	/**
	 * Set the value of [smallimage] column.
	 * 
	 * @param      boolean $v new value
	 * @return     SProducts The current object (for fluent API support)
	 */
	public function setSmallimage($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->smallimage !== $v) {
			$this->smallimage = $v;
			$this->modifiedColumns[] = SProductsPeer::SMALLIMAGE;
		}

		return $this;
	} // setSmallimage()

	/**
	 * Set the value of [short_description] column.
	 * 
	 * @param      string $v new value
	 * @return     SProducts The current object (for fluent API support)
	 */
	public function setShortDescription($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->short_description !== $v) {
			$this->short_description = $v;
			$this->modifiedColumns[] = SProductsPeer::SHORT_DESCRIPTION;
		}

		return $this;
	} // setShortDescription()

	/**
	 * Set the value of [full_description] column.
	 * 
	 * @param      string $v new value
	 * @return     SProducts The current object (for fluent API support)
	 */
	public function setFullDescription($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->full_description !== $v) {
			$this->full_description = $v;
			$this->modifiedColumns[] = SProductsPeer::FULL_DESCRIPTION;
		}

		return $this;
	} // setFullDescription()

	/**
	 * Set the value of [meta_title] column.
	 * 
	 * @param      string $v new value
	 * @return     SProducts The current object (for fluent API support)
	 */
	public function setMetaTitle($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->meta_title !== $v) {
			$this->meta_title = $v;
			$this->modifiedColumns[] = SProductsPeer::META_TITLE;
		}

		return $this;
	} // setMetaTitle()

	/**
	 * Set the value of [meta_description] column.
	 * 
	 * @param      string $v new value
	 * @return     SProducts The current object (for fluent API support)
	 */
	public function setMetaDescription($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->meta_description !== $v) {
			$this->meta_description = $v;
			$this->modifiedColumns[] = SProductsPeer::META_DESCRIPTION;
		}

		return $this;
	} // setMetaDescription()

	/**
	 * Set the value of [meta_keywords] column.
	 * 
	 * @param      string $v new value
	 * @return     SProducts The current object (for fluent API support)
	 */
	public function setMetaKeywords($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->meta_keywords !== $v) {
			$this->meta_keywords = $v;
			$this->modifiedColumns[] = SProductsPeer::META_KEYWORDS;
		}

		return $this;
	} // setMetaKeywords()

	/**
	 * Set the value of [created] column.
	 * 
	 * @param      int $v new value
	 * @return     SProducts The current object (for fluent API support)
	 */
	public function setCreated($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->created !== $v) {
			$this->created = $v;
			$this->modifiedColumns[] = SProductsPeer::CREATED;
		}

		return $this;
	} // setCreated()

	/**
	 * Set the value of [updated] column.
	 * 
	 * @param      int $v new value
	 * @return     SProducts The current object (for fluent API support)
	 */
	public function setUpdated($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->updated !== $v) {
			$this->updated = $v;
			$this->modifiedColumns[] = SProductsPeer::UPDATED;
		}

		return $this;
	} // setUpdated()

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
			$this->price = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->stock = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
			$this->number = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->active = ($row[$startcol + 6] !== null) ? (boolean) $row[$startcol + 6] : null;
			$this->hit = ($row[$startcol + 7] !== null) ? (boolean) $row[$startcol + 7] : null;
			$this->brand_id = ($row[$startcol + 8] !== null) ? (int) $row[$startcol + 8] : null;
			$this->category_id = ($row[$startcol + 9] !== null) ? (int) $row[$startcol + 9] : null;
			$this->related_products = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->mainimage = ($row[$startcol + 11] !== null) ? (boolean) $row[$startcol + 11] : null;
			$this->smallimage = ($row[$startcol + 12] !== null) ? (boolean) $row[$startcol + 12] : null;
			$this->short_description = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
			$this->full_description = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
			$this->meta_title = ($row[$startcol + 15] !== null) ? (string) $row[$startcol + 15] : null;
			$this->meta_description = ($row[$startcol + 16] !== null) ? (string) $row[$startcol + 16] : null;
			$this->meta_keywords = ($row[$startcol + 17] !== null) ? (string) $row[$startcol + 17] : null;
			$this->created = ($row[$startcol + 18] !== null) ? (int) $row[$startcol + 18] : null;
			$this->updated = ($row[$startcol + 19] !== null) ? (int) $row[$startcol + 19] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 20; // 20 = SProductsPeer::NUM_COLUMNS - SProductsPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating SProducts object", $e);
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

		if ($this->aBrand !== null && $this->brand_id !== $this->aBrand->getId()) {
			$this->aBrand = null;
		}
		if ($this->aMainCategory !== null && $this->category_id !== $this->aMainCategory->getId()) {
			$this->aMainCategory = null;
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
			$con = Propel::getConnection(SProductsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = SProductsPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aBrand = null;
			$this->aMainCategory = null;
			$this->collProductVariants = null;

			$this->collShopProductCategoriess = null;

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
			$con = Propel::getConnection(SProductsPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			if ($ret) {
				SProductsQuery::create()
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
			$con = Propel::getConnection(SProductsPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				SProductsPeer::addInstanceToPool($this);
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

			if ($this->aBrand !== null) {
				if ($this->aBrand->isModified() || $this->aBrand->isNew()) {
					$affectedRows += $this->aBrand->save($con);
				}
				$this->setBrand($this->aBrand);
			}

			if ($this->aMainCategory !== null) {
				if ($this->aMainCategory->isModified() || $this->aMainCategory->isNew()) {
					$affectedRows += $this->aMainCategory->save($con);
				}
				$this->setMainCategory($this->aMainCategory);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = SProductsPeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$criteria = $this->buildCriteria();
					if ($criteria->keyContainsValue(SProductsPeer::ID) ) {
						throw new PropelException('Cannot insert a value for auto-increment primary key ('.SProductsPeer::ID.')');
					}

					$pk = BasePeer::doInsert($criteria, $con);
					$affectedRows += 1;
					$this->setId($pk);  //[IMV] update autoincrement primary key
					$this->setNew(false);
				} else {
					$affectedRows += SProductsPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collProductVariants !== null) {
				foreach ($this->collProductVariants as $referrerFK) {
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


			// We call the validate method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aBrand !== null) {
				if (!$this->aBrand->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aBrand->getValidationFailures());
				}
			}

			if ($this->aMainCategory !== null) {
				if (!$this->aMainCategory->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aMainCategory->getValidationFailures());
				}
			}


			if (($retval = SProductsPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collProductVariants !== null) {
					foreach ($this->collProductVariants as $referrerFK) {
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
		$pos = SProductsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getPrice();
				break;
			case 4:
				return $this->getStock();
				break;
			case 5:
				return $this->getNumber();
				break;
			case 6:
				return $this->getActive();
				break;
			case 7:
				return $this->getHit();
				break;
			case 8:
				return $this->getBrandId();
				break;
			case 9:
				return $this->getCategoryId();
				break;
			case 10:
				return $this->getRelatedProducts();
				break;
			case 11:
				return $this->getMainimage();
				break;
			case 12:
				return $this->getSmallimage();
				break;
			case 13:
				return $this->getShortDescription();
				break;
			case 14:
				return $this->getFullDescription();
				break;
			case 15:
				return $this->getMetaTitle();
				break;
			case 16:
				return $this->getMetaDescription();
				break;
			case 17:
				return $this->getMetaKeywords();
				break;
			case 18:
				return $this->getCreated();
				break;
			case 19:
				return $this->getUpdated();
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
		$keys = SProductsPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getName(),
			$keys[2] => $this->getUrl(),
			$keys[3] => $this->getPrice(),
			$keys[4] => $this->getStock(),
			$keys[5] => $this->getNumber(),
			$keys[6] => $this->getActive(),
			$keys[7] => $this->getHit(),
			$keys[8] => $this->getBrandId(),
			$keys[9] => $this->getCategoryId(),
			$keys[10] => $this->getRelatedProducts(),
			$keys[11] => $this->getMainimage(),
			$keys[12] => $this->getSmallimage(),
			$keys[13] => $this->getShortDescription(),
			$keys[14] => $this->getFullDescription(),
			$keys[15] => $this->getMetaTitle(),
			$keys[16] => $this->getMetaDescription(),
			$keys[17] => $this->getMetaKeywords(),
			$keys[18] => $this->getCreated(),
			$keys[19] => $this->getUpdated(),
		);
		if ($includeForeignObjects) {
			if (null !== $this->aBrand) {
				$result['Brand'] = $this->aBrand->toArray($keyType, $includeLazyLoadColumns, true);
			}
			if (null !== $this->aMainCategory) {
				$result['MainCategory'] = $this->aMainCategory->toArray($keyType, $includeLazyLoadColumns, true);
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
		$pos = SProductsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setPrice($value);
				break;
			case 4:
				$this->setStock($value);
				break;
			case 5:
				$this->setNumber($value);
				break;
			case 6:
				$this->setActive($value);
				break;
			case 7:
				$this->setHit($value);
				break;
			case 8:
				$this->setBrandId($value);
				break;
			case 9:
				$this->setCategoryId($value);
				break;
			case 10:
				$this->setRelatedProducts($value);
				break;
			case 11:
				$this->setMainimage($value);
				break;
			case 12:
				$this->setSmallimage($value);
				break;
			case 13:
				$this->setShortDescription($value);
				break;
			case 14:
				$this->setFullDescription($value);
				break;
			case 15:
				$this->setMetaTitle($value);
				break;
			case 16:
				$this->setMetaDescription($value);
				break;
			case 17:
				$this->setMetaKeywords($value);
				break;
			case 18:
				$this->setCreated($value);
				break;
			case 19:
				$this->setUpdated($value);
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
		$keys = SProductsPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setUrl($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setPrice($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setStock($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setNumber($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setActive($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setHit($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setBrandId($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCategoryId($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setRelatedProducts($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setMainimage($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setSmallimage($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setShortDescription($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setFullDescription($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setMetaTitle($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setMetaDescription($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setMetaKeywords($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setCreated($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setUpdated($arr[$keys[19]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(SProductsPeer::DATABASE_NAME);

		if ($this->isColumnModified(SProductsPeer::ID)) $criteria->add(SProductsPeer::ID, $this->id);
		if ($this->isColumnModified(SProductsPeer::NAME)) $criteria->add(SProductsPeer::NAME, $this->name);
		if ($this->isColumnModified(SProductsPeer::URL)) $criteria->add(SProductsPeer::URL, $this->url);
		if ($this->isColumnModified(SProductsPeer::PRICE)) $criteria->add(SProductsPeer::PRICE, $this->price);
		if ($this->isColumnModified(SProductsPeer::STOCK)) $criteria->add(SProductsPeer::STOCK, $this->stock);
		if ($this->isColumnModified(SProductsPeer::NUMBER)) $criteria->add(SProductsPeer::NUMBER, $this->number);
		if ($this->isColumnModified(SProductsPeer::ACTIVE)) $criteria->add(SProductsPeer::ACTIVE, $this->active);
		if ($this->isColumnModified(SProductsPeer::HIT)) $criteria->add(SProductsPeer::HIT, $this->hit);
		if ($this->isColumnModified(SProductsPeer::BRAND_ID)) $criteria->add(SProductsPeer::BRAND_ID, $this->brand_id);
		if ($this->isColumnModified(SProductsPeer::CATEGORY_ID)) $criteria->add(SProductsPeer::CATEGORY_ID, $this->category_id);
		if ($this->isColumnModified(SProductsPeer::RELATED_PRODUCTS)) $criteria->add(SProductsPeer::RELATED_PRODUCTS, $this->related_products);
		if ($this->isColumnModified(SProductsPeer::MAINIMAGE)) $criteria->add(SProductsPeer::MAINIMAGE, $this->mainimage);
		if ($this->isColumnModified(SProductsPeer::SMALLIMAGE)) $criteria->add(SProductsPeer::SMALLIMAGE, $this->smallimage);
		if ($this->isColumnModified(SProductsPeer::SHORT_DESCRIPTION)) $criteria->add(SProductsPeer::SHORT_DESCRIPTION, $this->short_description);
		if ($this->isColumnModified(SProductsPeer::FULL_DESCRIPTION)) $criteria->add(SProductsPeer::FULL_DESCRIPTION, $this->full_description);
		if ($this->isColumnModified(SProductsPeer::META_TITLE)) $criteria->add(SProductsPeer::META_TITLE, $this->meta_title);
		if ($this->isColumnModified(SProductsPeer::META_DESCRIPTION)) $criteria->add(SProductsPeer::META_DESCRIPTION, $this->meta_description);
		if ($this->isColumnModified(SProductsPeer::META_KEYWORDS)) $criteria->add(SProductsPeer::META_KEYWORDS, $this->meta_keywords);
		if ($this->isColumnModified(SProductsPeer::CREATED)) $criteria->add(SProductsPeer::CREATED, $this->created);
		if ($this->isColumnModified(SProductsPeer::UPDATED)) $criteria->add(SProductsPeer::UPDATED, $this->updated);

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
		$criteria = new Criteria(SProductsPeer::DATABASE_NAME);
		$criteria->add(SProductsPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of SProducts (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{
		$copyObj->setName($this->name);
		$copyObj->setUrl($this->url);
		$copyObj->setPrice($this->price);
		$copyObj->setStock($this->stock);
		$copyObj->setNumber($this->number);
		$copyObj->setActive($this->active);
		$copyObj->setHit($this->hit);
		$copyObj->setBrandId($this->brand_id);
		$copyObj->setCategoryId($this->category_id);
		$copyObj->setRelatedProducts($this->related_products);
		$copyObj->setMainimage($this->mainimage);
		$copyObj->setSmallimage($this->smallimage);
		$copyObj->setShortDescription($this->short_description);
		$copyObj->setFullDescription($this->full_description);
		$copyObj->setMetaTitle($this->meta_title);
		$copyObj->setMetaDescription($this->meta_description);
		$copyObj->setMetaKeywords($this->meta_keywords);
		$copyObj->setCreated($this->created);
		$copyObj->setUpdated($this->updated);

		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getProductVariants() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addProductVariant($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getShopProductCategoriess() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addShopProductCategories($relObj->copy($deepCopy));
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
	 * @return     SProducts Clone of current object.
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
	 * @return     SProductsPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new SProductsPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a SBrands object.
	 *
	 * @param      SBrands $v
	 * @return     SProducts The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setBrand(SBrands $v = null)
	{
		if ($v === null) {
			$this->setBrandId(NULL);
		} else {
			$this->setBrandId($v->getId());
		}

		$this->aBrand = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the SBrands object, it will not be re-added.
		if ($v !== null) {
			$v->addSProducts($this);
		}

		return $this;
	}


	/**
	 * Get the associated SBrands object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     SBrands The associated SBrands object.
	 * @throws     PropelException
	 */
	public function getBrand(PropelPDO $con = null)
	{
		if ($this->aBrand === null && ($this->brand_id !== null)) {
			$this->aBrand = SBrandsQuery::create()->findPk($this->brand_id, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aBrand->addSProductss($this);
			 */
		}
		return $this->aBrand;
	}

	/**
	 * Declares an association between this object and a SCategory object.
	 *
	 * @param      SCategory $v
	 * @return     SProducts The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setMainCategory(SCategory $v = null)
	{
		if ($v === null) {
			$this->setCategoryId(NULL);
		} else {
			$this->setCategoryId($v->getId());
		}

		$this->aMainCategory = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the SCategory object, it will not be re-added.
		if ($v !== null) {
			$v->addSProducts($this);
		}

		return $this;
	}


	/**
	 * Get the associated SCategory object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     SCategory The associated SCategory object.
	 * @throws     PropelException
	 */
	public function getMainCategory(PropelPDO $con = null)
	{
		if ($this->aMainCategory === null && ($this->category_id !== null)) {
			$this->aMainCategory = SCategoryQuery::create()->findPk($this->category_id, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aMainCategory->addSProductss($this);
			 */
		}
		return $this->aMainCategory;
	}

	/**
	 * Clears out the collProductVariants collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addProductVariants()
	 */
	public function clearProductVariants()
	{
		$this->collProductVariants = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collProductVariants collection.
	 *
	 * By default this just sets the collProductVariants collection to an empty array (like clearcollProductVariants());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initProductVariants()
	{
		$this->collProductVariants = new PropelObjectCollection();
		$this->collProductVariants->setModel('SProductVariants');
	}

	/**
	 * Gets an array of SProductVariants objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this SProducts is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array SProductVariants[] List of SProductVariants objects
	 * @throws     PropelException
	 */
	public function getProductVariants($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collProductVariants || null !== $criteria) {
			if ($this->isNew() && null === $this->collProductVariants) {
				// return empty collection
				$this->initProductVariants();
			} else {
				$collProductVariants = SProductVariantsQuery::create(null, $criteria)
					->filterBySProducts($this)
					->find($con);
				if (null !== $criteria) {
					return $collProductVariants;
				}
				$this->collProductVariants = $collProductVariants;
			}
		}
		return $this->collProductVariants;
	}

	/**
	 * Returns the number of related SProductVariants objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related SProductVariants objects.
	 * @throws     PropelException
	 */
	public function countProductVariants(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collProductVariants || null !== $criteria) {
			if ($this->isNew() && null === $this->collProductVariants) {
				return 0;
			} else {
				$query = SProductVariantsQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterBySProducts($this)
					->count($con);
			}
		} else {
			return count($this->collProductVariants);
		}
	}

	/**
	 * Method called to associate a SProductVariants object to this object
	 * through the SProductVariants foreign key attribute.
	 *
	 * @param      SProductVariants $l SProductVariants
	 * @return     void
	 * @throws     PropelException
	 */
	public function addProductVariant(SProductVariants $l)
	{
		if ($this->collProductVariants === null) {
			$this->initProductVariants();
		}
		if (!$this->collProductVariants->contains($l)) { // only add it if the **same** object is not already associated
			$this->collProductVariants[]= $l;
			$l->setSProducts($this);
		}
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
	 * If this SProducts is new, it will return
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
					->filterByProduct($this)
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
					->filterByProduct($this)
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
			$l->setProduct($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this SProducts is new, it will return
	 * an empty collection; or if this SProducts has previously
	 * been saved, it will retrieve related ShopProductCategoriess from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in SProducts.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array ShopProductCategories[] List of ShopProductCategories objects
	 */
	public function getShopProductCategoriessJoinCategory($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = ShopProductCategoriesQuery::create(null, $criteria);
		$query->joinWith('Category', $join_behavior);

		return $this->getShopProductCategoriess($query, $con);
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
	 * If this SProducts is new, it will return
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
					->filterByProduct($this)
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
					->filterByProduct($this)
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
			$l->setProduct($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this SProducts is new, it will return
	 * an empty collection; or if this SProducts has previously
	 * been saved, it will retrieve related SProductPropertiesDatas from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in SProducts.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array SProductPropertiesData[] List of SProductPropertiesData objects
	 */
	public function getSProductPropertiesDatasJoinSProperties($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = SProductPropertiesDataQuery::create(null, $criteria);
		$query->joinWith('SProperties', $join_behavior);

		return $this->getSProductPropertiesDatas($query, $con);
	}

	/**
	 * Clears out the collCategorys collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addCategorys()
	 */
	public function clearCategorys()
	{
		$this->collCategorys = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collCategorys collection.
	 *
	 * By default this just sets the collCategorys collection to an empty collection (like clearCategorys());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initCategorys()
	{
		$this->collCategorys = new PropelObjectCollection();
		$this->collCategorys->setModel('SCategory');
	}

	/**
	 * Gets a collection of SCategory objects related by a many-to-many relationship
	 * to the current object by way of the shop_product_categories cross-reference table.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this SProducts is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria Optional query object to filter the query
	 * @param      PropelPDO $con Optional connection object
	 *
	 * @return     PropelCollection|array SCategory[] List of SCategory objects
	 */
	public function getCategorys($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collCategorys || null !== $criteria) {
			if ($this->isNew() && null === $this->collCategorys) {
				// return empty collection
				$this->initCategorys();
			} else {
				$collCategorys = SCategoryQuery::create(null, $criteria)
					->filterByProduct($this)
					->find($con);
				if (null !== $criteria) {
					return $collCategorys;
				}
				$this->collCategorys = $collCategorys;
			}
		}
		return $this->collCategorys;
	}

	/**
	 * Gets the number of SCategory objects related by a many-to-many relationship
	 * to the current object by way of the shop_product_categories cross-reference table.
	 *
	 * @param      Criteria $criteria Optional query object to filter the query
	 * @param      boolean $distinct Set to true to force count distinct
	 * @param      PropelPDO $con Optional connection object
	 *
	 * @return     int the number of related SCategory objects
	 */
	public function countCategorys($criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collCategorys || null !== $criteria) {
			if ($this->isNew() && null === $this->collCategorys) {
				return 0;
			} else {
				$query = SCategoryQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByProduct($this)
					->count($con);
			}
		} else {
			return count($this->collCategorys);
		}
	}

	/**
	 * Associate a SCategory object to this object
	 * through the shop_product_categories cross reference table.
	 *
	 * @param      SCategory $sCategory The ShopProductCategories object to relate
	 * @return     void
	 */
	public function addCategory($sCategory)
	{
		if ($this->collCategorys === null) {
			$this->initCategorys();
		}
		if (!$this->collCategorys->contains($sCategory)) { // only add it if the **same** object is not already associated
			$shopProductCategories = new ShopProductCategories();
			$shopProductCategories->setCategory($sCategory);
			$this->addShopProductCategories($shopProductCategories);
			
			$this->collCategorys[]= $sCategory;
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
		$this->price = null;
		$this->stock = null;
		$this->number = null;
		$this->active = null;
		$this->hit = null;
		$this->brand_id = null;
		$this->category_id = null;
		$this->related_products = null;
		$this->mainimage = null;
		$this->smallimage = null;
		$this->short_description = null;
		$this->full_description = null;
		$this->meta_title = null;
		$this->meta_description = null;
		$this->meta_keywords = null;
		$this->created = null;
		$this->updated = null;
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
			if ($this->collProductVariants) {
				foreach ((array) $this->collProductVariants as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collShopProductCategoriess) {
				foreach ((array) $this->collShopProductCategoriess as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collSProductPropertiesDatas) {
				foreach ((array) $this->collSProductPropertiesDatas as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collProductVariants = null;
		$this->collShopProductCategoriess = null;
		$this->collSProductPropertiesDatas = null;
		$this->aBrand = null;
		$this->aMainCategory = null;
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

} // BaseSProducts
