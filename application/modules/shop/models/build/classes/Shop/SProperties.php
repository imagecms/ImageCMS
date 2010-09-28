<?php



/**
 * Skeleton subclass for representing a row from the 'shop_product_properties' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.Shop
 */
class SProperties extends BaseSProperties {

	public function attributeLabels()
	{
		return array(
			'ProductId'=>ShopCore::t('ProductId'),
			'Name'=>ShopCore::t('Название'),
			'Active'=>ShopCore::t('Активно'),
			'Position'=>ShopCore::t('Позиция'),
			'Data'=>ShopCore::t('Значения'),
			'ShowInCompare'=>ShopCore::t('Показывать в сравнении товаров'),
			'UseInCategories'=>ShopCore::t('Использовать в категориях'),
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
        );
    }

    public function preSave()
    {
        // Save data as serialized string
        $data = $this->_dataToArray();
        if ($data)
            $this->setData(serialize($data));
        else
            $this->setData('');

        return true;
    }

    /**
     * Create array from text.
     * 
     * @access public
     * @return void
     */
    public function _dataToArray()
    {
        $data = trim($this->getData());
        
        if ($data)
        {
            $result = explode("\n", $data);
            if (count($result) > 0)
                $result = array_map('trim', $result);
            else
                return false;
        }

        if (count($result) > 0)
            return $result;
        else
            return false;
    }

    /**
     * Convert array back to string
     * 
     * @access public
     * @return void
     */
    public function asText()
    {
        $data = $this->getData();

        if ($data != '')
        {
            $data = unserialize($data);
            $data = implode("\n", $data);
        }

        return $data;
    }

    public function asArray()
    {
        if ($this->getData() != '')
        {
            return unserialize($this->getData());
        }
    }

} // SProperties
