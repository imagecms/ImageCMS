<?php



/**
 * This class defines the structure of the 'shop_products' table.
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
class SProductsTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'Shop.map.SProductsTableMap';

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
		$this->setName('shop_products');
		$this->setPhpName('SProducts');
		$this->setClassname('SProducts');
		$this->setPackage('Shop');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('NAME', 'Name', 'VARCHAR', true, 500, null);
		$this->addColumn('URL', 'Url', 'VARCHAR', true, 255, null);
		$this->addColumn('PRICE', 'Price', 'FLOAT', true, null, null);
		$this->addColumn('STOCK', 'Stock', 'INTEGER', false, null, null);
		$this->addColumn('NUMBER', 'Number', 'VARCHAR', false, 255, null);
		$this->addColumn('ACTIVE', 'Active', 'BOOLEAN', false, null, null);
		$this->addColumn('HIT', 'Hit', 'BOOLEAN', false, null, null);
		$this->addForeignKey('BRAND_ID', 'BrandId', 'INTEGER', 'shop_brands', 'ID', false, null, null);
		$this->addForeignKey('CATEGORY_ID', 'CategoryId', 'INTEGER', 'shop_category', 'ID', true, null, null);
		$this->addColumn('RELATED_PRODUCTS', 'RelatedProducts', 'VARCHAR', false, 255, null);
		$this->addColumn('MAINIMAGE', 'Mainimage', 'BOOLEAN', false, null, null);
		$this->addColumn('SMALLIMAGE', 'Smallimage', 'BOOLEAN', false, null, null);
		$this->addColumn('SHORT_DESCRIPTION', 'ShortDescription', 'LONGVARCHAR', false, null, null);
		$this->addColumn('FULL_DESCRIPTION', 'FullDescription', 'LONGVARCHAR', false, null, null);
		$this->addColumn('META_TITLE', 'MetaTitle', 'VARCHAR', false, 255, null);
		$this->addColumn('META_DESCRIPTION', 'MetaDescription', 'VARCHAR', false, 255, null);
		$this->addColumn('META_KEYWORDS', 'MetaKeywords', 'VARCHAR', false, 255, null);
		$this->addColumn('CREATED', 'Created', 'INTEGER', true, null, null);
		$this->addColumn('UPDATED', 'Updated', 'INTEGER', true, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Brand', 'SBrands', RelationMap::MANY_TO_ONE, array('brand_id' => 'id', ), null, null);
    $this->addRelation('MainCategory', 'SCategory', RelationMap::MANY_TO_ONE, array('category_id' => 'id', ), null, null);
    $this->addRelation('ProductVariant', 'SProductVariants', RelationMap::ONE_TO_MANY, array('id' => 'product_id', ), null, null);
    $this->addRelation('ShopProductCategories', 'ShopProductCategories', RelationMap::ONE_TO_MANY, array('id' => 'product_id', ), null, null);
    $this->addRelation('SProductPropertiesData', 'SProductPropertiesData', RelationMap::ONE_TO_MANY, array('id' => 'product_id', ), 'CASCADE', null);
    $this->addRelation('SOrderProducts', 'SOrderProducts', RelationMap::ONE_TO_MANY, array('id' => 'product_id', ), null, null);
    $this->addRelation('Category', 'SCategory', RelationMap::MANY_TO_MANY, array(), null, null);
	} // buildRelations()

} // SProductsTableMap
