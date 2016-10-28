<?php

namespace xbanners\src\UrlFinder\Finders;

use xbanners\src\UrlFinder\Results\Result;

final class Pages extends BaseFinder
{

    protected $table = 'content';

    protected $nameColumn = 'content.title';

    protected $langColumn = 'content.lang';

    public function getGroupName() {
        return lang('Pages', 'xbanners');
    }

    /**
     * @param string $word
     * @param string $language
     * @param integer $limit
     * @return Result
     */
    public function getResultsFor($word, $language, $limit = 10) {
        $languageId = $this->correctLocale($language);
        /* @var $db \CI_DB_active_record */
        $db = \CI::$APP->db;
        $results = $db->select("$this->nameColumn")
            ->select("IF(route.parent_url <> '', concat(route.parent_url, '/', route.url), route.url) as url", false)
            ->from($this->table)
            ->join('route', 'route.id = content.route_id')
            ->like($this->nameColumn, $word)
            ->where($this->langColumn, $languageId)
            ->limit($limit)
            ->get()
            ->result_array();
        $result = new Result($this->getGroupName());
        foreach ($results as $oneResult) {
            $result->addResult($oneResult['title'], $this->formUrl($oneResult['url']));
        }
        return $result;
    }

    /**
     * @param string $url
     * @return string
     */
    public function formUrl($url) {
        return '/' . $url;
    }

}