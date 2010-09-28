<?php

/**
 * Skeleton subclass for representing a row from the 'shop_category' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.Shop
 */
class SCategory extends BaseSCategory {

	public function attributeLabels()
	{
		return array(
			'Id'=>ShopCore::t('Id'),
			'Name'=>ShopCore::t('Название'),
			'Url'=>ShopCore::t('URL'),
			'Description'=>ShopCore::t('Описание'),
			'MetaDesc'=>ShopCore::t('Meta Description'),
			'MetaTitle'=>ShopCore::t('Meta Title'),
			'ParentId'=>ShopCore::t('Родитель'),
		);
	}

    /**
     * Validation rules
     * 
     * @access public
     * @return array
     */
    public function rules()
    {
        return array(
           array(
                 'field'=>'Name',
                 'label'=>$this->getLabel('Name'),
                 'rules'=>'required'
              ),
        );
    }

    /**
     * preSave hook. 
     * 
     * @access public
     * @return bool
     */
    public function preSave()
    {
        /**
         *  Translit category name to url if url empty.
         */
        if ($this->getUrl() == '')
        {
            $ci =& get_instance();
            $ci->load->helper('translit');
		    $this->setUrl( translit_url($this->getName()) );
        }

        return true;
    }

    public function preInsert()
    {
        // Select max position
        $maxPositionCategory = SCategoryQuery::create()
            ->orderByPosition('desc')
            ->findOne();

        /**
         *  Set max position to all new categories
         */
        if ($maxPositionCategory)
            $this->setPosition($maxPositionCategory->getPosition() + 1);
        else
            $this->setPosition(1);

        return true;
    }

   /**
    * Delete subcategories and related products.
    * 
    * @access public
    * @return boll
    */
   public function postDelete()
   {
        // Remove orphans.
        ShopCore::app()->SCategoryTree->removeOrphans();

        /**
         * Delete related products.  
         */
        $notDelete = ShopProductCategoriesQuery::create()->find();
        $result = array();
        
        foreach ($notDelete as $object)
            array_push($result,$object->getProductId());

        // Delete products only that not have related category.
        $criteria = new Criteria();
        $criteria->add(SProductsPeer::ID, $result, Criteria::NOT_IN);
        SProductsPeer::doDelete($criteria);

        return true;
   }

   public function buildCategoryPath()
   {
        $ids = array();
        $result = array();
        $pathArray = unserialize($this->getFullPathIds());
        
        if (sizeof($pathArray) > 1)
        {
            foreach ($pathArray as $key=>$val)
            {
                array_push($ids,$val);
            }

            $result = SCategoryQuery::create()
                ->findPKs($ids);
        }

        return $result;
   }

} // SCategory
