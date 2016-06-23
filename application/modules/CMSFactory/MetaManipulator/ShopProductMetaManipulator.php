<?php

namespace CMSFactory\MetaManipulator;

use MY_Controller;
use Propel\Runtime\Exception\PropelException;
use SProductPropertiesDataQuery;

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
     * @throws PropelException
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
     * @throws PropelException
     */
    public function getProperties($id = null) {

        if (count($this->properties) === 0) {

            $properties = $this->getModel()->getSProductPropertiesDatas(
                SProductPropertiesDataQuery::create()
                    ->setComment(__METHOD__)
                    ->joinWithSPropertyValue()
                    ->useSPropertyValueQuery()
                    ->joinWithI18n(MY_Controller::getCurrentLocale())
                    ->endUse()
            );

            foreach ($properties as $property) {
                $this->setProperties($property->getPropertyId(), $property->getSPropertyValue()->getValue());
            }
        }

        return $id === null ? $this->properties : $this->properties[$id];
    }

    /**
     * @param int $id
     * @param string $value
     */
    public function setProperties($id, $value) {

        if (array_key_exists($id, $this->properties)) {
            $this->properties[$id] .= ", $value";
        } else {
            $this->properties[$id] = $value;
        }
    }

    /**
     * @return string
     * @throws PropelException
     */
    public function getBrand() {

        if (!$this->brand) {
            $this->setBrand($this->getModel()->getBrand() ? $this->getModel()->getBrand()->getName() : '');
        }
        return $this->brand;
    }

    /**
     * @return string
     * @throws PropelException
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