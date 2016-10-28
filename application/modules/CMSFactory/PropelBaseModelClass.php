<?php

namespace CMSFactory;

use CMSFactory\DependencyInjection\DependencyInjectionProvider;
use Currency\Currency;
use CustomFieldsData;
use CustomFieldsDataQuery;
use CustomFieldsQuery;
use Doctrine\Common\Cache\CacheProvider;
use MY_Controller;
use MY_Form_validation;
use Propel\Runtime\Connection\ConnectionInterface;

class PropelBaseModelClass implements \Serializable
{

    public $customFields;

    public $customData;

    public $hasCustomData = false;

    public $entityId;

    private $entities_locale = [
                                'product',
                                'category',
                                'brand',
                               ];

    /**
     * @param MY_Form_validation $validator
     * @return mixed
     */
    public function validateCustomData($validator) {
        if (!empty($this->entityName)) {
            $this->collectCustomData($this->entityName, $this->getId());

            if ($this->hasCustomData !== false) {
                foreach ($_POST['custom_field'] as $key_post => $value_post) {
                    foreach ($this->customFields as $key => $value) {
                        if ((int) $key_post == $value['Id']) {

                            $validator_str = '';
                            if ($value['IsRequired'] && $this->curentPostEntitySave($key)) {
                                $validator_str = 'required';
                            }
                            if ($value['Validators'] && $this->curentPostEntitySave($key)) {
                                $validator_str .= '|' . $value['Validators'];
                            }
                            $name = array_shift($value['CustomFieldsI18ns'])['FieldLabel'];
                            $validator->set_rules("custom_field[$key]", $name, $validator_str);
                        }
                    }
                }
            }
        }
        return $validator;
    }

    /**
     * @param string $entityName
     * @param int $id
     * @return bool
     */
    public function collectCustomData($entityName, $id) {
        $this->entityId = $id;
        $this->customFields = CustomFieldsQuery::create()
            ->joinWithI18n(MY_Controller::defaultLocale())
            ->filterByIsActive(1)
            ->filterByEntity($entityName)
            ->find()
            ->toArray($keyColumn = 'id');

        if (count($this->customFields)) {
            $this->hasCustomData = true;
        } else {
            return false;
        }
    }

    /**
     * @param int $key
     * @return bool
     */
    public function curentPostEntitySave($key) {
        $entity = CustomFieldsQuery::create()->findPk($key);
        if ($entity) {
            return $entity->getEntity() == $this->entityName;
        }
    }

    public function saveCustomData() {

        $locale = in_array($this->entityName, $this->entities_locale, true) ? chose_language() : MY_Controller::defaultLocale();

        if ($this->hasCustomData === false) {
            $this->collectCustomData($this->entityName, $this->getId());
        }
        $data = $_POST['custom_field'];

        foreach ($this->customFields as $fieldObject) {
            if (!array_key_exists($fieldObject['Id'], $_POST['custom_field'])) {
                $data[$fieldObject['Id']] = '';
            }
            foreach ($data as $key => $value) {
                if ((int) $key == $fieldObject['Id']) {

                    $objCustomData = CustomFieldsDataQuery::create()
                        ->filterByentityId($this->entityId)
                        ->filterByfieldId($key)
                        ->filterByLocale($locale)
                        ->findOne();
                    if ($objCustomData) {
                        $objCustomData->setdata($value);
                        $objCustomData->save();
                        break;
                    } else {
                        $fieldObject = new CustomFieldsData();
                        $fieldObject->setentityId($this->entityId);
                        $fieldObject->setfieldId($key);
                        $fieldObject->setdata($value);
                        $fieldObject->setLocale($locale);
                        $fieldObject->save();
                        break;
                    }
                }
            }
        }
    }

    /**
     * @param $attributeName
     * @return mixed
     */
    public function getLabel($attributeName) {
        if (method_exists($this, 'attributeLabels')) {
            $labels = $this->attributeLabels();

            if (isset($labels[$attributeName])) {
                return $labels[$attributeName];
            } else {
                return $attributeName;
            }
        }
    }

