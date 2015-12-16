<?php

namespace CMSFactory\MetaManipulator;

use SBrands;

class ShopBrandMetaManipulator extends MetaManipulator
{

    /**
     * @var array
     */
    protected $matching = [
        'desc' => 'description'
    ];

    /**
     * @var SBrands
     */
    protected $model;

    /**
     * @return SBrands
     */
    public function getModel() {

        return $this->model;
    }

    /**
     * @param SBrands $model
     */
    public function setModel($model) {

        $this->model = $model;
    }

}