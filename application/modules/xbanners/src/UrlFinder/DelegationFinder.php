<?php

namespace xbanners\src\UrlFinder;

use xbanners\src\UrlFinder\Finders\BaseFinder;
use xbanners\src\UrlFinder\Finders\Brands;
use xbanners\src\UrlFinder\Finders\PageCategories;
use xbanners\src\UrlFinder\Finders\Pages;
use xbanners\src\UrlFinder\Finders\ProductCategories;
use xbanners\src\UrlFinder\Finders\Products;

class DelegationFinder extends BaseFinder
{

    /**
     * @var BaseFinder[]
     */
    protected $finders = [];

    public function __construct() {
        if (\MY_Controller::isCorporateCMS()) {
            $this->finders = [
                              new Pages(),
                              new PageCategories(),

                             ];
        } else {
            $this->finders = [
                              new Brands(),
                              new Products(),
                              new ProductCategories(),
                              new Pages(),
                              new PageCategories(),
                             ];

        }
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

    public function formUrl($url) {
        return null;
    }

}