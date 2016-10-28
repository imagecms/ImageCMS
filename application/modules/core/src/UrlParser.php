<?php namespace core\src;

use core\src\Exception\PageNotFoundException;

class UrlParser
{

    const SEPARATOR = '/';

    const VALUE_SEPARATOR = '-or-';

    const PREFIX_BRAND = 'brand-';

    const PREFIX_PROPERTY = 'property-';

    /**
     * @var array
     */
    private $properties = [];

    /**
     * @var array
     */
    private $brands = [];

    /**
     * Only filter segments
     * @var array
     */
    private $filterSegments;

    /**
     * Url segments without filter
     * @var array
     */
    private $urlSegments;

    /**
     * All segments
     * @var array
     */
    private $segments = [];

    /**
     * @var string
     */
    private $locale;

    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $fullUrl;

    /**
     * @var CoreConfiguration
     */
    private $coreConfiguration;

    /**
     * @var int
     */
    private $brandSegmentPosition = 0;

    /**
     * @var array
     */
    private $propertySegmentPositions = [];

    /**
     * @var string
     */
    private $paramsString;

    public function __construct(CoreConfiguration $coreConfiguration) {

        $this->coreConfiguration = $coreConfiguration;
    }

    /**
     * @param $url
     */
    public function parse($url) {
        list($this->fullUrl, $this->paramsString) = explode('?', $url);
        if (strpos($this->fullUrl, '/') == 0) {
            $this->fullUrl = (string) substr($this->fullUrl, 1);
        }

        $this->segments = $this->createSegments();
        $this->locale = $this->detectLanguage();
        $this->filterSegments = $this->fetchFilterSegments($this->segments);
        $this->url = $this->fetchUrl();
    }

    public function getFullUrl($locale = true, $filterSegments = true, $getParams = true) {

        if ($filterSegments) {
            $url = $this->segments;
        } else {
            $url = $this->urlSegments;
        }

        if ($locale && $this->locale) {
            array_unshift($url, $this->locale);
        }

        $url = implode('/', $url);

        if ($getParams && $this->paramsString) {
            $url = $url . '?' . $this->paramsString;
        }

        return $url;
    }

    /**
     * Url without locale and filter parameters
     * @return string
     */
    public function getUrl() {
        return $this->url;
    }

    /**
     * Locale from url
     * @return string
     */
    public function getLocale() {
        return $this->locale;
    }

    /**
     * @return array
     */
    public function getFilterSegments() {
        return $this->filterSegments;
    }

    /**
     * @return string
     */
    public function getFilterSegment() {
        return implode(self::SEPARATOR, $this->filterSegments);
    }

    /**
     * @return array
     */
    public function getProperties() {
        return $this->properties;
    }

    /**
     * @return array
     */
    public function getBrands() {
        return $this->brands;
    }

    /**
     * @param $propertyName
     * @return array|null
     */
    public function getValues($propertyName) {
        return isset($this->properties[$propertyName]) ? $this->properties[$propertyName] : null;
    }

    /**
     * @return string csv_name
     */
    public function getFirstProperty() {
        return key($this->properties);
    }

    /**
     * @param string $property
     * @return string value
     */
    public function getFirstValue($property) {
        $values = $this->getValues($property);
        return reset($values);
    }

    /**
     * @return int
     */
    public function countBrands() {
        return count($this->brands);
    }

    /**
     * @return int
     */
    public function countProperties() {
        return count($this->properties);
    }

    /**
     * @param $propertyName
     * @return int
     */
    public function countValues($propertyName) {
        return count($this->getValues($propertyName));
    }

    /**
     * Explode url segments and check denied
     * @return array
     * @throws PageNotFoundException
     */
    private function createSegments() {
        $segments = explode('/', $this->fullUrl);
        return $segments;
    }

    /**
     * @return string|null
     */
    private function detectLanguage() {

        $languageExists = count($this->segments) >= 1 && array_key_exists($this->segments[0], $this->coreConfiguration->getLanguages());

        if ($languageExists) {
            return array_shift($this->segments);
        }
    }

    public function brandSegmentIsFirst() {
        return
            $this->brandSegmentPosition < min($this->propertySegmentPositions)
            || empty($this->propertySegmentPositions)
            || $this->brandSegmentPosition == 0;
    }

    /**
     * @param $segments
     * @return array|null
     */
    private function fetchFilterSegments($segments) {
        $this->segments = $segments;

        foreach ($segments as $key => $segment) {
            if (stripos($segment, self::PREFIX_BRAND) === 0) {
                $this->fetchBrands($segment);
                $filterSegments[] = $segment;
                $this->brandSegmentPosition = $key;
            } elseif (stripos($segment, self::PREFIX_PROPERTY) === 0) {
                $this->fetchProperties($segment);
                $filterSegments[] = $segment;
                $this->propertySegmentPositions[] = $key;
            } else {
                $this->urlSegments[] = $segment;
            }

        }

        return is_array($filterSegments) ? $filterSegments : null;

    }

    /**
     * @param array $segment
     */
    private function fetchBrands($segment) {
        $segment = substr($segment, strlen(self::PREFIX_BRAND));
        $this->brands = explode(self::VALUE_SEPARATOR, $segment);
    }

    /**
     * @param array $segment
     */
    private function fetchProperties($segment) {
        $segment = substr($segment, strlen(self::PREFIX_PROPERTY));
        $values = explode(self::VALUE_SEPARATOR, $segment);

        $firstValue = $values[0];
        $valueSeparator = strrpos($firstValue, '-');
        $property = substr($firstValue, 0, $valueSeparator);
        $value = substr($firstValue, $valueSeparator + 1);

        $values[0] = $value;

        $this->properties[$property] = $values;

    }

    /**
     * @return string
     */
    private function fetchUrl() {

        $segments = $this->segments;

        if (($filters = $this->filterSegments)) {
            $segments = array_slice($segments, 0, count($segments) - count($filters));
        }

        $categoryPath = implode('/', $segments);

        return $categoryPath;
    }
}