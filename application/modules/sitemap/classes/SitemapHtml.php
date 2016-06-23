<?php

namespace sitemap\classes;

class SitemapHtml
{

    /**
     * @var \CI_DB_active_record
     */
    protected $db;

    protected $offset;

    protected $limit;

    protected $libCategory;

    protected $localeId;

    protected $itemsCount;

    protected $currentItem;

    protected $map;

    public function __construct($db, $libCategory, $offset = 0, $limit = 100) {
        $this->db = $db;
        $this->libCategory = $libCategory;
        $this->localeId = \MY_Controller::getCurrentLanguage()['id'];

        $this->offset = $offset;
        $this->limit = $limit;

        $this->itemsCount = 0;
        $this->currentItem = 0;
    }

    public function build() {
        $this->initCategories();
    }

    public function initCategories($level = 0) {
        $categories = $this->libCategory->build();
        foreach ($categories as $category) {
            $this->addCategory($category);
            if (is_array($category['subtree'])) {
                $this->initCategories(++$level);
            }
        }
    }

    public function addCategory($category, $level) {
        $this->addItem($category['name'], $category['path_url'], $level);
        //        if()
    }

    public function addPage() {

    }

    public function checkOffset() {
        return $this->currentItem >= $this->offset;
    }

    public function checkLimit() {
        return $this->itemsCount <= $this->limit;
    }

    public function addItem($name, $url, $level) {
        if ($this->checkLimit() && $this->checkOffset()) {
            $this->itemsCount ++;
            $this->currentItem ++;
            array_push($this->map, ['name' => $name, 'url' => $url, 'level' => $level]);
            return true;
        }
        return false;
    }

    //
    //    public function initPages() {
    //
    //    }
    //    protected function countPages($category_id = 0) {
    //        $this->db->where('lang', $this->localeId);
    //        $this->db->where('category', $category_id);
    //        return $this->db->get('content')->num_rows();
    //    }
    //
    //    protected function addContentCategories($categories, $level = 0) {
    //        foreach ($categories as $category) {
    //            $this->addContentToMap($category);
    //            if (!empty($category['subtree'])) {
    //                $this->addContentCategories($category['subtree'], ++$level);
    //            }
    //        }
    //    }
    //
    //    protected function addContentToMap($category, $level) {
    //        $this->itemsCount += $this->countPages($category['id']) + 1;
    //        if ($this->itemsCount > $this->offset) {
    //            $this->addToMap($category, $level);
    //            $this->addCategoryPages($category['id'], ++$level);
    //        } elseif ($this->itemsCount < $this->offset) {
    //
    //        }
    //    }
    //
    //    protected function addCategoryPages($category_id = 0, $level = 0) {
    //        $pages = [];
    //        $query = $this->db
    //                ->where('category', $category_id)
    //                ->where('lang', $this->localeId)
    //                ->limit($this->limit)
    //                ->get('content');
    //        if ($query->num_rows() > 0) {
    //            $pages = $query->result_array();
    //        }
    //
    //        foreach ($pages as $one) {
    //            $this->addToMap($one, $level);
    //        }
    //    }
    //
    //    protected function addToMap($item, $level) {
    //        $this->limit --;
    ////        $this->offset ++;
    //    }
}