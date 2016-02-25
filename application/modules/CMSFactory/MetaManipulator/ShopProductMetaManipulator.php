<?php

namespace CMSFactory\MetaManipulator;

use MY_Controller;
use SProductPropertiesDataQuery;
use SProducts;

/**
 * Class ShopProductMetaManipulator
 * @package CMSFactory\MetaManipulator
 */
class ShopProductMetaManipulator extends MetaManipulator
{

    /**
     * Product property
     * @var array
     */
    private $properties = [];

    /**
     * @param string $name
     * @param string $arguments
     * @return string
     */
    public function __call($name, $arguments) {

        // for %p_xxxx% param
        if (preg_match('/p_[\d]*/', $name, $matches)) {
            $propertyId = str_replace('p_', '', $matches[0]);
            return $this->getProperties($propertyId);
        }

        return parent::__call($name, $arguments);
    }

    /**
     * @param int|null $id
     * @return string|array
     */
    public function getProperties($id = null) {

        if (empty($this->properties)) {

            $properties = $this->getModel()->getSProductPropertiesDatas(
                SProductPropertiesDataQuery::create()
                    ->filterByLocale(MY_Controller::getCurrentLocale())
            );

            foreach ($properties as $property) {
                $this->setProperties($property->getPropertyId(), $property->getValue());
            }
        }

        return $id === null ? $this->properties : $this->properties[$id];
    }

    /**
     * @param int $id
     * @param string $value
     */
    public function setProperties($id, $value) {

        $this->properties[$id] = $value;
    }

     /**
     * @return string
     */
    public function getBrand() {

        if (!$this->brand) {
            $this->setBrand($this->getModel()->getBrand() ? $this->getModel()->getBrand()->getName() : '');
        }
        return $this->brand;
    }

    /**
     * @return string
     */
    public function getCategory() {

        if (!$this->category) {
            $this->setCategory($this->getModel()->getMainCategory()->getName());
        }
        return $this->category;
    }

    /**
     * @return string
     */
    public function getDescription() {

        if (!$this->description) {
            $this->setDescription($this->getModel()->getFullDescription());
        }

        return $this->description;
    }

    /**
     * @return string
     */
    public function getPrice() {

        if (!$this->price) {
            $this->setPrice($this->getModel()->getFirstVariant()->getPrice());
        }
        return $this->price;
    }

}