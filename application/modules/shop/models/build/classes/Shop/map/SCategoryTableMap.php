<?php



/**
 * This class defines the structure of the 'shop_category' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.Shop.map
 */
class SCategoryTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'Shop.map.SCategoryTableMap';

	/**
	 * Initialize the table attributes, columns and validators
	 * Relations are not initialized by this method since they are lazy loaded
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function initialize()
	{
	  // attributes
		$this->setName('shop_category');
		$this->setPhpName('SCategory');
		$this->setClassname('SCategory');
		$this->setPackage('Shop');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('NAME', 'Name', 'VARCHAR', true, 255, null);
		$this->addColumn('URL', 'Url', 'VARCHAR', true, 255, null);
		$this->addColumn('DESCRIPTION', 'Description', 'LONGVARCHAR', false, null, null);
		$this->addColumn('META_DESC', 'MetaDesc', 'VARCHAR', true, 255, null);
		$this->addColumn('META_TITLE', 'MetaTitle', 'VARCHAR', true, 255, null);
		$this->addColumn('PARENT_ID', 'ParentId', 'INTEGER', false, null, null);
		$this->addColumn('POSITION', 'Position', 'INTEGER', false, null, null);
		$this->addColumn('FULL_PATH', 'FullPath', 'VARCHAR', false, 1000, null);
		$this->addColumn('FULL_PATH_IDS', 'FullPathIds', 'VARCHAR', false, 250, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('SProducts', 'SProducts', RelationMap::ONE_TO_MANY, array('id' => 'category_id', ), null, null);
    $this->addRelation('ShopProductCategories', 'ShopProductCategories', RelationMap::ONE_TO_MANY, array('id' => 'category_id', ), 'CASCADE', null);
    $this->addRelation('ShopProductPropertiesCategories', 'ShopProductPropertiesCategories', RelationMap::ONE_TO_MANY, array('id' => 'category_id', ), 'CASCADE', null);
    $this->addRelation('Product', 'SProducts', RelationMap::MANY_TO_MANY, array(), 'CASCADE', null);
    $this->addRelation('Property', 'SProperties', RelationMap::MANY_TO_MANY, array(), 'CASCADE', null);
	} // buildRelations()

} // SCategoryTableMap
