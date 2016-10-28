<?php

namespace xbanners\src\UrlFinder\Finders;

use xbanners\src\UrlFinder\Results\Result;

final class PageCategories extends BaseFinder
{

    protected $table = 'category';

    protected $translations = 'category_translate';

    protected $nameColumn = 'category_translate.name';

    protected $urlColumn = 'route.url';

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
     * @param integer $limit
     * @return Result
     */
    public function getResultsFor($word, $language, $limit = 10) {
        $languageId = $this->correctLocale($language);
        $db = \CI::$APP->db;
        if ($language == \MY_Controller::defaultLocale()) {
            $this->nameColumn = 'category.name';
        } else {
            $db->join($this->translations, "{$this->table}.id = {$this->translations}.alias");
            $db->where($this->langColumn, $languageId);
        };
        /* @var $db \CI_DB_active_record */
        $results = $db->select("$this->nameColumn, $this->parentId")
            ->select("IF(route.parent_url <> '', concat(route.parent_url, '/', route.url), route.url) as url", false)
            ->join('route', 'route.id = category.route_id')
            ->from($this->table)
            ->like($this->nameColumn, $word)
            ->limit($limit)
            ->get()
            ->result_array();

        $result = new Result($this->getGroupName());
        foreach ($results as $oneResult) {
            $result->addResult($oneResult['name'], $this->formUrl($oneResult['url']));
        }

        return $result;
    }

    /**
     * Returns url segments
     * from all parent categories
     *
     * @param integer $id
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