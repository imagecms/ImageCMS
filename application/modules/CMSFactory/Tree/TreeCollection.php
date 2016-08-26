<?php namespace CMSFactory\Tree;

use Propel\Runtime\Collection\ObjectCollection;

class TreeCollection extends ObjectCollection
{

    protected $data = [];

    /**
     * TreeCollection constructor.
     * @param ObjectCollection $items
     * @param int $rootId
     */
    public function __construct(ObjectCollection $items, $rootId = 0) {

        foreach ($items as $item) {

            $this->data[$item->getId()] = new ModelWrapper($item);
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
     * TODO move level formation logic to __construct
     * @return ObjectCollection
     */
    public function getCollection() {

        $newData = [];
        $data = $this->data;
        while (!empty($data)) {
            /** @var $model ModelWrapper */
            $model = array_shift($data);
            if ($model->hasSubItems()) {
                $subItems = [];
                foreach ($model->getSubItems() as $subcategory) {
                    $subcategory->setVirtualColumn('level', $model->hasVirtualColumn('level') ? $model->getVirtualColumn('level') + 1 : 1);
                    array_push($subItems, $subcategory);
                }
                $data = array_merge($subItems, $data);
            }

            $model->hasVirtualColumn('level') || $model->setVirtualColumn('level', 0);
            $newData[] = $model->getWrappedModel();
        }
        return new ObjectCollection($newData);
    }

}