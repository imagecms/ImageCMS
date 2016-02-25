<?php

namespace xbanners\src\UrlFinder\Finders;

use xbanners\src\UrlFinder\Results\Result;

final class Pages extends BaseFinder
{

    protected $table = 'content';

    protected $nameColumn = 'content.title';

    protected $urlColumn = 'content.url';

    protected $categoryUrlColumn = 'content.cat_url';

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
        $results = $db->select("$this->nameColumn, $this->urlColumn, $this->categoryUrlColumn")
            ->from($this->table)
            ->like($this->nameColumn, $word)
            ->where($this->langColumn, $languageId)
            ->limit($limit)
            ->get()
            ->result_array();
        $result = new Result($this->getGroupName());
        foreach ($results as $oneResult) {
            $result->addResult($oneResult['title'], $this->formUrl($oneResult['cat_url'] . $oneResult['url']));
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