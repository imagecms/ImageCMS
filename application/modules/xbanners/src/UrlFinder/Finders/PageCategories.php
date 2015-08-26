<?php

namespace Banners\UrlFinder\Finders;

use Banners\UrlFinder\Results\Result;

final class PageCategories extends BaseFinder {

    protected $table = 'category';

    protected $translations = 'category_translate';

    protected $nameColumn = 'category_translate.name';

    protected $urlColumn = 'category.url';

    protected $langColumn = 'category_translate.lang';

    protected $parentId = 'category.parent_id';

    /**
     * @return string
     */
    public function getGroupName() {
        return lang('Page Categories', 'xbanners');
    }

    /**
     * @param string $word
     * @param string $language
     * @param int $limit
     * @return Result
     */
    public function getResultsFor($word, $language, $limit = 10) {
        $languageId = $this->correctLocale($language);
        /* @var $db \CI_DB_active_record */
        $db = \CI::$APP->db;
        $results = $db->select("$this->nameColumn, $this->urlColumn, $this->parentId")
            ->from($this->table)
            ->join($this->translations, "{$this->table}.id = {$this->translations}.alias")
            ->like($this->nameColumn, $word)
            ->where($this->langColumn, $languageId)
            ->limit($limit)
            ->get()
            ->result_array();
        $result = new Result($this->getGroupName());
        foreach ($results as $oneResult) {
            if ($oneResult['parent_id'] > 0) {
                $oneResult['url'] = $this->getPagentUrl($oneResult['parent_id']) . $oneResult['url'];
            }
            $result->addResult($oneResult['name'], $this->formUrl($oneResult['url']));
        }

        return $result;
    }

    /**
     * Returns url segments
     * from all parent categories
     *
     * @param int $id
     * @return string parent url with last "/" symbol
     */
    protected function getPagentUrl($id) {
        /* @var $db \CI_DB_active_record */
        $db = \CI::$APP->db;
        $res = $db->select("$this->urlColumn, $this->parentId")
            ->where('id', $id)
            ->get($this->table)
            ->first_row();
        $url = $res->url;
        if ($res->parent_id > 0) {
            $url = $this->getPagentUrl($res->parent_id) . $url;
        }
        return $url . '/';
    }

    /**
     * @param string $url
     * @return string
     */
    public function formUrl($url) {
        return '/' . $url;
    }

}