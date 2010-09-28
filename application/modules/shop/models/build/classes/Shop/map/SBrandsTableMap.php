<?php



/**
 * This class defines the structure of the 'shop_brands' table.
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
class SBrandsTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'Shop.map.SBrandsTableMap';

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
		$this->setName('shop_brands');
		$this->setPhpName('SBrands');
		$this->setClassname('SBrands');
		$this->setPackage('Shop');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('NAME', 'Name', 'VARCHAR', true, 500, null);
		$this->addColumn('URL', 'Url', 'VARCHAR', true, 255, null);
		$this->addColumn('DESCRIPTION', 'Description', 'LONGVARCHAR', false, null, null);
		$this->addColumn('META_TITLE', 'MetaTitle', 'VARCHAR', false, 255, null);
		$this->addColumn('META_DESCRIPTION', 'MetaDescription', 'VARCHAR', false, 255, null);
		$this->addColumn('META_KEYWORDS', 'MetaKeywords', 'VARCHAR', false, 255, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('SProducts', 'SProducts', RelationMap::ONE_TO_MANY, array('id' => 'brand_id', ), null, null);
	} // buildRelations()

} // SBrandsTableMap
