<?php

namespace xbanners\models\Base;

use \Exception;
use \PDO;
use CMSFactory\PropelBaseModelClass;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use xbanners\models\BannerImage as ChildBannerImage;
use xbanners\models\BannerImageI18n as ChildBannerImageI18n;
use xbanners\models\BannerImageI18nQuery as ChildBannerImageI18nQuery;
use xbanners\models\BannerImageQuery as ChildBannerImageQuery;
use xbanners\models\Banners as ChildBanners;
use xbanners\models\BannersQuery as ChildBannersQuery;
use xbanners\models\Map\BannerImageI18nTableMap;
use xbanners\models\Map\BannerImageTableMap;

/**
 * Base class that represents a row from the 'banner_image' table.
 *
 *
 *
 * @package    propel.generator.xbanners.models.Base
 */
abstract class BannerImage extends PropelBaseModelClass implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\xbanners\\models\\Map\\BannerImageTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the id field.
     *
     * @var        int
     */
    protected $id;

    /**
     * The value for the banner_id field.
     *
     * @var        int
     */
    protected $banner_id;

    /**
     * The value for the target field.
     *
     * @var        int
     */
    protected $target;

    /**
     * The value for the url field.
     *
     * @var        string
     */
    protected $url;

    /**
     * The value for the allowed_page field.
     *
     * @var        int
     */
    protected $allowed_page;

    /**
     * The value for the position field.
     *
     * @var        int
     */
    protected $position;

    /**
     * The value for the active_from field.
     *
     * @var        int
     */
    protected $active_from;

    /**
     * The value for the active_to field.
     *
     * @var        int
     */
    protected $active_to;

    /**
     * The value for the active field.
     *
     * @var        int
     */
    protected $active;

    /**
     * The value for the permanent field.
     *
     * @var        int
     */
    protected $permanent;

    /**
     * @var        ChildBanners
     */
    protected $aBanners;

    /**
     * @var        ObjectCollection|ChildBannerImageI18n[] Collection to store aggregation of ChildBannerImageI18n objects.
     */
    protected $collBannerImageI18ns;
    protected $collBannerImageI18nsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    // i18n behavior

    /**
     * Current locale
     * @var        string
     */
    protected $currentLocale = 'ru';

    /**
     * Current translation objects
     * @var        array[ChildBannerImageI18n]
     */
    protected $currentTranslations;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildBannerImageI18n[]
     */
    protected $bannerImageI18nsScheduledForDeletion = null;

    /**
     * Initializes internal state of xbanners\models\Base\BannerImage object.
     */
    public function __construct()
    {
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>BannerImage</code> instance.  If
     * <code>obj</code> is an instance of <code>BannerImage</code>, delegates to
     * <code>equals(BannerImage)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this|BannerImage The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return boolean
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        return Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [id] column value.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the [banner_id] column value.
     *
     * @return int
     */
    public function getBannerId()
    {
        return $this->banner_id;
    }

    /**
     * Get the [target] column value.
     *
     * @return int
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * Get the [url] column value.
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Get the [allowed_page] column value.
     *
     * @return int
     */
    public function getAllowedPage()
    {
        return $this->allowed_page;
    }

    /**
     * Get the [position] column value.
     *
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Get the [active_from] column value.
     *
     * @return int
     */
    public function getActiveFrom()
    {
        return $this->active_from;
    }

    /**
     * Get the [active_to] column value.
     *
     * @return int
     */
    public function getActiveTo()
    {
        return $this->active_to;
    }

    /**
     * Get the [active] column value.
     *
     * @return int
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Get the [permanent] column value.
     *
     * @return int
     */
    public function getPermanent()
    {
        return $this->permanent;
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return $this|\xbanners\models\BannerImage The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[BannerImageTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [banner_id] column.
     *
     * @param int $v new value
     * @return $this|\xbanners\models\BannerImage The current object (for fluent API support)
     */
    public function setBannerId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->banner_id !== $v) {
            $this->banner_id = $v;
            $this->modifiedColumns[BannerImageTableMap::COL_BANNER_ID] = true;
        }

        if ($this->aBanners !== null && $this->aBanners->getId() !== $v) {
            $this->aBanners = null;
        }

        return $this;
    } // setBannerId()

    /**
     * Set the value of [target] column.
     *
     * @param int $v new value
     * @return $this|\xbanners\models\BannerImage The current object (for fluent API support)
     */
    public function setTarget($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->target !== $v) {
            $this->target = $v;
            $this->modifiedColumns[BannerImageTableMap::COL_TARGET] = true;
        }

        return $this;
    } // setTarget()

    /**
     * Set the value of [url] column.
     *
     * @param string $v new value
     * @return $this|\xbanners\models\BannerImage The current object (for fluent API support)
     */
    public function setUrl($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->url !== $v) {
            $this->url = $v;
            $this->modifiedColumns[BannerImageTableMap::COL_URL] = true;
        }

        return $this;
    } // setUrl()

    /**
     * Set the value of [allowed_page] column.
     *
     * @param int $v new value
     * @return $this|\xbanners\models\BannerImage The current object (for fluent API support)
     */
    public function setAllowedPage($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->allowed_page !== $v) {
            $this->allowed_page = $v;
            $this->modifiedColumns[BannerImageTableMap::COL_ALLOWED_PAGE] = true;
        }

        return $this;
    } // setAllowedPage()

    /**
     * Set the value of [position] column.
     *
     * @param int $v new value
     * @return $this|\xbanners\models\BannerImage The current object (for fluent API support)
     */
    public function setPosition($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->position !== $v) {
            $this->position = $v;
            $this->modifiedColumns[BannerImageTableMap::COL_POSITION] = true;
        }

        return $this;
    } // setPosition()

    /**
     * Set the value of [active_from] column.
     *
     * @param int $v new value
     * @return $this|\xbanners\models\BannerImage The current object (for fluent API support)
     */
    public function setActiveFrom($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->active_from !== $v) {
            $this->active_from = $v;
            $this->modifiedColumns[BannerImageTableMap::COL_ACTIVE_FROM] = true;
        }

        return $this;
    } // setActiveFrom()

    /**
     * Set the value of [active_to] column.
     *
     * @param int $v new value
     * @return $this|\xbanners\models\BannerImage The current object (for fluent API support)
     */
    public function setActiveTo($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->active_to !== $v) {
            $this->active_to = $v;
            $this->modifiedColumns[BannerImageTableMap::COL_ACTIVE_TO] = true;
        }

        return $this;
    } // setActiveTo()

    /**
     * Set the value of [active] column.
     *
     * @param int $v new value
     * @return $this|\xbanners\models\BannerImage The current object (for fluent API support)
     */
    public function setActive($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->active !== $v) {
            $this->active = $v;
            $this->modifiedColumns[BannerImageTableMap::COL_ACTIVE] = true;
        }

        return $this;
    } // setActive()

    /**
     * Set the value of [permanent] column.
     *
     * @param int $v new value
     * @return $this|\xbanners\models\BannerImage The current object (for fluent API support)
     */
    public function setPermanent($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->permanent !== $v) {
            $this->permanent = $v;
            $this->modifiedColumns[BannerImageTableMap::COL_PERMANENT] = true;
        }

        return $this;
    } // setPermanent()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
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
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : BannerImageTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : BannerImageTableMap::translateFieldName('BannerId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->banner_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : BannerImageTableMap::translateFieldName('Target', TableMap::TYPE_PHPNAME, $indexType)];
            $this->target = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : BannerImageTableMap::translateFieldName('Url', TableMap::TYPE_PHPNAME, $indexType)];
            $this->url = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : BannerImageTableMap::translateFieldName('AllowedPage', TableMap::TYPE_PHPNAME, $indexType)];
            $this->allowed_page = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : BannerImageTableMap::translateFieldName('Position', TableMap::TYPE_PHPNAME, $indexType)];
            $this->position = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : BannerImageTableMap::translateFieldName('ActiveFrom', TableMap::TYPE_PHPNAME, $indexType)];
            $this->active_from = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : BannerImageTableMap::translateFieldName('ActiveTo', TableMap::TYPE_PHPNAME, $indexType)];
            $this->active_to = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : BannerImageTableMap::translateFieldName('Active', TableMap::TYPE_PHPNAME, $indexType)];
            $this->active = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : BannerImageTableMap::translateFieldName('Permanent', TableMap::TYPE_PHPNAME, $indexType)];
            $this->permanent = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 10; // 10 = BannerImageTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\xbanners\\models\\BannerImage'), 0, $e);
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
     * @throws PropelException
     */
    public function ensureConsistency()
    {
        if ($this->aBanners !== null && $this->banner_id !== $this->aBanners->getId()) {
            $this->aBanners = null;
        }
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(BannerImageTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildBannerImageQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aBanners = null;
            $this->collBannerImageI18ns = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see BannerImage::setDeleted()
     * @see BannerImage::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(BannerImageTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildBannerImageQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(BannerImageTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
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
                BannerImageTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aBanners !== null) {
                if ($this->aBanners->isModified() || $this->aBanners->isNew()) {
                    $affectedRows += $this->aBanners->save($con);
                }
                $this->setBanners($this->aBanners);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            if ($this->bannerImageI18nsScheduledForDeletion !== null) {
                if (!$this->bannerImageI18nsScheduledForDeletion->isEmpty()) {
                    \xbanners\models\BannerImageI18nQuery::create()
                        ->filterByPrimaryKeys($this->bannerImageI18nsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->bannerImageI18nsScheduledForDeletion = null;
                }
            }

            if ($this->collBannerImageI18ns !== null) {
                foreach ($this->collBannerImageI18ns as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[BannerImageTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . BannerImageTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(BannerImageTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(BannerImageTableMap::COL_BANNER_ID)) {
            $modifiedColumns[':p' . $index++]  = 'banner_id';
        }
        if ($this->isColumnModified(BannerImageTableMap::COL_TARGET)) {
            $modifiedColumns[':p' . $index++]  = 'target';
        }
        if ($this->isColumnModified(BannerImageTableMap::COL_URL)) {
            $modifiedColumns[':p' . $index++]  = 'url';
        }
        if ($this->isColumnModified(BannerImageTableMap::COL_ALLOWED_PAGE)) {
            $modifiedColumns[':p' . $index++]  = 'allowed_page';
        }
        if ($this->isColumnModified(BannerImageTableMap::COL_POSITION)) {
            $modifiedColumns[':p' . $index++]  = 'position';
        }
        if ($this->isColumnModified(BannerImageTableMap::COL_ACTIVE_FROM)) {
            $modifiedColumns[':p' . $index++]  = 'active_from';
        }
        if ($this->isColumnModified(BannerImageTableMap::COL_ACTIVE_TO)) {
            $modifiedColumns[':p' . $index++]  = 'active_to';
        }
        if ($this->isColumnModified(BannerImageTableMap::COL_ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = 'active';
        }
        if ($this->isColumnModified(BannerImageTableMap::COL_PERMANENT)) {
            $modifiedColumns[':p' . $index++]  = 'permanent';
        }

        $sql = sprintf(
            'INSERT INTO banner_image (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case 'banner_id':
                        $stmt->bindValue($identifier, $this->banner_id, PDO::PARAM_INT);
                        break;
                    case 'target':
                        $stmt->bindValue($identifier, $this->target, PDO::PARAM_INT);
                        break;
                    case 'url':
                        $stmt->bindValue($identifier, $this->url, PDO::PARAM_STR);
                        break;
                    case 'allowed_page':
                        $stmt->bindValue($identifier, $this->allowed_page, PDO::PARAM_INT);
                        break;
                    case 'position':
                        $stmt->bindValue($identifier, $this->position, PDO::PARAM_INT);
                        break;
                    case 'active_from':
                        $stmt->bindValue($identifier, $this->active_from, PDO::PARAM_INT);
                        break;
                    case 'active_to':
                        $stmt->bindValue($identifier, $this->active_to, PDO::PARAM_INT);
                        break;
                    case 'active':
                        $stmt->bindValue($identifier, $this->active, PDO::PARAM_INT);
                        break;
                    case 'permanent':
                        $stmt->bindValue($identifier, $this->permanent, PDO::PARAM_INT);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = BannerImageTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getId();
                break;
            case 1:
                return $this->getBannerId();
                break;
            case 2:
                return $this->getTarget();
                break;
            case 3:
                return $this->getUrl();
                break;
            case 4:
                return $this->getAllowedPage();
                break;
            case 5:
                return $this->getPosition();
                break;
            case 6:
                return $this->getActiveFrom();
                break;
            case 7:
                return $this->getActiveTo();
                break;
            case 8:
                return $this->getActive();
                break;
            case 9:
                return $this->getPermanent();
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
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {

        if (isset($alreadyDumpedObjects['BannerImage'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['BannerImage'][$this->hashCode()] = true;
        $keys = BannerImageTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getBannerId(),
            $keys[2] => $this->getTarget(),
            $keys[3] => $this->getUrl(),
            $keys[4] => $this->getAllowedPage(),
            $keys[5] => $this->getPosition(),
            $keys[6] => $this->getActiveFrom(),
            $keys[7] => $this->getActiveTo(),
            $keys[8] => $this->getActive(),
            $keys[9] => $this->getPermanent(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aBanners) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'banners';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'banners';
                        break;
                    default:
                        $key = 'Banners';
                }

                $result[$key] = $this->aBanners->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collBannerImageI18ns) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'bannerImageI18ns';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'banner_image_i18ns';
                        break;
                    default:
                        $key = 'BannerImageI18ns';
                }

                $result[$key] = $this->collBannerImageI18ns->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\xbanners\models\BannerImage
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = BannerImageTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\xbanners\models\BannerImage
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setBannerId($value);
                break;
            case 2:
                $this->setTarget($value);
                break;
            case 3:
                $this->setUrl($value);
                break;
            case 4:
                $this->setAllowedPage($value);
                break;
            case 5:
                $this->setPosition($value);
                break;
            case 6:
                $this->setActiveFrom($value);
                break;
            case 7:
                $this->setActiveTo($value);
                break;
            case 8:
                $this->setActive($value);
                break;
            case 9:
                $this->setPermanent($value);
                break;
        } // switch()

        return $this;
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
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = BannerImageTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setBannerId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setTarget($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setUrl($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setAllowedPage($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setPosition($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setActiveFrom($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setActiveTo($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setActive($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setPermanent($arr[$keys[9]]);
        }
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\xbanners\models\BannerImage The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(BannerImageTableMap::DATABASE_NAME);

        if ($this->isColumnModified(BannerImageTableMap::COL_ID)) {
            $criteria->add(BannerImageTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(BannerImageTableMap::COL_BANNER_ID)) {
            $criteria->add(BannerImageTableMap::COL_BANNER_ID, $this->banner_id);
        }
        if ($this->isColumnModified(BannerImageTableMap::COL_TARGET)) {
            $criteria->add(BannerImageTableMap::COL_TARGET, $this->target);
        }
        if ($this->isColumnModified(BannerImageTableMap::COL_URL)) {
            $criteria->add(BannerImageTableMap::COL_URL, $this->url);
        }
        if ($this->isColumnModified(BannerImageTableMap::COL_ALLOWED_PAGE)) {
            $criteria->add(BannerImageTableMap::COL_ALLOWED_PAGE, $this->allowed_page);
        }
        if ($this->isColumnModified(BannerImageTableMap::COL_POSITION)) {
            $criteria->add(BannerImageTableMap::COL_POSITION, $this->position);
        }
        if ($this->isColumnModified(BannerImageTableMap::COL_ACTIVE_FROM)) {
            $criteria->add(BannerImageTableMap::COL_ACTIVE_FROM, $this->active_from);
        }
        if ($this->isColumnModified(BannerImageTableMap::COL_ACTIVE_TO)) {
            $criteria->add(BannerImageTableMap::COL_ACTIVE_TO, $this->active_to);
        }
        if ($this->isColumnModified(BannerImageTableMap::COL_ACTIVE)) {
            $criteria->add(BannerImageTableMap::COL_ACTIVE, $this->active);
        }
        if ($this->isColumnModified(BannerImageTableMap::COL_PERMANENT)) {
            $criteria->add(BannerImageTableMap::COL_PERMANENT, $this->permanent);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildBannerImageQuery::create();
        $criteria->add(BannerImageTableMap::COL_ID, $this->id);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getId();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
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
     * @param      object $copyObj An object of \xbanners\models\BannerImage (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setBannerId($this->getBannerId());
        $copyObj->setTarget($this->getTarget());
        $copyObj->setUrl($this->getUrl());
        $copyObj->setAllowedPage($this->getAllowedPage());
        $copyObj->setPosition($this->getPosition());
        $copyObj->setActiveFrom($this->getActiveFrom());
        $copyObj->setActiveTo($this->getActiveTo());
        $copyObj->setActive($this->getActive());
        $copyObj->setPermanent($this->getPermanent());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getBannerImageI18ns() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBannerImageI18n($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \xbanners\models\BannerImage Clone of current object.
     * @throws PropelException
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
     * Declares an association between this object and a ChildBanners object.
     *
     * @param  ChildBanners $v
     * @return $this|\xbanners\models\BannerImage The current object (for fluent API support)
     * @throws PropelException
     */
    public function setBanners(ChildBanners $v = null)
    {
        if ($v === null) {
            $this->setBannerId(NULL);
        } else {
            $this->setBannerId($v->getId());
        }

        $this->aBanners = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildBanners object, it will not be re-added.
        if ($v !== null) {
            $v->addBannerImage($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildBanners object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildBanners The associated ChildBanners object.
     * @throws PropelException
     */
    public function getBanners(ConnectionInterface $con = null)
    {
        if ($this->aBanners === null && ($this->banner_id !== null)) {
            $this->aBanners = ChildBannersQuery::create()->findPk($this->banner_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aBanners->addBannerImages($this);
             */
        }

        return $this->aBanners;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('BannerImageI18n' == $relationName) {
            return $this->initBannerImageI18ns();
        }
    }

    /**
     * Clears out the collBannerImageI18ns collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addBannerImageI18ns()
     */
    public function clearBannerImageI18ns()
    {
        $this->collBannerImageI18ns = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collBannerImageI18ns collection loaded partially.
     */
    public function resetPartialBannerImageI18ns($v = true)
    {
        $this->collBannerImageI18nsPartial = $v;
    }

    /**
     * Initializes the collBannerImageI18ns collection.
     *
     * By default this just sets the collBannerImageI18ns collection to an empty array (like clearcollBannerImageI18ns());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBannerImageI18ns($overrideExisting = true)
    {
        if (null !== $this->collBannerImageI18ns && !$overrideExisting) {
            return;
        }

        $collectionClassName = BannerImageI18nTableMap::getTableMap()->getCollectionClassName();

        $this->collBannerImageI18ns = new $collectionClassName;
        $this->collBannerImageI18ns->setModel('\xbanners\models\BannerImageI18n');
    }

    /**
     * Gets an array of ChildBannerImageI18n objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildBannerImage is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildBannerImageI18n[] List of ChildBannerImageI18n objects
     * @throws PropelException
     */
    public function getBannerImageI18ns(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collBannerImageI18nsPartial && !$this->isNew();
        if (null === $this->collBannerImageI18ns || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collBannerImageI18ns) {
                // return empty collection
                $this->initBannerImageI18ns();
            } else {
                $collBannerImageI18ns = ChildBannerImageI18nQuery::create(null, $criteria)
                    ->filterByBannerImage($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collBannerImageI18nsPartial && count($collBannerImageI18ns)) {
                        $this->initBannerImageI18ns(false);

                        foreach ($collBannerImageI18ns as $obj) {
                            if (false == $this->collBannerImageI18ns->contains($obj)) {
                                $this->collBannerImageI18ns->append($obj);
                            }
                        }

                        $this->collBannerImageI18nsPartial = true;
                    }

                    return $collBannerImageI18ns;
                }

                if ($partial && $this->collBannerImageI18ns) {
                    foreach ($this->collBannerImageI18ns as $obj) {
                        if ($obj->isNew()) {
                            $collBannerImageI18ns[] = $obj;
                        }
                    }
                }

                $this->collBannerImageI18ns = $collBannerImageI18ns;
                $this->collBannerImageI18nsPartial = false;
            }
        }

        return $this->collBannerImageI18ns;
    }

    /**
     * Sets a collection of ChildBannerImageI18n objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $bannerImageI18ns A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildBannerImage The current object (for fluent API support)
     */
    public function setBannerImageI18ns(Collection $bannerImageI18ns, ConnectionInterface $con = null)
    {
        /** @var ChildBannerImageI18n[] $bannerImageI18nsToDelete */
        $bannerImageI18nsToDelete = $this->getBannerImageI18ns(new Criteria(), $con)->diff($bannerImageI18ns);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->bannerImageI18nsScheduledForDeletion = clone $bannerImageI18nsToDelete;

        foreach ($bannerImageI18nsToDelete as $bannerImageI18nRemoved) {
            $bannerImageI18nRemoved->setBannerImage(null);
        }

        $this->collBannerImageI18ns = null;
        foreach ($bannerImageI18ns as $bannerImageI18n) {
            $this->addBannerImageI18n($bannerImageI18n);
        }

        $this->collBannerImageI18ns = $bannerImageI18ns;
        $this->collBannerImageI18nsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BannerImageI18n objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related BannerImageI18n objects.
     * @throws PropelException
     */
    public function countBannerImageI18ns(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collBannerImageI18nsPartial && !$this->isNew();
        if (null === $this->collBannerImageI18ns || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBannerImageI18ns) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBannerImageI18ns());
            }

            $query = ChildBannerImageI18nQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByBannerImage($this)
                ->count($con);
        }

        return count($this->collBannerImageI18ns);
    }

    /**
     * Method called to associate a ChildBannerImageI18n object to this object
     * through the ChildBannerImageI18n foreign key attribute.
     *
     * @param  ChildBannerImageI18n $l ChildBannerImageI18n
     * @return $this|\xbanners\models\BannerImage The current object (for fluent API support)
     */
    public function addBannerImageI18n(ChildBannerImageI18n $l)
    {
        if ($l && $locale = $l->getLocale()) {
            $this->setLocale($locale);
            $this->currentTranslations[$locale] = $l;
        }
        if ($this->collBannerImageI18ns === null) {
            $this->initBannerImageI18ns();
            $this->collBannerImageI18nsPartial = true;
        }

        if (!$this->collBannerImageI18ns->contains($l)) {
            $this->doAddBannerImageI18n($l);

            if ($this->bannerImageI18nsScheduledForDeletion and $this->bannerImageI18nsScheduledForDeletion->contains($l)) {
                $this->bannerImageI18nsScheduledForDeletion->remove($this->bannerImageI18nsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildBannerImageI18n $bannerImageI18n The ChildBannerImageI18n object to add.
     */
    protected function doAddBannerImageI18n(ChildBannerImageI18n $bannerImageI18n)
    {
        $this->collBannerImageI18ns[]= $bannerImageI18n;
        $bannerImageI18n->setBannerImage($this);
    }

    /**
     * @param  ChildBannerImageI18n $bannerImageI18n The ChildBannerImageI18n object to remove.
     * @return $this|ChildBannerImage The current object (for fluent API support)
     */
    public function removeBannerImageI18n(ChildBannerImageI18n $bannerImageI18n)
    {
        if ($this->getBannerImageI18ns()->contains($bannerImageI18n)) {
            $pos = $this->collBannerImageI18ns->search($bannerImageI18n);
            $this->collBannerImageI18ns->remove($pos);
            if (null === $this->bannerImageI18nsScheduledForDeletion) {
                $this->bannerImageI18nsScheduledForDeletion = clone $this->collBannerImageI18ns;
                $this->bannerImageI18nsScheduledForDeletion->clear();
            }
            $this->bannerImageI18nsScheduledForDeletion[]= clone $bannerImageI18n;
            $bannerImageI18n->setBannerImage(null);
        }

        return $this;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aBanners) {
            $this->aBanners->removeBannerImage($this);
        }
        $this->id = null;
        $this->banner_id = null;
        $this->target = null;
        $this->url = null;
        $this->allowed_page = null;
        $this->position = null;
        $this->active_from = null;
        $this->active_to = null;
        $this->active = null;
        $this->permanent = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
            if ($this->collBannerImageI18ns) {
                foreach ($this->collBannerImageI18ns as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        // i18n behavior
        $this->currentLocale = 'ru';
        $this->currentTranslations = null;

        $this->collBannerImageI18ns = null;
        $this->aBanners = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(BannerImageTableMap::DEFAULT_STRING_FORMAT);
    }

    // i18n behavior

    /**
     * Sets the locale for translations
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     *
     * @return    $this|ChildBannerImage The current object (for fluent API support)
     */
    public function setLocale($locale = 'ru')
    {
        $this->currentLocale = $locale;

        return $this;
    }

    /**
     * Gets the locale for translations
     *
     * @return    string $locale Locale to use for the translation, e.g. 'fr_FR'
     */
    public function getLocale()
    {
        return $this->currentLocale;
    }

    /**
     * Returns the current translation for a given locale
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ChildBannerImageI18n */
    public function getTranslation($locale = 'ru', ConnectionInterface $con = null)
    {
        if (!isset($this->currentTranslations[$locale])) {
            if (null !== $this->collBannerImageI18ns) {
                foreach ($this->collBannerImageI18ns as $translation) {
                    if ($translation->getLocale() == $locale) {
                        $this->currentTranslations[$locale] = $translation;

                        return $translation;
                    }
                }
            }
            if ($this->isNew()) {
                $translation = new ChildBannerImageI18n();
                $translation->setLocale($locale);
            } else {
                $translation = ChildBannerImageI18nQuery::create()
                    ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                    ->findOneOrCreate($con);
                $this->currentTranslations[$locale] = $translation;
            }
            $this->addBannerImageI18n($translation);
        }

        return $this->currentTranslations[$locale];
    }

    /**
     * Remove the translation for a given locale
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return    $this|ChildBannerImage The current object (for fluent API support)
     */
    public function removeTranslation($locale = 'ru', ConnectionInterface $con = null)
    {
        if (!$this->isNew()) {
            ChildBannerImageI18nQuery::create()
                ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                ->delete($con);
        }
        if (isset($this->currentTranslations[$locale])) {
            unset($this->currentTranslations[$locale]);
        }
        foreach ($this->collBannerImageI18ns as $key => $translation) {
            if ($translation->getLocale() == $locale) {
                unset($this->collBannerImageI18ns[$key]);
                break;
            }
        }

        return $this;
    }

    /**
     * Returns the current translation
     *
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ChildBannerImageI18n */
    public function getCurrentTranslation(ConnectionInterface $con = null)
    {
        return $this->getTranslation($this->getLocale(), $con);
    }


        /**
         * Get the [src] column value.
         *
         * @return string
         */
        public function getSrc()
        {
        return $this->getCurrentTranslation()->getSrc();
    }


        /**
         * Set the value of [src] column.
         *
         * @param string $v new value
         * @return $this|\xbanners\models\BannerImageI18n The current object (for fluent API support)
         */
        public function setSrc($v)
        {    $this->getCurrentTranslation()->setSrc($v);

        return $this;
    }


        /**
         * Get the [name] column value.
         *
         * @return string
         */
        public function getName()
        {
        return $this->getCurrentTranslation()->getName();
    }


        /**
         * Set the value of [name] column.
         *
         * @param string $v new value
         * @return $this|\xbanners\models\BannerImageI18n The current object (for fluent API support)
         */
        public function setName($v)
        {    $this->getCurrentTranslation()->setName($v);

        return $this;
    }


        /**
         * Get the [clicks] column value.
         *
         * @return int
         */
        public function getClicks()
        {
        return $this->getCurrentTranslation()->getClicks();
    }


        /**
         * Set the value of [clicks] column.
         *
         * @param int $v new value
         * @return $this|\xbanners\models\BannerImageI18n The current object (for fluent API support)
         */
        public function setClicks($v)
        {    $this->getCurrentTranslation()->setClicks($v);

        return $this;
    }


        /**
         * Get the [description] column value.
         *
         * @return string
         */
        public function getDescription()
        {
        return $this->getCurrentTranslation()->getDescription();
    }


        /**
         * Set the value of [description] column.
         *
         * @param string $v new value
         * @return $this|\xbanners\models\BannerImageI18n The current object (for fluent API support)
         */
        public function setDescription($v)
        {    $this->getCurrentTranslation()->setDescription($v);

        return $this;
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preSave')) {
            return parent::preSave($con);
        }
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postSave')) {
            parent::postSave($con);
        }
    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preInsert')) {
            return parent::preInsert($con);
        }
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postInsert')) {
            parent::postInsert($con);
        }
    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preUpdate')) {
            return parent::preUpdate($con);
        }
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postUpdate')) {
            parent::postUpdate($con);
        }
    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preDelete')) {
            return parent::preDelete($con);
        }
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postDelete')) {
            parent::postDelete($con);
        }
    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
