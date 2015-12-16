<?php


namespace CMSFactory\MetaManipulator;


class CategoryMetaManipulator extends MetaManipulator
{
    /**
     * @var array
     */
    protected $model;

    /**
     * @return string
     */
    public function getDescription() {

        if (!$this->description) {
            $desc = $this->getModel()['prev_text'] === null ? $this->getModel()['full_text'] : $this->getModel()['prev_text'];
            $this->setDescription($desc);
        }

        return $this->description;
    }

    /**
     * @return array
     */
    public function getModel() {

        return $this->model;
    }

    /**
     * @param array $model
     */
    public function setModel($model) {

        $this->model = $model;
    }

    /**
     * @return string
     */
    public function getName() {

        if (!$this->name) {
            $this->setName($this->getModel()['title']);
        }
        return $this->name;
    }
}