    /**
     * @param string $column
     * @return bool
     */
    public function getVirtual($column) {
        $column = strtolower($column);
        return $this->getVirtualColumn($column);
    }

    /**
     * @param string $name
     * @return bool
     */
    public function getVirtualColumn($name) {
        $name = strtolower($name);

        if (!$this->hasVirtualColumn($name)) {
            return false;
        }
        return parent::getVirtualColumn($name);
    }

    /**
     * Convert model attribute(by default Price). e.g. "99.99 $"
     *
     * @param string $attributeName Optional. Attribute name to convert.
     * @access public
     * @return string
     */
    public function toCurrency($attributeName = 'Price', $cId = null, $convertForTemplate = false) {
        $attributeName = strtolower($attributeName);
        $get = 'get' . $attributeName;

        if (!$convertForTemplate) {
            if ($attributeName == 'origprice') {
                return Currency::create()->convert($this->getVirtualColumn('origprice'), $cId);
            }
            return Currency::create()->convert($this->$get(), $cId);
        } else {
            if ($attributeName == 'origprice') {
                return Currency::create()->convertForTemplate($this->getVirtualColumn('origprice'), $cId);
            }
            return Currency::create()->convertForTemplate($this->$get(), $cId);
        }
    }

    /**
     * Simple getter.
     *
     * @param  $name
     * @return
     */
    public function __get($name) {
        if (isset($this->$name)) {
            return $this->$name;
        }

        $call = 'get' . $name;
        if (method_exists($this, $call)) {
            return $this->$call();
        }
    }

    /**
     * @return CacheProvider
     */
    public function getCache() {

        return DependencyInjectionProvider::getContainer()->get('cache');
    }

    public function __call($name, $param) {

        if (preg_match('/get(\w+)/', $name, $matches)) {
            $virtualColumn = $matches[1];
            $virtualColumn = strtolower($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
            // no lcfirst in php<5.3...
            $virtualColumn[0] = strtolower($virtualColumn[0]);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }
    }

    public function setVirtualColumn($name, $value) {

        $name = strtolower($name);

        parent::setVirtualColumn($name, $value);
    }

    public function preSave(ConnectionInterface $con = null) {
        return true;
    }

    public function postSave(ConnectionInterface $con = null) {
        return true;
    }

    public function preInsert(ConnectionInterface $con = null) {
        return true;
    }

    public function postInsert(ConnectionInterface $con = null) {
        return true;
    }

    public function preUpdate(ConnectionInterface $con = null) {
        return true;
    }

    public function postUpdate(ConnectionInterface $con = null) {
        return true;
    }

    public function postDelete(ConnectionInterface $con = null) {
        return true;
    }

    public function preDelete(ConnectionInterface $con = null) {
        return true;
    }

    /**
     * String representation of object
     * @link http://php.net/manual/en/serializable.serialize.php
     * @return string the string representation of the object or null
     * @since 5.1.0
     */
    public function serialize() {
        $this->prepareToSleep();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach ($serializableProperties as $property) {

            $propertyName = $property->getName();
            $propertyValue = $this->$propertyName;

            if ($propertyValue !== null) {
                $propertyNames[$propertyName] = $propertyValue;

            }

        }

        return serialize($propertyNames);
    }

    private function prepareToSleep() {
        $this->collSCategoriesRelatedById = null;
        $this->collSCategoryI18ns = null;
        $this->collSProductss = null;
        $this->collShopProductCategoriess = null;
        $this->collShopProductPropertiesCategoriess = null;
        $this->collProducts = null;
        $this->collProperties = null;
        $this->aSCategory = null;
    }

    /**
     * Constructs the object
     * @link http://php.net/manual/en/serializable.unserialize.php
     * @param string $serialized <p>
     * The string representation of the object.
     * </p>
     * @return void
     * @since 5.1.0
     */
    public function unserialize($serialized) {
        $serialized = unserialize($serialized);

        foreach ($serialized as $key => $item) {

            $this->$key = $item;

        }

    }

}