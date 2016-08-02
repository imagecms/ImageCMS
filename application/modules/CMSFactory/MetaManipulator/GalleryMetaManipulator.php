<?php

namespace CMSFactory\MetaManipulator;

use CI;
use CI_DB_result;

/**
 * Class GalleryMetaManipulator
 * @package CMSFactory\MetaManipulator
 */
class GalleryMetaManipulator extends MetaManipulator
{

    /**
     * @return string
     */
    public function getDescription() {

        if (!$this->description) {
            $desc = $this->getModel()['description'];
            $this->setDescription($desc);
        }

        return $this->description;
    }

    /**
     * @return string
     */
    public function getCategory() {

        if (!$this->category) {

            $category_id = $this->getModel()['category_id'] ?: $this->getModel()['id'];
            $categoryName = $this->get_category_by_id($category_id);

            if ($categoryName) {
                $this->setCategory($categoryName);
            }
        }
        return $this->category;
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

    /**
     * @param int $id
     * @return bool
     */
    private function get_category_by_id($id) {
        $locale = \MY_Controller::getCurrentLocale();
        /** @var CI_DB_result $data */
        $data = CI::$APP->db->get_where('gallery_category_i18n', ['id' => $id, 'locale' => $locale]);

        if ($data->num_rows() > 0) {

            $data = $data->row_array();
            return $data['name'];
        }

        return false;
    }

}