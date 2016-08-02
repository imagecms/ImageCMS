<?php

namespace CMSFactory\MetaManipulator;

/**
 * Class ShopBrandMetaManipulator
 * @package CMSFactory\MetaManipulator
 */
class ShopBrandMetaManipulator extends MetaManipulator
{

    /**
     * @return string
     */
    public function getDescription() {

        if (!$this->description) {
            $this->setDescription($this->getModel()->getDescription());
        }
        return $this->description;
    }

    /**
     * @return string
     */
    public function getID() {

        if (!$this->ID) {
            $this->setID($this->getModel()->getId());
        }
        return $this->ID;
    }

    /**
     * @return string
     */
    public function getName() {

        if (!$this->name) {
            $this->setName($this->getModel()->getName());
        }
        return $this->name;
    }

}