<?php

namespace xbanners\src\UrlFinder\Results;

use Countable;

class Result implements ResultInterface, Countable
{

    /**
     * @var string
     */
    protected $groupName;

    /**
     * @var array
     */
    protected $urls = [];

    /**
     * @param string $groupName
     */
    public function __construct($groupName) {
        $this->groupName = $groupName;
    }

    public function addResult($name, $url) {
            $this->urls[$name .' ('. array_pop(explode('/', $url)).')'] = $url;
    }

    /**
     * @return string
     */
    public function getGroupName() {
        return $this->groupName;
    }

    public function count() {
        return count($this->urls);
    }

    /**
     * @return array
     */
    public function getResults() {
        return $this->urls;
    }

    public function toArray() {
        return [$this->getGroupName() => $this->getResults()];
    }

}