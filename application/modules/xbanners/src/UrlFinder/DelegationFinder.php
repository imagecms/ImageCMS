<?php

namespace Banners\UrlFinder;

use Banners\UrlFinder\Finders\FinderInterface;

class DelegationFinder implements FinderInterface {

    /**
     * @var FinderInterface[]
     */
    protected $finders = [];

    public function __construct() {
        $this->finders = [
            new \Banners\UrlFinder\Finders\Brands(),
            new \Banners\UrlFinder\Finders\Products(),
            new \Banners\UrlFinder\Finders\ProductCategories(),
            new \Banners\UrlFinder\Finders\Pages(),
            new \Banners\UrlFinder\Finders\PageCategories(),
        ];
    }

    /**
     * @param string $word
     * @return ResultsCollection
     */
    public function getResultsFor($word, $language, $limit = 10) {
        $results = new ResultsCollection();
        foreach ($this->finders as $finder) {
            $results->addResult($finder->getResultsFor($word, $language, $limit));
        }
        return $results;
    }

    public function getGroupName() {
        return null;
    }

}
