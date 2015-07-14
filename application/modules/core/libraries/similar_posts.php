<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class Similar_Posts
 * Search similar pages to current which is shown
 */
class Similar_Posts {

    private $defaultSettings = [
        "categories" => ['all'],
        "search_type" => "title",
        "limit" => 5,
        "min_compare_symbols" => 3,
        "max_short_description_words" => 500,
    ];

    private $settings = [];

    /**
     * Page title to search similar
     * @var string
     */
    private $pageTitle = '';

    /**
     * Page id to search similar
     * @var null
     */
    private $pageId = null;

    public function __construct() {

    }

    public function getDefaultSettings() {
        return $this->defaultSettings;
    }

    private function initSettings($settings) {
        foreach ($this->defaultSettings as $settingName => $setting) {
            $this->settings[$settingName] = $settings[$settingName] ? $settings[$settingName] : $setting;
        }
    }

    private function setPageTitle($title) {
        $title = str_replace(array(',', ';', ':', '-', '+', '=', '@', '.', '/', '\''), '', $title);
        $this->pageTitle = $title;
    }

    private function setPageId($pageId) {
        $this->pageId = $pageId;
    }

    /**
     * Start find similar pages
     * @param $pageId
     * @param $title
     * @param $settings
     * @return array
     */
    public function find($pageId, $title, $settings) {
        $this->initSettings($settings);
        $this->setPageTitle($title);
        $this->setPageId($pageId);
        return $this->search();
    }

    /**
     * Search pages
     * @return array
     */
    private function search() {
        if ($this->settings['search_type'] === 'title') {
            return $this->getPagesByTitle();
        }

        if ($this->settings['search_type'] === 'tags') {
            return $this->getPagesByTags();
        }

    }

    /**
     * Prepare title parts to serach
     * @return array
     */
    private function getTitleParts() {
        $titleParts = explode(' ', $this->pageTitle);
        if (!$titleParts) {
            return [];
        }

        $titleParts = array_map('trim', $titleParts);

        $titleParts = array_filter($titleParts, function ($part) {
            return mb_strlen($part) >= $this->settings['min_compare_symbols'];
        });

        return $titleParts;
    }

    /**
     * Search pages by tags
     * @return array
     */
    private function getPagesByTags() {
        $query = "
                SELECT page.*, count(page_tags.tag_id) AS tags_count,
                CASE WHEN LENGTH(page.prev_text) > " . $this->settings['max_short_description_words'] . "
                THEN CONCAT(SUBSTRING(page.prev_text, 1, " . $this->settings['max_short_description_words'] . "), '...')
                ELSE page.prev_text END AS prev_text
                FROM `content` AS page
                JOIN content_tags  AS page_tags
                ON page_tags.page_id = page.id
                WHERE tag_id IN (SELECT tag_id FROM content_tags WHERE page_id = " . $this->pageId . ")  AND `page`.`post_status`='publish'
                AND page.id != " . $this->pageId;

        if (!in_array('all', $this->settings['categories'])) {
            $query .= ' AND page.category IN (' . implode(',', $this->settings['categories']) . ')';
        }

        $query .= " GROUP BY page.id ORDER BY tags_count DESC LIMIT " . $this->settings['limit'];
        $result = CI::$APP->db->query($query);

        return $result ? $result->result_array() : [];
    }

    /**
     * Search pages by title
     * @return array
     */
    private function getPagesByTitle() {
        $titleParts = $this->getTitleParts();
        $pages = $this->getAllPages();

        $results = [];
        foreach ($pages as $page) {
            foreach ($titleParts as $search) {
                $searchCount = mb_substr_count($page['title'], $search);
                if ($searchCount) {
                    $prevTextLimit = $this->settings['max_short_description_words'];
                    $page['prev_text'] = mb_strlen($page['prev_text']) > $prevTextLimit ? mb_substr($page['prev_text'], 1, $prevTextLimit) . '...' : $prevTextLimit;
                    $results[$page['id']]['count'] += $searchCount;
                    $results[$page['id']]['page'] = $page;

                }
            }
        }

        usort($results, function ($a, $b) {
            return $a["count"] < $b["count"];
        });

        $pages = [];
        array_walk($results, function ($item) use (&$pages) {
            $pages[] = $item['page'];
        });

        return $pages;
    }

    /**
     * Get all pages
     * @return array
     */
    private function getAllPages() {
        CI::$APP->db->select('content.*');
        CI::$APP->db->select("CONCAT_WS('', content.cat_url, content.url ) as full_url");
        CI::$APP->db->where('post_status', 'publish');
        CI::$APP->db->where('publish_date <=', time());

        if (!in_array('all', $this->settings['categories'])) {
            CI::$APP->db->where_in('category', $this->settings['categories']);
        }

        CI::$APP->db->where('id <>', $this->pageId);
        CI::$APP->db->where('lang', CI::$APP->config->item('cur_lang'));
        $pages = CI::$APP->db->get('content');

        return $pages ? $pages->result_array() : [];
    }

}