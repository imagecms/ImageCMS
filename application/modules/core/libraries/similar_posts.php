<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Class Similar_Posts
 * Search similar pages to current which is shown
 */
class Similar_Posts
{

    /**
     * @var array
     */
    private $defaultSettings = [
                                'categories'                  => ['all'],
                                'limit'                       => 5,
                                'max_short_description_words' => 500,
                               ];

    /**
     * @var array
     */
    private $settings = [];

    /**
     * Page title to search similar
     * @var string
     */
    private $pageTitle = '';

    /**
     * Page id to search similar
     * @var int
     */
    private $pageId;

    public function __construct() {

    }

    /**
     * @return array
     */
    public function getDefaultSettings() {
        return $this->defaultSettings;
    }

    /**
     * @param array $settings
     */
    private function initSettings($settings) {
        foreach ($this->defaultSettings as $settingName => $setting) {
            $this->settings[$settingName] = $settings[$settingName] ?: $setting;
        }
    }

    /**
     * @param string $title
     */
    private function setPageTitle($title) {
        $title = str_replace([',', ';', ':', '-', '+', '=', '@', '.', '/', '\''], '', $title);
        $this->pageTitle = $title;
    }

    /**
     * @param int $pageId
     */
    private function setPageId($pageId) {
        $this->pageId = $pageId;
    }

    /**
     * Start find similar pages
     * @param int $pageId
     * @param string $title
     * @param array $settings
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
        $pages = $this->getPagesByTags();

        $prevTextLimit = $this->settings['max_short_description_words'];
        if ($prevTextLimit) {
            foreach ($pages as $key => $page) {
                $pages[$key]['prev_text'] = mb_strlen($page['prev_text']) > $prevTextLimit ? strip_tags(mb_substr($page['prev_text'], 0, $prevTextLimit)) . '...' : $page['prev_text'];
            }
        }

        return $pages;
    }

    /**
     * Search pages by tags
     * @return array
     */
    private function getPagesByTags() {
        $query = '
                SELECT `content`.*, count(content_tags.`tag_id`) AS `tags_count`, IF(`route`.`parent_url` <> \'\', 
                concat(`route`.`parent_url`, \'/\', `route`.`url`), `route`.`url`) as `full_url`
                FROM `content`
                JOIN `content_tags` ON `content_tags`.`page_id` = `content`.`id`
                LEFT JOIN `route` on `content`.`id` = route.entity_id AND `route`.`type` = \'page\'
                WHERE tag_id IN (SELECT tag_id FROM content_tags WHERE page_id = ' . $this->pageId . ")  AND `content`.`post_status`='publish'
                AND `content`.id != " . $this->pageId
                . ' AND `content`.lang = ' . CI::$APP->config->item('cur_lang');

        if (!in_array('all', $this->settings['categories'])) {
            $query .= ' AND `content`.`category` IN (' . implode(',', $this->settings['categories']) . ')';
        }

        $query .= ' GROUP BY `content`.`id` ORDER BY `tags_count` DESC';
        if ($this->settings['limit']) {
            $query .= ' LIMIT ' . $this->settings['limit'];
        }

        $result = CI::$APP->db->query($query);

        return $result ? $result->result_array() : [];
    }

}