<?php namespace CMSFactory\Tree;

use Propel\Runtime\Collection\ObjectCollection;

/**
 * Class ModelWrapper
 *
 * @package CMSFactory\Tree
 */
class ModelWrapper
{

    /**
     * @var ObjectCollection
     */
    protected $subItems;

    /**
     * @var TreeItemInterface
     */
    protected $model;

    /**
     * @param TreeItemInterface $model
     */
    public function __construct(TreeItemInterface $model) {
        $this->model = $model;
        $this->subItems = new ObjectCollection();
    }

    /**
     * @return TreeItemInterface
     */
    public function getWrappedModel() {
        return $this->model;
    }

    /**
     * @param ModelWrapper $model
     */
    public function addSubItem(ModelWrapper $model) {
        $this->subItems->push($model);
    }

    /**
     * @return ObjectCollection
     */
    public function getSubItems() {
        return $this->subItems;
    }

    /**
     * @return int
     */
    public function countSubItems() {
        return count($this->subItems);
    }

    /**
     * @return bool
     */
    public function hasSubItems() {
        return count($this->subItems) > 0;
    }

    /**
     * @param $function
     * @param $args
     * @return mixed
     */
    public function __call($function, $args) {
        return call_user_func_array([$this->model, $function], $args);
    }

    /**
     * @throws \Exception
     */
    public function save() {
        throw new \Exception("Forbidden action, couldn't save wrapper!");
    }

}