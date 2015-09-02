<?php

namespace translator\classes;

(defined('BASEPATH')) OR exit('No direct script access allowed');

class PoFileSearch {

    /**
     * PoFileSearch instance
     * @var PoFileSearch object
     */
    private static $instance;

    /**
     * File path
     * @var type
     */
    private $filePath;

    /**
     * Errors array
     * @var type
     */
    private $errors = array();

    /**
     * File data
     * @var type
     */
    private $data;

    private $searchString;

    private $searchStringMinLength = 2;

    private $searchedPaths;

    private $searchResult;

    private $searchResultsCount = [];

    private $searchType = NULL;

    private $languages;

    private $poFileManager;

    private $cacheTimeSeconds = 25;

    private function __construct() {
        $this->searchedPaths = array(
            'modules' => DOCUMENT_ROOT . '/application/modules',
            'main' => DOCUMENT_ROOT . '/application/language',
            'templates' => TEMPLATES_PATH
        );

        $this->languages = \CI::$APP->db->get('languages')->result_array();
        $this->poFileManager = new PoFileManager();
    }

    /**
     * Get PoFileSearch instance
     * @return PoFileSearch
     */
    public static function getInstatce() {
        if (null === self::$instance) {
            return self::$instance = new self();
        } else {
            return self::$instance;
        }
    }

    private function setSearchString($searchString) {
        $searchString = $this->formStringToSearch(trim($searchString));
        if (mb_strlen($searchString) >= $this->searchStringMinLength) {
            $this->searchString = mb_strtolower($searchString);
        } else {
            throw new \Exception(lang('Search string can not be smaller then 2 symbols.', 'translator'));
        }
    }

    private function setSearchType($searchType) {
        $this->searchType = $searchType ? $searchType : 'all';
    }

    public function getSearchString() {
        return $this->searchString;
    }

    public function run($searchString, $searchType) {
        try {
            if ($this->getFromCache($searchString)) {
                return TRUE;
            }

            $this->setSearchString($searchString);
            $this->setSearchType($searchType);
            $this->search();
            $this->setData($this->searchResult);
            $this->setCache($searchString);

            return TRUE;
        } catch (\Exception $exc) {
            $this->setError($exc->getMessage());
            return FALSE;
        }
    }

    /**
     * Get search results from cache
     * @param string $searchString - string to search
     * @return bool
     */
    private function getFromCache($searchString) {
        if ($data = \CI::$APP->cache->fetch($searchString . $this->searchType, 'translator_full_search')) {
            $this->setData($data);
            $this->searchResultsCount = \CI::$APP->cache->fetch($searchString . $this->searchType . '_result_counts', 'translator_full_search');
            return TRUE;
        }
        return FALSE;
    }

    /**
     * Create cache for this search string query
     * @param string $searchString - string to search
     */
    private function setCache($searchString) {
        if ($this->getData()) {
            \CI::$APP->cache->store($searchString . $this->searchType, $this->getData(), $this->cacheTimeSeconds, 'translator_full_search');
            \CI::$APP->cache->store($searchString . $this->searchType . '_result_counts', $this->getResultsCount(), $this->cacheTimeSeconds, 'translator_full_search');
        }
    }

    private function search() {
        foreach ($this->searchedPaths as $entity_type => $path) {
            $this->scanSearchDir($entity_type, $path);
        }

        return $this->searchResult;
    }

    /**
     * @param string $entity_type
     */
    private function scanSearchDir($entity_type, $path) {
        foreach (new \DirectoryIterator($path) as $entity) {

            $entity_name = $entity->getFilename();
            if (!$entity->isDot() && $entity->isDir() && $entity_name[0] != '.') {

                foreach ($this->languages as $language) {
                    $po_file = $this->poFileManager->toArray($entity_name, $entity_type, $language['locale']);

                    foreach ($po_file['po_array'] as $origin => $data) {
                        $this->searchLang($origin, $data, $entity_type, $entity_name, $language);
                    }
                }
            }
        }
    }

    /**
     * @param string $entity_name
     */
    private function searchLang($origin, $data, $entity_type, $entity_name, $language) {
        switch ($this->searchType) {
            case 'all':
                if ($this->searchString($origin) || $this->searchString($data['translation'])) {
                    $data['origin'] = $origin;
                    $this->searchResult[$entity_type][$entity_name][$language['locale']][] = $data;
                    $this->setResultsCount($entity_type, $entity_name, $language['locale']);
                }
                break;
            case 'origin':
                if ($this->searchString($origin)) {
                    $data['origin'] = $origin;
                    $this->searchResult[$entity_type][$entity_name][$language['locale']][] = $data;
                    $this->setResultsCount($entity_type, $entity_name, $language['locale']);
                }
                break;
            case 'translation':
                if ($this->searchString($data['translation'])) {
                    $data['origin'] = $origin;
                    $this->searchResult[$entity_type][$entity_name][$language['locale']][] = $data;
                    $this->setResultsCount($entity_type, $entity_name, $language['locale']);
                }
                break;
        }
    }

    /**
     * Search in string
     * @param string $searchString - string to search in
     * @return string
     */
    private function searchString($searchString) {
        $searchString = $this->formStringToSearch($searchString);
        return strstr($searchString, $this->searchString);
    }

    /**
     * Prepare search string
     * @param string $string - string to search in
     * @return string
     */
    private function formStringToSearch($string) {
        return mb_strtolower($string);
    }

    /**
     * Set error
     * @param string $error - error text
     */
    private function setError($error) {
        $this->errors = $error;
    }

    /**
     * Get errors
     * @return type
     */
    public function getErrors() {
        return $this->errors;
    }

    /**
     * Set file data
     * @param string $data - file data
     */
    private function setData($data) {
        $this->data = $data;
    }

    /**
     * Get file data
     * @return string
     */
    public function getData() {
        return $this->data;
    }

    /**
     * Set searched results count. For all entities: modules, templates, main
     * @param string $entity_type - entity type: module, template, main
     * @param string $entity_name - entity name, name of: module, template, main(main)
     * @param string $locale - searched locale
     */
    private function setResultsCount($entity_type, $entity_name, $locale) {
        $this->searchResultsCount['total'] += 1;
        $this->searchResultsCount[$entity_type]['total'] += 1;
        $this->searchResultsCount[$entity_type]['list'][$entity_name] += 1;
        $this->searchResultsCount[$entity_type]['locale'][$locale] += 1;
    }

    /**
     * Returns searched counts array
     * @return array
     */
    public function getResultsCount() {
        return $this->searchResultsCount;
    }

}