<?php

namespace xbanners\src\UrlFinder\Results;

interface ResultInterface
{

    public function __construct($groupName);

    /**
     * @param string $name
     * @param string $url
     */
    public function addResult($name , $url);

    /**
     * @return string
     */
    public function getGroupName();

    /**
     * @return array
     */
    public function getResults();

    /**
     * @return array
     */
    public function toArray();

}