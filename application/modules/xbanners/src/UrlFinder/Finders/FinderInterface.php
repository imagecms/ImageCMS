<?php

namespace Banners\UrlFinder\Finders;

interface FinderInterface {

    /**
     * @param string $word
     * @param string $language
     * @param int $limit
     */
    public function getResultsFor($word, $language, $limit);

    /**
     * Product Banner etc.
     * 
     * @return string
     */
    public function getGroupName();
}
