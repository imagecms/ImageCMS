<?php

class ShopBaseObject extends BaseObject {

    public function getLabel($attributeName)
    {
        if (method_exists($this,'attributeLabels'))
        {
            $labels = $this->attributeLabels();
            
            if (isset($labels[$attributeName]))
            {
                return $labels[$attributeName];
            }
            else
            {
                return $attributeName;
            }
        }
    }

}
