<?php



/**
 * Skeleton subclass for representing a row from the 'shop_brands' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.Shop
 */
class SBrands extends BaseSBrands {

	public function attributeLabels()
	{
		return array(
			'Name'=>ShopCore::t('Название'),
			'Url'=>ShopCore::t('URL'),
			'Description'=>ShopCore::t('Описание'),
			'MetaTitle'=>ShopCore::t('Meta Title'),
			'MetaDescription'=>ShopCore::t('Meta Description'),
			'MetaKeywords'=>ShopCore::t('Meta Keywords'),
		);
	}

    public function rules()
    {
        return array(
           array(
                 'field'=>'Name',
                 'label'=>$this->getLabel('Name'),
                 'rules'=>'required'
              ),
           array(
                 'field'=>'Url',
                 'label'=>$this->getLabel('Url'),
                 'rules'=>'alpha_dash',
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

} // SBrands
