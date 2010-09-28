<?php
/**
 * Class to generate properties form. 
 * 
 * @package Shop
 * @version $id$
 * @author <dev@imagecms.net>
 */
class SPropertiesRenderer {

    public $inputsName = 'productProperties';
    public $noValueText = '- none -';
    protected $properties = null;
    protected $productModel = null;
    protected $propertiesData = array();

    public function __construct()
    {

    }

    /**
     * Render properties form for admin panel. Used in create/edit products.
     * 
     * @param mixed $categoryId Category Id
     * @access public
     * @return string
     */
    public function renderAdmin($categoryId, $productModel = null)
    {
        $categoryModel = SCategoryQuery::create()
            ->findPk((int) $categoryId); 

        if ($categoryModel === null)
            return false;

        $properties = $categoryModel->getPropertys();
    
        if (sizeof($properties) == 0)
            return false;

        if ($productModel instanceof SProducts)
        {
            $this->productModel = $productModel;
            $this->_loadProductPropertiesData();
        }

        ShopCore::$ci->load->helper('form');

        $resultHtml = '';
        foreach ($properties as $property)
        {
            $resultHtml.='
            <div class="form_text">'.$property->getName().':</div>
            <div class="form_input">'.$this->_renderInput($property).'</div>
            <div class="form_overflow"></div>';
        }

        return $resultHtml;
    }

    protected function _renderInput(SProperties $property)
    {
        $data = $property->asArray();
        $name = $this->inputsName.'['.$property->getId().']';

        // Render select
        if (sizeof($data) > 0)
        {
            $data = array_merge(array(0=>$this->noValueText), array_combine($data,$data));
            return form_dropdown($name, $data, $this->_getProductPropertyValue($property->getId()));
        }
        else 
        {
            // Render textbox
            $inputData = array(
              'name' => $name,
              'value' => $this->_getProductPropertyValue($property->getId()),
              'class' => 'textbox_long',
            );

            return form_input($inputData);
        }
    }

    protected function _loadProductPropertiesData()
    {        
        if ($this->productModel === null)
            return false;

        $propertiesData = $this->productModel->getSProductPropertiesDatas();
 
        if (sizeof($propertiesData) > 0)
        {
            foreach ($propertiesData as $p)
            {
                $this->propertiesData[$p->getPropertyId()] = $p;
            }
        }
    }

    protected function _getProductPropertyValue($propertyId)
    {
        if ($this->propertiesData[$propertyId])
        {
            $property = $this->propertiesData[$propertyId];
            return $property->getValue();
        }
        else
        {
            return null;
        }
    }

    /**
     * Render table containing product properties data. 
     * 
     * @param SProducts $product 
     * @access public
     * @return mixed string or null.
     */
    public function renderPropertiesTable(SProducts $product)
    {
        $this->productModel = $product;
        $this->_loadProductPropertiesData();

        if (sizeof($this->propertiesData) > 0)
        {
            $table = ShopCore::$ci->load->library('table',true);
            $table->set_template(array(
                'table_open'=>'<table border="0" cellpadding="4" cellspacing="0" class="productPropertiesTable">'
            ));

            foreach ($this->propertiesData as $property)
            {
                $table->add_row(ShopCore::encode($property->getSProperties()->getName()), ShopCore::encode($property->getValue()));
            }

            return $table->generate();
        }

        return null;
    }

}
