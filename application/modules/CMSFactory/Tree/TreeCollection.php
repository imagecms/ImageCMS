<?php namespace CMSFactory\Tree;

use Propel\Runtime\Collection\ObjectCollection;

class TreeCollection extends ObjectCollection
{

    protected $data = [];

    public function __construct(ObjectCollection $items, $rootId = 0) {
        //order all categories by id
        while (!$items->isEmpty()) {
            $oneItem = $items->shift();
            $this->data[$oneItem->getId()] = new ModelWrapper($oneItem);
        }
        //set parents
        foreach ($this->data as $wrapper) {

            $parentId = $wrapper->getParentId();
            if ($parentId > 0 && isset($this->data[$parentId])) {
                /**@var $parentWrapper ModelWrapper */
                $parentWrapper = $this->data[$parentId];
                $parentWrapper->addSubItem($wrapper);
            }
        }

        //add only root models to collection
        $roots = [];
        foreach ($this->data as $wrapper) {
            $wrapper->getParentId() == $rootId && array_push($roots, $wrapper);
        }
        parent::__construct($roots);
    }

    /**
     * Transform self to ordered by level list
     * @return ObjectCollection
     */
    public function getCollection() {
        $newData = [];
        $data = $this->data;
        while (!empty($data)) {
            /** @var $model ModelWrapper */
            $model = array_shift($data);
            foreach ($model->getSubItems() as $subcategory) {
                $data[] = $subcategory;
            }
            $newData[] = $model->getWrappedModel();
        }
        return new ObjectCollection($newData);
    }

}