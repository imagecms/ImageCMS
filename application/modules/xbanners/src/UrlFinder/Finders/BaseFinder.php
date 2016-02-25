<?php

namespace xbanners\src\UrlFinder\Finders;

use xbanners\src\UrlFinder\Results\Result;

abstract class BaseFinder
{

    protected $table;

    protected $translations;

    protected $nameColumn;

    protected $urlColumn;

    protected $categoryUrlColumn;

    protected $langColumn;

    /**
     * @param string $word
     * @param string $language
     * @param integer $limit
     */
    public function getResultsFor($word, $language, $limit = 10) {
        /* @var $db \CI_DB_active_record */
        $db = \CI::$APP->db;
        $results = $db->select("$this->nameColumn, $this->urlColumn")
            ->from($this->table)
            ->join($this->translations, "{$this->table}.id = {$this->translations}.id")
            ->like($this->nameColumn, $word)
            ->where($this->langColumn, $language)
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
     * Returns locale id
     *
     * @param string $locale
     * @return id
     */
    protected function correctLocale($locale) {
        /* @var $db \CI_DB_active_record */
        $db = \CI::$APP->db;
        $res = $db
            ->where('identif', $locale)
            ->get('languages')
            ->first_row();
        return $res->id;
    }

    /**
     * @param string $url
     * @return string
     */
    abstract public function formUrl($url);

    /**
     * Product Banner etc.
     *
     * @return string
     */
    abstract public function getGroupName();

}