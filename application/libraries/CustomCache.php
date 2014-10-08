<?php

/**
 * Simple class that helps caching data 
 * created mostly for illustrative purposes
 * 
 * Usage:
 * $cache = new CustomCache(360, 'some_remote_data', function(){
 *      return file_get_contents('http://imagecms.net/some_controller/get_some_xml');
 * });
 * 
 * $myXml = $cache->getData(); // you don't know if data was from cache, or from remote source
 * 
 * @author kolia
 */
class CustomCache {

    const CACHE_PATH = 'system/cache/';

    protected static $cacheFilenames = array();

    /**
     * Interval in seconds
     * @var int
     */
    protected $interval;

    /**
     *
     * @var string
     */
    protected $cacheFilepath;

    /**
     * Function that returns the actual data
     * @var Closure 
     */
    protected $dataSourceCallback;

    /**
     * 
     * @param int $interval update interval in seconds 
     * @param string $cacheFilename file name that will be stored cache
     * @param Closure $dataSourceCallback function that returns actual data
     * @throws \Exception
     */
    public function __construct($interval = 0, $cacheFilename, Closure $dataSourceCallback) {
        if (is_numeric($interval)) {
            $this->interval = $interval;
        } elseif (ENVIRONMENT == 'development') {
            throw new \Exception(lang('Interval argument must be integer', 'main'));
        }

        $fileError = '';
        if (!preg_match('/^[a-zA-Z0-9\_\-]{1,240}$/', $cacheFilename)) {
            $fileError = lang('Cache file name is not valid string. ', 'main');
        }
        if (in_array($cacheFilename, self::$cacheFilenames)) {
            $fileError = lang('Cache file with such name already exist. Please chose another name', 'main');
        }

        if ($fileError === '') {
            $this->cacheFilepath = PUBPATH . self::CACHE_PATH . 'custom_cache_' . $cacheFilename . '.txt';
            self::$cacheFilenames[] = $cacheFilename;
        } elseif (ENVIRONMENT == 'development') {
            throw new \Exception($fileError);
        }

        $this->dataSourceCallback = $dataSourceCallback;
    }

    /**
     * Gets the data (client don't know it's from cache or not)
     * @return string
     */
    public function getData() {
        $dataSourceCallback = $this->dataSourceCallback;
        // if it's production and configuratin has errors data always will be from source
        if (is_null($this->cacheFilepath) || is_null($this->dataSourceCallback)) {
            return $dataSourceCallback();
        }
        // if chached file exists and has actual data it's content will be returned
        if (file_exists($this->cacheFilepath) && time() < (filemtime($this->cacheFilepath) + $this->interval)) {
            return file_get_contents($this->cacheFilepath);
        }
        // getting new data, save it, return it =)
        $data = $dataSourceCallback();
        file_put_contents($this->cacheFilepath, $data);
        return $data;
    }

}
