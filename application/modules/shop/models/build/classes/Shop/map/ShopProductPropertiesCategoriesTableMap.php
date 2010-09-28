<?php



/**
 * This class defines the structure of the 'shop_product_properties_categories' table.
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
class ShopProductPropertiesCategoriesTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'Shop.map.ShopProductPropertiesCategoriesTableMap';

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
		$this->setName('shop_product_properties_categories');
		$this->setPhpName('ShopProductPropertiesCategories');
		$this->setClassname('ShopProductPropertiesCategories');
		$this->setPackage('Shop');
		$this->setUseIdGenerator(false);
		// columns
		$this->addForeignPrimaryKey('PROPERTY_ID', 'PropertyId', 'INTEGER' , 'shop_product_properties', 'ID', true, null, null);
		$this->addForeignPrimaryKey('CATEGORY_ID', 'CategoryId', 'INTEGER' , 'shop_category', 'ID', true, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Property', 'SProperties', RelationMap::MANY_TO_ONE, array('property_id' => 'id', ), null, null);
    $this->addRelation('PropertyCategory', 'SCategory', RelationMap::MANY_TO_ONE, array('category_id' => 'id', ), 'CASCADE', null);
	} // buildRelations()

} // ShopProductPropertiesCategoriesTableMap
