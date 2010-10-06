<?php



/**
 * Skeleton subclass for representing a row from the 'shop_delivery_methods' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.Shop
 */
class SDeliveryMethods extends BaseSDeliveryMethods {

	public function attributeLabels()
	{
		return array(
			'Name'=>ShopCore::t('Название'),
			'Description'=>ShopCore::t('Описание'),
			'Price'=>ShopCore::t('Цена'),
			'FreeFrom'=>ShopCore::t('Бесплатен от'),
			'Enabled'=>ShopCore::t('Активен'),
		);
	}


    public function rules()
    {
        return array(
           array(
                 'field'=>'Name',
                 'label'=>$this->getLabel('Name'),
                 'rules'=>'required|max_length[500]'
              ),
           array(
                 'field'=>'Price',
                 'label'=>$this->getLabel('Price'),
                 'rules'=>'numeric',
              ),
           array(
                 'field'=>'FreeFrom',
                 'label'=>$this->getLabel('FreeFrom'),
                 'rules'=>'numeric',
              ),
        );
    }

} // SDeliveryMethods
