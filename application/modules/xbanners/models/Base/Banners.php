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
use xbanners\models\BannerImageQuery as ChildBannerImageQuery;
use xbanners\models\Banners as ChildBanners;
use xbanners\models\BannersI18n as ChildBannersI18n;
use xbanners\models\BannersI18nQuery as ChildBannersI18nQuery;
use xbanners\models\BannersQuery as ChildBannersQuery;
use xbanners\models\Map\BannerImageTableMap;
use xbanners\models\Map\BannersI18nTableMap;
use xbanners\models\Map\BannersTableMap;

/**
 * Base class that represents a row from the 'banners' table.
 *
 *
 *
 * @package    propel.generator.xbanners.models.Base
 */
abstract class Banners extends PropelBaseModelClass implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\xbanners\\models\\Map\\BannersTableMap';


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
     * The value for the place field.
     *
     * @var        string
     */
    protected $place;

    /**
     * The value for the width field.
     *
     * @var        int
     */
    protected $width;

    /**
     * The value for the height field.
     *
     * @var        int
     */
    protected $height;

    /**
     * The value for the effects field.
     *
     * @var        string
     */
    protected $effects;

    /**
     * The value for the page_type field.
     *
     * @var        string
     */
    protected $page_type;

    /**
     * @var        ObjectCollection|ChildBannerImage[] Collection to store aggregation of ChildBannerImage objects.
     */
    protected $collBannerImages;
    protected $collBannerImagesPartial;

    /**
     * @var        ObjectCollection|ChildBannersI18n[] Collection to store aggregation of ChildBannersI18n objects.
     */
    protected $collBannersI18ns;
    protected $collBannersI18nsPartial;

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
     * @var        array[ChildBannersI18n]
     */
    protected $currentTranslations;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildBannerImage[]
     */
    protected $bannerImagesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildBannersI18n[]
     */
    protected $bannersI18nsScheduledForDeletion = null;

    /**
     * Initializes internal state of xbanners\models\Base\Banners object.
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
     * Compares this with another <code>Banners</code> instance.  If
     * <code>obj</code> is an instance of <code>Banners</code>, delegates to
     * <code>equals(Banners)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Banners The current object, for fluid interface
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
     * Get the [place] column value.
     *
     * @return string
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * Get the [width] column value.
     *
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Get the [height] column value.
     *
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Get the [effects] column value.
     *
     * @return string
     */
    public function getEffects()
    {
        return $this->effects;
    }

    /**
     * Get the [page_type] column value.
     *
     * @return string
     */
    public function getPageType()
    {
        return $this->page_type;
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return $this|\xbanners\models\Banners The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[BannersTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [place] column.
     *
     * @param string $v new value
     * @return $this|\xbanners\models\Banners The current object (for fluent API support)
     */
    public function setPlace($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->place !== $v) {
            $this->place = $v;
            $this->modifiedColumns[BannersTableMap::COL_PLACE] = true;
        }

        return $this;
    } // setPlace()

    /**
     * Set the value of [width] column.
     *
     * @param int $v new value
     * @return $this|\xbanners\models\Banners The current object (for fluent API support)
     */
    public function setWidth($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->width !== $v) {
            $this->width = $v;
            $this->modifiedColumns[BannersTableMap::COL_WIDTH] = true;
        }

        return $this;
    } // setWidth()

    /**
     * Set the value of [height] column.
     *
     * @param int $v new value
     * @return $this|\xbanners\models\Banners The current object (for fluent API support)
     */
    public function setHeight($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->height !== $v) {
            $this->height = $v;
            $this->modifiedColumns[BannersTableMap::COL_HEIGHT] = true;
        }

        return $this;
    } // setHeight()

    /**
     * Set the value of [effects] column.
     *
     * @param string $v new value
     * @return $this|\xbanners\models\Banners The current object (for fluent API support)
     */
    public function setEffects($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->effects !== $v) {
            $this->effects = $v;
            $this->modifiedColumns[BannersTableMap::COL_EFFECTS] = true;
        }

        return $this;
    } // setEffects()

    /**
     * Set the value of [page_type] column.
     *
     * @param string $v new value
     * @return $this|\xbanners\models\Banners The current object (for fluent API support)
     */
    public function setPageType($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->page_type !== $v) {
            $this->page_type = $v;
            $this->modifiedColumns[BannersTableMap::COL_PAGE_TYPE] = true;
        }

        return $this;
    } // setPageType()

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : BannersTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : BannersTableMap::translateFieldName('Place', TableMap::TYPE_PHPNAME, $indexType)];
            $this->place = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : BannersTableMap::translateFieldName('Width', TableMap::TYPE_PHPNAME, $indexType)];
            $this->width = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : BannersTableMap::translateFieldName('Height', TableMap::TYPE_PHPNAME, $indexType)];
            $this->height = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : BannersTableMap::translateFieldName('Effects', TableMap::TYPE_PHPNAME, $indexType)];
            $this->effects = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : BannersTableMap::translateFieldName('PageType', TableMap::TYPE_PHPNAME, $indexType)];
            $this->page_type = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 6; // 6 = BannersTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\xbanners\\models\\Banners'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(BannersTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildBannersQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collBannerImages = null;

            $this->collBannersI18ns = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Banners::setDeleted()
     * @see Banners::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(BannersTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildBannersQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(BannersTableMap::DATABASE_NAME);
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
                BannersTableMap::addInstanceToPool($this);
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

            if ($this->bannerImagesScheduledForDeletion !== null) {
                if (!$this->bannerImagesScheduledForDeletion->isEmpty()) {
                    \xbanners\models\BannerImageQuery::create()
                        ->filterByPrimaryKeys($this->bannerImagesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->bannerImagesScheduledForDeletion = null;
                }
            }

            if ($this->collBannerImages !== null) {
                foreach ($this->collBannerImages as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->bannersI18nsScheduledForDeletion !== null) {
                if (!$this->bannersI18nsScheduledForDeletion->isEmpty()) {
                    \xbanners\models\BannersI18nQuery::create()
                        ->filterByPrimaryKeys($this->bannersI18nsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->bannersI18nsScheduledForDeletion = null;
                }
            }

            if ($this->collBannersI18ns !== null) {
                foreach ($this->collBannersI18ns as $referrerFK) {
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

        $this->modifiedColumns[BannersTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . BannersTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(BannersTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(BannersTableMap::COL_PLACE)) {
            $modifiedColumns[':p' . $index++]  = 'place';
        }
        if ($this->isColumnModified(BannersTableMap::COL_WIDTH)) {
            $modifiedColumns[':p' . $index++]  = 'width';
        }
        if ($this->isColumnModified(BannersTableMap::COL_HEIGHT)) {
            $modifiedColumns[':p' . $index++]  = 'height';
        }
        if ($this->isColumnModified(BannersTableMap::COL_EFFECTS)) {
            $modifiedColumns[':p' . $index++]  = 'effects';
        }
        if ($this->isColumnModified(BannersTableMap::COL_PAGE_TYPE)) {
            $modifiedColumns[':p' . $index++]  = 'page_type';
        }

        $sql = sprintf(
            'INSERT INTO banners (%s) VALUES (%s)',
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
                    case 'place':
                        $stmt->bindValue($identifier, $this->place, PDO::PARAM_STR);
                        break;
                    case 'width':
                        $stmt->bindValue($identifier, $this->width, PDO::PARAM_INT);
                        break;
                    case 'height':
                        $stmt->bindValue($identifier, $this->height, PDO::PARAM_INT);
                        break;
                    case 'effects':
                        $stmt->bindValue($identifier, $this->effects, PDO::PARAM_STR);
                        break;
                    case 'page_type':
                        $stmt->bindValue($identifier, $this->page_type, PDO::PARAM_STR);
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
        $pos = BannersTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getPlace();
                break;
            case 2:
                return $this->getWidth();
                break;
            case 3:
                return $this->getHeight();
                break;
            case 4:
                return $this->getEffects();
                break;
            case 5:
                return $this->getPageType();
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

        if (isset($alreadyDumpedObjects['Banners'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Banners'][$this->hashCode()] = true;
        $keys = BannersTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getPlace(),
            $keys[2] => $this->getWidth(),
            $keys[3] => $this->getHeight(),
            $keys[4] => $this->getEffects(),
            $keys[5] => $this->getPageType(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collBannerImages) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'bannerImages';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'banner_images';
                        break;
                    default:
                        $key = 'BannerImages';
                }

                $result[$key] = $this->collBannerImages->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collBannersI18ns) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'bannersI18ns';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'banners_i18ns';
                        break;
                    default:
                        $key = 'BannersI18ns';
                }

                $result[$key] = $this->collBannersI18ns->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\xbanners\models\Banners
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = BannersTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\xbanners\models\Banners
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setPlace($value);
                break;
            case 2:
                $this->setWidth($value);
                break;
            case 3:
                $this->setHeight($value);
                break;
            case 4:
                $this->setEffects($value);
                break;
            case 5:
                $this->setPageType($value);
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
        $keys = BannersTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setPlace($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setWidth($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setHeight($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setEffects($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setPageType($arr[$keys[5]]);
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
     * @return $this|\xbanners\models\Banners The current object, for fluid interface
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
        $criteria = new Criteria(BannersTableMap::DATABASE_NAME);

        if ($this->isColumnModified(BannersTableMap::COL_ID)) {
            $criteria->add(BannersTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(BannersTableMap::COL_PLACE)) {
            $criteria->add(BannersTableMap::COL_PLACE, $this->place);
        }
        if ($this->isColumnModified(BannersTableMap::COL_WIDTH)) {
            $criteria->add(BannersTableMap::COL_WIDTH, $this->width);
        }
        if ($this->isColumnModified(BannersTableMap::COL_HEIGHT)) {
            $criteria->add(BannersTableMap::COL_HEIGHT, $this->height);
        }
        if ($this->isColumnModified(BannersTableMap::COL_EFFECTS)) {
            $criteria->add(BannersTableMap::COL_EFFECTS, $this->effects);
        }
        if ($this->isColumnModified(BannersTableMap::COL_PAGE_TYPE)) {
            $criteria->add(BannersTableMap::COL_PAGE_TYPE, $this->page_type);
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
        $criteria = ChildBannersQuery::create();
        $criteria->add(BannersTableMap::COL_ID, $this->id);

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
     * @param      object $copyObj An object of \xbanners\models\Banners (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setPlace($this->getPlace());
        $copyObj->setWidth($this->getWidth());
        $copyObj->setHeight($this->getHeight());
        $copyObj->setEffects($this->getEffects());
        $copyObj->setPageType($this->getPageType());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getBannerImages() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBannerImage($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getBannersI18ns() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBannersI18n($relObj->copy($deepCopy));
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
     * @return \xbanners\models\Banners Clone of current object.
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
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('BannerImage' == $relationName) {
            return $this->initBannerImages();
        }
        if ('BannersI18n' == $relationName) {
            return $this->initBannersI18ns();
        }
    }

    /**
     * Clears out the collBannerImages collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addBannerImages()
     */
    public function clearBannerImages()
    {
        $this->collBannerImages = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collBannerImages collection loaded partially.
     */
    public function resetPartialBannerImages($v = true)
    {
        $this->collBannerImagesPartial = $v;
    }

    /**
     * Initializes the collBannerImages collection.
     *
     * By default this just sets the collBannerImages collection to an empty array (like clearcollBannerImages());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBannerImages($overrideExisting = true)
    {
        if (null !== $this->collBannerImages && !$overrideExisting) {
            return;
        }

        $collectionClassName = BannerImageTableMap::getTableMap()->getCollectionClassName();

        $this->collBannerImages = new $collectionClassName;
        $this->collBannerImages->setModel('\xbanners\models\BannerImage');
    }

    /**
     * Gets an array of ChildBannerImage objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildBanners is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildBannerImage[] List of ChildBannerImage objects
     * @throws PropelException
     */
    public function getBannerImages(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collBannerImagesPartial && !$this->isNew();
        if (null === $this->collBannerImages || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collBannerImages) {
                // return empty collection
                $this->initBannerImages();
            } else {
                $collBannerImages = ChildBannerImageQuery::create(null, $criteria)
                    ->filterByBanners($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collBannerImagesPartial && count($collBannerImages)) {
                        $this->initBannerImages(false);

                        foreach ($collBannerImages as $obj) {
                            if (false == $this->collBannerImages->contains($obj)) {
                                $this->collBannerImages->append($obj);
                            }
                        }

                        $this->collBannerImagesPartial = true;
                    }

                    return $collBannerImages;
                }

                if ($partial && $this->collBannerImages) {
                    foreach ($this->collBannerImages as $obj) {
                        if ($obj->isNew()) {
                            $collBannerImages[] = $obj;
                        }
                    }
                }

                $this->collBannerImages = $collBannerImages;
                $this->collBannerImagesPartial = false;
            }
        }

        return $this->collBannerImages;
    }

    /**
     * Sets a collection of ChildBannerImage objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $bannerImages A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildBanners The current object (for fluent API support)
     */
    public function setBannerImages(Collection $bannerImages, ConnectionInterface $con = null)
    {
        /** @var ChildBannerImage[] $bannerImagesToDelete */
        $bannerImagesToDelete = $this->getBannerImages(new Criteria(), $con)->diff($bannerImages);


        $this->bannerImagesScheduledForDeletion = $bannerImagesToDelete;

        foreach ($bannerImagesToDelete as $bannerImageRemoved) {
            $bannerImageRemoved->setBanners(null);
        }

        $this->collBannerImages = null;
        foreach ($bannerImages as $bannerImage) {
            $this->addBannerImage($bannerImage);
        }

        $this->collBannerImages = $bannerImages;
        $this->collBannerImagesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BannerImage objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related BannerImage objects.
     * @throws PropelException
     */
    public function countBannerImages(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collBannerImagesPartial && !$this->isNew();
        if (null === $this->collBannerImages || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBannerImages) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBannerImages());
            }

            $query = ChildBannerImageQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByBanners($this)
                ->count($con);
        }

        return count($this->collBannerImages);
    }

    /**
     * Method called to associate a ChildBannerImage object to this object
     * through the ChildBannerImage foreign key attribute.
     *
     * @param  ChildBannerImage $l ChildBannerImage
     * @return $this|\xbanners\models\Banners The current object (for fluent API support)
     */
    public function addBannerImage(ChildBannerImage $l)
    {
        if ($this->collBannerImages === null) {
            $this->initBannerImages();
            $this->collBannerImagesPartial = true;
        }

        if (!$this->collBannerImages->contains($l)) {
            $this->doAddBannerImage($l);

            if ($this->bannerImagesScheduledForDeletion and $this->bannerImagesScheduledForDeletion->contains($l)) {
                $this->bannerImagesScheduledForDeletion->remove($this->bannerImagesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildBannerImage $bannerImage The ChildBannerImage object to add.
     */
    protected function doAddBannerImage(ChildBannerImage $bannerImage)
    {
        $this->collBannerImages[]= $bannerImage;
        $bannerImage->setBanners($this);
    }

    /**
     * @param  ChildBannerImage $bannerImage The ChildBannerImage object to remove.
     * @return $this|ChildBanners The current object (for fluent API support)
     */
    public function removeBannerImage(ChildBannerImage $bannerImage)
    {
        if ($this->getBannerImages()->contains($bannerImage)) {
            $pos = $this->collBannerImages->search($bannerImage);
            $this->collBannerImages->remove($pos);
            if (null === $this->bannerImagesScheduledForDeletion) {
                $this->bannerImagesScheduledForDeletion = clone $this->collBannerImages;
                $this->bannerImagesScheduledForDeletion->clear();
            }
            $this->bannerImagesScheduledForDeletion[]= clone $bannerImage;
            $bannerImage->setBanners(null);
        }

        return $this;
    }

    /**
     * Clears out the collBannersI18ns collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addBannersI18ns()
     */
    public function clearBannersI18ns()
    {
        $this->collBannersI18ns = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collBannersI18ns collection loaded partially.
     */
    public function resetPartialBannersI18ns($v = true)
    {
        $this->collBannersI18nsPartial = $v;
    }

    /**
     * Initializes the collBannersI18ns collection.
     *
     * By default this just sets the collBannersI18ns collection to an empty array (like clearcollBannersI18ns());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBannersI18ns($overrideExisting = true)
    {
        if (null !== $this->collBannersI18ns && !$overrideExisting) {
            return;
        }

        $collectionClassName = BannersI18nTableMap::getTableMap()->getCollectionClassName();

        $this->collBannersI18ns = new $collectionClassName;
        $this->collBannersI18ns->setModel('\xbanners\models\BannersI18n');
    }

    /**
     * Gets an array of ChildBannersI18n objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildBanners is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildBannersI18n[] List of ChildBannersI18n objects
     * @throws PropelException
     */
    public function getBannersI18ns(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collBannersI18nsPartial && !$this->isNew();
        if (null === $this->collBannersI18ns || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collBannersI18ns) {
                // return empty collection
                $this->initBannersI18ns();
            } else {
                $collBannersI18ns = ChildBannersI18nQuery::create(null, $criteria)
                    ->filterByBanners($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collBannersI18nsPartial && count($collBannersI18ns)) {
                        $this->initBannersI18ns(false);

                        foreach ($collBannersI18ns as $obj) {
                            if (false == $this->collBannersI18ns->contains($obj)) {
                                $this->collBannersI18ns->append($obj);
                            }
                        }

                        $this->collBannersI18nsPartial = true;
                    }

                    return $collBannersI18ns;
                }

                if ($partial && $this->collBannersI18ns) {
                    foreach ($this->collBannersI18ns as $obj) {
                        if ($obj->isNew()) {
                            $collBannersI18ns[] = $obj;
                        }
                    }
                }

                $this->collBannersI18ns = $collBannersI18ns;
                $this->collBannersI18nsPartial = false;
            }
        }

        return $this->collBannersI18ns;
    }

    /**
     * Sets a collection of ChildBannersI18n objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $bannersI18ns A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildBanners The current object (for fluent API support)
     */
    public function setBannersI18ns(Collection $bannersI18ns, ConnectionInterface $con = null)
    {
        /** @var ChildBannersI18n[] $bannersI18nsToDelete */
        $bannersI18nsToDelete = $this->getBannersI18ns(new Criteria(), $con)->diff($bannersI18ns);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->bannersI18nsScheduledForDeletion = clone $bannersI18nsToDelete;

        foreach ($bannersI18nsToDelete as $bannersI18nRemoved) {
            $bannersI18nRemoved->setBanners(null);
        }

        $this->collBannersI18ns = null;
        foreach ($bannersI18ns as $bannersI18n) {
            $this->addBannersI18n($bannersI18n);
        }

        $this->collBannersI18ns = $bannersI18ns;
        $this->collBannersI18nsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BannersI18n objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related BannersI18n objects.
     * @throws PropelException
     */
    public function countBannersI18ns(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collBannersI18nsPartial && !$this->isNew();
        if (null === $this->collBannersI18ns || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBannersI18ns) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBannersI18ns());
            }

            $query = ChildBannersI18nQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByBanners($this)
                ->count($con);
        }

        return count($this->collBannersI18ns);
    }

    /**
     * Method called to associate a ChildBannersI18n object to this object
     * through the ChildBannersI18n foreign key attribute.
     *
     * @param  ChildBannersI18n $l ChildBannersI18n
     * @return $this|\xbanners\models\Banners The current object (for fluent API support)
     */
    public function addBannersI18n(ChildBannersI18n $l)
    {
        if ($l && $locale = $l->getLocale()) {
            $this->setLocale($locale);
            $this->currentTranslations[$locale] = $l;
        }
        if ($this->collBannersI18ns === null) {
            $this->initBannersI18ns();
            $this->collBannersI18nsPartial = true;
        }

        if (!$this->collBannersI18ns->contains($l)) {
            $this->doAddBannersI18n($l);

            if ($this->bannersI18nsScheduledForDeletion and $this->bannersI18nsScheduledForDeletion->contains($l)) {
                $this->bannersI18nsScheduledForDeletion->remove($this->bannersI18nsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildBannersI18n $bannersI18n The ChildBannersI18n object to add.
     */
    protected function doAddBannersI18n(ChildBannersI18n $bannersI18n)
    {
        $this->collBannersI18ns[]= $bannersI18n;
        $bannersI18n->setBanners($this);
    }

    /**
     * @param  ChildBannersI18n $bannersI18n The ChildBannersI18n object to remove.
     * @return $this|ChildBanners The current object (for fluent API support)
     */
    public function removeBannersI18n(ChildBannersI18n $bannersI18n)
    {
        if ($this->getBannersI18ns()->contains($bannersI18n)) {
            $pos = $this->collBannersI18ns->search($bannersI18n);
            $this->collBannersI18ns->remove($pos);
            if (null === $this->bannersI18nsScheduledForDeletion) {
                $this->bannersI18nsScheduledForDeletion = clone $this->collBannersI18ns;
                $this->bannersI18nsScheduledForDeletion->clear();
            }
            $this->bannersI18nsScheduledForDeletion[]= clone $bannersI18n;
            $bannersI18n->setBanners(null);
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
        $this->id = null;
        $this->place = null;
        $this->width = null;
        $this->height = null;
        $this->effects = null;
        $this->page_type = null;
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
            if ($this->collBannerImages) {
                foreach ($this->collBannerImages as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collBannersI18ns) {
                foreach ($this->collBannersI18ns as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        // i18n behavior
        $this->currentLocale = 'ru';
        $this->currentTranslations = null;

        $this->collBannerImages = null;
        $this->collBannersI18ns = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(BannersTableMap::DEFAULT_STRING_FORMAT);
    }

    // i18n behavior

    /**
     * Sets the locale for translations
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     *
     * @return    $this|ChildBanners The current object (for fluent API support)
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
     * @return ChildBannersI18n */
    public function getTranslation($locale = 'ru', ConnectionInterface $con = null)
    {
        if (!isset($this->currentTranslations[$locale])) {
            if (null !== $this->collBannersI18ns) {
                foreach ($this->collBannersI18ns as $translation) {
                    if ($translation->getLocale() == $locale) {
                        $this->currentTranslations[$locale] = $translation;

                        return $translation;
                    }
                }
            }
            if ($this->isNew()) {
                $translation = new ChildBannersI18n();
                $translation->setLocale($locale);
            } else {
                $translation = ChildBannersI18nQuery::create()
                    ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                    ->findOneOrCreate($con);
                $this->currentTranslations[$locale] = $translation;
            }
            $this->addBannersI18n($translation);
        }

        return $this->currentTranslations[$locale];
    }

    /**
     * Remove the translation for a given locale
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return    $this|ChildBanners The current object (for fluent API support)
     */
    public function removeTranslation($locale = 'ru', ConnectionInterface $con = null)
    {
        if (!$this->isNew()) {
            ChildBannersI18nQuery::create()
                ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                ->delete($con);
        }
        if (isset($this->currentTranslations[$locale])) {
            unset($this->currentTranslations[$locale]);
        }
        foreach ($this->collBannersI18ns as $key => $translation) {
            if ($translation->getLocale() == $locale) {
                unset($this->collBannersI18ns[$key]);
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
     * @return ChildBannersI18n */
    public function getCurrentTranslation(ConnectionInterface $con = null)
    {
        return $this->getTranslation($this->getLocale(), $con);
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
         * @return $this|\xbanners\models\BannersI18n The current object (for fluent API support)
         */
        public function setName($v)
        {    $this->getCurrentTranslation()->setName($v);

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
