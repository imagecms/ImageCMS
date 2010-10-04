<?php
/**
 * Skeleton subclass for representing a row from the 'shop_products' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.Shop
 */
class SProducts extends BaseSProducts {

	public function attributeLabels()
	{
		return array(
			'Name'=>ShopCore::t('Название'),
			'Url'=>ShopCore::t('URL'),
			'Price'=>ShopCore::t('Цена'),
			'Number'=>ShopCore::t('Акртикул'),
			'ShortDescription'=>ShopCore::t('Краткое Описание'),
			'FullDescription'=>ShopCore::t('Полное Описание'),
			'MetaTitle'=>ShopCore::t('Meta Title'),
			'MetaDescription'=>ShopCore::t('Meta Description'),
			'MetaKeywords'=>ShopCore::t('Meta Keywords'),
			'Categories'=>ShopCore::t('Дополнительные Категории'),
			'CategoryId'=>ShopCore::t('Категория'),
			'Active'=>ShopCore::t('Активен'),
			'Hit'=>ShopCore::t('Хит'),
			'Brand'=>ShopCore::t('Бренд'),
			'Stock'=>ShopCore::t('Склад'),
			'RelatedProducts'=>ShopCore::t('Связанные товары'),
		);
	}

    public function rules()
    {
        return array(
           array(
                 'field'=>'Name',
                 'label'=>$this->getLabel('Name'),
                 'rules'=>'required',
              ),
           array(
                 'field'=>'Price',
                 'label'=>$this->getLabel('Price'),
                 'rules'=>'required|numeric',
              ),
           array(
                 'field'=>'Url',
                 'label'=>$this->getLabel('Url'),
                 'rules'=>'alpha_dash',
              ),
           array(
                 'field'=>'CategoryId',
                 'label'=>$this->getLabel('CategoryId'),
                 'rules'=>'required|integer',
              ),
        );
    }

    public function postSave()
    {
        if ($this->getUrl() == '')
        {
            $this->setUrl($this->getId());
            $this->save();
        }

        return true;
    }

    public function postDelete()
    {
        // Delete product category relations
        ShopProductCategoriesQuery::create()
            ->filterByProductId($this->getId())
            ->delete();

        // Delete product variants
        SProductVariantsQuery::create()
            ->filterByProductId($this->getId())
            ->delete();
    }

    public function preSave()
    {
        $this->setUpdated(time());
        return true;
    }

    public function preInsert()
    {
        $this->setCreated(time());
        $this->setUpdated(time());
        return true;
    }

    public function getVariants()
    {
        return SProductVariantsQuery::create()
            ->orderByPosition()
            ->filterByProductId($this->getId())
            ->find();
    }

} // SProducts
