<?php


namespace CMSFactory\MetaManipulator;

/**
 * Class PageCategoryMetaManipulator
 * @package CMSFactory\MetaManipulator
 */
class PageCategoryMetaManipulator extends MetaManipulator
{

    /**
     * @return string
     */
    public function getDescription() {

        if (!$this->description) {
            $this->setDescription($this->getModel()['short_desc']);
        }
        return $this->description;
    }

    /**
     * @return string
     */
    public function getName() {

        if (!$this->name) {
            $this->setName($this->getModel()['name']);
        }
        return $this->name;
    }

}