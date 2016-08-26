<?php

namespace xbanners\src\UrlFinder;

use xbanners\src\UrlFinder\Results\Result;

class ResultsCollection
{

    /**
     * @var null
     */
    protected $groupName;

    /**
     * @var Result[]
     */
    protected $results = [];

    public function addResult(Result $result) {
        $this->results[] = $result;
    }

    public function getGroupName() {
        return $this->groupName;
    }

    public function getResults() {
        return $this->results;
    }

    public function toArray() {

        $array = [];
        foreach ($this->results as $oneResult) {
            if (count($oneResult)) {
                $oneResultArray = $oneResult->toArray();
                $array[] = [
                            'label' => $oneResult->getGroupName(),
                            'value' => $oneResultArray[$oneResult->getGroupName()],
                           ];

            }
        }
        return $array;
    }

    public function toJson() {
        return json_encode($this->toArray());
    }

}