<?php

namespace mod_link\models\Base;

use \Exception;
use \PDO;
use Base\PropelBaseModelClass;
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
use mod_link\models\PageLink as ChildPageLink;
use mod_link\models\PageLinkProduct as ChildPageLinkProduct;
use mod_link\models\PageLinkProductQuery as ChildPageLinkProductQuery;
use mod_link\models\PageLinkQuery as ChildPageLinkQuery;
use mod_link\models\Map\PageLinkProductTableMap;
use mod_link\models\Map\PageLinkTableMap;

/**
 * Base class that represents a row from the 'page_link' table.
 *
 *
 *
 * @package    propel.generator.mod_link.models.Base
 */
abstract class PageLink extends PropelBaseModelClass implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\mod_link\\models\\Map\\PageLinkTableMap';


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
     * The value for the page_id field.
     *
     * @var        int
     */
    protected $page_id;

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
     * The value for the show_on field.
     *
     * @var        boolean
     */
    protected $show_on;

    /**
     * The value for the permanent field.
     *
     * @var        boolean
     */
    protected $permanent;

    /**
     * @var        ObjectCollection|ChildPageLinkProduct[] Collection to store aggregation of ChildPageLinkProduct objects.
     */
    protected $collPageLinkProducts;
    protected $collPageLinkProductsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPageLinkProduct[]
     */
    protected $pageLinkProductsScheduledForDeletion = null;

    /**
     * Initializes internal state of mod_link\models\Base\PageLink object.
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
     * Compares this with another <code>PageLink</code> instance.  If
     * <code>obj</code> is an instance of <code>PageLink</code>, delegates to
     * <code>equals(PageLink)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|PageLink The current object, for fluid interface
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
     * Get the [page_id] column value.
     *
     * @return int
     */
    public function getPageId()
    {
        return $this->page_id;
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
     * Get the [show_on] column value.
     *
     * @return boolean
     */
    public function getShowOn()
    {
        return $this->show_on;
    }

    /**
     * Get the [show_on] column value.
     *
     * @return boolean
     */
    public function isShowOn()
    {
        return $this->getShowOn();
    }

    /**
     * Get the [permanent] column value.
     *
     * @return boolean
     */
    public function getPermanent()
    {
        return $this->permanent;
    }

    /**
     * Get the [permanent] column value.
     *
     * @return boolean
     */
    public function isPermanent()
    {
        return $this->getPermanent();
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return $this|\mod_link\models\PageLink The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[PageLinkTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [page_id] column.
     *
     * @param int $v new value
     * @return $this|\mod_link\models\PageLink The current object (for fluent API support)
     */
    public function setPageId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->page_id !== $v) {
            $this->page_id = $v;
            $this->modifiedColumns[PageLinkTableMap::COL_PAGE_ID] = true;
        }

        return $this;
    } // setPageId()

    /**
     * Set the value of [active_from] column.
     *
     * @param int $v new value
     * @return $this|\mod_link\models\PageLink The current object (for fluent API support)
     */
    public function setActiveFrom($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->active_from !== $v) {
            $this->active_from = $v;
            $this->modifiedColumns[PageLinkTableMap::COL_ACTIVE_FROM] = true;
        }

        return $this;
    } // setActiveFrom()

    /**
     * Set the value of [active_to] column.
     *
     * @param int $v new value
     * @return $this|\mod_link\models\PageLink The current object (for fluent API support)
     */
    public function setActiveTo($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->active_to !== $v) {
            $this->active_to = $v;
            $this->modifiedColumns[PageLinkTableMap::COL_ACTIVE_TO] = true;
        }

        return $this;
    } // setActiveTo()

    /**
     * Sets the value of the [show_on] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\mod_link\models\PageLink The current object (for fluent API support)
     */
    public function setShowOn($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->show_on !== $v) {
            $this->show_on = $v;
            $this->modifiedColumns[PageLinkTableMap::COL_SHOW_ON] = true;
        }

        return $this;
    } // setShowOn()

    /**
     * Sets the value of the [permanent] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\mod_link\models\PageLink The current object (for fluent API support)
     */
    public function setPermanent($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->permanent !== $v) {
            $this->permanent = $v;
            $this->modifiedColumns[PageLinkTableMap::COL_PERMANENT] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : PageLinkTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : PageLinkTableMap::translateFieldName('PageId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->page_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : PageLinkTableMap::translateFieldName('ActiveFrom', TableMap::TYPE_PHPNAME, $indexType)];
            $this->active_from = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : PageLinkTableMap::translateFieldName('ActiveTo', TableMap::TYPE_PHPNAME, $indexType)];
            $this->active_to = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : PageLinkTableMap::translateFieldName('ShowOn', TableMap::TYPE_PHPNAME, $indexType)];
            $this->show_on = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : PageLinkTableMap::translateFieldName('Permanent', TableMap::TYPE_PHPNAME, $indexType)];
            $this->permanent = (null !== $col) ? (boolean) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 6; // 6 = PageLinkTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\mod_link\\models\\PageLink'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(PageLinkTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildPageLinkQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collPageLinkProducts = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see PageLink::setDeleted()
     * @see PageLink::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(PageLinkTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildPageLinkQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(PageLinkTableMap::DATABASE_NAME);
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
                PageLinkTableMap::addInstanceToPool($this);
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

            if ($this->pageLinkProductsScheduledForDeletion !== null) {
                if (!$this->pageLinkProductsScheduledForDeletion->isEmpty()) {
                    \mod_link\models\PageLinkProductQuery::create()
                        ->filterByPrimaryKeys($this->pageLinkProductsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->pageLinkProductsScheduledForDeletion = null;
                }
            }

            if ($this->collPageLinkProducts !== null) {
                foreach ($this->collPageLinkProducts as $referrerFK) {
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

        $this->modifiedColumns[PageLinkTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . PageLinkTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(PageLinkTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(PageLinkTableMap::COL_PAGE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'page_id';
        }
        if ($this->isColumnModified(PageLinkTableMap::COL_ACTIVE_FROM)) {
            $modifiedColumns[':p' . $index++]  = 'active_from';
        }
        if ($this->isColumnModified(PageLinkTableMap::COL_ACTIVE_TO)) {
            $modifiedColumns[':p' . $index++]  = 'active_to';
        }
        if ($this->isColumnModified(PageLinkTableMap::COL_SHOW_ON)) {
            $modifiedColumns[':p' . $index++]  = 'show_on';
        }
        if ($this->isColumnModified(PageLinkTableMap::COL_PERMANENT)) {
            $modifiedColumns[':p' . $index++]  = 'permanent';
        }

        $sql = sprintf(
            'INSERT INTO page_link (%s) VALUES (%s)',
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
                    case 'page_id':
                        $stmt->bindValue($identifier, $this->page_id, PDO::PARAM_INT);
                        break;
                    case 'active_from':
                        $stmt->bindValue($identifier, $this->active_from, PDO::PARAM_INT);
                        break;
                    case 'active_to':
                        $stmt->bindValue($identifier, $this->active_to, PDO::PARAM_INT);
                        break;
                    case 'show_on':
                        $stmt->bindValue($identifier, (int) $this->show_on, PDO::PARAM_INT);
                        break;
                    case 'permanent':
                        $stmt->bindValue($identifier, (int) $this->permanent, PDO::PARAM_INT);
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
        $pos = PageLinkTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getPageId();
                break;
            case 2:
                return $this->getActiveFrom();
                break;
            case 3:
                return $this->getActiveTo();
                break;
            case 4:
                return $this->getShowOn();
                break;
            case 5:
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

        if (isset($alreadyDumpedObjects['PageLink'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['PageLink'][$this->hashCode()] = true;
        $keys = PageLinkTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getPageId(),
            $keys[2] => $this->getActiveFrom(),
            $keys[3] => $this->getActiveTo(),
            $keys[4] => $this->getShowOn(),
            $keys[5] => $this->getPermanent(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collPageLinkProducts) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'pageLinkProducts';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'page_link_products';
                        break;
                    default:
                        $key = 'PageLinkProducts';
                }

                $result[$key] = $this->collPageLinkProducts->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\mod_link\models\PageLink
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = PageLinkTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\mod_link\models\PageLink
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setPageId($value);
                break;
            case 2:
                $this->setActiveFrom($value);
                break;
            case 3:
                $this->setActiveTo($value);
                break;
            case 4:
                $this->setShowOn($value);
                break;
            case 5:
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
        $keys = PageLinkTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setPageId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setActiveFrom($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setActiveTo($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setShowOn($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setPermanent($arr[$keys[5]]);
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
     * @return $this|\mod_link\models\PageLink The current object, for fluid interface
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
        $criteria = new Criteria(PageLinkTableMap::DATABASE_NAME);

        if ($this->isColumnModified(PageLinkTableMap::COL_ID)) {
            $criteria->add(PageLinkTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(PageLinkTableMap::COL_PAGE_ID)) {
            $criteria->add(PageLinkTableMap::COL_PAGE_ID, $this->page_id);
        }
        if ($this->isColumnModified(PageLinkTableMap::COL_ACTIVE_FROM)) {
            $criteria->add(PageLinkTableMap::COL_ACTIVE_FROM, $this->active_from);
        }
        if ($this->isColumnModified(PageLinkTableMap::COL_ACTIVE_TO)) {
            $criteria->add(PageLinkTableMap::COL_ACTIVE_TO, $this->active_to);
        }
        if ($this->isColumnModified(PageLinkTableMap::COL_SHOW_ON)) {
            $criteria->add(PageLinkTableMap::COL_SHOW_ON, $this->show_on);
        }
        if ($this->isColumnModified(PageLinkTableMap::COL_PERMANENT)) {
            $criteria->add(PageLinkTableMap::COL_PERMANENT, $this->permanent);
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
        $criteria = ChildPageLinkQuery::create();
        $criteria->add(PageLinkTableMap::COL_ID, $this->id);

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
     * @param      object $copyObj An object of \mod_link\models\PageLink (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setPageId($this->getPageId());
        $copyObj->setActiveFrom($this->getActiveFrom());
        $copyObj->setActiveTo($this->getActiveTo());
        $copyObj->setShowOn($this->getShowOn());
        $copyObj->setPermanent($this->getPermanent());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getPageLinkProducts() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPageLinkProduct($relObj->copy($deepCopy));
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
     * @return \mod_link\models\PageLink Clone of current object.
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
        if ('PageLinkProduct' == $relationName) {
            return $this->initPageLinkProducts();
        }
    }

    /**
     * Clears out the collPageLinkProducts collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPageLinkProducts()
     */
    public function clearPageLinkProducts()
    {
        $this->collPageLinkProducts = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collPageLinkProducts collection loaded partially.
     */
    public function resetPartialPageLinkProducts($v = true)
    {
        $this->collPageLinkProductsPartial = $v;
    }

    /**
     * Initializes the collPageLinkProducts collection.
     *
     * By default this just sets the collPageLinkProducts collection to an empty array (like clearcollPageLinkProducts());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPageLinkProducts($overrideExisting = true)
    {
        if (null !== $this->collPageLinkProducts && !$overrideExisting) {
            return;
        }

        $collectionClassName = PageLinkProductTableMap::getTableMap()->getCollectionClassName();

        $this->collPageLinkProducts = new $collectionClassName;
        $this->collPageLinkProducts->setModel('\mod_link\models\PageLinkProduct');
    }

    /**
     * Gets an array of ChildPageLinkProduct objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPageLink is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildPageLinkProduct[] List of ChildPageLinkProduct objects
     * @throws PropelException
     */
    public function getPageLinkProducts(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collPageLinkProductsPartial && !$this->isNew();
        if (null === $this->collPageLinkProducts || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPageLinkProducts) {
                // return empty collection
                $this->initPageLinkProducts();
            } else {
                $collPageLinkProducts = ChildPageLinkProductQuery::create(null, $criteria)
                    ->filterByPageLink($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPageLinkProductsPartial && count($collPageLinkProducts)) {
                        $this->initPageLinkProducts(false);

                        foreach ($collPageLinkProducts as $obj) {
                            if (false == $this->collPageLinkProducts->contains($obj)) {
                                $this->collPageLinkProducts->append($obj);
                            }
                        }

                        $this->collPageLinkProductsPartial = true;
                    }

                    return $collPageLinkProducts;
                }

                if ($partial && $this->collPageLinkProducts) {
                    foreach ($this->collPageLinkProducts as $obj) {
                        if ($obj->isNew()) {
                            $collPageLinkProducts[] = $obj;
                        }
                    }
                }

                $this->collPageLinkProducts = $collPageLinkProducts;
                $this->collPageLinkProductsPartial = false;
            }
        }

        return $this->collPageLinkProducts;
    }

    /**
     * Sets a collection of ChildPageLinkProduct objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $pageLinkProducts A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildPageLink The current object (for fluent API support)
     */
    public function setPageLinkProducts(Collection $pageLinkProducts, ConnectionInterface $con = null)
    {
        /** @var ChildPageLinkProduct[] $pageLinkProductsToDelete */
        $pageLinkProductsToDelete = $this->getPageLinkProducts(new Criteria(), $con)->diff($pageLinkProducts);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->pageLinkProductsScheduledForDeletion = clone $pageLinkProductsToDelete;

        foreach ($pageLinkProductsToDelete as $pageLinkProductRemoved) {
            $pageLinkProductRemoved->setPageLink(null);
        }

        $this->collPageLinkProducts = null;
        foreach ($pageLinkProducts as $pageLinkProduct) {
            $this->addPageLinkProduct($pageLinkProduct);
        }

        $this->collPageLinkProducts = $pageLinkProducts;
        $this->collPageLinkProductsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related PageLinkProduct objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related PageLinkProduct objects.
     * @throws PropelException
     */
    public function countPageLinkProducts(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collPageLinkProductsPartial && !$this->isNew();
        if (null === $this->collPageLinkProducts || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPageLinkProducts) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPageLinkProducts());
            }

            $query = ChildPageLinkProductQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPageLink($this)
                ->count($con);
        }

        return count($this->collPageLinkProducts);
    }

    /**
     * Method called to associate a ChildPageLinkProduct object to this object
     * through the ChildPageLinkProduct foreign key attribute.
     *
     * @param  ChildPageLinkProduct $l ChildPageLinkProduct
     * @return $this|\mod_link\models\PageLink The current object (for fluent API support)
     */
    public function addPageLinkProduct(ChildPageLinkProduct $l)
    {
        if ($this->collPageLinkProducts === null) {
            $this->initPageLinkProducts();
            $this->collPageLinkProductsPartial = true;
        }

        if (!$this->collPageLinkProducts->contains($l)) {
            $this->doAddPageLinkProduct($l);

            if ($this->pageLinkProductsScheduledForDeletion and $this->pageLinkProductsScheduledForDeletion->contains($l)) {
                $this->pageLinkProductsScheduledForDeletion->remove($this->pageLinkProductsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildPageLinkProduct $pageLinkProduct The ChildPageLinkProduct object to add.
     */
    protected function doAddPageLinkProduct(ChildPageLinkProduct $pageLinkProduct)
    {
        $this->collPageLinkProducts[]= $pageLinkProduct;
        $pageLinkProduct->setPageLink($this);
    }

    /**
     * @param  ChildPageLinkProduct $pageLinkProduct The ChildPageLinkProduct object to remove.
     * @return $this|ChildPageLink The current object (for fluent API support)
     */
    public function removePageLinkProduct(ChildPageLinkProduct $pageLinkProduct)
    {
        if ($this->getPageLinkProducts()->contains($pageLinkProduct)) {
            $pos = $this->collPageLinkProducts->search($pageLinkProduct);
            $this->collPageLinkProducts->remove($pos);
            if (null === $this->pageLinkProductsScheduledForDeletion) {
                $this->pageLinkProductsScheduledForDeletion = clone $this->collPageLinkProducts;
                $this->pageLinkProductsScheduledForDeletion->clear();
            }
            $this->pageLinkProductsScheduledForDeletion[]= clone $pageLinkProduct;
            $pageLinkProduct->setPageLink(null);
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
        $this->page_id = null;
        $this->active_from = null;
        $this->active_to = null;
        $this->show_on = null;
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
            if ($this->collPageLinkProducts) {
                foreach ($this->collPageLinkProducts as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collPageLinkProducts = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(PageLinkTableMap::DEFAULT_STRING_FORMAT);
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
