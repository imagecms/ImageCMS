<?php


namespace CMSFactory\MetaManipulator;

use CI;

class PageMetaManipulator extends MetaManipulator
{

    /**
     * @var array
     */
    protected $matching = [
        'desc' => 'description'
    ];

    /**
     * @var array
     */
    protected $model;

    /**
     * @return string
     */
    public function getCategory() {

        if (!$this->category) {
            $category_id = $this->getModel()['category'];
            $categoryData = CI::$APP->load->model('cms_base')->get_category_by_id($category_id);
            if ($categoryData) {
                $categoryName = $categoryData['name'];
            }
            $this->setCategory($categoryName);
        }
        return $this->category;
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
    public function getDescription() {

        if (!$this->description) {
            $desc = $this->getModel()['prev_text'] === null ? $this->getModel()['full_text'] : $this->getModel()['prev_text'];
            $this->setDescription($desc);
        }

        return $this->description;
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