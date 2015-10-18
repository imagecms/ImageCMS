<?php

namespace template_manager\classes;

use Symfony\Component\Config\Util\XmlUtils;

class Params
{

    /**
     * @var string
     */
    protected $path;

    /**
     * @var array
     */
    protected $paramsArray = [];

    /**
     * @param string $path
     */
    public function __construct($path) {
        $this->path = $path;
    }

    /**
     * @return array
     */
    public function getArray() {
        if (count($this->paramsArray) < 1) {
            $dom = new \DOMDocument();
            $dom->load($this->path);
            $this->paramsArray = XmlUtils::convertDomElementToArray($dom->getElementsByTagName('template')->item(0));
        }
        return $this->paramsArray;
    }

    public function getValue($name) {
        $array = $this->getArray();
        if (array_key_exists($name, $array)) {
            return $array[$name];
        }
    }

}